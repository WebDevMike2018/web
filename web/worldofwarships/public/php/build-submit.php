<?php

function f_vote($n, $s_query) {
	$sql = "UPDATE t_submission SET i_votes = i_votes + $n WHERE s_config = ?";
	require '../../php/link.php';
	$stmt = mysqli_stmt_init($link);
	mysqli_stmt_prepare($stmt, $sql);
	echo mysqli_stmt_error($stmt);
	mysqli_stmt_bind_param($stmt, "s", $s_query);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($link);
}

function f_vote_check($s_config) {
	$sql = "SELECT i_index, i_vote FROM t_votes WHERE s_ipa = ? AND s_config = ?";
	require '../../php/link.php';
	$stmt = mysqli_stmt_init($link);
	mysqli_stmt_prepare($stmt, $sql);
	mysqli_stmt_bind_param($stmt, "ss", $_SERVER['REMOTE_ADDR'], $s_config);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $i_index2, $i_current_vote);
	mysqli_stmt_fetch($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($link);
	if (isset($i_index2)) {
		if ($i_current_vote != 1) {
			$sql = "UPDATE t_votes SET i_vote = 1 WHERE i_index = ?";
			require '../../php/link.php';
			$stmt = mysqli_stmt_init($link);
			mysqli_stmt_prepare($stmt, $sql);
			mysqli_stmt_bind_param($stmt, "i", $i_index2);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
			mysqli_close($link);
			if ($i_current_vote == -1) {
				f_vote(2, $s_config);
			} else {
				f_vote(1, $s_config);
			}
		}
	} else {
		$sql = "INSERT INTO t_votes (s_ipa, s_config, i_vote) VALUES (?, ?, 1)";
		require '../../php/link.php';
		$stmt = mysqli_stmt_init($link);
		mysqli_stmt_prepare($stmt, $sql);
		mysqli_stmt_bind_param($stmt, "ss", $_SERVER['REMOTE_ADDR'], $s_config);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		mysqli_close($link);
		f_vote(1, $s_config);
	}
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	$i_points = 21;
	$a_skills_check = array();
	for ($i = 1; $i < 25; $i++) {
		$a_skills_check[] = $i;
	}
	$a_skills = explode(",", $_GET['skills']);
	foreach ($a_skills as &$value) {
		$value = intval($value);
		if (!in_array($value, $a_skills_check)) {
			$a_response = array(0, "Invalid skill encountered.");
			echo json_encode($a_response);
			exit;
		}
		switch ($value) {
			case ($value >= 1 and $value <= 6):
				$i_points -= 1;
				break;
			case ($value >= 7 and $value <=12):
				$i_points -= 2;
				break;
			case ($value >= 13 and $value <= 18):
				$i_points -= 3;
				break;
			case ($value >= 19 and $value <= 24):
				$i_points -= 4;
		}
	}
	if ($i_points != 0) {
		$a_response = array(0, "You must spend all points before submission.");
		echo json_encode($a_response);
		exit;
	}
	$sql = "SELECT * FROM t_ships WHERE name = ?";
	require '../../php/link.php';
	$stmt = mysqli_stmt_init($link);
	mysqli_stmt_prepare($stmt, $sql);
	mysqli_stmt_bind_param($stmt, "s", $_GET['name']);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $i_index, $s_type, $s_nation, $i_tier, $s_name);
	while (mysqli_stmt_fetch($stmt)) {
		$a_result = array($i_index, $s_type, $s_nation, $i_tier, $s_name);
	}
	mysqli_stmt_close($stmt);
	mysqli_close($link);
	if (isset($a_result)) {
		$s_config = "?nation={$a_result[2]}&type={$a_result[1]}&tier={$a_result[3]}&name={$a_result[4]}&skills={$_GET['skills']}";
		$s_config = str_replace(" ", "+", $s_config);
		// check if configuration already exists
		$sql = "SELECT i_index FROM t_submission WHERE s_config = ?";
		require '../../php/link.php';
		$stmt = mysqli_stmt_init($link);
		mysqli_stmt_prepare($stmt, $sql);
		mysqli_stmt_bind_param($stmt, "s", $s_config);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $i_index1);
		mysqli_stmt_fetch($stmt);
		mysqli_stmt_close($stmt);
		mysqli_close($link);
		if (isset($i_index1)) {
			f_vote_check($s_config);
			$a_response = array(1, "Your configuration has been submitted successfully. You will be directed in a moment...");
			echo json_encode($a_response);
			exit;
		}
		$sql = "INSERT INTO t_submission (s_name, s_type, s_config, i_votes) VALUES (?, ?, ?, 0)";
		require '../../php/link.php';
		$stmt = mysqli_stmt_init($link);
		mysqli_stmt_prepare($stmt, $sql);
		mysqli_stmt_bind_param($stmt, "sss", $a_result[4], $a_result[1], $s_config);
		if (mysqli_stmt_execute($stmt)) {
			f_vote_check($s_config);
			$a_response = array(1, "Your configuration has been submitted successfully. You will be directed in a moment...");
			echo json_encode($a_response);
			exit;
		} else {
			$a_response = array(0, "Unable to process at this time. Please try again in a moment.");
			echo json_encode($a_response);
			exit;
		}
	} else {
		$a_response = array(0, "{$_GET['name']} not found.");
		echo json_encode($a_response);
		exit;
	}
}
?>