<?php

if (isset($_SESSION['b_logged_in']) && $_SESSION['b_logged_in'] == true) {
	header('Location: manage');
	exit;
}

if (isset($_COOKIE['password'])) {
	require '../db-alodiamarie.php';
	$s_query = "SELECT c_hash FROM t_login WHERE c_index = 1";
	$o_stmt = $o_sql->prepare($s_query);
	$o_stmt->execute();
	$o_stmt->bind_result($c1);
	$o_stmt->fetch();
	$o_stmt->close();
	$o_sql->close();
	if ($_COOKIE['password'] == $c1) {
		$_SESSION['b_logged_in'] = true;
		header("Location: manage");
		exit;
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="media/favicon.png">
	<link rel="stylesheet" href="css/login.css">
	<title>Alodia Marie Login</title>
</head>
<body>
<div id="id_sys_msg"></div>
<div class="a1">
	<div class="a2">
		<form id="id1" class="a3">
			<div class="a5"><div><input id="id3" type="password" name="password" placeholder="password" autofocus required></div><div><img id="id2" class="a6" data-status="hide" src="media/show.png" alt="show password"></div></div>
			<div><input type="checkbox" name="remember" id="id4"> <label for="id4">Remember Me</label></div>
			<div><button class="a4" type="submit">SUBMIT</button></div>
		</form>
	</div>
</div>
<script src="js/login.js"></script>
<!-- id4 -->
</body>
</html>