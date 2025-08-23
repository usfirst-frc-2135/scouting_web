<?php
/*
  Handle read requests 
*/
include "dbHandler.php";

$db = new dbHandler();
$dbConfig = $db->readDbConfig();

$eventCode = $dbConfig["eventcode"];
if (isset($_GET["eventCode"]))
{
  $eventCode = $_GET["eventCode"];
}

if (isset($_POST["writeTeamMatch"]))
{
  // Write Data API
  $db->connectToDB();
  $dat = json_decode($_POST["writeTeamMatch"], true);
  $msg = "success";
  for ($i = 0; $i < count($dat); ++$i)
  {
    $dat[$i]["entrykey"] = $dat[$i]["eventcode"] . "_" . $dat[$i]["matchnumber"] . "_" . $dat[$i]["teamnumber"];
    try
    {
      $db->writeRowToMatchTable($dat[$i]);
    }
    catch (Exception $e)
    {
      error_log("! writeRowToMatchTable() threw exception = $e");
      $msg = "fail";
    }
  }
  echo $msg;
}

if (isset($_POST["writeSingleData"]))
{
  // Write Data API
  $db->connectToDB();
  $dat = json_decode($_POST["writeSingleData"], true);
  // echo($_POST["writeTeamMatch"]);
  $dat["eventcode"] = $eventCode;
  $dat["entrykey"] = $dat["eventcode"] . "_" . $dat["matchnumber"] . "_" . $dat["teamnumber"];
  $db->writeRowToMatchTable($dat);
  echo "success";
}

if (isset($_POST["writePitTable"]))
{
  $db->connectToDB();
  $args = json_decode($_POST["writePitTable"], true);

  $args["entrykey"] = $eventCode . "_" . $args["teamnumber"];
  $args["eventcode"] = $eventCode;
  $db->writeRowToPitTable($args);
  echo "success";
}

if (isset($_POST["writeStrategicData"]))
{
  $db->connectToDB();
  $args = json_decode($_POST["writeStrategicData"], true);

  $args["eventcode"] = $eventCode;
  $msg = "success";
  $args["entrykey"] = $args["eventcode"] . "_" . $args["matchnumber"] . "_" . $args["teamnumber"];
  try
  {
    $db->writeRowToStrategicTable($args);
  }
  catch (Exception $e)
  {
    error_log("! writeStrategicData() threw exception = $e");
    $msg = "fail";
  }
  echo $msg;
}

if (isset($_POST["writePicklist"]))
{
  $plistData = $_POST["writePicklist"];
  $fileName = "$eventCode.csv";
  error_log("writePicklist fileName = $fileName");
  $file = fopen($fileName, "w");
  fwrite($file, $plistData);
  fclose($file);
}

if (isset($_POST["teamNum"]) and isset($_FILES["teamPic"]))
{
  // For testing: add a delay
  // TEST  sleep(10); // 10 seconds delay

  // Upload Photo API
  $uploadSuccess = false;
  $errorMessage = "";
  $target_dir = "robot-pics/";
  $imageFileType = strtolower(pathinfo(basename($_FILES["teamPic"]["name"]), PATHINFO_EXTENSION));
  $target_file = $target_dir . $_POST["teamNum"];

  // Check that there is a file in the POST request
  if (getimagesize($_FILES["teamPic"]["tmp_name"]) !== false)
  {
    // Check that the size of the file is less than the number below
    if ($_FILES["teamPic"]["size"] < 100000000)
    {
      // Check that the file type is a JPG or PNG
      if ($imageFileType === "jpg" || $imageFileType === "JPG" || $imageFileType === "PNG" || $imageFileType === "png" || $imageFileType === "jpeg" || $imageFileType === "JPEG" || $imageFileType === "gif" || $imageFileType === "GIF")
      {
        $i = 0;
        $fileValid = false;
        $newFileName = "";
        // Check that the file names that we want are not taken
        while ($i < 20)
        {
          $newFileName = strtolower("../" . $target_file . '-' . $i . '.' . $imageFileType);
          if (file_exists($newFileName))
          {
            $i++;
          }
          else
          {
            $fileValid = true;
            break;
          }
        }
        if ($fileValid)
        {
          // Upload the file to the folder
          if (move_uploaded_file($_FILES["teamPic"]["tmp_name"], $newFileName))
          {
            $uploadSuccess = true;
          }
          else
          {
            $errorMessage = "Server had issue uploading photo.";
          }
        }
        else
        {
          $errorMessage = "Too many images exist for this team in the DB. Please contact the Scouting Admin.";
        }
      }
      else
      {
        $errorMessage = "File not JPG or PNG.";
      }
    }
    else
    {
      $errorMessage = "Image too large.";
    }
  }
  else
  {
    $errorMessage = "Image does not exist.";
  }

  $response = array();
  $response["success"] = $uploadSuccess;
  $response["message"] = $errorMessage;
  echo json_encode($response);
}

?>

