<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	$iOffset = (intval($_GET['page']) * 8) - 8;
	$sql = "SELECT cContent FROM tags WHERE cTag = ?";
	require '../../php/link.php';
	$stmt = mysqli_stmt_init($link);
	mysqli_stmt_prepare($stmt, $sql);
	mysqli_stmt_bind_param($stmt, 's', $_GET['tag']);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $cContent);
	mysqli_stmt_fetch($stmt);
	$aContent = unserialize($cContent);
	mysqli_stmt_close($stmt);
	$iContent = count($aContent);
	$sContent = implode(', ', $aContent);
	$sql = "SELECT * FROM cms WHERE cIndex IN ($sContent) ORDER BY cIndex DESC LIMIT 8 OFFSET $iOffset";
	if ($result = mysqli_query($link, $sql)) {
		$sResponse = '';
		while ($row = mysqli_fetch_assoc($result)) {
			$sResponse .= "<div class='cl2'>" . $row['cTitle'] . "</div>";
			$aContent = unserialize($row['cContent']);
			if ($aContent[0] === 1) {
				$sResponse .= "<div class='cl3'>" . $aContent[1] . "</div>";
			} else {
				$i_a_content = count($aContent);
				if ($i_a_content == 2) {
					$sResponse .= "<div class='cl3'><img class='cl5' src='" . $aContent[1] . "'></div>";
				} elseif ($i_a_content == 3) {
					$sResponse .= "<div class='cl3'><div class='cl14'><div><img class='cl5' src='" . $aContent[1] . "'></div><div><img class='cl5' src='" . $aContent[2] . "'></div></div></div>";
				} elseif ($i_a_content == 4) {
					$sResponse .= "<div class='cl3'><div class='cl14'><div><img class='cl5' src='" . $aContent[1] . "'></div><div><img class='cl5' src='" . $aContent[2] . "'></div></div><img class='cl5' src='" . $aContent[3] . "' style='margin-top:8px;'></div>";
				} else {
					$sResponse .= "<div class='cl3'><div class='cl14'><div><img class='cl5' src='" . $aContent[1] . "'></div><div><img class='cl5' src='" . $aContent[2] . "'></div><div><img class='cl5' src='" . $aContent[3] . "' style='margin-top:8px;'></div><div><img class='cl5' src='" . $aContent[4] . "' style='margin-top:8px;'></div></div></div>";
				}
			}
			$sResponse .= "<div class='cl3 cl7'><div class='cl6'><span><a href='permalink.php?index=" . $row['cIndex'] . "'><img class='cl8' src='media/image/permalink.png'></a></span></div><div class='cl11'>";
			if ($row['cTag'] != '') {
				$aTag = unserialize($row['cTag']);
				foreach ($aTag as $value) {
					$sResponse .= "<a class='cl4' href='tag.php?tag=" . $value . "&page=1'>#" . $value . "</a> ";
				}
			}
			$sResponse .= "</div><div class='cl6'><span class='cl13' data-index='{$row['cIndex']}'><img class='cl12' src='media/image/heart.png'></span><span>{$row['cUpvote']}</span></div></div>";
		}
	}
	$iPages = ceil($iContent / 8);
	$aResponse = array($iPages, $sResponse);
	echo json_encode($aResponse);
}
?>