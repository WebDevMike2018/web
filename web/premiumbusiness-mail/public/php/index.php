<?php

if (empty($_SESSION['b_logged_in'])) {
	$a_response = [0, "Unable to process request. Error code: 13"];
	echo json_encode($a_response);
	exit;
}

function f_password_generator($i_length) {
	$i_length = empty($i_length) ? 16 : $i_length;
	$a_alpha_numeric_safe = ["2", "3", "4", "5", "6", "7", "8", "9", "A", "B", "C", "D", "E", "F", "G", "H", "J", "K", "L", "M", "N", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"];
	$i_a_length = count($a_alpha_numeric_safe) - 1;
	$s_password = "";
	for ($i = 0; $i < $i_length; $i++) {
		$s_password .= $a_alpha_numeric_safe[rand(0, $i_a_length)];
	}
	return $s_password;
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	if ($_GET['req'] == 1) {
		$a_email = explode("@", $_SESSION['email']);
		if ($a_email[0] == "admin") {
			$a1 = [];
			require '../../db-mailserver.php';
			$s_query = "SELECT email FROM virtual_users WHERE domain_id = ?";
			$o_stmt = $o_sql->prepare($s_query);
			$o_stmt->bind_param("s", $_SESSION['domain']);
			$o_stmt->execute();
			$o_stmt->bind_result($c1);
			while ($o_stmt->fetch()) {
				if ($c1 == $_SESSION['email']) { continue; }
				$a1[] = $c1;
			}
			$o_stmt->close();
			$o_sql->close();
			$a_response = [1, $a1, $a_email[1]];
			echo json_encode($a_response);
			exit;
		} else {
			$a_response = [2, $_SESSION['email']];
			echo json_encode($a_response);
			exit;
		}
	}
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if ($_POST["req"] == 1) {
		require '../../db-mailserver.php';
		$s_query = "SELECT id, password FROM virtual_users WHERE email = ?";
		$o_stmt = $o_sql->prepare($s_query);
		$o_stmt->bind_param("s", $_SESSION['email']);
		$o_stmt->execute();
		$o_stmt->bind_result($c1, $c2);
		$o_stmt->fetch();
		$o_stmt->close();
		$c2 = str_replace("{BLF-CRYPT}", "", $c2);
		if (password_verify($_POST['curpass'], $c2)) {
			$s_hash = password_hash($_POST['newpass'], PASSWORD_BCRYPT);
			$s_hash = "{BLF-CRYPT}" . $s_hash;
			$s_query = "UPDATE virtual_users SET password = ? WHERE id = ?";
			$o_stmt = $o_sql->prepare($s_query);
			$o_stmt->bind_param("ss", $s_hash, $c1);
			if ($o_stmt->execute()) {
				$o_stmt->close();
				$o_sql->close();
				$a_response = [1];
				echo json_encode($a_response);
				exit;
			} else {
				$o_stmt->close();
				$o_sql->close();
				$a_response = [0, "Unable to process request. Error code: 14."];
				echo json_encode($a_response);
				exit;
			}
		} else {
			$a_response = [0, "Incorrect password. Please check your current password and try again."];
			echo json_encode($a_response);
			exit;
		}
	}
	if ($_POST["req"] == 2) {
		$a_email = explode("@", $_SESSION['email']);
		if ($a_email[0] == "admin") {
			$s_password = f_password_generator(null);
			$s_hash = password_hash($s_password, PASSWORD_BCRYPT);
			$s_hash = "{BLF-CRYPT}" . $s_hash;
			require '../../db-mailserver.php';
			$s_query = "UPDATE virtual_users SET password = ? WHERE email = ?";
			$o_stmt = $o_sql->prepare($s_query);
			$o_stmt->bind_param("ss", $s_hash, $_SESSION['email']);
			if ($o_stmt->execute()) {
				$o_stmt->close();
				$o_sql->close();
				$a_response = [1, $s_password];
				echo json_encode($a_response);
				exit;
			} else {
				$o_stmt->close();
				$o_sql->close();
				$a_response = [0, "Unable to process request. Error code: 12"];
				echo json_encode($a_response);
				exit;
			}
		} else {
			$a_response = [0, "Unable to process request. Error code: 11"];
			echo json_encode($a_response);
			exit;
		}
	}
	if ($_POST["req"] == 3) {
		if (gettype($_POST['email']) != "string") {
			$a_response = [0, "Unable to process request. Error code: 15"];
			echo json_encode($a_response);
			exit;
		}
		if (strlen($_POST['email']) < 3 || strlen($_POST['email']) > 30) {
			$a_response = [0, "Unable to process request. Error code: 16"];
			echo json_encode($a_response);
			exit;
		}
		if (preg_match("/^[a-zA-Z0-9][a-zA-Z0-9.]+[a-zA-Z0-9]$/", $_POST['email']) !== 1) {
			$a_response = [0, "Unable to process request. Error code: 17"];
			echo json_encode($a_response);
			exit;
		}
		$a_email = explode("@", $_SESSION['email']);
		if ($a_email[0] != "admin") {
			$a_response = [0, "Unable to process request. Error code: 18"];
			echo json_encode($a_response);
			exit;
		}
		$s_email = $_POST['email'] . "@" . $a_email[1];
		$s_password = f_password_generator(null);
		$s_hash = password_hash($s_password, PASSWORD_BCRYPT);
		$s_hash = "{BLF-CRYPT}" . $s_hash;
		require '../../db-mailserver.php';
		$s_query = "INSERT INTO virtual_users (domain_id, email, password) VALUES (?, ?, ?)";
		$o_stmt = $o_sql->prepare($s_query);
		$o_stmt->bind_param("sss", $_SESSION['domain'], $s_email, $s_hash);
		if($o_stmt->execute()) {
			$o_stmt->close();
			$o_sql->close();
			$a_response = [1, $s_email, $s_password];
			echo json_encode($a_response);
			exit;
		} else {
			$o_stmt->close();
			$o_sql->close();
			$a_response = [0, "Unable to process request. Error code: 19"];
			echo json_encode($a_response);
			exit;
		}
	}
	if ($_POST["req"] == 4) {
		require '../../db-mailserver.php';
		$s_query = "SELECT id FROM virtual_users WHERE email = ?";
		$o_stmt = $o_sql->prepare($s_query);
		$o_stmt->bind_param("s", $_POST['email']);
		$o_stmt->execute();
		$o_stmt->bind_result($c1);
		$o_stmt->fetch();
		if (empty($c1)) {
			$o_stmt->close();
			$o_sql->close();
			$a_response = [0, "Unable to process request. Error code: 20"];
			echo json_encode($a_response);
			exit;
		}
		$o_stmt->close();
		$s_query = "DELETE FROM virtual_users WHERE email = ?";
		$o_stmt = $o_sql->prepare($s_query);
		$o_stmt->bind_param("s", $_POST['email']);
		$o_stmt->execute();
		$o_stmt->close();
		$o_sql->close();
		$a_response = [1];
		echo json_encode($a_response);
		exit;
	}
}

// error code: 20
?>