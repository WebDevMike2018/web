<?php

$s_password = "test";
$s_hash = "{BLF-CRYPT}" . password_hash($s_password, PASSWORD_BCRYPT);
echo $s_hash;

?>