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
        list($key, $value) = explode(":", $hdr, 2);
        if ($key == "Cache-Control"){
          foreach(explode(",", $value) as $cacheControlKV){
            $cacheKV = explode("=", $cacheControlKV, 2);
            if (count($cacheKV) == 2 and strcmp($cacheKV[0], "max-age")){
              $maxAge = intval($cacheKV[1]);
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
        $out["expiryTime"] = $result[0]["expiryTime"];
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
    
    function getTeamList($eventCode){
      $requestURI = "/event/" . $eventCode . "/teams";
      //
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
    
    function getMatches($eventCode){
      
    }
    
    function getComponentOPRS($eventCode){
      $teamListData = $this->getTeamList($eventCode);
      $matchData = $this->getMatches($eventCode);
    }
  
  
  
  }
?>