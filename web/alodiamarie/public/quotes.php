<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name='description' content='AlodiaMarie'>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta property='og:title' content='AlodiaMarie'>
<meta property='og:type' content='website'>
<meta property='og:image:secure_url' content='https://alodiamarie.com/image/peppa.png'>
<meta property="og:image:type" content="image/png">
<meta property='og:url' content='https://alodiamarie.com/'>
<link rel="icon" type="image/png" href="image/favicon.png">
<link rel="stylesheet" type="text/css" href="css/header.css?ver=4">
<link rel="stylesheet" type="text/css" href="css/quotes.css?ver=6">
<title>Alodia Marie Quotes</title>
</head>
<body>
<div id="header">
	<a href="/">Home</a>
	<a href="games">Games</a>
	<a class="active">Quotes</a>
</div>
<div id='body'>
	<div class='cl1'>
		<div id='year2022' class='active' onclick="f_year('table2022')">2022</div>
		<div id='year2021' onclick="f_year('table2021')">2021</div>
		<div id='year2020' onclick="f_year('table2020')">2020</div>
		<div id='year2019' onclick="f_year('table2019')">2019</div>
	</div>
	<table id='table2022'>
		<tr>
			<th onclick="sortTableInt(0, 'table2022')">Index</th>
			<th onclick="sortTable(1, 'table2022')">Quote</th>
			<th onclick="sortTable(2, 'table2022')">Quoted By</th>
			<th onclick="sortTableInt(3, 'table2022')">Requests</th>
		</tr>
<?php
	$sql = "SELECT * FROM quotes_2022";
	require "../php/link.php";
	$o_result = mysqli_query($link, $sql);
	while($a_row = mysqli_fetch_row($o_result)) {
		echo "<tr><td>" . $a_row[0] . "</td><td>" . htmlspecialchars($a_row[1]) . "</td><td>" . $a_row[2] . "</td><td>" . $a_row[3] . "</td></tr>";
	}
	mysqli_close($link);
?>
	</table>
	<table id='table2021'>
		<tr>
			<th onclick="sortTableInt(0, 'table2021')">Index</th>
			<th onclick="sortTable(1, 'table2021')">Quote</th>
			<th onclick="sortTable(2, 'table2021')">Quoted By</th>
			<th onclick="sortTableInt(3, 'table2021')">Requests</th>
		</tr>
<?php
	$sql = "SELECT * FROM quotes_2021";
	require "../php/link.php";
	$o_result = mysqli_query($link, $sql);
	while($a_row = mysqli_fetch_row($o_result)) {
		echo "<tr><td>" . $a_row[0] . "</td><td>" . htmlspecialchars($a_row[1]) . "</td><td>" . $a_row[2] . "</td><td>" . $a_row[3] . "</td></tr>";
	}
	mysqli_close($link);
?>
	</table>
	<table id='table2020'>
		<tr>
			<th onclick="sortTableInt(0, 'table2020')">Index</th>
			<th onclick="sortTable(1, 'table2020')">Quote</th>
			<th onclick="sortTable(2, 'table2020')">Quoted By</th>
			<th onclick="sortTableInt(3, 'table2020')">Requests</th>
		</tr>
<?php
	$sql = "SELECT * FROM quotes_2020";
	require "../php/link.php";
	$o_result = mysqli_query($link, $sql);
	while($a_row = mysqli_fetch_row($o_result)) {
		echo "<tr><td>" . $a_row[0] . "</td><td>" . htmlspecialchars($a_row[1]) . "</td><td>" . $a_row[2] . "</td><td>" . $a_row[3] . "</td></tr>";
	}
	mysqli_close($link);
?>
	</table>
	<table id='table2019'>
		<tr>
			<th onclick="sortTableInt(0, 'table2019')">Index</th>
			<th onclick="sortTable(1, 'table2019')">Quote</th>
		</tr>
<?php
	$sql = "SELECT * FROM quotes_2019";
	require "../php/link.php";
	$o_result = mysqli_query($link, $sql);
	while($a_row = mysqli_fetch_row($o_result)) {
		echo "<tr><td>" . $a_row[0] . "</td><td>" . $a_row[1] . "</td></tr>";
	}
	mysqli_close($link);
?>
	</table>
</div>
<script src='js/quotes.js?ver=4'></script>
</body>
</html>