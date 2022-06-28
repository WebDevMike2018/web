<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	$i_offset = (intval($_GET['page']) * 8) - 8;
	$s_posts = $_GET['posts'];
	echo $s_posts;
	$sql = "SELECT * FROM cms WHERE cIndex IN ($s_posts) ORDER BY cIndex DESC LIMIT 8 OFFSET $i_offset";
	require '../../php/link.php';
	if ($result = mysqli_query($link, $sql)) {
		$sResponse = '';
		while ($row = mysqli_fetch_assoc($result)) {
			$sResponse .= "<div class='cl12'>" . $row['cTitle'] . "</div>";
			$aContent = unserialize($row['cContent']);
			if ($aContent[0] === 1) {
				$sResponse .= "<div class='cl13'>" . $aContent[1] . "</div>";
			} else {
				$i_a_content = count($aContent);
				if ($i_a_content == 2) {
					$sResponse .= "<div class='cl13'><img class='cl15' src='" . $aContent[1] . "'></div>";
				} elseif ($i_a_content == 3) {
					$sResponse .= "<div class='cl13'><div class='cl24'><div><img class='cl15' src='" . $aContent[1] . "'></div><div><img class='cl15' src='" . $aContent[2] . "'></div></div></div>";
				} elseif ($i_a_content == 4) {
					$sResponse .= "<div class='cl13'><div class='cl24'><div><img class='cl15' src='" . $aContent[1] . "'></div><div><img class='cl15' src='" . $aContent[2] . "'></div></div><img class='cl15' src='" . $aContent[3] . "' style='margin-top:8px;'></div>";
				} else {
					$sResponse .= "<div class='cl13'><div class='cl24'><div><img class='cl15' src='" . $aContent[1] . "'></div><div><img class='cl15' src='" . $aContent[2] . "'></div><div><img class='cl15' src='" . $aContent[3] . "' style='margin-top:8px;'></div><div><img class='cl15' src='" . $aContent[4] . "' style='margin-top:8px;'></div></div></div>";
				}
			}
			$sResponse .= "<div class='cl13 cl17'><div class='cl16'><span><a href='permalink.php?index=" . $row['cIndex'] . "'><img class='cl18' src='media/image/permalink.png'></a></span></div><div class='cl21'>";
			if ($row['cTag'] != '') {
				$aTag = unserialize($row['cTag']);
				foreach ($aTag as $value) {
					$sResponse .= "<a class='cl14' href='tag.php?tag=" . $value . "&page=1'>#" . $value . "</a> ";
				}
			}
			$sResponse .= "</div><div class='cl16'><span class='cl23' data-index='{$row['cIndex']}'><img class='cl22' src='media/image/heart.png'></span><span>{$row['cUpvote']}</span></div></div>";
		}
		echo $sResponse;
	}
}
?>