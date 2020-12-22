<?php
include("../../config.php");
session_start();

// Force login if not logged in
$emailaddress = NULL;
if (isset($_SESSION['email'])) {
  $emailaddress = mysqli_real_escape_string($db, $_SESSION['email']);
} else {
  header('Location: ../../login/');
}

// Get the id of the user logged in
$query = "SELECT id FROM Users WHERE email='$emailaddress'";
$result = mysqli_query($db, $query);
$usr_id = mysqli_fetch_assoc($result)['id'];

// Get all reservations from user logged in
$query = "SELECT id, id_restaurant, id_table, start FROM Reservation WHERE id_user = $usr_id";
$result = mysqli_query($db, $query);
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
  <link rel="stylesheet" type="text/css" href="../../fonts/aileron_ultralight_macroman/stylesheet.css">
  <link rel="icon" href="../../img/logo.ico">

  <!-- javascript -->
  <script type="text/javascript" src="../../js/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="../../js/navigation.js"></script>

  <!-- page specific -->
  <link rel="stylesheet" type="text/css" href="bookings.css">

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
        <a class="item" href="../">Mijn profiel</a>
        <a class="item active" href="">Mijn reserveringen</a>
        <?php } ?>
      </div>
    </div>

    <!-- content -->
    <div class="content">
      <div class="reservations">
      <h1>Mijn reserveringen</h1>
        <?php
        if (!$result) {
          echo 'Geen reserveringen gevonden';
        } else {
          // Iterate of SQL result
          while($row = $result->fetch_array(MYSQLI_ASSOC)) {
            // Get restaurant information
            $query = "SELECT name FROM Restaurants WHERE id=".$row['id_restaurant'];
            $rest_result = mysqli_fetch_object(mysqli_query($db, $query));

            // Get table information
            $query = "SELECT tablenumber FROM Tables WHERE id=".$row['id_table'];
            $tabl_result = mysqli_fetch_object(mysqli_query($db, $query));

            // Format resrvation time into readable format
            $datetime_f = date('l F jS Y \o\m H:i', strtotime($row['start']));
            ?>

            <!-- Display reservation information -->
            <div class="reservation">
              <span class="title"><?php echo $rest_result->name; ?></span>
              <p><span class="table">Tafel <?php echo $tabl_result->tablenumber; ?></span> op <span class="datetime"><?php echo $datetime_f; ?></span></p>
              <a class="button" href="cancel.php?id=<?php echo $row['id']; ?>">Cancel reservering</a>
            </div>
          <?php
          }
        }?>
      </div>
    </div>
  </div>
</body>

</html>
