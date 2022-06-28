<?php

$a_battleship_config = array();
$a_battleship_name = array();
$a_battleship_nation = array();
$a_battleship_tier = array();
$a_battleship_votes = array();

$a_carrier_config = array();
$a_carrier_name = array();
$a_carrier_nation = array();
$a_carrier_tier = array();
$a_carrier_votes = array();

$a_cruiser_config = array();
$a_cruiser_name = array();
$a_cruiser_nation = array();
$a_cruiser_tier = array();
$a_cruiser_votes = array();

$a_destroyer_config = array();
$a_destroyer_name = array();
$a_destroyer_nation = array();
$a_destroyer_tier = array();
$a_destroyer_votes = array();

function f_get_flag($s_nation) {
	switch ($s_nation) {
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
}

function f_get_icon($s_type) {
	switch ($s_type) {
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
}

function f_get_tier($s_tier) {
	switch ($s_tier) {
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
}

function f_get_skill_img($s_config) {
	parse_str($s_config);
	$a_skills = explode(",", $skills);
	$s_skill_img = "";
	foreach ($a_skills as $value) {
		$s_skill_img .= "<img src='media/image/skill/{$type}/{$value}.png'>";
	}
	return $s_skill_img;
}

$sql = "SELECT * FROM t_submission WHERE s_type = 'battleship' ORDER BY i_votes DESC LIMIT 3";
require '../php/link.php';
$result = mysqli_query($link, $sql);
while ($row = mysqli_fetch_row($result)) {
	$a_battleship_name[] = $row[1];
	$a_battleship_config[] = $row[3];
	$a_battleship_votes[] = $row[4];
}
foreach ($a_battleship_name as $value) {
	$sql = "SELECT nation, tier FROM t_ships WHERE name = '{$value}'";
	$result = mysqli_query($link, $sql);
	$row = mysqli_fetch_row($result);
	$a_battleship_nation[] = $row[0];
	$a_battleship_tier[] = $row[1];
}

$sql = "SELECT * FROM t_submission WHERE s_type = 'carrier' ORDER BY i_votes DESC LIMIT 3";
$result = mysqli_query($link, $sql);
while ($row = mysqli_fetch_row($result)) {
	$a_carrier_name[] = $row[1];
	$a_carrier_config[] = $row[3];
	$a_carrier_votes[] = $row[4];
}
foreach ($a_carrier_name as $value) {
	$sql = "SELECT nation, tier FROM t_ships WHERE name = '{$value}'";
	$result = mysqli_query($link, $sql);
	$row = mysqli_fetch_row($result);
	$a_carrier_nation[] = $row[0];
	$a_carrier_tier[] = $row[1];
}

$sql = "SELECT * FROM t_submission WHERE s_type = 'cruiser' ORDER BY i_votes DESC LIMIT 3";
$result = mysqli_query($link, $sql);
while ($row = mysqli_fetch_row($result)) {
	$a_cruiser_name[] = $row[1];
	$a_cruiser_config[] = $row[3];
	$a_cruiser_votes[] = $row[4];
}
foreach ($a_cruiser_name as $value) {
	$sql = "SELECT nation, tier FROM t_ships WHERE name = '{$value}'";
	$result = mysqli_query($link, $sql);
	$row = mysqli_fetch_row($result);
	$a_cruiser_nation[] = $row[0];
	$a_cruiser_tier[] = $row[1];
}

$sql = "SELECT * FROM t_submission WHERE s_type = 'destroyer' ORDER BY i_votes DESC LIMIT 3";
$result = mysqli_query($link, $sql);
while ($row = mysqli_fetch_row($result)) {
	$a_destroyer_name[] = $row[1];
	$a_destroyer_config[] = $row[3];
	$a_destroyer_votes[] = $row[4];
}
foreach ($a_destroyer_name as $value) {
	$sql = "SELECT nation, tier FROM t_ships WHERE name = '{$value}'";
	$result = mysqli_query($link, $sql);
	$row = mysqli_fetch_row($result);
	$a_destroyer_nation[] = $row[0];
	$a_destroyer_tier[] = $row[1];
}

$sql = "UPDATE t_visitor_counter SET i_count = i_count + 1 WHERE i_index = 1";
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
<link rel='stylesheet' href='css/index.css?ver=5'>
<title>WoW Club</title>
</head>
<body>
<div id='sys_msg' class='sys_msg'></div>
<?php include 'header.htm'; ?>
<div class='cl8'>
	<div class='search1'>
		<div class='search2'><input id='search1' class='search3' type='text' placeholder='Search Ship' autofocus></div>
		<div class='search4'><div id='search2' class='search5'></div></div>
	</div>
	<div>
		<div class='cl1'>
			<a href='built.php<?php echo $a_destroyer_config[0]; ?>'>
				<div>
					<div class='cl4'><?php echo $a_destroyer_votes[0]; ?></div>
					<div class='cl2'><?php echo $a_destroyer_name[0]; ?></div>
					<div class='cl9'>
						<img class='cl5' src='<?php echo f_get_flag($a_destroyer_nation[0]); ?>'>
						<img class='cl6' src='<?php echo f_get_icon('destroyer'); ?>'>
						<span class='cl7'><?php echo f_get_tier($a_destroyer_tier[0]); ?></span>
					</div>
					<div class='cl10'><?php echo f_get_skill_img($a_destroyer_config[0]); ?></div>
				</div>
			</a>
			<a href='built.php<?php echo $a_destroyer_config[1]; ?>'>
				<div>
					<div class='cl4'><?php echo $a_destroyer_votes[1]; ?></div>
					<div class='cl2'><?php echo $a_destroyer_name[1]; ?></div>
					<div class='cl9'>
						<img class='cl5' src='<?php echo f_get_flag($a_destroyer_nation[1]); ?>'>
						<img class='cl6' src='<?php echo f_get_icon('destroyer'); ?>'>
						<span class='cl7'><?php echo f_get_tier($a_destroyer_tier[1]); ?></span>
					</div>
					<div class='cl10'><?php echo f_get_skill_img($a_destroyer_config[1]); ?></div>
				</div>
			</a>
			<a href='built.php<?php echo $a_destroyer_config[2]; ?>'>
				<div>
					<div class='cl4'><?php echo $a_destroyer_votes[2]; ?></div>
					<div class='cl2'><?php echo $a_destroyer_name[2]; ?></div>
					<div class='cl9'>
						<img class='cl5' src='<?php echo f_get_flag($a_destroyer_nation[2]); ?>'>
						<img class='cl6' src='<?php echo f_get_icon('destroyer'); ?>'>
						<span class='cl7'><?php echo f_get_tier($a_destroyer_tier[2]); ?></span>
					</div>
					<div class='cl10'><?php echo f_get_skill_img($a_destroyer_config[2]); ?></div>
				</div>
			</a>
		</div>
		<div class='cl1'>
			<a href='built.php<?php echo $a_cruiser_config[0]; ?>'>
				<div>
					<div class='cl4'><?php echo $a_cruiser_votes[0]; ?></div>
					<div class='cl2'><?php echo $a_cruiser_name[0]; ?></div>
					<div class='cl9'>
						<img class='cl5' src='<?php echo f_get_flag($a_cruiser_nation[0]); ?>'>
						<img class='cl6' src='<?php echo f_get_icon('cruiser'); ?>'>
						<span class='cl7'><?php echo f_get_tier($a_cruiser_tier[0]); ?></span>
					</div>
					<div class='cl10'><?php echo f_get_skill_img($a_cruiser_config[0]); ?></div>
				</div>
			</a>
			<a href='built.php<?php echo $a_cruiser_config[1]; ?>'>
				<div>
					<div class='cl4'><?php echo $a_cruiser_votes[1]; ?></div>
					<div class='cl2'><?php echo $a_cruiser_name[1]; ?></div>
					<div class='cl9'>
						<img class='cl5' src='<?php echo f_get_flag($a_cruiser_nation[1]); ?>'>
						<img class='cl6' src='<?php echo f_get_icon('cruiser'); ?>'>
						<span class='cl7'><?php echo f_get_tier($a_cruiser_tier[1]); ?></span>
					</div>
					<div class='cl10'><?php echo f_get_skill_img($a_cruiser_config[1]); ?></div>
				</div>
			</a>
			<a href='built.php<?php echo $a_cruiser_config[2]; ?>'>
				<div>
					<div class='cl4'><?php echo $a_cruiser_votes[2]; ?></div>
					<div class='cl2'><?php echo $a_cruiser_name[2]; ?></div>
					<div class='cl9'>
						<img class='cl5' src='<?php echo f_get_flag($a_cruiser_nation[2]); ?>'>
						<img class='cl6' src='<?php echo f_get_icon('cruiser'); ?>'>
						<span class='cl7'><?php echo f_get_tier($a_cruiser_tier[2]); ?></span>
					</div>
					<div class='cl10'><?php echo f_get_skill_img($a_cruiser_config[2]); ?></div>
				</div>
			</a>
		</div>
		<div class='cl1'>
			<a href='built.php<?php echo $a_battleship_config[0]; ?>'>
				<div>
					<div class='cl4'><?php echo $a_battleship_votes[0]; ?></div>
					<div class='cl2'><?php echo $a_battleship_name[0]; ?></div>
					<div class='cl9'>
						<img class='cl5' src='<?php echo f_get_flag($a_battleship_nation[0]); ?>'>
						<img class='cl6' src='<?php echo f_get_icon('battleship'); ?>'>
						<span class='cl7'><?php echo f_get_tier($a_battleship_tier[0]); ?></span>
					</div>
					<div class='cl10'><?php echo f_get_skill_img($a_battleship_config[0]); ?></div>
				</div>
			</a>
			<a href='built.php<?php echo $a_battleship_config[1]; ?>'>
				<div>
					<div class='cl4'><?php echo $a_battleship_votes[1]; ?></div>
					<div class='cl2'><?php echo $a_battleship_name[1]; ?></div>
					<div class='cl9'>
						<img class='cl5' src='<?php echo f_get_flag($a_battleship_nation[1]); ?>'>
						<img class='cl6' src='<?php echo f_get_icon('battleship'); ?>'>
						<span class='cl7'><?php echo f_get_tier($a_battleship_tier[1]); ?></span>
					</div>
					<div class='cl10'><?php echo f_get_skill_img($a_battleship_config[1]); ?></div>
				</div>
			</a>
			<a href='built.php<?php echo $a_battleship_config[2]; ?>'>
				<div>
					<div class='cl4'><?php echo $a_battleship_votes[2]; ?></div>
					<div class='cl2'><?php echo $a_battleship_name[2]; ?></div>
					<div class='cl9'>
						<img class='cl5' src='<?php echo f_get_flag($a_battleship_nation[2]); ?>'>
						<img class='cl6' src='<?php echo f_get_icon('battleship'); ?>'>
						<span class='cl7'><?php echo f_get_tier($a_battleship_tier[2]); ?></span>
					</div>
					<div class='cl10'><?php echo f_get_skill_img($a_battleship_config[2]); ?></div>
				</div>
			</a>
		</div>
		<div class='cl1'>
			<a href='built.php<?php echo $a_carrier_config[0]; ?>'>
				<div>
					<div class='cl4'><?php echo $a_carrier_votes[0]; ?></div>
					<div class='cl2'><?php echo $a_carrier_name[0]; ?></div>
					<div class='cl9'>
						<img class='cl5' src='<?php echo f_get_flag($a_carrier_nation[0]); ?>'>
						<img class='cl6' src='<?php echo f_get_icon('carrier'); ?>'>
						<span class='cl7'><?php echo f_get_tier($a_carrier_tier[0]); ?></span>
					</div>
					<div class='cl10'><?php echo f_get_skill_img($a_carrier_config[0]); ?></div>
				</div>
			</a>
			<a href='built.php<?php echo $a_carrier_config[1]; ?>'>
				<div>
					<div class='cl4'><?php echo $a_carrier_votes[1]; ?></div>
					<div class='cl2'><?php echo $a_carrier_name[1]; ?></div>
					<div class='cl9'>
						<img class='cl5' src='<?php echo f_get_flag($a_carrier_nation[1]); ?>'>
						<img class='cl6' src='<?php echo f_get_icon('carrier'); ?>'>
						<span class='cl7'><?php echo f_get_tier($a_carrier_tier[1]); ?></span>
					</div>
					<div class='cl10'><?php echo f_get_skill_img($a_carrier_config[1]); ?></div>
				</div>
			</a>
			<a href='built.php<?php echo $a_carrier_config[2]; ?>'>
				<div>
					<div class='cl4'><?php echo $a_carrier_votes[2]; ?></div>
					<div class='cl2'><?php echo $a_carrier_name[2]; ?></div>
					<div class='cl9'>
						<img class='cl5' src='<?php echo f_get_flag($a_carrier_nation[2]); ?>'>
						<img class='cl6' src='<?php echo f_get_icon('carrier'); ?>'>
						<span class='cl7'><?php echo f_get_tier($a_carrier_tier[2]); ?></span>
					</div>
					<div class='cl10'><?php echo f_get_skill_img($a_carrier_config[2]); ?></div>
				</div>
			</a>
		</div>
	</div>
</div>
<script>
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