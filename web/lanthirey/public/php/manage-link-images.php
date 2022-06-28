<?php
	$a_scan = scandir("../media/image/link");
	$a_scan = array_filter($a_scan, function($value) {
		if($value == '.' OR $value == '..') {
			return false;
		} else {
			return true;
		}
	});
	$a_scan = array_values($a_scan);
	echo json_encode($a_scan);
?>