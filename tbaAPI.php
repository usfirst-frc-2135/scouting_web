<?php
  include("dbHandler.php");
  include("tbaHandler.php");
  
  $db = new dbHandler();
  $dbConfig = $db->readDbConfig();
  $tba = new tbaHandler($dbConfig["tbakey"], $dbConfig["tbatable"], $db->connectToDB());
  
  $eventCode = $dbConfig["eventcode"];
  if (isset($_GET["eventcode"])){
    // Used to over ride the written event code
    $eventCode = $_GET["eventcode"];
  }
  
  if (isset($_GET["getEventCode"])){
    echo($dbConfig["eventcode"]);
  }
  else if (isset($_GET["getTeamList"])){
    // $tba->getTeamList($eventCode);
    echo(json_encode($tba->getSimpleTeamList($eventCode)));
  }
  
?>