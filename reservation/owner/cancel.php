<?php
/*
cancel.php

Called to cancel a reservation
*/

include("../config.php");
session_start();

// Force user to be logged in to an restaurant owner account
$emailaddress = NULL;
$restaurantid = NULL;
if (isset($_SESSION['email']) && isset($_SESSION['resid'])) {
  if ($_SESSION['resid'] == 0) {
    header('Location: login/');
  }

  $emailaddress = $_SESSION['email'];
  $restaurantid = $_SESSION['resid'];
} else {
  header('Location: login/');
}

// Reservation ID
$res_id = mysqli_real_escape_string($db, $_GET['id']);

// Restaurant ID
$restaurantid = mysqli_real_escape_string($db, $restaurantid);

// Delete reservation from database
$query = "DELETE FROM Reservation WHERE id=$res_id AND id_restaurant=$restaurantid";
$result = mysqli_query($db, $query);
header('Location: index.php');
?>
