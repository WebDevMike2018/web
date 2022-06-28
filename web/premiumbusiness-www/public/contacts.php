<?php

if (empty($_GET['req'])) {
	$_GET['req'] = "1";
	$b_req_empty = true;
}
if (empty($_GET['page'])) {
	$_GET['page'] = "1";
	$b_page_empty = true;
}
if (!empty($b_req_empty) || !empty($b_page_empty)) {
	$s_query = http_build_query($_GET);
	header("Location: contacts?{$s_query}");
}

require "html/contacts.html";

?>