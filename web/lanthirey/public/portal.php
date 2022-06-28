<?php

if (isset($_COOKIE['portal'])) {
	header("Location: /");
	exit;
}

?>
<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name='description' content='waxing poetic, waning attention span'>
	<meta name='keywords' content='poem, art'>
	<meta property='og:type' content='website'>
	<meta property='og:url' content='https://lanthirey.xyz'>
	<meta property='og:title' content='Lanthirey'>
	<meta property='og:description' content='waxing poetic, waning attention span'>
	<meta property='og:image' content='media/image/social.png'>
	<link rel='icon' href='media/image/favicon.png'>
	<link rel='stylesheet' href='css/portal.css?ver=1'>
	<title>Lanthirey Portal</title>
</head>
<body>
<div id='idSysMsg'></div>
<div class="c1">
	<div class="c2">
		<div class="c3">SOMETHING BIG IS WAITING FOR YOU.</div>
		<div class="c3">WHAT WOULD YOU DO IF YOU</div>
		<div class="c3">KNEW YOU COULD NOT FAIL?</div>
		<form id="id1" class="c5">
			<div class='c6'><textarea class='c8' name="sInput" maxlength="2000" autofocus required></textarea></div>
			<div class="c4 c7">YOU WERE DESTINED TO BE GREAT.</div>
			<div class="c4">ARE YOU GOING TO ACT ON IT?</div>
			<div class="c10"><input type="checkbox" name="sEmail" id="id2"> <label for="id2">i would like to receive cryptic messages via email</label></div>
			<div id="id3" class="c11"><input id="id4" type="email" name="sEmail1" placeholder="your email address here"></div>
			<div class="c7"><input class='c9' type="submit" value="i am ready"></div>
		</form>
	</div>
</div>
<script src="js/portal.js"></script>
</body>
</html>