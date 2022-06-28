<?php

$s1 = $_SERVER["REQUEST_URI"];
$s1 = ltrim($s1, "/");
$a1 = explode("/", $s1);
//$a1[3] dev /web/quizzer1/public/
//$a1[0] prod
switch ($a1[3]) {
	case "poll":
		require "php/poll.php";
		break;
	case "poll-create":
		require "php/poll-create.php";
		break;
	case "quiz":
		require "php/quiz.php";
		break;
	case "quiz-create":
		require "php/quiz-create.php";
		break;
	default:
		require "php/index.php";
}

?>