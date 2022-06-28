<?php
switch ($_GET['type']) {
	case "destroyer":
		$sql = "SELECT v_skill FROM t_destroyer_skills";
		break;
	case "cruiser":
		$sql = "SELECT v_skill FROM t_cruiser_skills";
		break;
	case "battleship":
		$sql = "SELECT v_skill FROM t_battleship_skills";
		break;
	case "carrier":
		$sql = "SELECT v_skill FROM t_carrier_skills";
		break;
	default:
		$sql = "";
}
if ($sql != "") {
	$a_skills = array();
	require '../php/link.php';
	$stmt = mysqli_stmt_init($link);
	mysqli_stmt_prepare($stmt, $sql);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $v_skill);
	while (mysqli_stmt_fetch($stmt)) {
		$a_skills[] = $v_skill;
	}
	mysqli_stmt_close($stmt);
	mysqli_close($link);
}

require '../php/link.php';
$sql = "UPDATE t_visitor_counter SET i_count = i_count + 1 WHERE i_index = 2";
mysqli_query($link, $sql);
mysqli_close($link);
?>
<!DOCTYPE html>
<html lang='en'>
<head>
<meta charset='utf-8'>
<meta name='viewport' content='width=device-width, initial-scale=1.0'>
<meta name='author' content='Michael Griffiths (contact@webdevmike.com)'>
<meta name='description' content='world of warships commander calculator'>
<link rel='shortcut icon' href='media/image/favicon.png'>
<link rel='stylesheet' href='css/header.css'>
<link rel='stylesheet' href='css/build.css?ver=6'>
<title>WoW Club Build</title>
</head>
<body>
<div id='sys_msg' class='sys_msg'></div>
<?php include 'header.htm'; ?>
<div class='search1'>
	<div class='search2'><input id='search1' class='search3' type='text' placeholder='Search Ship'></div>
	<div class='search4'><div id='search2' class='search5'></div></div>
</div>
<div class='cl12'>
	<div id='id1' class='cl1'></div>
	<div class='cl2'>
		<img id='id2' class='cl20'>
		<img id='id3' class='cl3'>
		<span id='id4' class='cl4'></span>
	</div>
	<div class='cl5'>
		<div id='id13' class='cl7'>
			<div class='cl25'>
				<a id='id7' class='cl29'></a>
				<div id='id8' class='cl26'><span id='id10' class='cl28'></span></div>
				<div id='id9' class='cl27'></div>
			</div>
			<div class='cl24'>
				<div class='cl6'>Commander Skills</div>
				<div class='cl8'>
					<div>Points Available: <span id='id5' class='cl23'></span></div>
					<div>Points Spent: <span id='id6'></span></div>
				</div>
				<div class='cl9'>
					<div data-index='1' data-cost='1' data-selected='0'><img class='cl10'><?php echo $a_skills[0]; ?></div>
					<div data-index='2' data-cost='1' data-selected='0'><img class='cl10'><?php echo $a_skills[1]; ?></div>
					<div data-index='3' data-cost='1' data-selected='0'><img class='cl10'><?php echo $a_skills[2]; ?></div>
					<div data-index='4' data-cost='1' data-selected='0'><img class='cl10'><?php echo $a_skills[3]; ?></div>
					<div data-index='5' data-cost='1' data-selected='0'><img class='cl10'><?php echo $a_skills[4]; ?></div>
					<div data-index='6' data-cost='1' data-selected='0'><img class='cl10'><?php echo $a_skills[5]; ?></div>
				</div>
				<hr class='cl11'>
				<div class='cl9'>
					<div data-index='7' data-cost='2' data-selected='0'><img class='cl10'><?php echo $a_skills[6]; ?></div>
					<div data-index='8' data-cost='2' data-selected='0'><img class='cl10'><?php echo $a_skills[7]; ?></div>
					<div data-index='9' data-cost='2' data-selected='0'><img class='cl10'><?php echo $a_skills[8]; ?></div>
					<div data-index='10' data-cost='2' data-selected='0'><img class='cl10'><?php echo $a_skills[9]; ?></div>
					<div data-index='11' data-cost='2' data-selected='0'><img class='cl10'><?php echo $a_skills[10]; ?></div>
					<div data-index='12' data-cost='2' data-selected='0'><img class='cl10'><?php echo $a_skills[11]; ?></div>
				</div>
				<hr class='cl11'>
				<div class='cl9'>
					<div data-index='13' data-cost='3' data-selected='0'><img class='cl10'><?php echo $a_skills[12]; ?></div>
					<div data-index='14' data-cost='3' data-selected='0'><img class='cl10'><?php echo $a_skills[13]; ?></div>
					<div data-index='15' data-cost='3' data-selected='0'><img class='cl10'><?php echo $a_skills[14]; ?></div>
					<div data-index='16' data-cost='3' data-selected='0'><img class='cl10'><?php echo $a_skills[15]; ?></div>
					<div data-index='17' data-cost='3' data-selected='0'><img class='cl10'><?php echo $a_skills[16]; ?></div>
					<div data-index='18' data-cost='3' data-selected='0'><img class='cl10'><?php echo $a_skills[17]; ?></div>
				</div>
				<hr class='cl11'>
				<div class='cl9'>
					<div data-index='19' data-cost='4' data-selected='0'><img class='cl10'><?php echo $a_skills[18]; ?></div>
					<div data-index='20' data-cost='4' data-selected='0'><img class='cl10'><?php echo $a_skills[19]; ?></div>
					<div data-index='21' data-cost='4' data-selected='0'><img class='cl10'><?php echo $a_skills[20]; ?></div>
					<div data-index='22' data-cost='4' data-selected='0'><img class='cl10'><?php echo $a_skills[21]; ?></div>
					<div data-index='23' data-cost='4' data-selected='0'><img class='cl10'><?php echo $a_skills[22]; ?></div>
					<div data-index='24' data-cost='4' data-selected='0'><img class='cl10'><?php echo $a_skills[23]; ?></div>
				</div>
			</div>
		</div>
		<div id='id14' class='cl32'>
			<div id='id11' class='cl34'></div>
			<div id='id12'></div>
		</div>
	</div>
