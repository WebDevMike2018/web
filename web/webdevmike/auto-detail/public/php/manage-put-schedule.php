<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$s_date = $_POST['s_date'];
	$j_time = $_POST['j_time'];
	if (isset($_POST['j_date'])) {
		$j_date = $_POST['j_date'];
		$i_day = intval($_POST['s_day']);
		$a_time = json_decode($j_time);
		$a_time1 = array();
		foreach ($a_time as $value) {
			$a_time1[] = $value->scheduled;
		}
		$s_schedule = file_get_contents("../../php/schedule.txt");
		$a_schedule = unserialize($s_schedule);
		$a_schedule[$i_day] = $a_time1;
		$s_schedule = serialize($a_schedule);
		file_put_contents("../../php/schedule.txt", $s_schedule);
		$a_date = json_decode($j_date);
		foreach ($a_date as $value) {
			$sql = "SELECT s_time FROM t_schedule WHERE s_date = '$value'";
			require '../../php/link.php';
			$stmt = mysqli_stmt_init($link);
			mysqli_stmt_prepare($stmt, $sql);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $s_time);
			while (mysqli_stmt_fetch($stmt)) { $a_time2 = json_decode($s_time); }
			mysqli_stmt_close($stmt);
			mysqli_close($link);
			for ($i = 0; $i < count($a_time); $i++) {
				$a_time2[$i]->scheduled = $a_time[$i]->scheduled;
			}
			$s_time = json_encode($a_time2);
			$sql = "UPDATE t_schedule SET s_time = ? WHERE s_date = ?";
			require '../../php/link.php';
			$stmt = mysqli_stmt_init($link);
			mysqli_stmt_prepare($stmt, $sql);
			mysqli_stmt_bind_param($stmt, "ss", $s_time, $value);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
			mysqli_close($link);
		}
	} else {
		$sql = "UPDATE t_schedule SET s_time = ? WHERE s_date = ?";
		require '../../php/link.php';
		$stmt = mysqli_stmt_init($link);
		mysqli_stmt_prepare($stmt, $sql);
		mysqli_stmt_bind_param($stmt, "ss", $j_time, $s_date);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		mysqli_close($link);
	}
	$a_response = [1, "Schedule updated."];
	echo json_encode($a_response);
}

?>