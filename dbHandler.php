<?php
/*
  MySQL database handler
*/

  class dbHandler {
    private $dbIniFile = "../../db_config.ini";
    private $charset = "utf8";
    private $conn = null;
    private $alreadyConnected = false;
    private $configKeys = array("server", "db", "username", "password", "table", "eventcode", "tbakey", 
                                "fbapikey", "fbauthdomain", "fbdburl", "fbprojectid", "fbstoragebucket", 
                                "fbsenderid", "fbappid", "fbmeasurementid");
    
    function connectToDB(){
      if(!$this->alreadyConnected){
        $dbConfig = $this->readDbConfig();
        $dsn = "mysql:host=" . $dbConfig["server"] . ";dbname=" . $dbConfig["db"] . ";charset=" . $this->charset;
        $opt = [
          PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
          PDO::ATTR_EMULATE_PREPARES   => false
        ];
        $this->conn = new PDO($dsn, $dbConfig["username"], $dbConfig["password"], $opt);
        $this->alreadyConnected = true;
      }
      return ($this->conn);
    }
    
    function connectToServer(){
      
      $dbConfig = $this->readDbConfig();
      $dsn = "mysql:host=" . $dbConfig["server"] . ";charset=" . $this->charset;
      $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false
      ];
      $this->alreadyConnected = true;
      
      return (new PDO($dsn, $dbConfig["username"], $dbConfig["password"], $opt));
    }
    
    function writeRowToTable($data){
      $dbConfig = $this->readDbConfig();
      $sql = "INSERT INTO ".$dbConfig["table"]."(entrykey,
                       teamnumber,
                       startpos,
                       tarmac,
                       autonlowpoints,
                       autonhighpoints,
                       teleoplowpoints,
                       teleophighpoints,
                       climbed,
                       died,
                       matchnumber,
                       eventcode)
                VALUES(:entrykey,
                       :teamnumber,
                       :startpos,
                       :tarmac,
                       :autonlowpoints,
                       :autonhighpoints,
                       :teleoplowpoints,
                       :teleophighpoints,
                       :climbed,
                       :died,
                       :matchnumber,
                       :eventcode)";
      $prepared_statement = $this->conn->prepare($sql);
      $prepared_statement->execute($data);
    }
    
    function readAllData($eventCode){
      $dbConfig = $this->readDbConfig();
      $sql = "SELECT teamnumber,
                     startpos,
                     tarmac,
                     autonlowpoints,
                     autonhighpoints,
                     teleoplowpoints,
                     teleophighpoints,
                     climbed,
                     died,
                     matchnumber,
                     eventcode from ".$dbConfig["table"]." where eventcode='".$eventCode."'";
      $prepared_statement = $this->conn->prepare($sql);
      $prepared_statement->execute();
      $result = $prepared_statement->fetchAll();
      return $result;
    }
    
    function readTeamData($teamNumber, $eventCode){
      $dbConfig = $this->readDbConfig();
      $sql = "SELECT teamnumber,
                     startpos,
                     tarmac,
                     autonlowpoints,
                     autonhighpoints,
                     teleoplowpoints,
                     teleophighpoints,
                     climbed,
                     died,
                     matchnumber,
                     eventcode from ".$dbConfig["table"]." where 
                      eventcode='".$eventCode."' AND
                      teamnumber='".$teamNumber."'";
      $prepared_statement = $this->conn->prepare($sql);
      $prepared_statement->execute();
      $result = $prepared_statement->fetchAll();
      return $result;
    }
    
    function createDB(){
      $dbConfig = $this->readDbConfig();
      $connection = $this->connectToServer();
      $statement = $connection->prepare('CREATE DATABASE IF NOT EXISTS ' . $dbConfig["db"]);
      if (!$statement->execute()) {
        throw new Exception("createDB Error: CREATE DATABASE query failed.");
      }
    }
    
    function createTable(){
      $conn = $this->connectToDB();
      $dbConfig = $this->readDbConfig();
      $query = "CREATE TABLE " . $dbConfig["db"] . "." . $dbConfig["table"] . " (
            entrykey VARCHAR(60) NOT NULL PRIMARY KEY,
            teamnumber VARCHAR(6) NOT NULL,
            startpos TINYINT UNSIGNED NOT NULL,
            tarmac TINYINT UNSIGNED NOT NULL,
            autonlowpoints TINYINT UNSIGNED NOT NULL,
            autonhighpoints TINYINT UNSIGNED NOT NULL,
            teleoplowpoints TINYINT UNSIGNED NOT NULL,
            teleophighpoints TINYINT UNSIGNED NOT NULL,
            climbed TINYINT UNSIGNED NOT NULL,
            died TINYINT UNSIGNED NOT NULL,
            matchnumber VARCHAR(10) NOT NULL,
            eventcode VARCHAR(10) NOT NULL
        )";
      $statement = $conn->prepare($query);
      if (!$statement->execute()) {
        throw new Exception("createTable Error: CREATE TABLE ".$dbConfig["table"]." query failed.");
      }
    }
    
    
    
    function readDbConfig(){
      // Read dbIniFile
      // If File doesn't exist, instantiate array as empty
      try{
        $ini_arr = parse_ini_file($this->dbIniFile);
      }
      catch(Exception $e){
        $ini_arr = array();
      }
      // If required keys don't exist, instantiate them to default empty string
      foreach($this->configKeys as $key){
        if(!isset($ini_arr[$key])){
          $ini_arr[$key] = "";
        }
      }
      return $ini_arr;
    }
    
    function writeDbConfig($dat){
      // Get values to write
      // If value is not in input, read from current DB config
      $currDBConfig = $this->readDbConfig();
      foreach($dat as $key => $value){
        $currDBConfig[$key] = $value;
      }     
      // Build ini file string
      $data = "";
      foreach($currDBConfig as $key => $value){
        $data = $data . $key . "=" . $value . "\r\n";
      }
      // Write ini file string to actual file
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
    
    function getStatus(){
      $dbConfig = $this->readDbConfig();
      $out = array();
      //
      $out["server"]          = $dbConfig["server"];
      $out["db"]              = $dbConfig["db"];
      $out["tbakey"]          = substr($dbConfig["tbakey"], 0, 3) . "******";
      $out["eventcode"]       = $dbConfig["eventcode"];
      $out["username"]        = substr($dbConfig["username"], 0, 1). "*****";
      $out["fbapikey"]        = substr($dbConfig["fbapikey"], 0, 1). "*****";
      $out["fbauthdomain"]    = $dbConfig["fbauthdomain"];
      $out["fbdburl"]         = substr($dbConfig["fbdburl"], 0, 1). "*****";
      $out["fbprojectid"]     = substr($dbConfig["fbprojectid"], 0, 1). "*****";
      $out["fbstoragebucket"] = substr($dbConfig["fbstoragebucket"], 0, 1). "*****";
      $out["fbsenderid"]      = substr($dbConfig["fbsenderid"], 0, 1). "*****";
      $out["fbappid"]         = substr($dbConfig["fbappid"], 0, 1). "*****";
      $out["fbmeasurementid"] = substr($dbConfig["fbmeasurementid"], 0, 1). "*****";
      $out["dbExists"]        = false;
      $out["serverExists"]    = false;
      $out["tableExists"]     = false;
      //DB Connection
      try{
        $dsn = "mysql:host=" . $dbConfig["server"] . ";dbname=" . $dbConfig["db"] . ";charset=" . $this->charset;
        $conn = new PDO($dsn, $dbConfig["username"], $dbConfig["password"]);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $out["dbExists"] = true;
      } catch(PDOException $e){
        $out["DBExists"] = false;
      }
      //Server Connection
      try{
        $dsn = "mysql:host=" . $dbConfig["server"] . ";charset=" . $this->charset;
        $conn = new PDO($dsn, $dbConfig["username"], $dbConfig["password"]);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $out["serverExists"] = true;
      } catch(PDOException $e){
        $out["ServerExists"] = false;
      }
      // Table Connection
      try{
        $dsn = "mysql:host=" . $dbConfig["server"] . ";dbname=" . $dbConfig["db"] . ";charset=" . $this->charset;
        $conn = new PDO($dsn, $dbConfig["username"], $dbConfig["password"]);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $val = $conn->query('SELECT * from ' . $dbConfig["table"]) ;
        $out["tableExists"] = true;
      } catch(PDOException $e){
        $out["tableExists"] = false;
      }
      return $out;
    }
    
  }
?>