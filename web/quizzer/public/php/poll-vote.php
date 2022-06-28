<?php

$sCode = $_GET['code'];
$sKey = $_GET['key'];
$iKey = intval($sKey);
$sRemoteAddr = $_SERVER['REMOTE_ADDR'];

if (gettype($sCode) == "string") {
	if (strlen($sCode) == 6) {
		if (preg_match("/\W/", $sCode)) {
			$aResponse = [0, "Data rejected by server. Error Code: 11"];
			echo json_encode($aResponse);
			exit;
		} else {
			if ($s1 = file_get_contents("../../poll/{$sCode}.txt")) {
				$a1 = unserialize($s1);
				if ($iKey > 0 && $iKey < count($a1)) {
					if ($iKey1 = array_search($sRemoteAddr, $a1[0][1])) {
						$aResponse = [0, "A vote from this address has already been recorded."];
						echo json_encode($aResponse);
						exit;
					} else {
						$a1[0][1][] = $sRemoteAddr;
						$a1[0][1][] = $iKey;
						$a1[$iKey][1] += 1;
						$s1 = serialize($a1);
						file_put_contents("../../poll/{$sCode}.txt", $s1);
						$aResponse = [1, "Your vote has been recorded."];
						echo json_encode($aResponse);
						exit;
					}
				} else {
					$aResponse = [0, "Data rejected by server. Error Code: 12"];
					echo json_encode($aResponse);
					exit;
				}
			} else {
				$aResponse = [0, "Unable to process request. Please try again."];
				echo json_encode($aResponse);
				exit;
			}
		}
	} else {
		$aResponse = [0, "Data rejected by server. Error Code: 13"];
		echo json_encode($aResponse);
		exit;
	}
} else {
	$aResponse = [0, "Data rejected by server. Error Code: 14"];
	echo json_encode($aResponse);
	exit;
}

?>