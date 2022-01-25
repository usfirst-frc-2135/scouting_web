<?php
/*
  MySQL database handler
*/

  class dbHandler {
    private $dbIniFile = "../../db_config.ini";
    private $charset = "utf8";
    private $conn = null;
    private $already_connected = false;
    
    function connectToDB(){
      if(!$this->already_connected){
        $dbConfig = $this->readDbConfig();
        $dsn = "mysql:host=" . $dbConfig["server"] . ";dbname=" . $dbConfig["db"] . ";charset=" . $this->charset;
        $opt = [
          PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
          PDO::ATTR_EMULATE_PREPARES   => false
        ];
        $this->conn = new PDO($dsn, $dbConfig["username"], $dbConfig["password"], $opt);
        $this->already_connected = true;
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
      $this->already_connected = true;
      
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
    
    function readAllData(){
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
                     eventcode from ".$dbConfig["table"];
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
            startpos VARCHAR(10) NOT NULL,
            tarmac VARCHAR(1) NOT NULL,
            autonlowpoints VARCHAR(10) NOT NULL,
            autonhighpoints VARCHAR(10) NOT NULL,
            teleoplowpoints VARCHAR(10) NOT NULL,
            teleophighpoints VARCHAR(10) NOT NULL,
            climbed VARCHAR(10) NOT NULL,
            died VARCHAR(1) NOT NULL,
            matchnumber VARCHAR(10) NOT NULL,
            eventcode VARCHAR(10) NOT NULL
        )";
      $statement = $conn->prepare($query);
      if (!$statement->execute()) {
        throw new Exception("createTable Error: CREATE TABLE ".$dbConfig["table"]." query failed.");
      }
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
      $data = $data . "server=" . $server ."\r\n";
      $data = $data . "db=" . $db ."\r\n";
      $data = $data . "username=" . $username ."\r\n";
      $data = $data . "password=" . $password ."\r\n";
      $data = $data . "table=" . $table ."\r\n";
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
    
    function getStatus(){
      $dbConfig = $this->readDbConfig();
      $out = array();
      //
      $out["server"]       = $dbConfig["server"];
      $out["db"]           = $dbConfig["db"];
      $out["username"]     = substr($dbConfig["username"], 0, 1). "*****";
      $out["dbExists"]     = false;
      $out["serverExists"] = false;
      $out["tableExists"] = false;
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