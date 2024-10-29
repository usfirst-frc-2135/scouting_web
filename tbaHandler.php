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

class tbaHandler
{
  private $charset = "utf8";
  private $alreadyConnected = false;
  private $tbaApiKey = null;
  private $tbaTableName;
  private $dbConnection;
  private $apiURL;

  function __construct($tbaApiKey, $tbaTableName, $dbConnection)
  {
    $this->tbaApiKey = $tbaApiKey;
    $this->tbaTableName = $tbaTableName;
    $this->dbConnection = $dbConnection;
    $this->apiURL = "https://www.thebluealliance.com/api/v3";
  }

  function readURIFromTBA($uri)
  {
    $out = array();
    if ( $this->tbaApiKey == null) {
      error_log("Can't read TheBlueAlliance data because no TBA Key was set!");
      return $out;
    }
    else error_log("READING BlueAlliance data");
    $url = $this->apiURL . $uri . "?X-TBA-Auth-Key=" . $this->tbaApiKey;
    $ch = curl_init();
    curl_setopt_array(
      $ch,
      array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_HEADER => true
      )
    );
    $response = curl_exec($ch);
    if (curl_errno($ch))
    {
      throw new Exception(curl_error($ch));
    }
    curl_close($ch);

    list($headers, $content) = explode("\r\n\r\n", $response, 2);

