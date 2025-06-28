<?php
/*
  Handle database requests for update
*/
include "dbHandler.php";

if (isset($_POST["getDBStatus"]))
{
  $db = new dbHandler();
  $stat = $db->getDBStatus();
  echo json_encode($stat);
}
else if (isset($_POST["writeConfig"]))
{
  $db = new dbHandler();
  $db->writeDbConfig(json_decode($_POST["writeConfig"]));
  $stat = $db->getDBStatus();
  echo json_encode($stat);
}
else if (isset($_POST["filterConfig"]))
{
  $db = new dbHandler();
  $db->writeDbConfig(json_decode($_POST["filterConfig"]));
  $stat = $db->getDBStatus();
  echo json_encode($stat);
}
else if (isset($_POST["createDB"]))
{
  $db = new dbHandler();
  $db->createDB();
  $stat = $db->getDBStatus();
  echo json_encode($stat);
}
else if (isset($_POST["createTable"]))
{
  $db = new dbHandler();

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

  $stat = $db->getDBStatus();
  echo json_encode($stat);
}
else
{
  error_log("dbAPI.php called without a valid request");
}

?>

