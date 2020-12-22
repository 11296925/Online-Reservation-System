<?php
/*
new.php

Called to create a new restaurant
*/

include("../../../config.php");
session_start();

// Force user to be logged in to an admin account
$emailaddress = NULL;
if (isset($_SESSION['email']) && isset($_SESSION['admin'])) {
  if ($_SESSION['admin'] == false) {
    header('Location: ../login/');
  }

  $emailaddress = $_SESSION['email'];
} else {
  header('Location: ../login/');
}

// Check if user provided necessary information
if (!isset($_POST['name']) || !isset($_POST['description']) || !isset($_POST['email']) ||
  !isset($_POST['address']) || !isset($_POST['city']) || !isset($_POST['zip']) ||
  !isset($_POST['phone'])) {
    header('Location: index.php');
}

// Name of the uploaded map of the restaurant
$filename = mysqli_real_escape_string($db, basename($_FILES["map"]["name"]));

// --------------------------------------------------
// This coded is heavily inspired by w3schools.com
// (https://www.w3schools.com/php/php_file_upload.asp)
$target_dir = "../../../img/maps/";
$target_file = $target_dir . basename($_FILES["map"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
$check = getimagesize($_FILES["map"]["tmp_name"]);
if($check !== false) {
  $uploadOk = 1;
} else {
  $uploadOk = 0;
}

// Check if file already exists
if (file_exists($target_file)) {
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
/*
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["map"]["tmp_name"], $target_file)) {
    echo "The file ". basename( $_FILES["map"]["name"]). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
*/
// --------------------------------------------------

// Sanitise user input
$res_name = mysqli_real_escape_string($db, $_POST['name']);
$res_desc = mysqli_real_escape_string($db, $_POST['description']);
$res_email = mysqli_real_escape_string($db, $_POST['email']);
$res_addr = mysqli_real_escape_string($db, $_POST['address']);
$res_city = mysqli_real_escape_string($db, $_POST['city']);
$res_zip = mysqli_real_escape_string($db, $_POST['zip']);
$res_phone = mysqli_real_escape_string($db, $_POST['phone']);

// Insert new row into restaurants table
$query = "INSERT INTO Restaurants (name, mapurl, description, email, address, city, zip,
  phone) VALUES('$res_name', '$filename', '$res_desc', '$res_email', '$res_addr',
  '$res_city', '$res_zip', '$res_phone')";
$result = mysqli_query($db, $query);
header('Location: index.php');
?>
