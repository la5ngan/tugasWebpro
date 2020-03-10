<?php
$id = @$_POST["id"];
$caption = @$_POST["caption"];

//upload file
$target_dir = "foto/";
$target_file = @$target_dir .$id.'_'.basename($_FILES["file"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }


}
if ($_FILES["file"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
// Create connection
include 'core/connection.php';
// Check connection
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
// INSERT INTO `photo`(`url`, `caption`, `like`, `id_profile`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5])
$sql = "INSERT INTO `photo`(`id_photo`, `url`, `caption`, `like`, `id_profile`) VALUES (NULL, '$target_file','$caption',1,'$id')";
if ($conn->query($sql) === TRUE) {
    // echo "New record created successfully";
    // $_SESSION["valid"] = 1;
    header("Location: feed.html");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    // $_SESSION["valid"] = 2;
    header("Location: addPhoto.php");
}

$conn->close();