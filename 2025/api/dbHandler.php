<?php
/*
  MySQL database handler
*/
class dbHandler
{
  private $dbIniFile = "../../../../db_config.ini";
  private $charset = "utf8";
  private $conn = null;
  private $alreadyConnected = false;
  private $configKeys = array(
    "server",
    "db",
    "username",
    "password",
    "eventcode",
    "tbakey",
    "datatable",
    "tbatable",
    "pittable",
    "strategictable",
    "scouttable",
    "aliastable",
    "watchtable",
    "useP",
    "useQm",
    "useSf",
    "useF"
  );

  private $opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false
  ];

  // Connect to the database
  public function connectToDB()
  {
    if (!$this->alreadyConnected)
    {
      $dbConfig = $this->readDbConfig();
      $dsn = "mysql:host=" . $dbConfig["server"] . ";dbname=" . $dbConfig["db"] . ";charset=" . $this->charset;
      try
      {
        $this->conn = new PDO($dsn, $dbConfig["username"], $dbConfig["password"], $this->opt);
        $this->alreadyConnected = true;
      }
      catch (PDOException $e)
      {
        error_log($e);
      }
    }
    return ($this->conn);
  }

  // Connect to the server holding the database
  private function connectToServer()
  {
    $dbConfig = $this->readDbConfig();
    $dsn = "mysql:host=" . $dbConfig["server"] . ";charset=" . $this->charset;

    try
    {
      $this->conn = new PDO($dsn, $dbConfig["username"], $dbConfig["password"], $this->opt);
      $this->alreadyConnected = true;
    }
    catch (PDOException $e)
    {
      error_log($e);
    }

    return $this->conn;
  }

  ////////////////////////////////////////////////////////
  ////////////////////// Match Data //////////////////////
  ////////////////////////////////////////////////////////

  // Write match data row into table
  public function writeRowToMatchTable($mData)
  {
    $dbConfig = $this->readDbConfig();
    $sql = "INSERT INTO " . $dbConfig["datatable"] .
      "(
        entrykey,
        eventcode,
        matchnumber,
        teamnumber,
        teamalias,
        scoutname,
        autonStartPos,
        autonLeave,
        autonCoralL1,
        autonCoralL2,
        autonCoralL3,
        autonCoralL4,
        autonAlgaeNet,
        autonAlgaeProc,
        teleopCoralAcquired,
        teleopAlgaeAcquired,
        teleopCoralL1,
        teleopCoralL2,
        teleopCoralL3,
        teleopCoralL4,
        teleopAlgaeNet,
        teleopAlgaeProc,
        defenseLevel,
        endgameCageClimb,
        endgameStartClimb,
        died,
        comment
      )
      VALUES
      (
        :entrykey,
        :eventcode,
        :matchnumber,
        :teamnumber,
        :teamalias,
        :scoutname,
        :autonStartPos,
        :autonLeave,
        :autonCoralL1,
        :autonCoralL2,
        :autonCoralL3,
        :autonCoralL4,
        :autonAlgaeNet,
        :autonAlgaeProc,
        :teleopCoralAcquired,
        :teleopAlgaeAcquired,
        :teleopCoralL1,
        :teleopCoralL2,
        :teleopCoralL3,
        :teleopCoralL4,
        :teleopAlgaeNet,
        :teleopAlgaeProc,
        :defenseLevel,
        :endgameCageClimb,
        :endgameStartClimb,
        :died,
        :comment
      )";
    $prepared_statement = $this->conn->prepare($sql);
    $prepared_statement->execute($mData);
  }

  // Enforce integer data type
  private function enforceInt($val)
  {
    return intval($val);
  }

  // Enforce data typing for match data
  private function enforceDataTyping($mData)
  {
    $out = array();
    foreach ($mData as $row)
    {
      foreach ($row as $key => $value)
      {
        if (
          $key === "autonStartPos" || $key === "autonLeave" ||
          $key === "autonCoralL1" || $key === "autonCoralL2" || $key === "autonCoralL3" || $key === "autonCoralL4" ||
          $key === "autonAlgaeNet" || $key === "autonAlgaeProc" ||
          $key === "teleopCoralAcquired" || $key === "teleopAlgaeAcquired" ||
          $key === "teleopCoralL1" || $key === "teleopCoralL2" || $key === "teleopCoralL3" || $key === "teleopCoralL4" ||
          $key === "teleopAlgaeNet" || $key === "teleopAlgaeProc" || $key === "defenseLevel" ||
          $key === "endgameCageClimb" || $key === "endgameStartClimb" || $key === "died" || $key === "teamalias"
        )
        {
          $row[$key] = $this->enforceInt($value);
        }
        else
        {
          $row[$key] = $value;
        }
      }
      array_push($out, $row);
    }
    return $out;
  }

  // Read all match data for event
  public function readAllFromMatchTable($eventCode)
  {
    $dbConfig = $this->readDbConfig();
    $sql = "SELECT 
        eventcode,
        matchnumber,
        teamnumber,
        teamalias,
        scoutname,
        autonStartPos,
        autonLeave,
        autonCoralL1,
        autonCoralL2,
        autonCoralL3,
        autonCoralL4,
        autonAlgaeNet,
        autonAlgaeProc,
        teleopCoralAcquired,
        teleopAlgaeAcquired,
        teleopCoralL1,
        teleopCoralL2,
        teleopCoralL3,
        teleopCoralL4,
        teleopAlgaeNet,
        teleopAlgaeProc,
        defenseLevel,
        endgameCageClimb,
        endgameStartClimb,
        died,
        comment 
        FROM " . $dbConfig["datatable"] .
      " WHERE eventcode='" . $eventCode . "'";
    $prepared_statement = $this->conn->prepare($sql);
    $prepared_statement->execute();
    $result = $prepared_statement->fetchAll();
    return $this->enforceDataTyping($result);
  }

  // Read match data for specific team in event
  public function readTeamFromMatchTable($teamNumber, $eventCode)
  {
    $dbConfig = $this->readDbConfig();
    $sql = "SELECT 
        eventcode,
        matchnumber,
        teamnumber,
        teamalias,
        scoutname,
        autonStartPos,
        autonLeave,
        autonCoralL1,
        autonCoralL2,
        autonCoralL3,
        autonCoralL4,
        autonAlgaeNet,
        autonAlgaeProc,
        teleopCoralAcquired,
        teleopAlgaeAcquired,
        teleopCoralL1,
        teleopCoralL2,
        teleopCoralL3,
        teleopCoralL4,
        teleopAlgaeNet,
        teleopAlgaeProc,
        defenseLevel,
        endgameCageClimb,
        endgameStartClimb,
        died,
        comment 
        FROM " . $dbConfig["datatable"] .
      " WHERE eventcode='" . $eventCode . "' AND teamnumber='" . $teamNumber . "'";
    $prepared_statement = $this->conn->prepare($sql);
    $prepared_statement->execute();
    $result = $prepared_statement->fetchAll();
    return $this->enforceDataTyping($result);
  }

  ////////////////////////////////////////////////////////
  ////////////////////// Pit Data ////////////////////////
  ////////////////////////////////////////////////////////

  // Write pit data row into table
  public function writeRowToPitTable($pData)
  {
    $dbConfig = $this->readDbConfig();
    $sql = "INSERT INTO " . $dbConfig["pittable"] .
      "(
        entrykey,
        eventcode,
        teamnumber,
        scoutname,
        swerve,
        drivemotors,
        spareparts,
        proglanguage,
        computervision,
        pitorg,
        preparedness,
        numbatteries
      )
      VALUES
      (
        :entrykey,
        :eventcode,
        :teamnumber,
        :scoutname,
        :swerve,
        :drivemotors,
        :spareparts,
        :proglanguage,
        :computervision,
        :pitorg,
        :preparedness,
        :numbatteries
      )";
    $prepared_statement = $this->conn->prepare($sql);
    $prepared_statement->execute($pData);
  }

  // Read all pit data for event
  public function readAllPitTable($eventCode)
  {
    $dbConfig = $this->readDbConfig();
    $sql = "SELECT 
        teamnumber,
        scoutname,
        swerve,
        drivemotors,
        spareparts,
        proglanguage,
        computervision,
        numbatteries,
        pitorg,
        preparedness,
        numbatteries
        FROM " . $dbConfig["pittable"] .
      " WHERE eventcode='" . $eventCode . "'";
    $prepared_statement = $this->conn->prepare($sql);
    $prepared_statement->execute();
    $result = $prepared_statement->fetchAll();
    return $result;
  }

  ////////////////////////////////////////////////////////
  ////////////////////// Strategic Data //////////////////
  ////////////////////////////////////////////////////////

  // Write strategic data row into table
  public function writeRowToStrategicTable($sData)
  {
    $dbConfig = $this->readDbConfig();

    $sql = "INSERT INTO " . $dbConfig["strategictable"] .
      "(
        entrykey,
        eventcode,
        matchnumber,
        teamnumber,
        scoutname,
        driverability,
        defense_tactic1,
        defense_tactic2,
        defense_comment,
        against_tactic1,
        against_comment,
        foul1,
        autonGetCoralFromFloor,
        autonGetCoralFromStation,
        autonGetAlgaeFromFloor,
        autonGetAlgaeFromReef,
        autonFoul1,
        autonFoul2,
        teleopFloorPickupAlgae,
        teleopFloorPickupCoral,
        teleopKnockOffAlgaeFromReef,
        teleopAcquireAlgaeFromReef,
        teleopFoul1,
        teleopFoul2,
        teleopFoul3,
        teleopFoul4,
        endgameFoul1,
        problem_comment,
        general_comment
      )
      VALUES
      (
        :entrykey,
        :eventcode,
        :matchnumber,
        :teamnumber,
        :scoutname,
        :driverability,
        :defense_tactic1,
        :defense_tactic2,
        :defense_comment,
        :against_tactic1,
        :against_comment,
        :foul1,
        :autonGetCoralFromFloor,
        :autonGetCoralFromStation,
        :autonGetAlgaeFromFloor,
        :autonGetAlgaeFromReef,
        :autonFoul1,
        :autonFoul2,
        :teleopFloorPickupAlgae,
        :teleopFloorPickupCoral,
        :teleopKnockOffAlgaeFromReef,
        :teleopAcquireAlgaeFromReef,
        :teleopFoul1,
        :teleopFoul2,
        :teleopFoul3,
        :teleopFoul4,
        :endgameFoul1,
        :problem_comment,
        :general_comment
      )";
    $prepared_statement = $this->conn->prepare($sql);
    $prepared_statement->execute($sData);
  }

  // Read all strategic data for event
  public function readAllFromStrategicTable($eventCode)
  {
    $dbConfig = $this->readDbConfig();
    $sql = "SELECT 
        matchnumber,
        teamnumber,
        scoutname,
        driverability,
        defense_tactic1,
        defense_tactic2,
        defense_comment,
        against_tactic1,
        against_comment,
        foul1,
        autonGetCoralFromFloor,
        autonGetCoralFromStation,
        autonGetAlgaeFromFloor,
        autonGetAlgaeFromReef,
        autonFoul1,
        autonFoul2,
        teleopFloorPickupAlgae,
        teleopFloorPickupCoral,
        teleopKnockOffAlgaeFromReef,
        teleopAcquireAlgaeFromReef,
        teleopFoul1,
        teleopFoul2,
        teleopFoul3,
        teleopFoul4,
        endgameFoul1,
        problem_comment,
        general_comment 
        FROM " . $dbConfig["strategictable"] .
      " WHERE eventcode='" . $eventCode . "'";
    $prepared_statement = $this->conn->prepare($sql);
    $prepared_statement->execute();
    $result = $prepared_statement->fetchAll();
    return $result;
  }

  // Read strategic data for specific team in event
  public function readTeamFromStrategicTable($teamNumber, $eventCode)
  {
    $dbConfig = $this->readDbConfig();
    $sql = "SELECT 
        matchnumber,
        teamnumber,
        scoutname,
        driverability,
        defense_tactic1,
        defense_tactic2,
        defense_comment,
        against_tactic1,
        against_comment,
        foul1,
        autonGetCoralFromFloor,
        autonGetCoralFromStation,
        autonGetAlgaeFromFloor,
        autonGetAlgaeFromReef,
        autonFoul1,
        autonFoul2,
        teleopFloorPickupAlgae,
        teleopFloorPickupCoral,
        teleopKnockOffAlgaeFromReef,
        teleopAcquireAlgaeFromReef,
        teleopFoul1,
        teleopFoul2,
        teleopFoul3,
        teleopFoul4,
        endgameFoul1,
        problem_comment,
        general_comment 
        FROM " . $dbConfig["strategictable"] .
      " WHERE eventcode='" . $eventCode . "' AND teamnumber='" . $teamNumber . "'";
    $prepared_statement = $this->conn->prepare($sql);
    $prepared_statement->execute();
    $result = $prepared_statement->fetchAll();
    return $result;
  }

  ////////////////////////////////////////////////////////
  ////////////////////// Scout Name //////////////////////
  ////////////////////////////////////////////////////////

  // Write scout name record into table and replace if an entry already exists
  public function writeScoutNameToTable($sName)
  {
    $dbConfig = $this->readDbConfig();
    $sql = "INSERT INTO " . $dbConfig["scouttable"] .
      "(
        entrykey,
        eventcode,
        scoutname
      )
      VALUES
      (
        :entrykey,
        :eventcode,
        :scoutname
      )";
    $prepared_statement = $this->conn->prepare($sql);
    $prepared_statement->execute($sName);
  }

  //
  public function deleteScoutNameFromTable($sName)
  {
    $dbConfig = $this->readDbConfig();
    $sql = "DELETE FROM " . $dbConfig["scouttable"] . " WHERE entrykey='" . $sName["entrykey"] . "'";
    $prepared_statement = $this->conn->prepare($sql);
    $prepared_statement->execute();
  }

  //
  public function readEventScoutTable($eventCode)
  {
    $dbConfig = $this->readDbConfig();
    $sql = "SELECT 
        entrykey,
        eventcode,
        scoutname
        FROM " . $dbConfig["scouttable"] .
      " WHERE eventcode='" . $eventCode . "'";
    $prepared_statement = $this->conn->prepare($sql);
    $prepared_statement->execute();
    $result = $prepared_statement->fetchAll();
    return $result;
  }

  ////////////////////////////////////////////////////////
  ////////////////////// Team Alias //////////////////////
  ////////////////////////////////////////////////////////

  // Write team alias record into table and replace if an entry already exists
  public function writeAliasNumberToTable($aNum)
  {
    $dbConfig = $this->readDbConfig();
    $sql = "REPLACE INTO " . $dbConfig["aliastable"] .
      "(
        entrykey,
        eventcode,
        teamnumber,
        aliasnumber
      )
      VALUES
      (
        :entrykey,
        :eventcode,
        :teamnumber,
        :aliasnumber
      )";
    $prepared_statement = $this->conn->prepare($sql);
    $prepared_statement->execute($aNum);
  }

  // Delete team alias record from table
  public function deleteTeamAliasFromTable($aNum)
  {
    $dbConfig = $this->readDbConfig();
    $sql = "DELETE FROM " . $dbConfig["aliastable"] . " WHERE entrykey='" . $aNum["entrykey"] . "'";
    $prepared_statement = $this->conn->prepare($sql);
    $prepared_statement->execute();
  }

  // Read all team alias records for event
  public function readEventAliasTable($eventCode)
  {
    $dbConfig = $this->readDbConfig();
    $sql = "SELECT 
        entrykey,
        eventcode,
        teamnumber,
        aliasnumber
        FROM " . $dbConfig["aliastable"] .
      " WHERE eventcode='" . $eventCode . "'";
    $prepared_statement = $this->conn->prepare($sql);
    $prepared_statement->execute();
    $result = $prepared_statement->fetchAll();
    return $result;
  }

  ////////////////////////////////////////////////////////
  ////////////////////// Watch List //////////////////////
  ////////////////////////////////////////////////////////

  // Write team watch status record into table and replace if an entry already exists
  public function writeWatchStatusToTable($wStat)
  {
    $dbConfig = $this->readDbConfig();
    $sql = "REPLACE INTO " . $dbConfig["watchtable"] .
      "(
        entrykey,
        eventcode,
        teamnumber,
        status
      )
      VALUES
      (
        :entrykey,
        :eventcode,
        :teamnumber,
        :status
      )";
    $prepared_statement = $this->conn->prepare($sql);
    $prepared_statement->execute($wStat);
  }

  // Delete team watch status record from table
  public function deleteWatchStatusFromTable($wStat)
  {
    $dbConfig = $this->readDbConfig();
    $sql = "DELETE FROM " . $dbConfig["watchtable"] . " WHERE entrykey='" . $wStat["entrykey"] . "'";
    $prepared_statement = $this->conn->prepare($sql);
    $prepared_statement->execute();
  }

  // Read all team watch status records for event
  public function readEventWatchList($eventCode)
  {
    $dbConfig = $this->readDbConfig();
    $sql = "SELECT 
        entrykey,
        eventcode,
        teamnumber,
        status
        FROM " . $dbConfig["watchtable"] .
      " WHERE eventcode='" . $eventCode . "'";
    $prepared_statement = $this->conn->prepare($sql);
    $prepared_statement->execute();
    $result = $prepared_statement->fetchAll();
    return $result;
  }

  ////////////////////////////////////////////////////////
  ////////////////////// Database Creation ///////////////
  ////////////////////////////////////////////////////////

  // Create the database
  public function createDB()
  {
    error_log("createDB in dbHandler");
    $dbConfig = $this->readDbConfig();
    $this->conn = $this->connectToServer();
    $statement = $this->conn->prepare('CREATE DATABASE IF NOT EXISTS ' . $dbConfig["db"]);
    if (!$statement->execute())
    {
      throw new Exception("createDB Error: CREATE DATABASE query failed.");
    }
  }

  ////////////////////////////////////////////////////////
  ////////////////////// Table Creation //////////////////
  ////////////////////////////////////////////////////////

  // Create Match Data Table 
  public function createMatchTable()
  {
    error_log("Creating Match Table");
    $conn = $this->connectToDB();
    $dbConfig = $this->readDbConfig();
    $query = "CREATE TABLE " . $dbConfig["db"] . "." . $dbConfig["datatable"] .
      " (
        entrykey VARCHAR(60) NOT NULL PRIMARY KEY,
        eventcode VARCHAR(10) NOT NULL,
        matchnumber VARCHAR(10) NOT NULL,
        teamnumber VARCHAR(10) NOT NULL,
        teamalias VARCHAR(10) NOT NULL,
        scoutname VARCHAR(30) NOT NULL,
        autonStartPos TINYINT UNSIGNED NOT NULL,
        autonLeave TINYINT UNSIGNED NOT NULL,
        autonCoralL1 TINYINT UNSIGNED NOT NULL,
        autonCoralL2 TINYINT UNSIGNED NOT NULL,
        autonCoralL3 TINYINT UNSIGNED NOT NULL,
        autonCoralL4 TINYINT UNSIGNED NOT NULL,
        autonAlgaeNet TINYINT UNSIGNED NOT NULL,
        autonAlgaeProc TINYINT UNSIGNED NOT NULL,
        teleopCoralAcquired TINYINT UNSIGNED NOT NULL,
        teleopAlgaeAcquired TINYINT UNSIGNED NOT NULL,
        teleopCoralL1 TINYINT UNSIGNED NOT NULL,
        teleopCoralL2 TINYINT UNSIGNED NOT NULL,
        teleopCoralL3 TINYINT UNSIGNED NOT NULL,
        teleopCoralL4 TINYINT UNSIGNED NOT NULL,
        teleopAlgaeNet TINYINT UNSIGNED NOT NULL,
        teleopAlgaeProc TINYINT UNSIGNED NOT NULL,
        defenseLevel TINYINT UNSIGNED NOT NULL,
        endgameCageClimb TINYINT UNSIGNED NOT NULL,
        endgameStartClimb TINYINT UNSIGNED NOT NULL,
        died TINYINT UNSIGNED NOT NULL,
        comment VARCHAR(500) NOT NULL,
        INDEX (eventcode, matchnumber, teamnumber)
      )";
    $statement = $conn->prepare($query);
    if (!$statement->execute())
    {
      throw new Exception("createTables Error: CREATE TABLE " . $dbConfig["datatable"] . " query failed.");
    }
  }

  // Create TBA Response CacheTable
  public function createTBATable()
  {
    error_log("Creating TBA Table");
    $conn = $this->connectToDB();
    $dbConfig = $this->readDbConfig();
    $query = "CREATE TABLE " . $dbConfig["db"] . "." . $dbConfig["tbatable"] .
      " (
        requestURI VARCHAR(100) NOT NULL PRIMARY KEY,
        expiryTime BIGINT NOT NULL,
        response MEDIUMTEXT NOT NULL
      )";
    $statement = $conn->prepare($query);
    if (!$statement->execute())
    {
      throw new Exception("createTBATable Error: CREATE TABLE " . $dbConfig["tbatable"] . " query failed.");
    }
  }

  // Create Pit Data Table
  public function createPitTable()
  {
    error_log("Creating Pit Table");
    $conn = $this->connectToDB();
    $dbConfig = $this->readDbConfig();
    $query = "CREATE TABLE " . $dbConfig["db"] . "." . $dbConfig["pittable"] .
      " (
        entrykey VARCHAR(60) NOT NULL PRIMARY KEY,
        eventcode VARCHAR(10) NOT NULL,
        teamnumber VARCHAR(10) NOT NULL,
        scoutname VARCHAR(30) NOT NULL,
        swerve TINYINT UNSIGNED NOT NULL,
        drivemotors VARCHAR(20) NOT NULL,
        spareparts TINYINT UNSIGNED NOT NULL,
        proglanguage VARCHAR(20) NOT NULL,
        computervision TINYINT UNSIGNED NOT NULL,
        pitorg TINYINT UNSIGNED NOT NULL,
        preparedness TINYINT UNSIGNED NOT NULL,
        numbatteries VARCHAR(8) NOT NULL,
        INDEX (eventcode)
      )";
    $statement = $conn->prepare($query);
    if (!$statement->execute())
    {
      throw new Exception("createPitTable Error: CREATE TABLE " . $dbConfig["pittable"] . " query failed.");
    }
  }

  // Create Strategic Data Table
  public function createStrategicTable()
  {
    error_log("Creating Strategic Table");
    $conn = $this->connectToDB();
    $dbConfig = $this->readDbConfig();
    $query = "CREATE TABLE " . $dbConfig["db"] . "." . $dbConfig["strategictable"] .
      " (
        entrykey VARCHAR(60) NOT NULL PRIMARY KEY,
        eventcode VARCHAR(10) NOT NULL,
        matchnumber VARCHAR(10) NOT NULL,
        teamnumber VARCHAR(10) NOT NULL,
        scoutname VARCHAR(30) NOT NULL,
        driverability TINYINT UNSIGNED NOT NULL,
        defense_tactic1 TINYINT UNSIGNED NOT NULL,
        defense_tactic2 TINYINT UNSIGNED NOT NULL,
        defense_comment VARCHAR(500) NOT NULL,
        against_tactic1 TINYINT UNSIGNED NOT NULL,
        against_comment VARCHAR(500) NOT NULL,
        foul1 TINYINT UNSIGNED NOT NULL,
        autonGetCoralFromFloor TINYINT UNSIGNED NOT NULL,
        autonGetCoralFromStation TINYINT UNSIGNED NOT NULL,
        autonGetAlgaeFromFloor TINYINT UNSIGNED NOT NULL,
        autonGetAlgaeFromReef TINYINT UNSIGNED NOT NULL,
        autonFoul1 TINYINT UNSIGNED NOT NULL,
        autonFoul2 TINYINT UNSIGNED NOT NULL,
        teleopFloorPickupAlgae TINYINT UNSIGNED NOT NULL,
        teleopFloorPickupCoral TINYINT UNSIGNED NOT NULL,
        teleopKnockOffAlgaeFromReef TINYINT UNSIGNED NOT NULL,
        teleopAcquireAlgaeFromReef TINYINT UNSIGNED NOT NULL,
        teleopFoul1 TINYINT UNSIGNED NOT NULL,
        teleopFoul2 TINYINT UNSIGNED NOT NULL,
        teleopFoul3 TINYINT UNSIGNED NOT NULL,
        teleopFoul4 TINYINT UNSIGNED NOT NULL,
        endgameFoul1 TINYINT UNSIGNED NOT NULL,
        problem_comment VARCHAR(500) NOT NULL,
        general_comment VARCHAR(500) NOT NULL,
        INDEX (eventcode)
      )";
    $statement = $conn->prepare($query);
    if (!$statement->execute())
    {
      throw new Exception("createStrategicTable Error: CREATE TABLE " . $dbConfig["strategictable"] . " query failed.");
    }
  }

  // Create Scout Name Table
  public function createScoutTable()
  {
    error_log("Creating Scout Table");
    $conn = $this->connectToDB();
    $dbConfig = $this->readDbConfig();
    $query = "CREATE TABLE " . $dbConfig["db"] . "." . $dbConfig["scouttable"] .
      " (
        entrykey VARCHAR(60) NOT NULL PRIMARY KEY,
        eventcode VARCHAR(10) NOT NULL,
        scoutname VARCHAR(30) NOT NULL,
        INDEX (eventcode)
      )";
    $statement = $conn->prepare($query);
    if (!$statement->execute())
    {
      throw new Exception("createScoutTable Error: CREATE TABLE " . $dbConfig["scouttable"] . " query failed.");
    }
  }

  // Write JSON data to file
  public function writeJSONToFile($dat, $name)
  {
    // Write ini file string to actual file
    if ($fp = fopen($name, 'w'))
    {
      $startTime = microtime(True);
      do
      {
        $writeLock = flock($fp, LOCK_EX);
        if (!$writeLock)
        {
          usleep(round(21350));
        }
      } while ((!$writeLock) and ((microtime(True) - $startTime) < 5));

      if ($writeLock)
      {
        fwrite($fp, $dat);
        flock($fp, LOCK_UN);
      }
    }
    fclose($fp);
  }

  // Create Team Alias Data Table
  public function createAliasTable()
  {
    error_log("Creating Alias Table");
    $conn = $this->connectToDB();
    $dbConfig = $this->readDbConfig();
    $query = "CREATE TABLE " . $dbConfig["db"] . "." . $dbConfig["aliastable"] .
      " (
        entrykey VARCHAR(60) NOT NULL PRIMARY KEY,
        eventcode VARCHAR(10) NOT NULL,
        teamnumber VARCHAR(10) NOT NULL,
        aliasnumber VARCHAR(10) NOT NULL,
        INDEX (eventcode)
      )";
    $statement = $conn->prepare($query);
    if (!$statement->execute())
    {
      throw new Exception("createAliasTable Error: CREATE TABLE " . $dbConfig["aliastable"] . " query failed.");
    }
  }

  // Create Team Alias Data Table
  public function createWatchTable()
  {
    error_log("Creating Watch Table");
    $conn = $this->connectToDB();
    $dbConfig = $this->readDbConfig();
    $query = "CREATE TABLE " . $dbConfig["db"] . "." . $dbConfig["watchtable"] .
      " (
        entrykey VARCHAR(60) NOT NULL PRIMARY KEY,
        eventcode VARCHAR(10) NOT NULL,
        teamnumber VARCHAR(10) NOT NULL,
        status VARCHAR(10) NOT NULL,
        INDEX (eventcode)
      )";
    $statement = $conn->prepare($query);
    if (!$statement->execute())
    {
      throw new Exception("createWatchTable Error: CREATE TABLE " . $dbConfig["watchtable"] . " query failed.");
    }
  }

  ////////////////////////////////////////////////////////
  ////////////////////// Database Config /////////////////
  ////////////////////////////////////////////////////////

  // Read and return the database configutration file
  public function readDbConfig()
  {
    // If File doesn't exist, instantiate array as empty
    if (!file_exists($this->dbIniFile))
    {
      error_log("dbHandler: readDbConfig: db_config file does NOT exist!");
      $ini_arr = array();
    }
    else
    {
      try
      {
        error_log("dbHandler: readDbConfig: reading db_config file");
        $ini_arr = parse_ini_file($this->dbIniFile);
      }
      catch (Exception $e)
      {
        error_log("dbHandler: can't read existing db_config file, so  creating a new one");
        $ini_arr = array();
      }
    }

    // If required keys don't exist, instantiate them to default empty string
    foreach ($this->configKeys as $key)
    {
      if (!isset($ini_arr[$key]))
      {
        $ini_arr[$key] = "";
      }

      # Specific checking for match filters
      if ($key === "useP" || $key === "useQm" || $key === "useSf" || $key === "useF")
      {
        $ini_arr[$key] = ($ini_arr[$key] === "" || $ini_arr[$key] === "1" || $ini_arr[$key] === "true");
      }
    }
    return $ini_arr;
  }

  // Write database configuration file
  public function writeDbConfig($dat)
  {
    // Get values to write
    // If value is not in input, read from current DB config
    $currDBConfig = $this->readDbConfig();
    foreach ($dat as $key => $value)
    {
      error_log("dbHandler: writeDbConfig: setting currDBConfig[$key] to $value");
      $currDBConfig[$key] = $value;
    }

    // Build ini file string
    $cfgData = "";
    foreach ($currDBConfig as $key => $value)
    {
      $cfgData = $cfgData . $key . "=" . $value . "\r\n";
    }

    // Write ini file string to actual file
    if ($fp = fopen($this->dbIniFile, 'w'))
    {
      $startTime = microtime(True);
      do
      {
        $writeLock = flock($fp, LOCK_EX);
        if (!$writeLock)
        {
          usleep(round(21350));
        }
      } while ((!$writeLock) and ((microtime(True) - $startTime) < 5));

      if ($writeLock)
      {
        fwrite($fp, $cfgData);
        flock($fp, LOCK_UN);
      }
    }
    fclose($fp);
  }

  // Check database status by connecting to server, database, and each table
  public function getDBStatus(): array
  {
    $dbConfig = $this->readDbConfig();
    $out = array();
    //
    $dbStatus["server"] = $dbConfig["server"];
    $dbStatus["db"] = $dbConfig["db"];
    $dbStatus["tbakey"] = $dbConfig["tbakey"];
    $dbStatus["eventcode"] = $dbConfig["eventcode"];
    $dbStatus["username"] = $dbConfig["username"];
    $dbStatus["dbExists"] = false;
    $dbStatus["serverExists"] = false;
    $dbStatus["matchTableExists"] = false;
    $dbStatus["tbaTableExists"] = false;
    $dbStatus["pitTableExists"] = false;
    $dbStatus["strategicTableExists"] = false;
    $dbStatus["scoutTableExists"] = false;
    $dbStatus["aliasTableExists"] = false;
    $dbStatus["watchTableExists"] = false;
    $dbStatus["useP"] = $dbConfig["useP"];
    $dbStatus["useQm"] = $dbConfig["useQm"];
    $dbStatus["useSf"] = $dbConfig["useSf"];
    $dbStatus["useF"] = $dbConfig["useF"];

    // Server Connection
    if ($dbConfig["server"] != "")
    {
      try
      {
        $dsn = "mysql:host=" . $dbConfig["server"] . ";charset=" . $this->charset;
        $conn = new PDO($dsn, $dbConfig["username"], $dbConfig["password"]);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbStatus["serverExists"] = true;
      }
      catch (PDOException $e)
      {
        error_log("dbHandler: getDBStatus: server connection failed! - " . $e->getMessage());
      }

      // DB Connection
      if ($dbStatus["serverExists"] == true)
      {
        try
        {
          $dsn = "mysql:host=" . $dbConfig["server"] . ";dbname=" . $dbConfig["db"] . ";charset=" . $this->charset;
          $conn = new PDO($dsn, $dbConfig["username"], $dbConfig["password"]);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $val = $conn->query('SHOW DATABASES LIKE "' . $dbConfig["db"] . '"');
          if ($val->rowCount() != 0)
          {
            $dbStatus["dbExists"] = true;
          }
          else
          {
            error_log("dbHandler: getDBStatus: database does not exist");
          }
        }
        catch (PDOException $e)
        {
          error_log("dbHandler: getDBStatus: database connection failed! - " . $e->getMessage());
        }

        // Match data able Connection
        if ($dbStatus["dbExists"] == true)
        {
          try
          {
            $dsn = "mysql:host=" . $dbConfig["server"] . ";dbname=" . $dbConfig["db"] . ";charset=" . $this->charset;
            $conn = new PDO($dsn, $dbConfig["username"], $dbConfig["password"]);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $val = $conn->query('SELECT * FROM ' . $dbConfig["datatable"]);
            $dbStatus["matchTableExists"] = true;
          }
          catch (PDOException $e)
          {
            error_log("dbHandler: getDBStatus: match data table missing! " . $e->getMessage());
          }

          // Pit table Connection
          try
          {
            $dsn = "mysql:host=" . $dbConfig["server"] . ";dbname=" . $dbConfig["db"] . ";charset=" . $this->charset;
            $conn = new PDO($dsn, $dbConfig["username"], $dbConfig["password"]);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $val = $conn->query('SELECT * FROM ' . $dbConfig["pittable"]);
            $dbStatus["pitTableExists"] = true;
          }
          catch (PDOException $e)
          {
            error_log("dbHandler: getDBStatus: pit data table missing! - " . $e->getMessage());
          }

          // Strategic table Connection
          try
          {
            $dsn = "mysql:host=" . $dbConfig["server"] . ";dbname=" . $dbConfig["db"] . ";charset=" . $this->charset;
            $conn = new PDO($dsn, $dbConfig["username"], $dbConfig["password"]);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $val = $conn->query('SELECT * FROM ' . $dbConfig["strategictable"]);
            $dbStatus["strategicTableExists"] = true;
          }
          catch (PDOException $e)
          {
            error_log("dbHandler: getDBStatus: strategic data table missing! - " . $e->getMessage());
          }

          // TBA table Connection
          try
          {
            $dsn = "mysql:host=" . $dbConfig["server"] . ";dbname=" . $dbConfig["db"] . ";charset=" . $this->charset;
            $conn = new PDO($dsn, $dbConfig["username"], $dbConfig["password"]);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $val = $conn->query('SELECT * FROM ' . $dbConfig["tbatable"]);
            $dbStatus["tbaTableExists"] = true;
          }
          catch (PDOException $e)
          {
            error_log("dbHandler: getDBStatus: tba table missing! - " . $e->getMessage());
          }

          // Scout table Connection
          try
          {
            $dsn = "mysql:host=" . $dbConfig["server"] . ";dbname=" . $dbConfig["db"] . ";charset=" . $this->charset;
            $conn = new PDO($dsn, $dbConfig["username"], $dbConfig["password"]);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $val = $conn->query('SELECT * FROM ' . $dbConfig["scouttable"]);
            $dbStatus["scoutTableExists"] = true;
          }
          catch (PDOException $e)
          {
            error_log("dbHandler: getDBStatus: scout table missing! - " . $e->getMessage());
          }

          // Alias table Connection
          try
          {
            $dsn = "mysql:host=" . $dbConfig["server"] . ";dbname=" . $dbConfig["db"] . ";charset=" . $this->charset;
            $conn = new PDO($dsn, $dbConfig["username"], $dbConfig["password"]);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $val = $conn->query('SELECT * FROM ' . $dbConfig["aliastable"]);
            $dbStatus["aliasTableExists"] = true;
          }
          catch (PDOException $e)
          {
            error_log("dbHandler: getDBStatus: alias table missing! - " . $e->getMessage());
          }

          // Watch table Connection
          try
          {
            $dsn = "mysql:host=" . $dbConfig["server"] . ";dbname=" . $dbConfig["db"] . ";charset=" . $this->charset;
            $conn = new PDO($dsn, $dbConfig["username"], $dbConfig["password"]);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $val = $conn->query('SELECT * FROM ' . $dbConfig["watchtable"]);
            $dbStatus["watchTableExists"] = true;
          }
          catch (PDOException $e)
          {
            error_log("dbHandler: getDBStatus: watch table missing! - " . $e->getMessage());
          }
        }
      }
    }
    return $dbStatus;
  }
}

?>

