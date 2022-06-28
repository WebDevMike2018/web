<?php

if (empty($_SESSION['b_logged_in'])) {
	header("Location: login");
	exit;
}

require "html/contacts-insert.html";

?>