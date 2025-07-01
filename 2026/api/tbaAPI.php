<?php
/*
  Handle the blue alliance requests for update
*/
include("dbHandler.php");
include("tbaHandler.php");

$db = new dbHandler();
$dbConfig = $db->readDbConfig();
$eventCode = $dbConfig["eventcode"];

if (isset($_GET["eventCode"]))
{
  // Used to over ride the written event code
  $eventCode = $_GET["eventCode"];
}

$tba = new tbaHandler($dbConfig["tbakey"], $dbConfig["tbatable"], $db->connectToDB());

if (isset($_GET["getTeamInfo"]))
{
  echo (json_encode($tba->getTeamInfo($_GET["getTeamInfo"])));
}
else if (isset($_GET["getEventTeamNames"]))
{
  echo (json_encode($tba->getEventTeamNames($eventCode)));
}
else if (isset($_GET["getEventMatches"]))
{
  echo (json_encode($tba->getEventMatches($eventCode)));
}
else if (isset($_GET["getEventTeamsEx"]))
{
  echo (json_encode($tba->getEventTeamsEx($eventCode)));
}
else if (isset($_GET["getStrategicMatches"]))
{
  echo (json_encode($tba->getStrategicMatches($eventCode)));
}
else if (isset($_GET["getCOPRs"]))
{
  echo (json_encode($tba->getComponentOPRS($eventCode)));
}

?>

