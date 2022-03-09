<?php
/*
  TBA Handler
  
  The purpose of this object is to create a function that can deal with The Blue Alliance.
  This will locally cache data in a MySQL server to limit TBA load and help with outages (IE a local server).
  
  Any data from the TBA API will come out as follows
  {
    expiryTime : dateTime,
    updated : boolean,
    data : {}
  }
*/
  
  
  class tbaHandler {
    private $charset = "utf8";
    private $alreadyConnected = false;
    private $tbaApiKey;
    private $tbaTableName; 
    private $dbConnection;  
    private $apiURL;  
  
    function __construct($tbaApiKey, $tbaTableName, $dbConnection) {
      $this->tbaApiKey = $tbaApiKey;
      $this->tbaTableName = $tbaTableName;
      $this->dbConnection = $dbConnection;
      $this->apiURL = "https://www.thebluealliance.com/api/v3";
    }
    
  
    function readURIFromTBA($uri){
      $url = $this->apiURL.$uri."?X-TBA-Auth-Key=".$this->tbaApiKey;
      $ch = curl_init();
      curl_setopt_array($ch,
        array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_SSL_VERIFYHOST => false,
          CURLOPT_SSL_VERIFYPEER => false,
          CURLOPT_HEADER => true
        )
      );
      $response = curl_exec($ch); 
      if(curl_errno($ch)){
        throw new Exception(curl_error($ch));
      }
      curl_close($ch);
      
      list($headers, $content) = explode("\r\n\r\n", $response, 2);
      
      // Parse Header to get max-age
      $maxAge = 0;
      foreach(explode("\r\n", $headers) as $hdr){
        $kv = explode(":", $hdr, 2);
        if (sizeof($kv) == 2){
          list($key, $value) = $kv;
          if ($key == "Cache-Control"){
            foreach(explode(",", $value) as $cacheControlKV){
              $cacheKV = explode("=", $cacheControlKV, 2);
              if (count($cacheKV) == 2 and strcmp($cacheKV[0], "max-age")){
                $maxAge = intval($cacheKV[1]);
              }
            }
          }
        }
      }
      $content = str_replace("'", "", $content);
      $out = array();
      $out["expiryTime"] = time() + $maxAge;
      $out["response"] = json_decode($content, true);
      return $out;
    }
    
    function readURIFromDB($uri){
      /*
        If uri not in db, then return empty
      */
      $sql = "SELECT expiryTime, response from ".$this->tbaTableName." where requestURI='".$uri."'";
      $prepared_statement = $this->dbConnection->prepare($sql);
      $prepared_statement->execute();
      $result = $prepared_statement->fetchAll(PDO::FETCH_ASSOC);
      //
      $out = array("expiryTime" => 0, "response" => null);
      if (count($result) != 0){
        $out["expiryTime"] = intval($result[0]["expiryTime"]);
        $out["response"] = json_decode($result[0]["response"], true);
      }
      return $out;
    }
    
    function writeResponseToDB($uri, $response){
      $replaceValues = array();
      $replaceValues["requestURI"] = $uri;
      $replaceValues["expiryTime"] = $response["expiryTime"];
      $replaceValues["response"] = json_encode($response["response"]);
      // echo($replaceValues["response"]);
      $sql = "REPLACE INTO ".$this->tbaTableName." (requestURI, expiryTime, response) VALUES (:requestURI, :expiryTime, :response)";
      $prepared_statement = $this->dbConnection->prepare($sql);
      $prepared_statement->execute($replaceValues);
    }
  
    function makeDBCachedCall($uri){
      $currTime = time();
      $dbResponse = $this->readURIFromDB($uri);
      // If expiryTime is after current time, cache is valid
      if ($currTime < $dbResponse["expiryTime"]){
        return $dbResponse;
      }
      
      $apiResponse = $this->readURIFromTBA($uri);
      $this->writeResponseToDB($uri, $apiResponse);
      return $apiResponse;
    }
    
    /* Team List Operations */
    
    function getTeamList($eventCode){
      $requestURI = "/event/" . $eventCode . "/teams";
      return $this->makeDBCachedCall($requestURI);
    }
    
    function getSimpleTeamList($eventCode){
      $tl = $this->getTeamList($eventCode);
      $out = array();
      foreach($tl["response"] as $teamRow){
        array_push($out, $teamRow["team_number"]);
      }
      return $out;
    }
    
    function teamListToLookup($teamList){
      $out = array();
      $i = 0;
      foreach($teamList as $team){
        $out[$team] = $i;
        $out["frc".$team] = $i;
        $i += 1;
      }
      return $out;
    }
    
    /* Match Data Operations */
    
    function getMatches($eventCode){
      $requestURI = "/event/" . $eventCode . "/matches";
      return $this->makeDBCachedCall($requestURI);
    }
    
    function getSimpleMatches($eventCode){
      $ml = $this->getMatches($eventCode);
      return $ml["response"];
    }
    
    function removeElimMatches($matchData){
      $out = array();
      foreach($matchData as $matchRow){
        if ($matchRow["comp_level"] == "qm"){
          array_push($out, $matchRow);
        }
      }
      return $out;
    }
    
    function removeUnplayedMatches($matchData){
      $out = array();
      foreach($matchData as $matchRow){
        if ($matchRow["alliances"]["red"]["score"] != -1){
          array_push($out, $matchRow);
        }
      }
      return $out;
    }
    
    function getNumericalBreakdownKeys($matchData){
      $sampleBreakdown = $matchData[0]["score_breakdown"]["red"];
      $out = array();
      foreach($sampleBreakdown as $key => $value){
        if (is_numeric($value)){
          array_push($out, $key);
        }
      }
      return $out;
    }
    
    /* COPR Calculation */
    
    function choleskyDecomposition($A){
      /*
      Args:
        $A - Must be square matrix that is symetric and positive definite
      Returns:
        array("L" => and "Lp" =>) decompositions
      */
      $n  = sizeof($A);
      
      $L  = array_fill(0, $n, array_fill(0, $n, 0));
      $Lp = array_fill(0, $n, array_fill(0, $n, 0));
      
      for($i = 0; $i < $n; $i++){
        for($j = 0; $j <= $i; $j++){
          $sum = 0;
          for($k = 0; $k < $j; $k++){
            $sum += $L[$i][$k] * $L[$j][$k];
          }
          if ($i == $j){
            $L[$i][$j]  = sqrt($A[$i][$j] - $sum);
            $Lp[$j][$i] = sqrt($A[$i][$j] - $sum);
          }
          else {
            $L[$i][$j]  = (1 / $L[$j][$j]) * ($A[$i][$j] - $sum);
            $Lp[$j][$i] = (1 / $L[$j][$j]) * ($A[$i][$j] - $sum);
          }
        }
      }
      
      return array("L" => $L , "Lp" => $Lp);
    }
    
    function forwardSubstitution($A, $B){
      /*
      Args:
        $A - Lower Triangular Square Matrix
        $B - Vector of Length of a side of $A
      Returns:
        $X - Solved vector
      */
      $n = sizeof($A);
      $X = array_fill(0, $n, 0);
      for($i = 0; $i != $n; $i++){
        $sum = 0;
        for($j = 0; $j < $i; $j++){
          $sum += $A[$i][$j] * $X[$j];
        }
        $X[$i] = ($B[$i] - $sum)/$A[$i][$i];
      }
      return $X;
    }
    
    function backwardSubstitution($A, $B){
      /*
      Args:
        $A - Upper Triangular Square Matrix
        $B - Vector of Length of a side of $A
      Returns:
        $X - Solved vector
      */
      $n = sizeof($A);
      $nm = $n - 1;
      $X = array_fill(0, $n, 0);
      for($i = 0; $i != $n; $i++){
        $sum = 0;
        for($j = 0; $j < $i; $j++){
          $sum += $A[$nm - $i][$nm - $j] * $X[$nm - $j];
        }
        $X[$nm - $i] = ($B[$nm - $i] - $sum)/$A[$nm - $i][$nm - $i];
      }
      return $X;
    }
    
    function createABMatricies($teamCount, $teamLookup, $simpleMatchData){
      $aMatrix = array_fill(0, $teamCount, array_fill(0, $teamCount, 0)); // Just for who plays in what matchData
      $bVectors = array(); // Set of data we want to solve for
      
      $coprKeys = $this->getNumericalBreakdownKeys($simpleMatchData);
      
      // Initialize B Vectors
      foreach($coprKeys as $key){
        $bVectors[$key] = array_fill(0, $teamCount, 0);
      }
  
      // Iterate through matches
      foreach ($simpleMatchData as &$match){
        foreach (array("red", "blue") as $color){
          foreach ($match["alliances"][$color]["team_keys"] as $teamA){
            // Modify A Matrix
            foreach ($match["alliances"][$color]["team_keys"] as $teamB){
              $aMatrix[$teamLookup[$teamA]][$teamLookup[$teamB]] += 1;
            }
            // Modify B Vectors
            foreach($coprKeys as $coprKey){
              $bVectors[$coprKey][$teamLookup[$teamA]] += $match["score_breakdown"][$color][$coprKey];
            }
          }
        }
      }
      
      return array("A" => $aMatrix, "B" => $bVectors);
    }
    
    function getComponentOPRS($eventCode){
      $simpleTeamList = $this->getSimpleTeamList($eventCode);
      $teamLookup = $this->teamListToLookup($simpleTeamList);
      $teamCount = sizeof($simpleTeamList);
      
      $simpleMatchData = $this->getSimpleMatches($eventCode);
      $simpleMatchData = $this->removeElimMatches($simpleMatchData);
      $simpleMatchData = $this->removeUnplayedMatches($simpleMatchData);
      $matchMatricies = $this->createABMatricies($teamCount, $teamLookup, $simpleMatchData);
      
      $A    = $matchMatricies["A"]; 
      $Bs   = $matchMatricies["B"];
      $Xs   = array();
      
      $Lmat = $this->choleskyDecomposition($A);
      $L  = $Lmat["L"];
      $Lp = $Lmat["Lp"];
      
      foreach ($Bs as $component => $Ba){
        $y = $this->forwardSubstitution($L, $Ba);
        $x = $this->backwardSubstitution($Lp, $y);
        $Xs[$component] = $x; 
      }
      
      // Repackage Values into Team Value Dicts
      $data = array();
      foreach ($simpleTeamList as $team){
        $data[$team] = array();
        foreach ($Xs as $component => $x){
          $data[$team][$component] = round($x[$teamLookup[$team]], 2);
        }
      }
      $out = array("eventCode" => $eventCode, "data" => $data, "keys" => $this->getNumericalBreakdownKeys($simpleMatchData));
      
      return $out;
    }
  }
?>