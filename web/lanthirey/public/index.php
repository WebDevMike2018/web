<?php

if (!isset($_COOKIE['portal'])) {
	header("Location: portal");
	exit;
}

?>
<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset='UTF-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<meta name='description' content='waxing poetic, waning attention span'>
	<meta name='keywords' content='poem, art'>
	<meta property='og:type' content='website'>
	<meta property='og:url' content='https://lanthirey.xyz'>
	<meta property='og:title' content='Lanthirey'>
	<meta property='og:description' content='waxing poetic, waning attention span'>
	<meta property='og:image' content='media/image/social.png'>
	<link rel='icon' href='media/image/favicon.png'>
	<link rel='stylesheet' href='css/header.css?ver=1'>
	<link rel='stylesheet' href='css/index.css?ver=1'>
	<link rel='stylesheet' href='css/footer.css?ver=1'>
	<title>Lanthirey</title>
</head>
<body>
<div id='sys_msg'></div>
<?php require 'header.htm'; ?>
<div id='scrollTop'></div>
<div id='id1' class='cl1'></div>
<div id='id2' class='cl10'></div>
<?php require "footer.htm"; ?>
<script src='js/index.js'></script>
<script src='js/index-pagination.js?ver=5'></script>
<script src='js/footer.js'></script>
<script src='js/random-pop.js' async></script>
</body>
</html>