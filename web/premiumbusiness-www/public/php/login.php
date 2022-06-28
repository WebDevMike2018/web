<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if ($_POST['req'] == "1") {
		if ($_POST['password'] == "bvRvAa2X") {
			$_SESSION['b_logged_in'] = true;
			$a_response = [1, "Authorized"];
			echo json_encode($a_response);
			exit;
		} else {
			$a_response = [0, "Incorrect password"];
			echo json_encode($a_response);
			exit;
		}
	}
}

?>