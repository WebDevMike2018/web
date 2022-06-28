<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/png" href="/web/quizzer/public/favicon.png">
	<link rel="stylesheet" href="/web/quizzer/public/css/poll-create.css">
	<link rel="stylesheet" href="/web/quizzer/public/css/header.css">
	<title>Quizzer</title>
</head>
<body>
<div id="idSysMsg"></div>
<?php include "header.html"; ?>
<div class="c1">
	<div id="id1">
		<div class="c2">Ask a question:</div>
		<textarea id="id2" autofocus></textarea>
		<div class="c2">Provide answers:</div>
		<div id="id3" class="c3">
			<textarea></textarea>
			<textarea></textarea>
		</div>
		<div class="c4"><div id="id4" class="c5">SUBMIT</div></div>
	</div>
	<div id="id7" class="c9">
		<div class="c6">
			<div class="c7">Your poll has been created successfully. Share the following link with pollees:<br><input id="id5" class="c8" type="text" readonly> <img id="id6" src="media/image/copy-icon.png"></div>
		</div>
	</div>
</div>
<script src="js/poll-create.js"></script>
<!-- id7 -->
</body>
</html>