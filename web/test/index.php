<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>index</title>
</head>
<body>
	<form id="id1">
		<input type="text" name="s_name" value="mike">
	</form>
<script>
let o_form = new FormData(id1);
fetch("test.php", {
	method: "POST",
	body: o_form })
	.then(response => response.json())
	.then(data => {
		console.log(data[0]);
		console.log(data[1]);
	});
</script>
</body>
</html>