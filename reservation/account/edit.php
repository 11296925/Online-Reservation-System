<?php
/*
edit.php

Called to edit a user profile
*/

include("../config.php");
session_start();

// Force user to be logged in
$emailaddress = NULL;
if (isset($_SESSION['email'])) {
  $emailaddress = $_SESSION['email'];
} else {
  header('Location: ../login/');
}

$emailaddress = mysqli_real_escape_string($db, $emailaddress);

// Check if all information needed is presented over POST
if (!isset($_POST['fname']) || !isset($_POST['lname']) || !isset($_POST['email'])) {
    header('Location: index.php');
}

// If delete button was pressed delete account
if (isset($_POST['delete'])) {
  $query = "DELETE FROM Users WHERE id=$emailaddress";
  $result = mysqli_query($db, $query);
  header('Location: ../logout.php');
}

// Else set new values of account
else {
  $res_fname = mysqli_real_escape_string($db, $_POST['fname']);
  $res_lname = mysqli_real_escape_string($db, $_POST['lname']);
  $res_email = mysqli_real_escape_string($db, $_POST['email']);

  $query = "UPDATE Users SET firstname='$res_fname', lastname='$res_lname', email='$res_email' WHERE email='$emailaddress'";
  $result = mysqli_query($db, $query);
  header('Location: index.php');
}
?>
