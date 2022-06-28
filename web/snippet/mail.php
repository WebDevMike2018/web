<?php

$s_to = "webdevmike2018@gmail.com";
$s_subject = "Test";
$s_message = file_get_contents("mail.html");
$a_headers = [
	"MIME-Version" => "1.0",
	"Content-type" => "text/html; charset=iso-8859-1",
	"To" => "Michael <{$s_to}>",
	"From" => "Server <server@premiumbusiness.site>",
	"Reply-To" => "server@premiumbusiness.site"
];
mail($s_to, $s_subject, $s_message, $a_headers);

?>