<?php
if ($_GET["req"] == "1") {
	$a0 = $a1 = [];
	require "../../php/link.php";
	$sQuery = "SELECT i_index, s_name FROM t_artist ORDER BY s_name";
	$oResult = $link->query($sQuery);
	while ($aRow = $oResult->fetch_array(MYSQLI_NUM)) {
		$a0[] = $aRow[0];
		$a1[] = $aRow[1];
	}
	$aResponse = [1, $a0, $a1];
	echo json_encode($aResponse);
	exit;
}

if ($_GET["req"] == "2") {
	$a0 = [];
	require "../../php/link.php";
	$sQuery = "SELECT cTag FROM tags";
	$oResult = $link->query($sQuery);
	while ($aRow = $oResult->fetch_array(MYSQLI_NUM)) {
		$a0[] = $aRow[0];
	}
	$aResponse = [1, $a0];
	echo json_encode($aResponse);
	exit;
}

?>