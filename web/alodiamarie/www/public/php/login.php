<?php

require '../../db-alodiamarie.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if ($_POST['req'] == 1) {
		function f_verify($c1 = null, $c2 = null, $c3 = null) {
			global $o_sql;
			$s_query = "SELECT c_hash FROM t_login WHERE c_index = 1";
			$o_result = $o_sql->query($s_query);
			$a_row = $o_result->fetch_row();
			if (password_verify($_POST['password'], $a_row[0])) {
				$_SESSION['b_logged_in'] = true;
				if ($c1) {
					$s_query = "UPDATE t_fail2ban SET c_fail_count = 0 WHERE c_index = $c1";
					$o_sql->query($s_query);
				}
				$a_response = [1, $a_row[0]];
				echo json_encode($a_response);
				$o_sql->close();
				exit;
			} else {
				if ($c1) {
					$i_fail_count = $c2 + 1;
					if ($i_fail_count > 100) {
					$o_ban_time = new DateTime();
					$o_ban_time->add(new DateInterval('PT60S'));
					$s_ban_time = $o_ban_time->format('Y-m-d H:i:s');
					$s_query = "UPDATE t_fail2ban SET c_fail_count = $i_fail_count, c_ban_time = '{$s_ban_time}' WHERE c_index = $c1";
					$o_sql->query($s_query);
					$a_response = [-2, "60"];
					echo json_encode($a_response);
					$o_sql->close();
					exit;
					} else {
						$s_query = "UPDATE t_fail2ban SET c_fail_count = $i_fail_count WHERE c_index = $c1";
						$o_result = $o_sql->query($s_query);
						$a_response = [0, "Invalid password. Please check the password and try again."];
						echo json_encode($a_response);
						$o_sql->close();
						exit;
					}
				} else {
					$s_query = "INSERT INTO t_fail2ban (c_ipa, c_fail_count, c_ban_time) VALUES (?, 1, current_timestamp())";
					$o_stmt = $o_sql->prepare($s_query);
					$o_stmt->bind_param("s", $_SERVER['REMOTE_ADDR']);
					$o_stmt->execute();
					$o_stmt->close();
					$a_response = [0, "Invalid password. Please check the password and try again."];
					echo json_encode($a_response);
					$o_sql->close();
					exit;
				}
			}
		}
		$s_query = "SELECT c_index, c_fail_count, c_ban_time FROM t_fail2ban WHERE c_ipa = ?";
		$o_stmt = $o_sql->prepare($s_query);
		$o_stmt->bind_param("s", $_SERVER['REMOTE_ADDR']);
		$o_stmt->execute();
		$o_stmt->bind_result($c1, $c2, $c3);
		$o_stmt->fetch();
		$o_stmt->close();
		if (empty($c1)) {
			f_verify();
		} else {
			$o_now = new DateTime();
			$o_ban_time = new DateTime($c3);
			if ($o_now > $o_ban_time) {
				f_verify($c1, $c2, $c3);
			} else {
				$o_ban_time = $o_now->diff($o_ban_time);
				$s_ban_time = $o_ban_time->format('%s');
				$a_response = [-1, $s_ban_time];
				echo json_encode($a_response);
				$o_sql->close();
				exit;
			}
		}
	}
}

?>