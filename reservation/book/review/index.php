<?php
include("../../config.php");
session_start();

// Get email address of user logged in
$emailaddress = NULL;
if (isset($_SESSION['email'])) {
  $emailaddress = $_SESSION['email'];
}

$res_id;
$res_date;
$res_time;
$res_table;

// Check if reservation information is in url parameters
if (!isset($_GET['id'])  || !isset($_GET['d'])
    || !isset($_GET['t']) || !isset($_GET['ta'])) {

  // Check if reservation information is in session variables
  if (!isset($_SESSION['r_id']) || !isset($_SESSION['r_da'])
      || !isset($_SESSION['r_ti']) || !isset($_SESSION['r_ta'])) {

    // Return
    header('Location: ../../index.php');
  }

  // Set local variables from session variables
  else {
    $res_id = mysqli_real_escape_string($db, $_SESSION['r_id']);
    $res_date = $_SESSION['r_da'];
    $res_time = $_SESSION['r_ti'];
    $res_table = $_SESSION['r_ta'];
  }
}

// Set local variables from url parameters
else {
  $res_id = mysqli_real_escape_string($db, $_GET['id']);
  $res_date = $_GET['d'];
  $res_time = $_GET['t'];
  $res_table = $_GET['ta'];
}

// Format date to readable format
$res_date_f = date('l F jS Y', strtotime($res_date));
$res_time_f = substr_replace($res_time, ':', 2, 0);

// Get restaurant information
$query = "SELECT id, name FROM Restaurants WHERE id = $res_id";
$result = mysqli_query($db, $query);
$row = mysqli_fetch_assoc($result);
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- styling -->
  <link rel="stylesheet" type="text/css" href="../../css/styles.css">
  <link rel="stylesheet" type="text/css" href="../../css/navigation.css">
  <link rel="stylesheet" type="text/css" href="../../css/breadcrumbs.css">
  <link rel="stylesheet" type="text/css" href="../../fonts/aileron_ultralight_macroman/stylesheet.css">
  <link rel="icon" href="../../img/logo.ico">

  <!-- javascript -->
  <script type="text/javascript" src="../../js/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="../../js/navigation.js"></script>
  <script type="text/javascript" src="../../js/helpers.js"></script>

  <!-- page specific -->
  <link rel="stylesheet" type="text/css" href="login.css">
  <link rel="stylesheet" type="text/css" href="review.css">
  <script type="text/javascript" src="review.js"></script>

  <title>ReeServations</title>
</head>

<body>
  <div class="container">

    <!-- header -->
    <div class="header">
      <div class="col left">
        <a href="../../">
          <img class="logo" src="../../img/logo.png">
          <h1>ReeServations</h1>
        </a>
      </div>
      <div class="col right">
        <a onclick="openNav()" class="profile">
          <img class="avatar" src="../../img/menu.png">
        </a>
      </div>
    </div>

    <!-- navigation -->
    <div id="navbar" class="navbar">
      <a href="javascript:void(0)" onclick="closeNav()">
        <img class="close" src="../../img/close.png">
      </a>
      <div class="items">
        <!-- navigation based on if user loged in -->
        <?php if ($emailaddress != NULL) { ?>
        <a class="item logout" href="../../logout.php">Log uit</a>
        <?php } else { ?>
        <a class="item logout" href="../../login/">Log in</a>
        <?php } ?>
        <a class="item" href="../../">Home</a>
        <?php if ($emailaddress != NULL) { ?>
        <a class="item" href="../../account/">Mijn profiel</a>
        <a class="item" href="../../account/bookings/">Mijn reserveringen</a>
        <?php } ?>
      </div>
    </div>

    <!-- content -->
    <div class="content">
      <div class="restaurant-header">
        <h1><?php echo $row["name"]; ?></h1>
        <span class="datetime"><?php echo $res_date_f;?>, <?php echo $res_time_f; ?></span>
      </div>
      <div class="restaurant-container">
        <div class="breadcrumb flat">
          <a href="../date?id=<?php echo $res_id; ?>" class="done">Datum kiezen</a>
        	<a href="../time?id=<?php echo $res_id; ?>&d=<?php echo $res_date; ?>" class="done">Tijd kiezen</a>
        	<a href="../table?id=<?php echo $res_id; ?>&d=<?php echo $res_date; ?>&t=<?php echo $res_time; ?>" class="done">Tafel kiezen</a>
        	<a href="javascript:void(0)" class="active">Reservering</a>
        </div>
        <h2>4. Reservering</h2>
        <div class="restaurant-content">
          <div class="reservation">
          <?php

          // Check if user is logged in
          if ($emailaddress == NULL) {

            // Store reservation information in session
            $_SESSION['r_id'] = $res_id;
            $_SESSION['r_da'] = $res_date;
            $_SESSION['r_ti'] = $res_time;
            $_SESSION['r_ta'] = $res_table;
            ?>

            <!-- show login form -->
            <form class="login" action="../../login/login.php" method="POST" onsubmit="return validateLogin()">
              <h1>Login</h1>
              <input id="email" name="email" type="text" placeholder="E-mailadres" autofocus>
              <input id="password" name="password" type="password" placeholder="Wachtwoord">
              <input type="hidden" name="inres" value=true>
              <input type="submit" value="Login">
              <p class="login-lost"><a href="../../lost/">Wachtwoord vergeten?</a></p>
              <p id="error" class="mandatory"><i>[veld] is verplicht</i></p>
            </form>

            <?php
          } else {

            // Reset reservation information in session
            $_SESSION['r_id'] = NULL;
            $_SESSION['r_da'] = NULL;
            $_SESSION['r_ti'] = NULL;
            $_SESSION['r_ta'] = NULL;
            ?>

            <!-- show reservation information -->
            <p>Reservering bij <?php echo $row["name"];?> op <?php echo $res_date_f;?> om <?php echo $res_time_f; ?></p>
            <?php
          }
          ?>
          </div>
        </div>

        <div class="booking-nav">
          <div class="left">
            <a class="button" href="../table?id=<?php echo $res_id; ?>&d=<?php echo $res_date; ?>">Vorige stap</a>
          </div>
          <div class="right">
            <?php if ($emailaddress != NULL) { ?>
            <a class="button" href="../?id=<?php echo $res_id; ?>&d=<?php echo $res_date; ?>&t=<?php echo $res_time; ?>&ta=<?php echo $res_table; ?>">Plaats reservering</a>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
