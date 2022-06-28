<?php

function f_upvote($i_index) {
	$sql = "UPDATE cms SET cUpvote = cUpvote + 1 WHERE cIndex = $i_index";
	require '../../php/link.php';
	if(mysqli_query($link, $sql)) {
		echo "true";
	}
	mysqli_close($link);
}

if($_SERVER['REQUEST_METHOD'] == 'GET') {
	$s_ipa = $_SERVER['REMOTE_ADDR'];
	$i_index = intval($_GET['index']);
	$sql = "SELECT * FROM t_vote WHERE c_ipa = '{$s_ipa}' AND c_vote = '{$i_index}'";
	require '../../php/link.php';
	$o_result = mysqli_query($link, $sql);
	if(mysqli_num_rows($o_result) > 0) {
		$a_row = mysqli_fetch_assoc($o_result);
		mysqli_close($link);
		$o_date = unserialize($a_row['c_date']);
		$o_now = date_create('now');
		$o_interval = date_diff($o_now, $o_date);
		if($o_interval->days > 1) {
			f_upvote($i_index);
			$s_now = serialize($o_now);
			$sql = "UPDATE t_vote SET c_date = '{$s_now}' WHERE c_index = '{$a_row['c_index']}'";
			require '../../php/link.php';
			mysqli_query($link, $sql);
			mysqli_close($link);
		} else {
			$a_response = array(0, "You have already submitted an upvote for this post.");
			echo json_encode($a_response);
		}
	} else {
		f_upvote($i_index);
		$o_now = date_create('now');
		$s_now = serialize($o_now);
		$sql = "INSERT INTO t_vote (c_ipa, c_vote, c_date) VALUES ('{$s_ipa}', '{$i_index}', '{$s_now}')";
		require '../../php/link.php';
		mysqli_query($link, $sql);
		mysqli_close($link);
	}
}
?>