<?php

$conn = mysqli_connect('localhost', 'root', '','vietgram');
if (!$conn) {
	echo "database error";