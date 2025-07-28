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
      $matchInfo["actual_time"] = $match["actual_time"];

      // Put all this match's teams in $teams, then check for our teamnumber.
      $teams = array();
      for ($j = 0; $j < 3; $j++)
        array_push($teams, substr($match["alliances"]["red"]["team_keys"][$j], 3));
      for ($k = 0; $k < 3; $k++)
        array_push($teams, substr($match["alliances"]["blue"]["team_keys"][$k], 3));
      for ($m = 0; $m < 6; $m++)
      {
        // If team number is ours, then this match is one of ours. 
        $entryNum = "$teams[$m]";
        if ($entryNum === OURTEAM)
        {
          // error_log("  ---> found one of our matches: $matchnum");
          $myMatch = array();  // store this match's num and teams in myMatch
          $myMatch["comp_level"] = $match["comp_level"];
          $myMatch["match_number"] = $match["match_number"];
          $myMatch["teams"] = $teams;
          array_push($ourMatches, $myMatch);
          break;
        }
        array_push($allMatches, $matchInfo);
      }
    }

    // Now we have the list of our matches (with the teams).
    // For each of our matches, go thru the teams in the match. Get the full match list for each team 
    // in the match and hang on to their list of matches that are earlier (lower number) than that match.
    // Those are matches we want to strategic scout. So store as match# and teams.
    $msize = sizeof($ourMatches);
    // error_log(" ===> ourMatches size = $msize");
    for ($n = 0; $n < $msize; $n++)
    {
      $tmatch = array();
      $tmatch = $ourMatches[$n];
      $ourMatchNum = $tmatch["match_number"];
      $intOurMatchnum = (int) $ourMatchNum;
      // error_log("  >>>> Looking at OUR match: $ourMatchNum");

      // Get this match's teams; for each: get their match numbers. Any match# that is less than this 
      // match#, save it with that team number.
      $mteams = array();
      $mteams = $tmatch["teams"];
      for ($p = 0; $p < 6; $p++)
      {
        $tnum = "$mteams[$p]";
        // error_log("   >>>> for match $ourMatchNum, looking at team: $tnum");
        // If team number is 2135, skip.
        if ($tnum === "2135")
          continue;

        // Get their match numbers.
        // error_log("   ===> going to get match numbers for team: $tnum");
        foreach ($ml["response"] as $bmatch)
        {
          $bcomplevel = $bmatch["comp_level"];
          if ($bcomplevel === "qm")
          {   // Only care about Qual matches
            // If this match is earlier than ourMatchNum, check if it has this $tnum.
            $bmatchnum = $bmatch["match_number"];
            // error_log("    ===> looking at match $bmatchnum");
            $intbmatchnum = (int) $bmatchnum;
            if ($intbmatchnum < $intOurMatchnum)
            {
              // This match is earlier than ourMatchNum, so check if it has this team.
              // error_log("     ===> match $bmatchnum is earlier than $ourMatchNum ");

              $bteams = array();
              for ($j = 0; $j < 3; $j++)
                array_push($bteams, substr($bmatch["alliances"]["red"]["team_keys"][$j], 3));
              for ($k = 0; $k < 3; $k++)
                array_push($bteams, substr($bmatch["alliances"]["blue"]["team_keys"][$k], 3));
              for ($m = 0; $m < 6; $m++)
              {
                // If team number is 2135, then this match is one of ours. 
                $entryNum = "$bteams[$m]";
                if ($entryNum === $tnum)
                {
                  // error_log("      ---> found team $tnum! so save with match $bmatchnum");
                  $dsize = sizeof($out);
                  $bFoundInOut = 0;
                  for ($z = 0; $z < $dsize; $z++)
                  {
                    $dout = array();
                    $dout = $out[$z];
                    $dmnum = $dout["match_number"];
                    // error_log("       ---> Looking at dout match# = $dmnum");
                    if ($dout["match_number"] === $bmatchnum)
                    {
                      $bFoundInOut = 1;
                      // error_log("        ---> found match $bmatchnum in out; save with team $tnum");
                      $prev = $dout["teams"];

                      // If tnum is already in prev, then don't do anything.
                      if (strpos($prev, $tnum) !== false)
                      {
                        // error_log("          ===> IN OUT: match $bmatchnum already had team $tnum");
                      }
                      else
                      {
                        $str1 = ", ";
                        $prev .= $str1;   // append prev with str1
                        $prev .= $tnum;   // append with tnum
                        $dout["teams"] = $prev;
                        // error_log("          ===> IN OUT: match $bmatchnum: now teams = $prev");
                        $out[$z] = $dout;
                      }
                      break;
                    }
                  }
                  if ($bFoundInOut === 0)
                  {
                    $dout = array();
                    $dout["comp_level"] = $bcomplevel;
                    $dout["match_number"] = $bmatchnum;
                    $dout["teams"] = $tnum;
                    array_push($out, $dout);
                    // error_log("         >>>> ADDING to out: match $bmatchnum: teams = $tnum");
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

