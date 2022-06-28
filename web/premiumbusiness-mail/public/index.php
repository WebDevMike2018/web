<?php
if (empty($_SESSION['b_logged_in'])) {
	header("Location: login.php");
	exit;
}

require 'html/index.html';
?>