<?php
/*
  Handle database requests for update
*/
include "dbHandler.php";

$db = new dbHandler();
$dbConfig = $db->readDbConfig();
$eventCode = $dbConfig["eventcode"];

if (isset($_GET["eventCode"]))
{
  // Used to over ride the written event code
  $eventCode = $_GET["eventCode"];
}

if (isset($_GET["getEventCode"]))
{
  echo $dbConfig["eventcode"];
}
else if (isset($_POST["getDBStatus"]))
{
  $stat = $db->getDBStatus();
  echo json_encode($stat);
}
else if (isset($_POST["writeScoutNameJSON"]))
{
  $db->writeJSONToFile($_POST["writeScoutNameJSON"], $_POST["filename"]);
  $stat = $db->getDBStatus();
  echo json_encode($stat);
}
else if (isset($_POST["writeTeamAliasJSON"]))
{
  $db->writeJSONToFile($_POST["writeTeamAliasJSON"], $_POST["filename"]);
  $stat = $db->getDBStatus();
  echo json_encode($stat);
}
else if (isset($_POST["writeConfig"]))
{
  $db->writeDbConfig(json_decode($_POST["writeConfig"]));
  $stat = $db->getDBStatus();
  echo json_encode($stat);
}
else if (isset($_POST["filterConfig"]))
{
  $db->writeDbConfig(json_decode($_POST["filterConfig"]));
  $stat = $db->getDBStatus();
  echo json_encode($stat);
}
else if (isset($_POST["createDB"]))
{
  $db->createDB();
  $stat = $db->getDBStatus();
  echo json_encode($stat);
}
else if (isset($_POST["createTables"]))
{
  try
  {
    $db->createMatchTable();
  }
  catch (Exception $e)
  {
    error_log($e);
  }

  try
  {
    $db->createTBATable();
  }
  catch (Exception $e)
  {
    error_log($e);
  }

  try
  {
    $db->createPitTable();
  }
  catch (Exception $e)
  {
    error_log($e);
  }

  try
  {
    $db->createStrategicTable();
  }
  catch (Exception $e)
  {
    error_log($e);
  }

  try
  {
    $db->createScoutTable();
  }
  catch (Exception $e)
  {
    error_log($e);
  }

  try
  {
    $db->createAliasTable();
  }
  catch (Exception $e)
  {
    error_log($e);
  }

  $stat = $db->getDBStatus();
  echo json_encode($stat);
}
else
{
  error_log("dbAPI.php called without a valid request");
}

?>

