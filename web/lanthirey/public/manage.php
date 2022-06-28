<?php
session_start();
if ($_SESSION['bAccess'] != 'true') {
	header('Location: login.php');
	exit();
}

$sql = "SELECT * FROM t_comment_approval";
require '../php/link.php';
$o_result = mysqli_query($link, $sql);
$i_comment_count = mysqli_num_rows($o_result);
if ($i_comment_count > 0) {
	$a_index = array();
	$a_post_index = array();
	$a_name = array();
	$a_comment = array();
	$a_ipa = array();
	while ($row = mysqli_fetch_row($o_result)) {
		$a_index[] = $row[0];
		$a_post_index[] = $row[1];
		$a_name[] = $row[2];
		$a_comment[] = $row[3];
		$a_ipa[] = $row[4];
	}
}
mysqli_close($link);

$a_artist_names = array(' ');
$sql = "SELECT s_name FROM t_artist";
require '../php/link.php';
$stmt = mysqli_stmt_init($link);
mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $s_artist_name);
while (mysqli_stmt_fetch($stmt)) {
	$a_artist_names[] = $s_artist_name;
}
mysqli_stmt_close($stmt);
mysqli_close($link);
$j_artist_names = json_encode($a_artist_names);
?>
<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset='UTF-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<link rel='icon' href='media/image/favicon.png'>
	<link rel='stylesheet'	href='css/header.css?ver=1'>
	<link rel='stylesheet'	href='css/manage.css?ver=1'>
	<link rel='stylesheet'	href='css/footer.css?ver=1'>
	<title>Lanthirey Manage</title>
</head>
<body>
<div id='sys_msg'></div>
<?php require 'header.htm'; ?>
<div class='cl1'>
	<div id='id6' class='cl2'>
		<img class='cl4' src='media/image/add.png'>
		<div class='cl3'>Post Management</div>
	</div>
	<div id='id7' class='cl5' style='display:none;'>
		<form id='id8' class='form1' enctype='multipart/form-data'>
			<div class='form1d'>Add Post</div>
			<div class='form1e'><input type='hidden' name='sForm' value='1'></div>
			<span>Title:</span><br>
			<input class='form1a' type='text' name='sTitle' maxlength='999' required autofocus><br><br>
			<div id='id1'>
				<span>Content:</span><br>
				<textarea id='id2' class='form1b' name='sContent'></textarea><br>
			</div>
			<div id='id3'>
				<span id='id5'>or</span>
				<input id='id4' type='file' accept='image/*' name='sImage[]' multiple><br><br>
			</div>
			<span>Tags:</span><br>
			<input class='form1a' type='text' name='sTag' maxlength='999' pattern="(#\w+)+" placeholder='#tag#tag'><br><br>
			<span>Collaborators:</span><br>
			<div id='id17'></div>
			<br>
			<input class='form1c' type='submit' value='SUBMIT'>
		</form>
		<form id='id9' class='form2'>
			<div class='form2b'>Delete Post</div>
			<div class='form2c'><input type='hidden' name='sForm' value='2'></div>
			<span>Index: </span><input type='number' name='sIndex' required> <input class='form2a' type='submit' value='DELETE'>
		</form>
		<div class='form2'>
			<div class='form2b'>Edit Post</div>
			<div class="form2c"></div>
			<span>Index: </span><input id='id14' type='number' name='sIndex'> <button id='id11' class='cl16'>GET</button><br><br>
			<textarea id='id12' class='form1b' name='s_content'></textarea><br>
			<button id='id13' class='cl16'>SET</button>
		</div>
	</div>
	<div id='id6' class='cl2'>
		<img class='cl4' src='media/image/add.png'>
		<div class='cl3'>Artist Management</div>
	</div>
	<div class='cl5' style='display:none;'>
		<form id='id15' class='form3' enctype='multipart/form-data'>
			<div class='form3h'>Add Artist</div>
			<div class='form3b'><span>Artist Name: </span><input type="text" name="s_name" required></div>
			<div class='form3b'><span>Artist Avatar: </span><input type="file" name="f_image" accept='image/*' required></div>
			<div id='id16' class='form3b'>
				<div class='form3e'><div class='form3f'></div><span>link image: </span><input type="hidden" name="link_image[]"><img class='form3d'><span class='form3c'>link text: </span><input type="text" name="link_text[]"><span class='form3c'>link: </span><input type="text" name="link[]"></div>
			</div>
			<div class='form3b'><span>About Artist:</span></div>
			<textarea class='form3a' name="s_about"></textarea>
			<div class='form3b'><input class='form3g' type="submit" value="SUBMIT"></div>
		</form>
		<form id='id18' class='form4'>
			<div class="form4a">Remove Artist</div>
			<div id="id19" class='form4b'></div>
		</form>
	</div>
	<div id='id6' class='cl2'>
		<img class='cl4' src='media/image/add.png'>
		<div class='cl3'><span id='id10'></span> Messages Awaiting Approval</div>
	</div>
	<div class='cl5' style='display:none;'>
		<?php
		for ($i = 0; $i < $i_comment_count; $i++) {
			$s_html = '';
			$s_html = "<div class='cl6'>
			<div class='cl10' data-index='{$a_index[$i]}' data-post-index='{$a_post_index[$i]}' data-ipa='{$a_ipa[$i]}'>
			<div class='cl11' data-action='1'><div class='cl14'>approve this comment</div><span>&#10004;</span></div>
			<div class='cl12' data-action='2'><div class='cl14'>decline this comment</div><span>&#10006;</span></div>
			<div class='cl13' data-action='3'><div class='cl15'>decline all comments from this person</div><span>&#10006;&#10006;</span></div></div><hr>
			<div class='cl7'>Post {$a_post_index[$i]}</div><div class='cl8'>{$a_name[$i]}</div><div class='cl9'>{$a_comment[$i]}</div></div>";
			echo $s_html;
		}
		?>
		<!--
		<div class='cl6'>
			<div class='cl10' data-index='' data-post-index='' data-ipa=''>
				<div class='cl11' data-action='1'><div class='cl14'>approve this comment</div><span>&#10004;</span></div>
				<div class='cl12' data-action='2'><div class='cl14'>decline this comment</div><span>&#10006;</span></div>
				<div class='cl13' data-action='3'><div class='cl15'>decline all comments from this person</div><span>&#10006;&#10006;</span></div>
			</div>
			<hr>
			<div class='cl7'>Post 1101</div>
			<div class='cl8'>Name</div>
			<div class='cl9'>Comment</div>
		</div>
		-->
	</div>
