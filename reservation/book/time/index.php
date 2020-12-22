<?php
include("../../config.php");
session_start();

// Get email address of user logged in
$emailaddress = NULL;
if (isset($_SESSION['email'])) {
  $emailaddress = $_SESSION['email'];
}

// Check if url parameters are set
if (!isset($_GET['id'])  || !isset($_GET['d'])) {
  header('Location: ../../index.php');
}

$res_id = mysqli_real_escape_string($db, $_GET['id']);

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
  <link rel="stylesheet" type="text/css" href="time.css">
  <script type="text/javascript" src="time.js"></script>

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
        <span class="datetime">Selecteer een tijd</span>
      </div>
      <div class="restaurant-container">
        <div class="breadcrumb flat">
        	<a href="../date?id=<?php echo $res_id; ?>" class="done">Datum kiezen</a>
        	<a href="javascript:void(0)" class="active">Tijd kiezen</a>
        	<a href="javascript:void(0)">Tafel kiezen</a>
        	<a href="javascript:void(0)">Reservering</a>
        </div>

        <h2>2. Tijd kiezen</h2>
        <div class="restaurant-content">
          <div class="timetable">
            <div class="timetable-row">
              <a class="timebutton" id="1000">10:00</a>
              <a class="timebutton" id="1030">10:30</a>
              <a class="timebutton" id="1100">11:00</a>
              <a class="timebutton" id="1130">11:30</a>
            </div>
            <div class="timetable-row">
              <a class="timebutton" id="1200">12:00</a>
              <a class="timebutton" id="1230">12:30</a>
              <a class="timebutton" id="1300">13:00</a>
              <a class="timebutton" id="1330">13:30</a>
            </div>
            <div class="timetable-row">
              <a class="timebutton" id="1400">14:00</a>
              <a class="timebutton" id="1430">14:30</a>
              <a class="timebutton" id="1500">15:00</a>
              <a class="timebutton" id="1530">15:30</a>
            </div>
            <div class="timetable-row">
              <a class="timebutton" id="1600">16:00</a>
              <a class="timebutton" id="1630">16:30</a>
              <a class="timebutton" id="1700">17:00</a>
              <a class="timebutton" id="1730">17:30</a>
            </div>
            <div class="timetable-row">
              <a class="timebutton" id="1800">18:00</a>
              <a class="timebutton" id="1830">18:30</a>
              <a class="timebutton" id="1900">19:00</a>
              <a class="timebutton" id="1930">19:30</a>
            </div>
            <div class="timetable-row">
              <a class="timebutton" id="2000">20:00</a>
              <a class="timebutton" id="2030">20:30</a>
              <a class="timebutton" id="2100">21:00</a>
              <a class="timebutton" id="2130">21:30</a>
            </div>
          </div>
          <p id="error" class="mandatory"><i>[veld] is verplicht</i></p>
          
          <div class="booking-nav">
            <div class="left">
              <a class="button" href="../date?id=<?php echo $res_id; ?>">Vorige stap</a>
            </div>
            <div class="right">
              <a id="nextStep" class="button" href="../table/">Volgende stap</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
