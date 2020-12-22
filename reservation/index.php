<?php
include("config.php");
session_start();

$emailaddress = NULL;
if (isset($_SESSION['email'])) {
  $emailaddress = $_SESSION['email'];
}

// Get restaurants from database
$query = "SELECT id, name, description FROM Restaurants";
$result = mysqli_query($db, $query);

// ------------------------------------------------------
// The following piece of code is from:
// https://stackoverflow.com/questions/10619126/make-sure-string-is-a-valid-css-id-name
function seoUrl($string) {
  //Lower case everything
  $string = strtolower($string);
  //Make alphanumeric (removes all other characters)
  $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
  //Clean up multiple dashes or whitespaces
  $string = preg_replace("/[\s-]+/", " ", $string);
  //Convert whitespaces and underscore to dash
  $string = preg_replace("/[\s_]/", "-", $string);
  return $string;
}
// ------------------------------------------------------

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- styling -->
  <link rel="stylesheet" type="text/css" href="fonts/aileron_ultralight_macroman/stylesheet.css">
  <link rel="icon" href="img/logo.ico">

  <!-- javascript -->
  <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>

  <!-- page specific -->
  <script type="text/javascript" src="home.js"></script>
  <link rel="stylesheet" type="text/css" href="home.css">

  <title>ReeServations</title>

  <script>
    restaurants = [];
  </script>
</head>

<body>
  <div class="container">

    <!-- header -->
    <div class="header">
      <div class="welcome">
        <img class="logo" src="img/logo.png">
        <h1>ReeServations</h1>
        <h3>The easiest way to make reservations online</h3>
        <div class="buttons">
          <?php
          if ($emailaddress == NULL) {
            ?>
            <!-- header when logged in -->
            <a class="button" href="login/">Login</a>
            <a class="button" href="register/">Registreer</a>
            <?php
          } else {
            ?>
            <!-- header when not logged in -->
            <a class="button" href="account/">Mijn profiel</a>
            <a class="button" href="account/bookings/">Mijn reserveringen</a>
            <?php
          }
          ?>
        </div>
      </div>
    </div>

    <!-- content -->
    <div class="content">
      <div class="restaurants">
        <h1>Restaurants</h1>
        <?php
        if (!$result) {
          echo 'Geen restaurants gevonden';
        } else {
          while($row = $result->fetch_array(MYSQLI_ASSOC)) { ?>

            <!-- display restaurant information -->
            <div class="restaurant">
              <div class="restaurant-left">
                <img class="restaurant-thumb" id="restaurant<?php echo seoUrl($row["name"]); ?>img">
                <a class="button" href="book/date?id=<?php echo $row["id"] ?>">Reserveer</a>
              </div>
              <div class="restaurant-right">
                <span class="title"><?php echo $row["name"]; ?></span>
                <p class="description"><?php echo $row["description"]; ?></p>
              </div>
            </div>

            <script tpye="text/javascript">
              restaurants.push('<?php echo seoUrl($row["name"]); ?>');
            </script>
          <?php
          }
        }?>
      </div>
    </div>
  </div>
</body>

</html>
