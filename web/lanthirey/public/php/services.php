<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if ($_POST["req"] == "1") {
		foreach ($_POST as $v) {
			if (gettype($v) != "string") {
				$aResponse = [0, "Unable to process request. Error: 11"];
				echo json_encode($aResponse);
				exit;
			}
			if (strlen($v) > 2000) {
				$aResponse = [0, "Unable to process request. Error: 12"];
				echo json_encode($aResponse);
				exit;
			}
		}
		$sName = htmlspecialchars($_POST["sName"]);
		$sEmail = (isset($_POST["bEmail"])) ? htmlspecialchars($_POST["sEmail"]) : "";
		$sTwitter = (isset($_POST["bTwitter"])) ? htmlspecialchars($_POST["sTwitter"]) : "";
		$sInstagram = (isset($_POST["bInstagram"])) ? htmlspecialchars($_POST["sInstagram"]) : "";
		$sMuseum = (isset($_POST["bMuseum"])) ? "yes" : "no";
		$sCollaborate = (isset($_POST["bCollab"])) ? "yes" : "no";
		$sComment = (isset($_POST["bComment"])) ? htmlspecialchars($_POST["sComment"]) : "";
		$s_message = "
		<html>
		<head>
		<style>
		.m16 {
			margin-top: 16px;
		}
		</style>
		</head>
		<body>
			<div class='m16'>Name: {$sName}</div>
			<div class='m16'>Email: {$sEmail}</div>
			<div class='m16'>Twitter: {$sTwitter}</div>
			<div class='m16'>Instagram: {$sInstagram}</div>
			<div class='m16'>Museum: {$sMuseum}</div>
			<div class='m16'>Collaborate: {$sCollaborate}</div>
			<div class='m16'>questions, comments, or concerns:</div>
			<div>{$sComment}</div>
		</body>
		</html>
		";
		$s_to = "poetlanthirey@gmail.com";
		$s_subject = "Services";
		$a_headers = [
			"MIME-Version" => "1.0",
			"Content-type" => "text/html; charset=iso-8859-1",
			"To" => "Nurani <{$s_to}>",
			"From" => "Lanthirey Server <creator@lanthirey.xyz>",
			"Reply-To" => "creator@lanthirey.xyz"
		];
		mail($s_to, $s_subject, $s_message, $a_headers, "-fcreator@lanthirey.xyz");
		$a_response = [1, "Success"];
		echo json_encode($a_response);
		exit;
	}
}

?>