</div>
<?php require "footer.htm"; ?>
<script async>
// Variables
let i_comment_count = <?php echo $i_comment_count; ?>;
let o_cl2 = document.querySelectorAll('.cl2');
let a_artist_names = JSON.parse('<?php echo $j_artist_names; ?>');
let a_artist_names_filtered = a_artist_names.slice(0);

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

function f_artist_select(a_artists) {
	let o_new_element = document.createElement('select');
	o_new_element.classList.add('form1f');
	o_new_element.name = 'artists[]';
	a_artists.forEach(function(value) {
		let o_new_element_1 = document.createElement('option');
		o_new_element_1.value = value;
		o_new_element_1.innerHTML = value;
		o_new_element.append(o_new_element_1);
	});
	id17.append(o_new_element);
}

// Invoke
for (let i = 1; i < 20; i++) {
	let str = "const id" + i + " = document.getElementById('id" + i + "');";
	eval(str);
}

f_artist_select(a_artist_names);

id10.innerHTML = i_comment_count;

id16.firstElementChild.children[3].src = "media/image/question-mark.png";

(function() {
	let o_new_element = document.createElement('select');
	// o_new_element.classList.add('form1f');
	o_new_element.name = 'artist';
	a_artist_names.forEach(function(value) {
		let o_new_element_1 = document.createElement('option');
		o_new_element_1.value = value;
		o_new_element_1.innerHTML = value;
		o_new_element.append(o_new_element_1);
	});
	id19.append(o_new_element);
	let o_new_element_2 = document.createElement('input');
	o_new_element_2.type = 'submit';
	o_new_element_2.value = 'SUBMIT';
	o_new_element_2.classList.add('form4c');
	id19.append(o_new_element_2);
})();

