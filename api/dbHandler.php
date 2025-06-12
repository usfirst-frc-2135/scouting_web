<?php
/*
  MySQL database handler
*/
class dbHandler
{
  private $dbIniFile = "../../../db_config.ini";
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
    "useP",
    "useQm",
    "useQf",
    "useSf",
    "useF"
  );

  // Connect to the database
  public function connectToDB()
  {
    if (!$this->alreadyConnected)
    {
      $dbConfig = $this->readDbConfig();
      $dsn = "mysql:host=" . $dbConfig["server"] . ";dbname=" . $dbConfig["db"] . ";charset=" . $this->charset;
      $opt = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
      ];
      $this->conn = new PDO($dsn, $dbConfig["username"], $dbConfig["password"], $opt);
      $this->alreadyConnected = true;
    }
    return ($this->conn);
  }

  // Connect to the server holding the database
  private function connectToServer()
  {
    $dbConfig = $this->readDbConfig();
    $dsn = "mysql:host=" . $dbConfig["server"] . ";charset=" . $this->charset;
    $opt = [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES => false
    ];
    $this->alreadyConnected = true;

    return (new PDO($dsn, $dbConfig["username"], $dbConfig["password"], $opt));
  }

  public function writeRowToMatchTable($data)
  {
    $dbConfig = $this->readDbConfig();
    $sql = "INSERT INTO " . $dbConfig["datatable"] .
      "(entrykey,
        teamnumber,
        autonStartPos,
        autonLeave,
        reefzoneAB,
        reefzoneCD,
        reefzoneEF,
        reefzoneGH,
        reefzoneIJ,
        reefzoneKL,
        autonCoralL1,
        autonCoralL2,
        autonCoralL3,
        autonCoralL4,
        autonAlgaeNet,
        autonAlgaeProcessor,
        autonCoralFloor,
        autonCoralStation,
        autonAlgaeFloor,
        autonAlgaeReef,
        acquiredCoral,
        acquiredAlgae,
        teleopAlgaeFloorPickup,
        teleopCoralFloorPickup,
        teleopKnockOffAlgae,
        teleopAlgaeFromReef,
        teleopHoldBoth,
        teleopCoralL1,
        teleopCoralL2,
        teleopCoralL3,
        teleopCoralL4,
        teleopAlgaeNet,
        teleopAlgaeProcessor,
        defenseLevel,
        cageClimb,
        startClimb,
        died,
        matchnumber,
        eventcode,
        scoutname,
        comment)
      VALUES(:entrykey,
        :teamnumber,
        :autonStartPos,
        :autonLeave,
        :reefzoneAB,
        :reefzoneCD,
        :reefzoneEF,
        :reefzoneGH,
        :reefzoneIJ,
        :reefzoneKL,
        :autonCoralL1,
        :autonCoralL2,
        :autonCoralL3,
        :autonCoralL4,
        :autonAlgaeNet,
        :autonAlgaeProcessor,
        :autonCoralFloor,
        :autonCoralStation,
        :autonAlgaeFloor,
        :autonAlgaeReef,
        :acquiredCoral,
        :acquiredAlgae,
        :teleopAlgaeFloorPickup,
        :teleopCoralFloorPickup,
        :teleopKnockOffAlgae,
        :teleopAlgaeFromReef,
        :teleopHoldBoth,
        :teleopCoralL1,
        :teleopCoralL2,
        :teleopCoralL3,
        :teleopCoralL4,
        :teleopAlgaeNet,
        :teleopAlgaeProcessor,
        :defenseLevel,
        :cageClimb,
        :startClimb,
        :died,
        :matchnumber,
        :eventcode,
        :scoutname,
        :comment)";
    $prepared_statement = $this->conn->prepare($sql);
    $prepared_statement->execute($data);
  }

  private function enforceInt($val)
  {
    return intval($val);
  }

  private function enforceDataTyping($data)
  {
    $out = array();
    foreach ($data as $row)
    {
      foreach ($row as $key => $value)
      {
        if ($key == "autonStartPos" || $key == "autonLeave" || $key == "reefzoneAB" || $key == "reefzoneCD" || $key == "reefzoneEF" || $key == "reefzoneGH" || $key == "reefzoneIJ" || $key == "reefzoneKL" || $key == "autonCoralL1" || $key == "autonCoralL2" || $key == "autonCoralL3" || $key == "autonCoralL4" || $key == "autonAlgaeNet" || $key == "autonAlgaeProcessor" || $key == "autonCoralFloor" || $key == "autonCoralStation" || $key == "autonAlgaeFloor" || $key == "autonAlgaeReef" || $key == "acquiredCoral" || $key == "acquiredAlgae" || $key == "teleopAlgaeFloorPickup" || $key == "teleopCoralFloorPickup" || $key == "teleopKnockOffAlgae" || $key == "teleopAlgaeFromReef" || $key == "teleopHoldBoth" || $key == "teleopCoralL1" || $key == "teleopCoralL2" || $key == "teleopCoralL3" || $key == "teleopCoralL4" || $key == "teleopAlgaeNet" || $key == "teleopAlgaeProcessor" || $key == "defenseLevel" || $key == "cageClimb" || $key == "startClimb" || $key == "died")
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

  public function readAllFromMatchTable($eventCode)
  {
    $dbConfig = $this->readDbConfig();
    $sql = "SELECT teamnumber,
        autonStartPos,
        autonLeave,
        reefzoneAB,
        reefzoneCD,
        reefzoneEF,
        reefzoneGH,
        reefzoneIJ,
        reefzoneKL,
        autonCoralL1,
        autonCoralL2,
        autonCoralL3,
        autonCoralL4,
        autonAlgaeNet,
        autonAlgaeProcessor,
        autonCoralFloor,
        autonCoralStation,
        autonAlgaeFloor,
        autonAlgaeReef,
        acquiredCoral,
        acquiredAlgae,
        teleopAlgaeFloorPickup,
        teleopCoralFloorPickup,
        teleopKnockOffAlgae,
        teleopAlgaeFromReef,
        teleopHoldBoth,
        teleopCoralL1,
        teleopCoralL2,
        teleopCoralL3,
        teleopCoralL4,
        teleopAlgaeNet,
        teleopAlgaeProcessor,
        defenseLevel,
        cageClimb,
        startClimb,
        died,
        matchnumber,
        eventcode,
        scoutname,
        comment from " . $dbConfig["datatable"] . " where eventcode='" . $eventCode . "'";
    $prepared_statement = $this->conn->prepare($sql);
    $prepared_statement->execute();
    $result = $prepared_statement->fetchAll();
    return $this->enforceDataTyping($result);
  }

  public function readTeamFromMatchTable($teamNumber, $eventCode)
  {
    $dbConfig = $this->readDbConfig();
    $sql = "SELECT teamnumber,
        autonStartPos,
        autonLeave,
        reefzoneAB,
        reefzoneCD,
        reefzoneEF,
        reefzoneGH,
        reefzoneIJ,
        reefzoneKL,
        autonCoralL1,
        autonCoralL2,
        autonCoralL3,
        autonCoralL4,
        autonAlgaeNet,
        autonAlgaeProcessor,
        autonCoralFloor,
        autonCoralStation,
        autonAlgaeFloor,
        autonAlgaeReef,
        acquiredCoral,
        acquiredAlgae,
        teleopAlgaeFloorPickup,
        teleopCoralFloorPickup,
        teleopKnockOffAlgae,
        teleopAlgaeFromReef,
        teleopHoldBoth,
        teleopCoralL1,
        teleopCoralL2,
        teleopCoralL3,
        teleopCoralL4,
        teleopAlgaeNet,
        teleopAlgaeProcessor,
        defenseLevel,
        cageClimb,
        startClimb,
        died,
        matchnumber,
        eventcode,
        scoutname,
        comment from " . $dbConfig["datatable"] . " where
        eventcode='" . $eventCode . "' AND
        teamnumber='" . $teamNumber . "'";
    $prepared_statement = $this->conn->prepare($sql);
    $prepared_statement->execute();
    $result = $prepared_statement->fetchAll();
    return $this->enforceDataTyping($result);
  }

  public function writeRowToPitTable($data)
  {
    $dbConfig = $this->readDbConfig();
    $sql = "INSERT INTO " . $dbConfig["pittable"] .
      "(entrykey,
        eventcode,
        teamnumber,
        numbatteries,
        pitorg,
        spareparts,
        computervision,
        swerve,
        proglanguage,
        drivemotors,
        preparedness)
      VALUES(:entrykey,
        :eventcode,
        :teamnumber,
        :numbatteries,
        :pitorg,
        :spareparts,
        :computervision,
        :swerve,
        :proglanguage,
        :drivemotors,
        :preparedness)";
    $prepared_statement = $this->conn->prepare($sql);
    $prepared_statement->execute($data);
  }

  public function readAllPitTable($eventCode)
  {
    $dbConfig = $this->readDbConfig();
    $sql = "SELECT teamnumber,
        numbatteries,
        pitorg,
        spareparts,
        computervision,
        swerve,
        proglanguage,
        drivemotors,
        preparedness from " . $dbConfig["pittable"] . " where
        eventcode='" . $eventCode . "'";
    $prepared_statement = $this->conn->prepare($sql);
    $prepared_statement->execute();
    $result = $prepared_statement->fetchAll();
    return $result;
  }

  public function writeRowToStrategicTable($data)
  {
    $dbConfig = $this->readDbConfig();

    $sql = "INSERT INTO " . $dbConfig["strategictable"] .
      "(entrykey,
        eventcode,
        teamnumber,
        matchnumber,
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
        general_comment)
      VALUES(:entrykey,
        :eventcode,
        :teamnumber,
        :matchnumber,
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
        :general_comment)";
    $prepared_statement = $this->conn->prepare($sql);
    $prepared_statement->execute($data);
  }

  public function readAllFromStrategicTable($eventCode)
  {
    $dbConfig = $this->readDbConfig();
    $sql = "SELECT teamnumber,
        matchnumber,
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
        general_comment from " . $dbConfig["strategictable"] .
      " where eventcode='" . $eventCode . "'";
    $prepared_statement = $this->conn->prepare($sql);
    $prepared_statement->execute();
    $result = $prepared_statement->fetchAll();
    return $result;
  }

  public function readTeamFromStrategicTable($teamNumber, $eventCode)
  {
    $dbConfig = $this->readDbConfig();
    $sql = "SELECT teamnumber,
        matchnumber,
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
        general_comment from " . $dbConfig["strategictable"] .
      " where eventcode='" . $eventCode .
      "' AND teamnumber='" . $teamNumber . "'";
    $prepared_statement = $this->conn->prepare($sql);
    $prepared_statement->execute();
    $result = $prepared_statement->fetchAll();
    return $result;
  }

  public function createDB()
  {
    $dbConfig = $this->readDbConfig();
    $connection = $this->connectToServer();
    $statement = $connection->prepare('CREATE DATABASE IF NOT EXISTS ' . $dbConfig["db"]);
    if (!$statement->execute())
    {
      throw new Exception("createDB Error: CREATE DATABASE query failed.");
    }
  }

  public function createMatchTable()
  {
    $conn = $this->connectToDB();
    $dbConfig = $this->readDbConfig();
    $query = "CREATE TABLE " . $dbConfig["db"] . "." . $dbConfig["datatable"] .
      " (
        entrykey VARCHAR(60) NOT NULL PRIMARY KEY,
        teamnumber VARCHAR(6) NOT NULL,
        autonStartPos TINYINT UNSIGNED NOT NULL,
        autonLeave TINYINT UNSIGNED NOT NULL,
        reefzoneAB TINYINT UNSIGNED NOT NULL,
        reefzoneCD TINYINT UNSIGNED NOT NULL,
        reefzoneEF TINYINT UNSIGNED NOT NULL,
        reefzoneGH TINYINT UNSIGNED NOT NULL,
        reefzoneIJ TINYINT UNSIGNED NOT NULL,
        reefzoneKL TINYINT UNSIGNED NOT NULL,
        autonCoralL1 TINYINT UNSIGNED NOT NULL,
        autonCoralL2 TINYINT UNSIGNED NOT NULL,
        autonCoralL3 TINYINT UNSIGNED NOT NULL,
        autonCoralL4 TINYINT UNSIGNED NOT NULL,
        autonAlgaeNet TINYINT UNSIGNED NOT NULL,
        autonAlgaeProcessor TINYINT UNSIGNED NOT NULL,
        autonCoralFloor TINYINT UNSIGNED NOT NULL,
        autonCoralStation TINYINT UNSIGNED NOT NULL,
        autonAlgaeFloor TINYINT UNSIGNED NOT NULL,
        autonAlgaeReef TINYINT UNSIGNED NOT NULL,
        acquiredCoral TINYINT UNSIGNED NOT NULL,
        acquiredAlgae TINYINT UNSIGNED NOT NULL,
        teleopAlgaeFloorPickup TINYINT UNSIGNED NOT NULL,
        teleopCoralFloorPickup TINYINT UNSIGNED NOT NULL,
        teleopKnockOffAlgae TINYINT UNSIGNED NOT NULL,
        teleopAlgaeFromReef TINYINT UNSIGNED NOT NULL,
        teleopHoldBoth TINYINT UNSIGNED NOT NULL,
        teleopCoralL1 TINYINT UNSIGNED NOT NULL,
        teleopCoralL2 TINYINT UNSIGNED NOT NULL,
        teleopCoralL3 TINYINT UNSIGNED NOT NULL,
        teleopCoralL4 TINYINT UNSIGNED NOT NULL,
        teleopAlgaeNet TINYINT UNSIGNED NOT NULL,
        teleopAlgaeProcessor TINYINT UNSIGNED NOT NULL,
        defenseLevel TINYINT UNSIGNED NOT NULL,
        cageClimb TINYINT UNSIGNED NOT NULL,
        startClimb TINYINT UNSIGNED NOT NULL,
        died TINYINT UNSIGNED NOT NULL,
        matchnumber VARCHAR(10) NOT NULL,
        eventcode VARCHAR(10) NOT NULL,
        scoutname VARCHAR(100) NOT NULL,
        comment VARCHAR(500) NOT NULL
      )";
    $statement = $conn->prepare($query);
    if (!$statement->execute())
    {
      throw new Exception("createTable Error: CREATE TABLE " . $dbConfig["datatable"] . " query failed.");
    }
  }

  public function createTBATable()
  {
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

  public function createPitTable()
  {
    $conn = $this->connectToDB();
    $dbConfig = $this->readDbConfig();
    $query = "CREATE TABLE " . $dbConfig["db"] . "." . $dbConfig["pittable"] .
      " (
        entrykey VARCHAR(60) NOT NULL PRIMARY KEY,
        eventcode VARCHAR(10) NOT NULL,
        teamnumber VARCHAR(6) NOT NULL,
        numbatteries VARCHAR(8) NOT NULL,
        pitorg TINYINT UNSIGNED NOT NULL,
        spareparts TINYINT UNSIGNED NOT NULL,
        computervision TINYINT UNSIGNED NOT NULL,
        swerve TINYINT UNSIGNED NOT NULL,
        proglanguage VARCHAR(20) NOT NULL,
        drivemotors VARCHAR(20) NOT NULL,
        preparedness TINYINT UNSIGNED NOT NULL
      )";
    $statement = $conn->prepare($query);
    if (!$statement->execute())
    {
      throw new Exception("createPitTable Error: CREATE TABLE " . $dbConfig["pittable"] . " query failed.");
    }
  }

  public function createStrategicTable()
  {
    $conn = $this->connectToDB();
    $dbConfig = $this->readDbConfig();
    $query = "CREATE TABLE " . $dbConfig["db"] . "." . $dbConfig["strategictable"] .
      " (
        entrykey VARCHAR(60) NOT NULL PRIMARY KEY,
        eventcode VARCHAR(10) NOT NULL,
        teamnumber VARCHAR(6) NOT NULL,
        matchnumber VARCHAR(6) NOT NULL,
        scoutname VARCHAR(15) NOT NULL,
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
        general_comment VARCHAR(500) NOT NULL
      )";
    $statement = $conn->prepare($query);
    if (!$statement->execute())
    {
      throw new Exception("createStrategicTable Error: CREATE TABLE " . $dbConfig["strategictable"] . " query failed.");
    }
  }

  // Read and return the database configutration file
  public function readDbConfig()
  {
    // If File doesn't exist, instantiate array as empty
    try
    {
      error_log("dbHandler: readDbConfig(): reading db_config file");
      $ini_arr = parse_ini_file($this->dbIniFile);
    }
    catch (Exception $e)
    {
      error_log("dbHandler: no existing db_config file, so  creating a new one");
      $ini_arr = array();
    }

    // If required keys don't exist, instantiate them to default empty string
    foreach ($this->configKeys as $key)
    {
      if (!isset($ini_arr[$key]))
      {
        $ini_arr[$key] = "";
      }

      # Specific checking for match filters
      if ($key == "useP" || $key == "useQm" || $key == "useQf" || $key == "useSf" || $key == "useF")
      {
        $ini_arr[$key] = ($ini_arr[$key] == "" || $ini_arr[$key] == "1" || $ini_arr[$key] == "true");
      }
    }
    return $ini_arr;
  }

  public function writeDbConfig($dat)
  {
    // Get values to write
    // If value is not in input, read from current DB config
    $currDBConfig = $this->readDbConfig();
    foreach ($dat as $key => $value)
    {
      error_log("dbHandler: writeDbConfig(): setting currDBConfig[$key] to $value");
      $currDBConfig[$key] = $value;
    }

    // Build ini file string
    $data = "";
    foreach ($currDBConfig as $key => $value)
    {
      $data = $data . $key . "=" . $value . "\r\n";
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
        fwrite($fp, $data);
        flock($fp, LOCK_UN);
      }
    }
    fclose($fp);
  }

  // Check database status by connecting to server, database, and each table
  public function getDBStatus()
  {
    $dbConfig = $this->readDbConfig();
    $out = array();
    //
    $out["server"] = $dbConfig["server"];
    $out["db"] = $dbConfig["db"];
    $out["tbakey"] = substr($dbConfig["tbakey"], 0, 3) . "******";
    $out["eventcode"] = $dbConfig["eventcode"];
    $out["username"] = substr($dbConfig["username"], 0, 1) . "*****";
    $out["dbExists"] = false;
    $out["serverExists"] = false;
    $out["matchTableExists"] = false;
    $out["tbaTableExists"] = false;
    $out["pitTableExists"] = false;
    $out["strategicTableExists"] = false;
    $out["useP"] = $dbConfig["useP"];
    $out["useQm"] = $dbConfig["useQm"];
    $out["useQf"] = $dbConfig["useQf"];
    $out["useSf"] = $dbConfig["useSf"];
    $out["useF"] = $dbConfig["useF"];

    // DB Connection
    try
    {
      $dsn = "mysql:host=" . $dbConfig["server"] . ";dbname=" . $dbConfig["db"] . ";charset=" . $this->charset;
      $conn = new PDO($dsn, $dbConfig["username"], $dbConfig["password"]);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $out["dbExists"] = true;
    }
    catch (PDOException $e)
    {
      $out["DBExists"] = false;
    }

    // Server Connection
    try
    {
      $dsn = "mysql:host=" . $dbConfig["server"] . ";charset=" . $this->charset;
      $conn = new PDO($dsn, $dbConfig["username"], $dbConfig["password"]);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $out["serverExists"] = true;
    }
    catch (PDOException $e)
    {
      $out["ServerExists"] = false;
    }

    // Match data able Connection
    try
    {
      $dsn = "mysql:host=" . $dbConfig["server"] . ";dbname=" . $dbConfig["db"] . ";charset=" . $this->charset;
      $conn = new PDO($dsn, $dbConfig["username"], $dbConfig["password"]);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $val = $conn->query('SELECT * from ' . $dbConfig["datatable"]);
      $out["matchTableExists"] = true;
    }
    catch (PDOException $e)
    {
      $out["matchTableExists"] = false;
    }

    // TBA table Connection
    try
    {
      $dsn = "mysql:host=" . $dbConfig["server"] . ";dbname=" . $dbConfig["db"] . ";charset=" . $this->charset;
      $conn = new PDO($dsn, $dbConfig["username"], $dbConfig["password"]);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $val = $conn->query('SELECT * from ' . $dbConfig["tbatable"]);
      $out["tbaTableExists"] = true;
    }
    catch (PDOException $e)
    {
      $out["tbaTableExists"] = false;
    }

    // Pit table Connection
    try
    {
      $dsn = "mysql:host=" . $dbConfig["server"] . ";dbname=" . $dbConfig["db"] . ";charset=" . $this->charset;
      $conn = new PDO($dsn, $dbConfig["username"], $dbConfig["password"]);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $val = $conn->query('SELECT * from ' . $dbConfig["pittable"]);
      $out["pitTableExists"] = true;
    }
    catch (PDOException $e)
    {
      $out["pitTableExists"] = false;
    }

    // Strategic table Connection
    try
    {
      $dsn = "mysql:host=" . $dbConfig["server"] . ";dbname=" . $dbConfig["db"] . ";charset=" . $this->charset;
      $conn = new PDO($dsn, $dbConfig["username"], $dbConfig["password"]);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $val = $conn->query('SELECT * from ' . $dbConfig["strategictable"]);
      $out["strategicTableExists"] = true;
    }
    catch (PDOException $e)
    {
      $out["strategicTableExists"] = false;
    }

    return $out;
  }
}

?>

