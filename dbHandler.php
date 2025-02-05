<?php
/*
  MySQL database handler
*/

class dbHandler
{
  private $dbIniFile = "../../db_config.ini";
  private $charset = "utf8";
  private $conn = null;
  private $alreadyConnected = false;
  private $configKeys = array(
    "server", "db", "username", "password", "eventcode", "tbakey",
    "fbapikey", "fbauthdomain", "fbdburl", "fbprojectid", "fbstoragebucket",
    "fbsenderid", "fbappid", "fbmeasurementid",
    "datatable", "tbatable", "pittable", "ranktable", "driveranktable",
    "useP", "useQm", "useQf", "useSf", "useF"
  );

  function connectToDB()
  {
    if (!$this->alreadyConnected)
    {
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

  function connectToServer()
  {

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

  function writeRowToTable($data)
  {
    $dbConfig = $this->readDbConfig();
    $sql = "INSERT INTO " . $dbConfig["datatable"] . "(entrykey,
                       teamnumber,
                       autonStartingPosition,
                       autonLeave,
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
                       teleopAcquireCoral,
                       teleopAcquireAlgae,
                       teleopAlgaeFloorPickup,
                       teleopCoralFloorPickup,
                       teleopKnockOffAlgae,
                       teleopAcquireAlgaeReef,
                       teleopHoldBothElements,
                       teleopCoralL1,
                       teleopCoralL2,
                       teleopCoralL3,
                       teleopCoralL4,
                       teleopAlgaeNet,
                       teleopAlgaeProcessor,
                       teleopDefenseLevel,
                       teleopPinFoul,
                       teleopAnchorFoul,
                       teleopCageFoul,
                       teleopBargeZoneFoul,
                       teleopReefZoneFoul,
                       endgameClimbLevel,
                       endgameStartClimbing,
                       endgameFoulNumber,
                       died,
                       matchnumber,
                       eventcode,
                       scoutname,
                       comment)
                VALUES(:entrykey,
                       :teamnumber,
                       :autonStartingPosition,
                       :autonLeave,
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
                       :teleopAcquireCoral,
                       :teleopAcquireAlgae,
                       :teleopAlgaeFloorPickup,
                       :teleopCoralFloorPickup,
                       :teleopKnockOffAlgae,
                       :teleopAcquireAlgaeReef,
                       :teleopHoldBothElements,
                       :teleopCoralL1,
                       :teleopCoralL2,
                       :teleopCoralL3,
                       :teleopCoralL4,
                       :teleopAlgaeNet,
                       :teleopAlgaeProcessor,
                       :teleopDefenseLevel,
                       :teleopPinFoul,
                       :teleopAnchorFoul,
                       :teleopCageFoul,
                       :teleopBargeZoneFoul,
                       :teleopReefZoneFoul,
                       :endgameClimbLevel,
                       :endgameStartClimbing,
                       :endgameFoulNumber,
                       :died,
                       :matchnumber,
                       :eventcode,
                       :scoutname,
                       :comment)";
    $prepared_statement = $this->conn->prepare($sql);
    $prepared_statement->execute($data);
  }

  function enforceInt($val)
  {
    return intval($val);
  }

  function enforceDataTyping($data)
  {
    $out = array();
    foreach ($data as $row)
    {
      foreach ($row as $key => $value)
      {
        if ($key == "autonStartingPosition" || $key == "autonLeave" || $key == "autonCoralL1" || $key == "autonCoralL2" || $key == "autonCoralL3" || $key == "autonCoralL4" || $key == "autonAlgaeNet" || $key == "autonAlgaeProcessor" || $key == "autonCoralFloor" || $key == "autonCoralStation" || $key == "autonAlgaeFloor" || $key == "autonAlgaeReef" || $key == "teleopAcquireCoral" || $key == "teleopAcquireAlgae" || $key == "teleopAlgaeFloorPickup" || $key == "teleopCoralFloorPickup" || $key == "teleopKnockOffAlgae" || $key == "teleopAcquireAlgaeReef" || $key == "teleopHoldBothElements" || $key == "teleopCoralL1" || $key == "teleopCoralL2" || $key == "teleopCoralL3" || $key == "teleopCoralL4" || $key == "teleopAlgaeNet" || $key == "teleopAlgaeProcessor" || $key == "teleopDefenseLevel" || $key == "teleopPinFoul" || $key == "teleopAnchorFoul" || $key == "teleopCageFoul" || $key == "teleopBargeZoneFoul" ||  $key == "teleopReefZoneFoul" || $key == "endgameClimbLevel" || $key == "endgameStartClimbing" || $key == "endgameFoulNumber" || $key == "died")
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

  function readAllData($eventCode)
  {
    $dbConfig = $this->readDbConfig();
    $sql = "SELECT teamnumber,
                       autonStartingPosition,
                       autonLeave,
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
                       teleopAcquireCoral,
                       teleopAcquireAlgae,
                       teleopAlgaeFloorPickup,
                       teleopCoralFloorPickup,
                       teleopKnockOffAlgae,
                       teleopAcquireAlgaeReef,
                       teleopHoldBothElements,
                       teleopCoralL1,
                       teleopCoralL2,
                       teleopCoralL3,
                       teleopCoralL4,
                       teleopAlgaeNet,
                       teleopAlgaeProcessor,
                       teleopDefenseLevel,
                       teleopPinFoul,
                       teleopAnchorFoul,
                       teleopCageFoul,
                       teleopBargeZoneFoul,
                       teleopReefZoneFoul,
                       endgameClimbLevel,
                       endgameStartClimbing,
                       endgameFoulNumber,
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

  function readTeamData($teamNumber, $eventCode)
  {
    $dbConfig = $this->readDbConfig();
    $sql = "SELECT teamnumber,
                       autonStartingPosition,
                       autonLeave,
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
                       teleopAcquireCoral,
                       teleopAcquireAlgae,
                       teleopAlgaeFloorPickup,
                       teleopCoralFloorPickup,
                       teleopKnockOffAlgae,
                       teleopAcquireAlgaeReef,
                       teleopHoldBothElements,
                       teleopCoralL1,
                       teleopCoralL2,
                       teleopCoralL3,
                       teleopCoralL4,
                       teleopAlgaeNet,
                       teleopAlgaeProcessor,
                       teleopDefenseLevel,
                       teleopPinFoul,
                       teleopAnchorFoul,
                       teleopCageFoul,
                       teleopBargeZoneFoul,
                       teleopReefZoneFoul,
                       endgameClimbLevel,
                       endgameStartClimbing,
                       endgameFoulNumber,
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

  function writeRowToPitTable($data)
  {
    $dbConfig = $this->readDbConfig();
    $sql = "INSERT INTO " . $dbConfig["pittable"] . "(entrykey,
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

  function readPitData($eventCode)
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
	

  function writeRowToDriveRankTable($data)
  {
    $dbConfig = $this->readDbConfig();
	
    $sql = "INSERT INTO " . $dbConfig["driveranktable"] . "(entrykey,
                   eventcode,
		   teamnumber,
		   matchnumber,
		   scoutname,
                   driverability,
                   multinote_starting_zone,
                   multinote_centerline,
                   shootsfrom,
                   passing,
                   understage,
                   defense_tactic1,
                   defense_tactic2,
                   defense_tactic3,
                   defense_comment,
                   against_tactic1,
                   against_tactic2,
                   against_comment,
                   foul1,
                   foul2,
                   foul3,
                   foul4,
                   foul5,
                   foul6,
                   climb_comment,
                   problem_comment,
                   general_comment)
                VALUES(:entrykey,
                   :eventcode,
		   :teamnumber,
		   :matchnumber,
		   :scoutname,
                   :driverability,
                   :multinote_starting_zone,
                   :multinote_centerline,
                   :shootsfrom,
                   :passing,
                   :understage,
                   :defense_tactic1,
                   :defense_tactic2,
                   :defense_tactic3,
                   :defense_comment,
                   :against_tactic1,
                   :against_tactic2,
                   :against_comment,
                   :foul1,
                   :foul2,
                   :foul3,
                   :foul4,
                   :foul5,
                   :foul6,
                   :climb_comment,
                   :problem_comment,
                   :general_comment)";
    $prepared_statement = $this->conn->prepare($sql);
    $prepared_statement->execute($data);
  }

  function readAllDriveRankData($eventCode)
  {
    $dbConfig = $this->readDbConfig();
    $sql = "SELECT teamnumber,
	           matchnumber,
	           scoutname,
                   driverability,
                   multinote_starting_zone,
                   multinote_centerline,
                   shootsfrom,
                   passing,
                   understage,
                   defense_tactic1,
                   defense_tactic2,
                   defense_tactic3,
                   defense_comment,
                   against_tactic1,
                   against_tactic2,
                   against_comment,
                   foul1,
                   foul2,
                   foul3,
                   foul4,
                   foul5,
                   foul6,
                   climb_comment,
                   problem_comment,
                   general_comment from " . $dbConfig["driveranktable"] . " where eventcode='" . $eventCode . "'";
    $prepared_statement = $this->conn->prepare($sql);
    $prepared_statement->execute();
    $result = $prepared_statement->fetchAll();
    return $result;
  }
	
  function readTeamDriveRankData($teamNumber,$eventCode)
  {
    $dbConfig = $this->readDbConfig();
    $sql = "SELECT teamnumber,
	           matchnumber,
	           scoutname,
                   driverability,
                   multinote_starting_zone,
                   multinote_centerline,
                   shootsfrom,
                   passing,
                   understage,
                   defense_tactic1,
                   defense_tactic2,
                   defense_tactic3,
                   defense_comment,
                   against_tactic1,
                   against_tactic2,
                   against_comment,
                   foul1,
                   foul2,
                   foul3,
                   foul4,
                   foul5,
                   foul6,
                   climb_comment,
                   problem_comment,
                   general_comment from " . $dbConfig["driveranktable"] . " where
                     eventcode='" . $eventCode . "' AND
                     teamnumber='" . $teamNumber . "'";
    $prepared_statement = $this->conn->prepare($sql);
    $prepared_statement->execute();
    $result = $prepared_statement->fetchAll();
    return $result;
  }

  function createDB()
  {
    $dbConfig = $this->readDbConfig();
    $connection = $this->connectToServer();
    $statement = $connection->prepare('CREATE DATABASE IF NOT EXISTS ' . $dbConfig["db"]);
    if (!$statement->execute())
    {
      throw new Exception("createDB Error: CREATE DATABASE query failed.");
    }
  }

  function createDataTable()
  {
    $conn = $this->connectToDB();
    $dbConfig = $this->readDbConfig();
    $query = "CREATE TABLE " . $dbConfig["db"] . "." . $dbConfig["datatable"] . " (
            entrykey VARCHAR(60) NOT NULL PRIMARY KEY,
            teamnumber VARCHAR(6) NOT NULL,
            autonStartingPosition TINYINT UNSIGNED NOT NULL,
            autonLeave TINYINT UNSIGNED NOT NULL,
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
            teleopAcquireCoral TINYINT UNSIGNED NOT NULL,
            teleopAcquireAlgae TINYINT UNSIGNED NOT NULL,
            teleopAlgaeFloorPickup TINYINT UNSIGNED NOT NULL,
            teleopCoralFloorPickup TINYINT UNSIGNED NOT NULL,
            teleopKnockOffAlgae TINYINT UNSIGNED NOT NULL,
            teleopAcquireAlgaeReef TINYINT UNSIGNED NOT NULL,
            teleopHoldBothElements TINYINT UNSIGNED NOT NULL,
            teleopCoralL1 TINYINT UNSIGNED NOT NULL,
            teleopCoralL2 TINYINT UNSIGNED NOT NULL,
            teleopCoralL3 TINYINT UNSIGNED NOT NULL,
            teleopCoralL4 TINYINT UNSIGNED NOT NULL,
            teleopAlgaeNet TINYINT UNSIGNED NOT NULL,
            teleopAlgaeProcessor TINYINT UNSIGNED NOT NULL,
            teleopDefenseLevel TINYINT UNSIGNED NOT NULL,
            teleopPinFoul TINYINT UNSIGNED NOT NULL,
            teleopAnchorFoul TINYINT UNSIGNED NOT NULL,
            teleopCageFoul TINYINT UNSIGNED NOT NULL,
            teleopBargeZoneFoul TINYINT UNSIGNED NOT NULL,
            teleopReefZoneFoul TINYINT UNSIGNED NOT NULL,
            endgameClimbLevel TINYINT UNSIGNED NOT NULL,
            endgameStartClimbing TINYINT UNSIGNED NOT NULL,
            endgameFoulNumber TINYINT UNSIGNED NOT NULL,
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

  function createTBATable()
  {
    $conn = $this->connectToDB();
    $dbConfig = $this->readDbConfig();
    $query = "CREATE TABLE " . $dbConfig["db"] . "." . $dbConfig["tbatable"] . " (
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

  function createPitTable()
  {
    $conn = $this->connectToDB();
    $dbConfig = $this->readDbConfig();
    $query = "CREATE TABLE " . $dbConfig["db"] . "." . $dbConfig["pittable"] . " (
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
	
  function createDriveRankTable()
  {
    $conn = $this->connectToDB();
    $dbConfig = $this->readDbConfig();
    $query = "CREATE TABLE " . $dbConfig["db"] . "." . $dbConfig["driveranktable"] . " (
            entrykey VARCHAR(60) NOT NULL PRIMARY KEY,
            eventcode VARCHAR(10) NOT NULL,
	    teamnumber VARCHAR(6) NOT NULL,
	    matchnumber VARCHAR(6) NOT NULL,
	    scoutname VARCHAR(15) NOT NULL,
            driverability TINYINT UNSIGNED NOT NULL,
            multinote_starting_zone TINYINT UNSIGNED NOT NULL,
            multinote_centerline TINYINT UNSIGNED NOT NULL,
            shootsfrom TINYINT UNSIGNED NOT NULL,
            passing TINYINT UNSIGNED NOT NULL,
            understage TINYINT UNSIGNED NOT NULL,
            defense_tactic1 TINYINT UNSIGNED NOT NULL,
            defense_tactic2 TINYINT UNSIGNED NOT NULL,
            defense_tactic3 TINYINT UNSIGNED NOT NULL,
            defense_comment VARCHAR(500) NOT NULL,
            against_tactic1 TINYINT UNSIGNED NOT NULL,
            against_tactic2 TINYINT UNSIGNED NOT NULL,
            against_comment VARCHAR(500) NOT NULL,
            foul1 TINYINT UNSIGNED NOT NULL,
            foul2 TINYINT UNSIGNED NOT NULL,
            foul3 TINYINT UNSIGNED NOT NULL,
            foul4 TINYINT UNSIGNED NOT NULL,
            foul5 TINYINT UNSIGNED NOT NULL,
            foul6 TINYINT UNSIGNED NOT NULL,
            climb_comment VARCHAR(500) NOT NULL,
            problem_comment VARCHAR(500) NOT NULL,
            general_comment VARCHAR(500) NOT NULL
        )";
    $statement = $conn->prepare($query);
    if (!$statement->execute())
    {
      throw new Exception("createdriveRankTable Error: CREATE TABLE " . $dbConfig["driveranktable"] . " query failed.");
    }
  }

  function createRankTable()
  {
    $conn = $this->connectToDB();
    $dbConfig = $this->readDbConfig();
    $query = "CREATE TABLE " . $dbConfig["db"] . "." . $dbConfig["ranktable"] . " (
            eventcode VARCHAR(10) NOT NULL,
            matchkey VARCHAR(60) NOT NULL,
            teamrank MEDIUMTEXT NOT NULL
        )";
    $statement = $conn->prepare($query);
    if (!$statement->execute())
    {
      throw new Exception("createRankingTable Error: CREATE TABLE " . $dbConfig["ranktable"] . " query failed.");
    }
  }

  function writeRowToRankTable($data)
  {
    $dbConfig = $this->readDbConfig();
    $sql = "INSERT INTO " . $dbConfig["ranktable"] . "(eventcode, matchkey, teamrank)
                VALUES(:eventcode, :matchkey, :teamrank)";
    $prepared_statement = $this->conn->prepare($sql);
    $prepared_statement->execute($data);
  }

  function readRawRankData($eventCode)
  {
    $dbConfig = $this->readDbConfig();
    $sql = "SELECT matchkey,
                     teamrank from " . $dbConfig["ranktable"] . " where
                     eventcode='" . $eventCode . "'";
    $prepared_statement = $this->conn->prepare($sql);
    $prepared_statement->execute();
    $result = $prepared_statement->fetchAll();
    return $result;
  }

  function readRankData($eventCode)
  {
    $rawRankData = $this->readRawRankData($eventCode);
    $rankData = array();
    $dataSize = sizeof($rawRankData);
    for ($i = 0; $i < $dataSize; $i++)
    {
      array_push($rankData, json_decode($rawRankData[$i]["teamrank"], True));
    }
    return $rankData;
  }

  function deleteRowFromRankTable($data)
  {
    $dbConfig = $this->readDbConfig();
    $sql = "DELETE FROM " . $dbConfig["ranktable"] . " WHERE eventcode = :eventcode AND matchkey = :matchkey AND teamrank = :teamrank LIMIT 1";
    $prepared_statement = $this->conn->prepare($sql);
    $prepared_statement->execute($data);
  }

  function readDbConfig()
  {
    // Read dbIniFile
    // If File doesn't exist, instantiate array as empty
    try
    {
      $ini_arr = parse_ini_file($this->dbIniFile);
    }
    catch (Exception $e)
    {
      $ini_arr = array();
    }
    // If required keys don't exist, instantiate them to default empty string
    foreach ($this->configKeys as $key)
    {
      if (!isset($ini_arr[$key]))
      {
        $ini_arr[$key] = "";
      }

      # Specific checking
      if ($key == "useP" || $key == "useQm" || $key == "useQf" || $key == "useSf" || $key == "useF")
      {
        if ($ini_arr[$key] == "")
        {
          $ini_arr[$key] = true;
        }
        else if ($ini_arr[$key] == "1" || $ini_arr[$key] == "true")
        {
          $ini_arr[$key] = true;
        }
        else
        {
          $ini_arr[$key] = false;
        }
      }
    }
    return $ini_arr;
  }

  function writeDbConfig($dat)
  {
    // Get values to write
    // If value is not in input, read from current DB config
    $currDBConfig = $this->readDbConfig();
    foreach ($dat as $key => $value)
    {
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

  function getStatus()
  {
    $dbConfig = $this->readDbConfig();
    $out = array();
    //
    $out["server"]          = $dbConfig["server"];
    $out["db"]              = $dbConfig["db"];
    $out["tbakey"]          = substr($dbConfig["tbakey"], 0, 3) . "******";
    $out["eventcode"]       = $dbConfig["eventcode"];
    $out["username"]        = substr($dbConfig["username"], 0, 1) . "*****";
    $out["fbapikey"]        = substr($dbConfig["fbapikey"], 0, 1) . "*****";
    $out["fbauthdomain"]    = $dbConfig["fbauthdomain"];
    $out["fbdburl"]         = substr($dbConfig["fbdburl"], 0, 1) . "*****";
    $out["fbprojectid"]     = substr($dbConfig["fbprojectid"], 0, 1) . "*****";
    $out["fbstoragebucket"] = substr($dbConfig["fbstoragebucket"], 0, 1) . "*****";
    $out["fbsenderid"]      = substr($dbConfig["fbsenderid"], 0, 1) . "*****";
    $out["fbappid"]         = substr($dbConfig["fbappid"], 0, 1) . "*****";
    $out["fbmeasurementid"] = substr($dbConfig["fbmeasurementid"], 0, 1) . "*****";
    $out["dbExists"]        = false;
    $out["serverExists"]    = false;
    $out["dataTableExists"] = false;
    $out["tbaTableExists"]  = false;
    $out["pitTableExists"]  = false;
	$out["driveRankTableExists"] = false;
    $out["rankTableExists"] = false;
    $out["useP"]            = $dbConfig["useP"];
    $out["useQm"]           = $dbConfig["useQm"];
    $out["useQf"]           = $dbConfig["useQf"];
    $out["useSf"]           = $dbConfig["useSf"];
    $out["useF"]            = $dbConfig["useF"];

    //DB Connection
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
    //Server Connection
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
    // Table Connection
    try
    {
      $dsn = "mysql:host=" . $dbConfig["server"] . ";dbname=" . $dbConfig["db"] . ";charset=" . $this->charset;
      $conn = new PDO($dsn, $dbConfig["username"], $dbConfig["password"]);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $val = $conn->query('SELECT * from ' . $dbConfig["datatable"]);
      $out["dataTableExists"] = true;
    }
    catch (PDOException $e)
    {
      $out["dataTableExists"] = false;
    }
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
	try
    {
      $dsn = "mysql:host=" . $dbConfig["server"] . ";dbname=" . $dbConfig["db"] . ";charset=" . $this->charset;
      $conn = new PDO($dsn, $dbConfig["username"], $dbConfig["password"]);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $val = $conn->query('SELECT * from ' . $dbConfig["driveranktable"]);
      $out["driveRankTableExists"] = true;
    }
    catch (PDOException $e)
    {
      $out["driveRankTableExists"] = false;
    }
    try
    {
      $dsn = "mysql:host=" . $dbConfig["server"] . ";dbname=" . $dbConfig["db"] . ";charset=" . $this->charset;
      $conn = new PDO($dsn, $dbConfig["username"], $dbConfig["password"]);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $val = $conn->query('SELECT * from ' . $dbConfig["ranktable"]);
      $out["rankTableExists"] = true;
    }
    catch (PDOException $e)
    {
      $out["rankTableExists"] = false;
    }
    return $out;
  }
}
