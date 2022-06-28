<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	if ($_GET['req'] == 1) {
		$a_playing = [];
		$a_played = [];
		require '../../db-alodiamarie.php';
		$s_query = "SELECT c_title FROM t_games_playing ORDER BY c_title";
		$o_result = $o_sql->query($s_query);
		while ($a_row = $o_result->fetch_row()) {
			$a_playing[] = $a_row[0];
		}
		$s_query = "SELECT c_title FROM t_games_played ORDER BY c_title";
		$o_result = $o_sql->query($s_query);
		while ($a_row = $o_result->fetch_row()) {
			$a_played[] = $a_row[0];
		}
		$o_sql->close();
		$a_response = [1, $a_playing, $a_played];
		echo json_encode($a_response);
		exit;
	}
}

?>