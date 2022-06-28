<?php

require '../../php/link.php';
if (!$link) {
	$a_response = array(0, "Unable to process your request at this time. Please try again in a moment.");
	echo json_encode($a_response);
	error_log("php/manage-get-pending:7 ( " . mysqli_connect_error() . " )");
	exit;
}

$i_order = intval($_GET['order']);
$i_time = intval($_GET['time']);

$sql = "SELECT s_time FROM t_schedule WHERE s_date = ?";
$stmt = mysqli_stmt_init($link);
mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_bind_param($stmt, "s", $_GET['date']);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $c1);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

$a_schedule = json_decode($c1);
$a_schedule[$i_time]->reserved = 0;
$j_schedule = json_encode($a_schedule);

$sql = "UPDATE t_schedule SET s_time = ? WHERE s_date = ?";
$stmt = mysqli_stmt_init($link);
mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_bind_param($stmt, "ss", $j_schedule, $_GET['date']);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

$sql = "UPDATE t_order SET i_status = 2 WHERE i_index = ?";
$stmt = mysqli_stmt_init($link);
mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_bind_param($stmt, "i", $i_order);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
mysqli_close($link);

$a_response = [1, "Order {$i_order} has been cancelled."];
echo json_encode($a_response);

?>