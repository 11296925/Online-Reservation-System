<?php
/*
edit.php

Called to edit an existing restaurant
*/

include("../../config.php");
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

// Check if user provided all information necessary
if (!isset($_POST['name']) || !isset($_POST['description']) || !isset($_POST['email']) ||
  !isset($_POST['address']) || !isset($_POST['city']) || !isset($_POST['zip']) ||
  !isset($_POST['phone']) || !isset($_POST['id'])) {
    header('Location: index.php');
}

// ID of the restaurant to edit
$res_id = mysqli_real_escape_string($db, $_POST['id']);

// If delete button was pressed delete restaurant
if (isset($_POST['delete'])) {
  $query = "DELETE FROM Restaurants WHERE id=$res_id";
  $result = mysqli_query($db, $query);
  header('Location: ../');
}

// Else update restaurant information with user provided information
else {
  // Santise user input
  $res_name = mysqli_real_escape_string($db, $_POST['name']);
  $res_desc = mysqli_real_escape_string($db, $_POST['description']);
  $res_email = mysqli_real_escape_string($db, $_POST['email']);
  $res_addr = mysqli_real_escape_string($db, $_POST['address']);
  $res_city = mysqli_real_escape_string($db, $_POST['city']);
  $res_zip = mysqli_real_escape_string($db, $_POST['zip']);
  $res_phone = mysqli_real_escape_string($db, $_POST['phone']);

  // Update restaurant information
  $query = "UPDATE Restaurants SET name='$res_name', description='$res_desc',
    email='$res_email', address='$res_addr', city='$res_city',
    zip='$res_zip', phone='$res_phone' WHERE id=$res_id";
  $result = mysqli_query($db, $query);
  header('Location: index.php?id='.$_POST['id']);
}
?>
