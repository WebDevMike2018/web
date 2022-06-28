<?php

require "../../db.php";
$a1 = json_decode($_POST["j1"]);
$a2 = [];

function fCodeGenerator() {
	global $oSQL;
	$aAlphaNumeric = ["2", "3", "4", "5", "6", "7", "8", "9", "A", "B", "C", "D", "E", "F", "G", "H", "J", "K", "L", "M", "N", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"];
	$b1 = true;
	while($b1) {
		$a1 = [];
		for ($i = 0; $i < 6; $i++) {
			$i1 = rand(0, count($aAlphaNumeric) - 1);
			$a1[] = $aAlphaNumeric[$i1];
		}
		$s1 = implode($a1);
		$oResult = $oSQL->query("SELECT cIndex FROM t_poll WHERE cCode = '$s1'");
		if ($oResult->num_rows == 0) {
			$b1 = false;
		}
	}
	return $s1;
}

// verify data is array
if (gettype($a1) != "array") {
	$aResponse = [0, "Data rejected by server. Error Code: 11"];
	echo json_encode($aResponse);
	exit;
}

// verify array values are a html safe string & add to new array
foreach ($a1 as $v1) {
	if (gettype($v1) != "string") {
		$aResponse = [0, "Data rejected by server. Error Code: 12"];
		echo json_encode($aResponse);
		exit;
	} else {
		$a2[] = [htmlspecialchars($v1), 0];
		$a2[0][1] = [];
	}
}

$sCode = fCodeGenerator();

if (!$oSQL->query("INSERT INTO t_poll (cCode) VALUES ('{$sCode}')")) {
	$aResponse = [0, "Server error. Error Code: 13"];
	echo json_encode($aResponse);
	exit;
}

$s1 = serialize($a2);
if (!file_put_contents("../../poll/{$sCode}.txt", $s1)) {
	$aResponse = [0, "Server error. Error Code: 14"];
	echo json_encode($aResponse);
	exit;
}

$aResponse = [1, $sCode];
echo json_encode($aResponse);

?>