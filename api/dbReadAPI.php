<?php
/*
  Handle read requests 
*/
require_once "dbHandler.php";

$db = new dbHandler();
$dbConfig = $db->readDbConfig();
$db->connectToDB();

function getRobotPhotos($team)
{
  $imageList = array();
  $suffixList = array("png", "jpg", "jpeg");
  $teamLower = strtolower($team);
  // Iterate through all valid prefixes
  foreach ($suffixList as $suffix)
  {
    $i = 0;
    // While files with the index exists
    while (true)
    {
      $image_url = "robot-pics/" . $teamLower . "-" . $i . "." . $suffix;
      // We are down one directory level, but returned URL should be relative to index.php
      if (file_exists("../$image_url") != 1)
      {
        break; // Doesn't exist
      }

      array_push($imageList, $image_url);
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

if (isset($_GET["getAllMatchData"]))
{
  // Get all data
  echo (json_encode($db->readAllFromMatchTable($eventCode)));
}
else if (isset($_GET["getTeamData"]))
{
  // Get all data for a team
  echo (json_encode($db->readTeamFromMatchTable($_GET["getTeamData"], $eventCode)));
}
else if (isset($_GET["getAllPitData"]))
{
  // Get all pit data
  $matchData = $db->readAllPitTable($eventCode);
  $out = array();
  foreach ($matchData as $row)
  {
    $out[$row["teamnumber"]] = $row;
  }
  echo (json_encode($out));
}
else if (isset($_GET["getTeamPitData"]))
{
  // Get all pit data
  $matchData = $db->readAllPitTable($eventCode);
  $out = array();
  foreach ($matchData as $row)
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
  echo (json_encode($db->readAllFromStrategicTable($eventCode)));
}
else if (isset($_GET["getTeamStrategicData"]))
{
  // Get all data for a team
  echo (json_encode($db->readTeamFromStrategicTable($_GET["getTeamStrategicData"], $eventCode)));
}

/*HOLD->
else if (isset($_GET["getTeamStrategicData"]))
{
  // Get all data for a team
  echo (json_encode($db->readTeamFromStrategicTable($_GET["getTeamData"], $eventCode)));
  // Get all strategic data
  $strategicData = $db->readTeamFromStrategicTable($eventCode);
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
else if (isset($_GET["getImagesForTeam"]))
{
  // Get all images for a team
  echo (json_encode(getRobotPhotos($_GET["getImagesForTeam"])));
}
else if (isset($_GET["getAllTeamImages"]))
{
  // Get all images for a set of teams
  $teamList = json_decode($_GET["getAllTeamImages"], true);
  $imageObj = array();
  foreach ($teamList as $team)
  {
    $imageObj[$team] = getRobotPhotos($team);
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
    }
  }
  echo (json_encode($output));
}

?>

