<?php
include("../config.php");
session_start();


// Force user to be logged in
$emailaddress = NULL;
if (isset($_SESSION['email'])) {
  $emailaddress = $_SESSION['email'];
} else {
  header('Location: ../../login/');
}

$emailaddress = mysqli_real_escape_string($db, $emailaddress);

// Get user infomration
$query = "SELECT * FROM Users WHERE email='$emailaddress'";
$result = mysqli_query($db, $query);
$row = $result->fetch_array(MYSQLI_ASSOC)
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
  <link rel="stylesheet" type="text/css" href="account.css">
  <script type="text/javascript" src="account.js"></script>

  <title>ReeServations</title>
</head>

<body>
  <div class="container">
    <!-- header -->
    <div class="header">
      <div class="col left">
        <a href="../">
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
        <!-- navigation based on if user loged in -->
        <?php if ($emailaddress != NULL) { ?>
        <a class="item logout" href="../logout.php">Log uit</a>
        <?php } else { ?>
        <a class="item logout" href="../login/">Log in</a>
        <?php } ?>
        <a class="item" href="../">Home</a>
        <?php if ($emailaddress != NULL) { ?>
        <a class="item active" href="">Mijn profiel</a>
        <a class="item" href="bookings/">Mijn reserveringen</a>
        <?php } ?>
      </div>
    </div>

    <!-- content -->
    <div class="content">
      <div class="account-wrap">
        <h1>Mijn profiel</h1>
          <div class="account">
            <form method="POST" action="edit.php">
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
                  <label for="fname">Voornaam</label>
                </div>
                <div class="col-75">
                  <input type="text" id="fname" name="fname" value="<?php echo $row["firstname"]; ?>">
                </div>
              </div>
              <div class="row">
                <div class="col-25">
                  <label for="lname">Achternaam</label>
                </div>
                <div class="col-75">
                  <input type="text" id="lname" name="lname" value="<?php echo $row["lastname"]; ?>">
                </div>
              </div>
              <div class="row buttons">
                <input type="submit" class="button" name="edit" value="Pas aan">
                <input type="submit" class="button" name="delete" value="Verwijder">
              </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</body>

</html>
