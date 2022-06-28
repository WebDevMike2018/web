<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if ($_POST['req'] == "1") {
		foreach ($_POST as &$v) {
			if (empty($v)) {
				$v = null;
			}
		}
		require "../../db-premiumbusiness.php";
		$s_query = "SELECT c_index FROM t_contacts WHERE c_address = ?";
		$o_stmt = $o_sql->prepare($s_query);
		$o_stmt->bind_param("s", $_POST['address']);
		$o_stmt->execute();
		$o_stmt->store_result();
		if ($o_stmt->num_rows > 0) {
			$o_stmt->close();
			$o_sql->close();
			$a_response = [0, "This address already exists."];
			echo json_encode($a_response);
			exit;
		}
		$o_stmt->close();
		$s_query = "INSERT INTO t_contacts (c_name, c_type, c_address, c_number, c_website, c_email) VALUES (?, ?, ?, ?, ?, ?)";
		$o_stmt = $o_sql->prepare($s_query);
		$o_stmt->bind_param("ssssss", $_POST['name'], $_POST['type'], $_POST['address'], $_POST['number'], $_POST['website'], $_POST['email']);
		if ($o_stmt->execute()) {
			$a_response = [1, "Success!"];
			echo json_encode($a_response);
			exit;
		} else {
			$a_response = [0, $o_stmt->error];
			echo json_encode($a_response);
			exit;
		}
		$o_stmt->close();
		$o_sql->close();
	}
}

?>