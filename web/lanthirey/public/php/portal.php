<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if ($_POST["req"] == "1") {
		$sInput = htmlspecialchars($_POST['sInput']);
		$sInput = wordwrap($sInput, 70, "\r\n");
		if ($_POST["sEmail"]) {
			$sInput .= "\r\n\r\n" . htmlspecialchars($_POST["sEmail"]) . " would like to receive cryptic messages.";
		}
		$s_address = "poetlanthirey@gmail.com";
		$s_subject = "Portal";
		$a_headers = ["From" => "Lanthirey Server <creator@lanthirey.xyz>", "Reply-To" => "creator@lanthirey.xyz"];
		mail($s_address, $s_subject, $sInput, $a_headers, "-fcreator@lanthirey.xyz");
		exit;
	}
}
?>
