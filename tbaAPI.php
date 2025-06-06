<?php

include("dbHandler.php");
include("tbaHandler.php");

$db = new dbHandler();
$dbConfig = $db->readDbConfig();
$tba = new tbaHandler($dbConfig["tbakey"], $dbConfig["tbatable"], $db->connectToDB());

$eventCode = $dbConfig["eventcode"];
if (isset($_GET["eventCode"]))
{
  // Used to over ride the written event code
  $eventCode = $_GET["eventCode"];
}

if (isset($_GET["getEventCode"]))
{
  echo ($dbConfig["eventcode"]);
}
else if (isset($_GET["getTeamInfo"]))
{
  echo (json_encode($tba->getTeamInfo($_GET["getTeamInfo"])));
}
else if (isset($_GET["getSimpleTeamList"]))
{
  echo (json_encode($tba->getSimpleTeamList($eventCode)));
}
else if (isset($_GET["getTeamListAndNames"]))
{
  echo (json_encode($tba->getTeamListAndNames($eventCode)));
}
else if (isset($_GET["getMatchList"]))
{
  echo (json_encode($tba->getMatchList($eventCode)));
}
else if (isset($_GET["getStrategicMatches"]))
{
  echo (json_encode($tba->getStrategicMatches($eventCode)));
}
else if (isset($_GET["getCOPRs"]))
{
  echo (json_encode($tba->getComponentOPRS($eventCode)));
}
