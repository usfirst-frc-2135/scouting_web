<?php

require_once "dbHandler.php";

$db = new dbHandler();
$dbConfig = $db->readDbConfig();
$db->connectToDB();

function getTeamPicture($team)
{
  $imageList = array();
  $suffixList = array("png", "jpg", "jpeg");
  $teamLower = strtolower($team);
  // Iterate through all valid prefixes
  foreach ($suffixList as $suffix)
  {
    $i = 0;
    // While files with the index exist
    while (true)
    {
      $image_url = "robot-pics/" . $teamLower . "-" . $i . "." . $suffix;
      if (file_exists($image_url) == 1)
      {
        array_push($imageList, $image_url);
      }
      else
      {
        break;
      }
      $i++;
    }
  }
  return $imageList;
}

$eventCode = $dbConfig["eventcode"];
if (isset($_GET["eventCode"]))
{
  $eventCode = $_GET["eventCode"];
}

if (isset($_GET["getAllData"]))
{
  // Get all data
  echo (json_encode($db->readAllData($eventCode)));
}
else if (isset($_GET["getTeamData"]))
{
  // Get all data for a team
  echo (json_encode($db->readTeamData($_GET["getTeamData"], $eventCode)));
}
else if (isset($_GET["getAllPitData"]))
{
  // Get all pit data
  $rawData = $db->readPitData($eventCode);
  $out = array();
  foreach ($rawData as $row)
  {
    $out[$row["teamnumber"]] = $row;
  }
  echo (json_encode($out));
}
else if (isset($_GET["getTeamPitData"]))
{
  // Get all pit data
  $rawData = $db->readPitData($eventCode);
  $out = array();
  foreach ($rawData as $row)
  {
    if ($row["teamnumber"] == $_GET["getTeamPitData"])
    {
      $out = $row;
      break;
    }
  }
  echo (json_encode($out));
}
else if (isset($_GET["getAllStrategicData"]))
{
  // Get all data
  echo (json_encode($db->readAllStrategicData($eventCode)));
}
else if (isset($_GET["getTeamStrategicData"]))
{
  // Get all data for a team
  echo (json_encode($db->readTeamStrategicData($_GET["getTeamStrategicData"], $eventCode)));
}

/*HOLD->
else if (isset($_GET["getTeamStrategicData"]))
{
  // Get all data for a team
  echo (json_encode($db->readTeamStrategicData($_GET["getTeamData"], $eventCode)));
  // Get all strategic data
  $strategicData = $db->readTeamStrategicData($eventCode);
  $out = array();
  foreach ($strategicData as $row)
  {
    if ($row["teamnumber"] == $_GET["getTeamStrategicData"])
    {
      $out = $row;
      break;
    } 
  }
  echo (json_encode($out));
}<-HOLD */
else if (isset($_GET["getTeamImages"]))
{
  // Get all images for a team
  echo (json_encode(getTeamPicture($_GET["getTeamImages"])));
}
else if (isset($_GET["getTeamsImages"]))
{
  // Get all images for a set of teams
  $teamList = json_decode($_GET["getTeamsImages"], true);
  $imageObj = array();
  foreach ($teamList as $team)
  {
    $imageObj[$team] = getTeamPicture($team);
  }
  echo (json_encode($imageObj));
}
else if (isset($_GET["config"]))
{
  $output = array();
  $output["response"] = False;
  if (isset($_GET["secret"]))
  {
    if (strcmp($_GET["secret"], "CHANGE_PER_SERVER") == 0)
    {
      $output["response"] = True;
      $output["eventcode"] = $dbConfig["eventcode"];
      $output["tbakey"] = $dbConfig["tbakey"];
      $output["fbapikey"] = $dbConfig["fbapikey"];
      $output["fbauthdomain"] = $dbConfig["fbauthdomain"];
      $output["fbdburl"] = $dbConfig["fbdburl"];
      $output["fbprojectid"] = $dbConfig["fbprojectid"];
      $output["fbstoragebucket"] = $dbConfig["fbstoragebucket"];
      $output["fbsenderid"] = $dbConfig["fbsenderid"];
      $output["fbappid"] = $dbConfig["fbappid"];
      $output["fbmeasurementid"] = $dbConfig["fbmeasurementid"];
    }
  }
  echo (json_encode($output));
}
