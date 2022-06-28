<?php
session_start();
if ($_SESSION['bAccess'] != 'true') {
	exit('Authorization Required');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require '../../php/link.php';
	$sIndex = $_POST['sIndex'];
	$sql = "SELECT * FROM cms WHERE cIndex = '$sIndex'";
	$result = mysqli_query($link, $sql);
	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);
		$sContent = $row['cContent'];
		$aContent = unserialize($sContent);
		if ($aContent[0] === 2) {
			$i_count = count($aContent);
			for ($i = 1; $i < $i_count; $i++) {
				unlink("../{$aContent[$i]}");
			}
		}
		if ($row['cTag'] !== '') {
			$aTag = unserialize($row['cTag']);
			foreach ($aTag as $value) {
				$sql = "SELECT cContent FROM tags WHERE cTag = '$value'";
				$result1 = mysqli_query($link, $sql);
				if (mysqli_num_rows($result1) > 0) {
					$row1 = mysqli_fetch_assoc($result1);
					$aContent = unserialize($row1['cContent']);
					if (count($aContent) > 1) {
						$iIndex = array_search(intval($sIndex), $aContent);
						unset($aContent[$iIndex]);
						$aContent = array_values($aContent);
						$sContent = serialize($aContent);
						$sql = "UPDATE tags SET cContent = '$sContent' WHERE cTag = '$value'";
						mysqli_query($link, $sql);
					} else {
						$sql = "DELETE FROM tags WHERE cTag = '$value'";
						mysqli_query($link, $sql);
					}
				}
			}
		}
		$sql = "DELETE FROM cms WHERE cIndex = '$sIndex'";
		mysqli_query($link, $sql);
		unlink("../comment/{$sIndex}.txt");
		$a_response = array(1, "Post deleted successfully.");
		echo json_encode($a_response);
	}
}
?>