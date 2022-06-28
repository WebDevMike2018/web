<?php

setcookie("code", $a1[4]); //$a1[1] Prod $a1[4] Dev

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/png" href="/web/quizzer/public/favicon.png">
	<link rel="stylesheet" href="/web/quizzer/public/css/poll.css">
	<link rel="stylesheet" href="/web/quizzer/public/css/header.css">
	<title>Quizzer</title>
</head>
<body>
<div id='idSysMsg'></div>
<?php include "header.html"; ?>
<div class="c1">
	<div id="id1" class="c2"></div>
	<div id="id2" class="c3"></div>
</div>
<script src="/web/quizzer/public/js/poll.js"></script>
</body>
</html>