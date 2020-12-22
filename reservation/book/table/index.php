<?php
include("../../config.php");
session_start();

// Get email address of user logged in
$emailaddress = NULL;
if (isset($_SESSION['email'])) {
  $emailaddress = $_SESSION['email'];
}

// Check if url parameters are set
if (!isset($_GET['id'])  || !isset($_GET['d']) || !isset($_GET['t'])) {
  // Return
  header('Location: ../../index.php');
}

// Set local variables from url parameters
$res_id = mysqli_real_escape_string($db, $_GET['id']);
$res_date = $_GET['d'];
$res_time = $_GET['t'];

// Format date into readable format
$res_date_f = date('l F jS Y', strtotime($res_date));
$res_time_f = substr_replace($res_time, ':', 2, 0);
$res_datetime = $res_date . ' ' . $res_time_f;

// Get restaurant information
$query = "SELECT mapurl, id, name FROM Restaurants WHERE id = $res_id";
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
  <script type="text/javascript" src="../../js/jquery.maphilight.min.js"></script>
  <script type="text/javascript" src="../../js/helpers.js"></script>

  <!-- page specific -->
  <link rel="stylesheet" type="text/css" href="table.css">
  <script type="text/javascript" src="table.js"></script>

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
        	<a href="../time?id=<?php echo $res_id; ?>&d=<?php echo $res_date; ?>"
              class="done">Tijd kiezen</a>
        	<a href="javascript:void(0)" class="active" >Tafel kiezen</a>
        	<a href="javascript:void(0)">Reservering</a>
        </div>
        <h2>3. Tafel kiezen</h2>
        <div class="restaurant-content">
          <img class="map" src="../../img/maps/<?php echo $row['mapurl']; ?>"
            usemap="#image-map">

          <map name="image-map">
            <?php
            // Get table information of current restaurant
            $query = "SELECT id, tablenumber, map_coordinates FROM Tables WHERE
              restaurant_id = $res_id";
            $result = mysqli_query($db, $query);

            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
              $table_id = $row["id"];

              // Get already booked tables
              $query = "SELECT * FROM Reservation WHERE id_table=$table_id AND
                start = '$res_datetime'";
              $booked_result = mysqli_query($db, $query);
              $num_rows = mysqli_num_rows($booked_result);

              // If table is already booked, display table in red
              if ($num_rows == 1) {
                ?>
                <area id="<?php echo $row["tablenumber"]; ?>"
                  class="table booked" href="javascript:void(0)"
                  coords="<?php echo $row["map_coordinates"]; ?>" shape="rect">
                <?php
              } else {
                ?>
                <area id="<?php echo $row["tablenumber"]; ?>"
                  class="table" href="javascript:void(0)"
                  coords="<?php echo $row["map_coordinates"]; ?>" shape="rect">
                <?php
              }
            }
            ?>
          </map>
        </div>
        <p id="error" class="mandatory"><i>[veld] is verplicht</i></p>

        <div class="booking-nav">
          <div class="left">
            <a class="button" href="../time?id=<?php echo $res_id; ?>&d=<?php echo $res_date; ?>">Vorige stap</a>
          </div>
          <div class="right">
            <a id="nextStep" class="button" href="../review/">Volgende stap</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
