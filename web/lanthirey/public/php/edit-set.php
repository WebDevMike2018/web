<?php
session_start();
if ($_SESSION['bAccess'] != 'true') {
	exit('Authorization Required');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$a_content = array(1, $_POST['s_content']);
	$s_content = serialize($a_content);
	$sql = "UPDATE cms SET cContent = ? WHERE cIndex = ?";
	require '../../php/link.php';
	$stmt = mysqli_stmt_init($link);
	mysqli_stmt_prepare($stmt, $sql);
	mysqli_stmt_bind_param($stmt, "si", $s_content, $_POST['i_index']);
	if (mysqli_stmt_execute($stmt)) {
		$a_response = array(1, "Edit successful.");
		echo json_encode($a_response);
	}
	mysqli_stmt_close($stmt);
	mysqli_close($link);
}
?>