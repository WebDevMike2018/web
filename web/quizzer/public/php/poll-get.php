<?php

$sCode = $_GET["code"];
$sRemoteAddr = $_SERVER['REMOTE_ADDR'];

if (strlen($sCode) == 6) {
	if (preg_match("/\W/", $sCode)) {
		$aResponse = [0, "Data rejected by server. Error Code: ??"];
		echo json_encode($aResponse);
		exit;
	} else {
		if ($s1 = file_get_contents("../../poll/{$sCode}.txt")) {
			$a1 = unserialize($s1);
			$a2 = [];
			$a2[] = $a1[0][0];
			for ($i = 1; $i < count($a1); $i++) {
				$a2[] = $a1[$i];
			}
			if (($iKey1 = array_search($sRemoteAddr, $a1[0][1])) !== false) {
				$aResponse = [2, $a1[0][1][$iKey1 + 1], $a2];
				echo json_encode($aResponse);
				exit;
			} else {
				$aResponse = [1, $a2];
				echo json_encode($aResponse);
				exit;
			}
		} else {
			$aResponse = [0, "Unable to process request."];
			echo json_encode($aResponse);
		}
	}
} else {
	$aResponse = [0, "Data rejected by server. Error Code: ??"];
	echo json_encode($aResponse);
	exit;
}

?>