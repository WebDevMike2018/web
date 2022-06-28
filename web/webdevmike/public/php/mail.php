<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$sEmail = 'webdevmike2018@gmail.com';
	$sHeader = "From: " . $_POST['firstName'];
	mail($sEmail, $_POST['subject'], $_POST['message'], $sHeader);
	echo 'true';
}
?>