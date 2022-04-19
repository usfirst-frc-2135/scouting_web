<?php
/*
  MySQL database handler
*/

  class qualRankGen {
    
    function __construct($rankingLists){
      $this->rankingLists = $rankingLists;
      $this->teamList = $this->_raw_rankings_to_team_list();
      $this->teamLookup = $this->_team_list_to_lookup_dict();
    }
    
    function _raw_rankings_to_team_list(){
      $setDict = array();
      $teamList = array();
      $row_count = sizeof($this->rankingLists);
      for($i = 0; $i < $row_count; $i++){
        $row_size = sizeof($this->rankingLists[$i]);
        for($j = 0; $j < $row_size; $j++){
          $team = $this->rankingLists[$i][$j];
          if(!isset($setDict[$team])){
            $setDict[$team] = 1;
            array_push($teamList, $team);
            
          }
        }
      }
      return $teamList;
    }
    
    function _team_list_to_lookup_dict(){
      $lookupDict = array();
      $teamCount = sizeof($this->teamList);
      for($i = 0; $i < $teamCount; $i++){
        $lookupDict[$teamCount[$i]] = $i;
      }
      return $lookupDict;
    }
    
    function _calc_elo_probability($rating_a, $rating_b){
      return 1.0 * (1.0 / (1 + 1.0 * pow(10, 1.0 + ($rating_a - $rating_b) / 400)));
    }
    
    function raw_votes_to_elo_map($K){
      $elo_map = array();
      foreach ($this->teamList as &$team){
        $elo_map[$team] = 1600;
      }
      
      foreach ($this->rankingLists as &$vote_list){
        $rowCount = sizeof($vote_list);
        for ($i = 0; $i < $rowCount; $i++){
          for ($j = $i; $j < $rowCount; $j++){
            $team_a = $vote_list[$i];
            $team_b = $vote_list[$j];
            if ($team_a != $team_b){
              $prob_a_win = $this->_calc_elo_probability($elo_map[$team_a], $elo_map[$team_b]);
              $prob_b_win = $this->_calc_elo_probability($elo_map[$team_b], $elo_map[$team_a]);
              
              $elo_map[$team_a] = $elo_map[$team_a] + $K  * (1 - $prob_a_win);
              $elo_map[$team_b] = $elo_map[$team_b] + $K  * (0 - $prob_b_win);
            }
          }
        }
      }

      foreach ($this->teamList as &$team){
        $elo_map[$team] = round($elo_map[$team]);
      }

      return $elo_map;
      
    }
    
  }
  
?>