<?php
  include("dbHandler.php");
  
  if (isset($_GET["getAllData"])){
    $db = new dbHandler();
    $db->connectToDB();
    echo(json_encode($db->readAllData()));
  }
?>