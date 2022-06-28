<?php

if ($_GET["req"] == "link") {
	require "../../php/link.php";
	$sQuery = "SELECT i_index FROM t_artist ORDER BY i_index DESC LIMIT 2";
	$oResult = $link->query($sQuery);
	$a1 = [];
	while ($aRow = $oResult->fetch_assoc()) {
		$a1[] = $aRow["i_index"];
	}
	if (count($a1) == 0) {
		$aResponse = [0, "No artists found."];
		echo json_encode($aResponse);
		exit;
	}
	if (count($a1) == 1) {
		$a1[] = $a1[0];
	}
	$aResponse = [1, $a1];
	echo json_encode($aResponse);
}

?>