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

  <!-- styling -->
  <link rel="stylesheet" type="text/css" href="../../css/styles.css">
  <link rel="stylesheet" type="text/css" href="../../fonts/aileron_ultralight_macroman/stylesheet.css">

  <!-- javascript -->
  <script type="text/javascript" src="../../js/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="../../js/helpers.js"></script>

  <!-- page specific -->
  <script type="text/javascript" src="login.js"></script>
  <link rel="stylesheet" type="text/css" href="login.css">

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

      </div>
    </div>

    <!-- content -->
    <div class="content">
      <form class="login" action="login.php" method="POST" onsubmit="return validateLogin()">
        <h1>Login</h1>
        <input id="email" name="email" type="text" placeholder="E-maiadres" autofocus>
        <input id="password" name="password" type="password" placeholder="Wachtwoord">
        <input type="submit" value="Login">
        <p class="login-lost"><a href="../../login/lost/">Wachtwoord vergeten?</a></p>
        <p id="error" class="mandatory"><i>[veld] is verplicht</i></p>
      </form>
    </div>
  </div>
</body>

</html>
