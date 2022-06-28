<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	if (preg_match("/[^A-Za-z0-9\-\.]/", $_GET['q']) === 1) {
		exit;
	}
	$str = "%{$_GET['q']}%";
	$str1 = "";
	require '../../php/link.php';
	$sql = "SELECT * FROM t_ships WHERE name LIKE ?";
	$stmt = mysqli_stmt_init($link);
	mysqli_stmt_prepare($stmt, $sql);
	mysqli_stmt_bind_param($stmt, 's', $str);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $i_id, $s_type, $s_nation, $i_tier, $s_name);
	while(mysqli_stmt_fetch($stmt)) {
		$str1 .= "<a class='search6' href='build.php?nation={$s_nation}&type={$s_type}&tier={$i_tier}&name={$s_name}'>{$s_name}</a>";
	}
	mysqli_stmt_close($stmt);
	mysqli_close($link);
	$a_response = array(1, $str1);
	echo json_encode($a_response);
}
?>