<?php
  include("dbHandler.php");

  if (isset($_POST["getStatus"])){
    $db = new dbHandler();
    $stat = $db->getStatus();
    echo json_encode($stat);
  }
  else if (isset($_POST["writeConfig"])){
    $db = new dbHandler();
    $db->writeDbConfig(json_decode($_POST["writeConfig"]));
    $stat = $db->getStatus();
    echo json_encode($stat);
  }
  else if (isset($_POST["filterConfig"])){
    $db = new dbHandler();
    $db->writeDbConfig(json_decode($_POST["filterConfig"]));
    $stat = $db->getStatus();
    echo json_encode($stat);
  }
  else if (isset($_POST["createDB"])){
    $db = new dbHandler();
    $db->createDB();
    $stat = $db->getStatus();
    echo json_encode($stat);
  }
  else if (isset($_POST["createTable"])){
    $db = new dbHandler();
    try{ $db->createDataTable(); } catch (Exception $e) {error_log($e);} 
    try{ $db->createTBATable(); } catch (Exception $e) {error_log($e);} 
    try{ $db->createPitTable(); } catch (Exception $e) {error_log($e);} 
    // try{ $db->createRankTable(); } catch (Exception $e) {error_log($e)} 
    $stat = $db->getStatus();
    echo json_encode($stat);
    
  }
?>