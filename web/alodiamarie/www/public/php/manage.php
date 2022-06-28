<?php

if (empty($_SESSION['b_logged_in'])) { exit; }

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	if ($_GET['req'] == 1) {
		$a1 = [];
		require '../../db-alodiamarie.php';
		$s_query = "SELECT c_index, c_text FROM t_links ORDER BY c_text";
		$o_result = $o_sql->query($s_query);
		while ($a_row = $o_result->fetch_row()) {
			$a1[] = [$a_row[0], $a_row[1]];
		}
		$a_response = [1, $a1];
		echo json_encode($a_response);
		exit;
	}
	if ($_GET['req'] == 2) {
		$a1 = [];
		$a2 = [];
		require '../../db-alodiamarie.php';
		$s_query = "SELECT c_index, c_title FROM t_games_playing ORDER BY c_title";
		$o_result = $o_sql->query($s_query);
		while ($a_row = $o_result->fetch_row()) {
			$a1[] = [$a_row[0], $a_row[1]];
		}
		$s_query = "SELECT c_index, c_title FROM t_games_played ORDER BY c_title";
		$o_result = $o_sql->query($s_query);
		while ($a_row = $o_result->fetch_row()) {
			$a2[] = [$a_row[0], $a_row[1]];
		}
		$a_response = [1, $a1, $a2];
		echo json_encode($a_response);
		exit;
	}
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if ($_POST['req'] == 1) {
		require '../../db-alodiamarie.php';
		$s_query = "INSERT INTO t_links (c_link, c_text) VALUES (?, ?)";
		$o_stmt = $o_sql->prepare($s_query);
		$o_stmt->bind_param("ss", $_POST["link"], $_POST["text"]);
		$o_stmt->execute();
		$o_stmt->close();
		$o_sql->close();
		$a_response = [1];
		echo json_encode($a_response);
		exit;
	}
	if ($_POST['req'] == 2) {
		require '../../db-alodiamarie.php';
		$s_query = "DELETE FROM t_links WHERE c_index = ?";
		$o_stmt = $o_sql->prepare($s_query);
		$o_stmt->bind_param("s", $_POST["index"]);
		$o_stmt->execute();
		$o_stmt->close();
		$o_sql->close();
		$a_response = [1];
		echo json_encode($a_response);
		exit;
	}
	if ($_POST['req'] == 3) {
		require '../../db-alodiamarie.php';
		$s_table = ($_POST['type'] == 1) ? "t_games_playing" : "t_games_played";
		$s_query = "INSERT INTO $s_table (c_title) VALUES (?)";
		$o_stmt = $o_sql->prepare($s_query);
		$o_stmt->bind_param("s", $_POST["title"]);
		try {
			$o_stmt->execute();
			$o_stmt->close();
			$o_sql->close();
			$a_response = [1];
			echo json_encode($a_response);
			exit;
		} catch (mysqli_sql_exception $e) {
			$a_response = [0, "This title already exists."];
			echo json_encode($a_response);
			$o_stmt->close();
			$o_sql->close();
			exit;
		}
	}
	if ($_POST['req'] == 4) {
		require '../../db-alodiamarie.php';
		$s_table = ($_POST['table'] == 1) ? "t_games_playing" : "t_games_played";
		$s_query = "DELETE FROM $s_table WHERE c_index = ?";
		$o_stmt = $o_sql->prepare($s_query);
		$o_stmt->bind_param("s", $_POST["index"]);
		$o_stmt->execute();
		$o_stmt->close();
		$o_sql->close();
		$a_response = [1];
		echo json_encode($a_response);
		exit;
	}
	if ($_POST['req'] == 5) {
		$s_dir = "../media/index/";
		$a_scan = scandir($s_dir);
		$s_ext = str_ireplace("image/", "", $_FILES['pic']['type']);
		$s_path = $s_dir . "new." . $s_ext;
		$s_path1 = $s_dir . "alodia." . $s_ext;
		$s_path2 = $s_dir . $a_scan[2];
		$s_path3 = "media/index/" . $a_scan[2];
		$s_path4 = "media/index/alodia." . $s_ext;
		if (move_uploaded_file($_FILES['pic']['tmp_name'], $s_path)) {
			unlink($s_path2);
			rename($s_path, $s_path1);
			$s_file = file_get_contents("../index.php");
			$s_file = str_ireplace($s_path3, $s_path4, $s_file);
			file_put_contents("../index.php", $s_file);
			$a_response = [1];
			echo json_encode($a_response);
			exit;
		}
	}
}

?>