<?php 
    // host, server username, server password, database
    $connection = mysqli_connect('localhost', 'root', '', 'equipment-rental');
    if(!$connection){
        die('Connection Error!');
    }
    $base_url = "http://" . $_SERVER['SERVER_NAME'] . "/equipment-rental";
?>