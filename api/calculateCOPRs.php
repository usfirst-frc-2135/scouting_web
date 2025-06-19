<?php
/*
  COPR calculation utilities
*/
class CalculateCOPRs
{
  // public function __construct($tbaApiKey, $tbaTableName, $dbConnection)
  // {
  // }

  private static function removeElimMatches($matchData)
  {
    $out = array();
    foreach ($matchData as $matchRow)
    {
      if ($matchRow["comp_level"] === "qm")
      {
        array_push($out, $matchRow);
      }
    }
    return $out;
  }

  private static function removeUnplayedMatches($matchData)
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

  private static function getNumericalBreakdownKeys($matchData)
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

  // COPR Calculation 
  // NOTE: this will NOT work for events with multiple teams unless that event code is in 
  // the hard-coded list (see getEventTeamsEx()). The result is that there is no OPR data shown.

  private static function choleskyDecomposition($A)
  {
    //  Args:
    //    $A - Must be square matrix that is symetric and positive definite
    //  Returns:
    //    array("L" => and "Lp" =>) decompositions
    $n = sizeof($A);

    $L = array_fill(0, $n, array_fill(0, $n, 0));
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
        if ($i === $j)
        {
          $L[$i][$j] = sqrt($A[$i][$j] - $sum);
          $Lp[$j][$i] = sqrt($A[$i][$j] - $sum);
        }
        else
        {
          if ($L[$j][$j] != 0)
          {
            $L[$i][$j] = (1 / $L[$j][$j]) * ($A[$i][$j] - $sum);
            $Lp[$j][$i] = (1 / $L[$j][$j]) * ($A[$i][$j] - $sum);
            $test1 = (1 / $L[$j][$j]) * ($A[$i][$j] - $sum);
            $test2 = (1 / $L[$j][$j]) * ($A[$i][$j] - $sum);
          }
          else
          {
            error_log("---> in choleskyDecomposition(): avoiding divide-by-0!");
            $L[$i][$j] = 0;
            $Lp[$j][$i] = 0;
          }
        }
      }
    }

    return array("L" => $L, "Lp" => $Lp);
  }

  private static function forwardSubstitution($A, $B)
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
      if ($A[$i][$i] != 0)
      {
        $X[$i] = ($B[$i] - $sum) / $A[$i][$i];
        $test3 = ($B[$i] - $sum) / $A[$i][$i];
      }
      else
      {
        error_log("---> in forwardSubstitution(): avoiding divide-by-0");
        $X[$i] = 0;
      }
    }
    return $X;
  }

  private static function backwardSubstitution($A, $B)
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
      if ($A[$nm - $i][$nm - $i] != 0)
      {
        $X[$nm - $i] = ($B[$nm - $i] - $sum) / $A[$nm - $i][$nm - $i];
        $test4 = ($B[$nm - $i] - $sum) / $A[$nm - $i][$nm - $i];
      }
      else
      {
        error_log("---> in backwardSubstitution(): avoiding divide-by-0");
        $X[$nm - $i] = 0;
      }
    }
    return $X;
  }

  private static function createABMatricies($teamCount, $teamLookup, $matchData)
  {
    $aMatrix = array_fill(0, $teamCount, array_fill(0, $teamCount, 0)); // Just for who plays in what matchData
    $bVectors = array(); // Set of data we want to solve for

    $coprKeys = self::getNumericalBreakdownKeys($matchData);

    // Initialize B Vectors
    foreach ($coprKeys as $key)
    {
      $bVectors[$key] = array_fill(0, $teamCount, 0);
    }

    // Iterate through matches
    foreach ($matchData as &$match)
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

  public static function calculateCOPRS($eventCode, $teamCount, $teamList, $teamLookup, $matchData)
  {
    $matchData = self::removeElimMatches($matchData);
    $matchData = self::removeUnplayedMatches($matchData);
    $matchMatricies = self::createABMatricies($teamCount, $teamLookup, $matchData);

    $A = $matchMatricies["A"];
    $Bs = $matchMatricies["B"];
    $Xs = array();

    $Lmat = self::choleskyDecomposition($A);
    $L = $Lmat["L"];
    $Lp = $Lmat["Lp"];

    foreach ($Bs as $component => $Ba)
    {
      $y = self::forwardSubstitution($L, $Ba);
      $x = self::backwardSubstitution($Lp, $y);
      $Xs[$component] = $x;
    }

    // Repackage Values into Team Value Dicts
    $data = array();
    foreach ($teamList as $team)
    {
      $data[$team] = array();
      foreach ($Xs as $component => $x)
      {
        $data[$team][$component] = round($x[$teamLookup[$team]], 2);
      }
    }

    return array("eventCode" => $eventCode, "data" => $data, "keys" => self::getNumericalBreakdownKeys($matchData));
  }

}

?>

