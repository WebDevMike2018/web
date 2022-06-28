<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	if ($_GET['req'] == 1) {
		$o_date = new DateTime();
		$s_year_cur = $o_date->format("Y");
		$i_year_cur = intval($s_year_cur);
		$a_years = [];
		for ($i = $i_year_cur; $i >= 2019; $i--) {
			$a_years[] = $i;
		}
		foreach ($a_years as &$v) {
			$v = strval($v);
		}
		unset($v);
		$a_response = [1, $a_years];
		echo json_encode($a_response);
		exit;
	}
	if ($_GET['req'] == 2) {
		$b_valid = false;
		$o_date = new DateTime();
		$s_year_cur = $o_date->format("Y");
		$i_year_cur = intval($s_year_cur);
		$a_years = [];
		for ($i = $i_year_cur; $i >= 2019; $i--) {
			$a_years[] = $i;
		}
		foreach ($a_years as &$v) {
			$v = strval($v);
			if ($v == $_GET['year']) { $b_valid = true; }
		}
		unset($v);
		if ($b_valid) {
			$s_table = "quotes_{$_GET['year']}";
			$a1 = [];
			require '../../db-alodiamarie.php';
			$s_query = "SELECT * FROM $s_table";
			$o_result = $o_sql->query($s_query);
			while ($a_row = $o_result->fetch_row()) {
				$a1[] = [$a_row[0], $a_row[1], $a_row[2]];
			}
			$o_sql->close();
			$a_response = [1, $a1];
			echo json_encode($a_response);
			exit;
		} else {
			$a_response = [0, "Unable to process request. Error Code: 11"];
			echo json_encode($a_response);
			exit;
		}
	}
	if ($_GET['req'] == 3) {
		if ($_GET['token'] == "Z3PTXywzT89kcvmQ") {
			$i1 = strlen($_GET['data']);
			if ($i1 >= 3 && $i1 <= 180) {
				$s_quote = $_GET['data'];
				$o_date = new DateTime();
				$s_year_cur = $o_date->format("Y");
				$s_table = "quotes_" . $s_year_cur;
				$a_headers = getallheaders();
				parse_str($a_headers['Nightbot-User'], $a_result);
				require '../../db-alodiamarie.php';
				$s_query = "INSERT INTO $s_table (c_quote, c_quote_by) VALUES (?, ?)";
				$o_stmt = $o_sql->prepare($s_query);
				$o_stmt->bind_param("ss", $s_quote, $a_result['name']);
				if ($o_stmt->execute()) {
					echo "Quote added.";
				} else {
					echo "Unable to add quote. Please try again.";
				}
				$o_stmt->close();
				$o_sql->close();
			} else {
				echo "The quote must be 3-180 characters.";
				exit;
			}
		} else {
			echo "Unable to process request. Error code: 11";
			exit;
		}
	}
	if ($_GET['req'] == 4) {
		if ($_GET['token'] == "Z3PTXywzT89kcvmQ") {
			$o_date = new DateTime();
			$s_year_cur = $o_date->format("Y");
			$s_table = "quotes_" . $s_year_cur;
			$i_index = intval($_GET['data']);
			$a_headers = getallheaders();
			parse_str($a_headers['Nightbot-User'], $a_result);
			require '../../db-alodiamarie.php';
			$s_query = "SELECT c_quote_by FROM $s_table WHERE c_index = ?";
			$o_stmt = $o_sql->prepare($s_query);
			$o_stmt->bind_param("i", $i_index);
			$o_stmt->execute();
			$o_stmt->bind_result($c1);
			$o_stmt->fetch();
			$o_stmt->close();
			if (empty($c1)) {
				echo "Unable to find quote " . $_GET['data'];
				exit;
			} else {
				if ($a_result['name'] == $c1 || $a_result['name'] == "alodiamarie") {
					$s_query = "DELETE FROM $s_table WHERE c_index = ?";
					$o_stmt = $o_sql->prepare($s_query);
					$o_stmt->bind_param("i", $i_index);
					if ($o_stmt->execute()) {
						echo "Quote " . $_GET['data'] . " has been deleted.";
						exit;
					} else {
						echo "Unable to delete quote. Please try again.";
						exit;
					}
				} else {
					echo "Only the author or AlodiaMarie may delete this quote.";
					exit;
				}
			}
		} else {
			echo "Unable to process request. Error code: 11";
			exit;
		}
	}
	if ($_GET['req'] == 5) {
		if ($_GET['data'] == "list") {
			echo "https://alodiamarie.com/quotes";
			exit;
		}
		require '../../db-alodiamarie.php';
		$o_date = new DateTime();
		$s_year_cur = $o_date->format("Y");
		$s_table = "quotes_" . $s_year_cur;
		if ($_GET['data'] == "") {
			$s_query = "SELECT c_quote FROM $s_table ORDER BY RAND() LIMIT 1";
			$o_stmt = $o_sql->prepare($s_query);
			$o_stmt->execute();
			$o_stmt->bind_result($c1);
			$o_stmt->fetch();
			$o_stmt->close();
			$o_sql->close();
			echo $c1;
			exit;
		}
		if (is_numeric($_GET['data'])) {
			$i1 = intval($_GET['data']);
			$s_query = "SELECT c_quote FROM $s_table WHERE c_index = ?";
			$o_stmt = $o_sql->prepare($s_query);
			$o_stmt->bind_param("i", $i1);
			$o_stmt->execute();
			$o_stmt->bind_result($c1);
			$o_stmt->fetch();
			$o_stmt->close();
			$o_sql->close();
			if (empty($c1)) {
				echo "Unable to find quote " . $_GET['data'];
				exit;
			} else {
				echo $c1;
				exit;
			}
		}
	}
}


?>