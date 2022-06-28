<?php
session_start();
if ($_SESSION['bAccess'] != 'true') {
	exit('Authorization Required');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$sql = "SELECT i_index FROM t_artist WHERE s_name = ?";
	require '../../php/link.php';
	$stmt = mysqli_stmt_init($link);
	mysqli_stmt_prepare($stmt, $sql);
	mysqli_stmt_bind_param($stmt, "s", $_POST['s_name']);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $col1);
	if (mysqli_stmt_fetch($stmt)) {
		$a_response = array(0, "Artist already exists.");
		echo json_encode($a_response);
		mysqli_stmt_close($stmt);
		mysqli_close($link);
		exit();
	}

	$s_name = $_POST['s_name'];
	$s_about = $_POST['s_about'];
	$a_posts = array();
	$s_posts = json_encode($a_posts);
	$a_link_image = array();
	$a_link_text = array();
	$a_link = array();
	for ($i = 0; $i < count($_POST['link_image']); $i++) {
		if ($_POST['link_image'][$i] != '' and $_POST['link_text'][$i] != '' and $_POST['link'][$i] != '') {
			$a_link_image[] = $_POST['link_image'][$i];
			$a_link_text[] = $_POST['link_text'][$i];
			$a_link[] = $_POST['link'][$i];
		}
	}
	$a_links = array($a_link_image, $a_link_text, $a_link);
	$s_links = json_encode($a_links);
	$s_avatar = "x";
	$sql = "INSERT INTO t_artist (s_name, s_about, s_avatar, s_links, s_posts) VALUES (?, ?, ?, ?, ?)";
	require '../../php/link.php';
	$stmt = mysqli_stmt_init($link);
	mysqli_stmt_prepare($stmt, $sql);
	mysqli_stmt_bind_param($stmt, "sssss", $s_name, $s_about, $s_avatar, $s_links, $s_posts);
	mysqli_stmt_execute($stmt);
	$i_last_id = mysqli_insert_id($link);
	mysqli_stmt_close($stmt);
	mysqli_close($link);

	$s_ext = strtolower(pathinfo($_FILES['f_image']['name'], PATHINFO_EXTENSION));
	$s_dir = '../media/image/artist/' . $i_last_id . '.' . $s_ext;
	move_uploaded_file($_FILES['f_image']['tmp_name'], $s_dir);
	$s_dir = substr($s_dir, 3);
	$sql = "UPDATE t_artist SET s_avatar=? WHERE i_index=?";
	require '../../php/link.php';
	$stmt = mysqli_stmt_init($link);
	mysqli_stmt_prepare($stmt, $sql);
	mysqli_stmt_bind_param($stmt, "si", $s_dir, $i_last_id);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($link);
	$a_response = array(1, "Artist added successfully");
	echo json_encode($a_response);
}
?>