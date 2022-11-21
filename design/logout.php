<?php
session_start();
$_SESSION['first_name'] = null;
$_SESSION['last_name'] = null;
$_SESSION['email'] = null;
$_SESSION['password'] = null;
session_destroy();
header('Location:../design/login.php');
?>