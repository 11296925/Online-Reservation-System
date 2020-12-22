<?php
session_start();

$emailaddress = NULL;
if (isset($emailaddress)) {
  $emailaddress = $_SESSION['email'];
}

if ($emailaddress != NULL) {
  header('Location: ../');
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="../css/styles.css">
  <link rel="stylesheet" type="text/css" href="../fonts/aileron_ultralight_macroman/stylesheet.css">
  <link rel="icon" href="../img/logo.ico">

  <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="../js/helpers.js"></script>

  <link rel="stylesheet" type="text/css" href="register.css">
  <script type="text/javascript" src="register.js"></script>

  <title>ReeServations</title>
</head>

<body>
  <div class="container">
    <div class="header">
      <div class="col left">
        <a href="../">
          <img class="logo" src="../img/logo.png">
          <h1>ReeServations</h1>
        </a>
      </div>
      <div class="col right">

      </div>
    </div>
    <div class="content">
      <form class="register" action="register.php" method="POST" onsubmit="return validateRegister()">
        <h1>Registreer</h1>
        <label>E-mailadres <i>*</i></label>
        <input id="email" style="width: 587px;" name="email" type="text" placeholder="E-mailadres" autofocus>
        <label>Naam <i>*</i></label><br>
        <input id="firstname" name="firstname" type="text" placeholder="Voornaam">
        <input id="lastname" name="lastname" type="text" placeholder="Achternaam">
        <label>Wachtwoord <i>*</i></label><br>
        <input id="password" name="password" type="password" placeholder="Wachtwoord">
        <input id="passwordCheck" type="password" placeholder="Bevestig wachtwoord">
        <input type="submit" value="Registreer">
        <p id="error" class="mandatory"><i>[veld] is verplicht</i></p>
      </form>
    </div>
  </div>
</body>

</html>
