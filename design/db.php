<?php 
    $connection = mysqli_connect('localhost','root','','ci_platform');
    if(!$connection)
        die('database connection failed'.mysqli_connect_error());
    date_default_timezone_set('Asia/Kolkata');
?>
