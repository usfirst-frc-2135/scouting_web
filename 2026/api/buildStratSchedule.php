<?php
/*
  Build the Strategic Scouting match schedule
*/
class BuildStratSchedule
{
  // public function __construct()
  // {
  // }

  public static function getMatches($ml)
  {
    $out = array();

    // Go thru all the matches and figure out which ones are our matches.
    $ourMatches = array();  // Our matches at the event
    $allMatches = array();   // All matches at the event

    // error_log("---> going thru matches ");
    foreach ($ml["response"] as $match)
    {
      $matchInfo = array();
      $matchInfo["comp_level"] = $match["comp_level"];
      $matchInfo["match_number"] = $match["match_number"];
      $matchInfo["time"] = $match["time"];
      $matchInfo["predicted_time"] = $match["predicted_time"];
      $matchInfo["actual_time"] = $match["actual_time"];

      // Put all this match's teams in $teams, then check for our teamnumber.
      $teams = array();
      for ($j = 0; $j < 3; $j++)
        array_push($teams, substr($match["alliances"]["red"]["team_keys"][$j], 3));
      for ($k = 0; $k < 3; $k++)
        array_push($teams, substr($match["alliances"]["blue"]["team_keys"][$k], 3));

      // If a team number is ours, then this match is one of ours. 
      foreach ($teams as $tn)
      {
        if ($tn === OURTEAM)
        {
          // error_log("  ---> found one of our matches: $matchnum");
          $myMatch = array();  // store this match's num and teams in myMatch
          $myMatch["comp_level"] = $match["comp_level"];
          $myMatch["match_number"] = $match["match_number"];
          $myMatch["teams"] = $teams;
          array_push($ourMatches, $myMatch);
          break;
        }
      }

      $matchInfo["teams"] = $teams; // TODO: Do we need to keep all teams here? Or just get them from ourMatches
      array_push($allMatches, $matchInfo);
    }

    // Now we have the list of our matches (with the teams).
    // For each of our matches, go thru the teams in the match. Get the full match list for each team 
    // in the match and hang on to their list of matches that are earlier (lower number) than that match.
    // Those are matches we want to strategic scout. So store as match# and teams.
    foreach ($ourMatches as $tmatch)
    {
      // Get this match's teams; for each: get their match numbers. Any match# that is less than this 
      // match#, save it with that team number.
      foreach ($tmatch["teams"] as $tnum)
      {
        if ($tnum === OURTEAM)
          continue;

        // Get their match numbers.
        foreach ($ml["response"] as $bmatch)
        {
          if ($bmatch["comp_level"] === "qm")   // Only care about Qual matches
          {
            // If this match is earlier than ourMatchNum, check if it has this $tnum.
            $bmatchnum = $bmatch["match_number"];
            // error_log("    ===> looking at match $bmatchnum");
            if ((int) $bmatchnum < (int) $tmatch["match_number"])
            {
              // This match is earlier than ourMatchNum, so check if it has this team.
              $bteams = array();
              for ($j = 0; $j < 3; $j++)
                array_push($bteams, substr($bmatch["alliances"]["red"]["team_keys"][$j], 3));
              for ($k = 0; $k < 3; $k++)
                array_push($bteams, substr($bmatch["alliances"]["blue"]["team_keys"][$k], 3));

              foreach ($bteams as $bnum)
              {
                // If team number is a match here
                if ($bnum === $tnum)
                {
                  $bFoundInOut = false;
                  for ($z = 0; $z < sizeof($out); $z++)
                  {
                    $dout = $out[$z];
                    if ($dout["match_number"] === $bmatchnum)
                    {
                      $bFoundInOut = true;
                      $prev = $dout["teams"];
                      // If tnum is not in prev, then add it.
                      if (strpos($prev, $tnum) === false)
                      {
                        $dout["teams"] = $prev . ", " . $tnum;
                        $out[$z] = $dout;
                      }
                      break;
                    }
                  }

                  if ($bFoundInOut === false)
                  {
                    $dout = array();
                    $dout["comp_level"] = $bmatch["comp_level"];
                    $dout["match_number"] = $bmatchnum;
                    $dout["teams"] = $tnum;
                    array_push($out, $dout);
                  }
                }
              }
            }
          }
        }
      }
    }

    // TODO: Merge $out with our matches into the $allMatches array and send it out

    return $out;
  }

}

?>

