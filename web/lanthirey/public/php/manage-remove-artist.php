<?php
session_start();
if ($_SESSION['bAccess'] != 'true') {
	exit('Authorization Required');
}

$b_result = 0;
$sql = "SELECT i_index, s_avatar FROM t_artist WHERE s_name = ?";
require '../../php/link.php';
$stmt = mysqli_stmt_init($link);
mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_bind_param($stmt, "s", $_POST['artist']);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $i_index, $s_avatar);
if (mysqli_stmt_fetch($stmt)) { $b_result = 1; }
mysqli_stmt_close($stmt);
mysqli_close($link);

if ($b_result == 1) {
	unlink("../{$s_avatar}");
	$sql = "DELETE FROM t_artist WHERE s_name = ?";
	require '../../php/link.php';
	$stmt = mysqli_stmt_init($link);
	mysqli_stmt_prepare($stmt, $sql);
	mysqli_stmt_bind_param($stmt, "s", $_POST['artist']);
	if (mysqli_stmt_execute($stmt)) {
		$a_response = array(1, "{$_POST['artist']} has been removed.");
		echo json_encode($a_response);
	}
	mysqli_stmt_close($stmt);
	mysqli_close($link);
} else {
	$a_response = array(0, "Artist not found.");
	echo json_encode($a_response);
}
?>