<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	if ($_GET["req"] == "1") {
		require "../../php/link.php";
		$s_query = "SELECT cContent FROM tags WHERE cTag = 'museum'";
		$o_result = $link->query($s_query);
		if ($o_result->num_rows == 0) {
			$a_response = [2];
			echo json_encode($a_response);
			exit;
		}
		$a_image = [];
		$a_row = $o_result->fetch_row();
		$a_tags = unserialize($a_row[0]);
		$s_query = "SELECT cContent FROM cms WHERE cIndex = ?";
		$o_stmt = $link->prepare($s_query);
		$o_stmt->bind_param("i", $i_index);
		for ($i = count($a_tags) - 1; $i >= 0 && $i > count($a_tags) - 10; $i--) {
			$i_index = $a_tags[$i];
			$o_stmt->execute();
			$o_stmt->bind_result($s_content);
			$o_stmt->fetch();
			$a_content = unserialize($s_content);
			$a_image[] = [strval($i_index), $a_content[1]];
		}
		$o_stmt->close();
		$link->close();
		$a_response = [1, $a_image];
		echo json_encode($a_response);
		exit;
	}
}

?>