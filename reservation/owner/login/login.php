<?php
/*
login.php

Called to log in a user
*/

include("../../config.php");
session_start();

// Return if no connection to database is possible
if (!$db) {
  header("Location: index.php?e=1");
}

// Check if user provided necessary infomration
if (empty($_POST["email"])) {
  header("Location: index.php?e=2");
} else if (empty($_POST["password"])) {
  header("Location: index.php?e=3");
}

// If user provided necessary information continue to log in
else if (isset($_POST['email']) and isset($_POST['password'])) {
  // Get user provieded information
  $email = mysqli_real_escape_string($db, strtolower($_POST['email']));
  $password = $_POST['password'];

  // Get password hash and id of restaurant id of email provied by the user
  $query = "SELECT password_hash, restaurant_id FROM Users WHERE email='$email' AND type=3";
  $result = mysqli_query($db, $query);
  $row = $result->fetch_array(MYSQLI_ASSOC);
  $value = $row['password_hash'];
  $res_id = $row['restaurant_id'];
  $count = mysqli_num_rows($result);

  // Email address is in user continue to log in
  if ($count == 1) {
    // Verify password, and update hash if needed
    if (password_verify ($password, $value)) {
      if (password_needs_rehash ($value, PASSWORD_DEFAULT)) {
        // Update password hash
        $newHash = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE Users SET (password_hash='$newHash')";
        $result = mysqli_query($db, $query);
      }

      // Log in
      $_SESSION['email'] = $email;
      $_SESSION['resid'] = $res_id;
      header("Location: ../");
    } else {
      header("Location: index.php?e=4");
    }
  } else {
    header("Location: index.php?e=4");
  }
}
?>
