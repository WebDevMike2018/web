<?php

date_default_timezone_set("Asia/Manila");
$a_time = [
	["time" => "12:00 AM", "available" => 0, "reserved" => 0],
	["time" => "1:00 AM", "available" => 0, "reserved" => 0],
	["time" => "2:00 AM", "available" => 0, "reserved" => 0],
	["time" => "3:00 AM", "available" => 0, "reserved" => 0],
	["time" => "4:00 AM", "available" => 0, "reserved" => 0],
	["time" => "5:00 AM", "available" => 0, "reserved" => 0],
	["time" => "6:00 AM", "available" => 0, "reserved" => 0],
	["time" => "7:00 AM", "available" => 0, "reserved" => 0],
	["time" => "8:00 AM", "available" => 0, "reserved" => 0],
	["time" => "9:00 AM", "available" => 1, "reserved" => 0],
	["time" => "10:00 AM", "available" => 0, "reserved" => 0],
	["time" => "11:00 AM", "available" => 1, "reserved" => 0],
	["time" => "12:00 PM", "available" => 0, "reserved" => 0],
	["time" => "1:00 PM", "available" => 1, "reserved" => 0],
	["time" => "2:00 PM", "available" => 0, "reserved" => 0],
	["time" => "3:00 PM", "available" => 0, "reserved" => 0],
	["time" => "4:00 PM", "available" => 0, "reserved" => 0],
	["time" => "5:00 PM", "available" => 0, "reserved" => 0],
	["time" => "6:00 PM", "available" => 0, "reserved" => 0],
	["time" => "7:00 PM", "available" => 0, "reserved" => 0],
	["time" => "8:00 PM", "available" => 0, "reserved" => 0],
	["time" => "9:00 PM", "available" => 0, "reserved" => 0],
	["time" => "10:00 PM", "available" => 0, "reserved" => 0],
	["time" => "11:00 PM", "available" => 0, "reserved" => 0]
];
for ($i = 0; $i < 30; $i++) {
	$o_date = new DateTime();
	$o_date->add(new DateInterval("P{$i}D"));
	$a_schedule[] = [$o_date->format("Y-n-j"), $a_time];
}
echo json_encode($a_schedule);

?>