<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (strlen($_POST['s_comment']) < 501 and strlen($_POST['s_name']) < 26) {
		$s_IPA = $_SERVER['REMOTE_ADDR'];
		$s_comment = htmlspecialchars($_POST['s_comment']);
		$s_name = htmlspecialchars($_POST['s_name']);
		$s_comment = str_replace(PHP_EOL, '<br>', $s_comment);
		require '../../php/link.php';
		$sql = "SELECT * FROM t_comment_approval WHERE v_post_index = ? AND v_IPA = ?";
		$stmt = mysqli_stmt_init($link);
		mysqli_stmt_prepare($stmt, $sql);
		mysqli_stmt_bind_param($stmt, "ss", $_POST['i_index'], $s_IPA);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_store_result($stmt);
		if (mysqli_stmt_num_rows($stmt) == 0) {
			mysqli_stmt_close($stmt);
			$sql = "INSERT INTO t_comment_approval (v_post_index, v_name, t_comment, v_IPA) VALUES (?, ?, ?, ?)";
			$stmt = mysqli_stmt_init($link);
			mysqli_stmt_prepare($stmt, $sql);
			mysqli_stmt_bind_param($stmt, "ssss", $_POST['i_index'], $s_name, $s_comment, $s_IPA);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
			mysqli_close($link);
			$a_response = array(1, "Your comment is awaiting approval.");
			echo json_encode($a_response);
		} else {
			$a_response = array(0, "You already have a comment awaiting approval.");
			echo json_encode($a_response);
		}
	}
}
?>