(function() {
	let xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			if (this.responseText != '') {
				a_image_links = JSON.parse(this.responseText);
				a_image_links.forEach(function(value) {
					let o_new_element = document.createElement('img');
					o_new_element.src = "media/image/link/" + value;
					o_new_element.addEventListener('click', function() {
						id16.firstElementChild.children[3].src = this.src;
						id16.firstElementChild.children[0].style.display = "none";
						id16.firstElementChild.children[2].value = this.src;
					});
					id16.firstElementChild.children[0].appendChild(o_new_element);
				});
			}
		}
	};
	xhr.open('GET', "php/manage-link-images.php", true);
	xhr.send();
})();

o_cl2.forEach(function(value) {
	value.addEventListener('click', function(e) {
		let o_next_sibling = e.currentTarget.nextElementSibling;
		if (o_next_sibling.style.display == 'none') {
			o_next_sibling.style.display = 'block';
			e.currentTarget.firstElementChild.src = 'media/image/remove.png';
		} else {
			o_next_sibling.style.display = 'none';
			e.currentTarget.firstElementChild.src = 'media/image/add.png';
		}
	});
});

// Event Listeners
id2.addEventListener('focus', function() {
	id2.style.height = '200px';
	id3.style.display = 'none';
});
id2.addEventListener('blur', function() {
	if (id2.value == '') {
		id2.style.height = 'auto';
		id3.style.display = 'block';
	}
});

id4.addEventListener('change', function() {
	if (id4.value == '') {
		id1.style.display = 'block';
		id5.style.display = 'inline';
	} else {
		id1.style.display = 'none';
		id5.style.display = 'none';
	}
});

id8.addEventListener('submit', function(e) {
	e.preventDefault();
	let o_form = new FormData(id8);
	let xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			if (this.responseText != '') {
				let a_response = JSON.parse(this.responseText);
				f_sys_msg(a_response[0], a_response[1]);
				if (a_response[0] == 1) {
					id8.reset();
					id17.innerHTML = '';
					a_artist_names_filtered = a_artist_names.slice(0);
					f_artist_select(a_artist_names);
				}
			}
		}
	};
	xhr.open('POST', "php/add-post.php", true);
	xhr.send(o_form);
});

id9.addEventListener('submit', function(e) {
	e.preventDefault();
	let o_form = new FormData(id9);
	let xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			if (this.responseText != '') {
				let a_response = JSON.parse(this.responseText);
				f_sys_msg(a_response[0], a_response[1]);
				if (a_response[0] == 1) {
					id9.reset();
				}
			}
		}
	};
	xhr.open('POST', "php/delete-post.php", true);
	xhr.send(o_form);
});

id11.addEventListener('click', function() {
	let i_index = id14.value;
	let o_form = new FormData();
	o_form.append('i_index', i_index);
	let xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			if (this.responseText != '') {
				id12.value = this.responseText;
				id12.style.height = this.responseText.length / 3.5 + "px";
			}
		}
	};
	xhr.open('POST', "php/edit-get.php", true);
	xhr.send(o_form);
});

id13.addEventListener('click', function() {
	let i_index = id14.value;
	let s_content = id12.value;
	let o_form = new FormData();
	o_form.append('i_index', i_index);
	o_form.append('s_content', s_content);
	let xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			if (this.responseText != '') {
				let a_response = JSON.parse(this.responseText);
				f_sys_msg(a_response[0], a_response[1]);
				if (a_response[0] == 1) {
					id14.value = "";
					id12.value = "";
					id12.style.height = "auto";
				}
			}
		}
	};
	xhr.open('POST', "php/edit-set.php", true);
	xhr.send(o_form);
});

id15.addEventListener('submit', function(e) {
	e.preventDefault();
	let o_form = new FormData(id15);
	let xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			if (this.responseText != '') {
				let a_response = JSON.parse(this.responseText);
				f_sys_msg(a_response[0], a_response[1]);
				if (a_response[0] == 1) {
					id15.reset();
					while (id16.children.length > 1) {
						id16.firstElementChild.remove();
					}
				}
			}
		}
	};
	xhr.open('POST', "php/manage-add-artist.php", true);
	xhr.send(o_form);
});