</div>
<script>
// Variables
const o_url = new URL(window.location);
const s_type = o_url.searchParams.get("type");
const s_nation = o_url.searchParams.get("nation");
const s_tier = o_url.searchParams.get("tier");
const s_name = o_url.searchParams.get("name");
const s_base = "nation=" + s_nation + "&type=" + s_type + "&tier=" + s_tier + "&name=" + s_name;
const s_reset = "build.php?" + s_base;
var s_skills = o_url.searchParams.get("skills");
var i_points_available = 21;
var i_points_spent = 0;
var a_skills, i_row1, i_row2, i_row3, i_row4;
i_row1 = i_row2 = i_row3 = i_row4 = 0;

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
for (let i = 1; i < 15; i++) {
	let str = "const id" + i + " = document.getElementById('id" + i + "');";
	eval(str);
}

id1.innerHTML = s_name;
id5.innerHTML = i_points_available;
id6.innerHTML = i_points_spent;
id7.href = s_reset;

// flag
(function() {
	let x = function() {
		switch (s_nation) {
			case "usa":
				return "media/image/flag/usa.png";
				break;
			case "japan":
				return "media/image/flag/japan.png";
				break;
			case "ussr":
				return "media/image/flag/ussr.png";
				break;
			case "germany":
				return "media/image/flag/germany.png";
				break;
			case "uk":
				return "media/image/flag/united_kingdom.png";
				break;
			case "commonwealth":
				return "media/image/flag/commonwealth.png";
				break;
			case "france":
				return "media/image/flag/france.png";
				break;
			case "italy":
				return "media/image/flag/italy.png";
				break;
			case "pan_asia":
				return "media/image/flag/pan_asia.png";
				break;
			case "europe":
				return "media/image/flag/europe.png";
				break;
			case "pan_america":
				return "media/image/flag/pan_america.png";
		}
	};
	id2.src = x();
})();
// type
(function() {
	let x = function() {
		switch (s_type) {
			case "destroyer":
				return "media/image/ship_icon/destroyer.png";
				break;
			case "cruiser":
				return "media/image/ship_icon/cruiser.png";
				break;
			case "battleship":
				return "media/image/ship_icon/battleship.png";
				break;
			case "carrier":
				return "media/image/ship_icon/carrier.png";
		}
	};
	id3.src = x();
})();
// tier
(function() {
	let x = function() {
		switch (parseInt(s_tier)) {
			case 1:
				return "I";
				break;
			case 2:
				return "II";
				break;
			case 3:
				return "III";
				break;
			case 4:
				return "IV";
				break;
			case 5:
				return "V";
				break;
			case 6:
				return "VI";
				break;
			case 7:
				return "VII";
				break;
			case 8:
				return "VIII";
				break;
			case 9:
				return "IX";
				break;
			case 10:
				return "X";
		}
	};
	id4.innerHTML = x();
})();
// skill image
(function() {
	let x = document.querySelectorAll('.cl10');
	for (let i = 0; i < x.length; i++) {
		x[i].src = "media/image/skill/" + s_type + "/" + (i + 1) + ".png";
	}
})();
// click
(function() {
	let x = document.querySelectorAll('.cl9 > div');
	x.forEach(function(value) {
		value.addEventListener('mouseover', function() {
			this.children[1].style.display = "block";
		});
		value.addEventListener('mouseout', function() {
			this.children[1].style.display = "none";
		});
		value.addEventListener('click', function() {
			this.children[1].style.display = "none";
			let i_index = this.dataset.index;
			let i_cost = parseInt(this.dataset.cost);
			let b_selected = this.dataset.selected;
			if (b_selected == 0) {
				if (i_cost > i_points_available) { f_sys_msg(0, "You don't have enough points to master this skill."); return; }
				switch (i_cost) {
					case 1:
						i_row1 += 1;
						break;
					case 2:
						if (i_row1 == 0) { f_sys_msg(0, "You must master a skill from the previous row before you can master a skill from this row."); return; }
						i_row2 += 1;
						break;
					case 3:
						if (i_row2 == 0) { f_sys_msg(0, "You must master a skill from the previous row before you can master a skill from this row."); return; }
						i_row3 += 1;
						break;
					case 4:
						if (i_row3 == 0) { f_sys_msg(0, "You must master a skill from the previous row before you can master a skill from this row."); return; }
						i_row4 += 1;
				}
				this.dataset.selected = "1";
				this.style.border = "1px solid white";
				this.children[0].style.filter = "none";
				i_points_available -= i_cost;
				id5.innerHTML = i_points_available;
				i_points_spent += i_cost;
				id6.innerHTML = i_points_spent;
				if (!a_skills.find(function(value) { return value == i_index; })) {
					a_skills.push(i_index);
					a_skills.sort(function(a, b) { return parseInt(a) - parseInt(b); });
					o_url.searchParams.set("skills", a_skills.toString());
					history.pushState({}, "", decodeURIComponent(o_url.href));
				}
			} else {
				switch (i_cost) {
					case 1:
						if (i_row2 > 0 && i_row1 == 1) { f_sys_msg(0, "You must unlearn the skills from the next row before you can unlearn the skills from this row."); return; }
						i_row1 -= 1;
						break;
					case 2:
						if (i_row3 > 0 && i_row2 == 1) { f_sys_msg(0, "You must unlearn the skills from the next row before you can unlearn the skills from this row."); return; }
						i_row2 -= 1;
						break;
					case 3:
						if (i_row4 > 0 && i_row3 == 1) { f_sys_msg(0, "You must unlearn the skills from the next row before you can unlearn the skills from this row."); return; }
						i_row3 -= 1;
						break;
					case 4:
						i_row4 -= 1;
				}
				this.dataset.selected = "0";
				this.style.border = "1px solid transparent";
				this.children[0].style.filter = "brightness(50%)";
				i_points_available += i_cost;
				id5.innerHTML = i_points_available;
				i_points_spent -= i_cost;
				id6.innerHTML = i_points_spent;
				if (a_skills.find(function(value) { return value == i_index; })) {
					let i_index1 = a_skills.indexOf(i_index);
					a_skills.splice(i_index1, 1);
					a_skills.sort(function(a, b) { return parseInt(a) - parseInt(b); });
					o_url.searchParams.set("skills", a_skills.toString());
					history.pushState({}, "", decodeURIComponent(o_url.href));
				}
			}
			if (i_points_spent == 0) { id6.style.color = "white"; } else { id6.style.color = "red"; }
			if (i_points_available == 0) { id5.style.color = "white"; } else { id5.style.color = "lime"; }
		});
	});
})();
// initial skills
(function() {
	if (s_skills) {
		a_skills = s_skills.split(",");
		a_skills.sort(function(a, b) { return parseInt(a) - parseInt(b); });
		o_url.searchParams.set("skills", a_skills.toString());
		history.pushState({}, "", decodeURIComponent(o_url.href));
		a_skills.forEach(function(value, index) {
			let x = document.querySelector("[data-index='" + value + "']");
			x.click();
		});
	} else {
		a_skills = [];
	}
})();
// top builds
(function() {
	let xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			if (this.responseText != '') {
				id11.innerHTML = "Popular builds for " + s_name;
				let a_response = JSON.parse(this.responseText);
				for (let i = 0; i < a_response[1].length; i++) {
					let o_new_element = document.createElement('div');
					o_new_element.style.marginTop = "16px";
					let o_new_element_1 = document.createElement('div');
					o_new_element_1.classList.add('cl33');
					o_new_element_1.innerHTML = a_response[1][i];
					if (a_response[1][i] > 0) {
						o_new_element_1.style.color = "lime";
					} else if (a_response[1][i] < 0) {
						o_new_element_1.style.color = "red";
					} else {
						o_new_element_1.style.color = "white";
					}
					let o_new_element_2 = document.createElement('div');
					o_new_element_2.classList.add('cl35');
					let o_search_params = new URLSearchParams(a_response[0][i]);
					let s_skills = o_search_params.get("skills");
					let a_skills = s_skills.split(",");
					a_skills.forEach(function(value) {
						let o_new_element_5 = document.createElement('div');
						let o_new_element_3 = document.createElement('img');
						o_new_element_3.src = "media/image/skill/" + s_type + "/" + value + ".png";
						o_new_element_3.classList.add('cl10');
						o_new_element_5.appendChild(o_new_element_3);
						o_new_element_2.appendChild(o_new_element_5);
					})
					o_new_element.appendChild(o_new_element_1);
					o_new_element.appendChild(o_new_element_2);
					let o_new_element_4 = document.createElement('a');
					o_new_element_4.href = "built.php" + a_response[0][i];
					o_new_element_4.style.color = "white";
					o_new_element_4.appendChild(o_new_element);
					id12.appendChild(o_new_element_4);
				}
				id14.style.display = "block";
			}
		}
	};
	xhr.open('GET', "php/top-builds.php?name=" + s_name, true);
	xhr.send();
})();

