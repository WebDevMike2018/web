<?php

date_default_timezone_set("Asia/Manila");
$a_time = array(
	array('time'=>0, 'scheduled'=>0, 'reserved'=>0),
	array('time'=>1, 'scheduled'=>0, 'reserved'=>0),
	array('time'=>2, 'scheduled'=>0, 'reserved'=>0),
	array('time'=>3, 'scheduled'=>0, 'reserved'=>0),
	array('time'=>4, 'scheduled'=>0, 'reserved'=>0),
	array('time'=>5, 'scheduled'=>0, 'reserved'=>0),
	array('time'=>6, 'scheduled'=>0, 'reserved'=>0),
	array('time'=>7, 'scheduled'=>0, 'reserved'=>0),
	array('time'=>8, 'scheduled'=>0, 'reserved'=>0),
	array('time'=>9, 'scheduled'=>0, 'reserved'=>0),
	array('time'=>10, 'scheduled'=>0, 'reserved'=>0),
	array('time'=>11, 'scheduled'=>0, 'reserved'=>0),
	array('time'=>12, 'scheduled'=>0, 'reserved'=>0),
	array('time'=>13, 'scheduled'=>0, 'reserved'=>0),
	array('time'=>14, 'scheduled'=>0, 'reserved'=>0),
	array('time'=>15, 'scheduled'=>0, 'reserved'=>0),
	array('time'=>16, 'scheduled'=>0, 'reserved'=>0),
	array('time'=>17, 'scheduled'=>0, 'reserved'=>0),
	array('time'=>18, 'scheduled'=>0, 'reserved'=>0),
	array('time'=>19, 'scheduled'=>0, 'reserved'=>0),
	array('time'=>20, 'scheduled'=>0, 'reserved'=>0),
	array('time'=>21, 'scheduled'=>0, 'reserved'=>0),
	array('time'=>22, 'scheduled'=>0, 'reserved'=>0),
	array('time'=>23, 'scheduled'=>0, 'reserved'=>0),
	array('time'=>24, 'scheduled'=>0, 'reserved'=>0),
	array('time'=>25, 'scheduled'=>0, 'reserved'=>0)
);
/*
$a_time = array(
	array('time'=>'6,0', 'scheduled'=>0, 'reserved'=>0),
	array('time'=>'6,30', 'scheduled'=>0, 'reserved'=>0),
	array('time'=>'7,0', 'scheduled'=>0, 'reserved'=>0),
	array('time'=>'7,30', 'scheduled'=>0, 'reserved'=>0),
	array('time'=>'8,0', 'scheduled'=>0, 'reserved'=>0),
	array('time'=>'8,30', 'scheduled'=>0, 'reserved'=>0),
	array('time'=>'9,0', 'scheduled'=>0, 'reserved'=>0),
	array('time'=>'9,30', 'scheduled'=>0, 'reserved'=>0),
	array('time'=>'10,0', 'scheduled'=>0, 'reserved'=>0),
	array('time'=>'10,30', 'scheduled'=>0, 'reserved'=>0),
	array('time'=>'11,0', 'scheduled'=>0, 'reserved'=>0),
	array('time'=>'11,30', 'scheduled'=>0, 'reserved'=>0),
	array('time'=>'12,0', 'scheduled'=>0, 'reserved'=>0),
	array('time'=>'12,30', 'scheduled'=>0, 'reserved'=>0),
	array('time'=>'13,0', 'scheduled'=>0, 'reserved'=>0),
	array('time'=>'13,30', 'scheduled'=>0, 'reserved'=>0),
	array('time'=>'14,0', 'scheduled'=>0, 'reserved'=>0),
	array('time'=>'14,30', 'scheduled'=>0, 'reserved'=>0),
	array('time'=>'15,0', 'scheduled'=>0, 'reserved'=>0),
	array('time'=>'15,30', 'scheduled'=>0, 'reserved'=>0),
	array('time'=>'16,0', 'scheduled'=>0, 'reserved'=>0),
	array('time'=>'16,30', 'scheduled'=>0, 'reserved'=>0),
	array('time'=>'17,0', 'scheduled'=>0, 'reserved'=>0),
	array('time'=>'17,30', 'scheduled'=>0, 'reserved'=>0),
	array('time'=>'18,0', 'scheduled'=>0, 'reserved'=>0),
	array('time'=>'18,30', 'scheduled'=>0, 'reserved'=>0)
);
*/
// Add day to table.
$i_days = 30;
$o_date = date_create();
date_add($o_date, date_interval_create_from_date_string("$i_days days"));
$s_date = date_format($o_date, "Y-m-d");
$s_day = date_format($o_date, "w");
$i_day = intval($s_day);
$s_schedule = file_get_contents("schedule.txt");
$a_schedule = unserialize($s_schedule);
if (count($a_schedule[$i_day]) > 0) {
	$j_schedule = json_encode($a_schedule[$i_day]);
} else {
	$j_schedule = json_encode($a_time);
}
$sql = "INSERT INTO t_schedule (s_date, s_time) VALUES (?, ?)";
require 'link.php';
$stmt = mysqli_stmt_init($link);
mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_bind_param($stmt, "ss", $s_date, $j_schedule);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
mysqli_close($link);

// Delete today from table.
$o_date = date_create();
$s_date = date_format($o_date, "Y-m-d");
$sql = "DELETE FROM t_schedule WHERE s_date = ?";
require 'link.php';
$stmt = mysqli_stmt_init($link);
mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_bind_param($stmt, "s", $s_date);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
mysqli_close($link);
/*
$s_address = "gmichael2000@hotmail.com";
$s_subject = "schedule-daily";
$s_input = "executed";
mail($s_address, $s_subject, $s_input);
*/
?>