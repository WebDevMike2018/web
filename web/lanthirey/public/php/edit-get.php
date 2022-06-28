<?php
session_start();
if ($_SESSION['bAccess'] != 'true') {
	exit('Authorization Required');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$sql = "SELECT cContent FROM cms WHERE cIndex = ?";
	require '../../php/link.php';
	$stmt = mysqli_stmt_init($link);
	mysqli_stmt_prepare($stmt, $sql);
	mysqli_stmt_bind_param($stmt, "i", $_POST['i_index']);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $s_content);
	if (mysqli_stmt_fetch($stmt)) {
		$a_content = unserialize($s_content);
		echo $a_content[1];
	}
	mysqli_stmt_close($stmt);
	mysqli_close($link);
}
?>