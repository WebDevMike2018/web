<?php

if (!$_POST["sEmail"]) {
	$aResponse = [0, "Unable to process request. Error: 11"];
	echo json_encode($aResponse);
	exit;
}
if (gettype($_POST["sEmail"]) != "string") {
	$aResponse = [0, "Unable to process request. Error: 12"];
	echo json_encode($aResponse);
	exit;
}
$sAddress = "poetlanthirey@gmail.com";
$sSubject = "Footer Subscription";
$sMessage = "{$_POST['sEmail']} has subscribed";
mail($sAddress, $sSubject, $sMessage);
$aResponse = [1, "Request processed."];
echo json_encode($aResponse);

?>