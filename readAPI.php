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
    // Get all data
    echo(json_encode($db->readAllData($eventCode)));
  }
  else if (isset($_GET["getTeamData"])){
    // Get all data for a team
    echo(json_encode($db->readTeamData($_GET["getTeamData"], $eventCode)));
  }
  else if (isset($_GET["getTeamImages"])){
    // Get all images for a team
    $imageList = array();
    $suffixList = array("png", "jpg", "jpeg");
    $teamLower = strtolower($_GET["getTeamImages"]);
    // Iterate through all valid prefixes
    foreach($suffixList as $suffix){
      $i =0;
      // While files with the index exist
      while(true){
        $image_url = "robot-pics/" . $teamLower . "-" . $i . "." . $suffix;
        if(file_exists($image_url) == 1){
          array_push($imageList, $image_url);
        }
        else {
          break;
        }
        $i++;
      }
    }
    
    if ($teamLower == "2135"){
      // Easter egg to always add a picture of grogu to the team images
      array_push($imageList, "robot-pics/grogu.jpeg");
    }
    echo(json_encode($imageList));
  }
  else if (isset($_GET["config"])){
    $output = array();
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
    echo(json_encode($output));
  }
?>