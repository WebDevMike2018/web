<?php

$a = ["css/", "js/", "php/"];

foreach ($a as $v) {
	if ($handle = opendir($v)) {
		while (false !== ($entry = readdir($handle))) {
			if ($entry == "." || $entry == "..") { 
				continue;
			}
				$sCurrentFile = file_get_contents($v . $entry);
				$sCurrentFile = str_replace("/web/quizzer/public/", "/", $sCurrentFile);
				file_put_contents($v . $entry, $sCurrentFile);
				echo $entry . "\n";
		}
	}
}
?>