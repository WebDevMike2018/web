<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	require '../../php/link.php';
	$sql = "SELECT cIndex FROM cms ORDER BY RAND() LIMIT 1";
	$o_result = mysqli_query($link, $sql);
	$row = mysqli_fetch_row($o_result);
	echo 'permalink?index=' . $row[0];
	mysqli_close($link);
}
?>