<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if ($_POST['req'] == 1) {
		foreach ($_POST as $v) {
			if (gettype($v) != "string") {
				$a_response = [0, "Unable to process request. Error code: 11"];
				echo json_encode($a_response);
				exit;
			}
			if (strlen($v) > 255) {
				$a_response = [0, "Unable to process request. Error code: 12"];
				echo json_encode($a_response);
				exit;
			}
		}
		require '../../db-mailserver.php';
		$s_query = "SELECT domain_id, password FROM virtual_users WHERE email = ?";
		$o_stmt = $o_sql->prepare($s_query);
		$o_stmt->bind_param("s", $_POST['email']);
		$o_stmt->execute();
		$o_stmt->bind_result($s_domain, $s_hash);
		$o_stmt->fetch();
		$o_stmt->close();
		$o_sql->close();
		if (empty($s_hash)) {
			$a_response = [0, "Email address not found."];
			echo json_encode($a_response);
			exit;
		}
		$s_hash = str_replace("{BLF-CRYPT}", "", $s_hash);
		if (password_verify($_POST['password'], $s_hash)) {
			$_SESSION['b_logged_in'] = true;
			$_SESSION['email'] = $_POST['email'];
			$_SESSION['domain'] = $s_domain;
			$a_response = [1, $s_hash];
			echo json_encode($a_response);
			exit;
		} else {
			$a_response = [0, "Incorrect password."];
			echo json_encode($a_response);
			exit;
		}
	}
}

?>