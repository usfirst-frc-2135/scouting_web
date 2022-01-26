<?php
  include("dbHandler.php");
  $db = new dbHandler();
  $dbConfig = $db->readDbConfig();
  $db->connectToDB();
  
  $eventCode = $dbConfig["eventcode"];
  if (isset($_GET["eventCode"])){
    $eventCode = $_GET["eventCode"];
  }
  
  if (isset($_GET["getAllData"])){
    echo(json_encode($db->readAllData($eventCode)));
  }
?>