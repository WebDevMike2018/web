<?php

$a_day = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
$a_month = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
$a_number = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
$a_number_string = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
$a_alphabet_uppercase = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];
$a_alphabet_lowercase = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"];
$a_alpha_numeric = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"];
$a_alpha_numeric_safe = ["2", "3", "4", "5", "6", "7", "8", "9", "A", "B", "C", "D", "E", "F", "G", "H", "J", "K", "L", "M", "N", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"];

// create empty object
$o_var = new stdClass;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if ($_POST['req'] == 1) {

	}
}

// declare multiple variables with same value
$x = $y = "";

// mysqli query num_rows
require '../../db-file.php';
$s_query = "";
$o_stmt = $o_sql->prepare($s_query);
$o_stmt->bind_param();
$o_stmt->execute();
$o_stmt->store_result();
$o_stmt->num_rows;
$o_stmt->free_result();
$o_stmt->close();
$o_sql->close();

// mysqli prepared add try/catch
require '../../db-file.php';
$s_query = "SELECT c_user FROM t_users WHERE c_name = ?";
$o_stmt = $o_sql->prepare($s_query);
$o_stmt->bind_param("s", $s_name);
$o_stmt->execute();
$o_stmt->bind_result($c1);
while ($o_stmt->fetch()) {
	$a1[] = $c1;
}
$o_stmt->close();
$o_sql->close();

// mysqli query
require '../../db-file.php';
$s_query = "";
$o_result = $o_sql->query($s_query);
while ($a_row = $o_result->fetch_row()) {
	// $a_row[0]
}
$o_sql->close();

// COOKIE
$a_cookie = [
	"expires" => time()+60*60*24*365,
	"path" => "/",
	"secure" => true,
	"samesite" => "Strict"
];
setcookie("name", "value", $a_cookie);

// Filter array with anonymous function and repack
$a_number = ['one', 'two', 'three', 'four', 'five'];
$numbers_filter = array_filter($numbers, function($value) {
	if($value != 'three') {
		return true;
	}
});
$numbers = array_values($numbers_filter);
print_r($numbers);
// output: Array ( [0] => one [1] => two [2] => four [3] => five )

// mail
$s_to = "";
$s_subject = "";
$s_message = file_get_contents("mail.html");
$a_headers = [
	"MIME-Version" => "1.0",
	"Content-type" => "text/html; charset=iso-8859-1",
	"To" => "Michael <{$s_to}>",
	"From" => "Server <server@premiumbusiness.site>",
	"Reply-To" => "server@premiumbusiness.site"
];
mail($s_to, $s_subject, $s_message, $a_headers);

// password generator
function f_password_generator($i_length) {
	$i_length = empty($i_length) ? 16 : $i_length;
	$a_alpha_numeric_safe = ["2", "3", "4", "5", "6", "7", "8", "9", "A", "B", "C", "D", "E", "F", "G", "H", "J", "K", "L", "M", "N", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"];
	$i_a_length = count($a_alpha_numeric_safe) - 1;
	$s_password = "";
	for ($i = 0; $i < $i_length; $i++) {
		$s_password .= $a_alpha_numeric_safe[rand(0, $i_a_length)];
	}
	return $s_password;
}

?>