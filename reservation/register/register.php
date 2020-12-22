<?php
include("../config.php");
session_start();

if (!$db) {
  header("Location: index.php?e=1");
}

if (empty($_POST["email"])) {
  header("Location: index.php?e=2");
} else if (empty($_POST["firstname"])) {
  header("Location: index.php?e=2");
} else if (empty($_POST["lastname"])) {
  header("Location: index.php?e=4");
} else if (empty($_POST["password"])) {
  header("Location: index.php?e=5");
} else if (isset($_POST['email']) and isset($_POST['firstname']) and isset($_POST['lastname']) and isset($_POST['password'])) {
  $email = $_POST["email"];
  $firstname = $_POST["firstname"];
  $lastname = $_POST["lastname"];
  $password = $_POST["password"];

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: index.php?e=6");
  } else if (!preg_match("/^[a-zA-Z ]*$/", $firstname)) {
    header("Location: index.php?e=7");
  } else if (!preg_match("/^[a-zA-Z ]*$/", $lastname)) {
    header("Location: index.php?e=8");
  } else if (!preg_match("/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,16}/", $password)) {
    header("Location: index.php?e=9");
  }

  $email = mysqli_real_escape_string($db, strtolower($_POST['email']));
  $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
  $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $query = "SELECT * FROM Users WHERE email='$email' AND type=1";
  $result = mysqli_query($db, $query);
  $count = mysqli_num_rows($result);

  if ($count == 1) {
    header("Location: index.php?e=10");
  } else {
    $query = "INSERT INTO Users (email, firstname, lastname, password_hash, type, restaurant_id) VALUES ('$email', '$firstname', '$lastname', '$password', 1, 0)";

    $result = mysqli_query($db, $query);
    $_SESSION['email'] = $email;
    header("Location: ../");
  }
}
?>
