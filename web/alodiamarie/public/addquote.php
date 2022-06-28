<?php
if($_SERVER['REQUEST_METHOD'] == 'GET') {
	if($_GET['token'] === "Z3PTXywzT89kcvmQ") {
		$a_headers = getallheaders();
		parse_str($a_headers['Nightbot-User'], $a_result);
		$mvData = $_GET['data'];
		$mvDataLength = strlen($mvData);
		if ($mvDataLength >= 3 and $mvDataLength <= 150) {
			require '../php/link.php';
			$sql = "INSERT INTO quotes_2022 (c_quote, c_quote_by, c_requests) VALUES (?, ?, 0)";
			$stmt = mysqli_stmt_init($link);
			mysqli_stmt_prepare($stmt, $sql);
			mysqli_stmt_bind_param($stmt, "ss", $mvData, $a_result['name']);
			if(mysqli_stmt_execute($stmt)) {
				echo "Quote added.";
			} else {
				echo "Unable to add quote. Please try again later.";
			}
			mysqli_stmt_close($stmt);
			mysqli_close($link);
		} else {
			echo "The quote must be 3-150 characters.";
		}
	}
}
?>