id16.addEventListener('click', function(e) {
	if (id16.lastElementChild.children[3].src != "http://localhost/web/lanthirey/public/media/image/question-mark.png") {
		let o_new_element = document.createElement('div');
		o_new_element.classList.add('form3e');
		let o_new_element_8 = document.createElement('div');
		o_new_element_8.classList.add('form3f');
		a_image_links.forEach(function(value) {
			let o_new_element = document.createElement('img');
			o_new_element.src = "media/image/link/" + value;
			o_new_element.addEventListener('click', function() {
				this.parentElement.parentElement.children[3].src = this.src;
				this.parentElement.parentElement.children[0].style.display = "none";
				this.parentElement.parentElement.children[2].value = this.src;
			});
			o_new_element_8.append(o_new_element);
		})
		let o_new_element_1 = document.createElement('span');
		o_new_element_1.innerHTML = "link image: ";
		let o_new_element_2 = document.createElement('input');
		o_new_element_2.type = "hidden";
		o_new_element_2.name = "link_image[]";
		let o_new_element_3 = document.createElement('img');
		o_new_element_3.src = "http://localhost/web/lanthirey/public/media/image/question-mark.png";
		o_new_element_3.classList.add('form3d');
		o_new_element_3.addEventListener('click', function() {
			this.parentElement.children[0].style.display = "block";
		});
		let o_new_element_4 = document.createElement('span');
		o_new_element_4.classList.add('form3c');
		o_new_element_4.innerHTML = "link text: ";
		let o_new_element_5 = document.createElement('input');
		o_new_element_5.type = "text";
		o_new_element_5.name = "link_text[]";
		let o_new_element_6 = document.createElement('span');
		o_new_element_6.classList.add('form3c');
		o_new_element_6.innerHTML = "link: ";
		let o_new_element_7 = document.createElement('input');
		o_new_element_7.type = "text";
		o_new_element_7.name = "link[]";
		o_new_element.append(o_new_element_8, o_new_element_1, o_new_element_2, o_new_element_3, o_new_element_4, o_new_element_5, o_new_element_6, o_new_element_7);
		id16.append(o_new_element);
	}
});

id16.firstElementChild.children[3].addEventListener('click', function() {
	id16.firstElementChild.children[0].style.display = "block";
});

id17.addEventListener('click', function() {
	if (id17.lastElementChild.value != ' ') {
		let i_index = a_artist_names_filtered.indexOf(id17.lastElementChild.value);
		a_artist_names_filtered.splice(i_index, 1);
		f_artist_select(a_artist_names_filtered);
	}
});

id18.addEventListener('submit', function(e) {
	e.preventDefault();
	let o_form = new FormData(id18);
	let xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			if (this.responseText != '') {
				let a_response = JSON.parse(this.responseText);
				f_sys_msg(a_response[0], a_response[1]);
				if (a_response[0] == 1) {
					id18.reset();
				}
			}
		}
	};
	xhr.open('POST', "php/manage-remove-artist.php", true);
	xhr.send(o_form);
});

(function() {
	let o = document.querySelectorAll('.cl10 > div');
	o.forEach(function(value) {
		value.addEventListener('mouseover', function(e) {
			this.firstElementChild.style.visibility = 'visible';
		});
		value.addEventListener('mouseout', function(e) {
			this.firstElementChild.style.visibility = 'hidden';
		});
		value.addEventListener('click', function(e) {
			let o_form = new FormData();
			let i_action = this.dataset.action;
			let o_parent2 = this.parentElement.parentElement;
			let s_ipa = this.parentElement.dataset.ipa;
			o_form.append('action', this.dataset.action);
			o_form.append('index', this.parentElement.dataset.index);
			o_form.append('post_index', this.parentElement.dataset.postIndex);
			o_form.append('ipa', this.parentElement.dataset.ipa);
			let xhr = new XMLHttpRequest();
			xhr.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					if (this.responseText == 'true') {
						if (i_action == 1) {
							o_parent2.remove();
							id10.innerHTML = --i_comment_count;
						} else if (i_action == 2) {
							o_parent2.remove();
							id10.innerHTML = --i_comment_count;
							console.log(i_comment_count);
						} else {
							let o_ipa = document.querySelectorAll("[data-ipa='" + s_ipa + "']");
							console.log(o_ipa.length);
							i_comment_count -= o_ipa.length;
							id10.innerHTML = i_comment_count;
							o_ipa.forEach(function(value) {
								value.parentElement.remove();
							});
						}
					}
				}
			};
			xhr.open('POST', "php/comment-moderate.php", true);
			xhr.send(o_form);
		});
	});
})();
</script>
<script src="js/footer.js"></script>
<script src='js/random-pop.js' async></script>
</body>
</html>