<?php

if (!empty($_SESSION['b_logged_in'])) {
	header("Location: contacts");
	exit;
}

require "html/login.html";

?>