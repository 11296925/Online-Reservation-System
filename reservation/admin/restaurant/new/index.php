<?php
include("../../../config.php");
session_start();

// Force user to be logged in to an admin account
$emailaddress = NULL;
if (isset($_SESSION['email']) && isset($_SESSION['admin'])) {
  if ($_SESSION['admin'] == false) {
    header('Location: ../../login/');
  }

  $emailaddress = $_SESSION['email'];
} else {
  header('Location: ../../login/');
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- styling -->
  <link rel="stylesheet" type="text/css" href="../../../css/styles.css">
  <link rel="stylesheet" type="text/css" href="../../../css/navigation.css">
  <link rel="stylesheet" type="text/css" href="../../../fonts/aileron_ultralight_macroman/stylesheet.css">
  <link rel="icon" href="../../../img/logo.ico">

  <!-- javascript -->
  <script type="text/javascript" src="../../../js/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="../../../js/navigation.js"></script>

  <!-- page specific -->
  <link rel="stylesheet" type="text/css" href="new.css">

  <title>ReeServations</title>
</head>

<body>
  <div class="container">

    <!-- header -->
    <div class="header">
      <div class="col left">
        <a href="../../">
          <img class="logo" src="../../../img/logo.png">
          <h1>ReeServations</h1>
        </a>
      </div>
      <div class="col right">
        <a onclick="openNav()" class="profile">
          <img class="avatar" src="../../../img/menu.png">
        </a>
      </div>
    </div>

    <!-- navigation -->
    <div id="navbar" class="navbar">
      <a href="javascript:void(0)" onclick="closeNav()">
        <img class="close" src="../../../img/close.png">
      </a>
      <div class="items">
        <a class="item logout" href="../../../logout.php">Log uit</a>
      </div>
    </div>

    <!-- content -->
    <div class="content">
      <div class="restaurants">
        <h1>Nieuw Restaurant</h1>
          <div class="restaurant">
            <form method="POST" action="new.php" enctype="multipart/form-data">
              <div class="row">
                <div class="col-25">
                  <label for="naam">Naam</label>
                </div>
                <div class="col-75">
                  <input type="text" id="name" name="name" placeholder="Naam">
                </div>
              </div>
              <div class="row">
                <div class="col-25">
                  <label for="description">Beschrijving</label>
                </div>
                <div class="col-75">
                  <textarea maxlength="200" id="description" name="description" style="height:200px"></textarea>
                </div>
              </div>
              <div class="row">
                <div class="col-25">
                  <label for="map">Plattegrond</label>
                </div>
                <div class="col-75">
                  <input type="file" id="map" name="map" accept="image/*">
                </div>
              </div>
              <div class="row">
                <div class="col-25">
                  <label for="email">E-mailadres</label>
                </div>
                <div class="col-75">
                  <input type="text" id="email" name="email" placeholder="E-mailadres">
                </div>
              </div>
              <div class="row">
                <div class="col-25">
                  <label for="address">Adres</label>
                </div>
                <div class="col-75">
                  <input type="text" id="address" name="address" placeholder="Adres">
                </div>
              </div>
              <div class="row">
                <div class="col-25">
                  <label for="city">Plaats</label>
                </div>
                <div class="col-75">
                  <input type="text" id="city" name="city" placeholder="Plaats">
                </div>
              </div>
              <div class="row">
                <div class="col-25">
                  <label for="zip">Postcode</label>
                </div>
                <div class="col-75">
                  <input type="text" id="zip" name="zip" placeholder="Postcode">
                </div>
              </div>
              <div class="row">
                <div class="col-25">
                  <label for="phone">Telefoon</label>
                </div>
                <div class="col-75">
                  <input type="text" id="phone" name="phone" placeholder="Telefoon">
                </div>
              </div>
              <div class="row">
                <input type="submit" value="Maak aan">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
