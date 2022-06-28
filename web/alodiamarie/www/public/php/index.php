<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	if ($_GET['req'] == 1) {
		$a1 = [];
		require '../../db-alodiamarie.php';
		$s_query = "SELECT c_link, c_text FROM t_links ORDER BY c_text";
		$o_result = $o_sql->query($s_query);
		while ($a_row = $o_result->fetch_row()) {
			$a1[] = [$a_row[0], $a_row[1]];
		}
		$a_response = [1, $a1];
		echo json_encode($a_response);
		exit;
	}
}

?>