<?php

$s_email = "test5@premiumbusiness.site";
require '../../db-mailserver.php';
$s_query = "DELETE FROM virtual_users WHERE email = ?";
$o_stmt = $o_sql->prepare($s_query);
$o_stmt->bind_param("s", $s_email);
if ($o_stmt->execute()) {
	echo "success";
} else {
	echo "failure";
}

?>