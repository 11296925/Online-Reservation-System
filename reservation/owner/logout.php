<?php
// Reset email address and account type
session_start();
$_SESSION['email'] = NULL;
$_SESSION['resid'] = 0;
header('Location: index.php');
?>
