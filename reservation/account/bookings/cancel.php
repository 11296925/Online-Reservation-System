<?php
/*
cancel.php

Called to cancel a reservation by ID
*/


include("../../config.php");
session_start();

$emailaddress = NULL;
if (isset($_SESSION['email'])) {
  $emailaddress = mysqli_real_escape_string($db, $_SESSION['email']);
}

// Reservation to cancel
$res_id = mysqli_real_escape_string($db, $_GET['id']);

// Get user id of the user trying to cancel
$query = "SELECT id FROM Users WHERE email = '$emailaddress'";
$result = mysqli_query($db, $query);
$id_result = mysqli_fetch_object(mysqli_query($db, $query));


// Cancel reservation to cancel if it was made by this user
$query = "DELETE FROM Reservation WHERE id = $res_id AND id_user=".$id_result->id;
$result = mysqli_query($db, $query);

header('Location: index.php');
?>
