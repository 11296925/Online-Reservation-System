<?php
/*
book/index.php

Called to make a reservation
*/

include("../config.php");
session_start();

// Force user to be logged in
$emailaddress = NULL;
if (isset($_SESSION['email'])) {
  $emailaddress = mysqli_real_escape_string($db, $_SESSION['email']);
} else {
  header('Location: ../index.php');
}

// Check if user provided url parameters needed
if (!isset($_GET['id'])  || !isset($_GET['d']) || !isset($_GET['t']) ||
  !isset($_GET['ta'])) {
  header('Location: ../index.php');
}

// Store url parameters in local variables and sanitise input
$res_id = mysqli_real_escape_string($db, $_GET['id']);
$res_date = mysqli_real_escape_string($db, $_GET['d']);
$res_time = mysqli_real_escape_string($db, $_GET['t']);
$res_table = mysqli_real_escape_string($db, $_GET['ta']);

// Format time and date into database format
$res_time = substr_replace($res_time, ':', 2, 0);
$res_datetime = $res_date . ' ' . $res_time;

// Get user information
$query = "SELECT id FROM Users WHERE email='$emailaddress'";
$result = mysqli_query($db, $query);
$usr_id = mysqli_fetch_object($result)->id;

// Get restaurant tables information
$query = "SELECT id FROM Tables WHERE tablenumber='$res_table' AND restaurant_id='$res_id'";
$result = mysqli_query($db, $query);
$res_table_id = mysqli_fetch_object($result)->id;

// Insert new row into reservations table with user provided information
$query = "INSERT INTO Reservation (id_restaurant, id_user, id_table, number_of_people, start) VALUES ($res_id, $usr_id, $res_table_id, 1, '$res_datetime')";
$result = mysqli_query($db, $query);

header('Location: success/')
?>
