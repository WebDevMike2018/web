<?php
session_start();
if ($_SESSION['bAccess'] != 'true') {
	exit('Authorization Required');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$iLastIndex = intval(file_get_contents('../../php/last-index.txt'));
	$iThisIndex = $iLastIndex + 1;
	require '../../php/link.php';
	if ($_POST['sForm'] === '1') {
		$sTitle = $_POST['sTitle'];
		if (empty($_POST['sContent'])) {
			if (empty($_FILES['sImage']['name'])) {
				$sMsg = "You must include content.";
				$a_response = array(0, $sMsg);
				echo json_encode($a_response);
				exit();
			} else {
				$i_file_count = count($_FILES['sImage']['name']);
				$a_abc = array('a', 'b', 'c', 'd');
				$aContent = array(2);
				for ($i = 0; $i < $i_file_count; $i++) {
					$sExt = strtolower(pathinfo($_FILES['sImage']['name'][$i], PATHINFO_EXTENSION));
					$sDir = '../media/image_post/' . $iThisIndex . $a_abc[$i] . '.' . $sExt;
					move_uploaded_file($_FILES['sImage']['tmp_name'][$i], $sDir);
					$sDir = substr($sDir, 3);
					$aContent[] = $sDir;
					if ($i == 3) {
						break;
					}
				}
				$sContent = serialize($aContent);
			}
		} else {
			$aContent = array(1, $_POST['sContent']);
			$sContent = serialize($aContent);
		}
		if (empty($_POST['sTag'])) {
			$sTag = '';
		} else {
			$sTag = substr($_POST['sTag'], 1);
			$aTag = explode('#', $sTag);
			$sTag = serialize($aTag);
			foreach ($aTag as $value) {
				$sql = "SELECT cContent FROM tags WHERE cTag = '$value'";
				$result = mysqli_query($link, $sql);
				if (mysqli_num_rows($result) > 0) {
					$row = mysqli_fetch_assoc($result);
					$sTagContent = $row['cContent'];
					$aTagContent = unserialize($sTagContent);
					$aTagContent[] = $iThisIndex;
					$sTagContent = serialize($aTagContent);
					$sql = "UPDATE tags SET cContent = '$sTagContent' WHERE cTag = '$value'";
					mysqli_query($link, $sql);
				} else {
					$aTagContent = array($iThisIndex);
					$sTagContent = serialize($aTagContent);
					$sql = "INSERT INTO tags (cTag, cContent) VALUES ('$value', '$sTagContent')";
					mysqli_query($link, $sql);
				}
			}
		}
		$a_artists = array_filter($_POST['artists'], function($value) {
			if($value != ' ') {
				return true;
			}
		});
		if (!empty($a_artists)) {
			foreach ($a_artists as $value) {
				$sql = "SELECT s_posts FROM t_artist WHERE s_name = ?";
				$stmt = mysqli_stmt_init($link);
				mysqli_stmt_prepare($stmt, $sql);
				mysqli_stmt_bind_param($stmt, "s", $value);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_bind_result($stmt, $j_posts);
				$b_result = 0;
				if (mysqli_stmt_fetch($stmt)) { $b_result = 1; }
				mysqli_stmt_close($stmt);
				if ($b_result) {
					$s_posts = json_decode($j_posts);
					$s_posts[] = $iThisIndex;
					$j_posts = json_encode($s_posts);
					$sql = "UPDATE t_artist SET s_posts = ? WHERE s_name = ?";
					$stmt = mysqli_stmt_init($link);
					mysqli_stmt_prepare($stmt, $sql);
					mysqli_stmt_bind_param($stmt, "ss", $j_posts, $value);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_close($stmt);
				}
			}
		}
		$iUpvote = 0;
		$sql = "INSERT INTO cms (cTitle, cContent, cTag, cUpvote) VALUES (?, ?, ?, ?)";
		$stmt = mysqli_stmt_init($link);
		mysqli_stmt_prepare($stmt, $sql);
		mysqli_stmt_bind_param($stmt, "sssi", $sTitle, $sContent, $sTag, $iUpvote);
		if (mysqli_stmt_execute($stmt)) {
			$iLastIndex = mysqli_insert_id($link);
			$a_comment = array();
			$j_comment = json_encode($a_comment);
			file_put_contents("../comment/{$iLastIndex}.txt", $j_comment);
			file_put_contents('../../php/last-index.txt', $iLastIndex);
			$s_msg = "Post added successfully.";
			$a_response = array(1, $s_msg);
			echo json_encode($a_response);
		} else {
			$s_msg = mysqli_stmt_error($stmt);
			$a_response = array(0, $s_msg);
			echo json_encode($a_response);
		}
	}
}
?>