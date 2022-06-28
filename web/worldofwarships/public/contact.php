<!DOCTYPE html>
<html lang='en'>
<head>
<meta charset='utf-8'>
<meta name='viewport' content='width=device-width, initial-scale=1.0'>
<meta name='author' content='Michael Griffiths (contact@webdevmike.com)'>
<meta name='description' content='world of warships calculator'>
<meta name='keywords' content='world of warships'>
<link rel='stylesheet' href='css/header.css'>
<link rel='stylesheet' href='css/contact.css'>
<title>WoW Club Contact</title>
</head>
<body>
<div id='sys_msg'></div>
<?php include 'header.htm'; ?>
<div class='cl1'>Got a question or comment?<br><a class='cl2' href='mailto:support@worldofwarships.club'>support@worldofwarships.club</a></div>
<script async>
// Variables

// Functions
function f_sys_msg(i_type, s_msg) {
	let o_sys_msg = document.getElementById('sys_msg');
	if (i_type == -1) {
		o_sys_msg.style.visibility = 'hidden';
		o_sys_msg.style.backgroundColor = 'white';
	} else if (i_type == 0) {
		o_sys_msg.innerHTML = s_msg;
		o_sys_msg.style.color = 'white';
		o_sys_msg.style.visibility = 'visible';
		o_sys_msg.style.backgroundColor = 'hsl(0, 100%, 50%)';
		setTimeout(f_sys_msg, 6000, -1);
	} else {
		o_sys_msg.innerHTML = s_msg;
		o_sys_msg.style.color = 'black';
		o_sys_msg.style.visibility = 'visible';
		o_sys_msg.style.backgroundColor = 'hsl(120, 100%, 50%)';
		setTimeout(f_sys_msg, 6000, -1);
	}
}
// Invoke
for (let i = 1; i < 1; i++) {
	let str = "const id" + i + " = document.getElementById('id" + i + "');";
	eval(str);
}
// Event Listeners
</script>
</body>
</html>