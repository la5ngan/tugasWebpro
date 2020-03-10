<?php
include 'connection.php';
header('Content-Type: application/json');
$search = $_GET['search'];
$q = mysqli_query($conn,"SELECT * FROM `photo` WHERE `caption` LIKE '%$search%'");
if ($q) {
	$data = array();
	while ($row = mysqli_fetch_assoc($q)) {
	   
		array_push($data, $row);
	   
	}
	$v = json_encode($data);
	echo $v;
}else{
	echo "string";
}