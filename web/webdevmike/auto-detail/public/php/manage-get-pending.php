<?php

require '../../php/link.php';
if (!$link) {
	$a_response = array(0, "Unable to process your request at this time. Please try again in a moment.");
	echo json_encode($a_response);
	error_log("php/manage-get-pending:7 ( " . mysqli_connect_error() . " )");
	exit;
}

$i_offset = intval($_GET['offset']);
$a_results = array();

$sql = "SELECT * FROM t_order WHERE s_date >= CURRENT_DATE() AND i_status = 1 LIMIT 10 OFFSET ?";
$stmt = mysqli_stmt_init($link);
mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_bind_param($stmt, "i", $i_offset);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11, $col12, $col13, $col14);
while (mysqli_stmt_fetch($stmt)) {
	$a_results[] = array($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11, $col12, $col13, $col14);
}
mysqli_stmt_close($stmt);
mysqli_close($link);

$a_response = array(1, $a_results);
echo json_encode($a_response);

?>