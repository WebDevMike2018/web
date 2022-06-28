<?php
session_start();
require '../php/link.php';
$sPassword = file_get_contents('../php/password.txt');
function fVerified() {
	$_SESSION['bAccess'] = true;
	if (isset($_POST['sNewPassword'])) {
		file_put_contents('../php/password.txt', $_POST['sNewPassword']);
		setcookie('sPassword', $_POST['sNewPassword'], time()+30*24*60*60, "/");
		header('Location: manage.php');
	} else {
		setcookie('sPassword', $_POST['sPassword'], time()+30*24*60*60, "/");
		header('Location: manage');
	}
}
if (isset($_COOKIE['sPassword']) and $_COOKIE['sPassword'] == $sPassword) {
	fVerified();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$sAddress = $_SERVER["REMOTE_ADDR"];
	$sQuery = "SELECT * FROM fail_tracker WHERE cAddress = '$sAddress'";
	$result = mysqli_query($link, $sQuery);
	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);
		$cIndex = $row['cIndex'];
		$cFailTime = $row['cFailTime'];
		$cFailCount = $row['cFailCount'];
		$oNow = date_create();
		$oFailTime = date_create($cFailTime);
		if ($oNow > $oFailTime) {
			if ($_POST['sPassword'] == $sPassword) {
				$iFailCount = 0;
				$sNow = date_format($oNow, 'Y-m-d H:i:s');
				$sQuery1 = "UPDATE fail_tracker SET cFailCount = $iFailCount WHERE cIndex = $cIndex";
				mysqli_query($link, $sQuery1);
				fVerified();
			} else {
				$iFailCount = $cFailCount + 1;
				if ($iFailCount > 5) {
					$oFailTime = date_modify($oNow, '+5 minute');
					$sFailTime = date_format($oFailTime, 'Y-m-d H:i:s');
					$sQuery3 = "UPDATE fail_tracker SET cFailCount = $iFailCount, cFailTime = '$sFailTime' WHERE cIndex = $cIndex";
					mysqli_query($link, $sQuery3);
					$iWaitTime = 300;
				} else {
					$sQuery5 = "UPDATE fail_tracker SET cFailCount = $iFailCount WHERE cIndex = $cIndex";
					mysqli_query($link, $sQuery5);
					echo "You have entered an incorrect password. Please try again.";
				}
			}
		} else {
			$iWaitTime = date_timestamp_get($oFailTime) - date_timestamp_get($oNow);
		}
	} else {
		if ($_POST['sPassword'] == $sPassword) {
			fVerified();
		} else {
			$iFailCount = 1;
			$oNow = date_create();
			$sNow = date_format($oNow, 'Y-m-d H:i:s');
			$sQuery4 = "INSERT INTO fail_tracker (cAddress, cFailCount, cFailTime) VALUES ('$sAddress', $iFailCount, '$sNow')";
			mysqli_query($link, $sQuery4);
		}
	}
}
?>
<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset='utf-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<link rel='icon' href='media/image/favicon.png'>
	<link rel="stylesheet" href='css/login.css'>
	<title>Lanthirey Login</title>
</head>
<body>
<div id='id1'></div>
<div class='cl2'>
	<div class='cl3'>
		<div class='cl4'>Login</div>
		<form class='cl5' method='POST' action='login.php'>
			<input class='cl1' required autofocus type='text' name='sPassword' maxlength='32' placeholder='Password'><br><br>
			<input class='cl1 cl6' type='submit' value='Submit'>
		</form>
	</div>
	<div class='cl3'>
		<div class='cl4'>Change Password</div>
		<form class='cl5' method='POST' action='login.php'>
			<input class='cl1' required autofocus type='text' name='sPassword' maxlength='32' placeholder='Current Password'><br><br>
			<input class='cl1' required autofocus type='text' name='sNewPassword' maxlength='32' placeholder='New Password'><br><br>
			<input class='cl1 cl6' type='submit' value='Submit'>
		</form>
	</div>
</div>
<script async>
// Variables

// Functions

// Invoke
for (let i = 0; i < 2; i++) {
	let str = "const id" + i + " = document.getElementById('id" + i + "');";
	eval(str);
}
<?php
	if (isset($iWaitTime)) {
		echo "var iWaitTime = $iWaitTime;";
		include 'js/wait-time.js';
	}
?>
// Event Listeners
</script>
</body>
</html>