    // Parse Header to get max-age
    $maxAge = 0;
    foreach (explode("\r\n", $headers) as $hdr)
    {
      $kv = explode(":", $hdr, 2);
      if (sizeof($kv) == 2)
      {
        list($key, $value) = $kv;
        if ($key == "Cache-Control")
        {
          foreach (explode(",", $value) as $cacheControlKV)
          {
            $cacheKV = explode("=", $cacheControlKV, 2);
            if (count($cacheKV) == 2 and strcmp($cacheKV[0], "max-age"))
            {
              $maxAge = intval($cacheKV[1]);
            }
          }
        }
      }
    }
    $content = str_replace("'", "", $content);
    $out["expiryTime"] = time() + $maxAge;
    $out["response"] = json_decode($content, true);
    return $out;
  }

  function readURIFromDB($uri)
  {
    /*
        If uri not in db, then return empty
      */
    $sql = "SELECT expiryTime, response from " . $this->tbaTableName . " where requestURI='" . $uri . "'";
    $prepared_statement = $this->dbConnection->prepare($sql);
    $prepared_statement->execute();
    $result = $prepared_statement->fetchAll(PDO::FETCH_ASSOC);
    //
    $out = array("expiryTime" => 0, "response" => null);
    if (count($result) != 0)
    {
      $out["expiryTime"] = intval($result[0]["expiryTime"]);
      $out["response"] = json_decode($result[0]["response"], true);
    }
    return $out;
  }

  function writeResponseToDB($uri, $response)
  {
    $replaceValues = array();
    $replaceValues["requestURI"] = $uri;
    $replaceValues["expiryTime"] = $response["expiryTime"];
    $replaceValues["response"] = json_encode($response["response"]);
    // echo($replaceValues["response"]);
    $sql = "REPLACE INTO " . $this->tbaTableName . " (requestURI, expiryTime, response) VALUES (:requestURI, :expiryTime, :response)";
    $prepared_statement = $this->dbConnection->prepare($sql);
    $prepared_statement->execute($replaceValues);
  }

  function makeDBCachedCall($uri)
  {
    $currTime = time();
    $dbResponse = $this->readURIFromDB($uri);
    // If expiryTime is after current time, cache is valid
    if ($currTime < $dbResponse["expiryTime"])
    {
      return $dbResponse;
    }

    $apiResponse = $this->readURIFromTBA($uri);
    $this->writeResponseToDB($uri, $apiResponse);
    return $apiResponse;
  }

  /*********** Team List Operations ***********/

  function getTeamList($eventCode)
  {
    $requestURI = "/event/" . $eventCode . "/teams";
    return $this->makeDBCachedCall($requestURI);
  }

  // NOTE: for events that have multiple robots, the teamlist only lists the basic team numbers.
  // So we must adjust the list to contain the multiple robot <teamNum><Letter>.
  function getSimpleTeamList($eventCode)
  {
    error_log("starting getSimpleTeamList for eventCode: $eventCode");  

    // If eventCode is "COMPX", just exit.
    if(strstr($eventCode,'COMPX') )   {
      error_log("skipping getSimpleTeamList for COMPX");  
      $aout = array();
      return $aout;
    }

    $tl = $this->getTeamList($eventCode);
    $out = array();

    // FORNOW - only "mttd", "cacg", "cacc"  events are known multi-robot events. Add any others as needed.
    $bMultiRobots = false;
    if(strstr($eventCode,'mttd') || strstr($eventCode,'cacg') || strstr($eventCode,'cacc'))   // Hardcoded multi-robot eventcode
    {
      error_log("getTeamList: this is a multi-robot event");  
      $bMultiRobots = true;
    }

    $ml = null;   // matchlist, only needed if multi-robot event
    if($bMultiRobots == true)
    {
      $ml = $this->getMatches($eventCode);
      error_log("getTeamList: going to adjust teamlist for multi-robots"); 
    }

    foreach ($tl["response"] as $teamRow)
    {
      if($bMultiRobots == true)
      { 
        // If this is a multi-robot event, go thru  match list to get B/C/D/E robots and 
        // add them as separate teams.
        $teamnum = $teamRow["team_number"];
        $numStr = "$teamnum"; // $teadmnum needs to be converted to a string, for later
        $multiBots = array();
        array_push($multiBots, $teamnum);  // always add the plain team number

        // Check the matches if this team number has multiple robots.
        foreach ($ml["response"] as $match)
        {
          // Put all this match's teams in $teams, then check for the current teamnumber.
          $teams = array();
          for ($j = 0; $j < 3; $j++)
            array_push($teams, substr($match["alliances"]["red"]["team_keys"][$j],3));
          for ($k = 0; $k < 3; $k++)
            array_push($teams, substr($match["alliances"]["blue"]["team_keys"][$k],3));
          for ($m = 0; $m < 6; $m++)
          {
            $entryNum = "$teams[$m]";
            $trimmedNum = substr($entryNum,0,-1); // trim off the last char in entryNum, for later matching

            // If trimmedNum is same as numStr AND it ends in a B/C/D/E/F, then it's a 
            // multiple robot for numStr team.
            if(($trimmedNum == $numStr) && ((substr($entryNum,-1) == 'B') || 
               (substr($entryNum,-1) == 'C') || (substr($entryNum,-1) == 'D') || 
               (substr($entryNum,-1) == 'E') || (substr($entryNum,-1) == 'F')))
            {
              // Check if this entryNum is already in multiBots.
              $w = sizeof($multiBots); 
              $bFoundInMultiBots = false;
              for ($x = 0; $x < $w; $x++)
              {
                if(strcmp($multiBots[$x],$entryNum) == 0)
                {
                  $bFoundInMultiBots = true;
                  break;
                } 
              }
              if($bFoundInMultiBots == false)
              {
                array_push($multiBots, $entryNum);  // add this multi-bot number.
              }
            }
          }
        }

        // Add the team numbers found (at least the basic number, even if no multiples found)
        $n  = sizeof($multiBots);
        for ($j = 0; $j < $n; $j++)
        {
//          error_log("-- Adding to out: $multiBots[$j]"); 
          array_push($out, $multiBots[$j]);
        }
      } 
      else array_push($out, $teamRow["team_number"]);   // not mulit-bot case
    }
    return $out;
  }

  function teamListToLookup($teamList)
  {
    $out = array();
    $i = 0;
    foreach ($teamList as $team)
    {
      $out[$team] = $i;
      $out["frc" . $team] = $i;
      $i += 1;
    }
    return $out;
  }

  /*********** Match Data Operations ***********/

  function getMatches($eventCode)
  {
    $requestURI = "/event/" . $eventCode . "/matches";
    return $this->makeDBCachedCall($requestURI);
  }

  function getSimpleMatches($eventCode)
  {
    $ml = $this->getMatches($eventCode);
    return $ml["response"];
  }

  function removeElimMatches($matchData)
  {
    $out = array();
    foreach ($matchData as $matchRow)
    {
      if ($matchRow["comp_level"] == "qm")
      {
        array_push($out, $matchRow);
      }
    }
    return $out;
  }

  function removeUnplayedMatches($matchData)
  {
    $out = array();
    foreach ($matchData as $matchRow)
    {
      if ($matchRow["alliances"]["red"]["score"] != -1)
      {
        array_push($out, $matchRow);
      }
    }
    return $out;
  }

  function getNumericalBreakdownKeys($matchData)
  {
    $sampleBreakdown = $matchData[0]["score_breakdown"]["red"];
    $out = array();
    foreach ($sampleBreakdown as $key => $value)
    {
      if (is_numeric($value))
      {
        array_push($out, $key);
      }
    }
    return $out;
  }

  /* COPR Calculation */

  function choleskyDecomposition($A)
  {
    /*
      Args:
        $A - Must be square matrix that is symetric and positive definite
      Returns:
        array("L" => and "Lp" =>) decompositions
      */
    $n  = sizeof($A);

    $L  = array_fill(0, $n, array_fill(0, $n, 0));
    $Lp = array_fill(0, $n, array_fill(0, $n, 0));

    for ($i = 0; $i < $n; $i++)
    {
      for ($j = 0; $j <= $i; $j++)
      {
        $sum = 0;
        for ($k = 0; $k < $j; $k++)
        {
          $sum += $L[$i][$k] * $L[$j][$k];
        }
        if ($i == $j)
        {
          $L[$i][$j]  = sqrt($A[$i][$j] - $sum);
          $Lp[$j][$i] = sqrt($A[$i][$j] - $sum);
        }
        else
        {
          $L[$i][$j]  = (1 / $L[$j][$j]) * ($A[$i][$j] - $sum);
          $Lp[$j][$i] = (1 / $L[$j][$j]) * ($A[$i][$j] - $sum);
        }
      }
    }

    return array("L" => $L, "Lp" => $Lp);
  }

  function forwardSubstitution($A, $B)
  {
    /*
      Args:
        $A - Lower Triangular Square Matrix
        $B - Vector of Length of a side of $A
      Returns:
        $X - Solved vector
      */
    $n = sizeof($A);
    $X = array_fill(0, $n, 0);
    for ($i = 0; $i != $n; $i++)
    {
      $sum = 0;
      for ($j = 0; $j < $i; $j++)
      {
        $sum += $A[$i][$j] * $X[$j];
      }
      $X[$i] = ($B[$i] - $sum) / $A[$i][$i];
    }
    return $X;
  }

  function backwardSubstitution($A, $B)
  {
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
    for ($i = 0; $i != $n; $i++)
    {
      $sum = 0;
      for ($j = 0; $j < $i; $j++)
      {
        $sum += $A[$nm - $i][$nm - $j] * $X[$nm - $j];
      }
      $X[$nm - $i] = ($B[$nm - $i] - $sum) / $A[$nm - $i][$nm - $i];
    }
    return $X;
  }

  function createABMatricies($teamCount, $teamLookup, $simpleMatchData)
  {
    $aMatrix = array_fill(0, $teamCount, array_fill(0, $teamCount, 0)); // Just for who plays in what matchData
    $bVectors = array(); // Set of data we want to solve for

    $coprKeys = $this->getNumericalBreakdownKeys($simpleMatchData);

    // Initialize B Vectors
    foreach ($coprKeys as $key)
    {
      $bVectors[$key] = array_fill(0, $teamCount, 0);
    }

    // Iterate through matches
    foreach ($simpleMatchData as &$match)
    {
      foreach (array("red", "blue") as $color)
      {
        foreach ($match["alliances"][$color]["team_keys"] as $teamA)
        {
          // Modify A Matrix
          foreach ($match["alliances"][$color]["team_keys"] as $teamB)
          {
            $aMatrix[$teamLookup[$teamA]][$teamLookup[$teamB]] += 1;
          }
          // Modify B Vectors
          foreach ($coprKeys as $coprKey)
          {
            $bVectors[$coprKey][$teamLookup[$teamA]] += $match["score_breakdown"][$color][$coprKey];
          }
        }
      }
    }

    return array("A" => $aMatrix, "B" => $bVectors);
  }

  function getComponentOPRS($eventCode)
  {
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

    foreach ($Bs as $component => $Ba)
    {
      $y = $this->forwardSubstitution($L, $Ba);
      $x = $this->backwardSubstitution($Lp, $y);
      $Xs[$component] = $x;
    }

    // Repackage Values into Team Value Dicts
    $data = array();
    foreach ($simpleTeamList as $team)
    {
      $data[$team] = array();
      foreach ($Xs as $component => $x)
      {
        $data[$team][$component] = round($x[$teamLookup[$team]], 2);
      }
    }
    $out = array("eventCode" => $eventCode, "data" => $data, "keys" => $this->getNumericalBreakdownKeys($simpleMatchData));

    return $out;
  }

  function getStrategicMatches($eventCode)
  {
    error_log("---> starting getStrategicMatches for eventCode: $eventCode");  

    // If eventCode is "COMPX", just exit.
    if(strstr($eventCode,'COMPX') )   {
      error_log("skipping getStrategicMatches for COMPX");  
      $aout = array();
      return $aout;
    }

    $out = array();
    $mdata = array();
//    error_log("---> calling getMatches()");  
    $ml = $this->getMatches($eventCode);   // get all the matches at this event
  
    // Go thru all the matches and figure out which ones are our matches.
    $ourMatches = array();
//    error_log("---> going thru matches ");  
    foreach ($ml["response"] as $match)
    {
      $complevel = $match["comp_level"];
      if($complevel == "qm") {  // Only care about Qual matches
        // Put all this match's teams in $teams, then check for our teamnumber.
        $matchnum = $match["match_number"];
        $teams = array();
        for ($j = 0; $j < 3; $j++)
          array_push($teams, substr($match["alliances"]["red"]["team_keys"][$j],3));
        for ($k = 0; $k < 3; $k++)
          array_push($teams, substr($match["alliances"]["blue"]["team_keys"][$k],3));
        for ($m = 0; $m < 6; $m++)
        {
          // If team number is 2135, then this match is one of ours. 
          $entryNum = "$teams[$m]";
          if($entryNum == "2135") 
          {
//            error_log("     ---> found one of our matches: $matchnum");  
            $myMatch = array();  // store this match's num and teams in myMatch
            $myMatch["match_number"] = $matchnum;
            $myMatch["teams"] = $teams;
            array_push($ourMatches,$myMatch);
            break;
          }
        }
      }
    }

    // Now we have the list of our matches (with the teams).
    // For each of our matches, go thru the teams in the match. Get the full match list for each team 
    // in the match and hang on to their list of matches that are earlier (lower number) than that match.
    // Those are matches we want to strategic scout. So store as match# and teams.
    $msize = sizeof($ourMatches); 
//    error_log(" ===> ourMatches size = $msize");  
    for ($n = 0; $n < $msize; $n++)
    {
      $tmatch = array();
      $tmatch = $ourMatches[$n];
      $ourMatchNum = $tmatch["match_number"];
      $intOurMatchnum = (int)$ourMatchNum; 
//      error_log(" >>>> Looking at OUR match: $ourMatchNum");  

      // Get this match's teams; for each: get their match numbers. Any match# that is less than this 
      // match#, save it with that team number.
      $mteams = array();
      $mteams = $tmatch["teams"];
      for ($p = 0; $p < 6; $p++)
      {
        $tnum = "$mteams[$p]";
//        error_log("   >>>> for match $ourMatchNum, looking at team: $tnum");  
        // If team number is 2135, skip.
        if($tnum == "2135") 
          continue;

        // Get their match numbers.
//        error_log("     ===> going to get match numbers for team: $tnum");  
        foreach ($ml["response"] as $bmatch)
        {
          $bcomplevel = $bmatch["comp_level"];
          if($bcomplevel == "qm")  
          {   // Only care about Qual matches
            // If this match is earlier than ourMatchNum, check if it has this $tnum.
            $bmatchnum = $bmatch["match_number"];
//            error_log("      ===> looking at match $bmatchnum");  
            $intbmatchnum = (int)$bmatchnum; 
            if($intbmatchnum < $intOurMatchnum) 
            {
              // This match is earlier than ourMatchNum, so check if it has this team.
 //             error_log("        ===> match $bmatchnum is earlier than $ourMatchNum ");  

              $bteams = array();
              for ($j = 0; $j < 3; $j++)
                array_push($bteams, substr($bmatch["alliances"]["red"]["team_keys"][$j],3));
              for ($k = 0; $k < 3; $k++)
                array_push($bteams, substr($bmatch["alliances"]["blue"]["team_keys"][$k],3));
              for ($m = 0; $m < 6; $m++)
              {
                // If team number is 2135, then this match is one of ours. 
                $entryNum = "$bteams[$m]";
                if($entryNum == $tnum) 
                {
//                  error_log("     ---> found team $tnum! so save with match $bmatchnum");  
                  $dsize = sizeof($out); 
                  $bFoundInOut = 0;
                  for ($z = 0; $z < $dsize; $z++)
                  {
                    $dout = array();
                    $dout = $out[$z];
                    $dmnum = $dout["match_number"];
 //                   error_log("         ---> Looking at dout match# = $dmnum");  
                    if( $dout["match_number"] == $bmatchnum)
                    {
                      $bFoundInOut = 1;
//                      error_log("       ---> found match $bmatchnum in out; save with team $tnum");  
                      $prev = $dout["teams"];

                      // If tnum is already in prev, then don't do anything.
                      if(strpos($prev,$tnum) !== false)
                      {
//                        error_log("            ===> IN OUT: match $bmatchnum already had team $tnum"); 
                      }
                      else 
                      {
                        $str1 = ", ";
                        $prev .= $str1;   // append prev with str1
                        $prev .= $tnum;   // append with tnum
                        $dout["teams"] = $prev;
//                        error_log("            ===> IN OUT: match $bmatchnum: now teams = $prev");  
                        $out[$z] = $dout;
                      }
                      break;
                    }
                  }
                  if( $bFoundInOut == 0)
                  { 
                    $dout = array();
                    $dout["match_number"] = $bmatchnum;
                    $dout["teams"] = $tnum;
                    array_push($out,$dout);
//                    error_log("           >>>> ADDING to out: match $bmatchnum: teams = $tnum");  
              
                  }
                }
              }
            }
          }
        }
      }
    }
    return $out;
  }

}
