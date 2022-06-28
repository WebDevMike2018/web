<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require "../../php/PHPMailer/src/PHPMailer.php";
require "../../php/PHPMailer/src/Exception.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require '../../php/link.php';
	if (mysqli_connect_error()) {
		$a_response = array(0, "Unable to process your request at this time. Please try again in a moment.");
		echo json_encode($a_response);
		error_log(mysqli_connect_error());
		exit;
	}
	foreach ($_POST as $k => $v) {
		if (strlen($v) > 200) {
			$a_response = array(0, "$k exceeds maximum allowed length.");
			echo json_encode($a_response);
			error_log("php/index-submit.php:15 ( $k too long )");
			exit;
		}
	}
	unset($k, $v);
	$s_service = htmlspecialchars($_POST['service']);
	$s_date = htmlspecialchars($_POST['date']);
	$s_time = htmlspecialchars($_POST['time']);
	$s_time1 = htmlspecialchars($_POST['time1']);
	$s_make = htmlspecialchars($_POST['make']);
	$s_model = htmlspecialchars($_POST['model']);
	$s_color = htmlspecialchars($_POST['color']);
	$s_address = htmlspecialchars($_POST['address']);
	$s_fName = htmlspecialchars($_POST['fName']);
	$s_lName = htmlspecialchars($_POST['lName']);
	$s_phone = htmlspecialchars($_POST['phone']);
	$s_email = htmlspecialchars($_POST['email']);
	$i_time = intval($s_time);
	$i_status = 1;

	$sql = "SELECT s_time FROM t_schedule WHERE s_date = ?";
	$stmt = mysqli_stmt_init($link);
	mysqli_stmt_prepare($stmt, $sql);
	mysqli_stmt_bind_param($stmt, "s", $s_date);
	mysqli_stmt_execute($stmt);
	echo mysqli_stmt_error($stmt);
	mysqli_stmt_bind_result($stmt, $j_time);
	mysqli_stmt_fetch($stmt);
	mysqli_stmt_close($stmt);
	if (!$j_time) {
		$a_response = array(0, "Unable to process your request at this time. Please reload the page and try again.");
		echo json_encode($a_response);
		error_log("php/index-submit.php:37 ( s_date not found in DB )");
		exit;
	}
	$a_time = json_decode($j_time);
	if ($a_time[$i_time]->scheduled == 0 || $a_time[$i_time]->reserved == 1) {
		$a_response = array(0, "This time slot is no longer available. Please select another time.");
		echo json_encode($a_response);
		error_log("php/index-submit.php:44 ( time slot not available )");
		exit;
	}
	$a_time[$i_time]->reserved = 1;
	$j_time = json_encode($a_time);
	$sql = "UPDATE t_schedule SET s_time = ? WHERE s_date = ?";
	$stmt = mysqli_stmt_init($link);
	mysqli_stmt_prepare($stmt, $sql);
	mysqli_stmt_bind_param($stmt, "ss", $j_time, $s_date);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);

	$sql = "INSERT INTO t_order (i_status, s_service, s_date, s_time, s_time1, s_make, s_model, s_color, s_address, s_fName, s_lName, s_phone, s_email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
	$stmt = mysqli_stmt_init($link);
	mysqli_stmt_prepare($stmt, $sql);
	mysqli_stmt_bind_param($stmt, "issssssssssss", $i_status, $s_service, $s_date, $s_time, $s_time1, $s_make, $s_model, $s_color, $s_address, $s_fName, $s_lName, $s_phone, $s_email);
	mysqli_stmt_execute($stmt);
	$i_order = mysqli_insert_id($link);
	mysqli_stmt_close($stmt);
	mysqli_close($link);
	$o_dateTime = new DateTime($s_date);
	$s_dateTime = $o_dateTime->format("F j");
	$s_message = "
	<html lang'en'>
	<head>
		<style>
			* {
				box-sizing: border-box;
				margin: 0;
				padding: 0;
			}
			body {
				background-color: #d9d9d9;
				padding: 48px 0;
			}
			.c1 {
				max-width: 720px;
				margin: auto;
			}
			.c2 {
				background-color: black;
				text-align: center;
			}
			.c3 {
				padding: 16px;
				background-color: #1a1a1a;
				color: white;
				text-align: center;
				font-size: 32px;
			}
			.c4 {
				padding: 16px;
				background-color: white;
			}
			.c5 {
				padding-bottom: 16px;
			}
			.c6 {
				width: 100%;
			}
			.c6 td {
				width: 50%;
				padding: 8px;
			}
			.c6 td:first-child {
				text-align: right;
			}
		</style>
	</head>
	<body>
		<div class='c1'>
			<div class='c2'><a href='https://auto.webdevmike.com/' target='_blank'><img src='https://auto.webdevmike.com/media/image/logo.png' width='240' height='96'></a></div>
			<div class='c3'>Order Confirmation</div>
			<div class='c4'>
				<div class='c5'>Thank you for choosing White Glove. If you need to change your order, please email us <a href='mailto:support@autodetail.com'>support@autodetail.com</a> or call us <a href='tel:+18005551234'>1-800-555-1234</a></div>
				<table class='c6'>
					<tr>
						<td>Order:</td>
						<td>{$i_order}</td>
					</tr>
					<tr>
						<td>Service:</td>
						<td>Standard $199</td>
					</tr>
					<tr>
						<td>Date:</td>
						<td>{$s_dateTime}</td>
					</tr>
					<tr>
						<td>Time:</td>
						<td>10:00 AM</td>
					</tr>
				</table>
			</div>
		</div>
	</body>
	</html>
	";
	$mail = new PHPMailer(true);
	try {
		$mail->SetFrom("autodetail@webdevmike.com", "White Glove Auto Detail");
		$mail->addAddress($s_email);
		$mail->isHTML(true);
		$mail->Subject = "Order Confirmation";
		$mail->Body = $s_message;
		$mail->send();
	} catch (Exception $e) {}
	$a_response = [1, "Success!"];
	echo json_encode($a_response);
}

?>