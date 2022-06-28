<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	if ($_GET['req'] == "1") {
		$a_results = [];
		$i_page = intval($_GET['page']);
		$i_offset = $i_page * 100 - 100;
		require "../../db-premiumbusiness.php";
		$s_query = "SELECT * FROM t_contacts LIMIT ?, 100";
		$o_stmt = $o_sql->prepare($s_query);
		$o_stmt->bind_param("i", $i_offset);
		$o_stmt->execute();
		$o_stmt->bind_result($c1, $c2, $c3, $c4, $c5, $c6, $c7);
		while ($o_stmt->fetch()) {
			$a_results[] = [$c2, $c3, $c4, $c5, $c6, $c7];
		}
		$o_stmt->close();
		$o_sql->close();
		$a_response = [1, $a_results];
		echo json_encode($a_response);
		exit;
	}
	if ($_GET['req'] == "2") {
		$a_results = [];
		$i_page = intval($_GET['page']);
		$i_offset = $i_page * 100 - 100;
		require "../../db-premiumbusiness.php";
		$s_query = "SELECT * FROM t_contacts LIMIT ?, 100";
		$o_stmt = $o_sql->prepare($s_query);
		$o_stmt->bind_param("i", $i_offset);
		$o_stmt->execute();
		$o_stmt->bind_result($c1, $c2, $c3, $c4, $c5, $c6, $c7);
		while ($o_stmt->fetch()) {
			$a_results[] = [$c1, $c2, $c3, $c4, $c5, $c6, $c7];
		}
		$o_stmt->close();
		$o_sql->close();
		$a_response = [1, $a_results];
		echo json_encode($a_response);
		exit;
	}
	if ($_GET['req'] == "3") {
		require "../../db-premiumbusiness.php";
		$s_query = "SELECT COUNT(*) FROM t_contacts";
		$o_result = $o_sql->query($s_query);
		$a_row = $o_result->fetch_array(MYSQLI_NUM);
		$a_response = [1, $a_row[0]];
		echo json_encode($a_response);
		exit;
	}
	if ($_GET['req'] == "4") {
		require "../../db-premiumbusiness.php";
		$s_query = "INSERT INTO t_contacts (c_name, c_type, c_address, c_number, c_website, c_email) VALUES (?, ?, ?, ?, ?, ?)";
		$o_stmt = $o_sql->prepare($s_query);
		$o_stmt->bind_param("ssssss", $s_name, $s_type, $s_address, $s_number, $s_website, $s_email);
		for ($i = 0; $i < 500; $i++) {
			$s_name = "Name {$i}";
			$s_type = "Type {$i}";
			$s_address = "Address {$i}";
			$s_number = "Number {$i}";
			$s_website = "Website {$i}";
			$s_email = "Email {$i}";
			$o_stmt->execute();
		}
	}
}

?>