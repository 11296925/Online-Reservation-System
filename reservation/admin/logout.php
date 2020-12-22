<?php
session_start();
$_SESSION['email'] = NULL;
$_SESSION['admin'] = NULL;
header('Location: login');
# DIT IS EEN COMMENT
?>
