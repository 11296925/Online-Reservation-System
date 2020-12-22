<?php
include("../../config.php");
session_start();

// Force user to be logged in to an admin account
$emailaddress = NULL;
if (isset($_SESSION['email']) && isset($_SESSION['admin'])) {
  if ($_SESSION['admin'] == false) {
    header('Location: ../login/');
  }

  $emailaddress = $_SESSION['email'];
} else {
  header('Location: ../login/');
}

// ID of the restaurant to edit
$res_id = mysqli_real_escape_string($db, $_GET['id']);

// Get information of restaurant to edit
$query = "SELECT * FROM Restaurants WHERE id=$res_id";
$result = mysqli_query($db, $query);
$row = $result->fetch_array(MYSQLI_ASSOC)
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="../../css/styles.css">
  <link rel="stylesheet" type="text/css" href="../../css/navigation.css">
  <link rel="stylesheet" type="text/css" href="../../fonts/aileron_ultralight_macroman/stylesheet.css">
  <link rel="icon" href="../../img/logo.ico">

  <script type="text/javascript" src="../../js/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="../../js/navigation.js"></script>
  <link rel="stylesheet" type="text/css" href="restaurant.css">

  <title>ReeServations</title>
</head>

<body>
  <div class="container">

    <!-- header -->
    <div class="header">
      <div class="col left">
        <a href="../">
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
        <a class="item logout" href="../../logout.php">Log uit</a>
      </div>
    </div>

    <!-- content -->
    <div class="content">
      <div class="restaurants">
        <h1><?php echo $row["name"]; ?></h1>
        <?php
        if (!$result) {
          echo 'Restaurant niet gevonden';
        } else {
          // Display restaurant information
          ?>
            <div class="restaurant">
              <form method="POST" action="edit.php">
                <div class="row">
                  <div class="col-25">
                    <label for="name">Naam</label>
                  </div>
                  <div class="col-75">
                    <input type="text" id="name" name="name" value="<?php echo $row["name"]; ?>">
                  </div>
                </div>
                <div class="row">
                  <div class="col-25">
                    <label for="description">Beschrijving</label>
                  </div>
                  <div class="col-75">
                    <textarea maxlength="200" id="description" name="description" style="height:200px"><?php echo $row["description"]; ?></textarea>
                  </div>
                </div>
                <div class="row">
                  <div class="col-25">
                    <label for="email">E-mailadres</label>
                  </div>
                  <div class="col-75">
                    <input type="text" id="email" name="email" value="<?php echo $row["email"]; ?>">
                  </div>
                </div>
                <div class="row">
                  <div class="col-25">
                    <label for="address">Adres</label>
                  </div>
                  <div class="col-75">
                    <input type="text" id="address" name="address" value="<?php echo $row["address"]; ?>">
                  </div>
                </div>
                <div class="row">
                  <div class="col-25">
                    <label for="city">Plaats</label>
                  </div>
                  <div class="col-75">
                    <input type="text" id="city" name="city" value="<?php echo $row["city"]; ?>">
                  </div>
                </div>
                <div class="row">
                  <div class="col-25">
                    <label for="zip">Postcode</label>
                  </div>
                  <div class="col-75">
                    <input type="text" id="zip" name="zip" value="<?php echo $row["zip"]; ?>">
                  </div>
                </div>
                <div class="row">
                  <div class="col-25">
                    <label for="phone">Telefoon</label>
                  </div>
                  <div class="col-75">
                    <input type="text" id="phone" name="phone" value="<?php echo $row["phone"]; ?>">
                  </div>
                </div>
                <div class="row buttons">
                  <input type="hidden" name="id" value=<?php echo $res_id; ?>>
                  <input type="submit" class="button" name="edit" value="Pas aan">
                  <input type="submit" class="button" name="delete" value="Verwijder">
                </div>
              </form>
            </div>
          <?php
        }?>
      </div>
    </div>
  </div>
</body>

</html>
