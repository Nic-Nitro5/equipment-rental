<?php 
require_once("config/db.php");
session_start();
if(!isset($_SESSION['user'])){
    echo "<script>location.href='login.php';</script>";
    exit;
}

if(isset($_REQUEST['id'])){
    $query = "INSERT INTO `ordered_items`(`item_id`, `user_id`) VALUES ('".$_REQUEST['id']."', '".$_SESSION['user']['id']."')";
    $result = mysqli_query($connection, $query);
  
    if($result){
      header('Location: ordered_products.php');
    }else{
      die('Something went wrong! <a href="'.$base_url.'/index.php">Home</a>');
    }
}
?>