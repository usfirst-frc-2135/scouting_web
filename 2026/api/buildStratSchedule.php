<?php
/*
  Build the Strategic Scouting match schedule
*/
class BuildStratSchedule
{
  // public function __construct()
  // {
  // }

  private static function getTeamsInMatch($match)
  {
    $teams = array();
    foreach ($match["alliances"]["red"]["team_keys"] as $redTeam)
      array_push($teams, substr($redTeam, 3));
    foreach ($match["alliances"]["blue"]["team_keys"] as $blueTeam)
      array_push($teams, substr($blueTeam, 3));
    return $teams;
  }

  public static function getMatches($evtMatches, $scheduleFilter)
  {
    // Go thru all the matches and figure out which ones are our matches.
    $ourMatches = array();  // Our matches at the event
    foreach ($evtMatches["response"] as $evtMatch)
    {
      // Put all this match's teams in $teams, then check for our teamnumber.
      $teamNums = self::getTeamsInMatch($evtMatch);

      // If a team number is ours, then this match is one of ours. 
      if (in_array((String) OURTEAM, $teamNums, true))
      {
        // error_log("  ---> found one of our matches: $matchnum");
        $myMatch = array();  // store this match's num and teamNums in myMatch
        $myMatch["comp_level"] = $evtMatch["comp_level"];
        $myMatch["match_number"] = $evtMatch["match_number"];
        $myMatch["teams"] = $teamNums;
        array_push($ourMatches, $myMatch);
      }
    }

    // Build watch and ignore filters from combined list filter
    $watchList = array();
    $ignoreList = array();
    $filter = json_decode($scheduleFilter, true);
    $watchList = $filter["watch"];
    $ignoreList = $filter["ignore"];

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
        $evtTeams = self::getTeamsInMatch($evtMatch);

        // For each event team, search through our matches to see if we play them later
        foreach ($evtTeams as $evtTeam)
        {
          // Scan schedule for all teams as a default
          $skipScan = false;

          // If in watch list, push to stratTeams here and skip the schedule scan
          foreach ($watchList as $watchTeam)
          {
            if ($evtTeam === $watchTeam["teamnumber"])
            {
              array_push($stratTeams, $evtTeam);
              $skipScan = true;
            }
          }

          // If in ignore list, skip the schedule scan
          foreach ($ignoreList as $ignoreTeam)
          {
            if ($evtTeam === $ignoreTeam["teamnumber"])
            {
              $skipScan = true;
            }
          }

          // Scan the schedule to make a list of teams we haven't played yet
          if (!$skipScan)
          {
            foreach ($ourMatches as $ourMatch)
            {
              // If this match is earlier than ourMatchNum, check if it has this $ourTeam.
              if ((int) $evtMatch["match_number"] < (int) $ourMatch["match_number"])
              {
                foreach ($ourMatch["teams"] as $ourTeam)
                {
                  // Don't check our own team number, just continue
                  if ($ourTeam === OURTEAM)
                    continue;

                  // Check if this event team is in the list of our matches
                  if ($evtTeam === $ourTeam)
                  {
                    $alreadyListed = in_array($evtTeam, $stratTeams, true);

                    if (empty($stratTeams) || !$alreadyListed)
                    {
                      array_push($stratTeams, $evtTeam);
                    }
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
        array_push($stratMatches, $matchInfo);
      }
    }

    return $stratMatches;
  }
}

?>

