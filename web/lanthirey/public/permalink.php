<?php
require '../php/link.php';
parse_str($_SERVER['QUERY_STRING'], $aGet);
$sql = "SELECT * FROM cms WHERE cIndex = ?";
$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_bind_param($stmt, "i", $aGet['index']);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $cIndex, $cDate, $cTitle, $cContent, $cTag, $cUpvote);
while (mysqli_stmt_fetch($stmt)) {
	$aArray = array($cIndex, $cDate, $cTitle, $cContent, $cTag, $cUpvote);
}
mysqli_stmt_close($stmt);
mysqli_close($link);
$aContent = unserialize($aArray[3]);
if ($aContent[0] === 1) {
	$sContent = $aContent[1];
} else {
	$i_a_content = count($aContent);
	if ($i_a_content == 2) {
		$sContent = "<img class='cl5' src='" . $aContent[1] . "'>";
	} elseif ($i_a_content == 3) {
		$sContent = "<div class='cl14'><div><img class='cl5' src='" . $aContent[1] . "'></div><div><img class='cl5' src='" . $aContent[2] . "'></div></div>";
	} elseif ($i_a_content == 4) {
		$sContent = "<div class='cl14'><div><img class='cl5' src='" . $aContent[1] . "'></div><div><img class='cl5' src='" . $aContent[2] . "'></div></div><img class='cl5' src='" . $aContent[3] . "' style='margin-top:8px;'>";
	} else {
		$sContent = "<div class='cl14'><div><img class='cl5' src='" . $aContent[1] . "'></div><div><img class='cl5' src='" . $aContent[2] . "'></div><div><img class='cl5' src='" . $aContent[3] . "' style='margin-top:8px;'></div><div><img class='cl5' src='" . $aContent[4] . "' style='margin-top:8px;'></div></div>";
	}
}
$sTag = '';
if ($aArray[4] != '') {
	$aTag = unserialize($aArray[4]);
	$sTag = "<div class='cl3'>";
	foreach ($aTag as $value) {
		$sTag .= "<a href='tag.php?tag=$value&page=1' class='cl4'>#" . $value . "</a> ";
	}
	$sTag .= "</div>";
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
	<link rel='stylesheet' href='css/header.css?ver=1'>
	<link rel='stylesheet' href='css/permalink.css?ver=1'>
	<link rel="stylesheet" href="css/footer.css?ver=1">
	<title>Lanthirey <?php echo $aArray[2]; ?></title>
</head>
<body>
<div id='sys_msg'></div>
<?php include 'header.htm'; ?>
<div class='cl1'>
	<div class='cl2'><?php echo $aArray[2]; ?></div>
	<div class='cl3'><?php echo $sContent; ?></div>
	<?php echo $sTag; ?>
	<div id='id1' class='cl6'>
		<form id='id4'>
			<input type='text' name='s_name' placeholder='Name' maxlength='25' required><br>
			<textarea id='id2' class='cl10' name='s_comment' placeholder='leave a comment' maxlength='500' required></textarea>
			<div class="cl16"><div class='cl12'><input class='cl11' type='submit' value='SUBMIT'></div><div id='id3' class='cl13'></div></div>
			</form>
	</div>
</div>
<?php require "footer.htm"; ?>
<script>
// Variables
const i_index = <?php echo $aGet['index']; ?>
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
for (let i = 0; i < 5; i++) {
	let str = "const id" + i + " = document.getElementById('id" + i + "');";
	eval(str);
}

(function() {
	let xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			if (this.responseText != '') {
				a_data = JSON.parse(this.responseText);
				if (a_data.length > 0) {
					a_data.forEach(function(value) {
						let o_new_element = document.createElement('div');
						o_new_element.classList.add('cl7');
						let o_new_element_1 = document.createElement('div');
						o_new_element_1.classList.add('cl8');
						o_new_element_1.innerHTML = value[0];
						let o_new_element_2 = document.createElement('div');
						o_new_element_2.classList.add('cl9');
						o_new_element_2.innerHTML = value[1];
						o_new_element.appendChild(o_new_element_1);
						o_new_element.appendChild(o_new_element_2);
						id1.appendChild(o_new_element);
					});
				}
			}
		}
	}
	xhr.open('GET', "comment/" + i_index + ".txt", true);
	xhr.send();
})();
(function() {
	let aIframe = document.querySelectorAll("iframe");
	aIframe.forEach(function(v) {
		v.setAttribute("width", "");
		v.style.width = "100%";
	});
}) ();
/*
<div class='cl7'>
	<div class='cl8'>Name</div>
	<div class='cl9'>Comment.</div>
</div>
*/
// Event Listeners
id4.addEventListener('submit', function(e) {
	e.preventDefault();
	let o_form = new FormData(id4);
	o_form.append("i_index", i_index);
	let xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			if (this.responseText != '') {
				let a_response = JSON.parse(this.responseText);
				f_sys_msg(a_response[0], a_response[1]);
			}
		}
	};
	xhr.open('POST', "php/comment-submit.php", true);
	xhr.send(o_form);
	id4.reset();
});
</script>
<script src="js/footer.js"></script>
<script src='js/random-pop.js' async></script>
</body>
</html>