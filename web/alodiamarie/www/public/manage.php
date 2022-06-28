<?php

if (empty($_SESSION['b_logged_in'])) {
	header("Location: login");
	exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="media/favicon.png">
	<link rel="stylesheet" href="css/manage.css">
	<title>Alodia Marie Manage</title>
</head>
<body>
<div id="id_sys_msg"></div>
<div class="a1">
	<div class="a2">
		<div class="a3">
			<div class="a16">
				<div><form id="id10"><input type="file" name="pic" accept="image/*" required> <button type="submit">Change Picture</button></form></div>
				<div class="a17 m2">200x200 pixels is recommended.</div>
			</div>
		</div>
		<div class="a3 m64">
			<div class="a4">
				<div class="a5"><img id="id1" data-status="closed" src="media/add.png"></div>
				<div class="a6">Manage Links</div>
				<div class="a7"></div>
			</div>
			<div class="a9" id="id2">
				<!-- <div class="a8">Add Link</div> -->
				<form id="id3">
					<table class="a10">
						<tr>
							<td>Link Text:</td>
							<td><input type="text" name="text" maxlength="255" placeholder="Twitch" required></td>
						</tr>
						<tr>
							<td>Link To:</td>
							<td><input type="text" name="link" maxlength="255" placeholder="https://twitch.tv/alodiamarie" required></td>
						</tr>
					</table>
					<div class="a11"><button class="a12">ADD LINK</button></div>
				</form>
				<table class="a10 m32"><tbody id="id4"></tbody></table>
			</div>
		</div>
		<div class="a3 m32">
			<div class="a4">
				<div class="a5"><img id="id5" data-status="closed" src="media/add.png"></div>
				<div class="a6">Manage Games</div>
				<div class="a7"></div>
			</div>
			<div id="id6" class="a9">
				<div>Add Game:</div>
				<form id="id7">
					<div><input type="text" name="title" placeholder="game title" maxlength="255" required> <button data-type="1" type="submit">PLAYING</button> <button data-type="2" type="submit">PLAYED</button></div>
				</form>
				<div class="a14 m32">Playing</div>
				<div class="m2"><table><tbody id="id8"></tbody></table></div>
				<div class="a14 m32">Played</div>
				<div class="m2"><table><tbody id="id9"></tbody></table></div>
			</div>
		</div>
	</div>
</div>
<script src="js/manage.js"></script>
<!-- id10 -->
</body>
</html>