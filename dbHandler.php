/*
  MySQL database handler
/*

<?php
  class dbHandler {
    private $dbIniFile = "db_config.ini";
    private $charset = "utf8";
    
    function connect(){
      
    }
    
    function connectToServer(){
      $dbConfig = $this->readDbConfig();
      $dsn = "mysql:host=" . $dbConfig["server"] . ";charset=" . $this->charset;
      $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false
      ];
      return (new PDO($dsn, $dbConfig["username"], $dbConfig["password"], $opt));
    }
    
    function createDB(){
      
    }
    
    function readDbConfig(){
      $ini_arr = parse_ini_file($this->dbIniFile);
      if (!isset($ini_arr["server"])){$ini_arr["server"] = "";}
      if (!isset($ini_arr["db"])){$ini_arr["db"] = "";}
      if (!isset($ini_arr["username"])){$ini_arr["username"] = "";}
      if (!isset($ini_arr["password"])){$ini_arr["password"] = "";}
      if (!isset($ini_arr["table"])){$ini_arr["table"] = "";}
      return $ini_arr;
    }
    
    function writeDbConfig($server, $db, $username, $password, $table){
      //
      $data = "";
      $data = $data + "server=" + $server +"\r\n";
      $data = $data + "db=" + $db +"\r\n";
      $data = $data + "username=" + $username +"\r\n";
      $data = $data + "password=" + $password +"\r\n";
      $data = $data + "table=" + $table +"\r\n";
      //
      if($fp = fopen($this->dbIniFile, 'w')){
        $startTime = microtime(True);
        do{
          $writeLock = flock($fp, LOCK_EX);
          if(!$writeLock){
            usleep(round(21350));
          }
        } while((!$writeLock) and ((microtime(True)-$startTime) < 5));
        
        if ($writeLock){
          fwrite($fp, $data);
          flock($fp, LOCK_UN);
        }
          
      }
      fclose($fp);
    }
    
    
  }
?>