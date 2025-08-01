<?php
/*
  Build the Strategic Scouting match schedule
*/
class BuildStratSchedule
{
  // public function __construct()
  // {
  // }

  public static function getMatches($evtMatches)
  {
    // Go thru all the matches and figure out which ones are our matches.
    $ourMatches = array();  // Our matches at the event
    foreach ($evtMatches["response"] as $evtMatch)
    {
      // Put all this match's teams in $teams, then check for our teamnumber.
      $teamNums = array();
      foreach ($evtMatch["alliances"]["red"]["team_keys"] as $redTeam)
        array_push($teamNums, substr($redTeam, 3));
      foreach ($evtMatch["alliances"]["blue"]["team_keys"] as $blueTeam)
        array_push($teamNums, substr($blueTeam, 3));

      // If a team number is ours, then this match is one of ours. 
      foreach ($teamNums as $teamNum)
      {
        if ($teamNum === OURTEAM)
        {
          // error_log("  ---> found one of our matches: $matchnum");
          $myMatch = array();  // store this match's num and teamNums in myMatch
          $myMatch["comp_level"] = $evtMatch["comp_level"];
          $myMatch["match_number"] = $evtMatch["match_number"];
          $myMatch["teams"] = $teamNums;
          array_push($ourMatches, $myMatch);
          break;
        }
      }
    }

    // Now we have the list of our matches (with the teams).
    // For each of the event matches, go thru the teams in the match. Get the full match list for each team 
    // in the match and hang on to their list of matches that are earlier (lower number) than that match.
    // Those are matches we want to strategic scout. So store as match# and teams.
    $stratMatches = array();
    foreach ($evtMatches["response"] as $evtMatch)
    {
      // Get this match's teams; for each: get their match numbers. Any match# that is less than this 
      // match#, save it with that team number.
      if ($evtMatch["comp_level"] === "qm")   // Only care about Qual matches
      {
        // Get the basic event match info
        $matchInfo = array();
        $matchInfo["comp_level"] = $evtMatch["comp_level"];
        $matchInfo["match_number"] = $evtMatch["match_number"];
        $matchInfo["time"] = $evtMatch["time"];
        $matchInfo["predicted_time"] = $evtMatch["predicted_time"];
        $matchInfo["actual_time"] = $evtMatch["actual_time"];
        $matchInfo["teams"] = "";
        $stratTeams = array();

        // Build a team list for this match
        $evtTeams = array();
        foreach ($evtMatch["alliances"]["red"]["team_keys"] as $redTeam)
          array_push($evtTeams, substr($redTeam, 3));
        foreach ($evtMatch["alliances"]["blue"]["team_keys"] as $blueTeam)
          array_push($evtTeams, substr($blueTeam, 3));

        // For each event team, search through our matches to see if we play them later
        foreach ($evtTeams as $evtTeam)
        {
          foreach ($ourMatches as $ourMatch)
          {
            // If this match is earlier than ourMatchNum, check if it has this $ourTeam.
            if ((int) $evtMatch["match_number"] < (int) $ourMatch["match_number"])
            {
              foreach ($ourMatch["teams"] as $ourTeam)
              {
                if ($ourTeam === OURTEAM)
                  continue;

                // This event match is earlier than ourMatchNum, so check if it has this team.
                if ($evtTeam === $ourTeam)
                {
                  $alreadyListed = false;
                  foreach ($stratTeams as $stratTeam)
                  {
                    if ($evtTeam === $stratTeam)
                    {
                      $alreadyListed = true;
                      break;
                    }
                  }

                  if (empty($stratTeams) || !$alreadyListed)
                  {
                    array_push($stratTeams, $evtTeam);
                  }
                }
              }
            }
          }
        }

        foreach ($stratTeams as $stratTeam)
        {
          if ($matchInfo["teams"] !== "")
            $matchInfo["teams"] .= ", ";
          $matchInfo["teams"] .= $stratTeam;
        }
        // error_log($matchInfo["teams"]);
        array_push($stratMatches, $matchInfo); // TODO: Form list here
      }
    }

    return $stratMatches;
  }
}

?>

