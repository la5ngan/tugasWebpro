<?php
include 'connection.php';
header('Content-Type: application/json');
session_start();
$username = $_SESSION['username'];
$q = mysqli_query($conn,"SELECT * FROM `profile` WHERE `username`='$username'");
foreach ($q as $v) {
	$data = json_encode($v);
}
echo $data;