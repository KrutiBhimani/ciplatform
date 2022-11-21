<?php include "db.php";
session_start();?>
<?php 
    if(!isset($_SESSION['email'])){
      header('Location:../ci-platform/login.php');
    }
?>