id7.addEventListener('mouseover', function() {
	id8.style.textAlign = "left";
	id10.style.padding = "1px";
	id10.innerHTML = "Reset Skills";
});
id7.addEventListener('mouseout', function() {
	id10.style.padding = "0";
	id10.innerHTML = "";
});
id9.addEventListener('mouseover', function() {
	id8.style.textAlign = "right";
	id10.style.padding = "1px";
	id10.innerHTML = "Submit for community review";
});
id9.addEventListener('mouseout', function() {
	id10.style.padding = "0";
	id10.innerHTML = "";
});
id9.addEventListener('click', function() {
	if (i_points_available == 0) {
		let s_url = window.location.search;
		let xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				if (this.responseText != '') {
					let a_response = JSON.parse(this.responseText);
					f_sys_msg(a_response[0], a_response[1]);
					if (a_response[0] == 1) {
						setTimeout(function() {
							location.assign("built.php" + location.search);
						}, 3000);
					}
				}
			}
		};
		xhr.open('GET', "php/build-submit.php" + s_url, true);
		xhr.send();
	} else {
		f_sys_msg(0, "You must spend all points before submission.");
	}
});
document.getElementById('search1').addEventListener('input', function(e) {
	let search2 = document.getElementById('search2');
	let q = this.value;
	if (q === '') { search2.innerHTML = ''; return; }
	if (q.search(/[^A-Za-z0-9\-\.]/) != -1) { return; }
	if (q.length < 2) { return; }
	let xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			if (this.responseText != '') {
				let a_response = JSON.parse(this.responseText);
				if (a_response[0] === 1) {
					search2.innerHTML = a_response[1];
				}
			}
		}
	};
	xhr.open('GET', "php/search.php?q=" + q, true);
	xhr.send();
});
</script>
</body>
</html>