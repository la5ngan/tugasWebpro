<?php
include 'connection.php';
$username = $_POST['username'];
$password = $_POST['password'];
if (empty($username)||empty($password)) {
	echo "empty";
}else{
	$q = mysqli_query($conn,"SELECT * FROM `user` WHERE `username`='$username' AND `password`=md5('$password')");
	$cek = mysqli_num_rows($q);
	if ($cek > 0) {
		session_start();
		$_SESSION['username'] = $username;
		$_SESSION['status'] = 'active';
		echo "oke";
	}else{
		echo "error";
	}
}