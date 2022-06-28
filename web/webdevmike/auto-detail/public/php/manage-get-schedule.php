<?php

$a_date = array();
$a_time = array();
$sql = "SELECT * FROM t_schedule ORDER BY s_date";
require '../../php/link.php';
$stmt = mysqli_stmt_init($link);
mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $s_date, $s_time);
while (mysqli_stmt_fetch($stmt)) {
	$a_date[] = $s_date;
	$a_time[] = $s_time;
}
mysqli_stmt_close($stmt);
mysqli_close($link);
if (count($a_date) > 0) {
	$a_response = array($a_date, $a_time);
	echo json_encode($a_response);
}

?>