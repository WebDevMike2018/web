<?php
if (isset($_SESSION['b_logged_in']) && $_SESSION['b_logged_in'] == true) {
	header('Location: index.php');
	exit;
}

if (isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
	require '../db-mailserver.php';
	$s_query = "SELECT domain_id FROM virtual_users WHERE email = ? AND password = ?";
	$o_stmt = $o_sql->prepare($s_query);
	$o_stmt->bind_param("ss", $_COOKIE['email'], $_COOKIE['password']);
	$o_stmt->execute();
	$o_stmt->store_result();
	if ($o_stmt->num_rows > 0) {
		$o_stmt->free_result();
		$o_stmt->close();
		$o_sql->close();
		$_SESSION['b_logged_in'] = true;
		$_SESSION['email'] = $_COOKIE['email'];
		header('Location: index');
		exit;
	}
}

require 'html/login.html';
?>