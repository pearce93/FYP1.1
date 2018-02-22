<?php
  include_once("scripts/php/AP_Functions.php");
  if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
    header("Location: success.php");
  }

  //check if post form values exist
  $Username = '';
  $Password = '';
  
  //Checking that all the required feilds are set.
  if (isset($_POST['userName']) && isset($_POST['password']))
  {
    $Username = $_POST['userName'];
    $Password = $_POST['password'];
    
    login($Username, $Password);

  }

//else render page as normal
?>