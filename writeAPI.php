<?php
  include("dbHandler.php");
  
  if (isset($_POST["writeData"])){
    $db = new dbHandler();
    $db->connectToDB();
    $dat = json_decode($_POST["writeData"], true);
    // echo($_POST["writeData"]);
    for($i = 0; $i < count($dat); ++$i){
      $dat[$i]["entrykey"] = $dat[$i]["eventcode"] . "_" . $dat[$i]["matchnumber"] . "_" . $dat[$i]["teamnumber"];
      try{
        $db->writeRowToTable($dat[$i]);
      }
      catch(Exception $e){
      } 
    }
  }
?>