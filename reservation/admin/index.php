<?php
include("../config.php");
session_start();

// Force user to be logged in to an admin account
$emailaddress = NULL;
if (isset($_SESSION['email']) && isset($_SESSION['admin'])) {
  if ($_SESSION['admin'] == false) {
    header('Location: login/');
  }

  $emailaddress = $_SESSION['email'];
} else {
  header('Location: login/');
}

// Get list of restaurants
$query = "SELECT id, name, description FROM Restaurants";
$result = mysqli_query($db, $query);
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="../css/styles.css">
  <link rel="stylesheet" type="text/css" href="../css/navigation.css">
  <link rel="stylesheet" type="text/css" href="../fonts/aileron_ultralight_macroman/stylesheet.css">
  <link rel="icon" href="../img/logo.ico">

  <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="../js/navigation.js"></script>
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
      <div class="restaurants">
        <h1>Restaurants</h1>
        <?php
        if (!$result) {
          echo 'Geen restaurants gevonden';
        } else {
          while($row = $result->fetch_array(MYSQLI_ASSOC)) { ?>
            
            <!-- display restaurant summary -->
            <div class="restaurant">
              <span class="title"><?php echo $row["name"]; ?></span>
              <p class="description"><?php echo $row["description"]; ?></p>
              <a class="button" href="restaurant?id=<?php echo $row["id"] ?>">Aanpassen</a>
            </div>
          <?php
          }
        }?>
        <a class="button" href="restaurant/new">Nieuw restaurant</a>
      </div>
    </div>
  </div>
</body>

</html>
