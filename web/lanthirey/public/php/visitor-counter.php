<?php

require '../../php/link.php';
$sIPA = $_SERVER['REMOTE_ADDR'];
$sQuery = "SELECT cIPA FROM visitor_counter WHERE cIPA = ?";
$oStmt = $link->prepare($sQuery);
$oStmt->bind_param("s", $sIPA);
$oStmt->execute();
$oStmt->store_result();
if ($oStmt->num_rows == 0) {
	$sQuery1 = "INSERT INTO visitor_counter (cIPA) VALUES (?)";
	$oStmt1 = $link->prepare($sQuery1);
	$oStmt1->bind_param("s", $sIPA);
	$oStmt1->execute();
	$oStmt1->close();
}
$oStmt->close();
$link->close();

$sVisitorCount = file_get_contents("../../php/visitors.txt");
$aResponse = [1, $sVisitorCount];
echo json_encode($aResponse);
exit;

?>