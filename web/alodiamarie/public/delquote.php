<?php
if($_SERVER['REQUEST_METHOD'] == 'GET') {
	$s_token = $_GET["token"];
	if ($s_token === "Z3PTXywzT89kcvmQ") {
		$i_data = intval($_GET['data']);
		$a_headers = getallheaders();
		$a_user = $a_headers["Nightbot-User"];
		parse_str($a_user, $a_result);
		$s_user = $a_result['name'];
		$sql = "SELECT * FROM quotes_2022 WHERE c_index = ?";
		require '../php/link.php';
		$stmt = mysqli_stmt_init($link);
		mysqli_stmt_prepare($stmt, $sql);
		mysqli_stmt_bind_param($stmt, "i", $i_data);
		if(mysqli_stmt_execute($stmt)) {
			mysqli_stmt_bind_result($stmt, $c_index, $c_quote, $c_quote_by, $c_requests);
			mysqli_stmt_fetch($stmt);
			$a_result = array($stmt, $c_index, $c_quote, $c_quote_by, $c_requests);
			mysqli_stmt_close($stmt);
			if($s_user == $a_result[2] or $s_user == 'alodiamarie') {
				$sql = "DELETE FROM quotes_2022 WHERE c_index = {$a_result[1]}";
				if(mysqli_query($link, $sql)) {
					echo "Quote " . $a_result[1] . " has been deleted.";
				} else {
					echo "Unable to delete quote at this time. Please try again later.";
				}
			} else {
				echo "Only alodiamarie or the quote author may delete this quote.";
			}
		} else {
			echo "Unable to delete quote at this time. Please try again later.";
		}
	} else {
		echo "Invalid token.";
	}
}
?>