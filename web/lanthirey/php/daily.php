<?php

require "link.php";
$sQuery = "SELECT COUNT(cIPA) FROM visitor_counter";
$oResult = $link->query($sQuery);
$aRow = $oResult->fetch_array(MYSQLI_NUM);
$sCount = strval($aRow[0]);
file_put_contents("visitors.txt", $sCount);

?>