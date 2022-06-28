<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	$a_config = array();
	$a_votes = array();
	$sql = "SELECT s_config, i_votes FROM t_submission WHERE s_name = ? ORDER BY i_votes DESC LIMIT 10";
	require '../../php/link.php';
	$stmt = mysqli_stmt_init($link);
	mysqli_stmt_prepare($stmt, $sql);
	mysqli_stmt_bind_param($stmt, "s", $_GET['name']);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $s_config, $i_votes);
	while (mysqli_stmt_fetch($stmt)) {
		$a_config[] = $s_config;
		$a_votes[] = $i_votes;
	}
	mysqli_stmt_close($stmt);
	mysqli_close($link);
	if (count($a_votes) > 0) {
		$a_response = array($a_config, $a_votes);
		echo json_encode($a_response);
	}
	exit;
}
?>