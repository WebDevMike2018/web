<?php
session_start();
if ($_SESSION['bAccess'] != 'true') {
	exit('Authorization Required');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if ($_POST['action'] == 1) {
		$sql = "SELECT * FROM t_comment_approval WHERE i_index = '{$_POST['index']}'";
		require '../../php/link.php';
		$o_result = mysqli_query($link, $sql);
		$row = mysqli_fetch_row($o_result);
		mysqli_close($link);
		$a_comments = json_decode(file_get_contents("../comment/{$row[1]}.txt"));
		$a_comments[] = array($row[2], $row[3]);
		file_put_contents("../comment/{$row[1]}.txt", json_encode($a_comments));
		$sql = "DELETE FROM t_comment_approval WHERE i_index = {$row[0]}";
		require '../../php/link.php';
		mysqli_query($link, $sql);
		echo "true";
	} elseif ($_POST['action'] == 2) {
		$sql = "DELETE FROM t_comment_approval WHERE i_index = '{$_POST['index']}'";
		require '../../php/link.php';
		mysqli_query($link, $sql);
		mysqli_close($link);
		echo "true";
	} else {
		$sql = "DELETE FROM t_comment_approval WHERE v_IPA = '{$_POST['ipa']}'";
		require '../../php/link.php';
		mysqli_query($link, $sql);
		mysqli_close($link);
		echo "true";
	}
}
?>