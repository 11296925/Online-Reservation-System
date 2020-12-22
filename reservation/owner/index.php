<?php
include("../config.php");
session_start();

// Force user to be logged in to an owner account
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

// Get  restaurant information by ID
$query = "SELECT id, id_user, id_table, start FROM Reservation WHERE id_restaurant=$restaurantid";
$result = mysqli_query($db, $query);
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- styling -->
  <link rel="stylesheet" type="text/css" href="../css/styles.css">
  <link rel="stylesheet" type="text/css" href="../css/navigation.css">
  <link rel="stylesheet" type="text/css" href="../fonts/aileron_ultralight_macroman/stylesheet.css">
  <link rel="icon" href="../img/logo.ico">

  <!-- javascript -->
  <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="../js/navigation.js"></script>

  <!-- page specific -->
  <link rel="stylesheet" type="text/css" href="home.css">

  <title>ReeServations</title>
</head>

<body>
  <div class="container">

    <!-- header -->
    <div class="header">
      <div class="col left">
        <a href="">
          <img class="logo" src="../img/logo.png">
          <h1>ReeServations</h1>
        </a>
      </div>
      <div class="col right">
        <a onclick="openNav()" class="profile">
          <img class="avatar" src="../img/menu.png">
        </a>
      </div>
    </div>

    <!-- navigation -->
    <div id="navbar" class="navbar">
      <a href="javascript:void(0)" onclick="closeNav()">
        <img class="close" src="../img/close.png">
      </a>
      <div class="items">
        <a class="item logout" href="../logout.php">Log uit</a>
      </div>
    </div>

    <!-- content -->
    <div class="content">
      <div class="reservations">
      <h1>Reserveringen</h1>
        <?php
        if (!$result) {
          echo 'Geen reserveringen gevonden';
        } else {
          while($row = $result->fetch_array(MYSQLI_ASSOC)) {
            // Get user information for reservation
            $query = "SELECT firstname, lastname, email FROM Users WHERE id=".$row['id_user'];
            $usr_result = mysqli_fetch_object(mysqli_query($db, $query));

            // Get table information for reservation
            $query = "SELECT tablenumber FROM Tables WHERE id=".$row['id_table'];
            $tabl_result = mysqli_fetch_object(mysqli_query($db, $query));

            // Format date to readable format
            $datetime_f = date('l F jS Y \o\m H:i', strtotime($row['start']));
            ?>

            <!-- display reservation information -->
            <div class="reservation">
              <span class="title"><?php echo $usr_result->firstname . ' ' . $usr_result->lastname; ?></span>
              <p><span class="table">Tafel <?php echo $tabl_result->tablenumber; ?></span> op <span class="datetime"><?php echo $datetime_f; ?></span></p>
              <p><?php echo $usr_result->email; ?></p>
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
