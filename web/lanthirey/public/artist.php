<?php
parse_str($_SERVER['QUERY_STRING'], $a_get);
$sql = "SELECT * FROM t_artist WHERE i_index = ?";
require '../php/link.php';
$stmt = mysqli_stmt_init($link);
mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_bind_param($stmt, "i", $a_get['index']);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $i_index, $s_name, $s_about, $s_avatar, $s_links, $j_posts);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);
mysqli_close($link);

$a_links = json_decode($s_links);
$s_links = "";
for ($i = 0; $i < count($a_links[0]); $i++) {
	$s_links .= "<a class='cl6' href='{$a_links[2][$i]}' target='_blank'><img class='cl9' src='{$a_links[0][$i]}'><span>{$a_links[1][$i]}</span></a>";
}

$a_posts = json_decode($j_posts);
$i_posts = count($a_posts);
$s_posts = implode(",", $a_posts);
?>
<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name='description' content='waxing poetic, waning attention span'>
	<meta name='keywords' content='poem, art'>
	<meta property='og:type' content='website'>
	<meta property='og:url' content='https://lanthirey.xyz'>
	<meta property='og:title' content='Lanthirey'>
	<meta property='og:description' content='waxing poetic, waning attention span'>
	<meta property='og:image' content='media/image/social.png'>
	<link rel='icon' href='media/image/favicon.png'>
	<link rel="stylesheet" href="css/header.css?ver=1">
	<link rel='stylesheet' href='css/artist.css?ver=1'>
	<link rel="stylesheet" href="css/footer.css?ver=1">
	<title>Lanthirey Artist</title>
</head>
<body>
<div id='idSysMsg'></div>
<?php require 'header.htm'; ?>
<div class='cl1'>
	<div class='cl2'>
		<div class='cl3'>
			<div class='cl5'><img class='cl8' src='<?php echo $s_avatar; ?>'></div>
			<?php echo $s_links; ?>
		</div>
		<div class='cl4'>
			<div class='cl10'><?php echo $s_name; ?></div>
			<div class='cl11'><?php echo $s_about; ?></div>
		</div>
	</div>
	<div id="scrollTop"></div>
	<div id='id1' class='cl26'></div>
	<div id='id2' class='cl25'></div>
</div>
<?php require "footer.htm"; ?>
<script>
var i_posts = <?php echo $i_posts; ?>;
var s_posts = "<?php echo $s_posts; ?>";
var i_max = Math.ceil(i_posts / 8);
</script>
<script src="js/artist.js"></script>
<script src="js/footer.js"></script>
<script src='js/artist-pagination.js' async></script>
</body>
</html>