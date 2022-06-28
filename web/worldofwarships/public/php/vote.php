<?php
function f_vote($n, $s_query1) {
	$sql = "UPDATE t_submission SET i_votes = i_votes + $n WHERE s_config = ?";
	require '../../php/link.php';
	$stmt = mysqli_stmt_init($link);
	mysqli_stmt_prepare($stmt, $sql);
	echo mysqli_stmt_error($stmt);
	mysqli_stmt_bind_param($stmt, "s", $s_query1);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($link);
}
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	$s_query = "?" . $_SERVER['QUERY_STRING'];
	if ($_GET['vote'] == 'up') {
		$i_vote = 1;
		$s_query = str_replace("&vote=up", "", $s_query);
	} elseif ($_GET['vote'] == 'down') {
		$i_vote = -1;
		$s_query = str_replace("&vote=down", "", $s_query);
	} else {
		exit;
	}
	$sql = "SELECT i_index, i_vote FROM t_votes WHERE s_ipa = ? AND s_config = ?";
	require '../../php/link.php';
	$stmt = mysqli_stmt_init($link);
	mysqli_stmt_prepare($stmt, $sql);
	mysqli_stmt_bind_param($stmt, "ss", $_SERVER['REMOTE_ADDR'], $s_query);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $i_index, $i_current_vote);
	mysqli_stmt_fetch($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($link);
	if (isset($i_index)) {
		if ($i_vote == $i_current_vote) {
			$sql = "UPDATE t_votes SET i_vote = 0 WHERE i_index = ?";
			require '../../php/link.php';
			$stmt = mysqli_stmt_init($link);
			mysqli_stmt_prepare($stmt, $sql);
			mysqli_stmt_bind_param($stmt, "i", $i_index);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
			mysqli_close($link);
			if ($i_vote == 1) {
				f_vote(-1, $s_query);
			} else {
				f_vote(1, $s_query);
			}
			echo "0";
			exit;
		} elseif ($i_vote > $i_current_vote) {
			$sql = "UPDATE t_votes SET i_vote = ? WHERE i_index = ?";
			require '../../php/link.php';
			$stmt = mysqli_stmt_init($link);
			mysqli_stmt_prepare($stmt, $sql);
			mysqli_stmt_bind_param($stmt, "ii", $i_vote, $i_index);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
			mysqli_close($link);
			if ($i_current_vote == 0) {
				f_vote(1, $s_query);
			} else {
				f_vote(2, $s_query);
			}
			echo "1";
			exit;
		} else {
			$sql = "UPDATE t_votes SET i_vote = ? WHERE i_index = ?";
			require '../../php/link.php';
			$stmt = mysqli_stmt_init($link);
			mysqli_stmt_prepare($stmt, $sql);
			mysqli_stmt_bind_param($stmt, "ii", $i_vote, $i_index);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
			mysqli_close($link);
			if ($i_current_vote == 0) {
				f_vote(-1, $s_query);
			} else {
				f_vote(-2, $s_query);
			}
			echo "-1";
			exit;
		}
	} else {
		$sql = "INSERT INTO t_votes (s_ipa, s_config, i_vote) VALUES (?, ?, ?)";
		require '../../php/link.php';
		$stmt = mysqli_stmt_init($link);
		mysqli_stmt_prepare($stmt, $sql);
		mysqli_stmt_bind_param($stmt, "ssi", $_SERVER['REMOTE_ADDR'], $s_query, $i_vote);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		mysqli_close($link);
		f_vote($i_vote, $s_query);
		if ($i_vote == 1) {
			echo "1";
			exit;
		} else {
			echo "-1";
			exit;
		}
	}
}
?>