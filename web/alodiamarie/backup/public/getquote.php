<?php
if($_SERVER['REQUEST_METHOD'] == 'GET') {
	$s_data = $_GET['data'];
	if($s_data === "list") {
		echo "https://alodiamarie.com/quotes.php";
		exit;
	}
	if($s_data === '') {
		$sql = "SELECT c_quote FROM quotes_2022 ORDER BY RAND() LIMIT 1";
		require '../php/link.php';
		$o_result = mysqli_query($link, $sql);
		$row = mysqli_fetch_row($o_result);
		echo $row[0];
		mysqli_close($link);
		exit;
	}
	if(is_numeric($s_data)) {
		$i_data = intval($s_data);
		$sql = "SELECT c_quote, c_requests FROM quotes_2022 WHERE c_index = ?";
		require '../php/link.php';
		$stmt = mysqli_stmt_init($link);
		mysqli_stmt_prepare($stmt, $sql);
		mysqli_stmt_bind_param($stmt, "i", $i_data);
		if(mysqli_stmt_execute($stmt)) {
			mysqli_stmt_bind_result($stmt, $c_quote, $c_requests);
			mysqli_stmt_fetch($stmt);
			$a_result = array($stmt, $c_quote, $c_requests);
			mysqli_stmt_close($stmt);
			echo $a_result[1];
			$i_requests = $a_result[2] + 1;
			$sql = "UPDATE quotes_2022 SET c_requests = ? WHERE c_index = ?";
			$stmt = mysqli_stmt_init($link);
			mysqli_stmt_prepare($stmt, $sql);
			mysqli_stmt_bind_param($stmt, "ii", $i_requests, $i_data);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
			mysqli_close($link);
			exit;
		}
	}
}
?>