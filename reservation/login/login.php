<?php
/*
login.php

Called to log in a user
*/

include("../config.php");
session_start();

// Track whether the user was in the prcoess of making a reservation
$inres = false;

if (isset($_POST['inres'])) {
  $inres = true;
}

// Return if no connection to database is possible
if (!$db) {
  if (!$inres) {
    header("Location: index.php?e=1");
  } else {
    header("Location: ../book/review/index.php?e=1");
  }
}

// Check if user provided necessary infomration
if (empty($_POST["email"])) {
  if (!$inres) {
    header("Location: index.php?e=2");
  } else {
    header("Location: ../book/review/index.php?e=2");
  }
} else if (empty($_POST["password"])) {
  if (!$inres) {
    header("Location: index.php?e=3");
  } else {
    header("Location: ../book/review/index.php?e=3");
  }
}

// If user provided necessary information continue to log in
else if (isset($_POST['email']) and isset($_POST['password'])) {
  // Get user provieded information
  $email = mysqli_real_escape_string($db, strtolower($_POST['email']));
  $password = $_POST['password'];

  // Get password hash of email provied by the user
  $query = "SELECT password_hash FROM Users WHERE email='$email'";
  $result = mysqli_query($db, $query);
  $value = mysqli_fetch_object($result)->password_hash;
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
      if (!$inres) {
        header("Location: ../");
      } else {
        header("Location: ../book/review/");
      }
    }

    // Invalid password, return
    else {
      if (!$inres) {
        header("Location: index.php?e=4");
      } else {
        header("Location: ../book/review/index.php?e=4");
      }
    }
  }

  // The email address is not in user, return
  else {
    if (!$inres) {
      header("Location: index.php?e=4");
    } else {
      header("Location: ../book/review/index.php?e=4");
    }
  }
}
?>
