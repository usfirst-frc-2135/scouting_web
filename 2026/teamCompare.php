<?php
$title = 'Team Compare';
require 'inc/header.php';
?>

<div class="container row-offcanvas row-offcanvas-left">
  <div id="content" class="column card-lg-12 col-sm-12 col-xs-12">

    <!-- Page Title -->
    <div class="row pt-3 pb-3 mb-3">
      <h2 class="col-md-6"><?php echo $title; ?></h2>
    </div>

    <!-- Main row to hold the team number entry -->
    <div class="row col-md-6 mb-3">
      <div class="input-group mb-3">
        <input id="enterTeamNumber1" class="form-control" type="text" placeholder="FRC team number1" aria-label="Team Number">
        <input id="enterTeamNumber2" class="form-control" type="text" placeholder="FRC team number2" aria-label="Team Number">
        <div class="input-group-append">
          <button id="loadTeamButton" class="btn btn-primary" type="button">Load Teams</button>
        </div>
      </div>
    </div>

    <!-- First column of data starts here -->
    <div class="row">
      <div class="col-lg-6 col-sm-6 col-xs-6 gx-3">
        <div class="card mb-3">
          <div class="card-body">
            <h5 id="team1Title" class="card-title">Team1</h5>
            <h5 id="team2Title" class="card-title">Team2</h5>

            <!-- First Pick collapsible graph -->
            <div class="card mb-3" style="background-color:#F0FFFF">
              <div class="card-header">
                <h5 class="text-center">
                  <a href="#collapseFirstPickGraph" data-bs-toggle="collapse" aria-expanded="true">First Pick</a>
                </h5>
              </div>
              <div id="collapseFirstPickGraph" class="card-body collapse show">
                <canvas id="firstPickChart" width="400" height="360"></canvas>
              </div>
            </div>
            <!-- end of First Pick collapsible graph -->

            <!-- Second Pick collapsible graph -->
            <div class="card mb-3" style="background-color:#F0FFFF">
              <div class="card-header">
                <h5 class="text-center">
                  <a href="#collapseSecondPickGraph" data-bs-toggle="collapse" aria-expanded="false">Second Pick</a>
                </h5>
              </div>
              <div id="collapseSecondPickGraph" class="card-body collapse">
                <canvas id="secondPickChart" width="400" height="360"></canvas>
              </div>
            </div>

            <!-- Third Pick collapsible graph -->
            <div class="card mb-3" style="background-color:#F0FFFF">
              <div class="card-header">
                <h5 class="text-center">
                  <a href="#collapseThirdPickGraph" data-bs-toggle="collapse" aria-expanded="false">Third Pick</a>
                </h5>
              </div>
              <div id="collapseThirdPickGraph" class="card-body collapse">
                <canvas id="ThirdPickChart" width="400" height="360"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Second column of data starts here -->
      <div class="col-lg-6 col-sm-6 col-xs-6 gx-3">
        <div class="card mb-3" style="background-color:#FBE6D3">
          <div class="card-header">
            <h5 class="text-center"> <a href="#collapseEndgame" data-bs-toggle="collapse" aria-expanded="false">Endgame Climb
                Percentages
              </a>
            </h5>
          </div>
          <div id="collapseEndgame" class="card-body collapse">
            <table id="endgameClimbTable" class="table table-striped table-bordered table-hover table-sm border-dark text-center ">
              <thead>
                <tr>
                  <th> </th>
                  <th style="width:12%" scope="col">N%</th>
                  <th style="width:12%" scope="col">F%</th>
                  <th style="width:12%" scope="col">P%</th>
                  <th style="width:12%" scope="col">S%</th>
                  <th style="width:12%" scope="col">D%</th>
                </tr>
              </thead>
              <tbody class="table-group-divider">
                <tr>
                  <td id="team1Title3" class="card-title">Team 1 # </td>
                  <td> </td>
                  <td> </td>
                  <td> </td>
                  <td> </td>
                  <td> </td>
                </tr>
                <tr>
                  <td id="team2Title3" class="card-title">Team 2 # </td>
                  <td> </td>
                  <td> </td>
                  <td> </td>
                  <td> </td>
                  <td> </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="card mb-3">
      <div id="strategicLink1" class="card-header">
        <h5 class="text-center">
          <a href="#collapseStrategicData1" data-bs-toggle="collapse" aria-expanded="false">Team 1 - Strategic Data</a>
        </h5>
      </div>
      <div id="collapseStrategicData1" class="card-body collapse">
        <div class="overflow-auto">
          <table id="strategicDataTable1"
            class="table table-striped table-bordered table-hover table-sm border-dark text-center sortable">
            <colgroup>
              <col span="2" style="background-color:transparent">
              <col span="1" style="background-color:#cfe2ff">
              <col span="1" style="background-color:transparent">
              <col span="1" style="background-color:#cfe2ff">
              <col span="1" style="background-color:transparent">
              <col span="1" style="background-color:#cfe2ff">
              <col span="1" style="background-color:transparent">
              <col span="1" style="background-color:#cfe2ff">
              <col span="1" style="background-color:transparent">
              <col span="1" style="background-color:#cfe2ff">
              <col span="1" style="background-color:transparent">
              <col span="1" style="background-color:#cfe2ff">
              <col span="1" style="background-color:transparent">
              <col span="1" style="background-color:#cfe2ff">
              <col span="1" style="background-color:transparent">
              <col span="1" style="background-color:#cfe2ff">
              <col span="1" style="background-color:transparent">
              <col span="1" style="background-color:#cfe2ff">
              <col span="1" style="background-color:transparent">
              <col span="1" style="background-color:#cfe2ff">
              <col span="1" style="background-color:transparent">
              <col span="1" style="background-color:#cfe2ff">
              <col span="1" style="background-color:transparent">
              <col span="1" style="background-color:#cfe2ff">
              <col span="1" style="background-color:transparent">
              <col span="1" style="background-color:#cfe2ff">
            </colgroup>
            <thead>
              <tr>
                <th colspan="1"> </th>
                <th colspan="1"> </th>
                <th colspan="2" class="text-center" style="background-color:#3686FF">Against Defense</th>
                <th colspan="3" class="text-center">Defense Tactics</th>
                <th colspan="8" class="text-center" style="background-color:#3686FF">Fouls</th>
                <th colspan="4" class="text-center">Auton</th>
                <th colspan="4" class="text-center" style="background-color:#3686FF">Teleop</th>
                <th colspan="2" class="text-center">Notes</th>
                <th colspan="1"> </th>
              </tr>
              <tr>
                <th scope="col">Match</th>
                <th scope="col">Drive Skill</th>
                <th scope="col">Block</th>
                <th scope="col">Note</th>
                <th scope="col">Block Path</th>
                <th scope="col">Block Stn</th>
                <th scope="col">Note</th>
                <th scope="col">Pin</th>
                <th scope="col">Auton Barge Contact</th>
                <th scope="col">Auton Cage Contact</th>
                <th scope="col">Anchor Contact</th>
                <th scope="col">Barge Contact</th>
                <th scope="col">Reef Contact</th>
                <th scope="col">Cage Contact</th>
                <th scope="col">Contact Climbing Robot</th>
                <th scope="col">Get Floor Coral</th>
                <th scope="col">Get Stn Coral</th>
                <th scope="col">Get Floor Algae</th>
                <th scope="col">Get Reef Algae</th>
                <th scope="col">Get Floor Coral</th>
                <th scope="col">Get Floor Algae</th>
                <th scope="col">Knock Algae</th>
                <th scope="col">Aquire Reef Algae</th>
                <th scope="col">Problem Note</th>
                <th scope="col">General Note</th>
                <th scope="col">Scout Name</th>
              </tr>
            </thead>
            <tbody class="table-group-divider"> </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="card mb-3">
      <div id="strategicLink2" class="card-header">
        <h5 class="text-center">
          <a href="#collapseStrategicData2" data-bs-toggle="collapse" aria-expanded="false">Team 2 - Strategic Data</a>
        </h5>
      </div>
      <div id="collapseStrategicData2" class="card-body collapse">
        <div class="overflow-auto">
          <table id="strategicDataTable2"
            class="table table-striped table-bordered table-hover table-sm border-dark text-center sortable">
            <colgroup>
              <col span="2" style="background-color:transparent">
              <col span="1" style="background-color:#cfe2ff">
              <col span="1" style="background-color:transparent">
              <col span="1" style="background-color:#cfe2ff">
              <col span="1" style="background-color:transparent">
              <col span="1" style="background-color:#cfe2ff">
              <col span="1" style="background-color:transparent">
              <col span="1" style="background-color:#cfe2ff">
              <col span="1" style="background-color:transparent">
              <col span="1" style="background-color:#cfe2ff">
              <col span="1" style="background-color:transparent">
              <col span="1" style="background-color:#cfe2ff">
              <col span="1" style="background-color:transparent">
              <col span="1" style="background-color:#cfe2ff">
              <col span="1" style="background-color:transparent">
              <col span="1" style="background-color:#cfe2ff">
              <col span="1" style="background-color:transparent">
              <col span="1" style="background-color:#cfe2ff">
              <col span="1" style="background-color:transparent">
              <col span="1" style="background-color:#cfe2ff">
              <col span="1" style="background-color:transparent">
              <col span="1" style="background-color:#cfe2ff">
              <col span="1" style="background-color:transparent">
              <col span="1" style="background-color:#cfe2ff">
              <col span="1" style="background-color:transparent">
              <col span="1" style="background-color:#cfe2ff">
            </colgroup>
            <thead>
              <tr>
                <th colspan="1"> </th>
                <th colspan="1"> </th>
                <th colspan="2" class="text-center" style="background-color:#3686FF">Against Defense</th>
                <th colspan="3" class="text-center">Defense Tactics</th>
                <th colspan="8" class="text-center" style="background-color:#3686FF">Fouls</th>
                <th colspan="4" class="text-center">Auton</th>
                <th colspan="4" class="text-center" style="background-color:#3686FF">Teleop</th>
                <th colspan="2" class="text-center">Notes</th>
                <th colspan="1"> </th>
              </tr>
              <tr>
                <th scope="col">Match</th>
                <th scope="col">Drive Skill</th>
                <th scope="col">Block</th>
                <th scope="col">Note</th>
                <th scope="col">Block Path</th>
                <th scope="col">Block Stn</th>
                <th scope="col">Note</th>
                <th scope="col">Pin</th>
                <th scope="col">Auton Barge Contact</th>
                <th scope="col">Auton Cage Contact</th>
                <th scope="col">Anchor Contact</th>
                <th scope="col">Barge Contact</th>
                <th scope="col">Reef Contact</th>
                <th scope="col">Cage Contact</th>
                <th scope="col">Contact Climbing Robot</th>
                <th scope="col">Get Floor Coral</th>
                <th scope="col">Get Stn Coral</th>
                <th scope="col">Get Floor Algae</th>
                <th scope="col">Get Reef Algae</th>
                <th scope="col">Get Floor Coral</th>
                <th scope="col">Get Floor Algae</th>
                <th scope="col">Knock Algae</th>
                <th scope="col">Aquire Reef Algae</th>
                <th scope="col">Problem Note</th>
                <th scope="col">General Note</th>
                <th scope="col">Scout Name</th>
              </tr>
            </thead>
            <tbody class="table-group-divider"> </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>


<div class="container row-offcanvas row-offcanvas-left">
  <div class="column card-lg-12 col-sm-12 col-xs-12" id="content">

    <!-- Page Title -->
    <div class="row pt-3 pb-3 mb-3">
      <h3 class="col-md-4"><?php echo "Team Averages"; ?></h3>

      <!-- Match Filter -->
      <div class="col-md-3 mb-3">
        <div id="customMatch" class="accordion accordion-flush">
          <div class="accordion-item" style="background-color: #F8F9FA">
            <h2 class="accordion-header">
              <button class="accordion-button text-light bg-secondary" type="button" data-bs-toggle="collapse"
                data-bs-target="#filterEntry" aria-expanded="false" aria-controls="matchEntry">Match Range Filter</button>
            </h2>

            <div id="filterEntry" class="accordion-collapse collapse" data-bs-parent="#customMatch">

              <div class="input-group">
                <div class="input-group-prepend">
                  <select id="startCompLevel" class="form-select mb-3" aria-label="Comp Level Select">
                    <option value="p">P</option>
                    <option value="qm" selected>QM</option>
                    <option value="sf">SF</option>
                    <option value="f">F</option>
                  </select>
                </div>
                <input id="startMatchNum" class="form-control col-2 mb-3" type="text" placeholder="Start"
                  aria-label="Start Match Filter">
              </div>

              <div class="input-group">
                <div class="input-group-prepend">
                  <select id="endCompLevel" class="form-select mb-3" aria-label="Comp Level Select">
                    <option value="p">P</option>
                    <option value="qm" selected>QM</option>
                    <option value="sf">SF</option>
                    <option value="f">F</option>
                  </select>
                </div>
                <input id="endMatchNum" class="form-control col-2 mb-3" type="text" placeholder="End" aria-label="End Match Filter">
              </div>


            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Main row to hold the table -->
    <div class="row mb-3">

      <div id="freeze-table" class="freeze-table overflow-auto">
        <table id="averagesTable" class="table table-striped table-bordered table-hover table-sm border-dark text-center sortable">
          <colgroup>
            <col span="2" style="background-color:transparent">
            <col span="2" style="background-color:#cfe2ff">
            <col span="2" style="background-color:transparent">
            <col span="2" style="background-color:#cfe2ff">
            <col span="2" style="background-color:transparent">
            <col span="2" style="background-color:#cfe2ff">
            <col span="2" style="background-color:transparent">
            <col span="2" style="background-color:#cfe2ff">
            <col span="2" style="background-color:transparent">
            <col span="2" style="background-color:#cfe2ff">
            <col span="2" style="background-color:transparent">
            <col span="2" style="background-color:#cfe2ff">
            <col span="2" style="background-color:transparent">
            <col span="2" style="background-color:#cfe2ff">
            <col span="2" style="background-color:transparent">
            <col span="2" style="background-color:#cfe2ff">
            <col span="2" style="background-color:transparent">
            <col span="2" style="background-color:#cfe2ff">
            <col span="2" style="background-color:transparent">
            <col span="3" style="background-color:#cfe2ff">
            <col span="2" style="background-color:transparent">
            <col span="2" style="background-color:#cfe2ff">
            <col span="2" style="background-color:transparent">
            <col span="2" style="background-color:#cfe2ff">
            <col span="3" style="background-color:transparent">
            <col span="2" style="background-color:#cfe2ff">
            <col span="2" style="background-color:transparent">
            <col span="1" style="background-color:#cfe2ff">
            <col span="1" style="background-color:transparent">
            <col span="1" style="background-color:#cfe2ff">
            <col span="1" style="background-color:transparent">
            <col span="1" style="background-color:#cfe2ff">
            <col span="1" style="background-color:transparent">
            <col span="1" style="background-color:#cfe2ff">
          </colgroup>
          <thead>
            <tr>
              <th colspan="2" style="background-color:transparent"></th>
              <th colspan="8" style="background-color:#83b4ff">Match Points</th>
              <th colspan="4" style="background-color:#d5e6de">Auton Pts</th>
              <th colspan="4" style="background-color:#d6f3fB">Teleop Pts</th>
              <th colspan="4" style="background-color:#83b4ff">Game pieces</th>
              <th colspan="10" style="background-color:#d5e6de">Auton Coral</th>
              <th colspan="6" style="background-color:#d5e6de">Auton Algae</th>
              <th colspan="11" style="background-color:#d6f3fB">Teleop Coral</th>
              <th colspan="7" style="background-color:#d6f3fB">Teleop Algae</th>
              <th colspan="1" style="background-color:#AFE8F7">Def</th>
              <th colspan="5" style="background-color:#fbe6d3">Endgame</th>
              <th colspan="1" style="background-color:transparent"></th>
            </tr>
            <tr>
              <!-- team number -->
              <th colspan="2" style="background-color:transparent"></th>

              <!-- points by game phase -->
              <th colspan="2" style="background-color:#83b4ff">Total Pts</th>
              <th colspan="2" style="background-color:#d5e6de">Auton Pts</th>
              <th colspan="2" style="background-color:#d6f3fB">Teleop Pts</th>
              <th colspan="2" style="background-color:#fbe6d3">Endgame Pts</th>

              <!-- points by game piece -->
              <th colspan="2" style="background-color:#d5e6de">Coral Pts</th>
              <th colspan="2" style="background-color:transparent">Algae Pts</th>
              <th colspan="2" style="background-color:#d6f3fB">Coral Pts</th>
              <th colspan="2" style="background-color:transparent">Algae Pts</th>

              <th colspan="2" style="background-color:#83b4ff">Total Coral</th>
              <th colspan="2" style="background-color:transparent">Total Algae</th>

              <!-- auton coral -->
              <th colspan="2" style="background-color:#d5e6de">Auton Coral</th>
              <th colspan="2" style="background-color:transparent">L4</th>
              <th colspan="2" style="background-color:#d5e6de">L3</th>
              <th colspan="2" style="background-color:transparent">L2</th>
              <th colspan="2" style="background-color:#d5e6de">L1</th>

              <!-- auton algae -->
              <th colspan="2" style="background-color:transparent">Total Algae</th>
              <th colspan="2" style="background-color:#d5e6de">Proc</th>
              <th colspan="2" style="background-color:transparent">Net</th>

              <!-- teleop coral -->
              <th colspan="3" style="background-color:#d6f3fB">Teleop Coral</th>
              <th colspan="2" style="background-color:transparent">L4</th>
              <th colspan="2" style="background-color:#d6f3fB">L3</th>
              <th colspan="2" style="background-color:transparent">L2</th>
              <th colspan="2" style="background-color:#d6f3fB">L1</th>

              <!-- teleop algae -->
              <th colspan="3" style="background-color:transparent">Teleop Algae</th>
              <th colspan="2" style="background-color:#d6f3fB">Proc</th>
              <th colspan="2" style="background-color:transparent">Net</th>

              <!-- defense -->
              <th colspan="1" style="background-color:#AFE8F7"></th>

              <!-- endgame -->
              <th colspan="5" style="background-color:#fbe6d3">Climb%</th>

              <!-- died -->
              <th colspan="1" style="background-color:transparent">Died</th>
            </tr>
            <tr>
              <!-- team number -->
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Team</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Alias</th>

              <!-- points by game phase -->
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Max</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Max</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Max</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Max</th>

              <!-- points by game piece -->
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Max</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Max</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Max</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Max</th>

              <!-- total game pieces -->
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Max</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Max</th>

              <!-- auton coral -->
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Max</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Max</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Max</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Max</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Max</th>

              <!-- auton algae -->
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Max</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Max</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Max</th>

              <!-- teleop coral -->
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Acc%</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Max</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Max</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Max</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Max</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Max</th>

              <!-- telop algae -->
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Acc%</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Max</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Max</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Max</th>

              <!-- defense -->
              <th scope="col" class="sorttable_numeric" style="background-color:#AFE8F7">Avg</th>

              <!-- endgame -->
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">N</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">P</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">F</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">S</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">D</th>

              <!-- died -->
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">#</th>
            </tr>

          <tbody class="table-group-divider">
            <tr>
              <td id="team1Title4" class="card-title">Team 1 # </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
            </tr>
            <tr>
              <td id="team2Title4" class="card-title">Team 2 # </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
            </tr>
          </tbody>

          </thead>
          <tbody class="table-group-divider"> </tbody>
        </table>
      </div>
    </div>
  </div>

  <?php include 'inc/footer.php'; ?>

  <!-- Javascript page handlers -->


  <script>

    let firstPickChart;
    let secondPickChart;
    let thirdPickChart;

    // Round data to no more than two decimal digits
    function roundTwoPlaces(val) {
      return Math.round((val + Number.EPSILON) * 100) / 100;
    }

    ///// FIRST PICK GRAPH STARTS HERE /////
    function loadFirstPickGraph(team1, team2, avgData1, avgData2) {
      console.log("==> teamCompare: loadFirstPickGraph()");

      let xLabels = ["Auton Avg Pts", "Teleop Avg Pts", "Endgame Avg Pts", "Teleop Net Pts", "Teleop L4 Pts", "Teleop L3 Pts"]
      let datasets = [];

      let t1DataA = avgData1[team1]["autonPointsAvg"];
      let t1DataB = avgData1[team1]["teleopPointsAvg"];
      let t1DataC = avgData1[team1]["endgamePointsAvg"];

      // Multiply teleopAlgaeNetAvg by 4 to get points.
      let t1DataD = avgData1[team1]["teleopAlgaeNetAvg"];
      let netPts1 = t1DataD * 4;

      // Multiply teleopCoralL4Avg by 5 to get points.
      let t1DataE = avgData1[team1]["teleopCoralL4Avg"];
      let L4Pts1 = t1DataE * 5;

      // Multiply teleopCoralL3Avg by 4 to get points.
      let t1DataF = avgData1[team1]["teleopCoralL3Avg"];
      let L3Pts1 = t1DataF * 4;

      let t2DataA = avgData2[team2]["autonPointsAvg"];
      let t2DataB = avgData2[team2]["teleopPointsAvg"];
      let t2DataC = avgData2[team2]["endgamePointsAvg"];

      // Multiply teleopAlgaeNetAvg by 4 to get points.
      let t2DataD = avgData2[team2]["teleopAlgaeNetAvg"];
      let netPts2 = t2DataD * 4;

      // Multiply teleopCoralL4Avg by 5 to get points.
      let t2DataE = avgData2[team2]["teleopCoralL4Avg"];
      let L4Pts2 = t2DataE * 5;

      // Multiply teleopCoralL3Avg by 4 to get points.
      let t2DataF = avgData2[team2]["teleopCoralL3Avg"];
      let L3Pts2 = t2DataF * 4;

      datasets.push({ label: team1, data: [t1DataA, t1DataB, t1DataC, netPts1, L4Pts1, L3Pts1], backgroundColor: '#FF4316' });
      datasets.push({ label: team2, data: [t2DataA, t2DataB, t2DataC, netPts2, L4Pts2, L3Pts2], backgroundColor: '#0033FF' });

      // Define the graph as a bar chart:
      if (firstPickChart !== undefined) {
        firstPickChart.destroy();
      }

      // Create the Auton graph
      const ctx = document.getElementById('firstPickChart').getContext('2d');
      firstPickChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: xLabels,
          datasets: datasets
        },
        options: {
          scales: {
            x: {},
            y: { min: 0, ticks: { precision: 0 }, max: 50 } // Set Y axis maximum value - 4 coral + algae in  auto plus leave
          },
          plugins: {
          }
        }
      });
    }
    // End of FIRST PICK GRAPH 

    ///// SECOND PICK GRAPH STARTS HERE /////
    function loadSecondPickGraph(team1, team2, avgData1, avgData2) {
      console.log("==> teamCompare: loadSecondPickGraph()");

      let xLabels = ["Auton Avg Pts", "Teleop Avg Pts", "Endgame Avg Pts", "Teleop Net Pts", "Teleop L3 Pts", "Teleop L2 Pts"]
      let datasets = [];

      let t1DataA = avgData1[team1]["autonPointsAvg"];
      let t1DataB = avgData1[team1]["teleopPointsAvg"];
      let t1DataC = avgData1[team1]["endgamePointsAvg"];

      // Multiply teleopAlgaeNetAvg by 4 to get points.
      let t1DataD = avgData1[team1]["teleopAlgaeNetAvg"];
      let netPts1 = t1DataD * 4;

      // Multiply teleopCoralL3Avg by 4 to get points.
      let t1DataE = avgData1[team1]["teleopCoralL3Avg"];
      let L3Pts1 = t1DataE * 4;

      // Multiply teleopCoralL2Avg by 3 to get points.
      let t1DataF = avgData1[team1]["teleopCoralL2Avg"];
      let L2Pts1 = t1DataF * 3;

      let t2DataA = avgData2[team2]["autonPointsAvg"];
      let t2DataB = avgData2[team2]["teleopPointsAvg"];
      let t2DataC = avgData2[team2]["endgamePointsAvg"];

      // Multiply teleopAlgaeNetAvg by 4 to get points.
      let t2DataD = avgData2[team2]["teleopAlgaeNetAvg"];
      let netPts2 = t2DataD * 4;

      // Multiply teleopCoralL3Avg by 4 to get points.
      let t2DataE = avgData2[team2]["teleopCoralL3Avg"];
      let L3Pts2 = t2DataE * 4;

      // Multiply teleopCoralL2Avg by 3 to get points.
      let t2DataF = avgData2[team2]["teleopCoralL2Avg"];
      let L2Pts2 = t2DataF * 3;

      datasets.push({ label: team1, data: [t1DataA, t1DataB, t1DataC, netPts1, L3Pts1, L2Pts1], backgroundColor: '#FF4316' });
      datasets.push({ label: team2, data: [t2DataA, t2DataB, t2DataC, netPts2, L3Pts2, L2Pts2], backgroundColor: '#0033FF' });

      // Define the graph as a bar chart:
      if (secondPickChart !== undefined) {
        secondPickChart.destroy();
      }

      // Create the second pick graph
      const ctx = document.getElementById('secondPickChart').getContext('2d');
      secondPickChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: xLabels,
          datasets: datasets
        },
        options: {
          scales: {
            x: {},
            y: { min: 0, ticks: { precision: 0 }, max: 50 } // Set Y axis maximum value - 4 coral + algae in  auto plus leave
          },
          plugins: {
          }
        }
      });
    }
    // End of SECOND PICK GRAPH 

    ///// THIRD PICK GRAPH STARTS HERE /////
    function loadThirdPickGraph(team1, team2, avgData1, avgData2) {
      console.log("==> teamCompare: loadThirdPickGraph()");

      let xLabels = ["Auton Avg Pts", "Teleop Avg Pts", "Endgame Avg Pts", "Teleop Net Pts", "Teleop L3 Pts"]
      let datasets = [];

      let t1DataA = avgData1[team1]["autonPointsAvg"];
      let t1DataB = avgData1[team1]["teleopPointsAvg"];
      let t1DataC = avgData1[team1]["endgamePointsAvg"];

      // Multiply teleopAlgaeNetAvg by 4 to get points.
      let t1DataD = avgData1[team1]["teleopAlgaeNetAvg"];
      let netPts1 = t1DataD * 4;

      // Multiply teleopCoralL3Avg by 4 to get points.
      let t1DataE = avgData1[team1]["teleopCoralL3Avg"];
      let L3Pts1 = t1DataE * 4;

      let t2DataA = avgData2[team2]["autonPointsAvg"];
      let t2DataB = avgData2[team2]["teleopPointsAvg"];
      let t2DataC = avgData2[team2]["endgamePointsAvg"];

      // Multiply teleopAlgaeNetAvg by 4 to get points.
      let t2DataD = avgData2[team2]["teleopAlgaeNetAvg"];
      let netPts2 = t2DataD * 4;

      // Multiply teleopCoralL3Avg by 4 to get points.
      let t2DataE = avgData2[team2]["teleopCoralL3Avg"];
      let L3Pts2 = t2DataE * 4;

      datasets.push({ label: team1, data: [t1DataA, t1DataB, t1DataC, netPts1, L3Pts1], backgroundColor: '#FF4316' });
      datasets.push({ label: team2, data: [t2DataA, t2DataB, t2DataC, netPts2, L3Pts2], backgroundColor: '#0033FF' });

      // Define the graph as a bar chart:
      if (thirdPickChart !== undefined) {
        thirdPickChart.destroy();
      }

      // Create the third pick graph
      const ctx = document.getElementById('ThirdPickChart').getContext('2d');
      thirdPickChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: xLabels,
          datasets: datasets
        },
        options: {
          scales: {
            x: {},
            y: { min: 0, ticks: { precision: 0 }, max: 50 } // Set Y axis maximum value - 4 coral + algae in  auto plus leave
          },
          plugins: {
          }
        }
      });
    }
    // End of THIRD PICK GRAPH 

    function loadMatchData(teamNum1, teamNum2, mdp1, mdp2) {
      if (mdp1 == null || mdp2 == null) {
        return;
      }
      console.log("loadMatchData: we have all the data, so do it");

      // Get the team1 averages data from matchDataProcessor (mdp)
      mdp1.getSiteFilteredAverages(function (filteredMatches, filteredAvgData) {
        if (filteredAvgData != undefined) {
          console.log("loadMatchData: got mdp1");

          // Get the team2 averages data from matchDataProcessor (mdp)
          mdp2.getSiteFilteredAverages(function (filteredMatches2, filteredAvgData2) {
            if (filteredAvgData2 != undefined) {
              console.log("loadMatchData: got mdp2");

              // Load the graphs
              loadFirstPickGraph(teamNum1, teamNum2, filteredAvgData, filteredAvgData2);
              loadSecondPickGraph(teamNum1, teamNum2, filteredAvgData, filteredAvgData2);
              loadThirdPickGraph(teamNum1, teamNum2, filteredAvgData, filteredAvgData2);
              loadEndgameTable(teamNum1, teamNum2, filteredAvgData, filteredAvgData2);
              loadAvgTable(teamNum1, teamNum2, filteredAvgData, filteredAvgData2);
            }
            else alert("No averages data for this team 2 at this event!");
          });
        }
        else alert("No averages data for this team at this event!");
      });
    }


    // MAIN PAGE PROCESSORS HERE
    // Check if our URL directs to a specific team
    function checkURLForTeamSpec() {
      console.log("=> teamCompare: checkURLForTeamSpec()");
      let sp = new URLSearchParams(window.location.search);
      if (sp.has('teamNum1')) {
        return sp.get('teamNum1');
      }
      return null;
    }
    function checkURLForTeamSpec1() {
      console.log("=> teamCompare: checkURLForTeamSpec()");
      let sp = new URLSearchParams(window.location.search);
      if (sp.has('teamNum2')) {
        return sp.get('teamNum2');
      }
      return null;
    }

    function checkURLForTeamSpec2() {
      console.log("=> teamCompare: checkURLForTeamSpec()");
      let sp2 = new URLSearchParams(window.location.search);
      if (sp2.has('teamNum1Second')) {
        return sp.get('teamNum1Second');
      }
      return null;
    }
    function checkURLForTeamSpec3() {
      console.log("=> teamCompare: checkURLForTeamSpec()");
      let sp2 = new URLSearchParams(window.location.search);
      if (sp2.has('teamNum2Second')) {
        return sp.get('teamNum2Second');
      }
      return null;
    }

    function checkURLForTeamSpec4() {
      console.log("=> teamCompare: checkURLForTeamSpec()");
      let sp2 = new URLSearchParams(window.location.search);
      if (sp2.has('teamNum1Third')) {
        return sp.get('teamNum1Third');
      }
      return null;
    }
    function checkURLForTeamSpec4() {
      console.log("=> teamCompare: checkURLForTeamSpec()");
      let sp2 = new URLSearchParams(window.location.search);
      if (sp2.has('teamNum2Third')) {
        return sp.get('teamNum2Third');
      }
      return null;
    }

    function clearTeamComparePage() {
      // Clear existing data
      document.getElementById("team1Title").innerText = "";
      document.getElementById("team2Title").innerText = "";
      document.getElementById("firstPickChart").querySelector('tbody').innerHTML = "";
      document.getElementById("secondPickChart").querySelector('tbody').innerHTML = "";
      document.getElementById("thirdPickChart").querySelector('tbody').innerHTML = "";
      document.getElementById("strategicDataTable").querySelector('tbody').innerHTML = "";
      document.getElementById("strategicDataTable2").querySelector('tbody').innerHTML = "";
    }

    function getDataValue(dict, key) {
      if (!dict) {
        console.warn("getDataValue: Dictionary not found! " + dict);
      }
      else if (key in dict) {
        return dict[key];
      }
      else {
        console.warn("getDataValue: Key not found in dictionary! " + key + " " + dict);
      }
      return "";
    }

    function loadEndgameTable(teamNum, teamNum2, avgData, avgData2) {
      console.log("==> teamCompare: loadEndgameTable()");
      let tbodyRef = document.getElementById("endgameClimbTable").querySelector('tbody');
      tbodyRef.innerHTML = ""; // Clear Table

      let endgameClimbPercentage = getDataValue(avgData[teamNum], "endgameClimbPercent");
      let endgameClimbPercentage2 = getDataValue(avgData2[teamNum2], "endgameClimbPercent");
      const tdPrefix = "<td>";
      let rowString = "";
      let rowString2 = "";
      rowString += tdPrefix + "<a href='teamLookup.php?teamNum=" + teamNum + "'>" + teamNum + "</a></td>";

      rowString += tdPrefix + getDataValue(endgameClimbPercentage, 0) + "</td>";
      rowString += tdPrefix + getDataValue(endgameClimbPercentage, 2) + "</td>";
      rowString += tdPrefix + getDataValue(endgameClimbPercentage, 1) + "</td>";
      rowString += tdPrefix + getDataValue(endgameClimbPercentage, 3) + "</td>";
      rowString += tdPrefix + getDataValue(endgameClimbPercentage, 4) + "</td>";

      tbodyRef.insertRow().innerHTML = rowString;

      rowString2 += tdPrefix + "<a href='teamLookup.php?teamNum=" + teamNum2 + "'>" + teamNum2 + "</a></td>";

      rowString2 += tdPrefix + getDataValue(endgameClimbPercentage2, 0) + "</td>";
      rowString2 += tdPrefix + getDataValue(endgameClimbPercentage2, 2) + "</td>";
      rowString2 += tdPrefix + getDataValue(endgameClimbPercentage2, 1) + "</td>";
      rowString2 += tdPrefix + getDataValue(endgameClimbPercentage2, 3) + "</td>";
      rowString2 += tdPrefix + getDataValue(endgameClimbPercentage2, 4) + "</td>";

      tbodyRef.insertRow().innerHTML = rowString2;
    }

    function loadAvgTable(teamNum, teamNum2, avgData, avgData2) {
      console.log("==> teamCompare: loadAvgTable()");
      let tbodyRef = document.getElementById("averagesTable").querySelector('tbody');
      tbodyRef.innerHTML = ""; // Clear Table

      let endgameClimbPercentage = getDataValue(avgData[teamNum], "endgameClimbPercent");
      let endgameClimbPercentage2 = getDataValue(avgData2[teamNum2], "endgameClimbPercent");
      const tdPrefix = "<td style=\"background-color:transparent\">";
      let rowString = "";
      let rowString2 = "";
      rowString += tdPrefix + "<a href='teamLookup.php?teamNum=" + teamNum + "'>" + teamNum + "</a></td>";
      // Alias col
      rowString += tdPrefix + "" + "</td>";   // for now just empty string

      // points by game phase
      rowString += tdPrefix + getDataValue(avgData[teamNum], "totalPointsAvg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "totalPointsMax") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "autonPointsAvg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "autonPointsMax") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopPointsAvg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopPointsMax") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "endgamePointsAvg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "endgamePointsMax") + "</td>";

      // points by game piece
      rowString += tdPrefix + getDataValue(avgData[teamNum], "autonCoralPointsAvg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "autonCoralPointsMax") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "autonAlgaePointsAvg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "autonAlgaePointsMax") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopCoralPointsAvg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopCoralPointsMax") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopAlgaePointsAvg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopAlgaePointsMax") + "</td>";

      // total game pieces
      rowString += tdPrefix + getDataValue(avgData[teamNum], "totalCoralScoredAvg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "totalCoralScoredMax") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "totalAlgaeScoredAvg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "totalAlgaeScoredMax") + "</td>";

      // auton coral
      rowString += tdPrefix + getDataValue(avgData[teamNum], "autonCoralScoredAvg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "autonCoralScoredMax") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "autonCoralL4Avg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "autonCoralL4Max") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "autonCoralL3Avg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "autonCoralL3Max") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "autonCoralL2Avg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "autonCoralL2Max") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "autonCoralL1Avg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "autonCoralL1Max") + "</td>";

      // auton algae
      rowString += tdPrefix + getDataValue(avgData[teamNum], "autonAlgaeScoredAvg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "autonAlgaeScoredMax") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "autonAlgaeProcAvg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "autonAlgaeProcMax") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "autonAlgaeNetAvg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "autonAlgaeNetMax") + "</td>";

      // teleop coral
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopCoralPercent") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopCoralScoredAvg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopCoralScoredMax") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopCoralL4Avg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopCoralL4Max") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopCoralL3Avg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopCoralL3Max") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopCoralL2Avg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopCoralL2Max") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopCoralL1Avg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopCoralL1Max") + "</td>";

      // teleop algae
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopAlgaePercent") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopAlgaeScoredAvg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopAlgaeScoredMax") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopAlgaeProcAvg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopAlgaeProcMax") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopAlgaeNetAvg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopAlgaeNetMax") + "</td>";

      // defense 
      rowString += tdPrefix + getDataValue(avgData[teamNum], "defenseAvg") + "</td>";

      // endgame
      rowString += tdPrefix + getDataValue(endgameClimbPercentage, 0) + "</td>";
      rowString += tdPrefix + getDataValue(endgameClimbPercentage, 1) + "</td>";
      rowString += tdPrefix + getDataValue(endgameClimbPercentage, 2) + "</td>";
      rowString += tdPrefix + getDataValue(endgameClimbPercentage, 3) + "</td>";
      rowString += tdPrefix + getDataValue(endgameClimbPercentage, 4) + "</td>";

      rowString += tdPrefix + getDataValue(avgData[teamNum], "totaldied") + "</td>";

      tbodyRef.insertRow().innerHTML = rowString;

      // Do 2nd team averages
      rowString2 += tdPrefix + "<a href='teamLookup.php?teamNum=" + teamNum2 + "'>" + teamNum2 + "</a></td>";
      rowString2 += tdPrefix + "" + "</td>";   // alias - for now just empty string


      // points by game phase
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "totalPointsAvg") + "</td>";
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "totalPointsMax") + "</td>";
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "autonPointsAvg") + "</td>";
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "autonPointsMax") + "</td>";
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "teleopPointsAvg") + "</td>";
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "teleopPointsMax") + "</td>";
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "endgamePointsAvg") + "</td>";
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "endgamePointsMax") + "</td>";

      // points by game piece
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "autonCoralPointsAvg") + "</td>";
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "autonCoralPointsMax") + "</td>";
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "autonAlgaePointsAvg") + "</td>";
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "autonAlgaePointsMax") + "</td>";
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "teleopCoralPointsAvg") + "</td>";
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "teleopCoralPointsMax") + "</td>";
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "teleopAlgaePointsAvg") + "</td>";
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "teleopAlgaePointsMax") + "</td>";

      // total game pieces
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "totalCoralScoredAvg") + "</td>";
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "totalCoralScoredMax") + "</td>";
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "totalAlgaeScoredAvg") + "</td>";
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "totalAlgaeScoredMax") + "</td>";

      // auton coral
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "autonCoralScoredAvg") + "</td>";
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "autonCoralScoredMax") + "</td>";
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "autonCoralL4Avg") + "</td>";
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "autonCoralL4Max") + "</td>";
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "autonCoralL3Avg") + "</td>";
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "autonCoralL3Max") + "</td>";
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "autonCoralL2Avg") + "</td>";
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "autonCoralL2Max") + "</td>";
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "autonCoralL1Avg") + "</td>";
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "autonCoralL1Max") + "</td>";

      // auton algae
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "autonAlgaeScoredAvg") + "</td>";
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "autonAlgaeScoredMax") + "</td>";
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "autonAlgaeProcAvg") + "</td>";
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "autonAlgaeProcMax") + "</td>";
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "autonAlgaeNetAvg") + "</td>";
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "autonAlgaeNetMax") + "</td>";

      // teleop coral
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "teleopCoralPercent") + "</td>";
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "teleopCoralScoredAvg") + "</td>";
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "teleopCoralScoredMax") + "</td>";
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "teleopCoralL4Avg") + "</td>";
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "teleopCoralL4Max") + "</td>";
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "teleopCoralL3Avg") + "</td>";
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "teleopCoralL3Max") + "</td>";
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "teleopCoralL2Avg") + "</td>";
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "teleopCoralL2Max") + "</td>";
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "teleopCoralL1Avg") + "</td>";
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "teleopCoralL1Max") + "</td>";

      // teleop algae
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "teleopAlgaePercent") + "</td>";
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "teleopAlgaeScoredAvg") + "</td>";
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "teleopAlgaeScoredMax") + "</td>";
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "teleopAlgaeProcAvg") + "</td>";
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "teleopAlgaeProcMax") + "</td>";
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "teleopAlgaeNetAvg") + "</td>";
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "teleopAlgaeNetMax") + "</td>";

      // defense
      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "defenseAvg") + "</td>";

      // endgame
      rowString2 += tdPrefix + getDataValue(endgameClimbPercentage2, 0) + "</td>";
      rowString2 += tdPrefix + getDataValue(endgameClimbPercentage2, 1) + "</td>";
      rowString2 += tdPrefix + getDataValue(endgameClimbPercentage2, 2) + "</td>";
      rowString2 += tdPrefix + getDataValue(endgameClimbPercentage2, 3) + "</td>";
      rowString2 += tdPrefix + getDataValue(endgameClimbPercentage2, 4) + "</td>";

      rowString2 += tdPrefix + getDataValue(avgData2[teamNum2], "totaldied") + "</td>";

      tbodyRef.insertRow().innerHTML = rowString2;
    }

    function toYesNo(value) {
      switch (String(value)) {
        case "1": return "Yes";
        case "2": return "No";
        default: return "-";
      }
    }

    // Load the strategic data table for this team
    function loadStrategicData1(teamNum, stratData) {
      console.log("==> teamCompare: loadStrategicData1()");
      let stratTitle = teamNum + " - Strategic Data";
      let sLink = document.getElementById("strategicLink1").querySelector('a');
      sLink.text = stratTitle;

      let tbodyRef = document.getElementById("strategicDataTable1").querySelector('tbody');
      tbodyRef.innerHTML = "";     // clear table
      for (let i = 0; i < stratData.length; i++) {
        let stratItem = stratData[i];
        let driverability = stratItem["driverability"];
        switch (driverability) {
          case 1: driveVal = "Jerky"; break;
          case 2: driveVal = "Slow"; break;
          case 3: driveVal = "Average"; break;
          case 4: driveVal = "Quick"; break;
          case 5: driveVal = "-"; break;
          default: driveVal = ""; break;
        }

        let rowString = "";
        rowString += "<td>" + stratItem["matchnumber"] + "</td>";
        rowString += "<td>" + driveVal + "</td>";
        rowString += "<td>" + toYesNo(stratItem["against_tactic1"]) + "</td>";
        rowString += "<td>" + stratItem["against_comment"] + "</td>";

        rowString += "<td>" + toYesNo(stratItem["defense_tactic1"]) + "</td>";
        rowString += "<td>" + toYesNo(stratItem["defense_tactic2"]) + "</td>";
        rowString += "<td>" + stratItem["defense_comment"] + "</td>";

        rowString += "<td>" + toYesNo(stratItem["foul1"]) + "</td>";
        rowString += "<td>" + toYesNo(stratItem["autonFoul1"]) + "</td>";
        rowString += "<td>" + toYesNo(stratItem["autonFoul2"]) + "</td>";
        rowString += "<td>" + toYesNo(stratItem["teleopFoul1"]) + "</td>";
        rowString += "<td>" + toYesNo(stratItem["teleopFoul2"]) + "</td>";
        rowString += "<td>" + toYesNo(stratItem["teleopFoul3"]) + "</td>";
        rowString += "<td>" + toYesNo(stratItem["teleopFoul4"]) + "</td>";
        rowString += "<td>" + toYesNo(stratItem["endgameFoul1"]) + "</td>";

        rowString += "<td>" + toYesNo(stratItem["autonGetCoralFromFloor"]) + "</td>";
        rowString += "<td>" + toYesNo(stratItem["autonGetCoralFromStation"]) + "</td>";
        rowString += "<td>" + toYesNo(stratItem["autonGetAlgaeFromFloor"]) + "</td>";
        rowString += "<td>" + toYesNo(stratItem["autonGetAlgaeFromReef"]) + "</td>";
        rowString += "<td>" + toYesNo(stratItem["teleopFloorPickupAlgae"]) + "</td>";
        rowString += "<td>" + toYesNo(stratItem["teleopFloorPickupCoral"]) + "</td>";
        rowString += "<td>" + toYesNo(stratItem["teleopKnockOffAlgaeFromReef"]) + "</td>";
        rowString += "<td>" + toYesNo(stratItem["teleopAcquireAlgaeFromReef"]) + "</td>";

        rowString += "<td>" + stratItem["problem_comment"] + "</td>";
        rowString += "<td>" + stratItem["general_comment"] + "</td>";
        rowString += "<td>" + stratItem["scoutname"] + "</td>";
        tbodyRef.insertRow().innerHTML = rowString;
      }
      const matchColumn = 0;
      sortTableByMatch("strategicDataTable1", matchColumn);
    }

    function loadStrategicData2(teamNum, stratData) {
      console.log("==> teamCompare: loadStrategicData()");
      let stratTitle = teamNum + " - Strategic Data";
      let sLink = document.getElementById("strategicLink2").querySelector('a');
      sLink.text = stratTitle;

      let tbodyRef = document.getElementById("strategicDataTable2").querySelector('tbody');
      tbodyRef.innerHTML = "";     // clear table
      for (let i = 0; i < stratData.length; i++) {
        let stratItem = stratData[i];

        let driverability = stratItem["driverability"];
        switch (driverability) {
          case 1: driveVal = "Jerky"; break;
          case 2: driveVal = "Slow"; break;
          case 3: driveVal = "Average"; break;
          case 4: driveVal = "Quick"; break;
          case 5: driveVal = "-"; break;
          default: driveVal = ""; break;
        }

        let rowString = "";
        rowString += "<td>" + stratItem["matchnumber"] + "</td>";
        rowString += "<td>" + driveVal + "</td>";
        rowString += "<td>" + toYesNo(stratItem["against_tactic1"]) + "</td>";
        rowString += "<td>" + stratItem["against_comment"] + "</td>";

        rowString += "<td>" + toYesNo(stratItem["defense_tactic1"]) + "</td>";
        rowString += "<td>" + toYesNo(stratItem["defense_tactic2"]) + "</td>";
        rowString += "<td>" + stratItem["defense_comment"] + "</td>";

        rowString += "<td>" + toYesNo(stratItem["foul1"]) + "</td>";
        rowString += "<td>" + toYesNo(stratItem["autonFoul1"]) + "</td>";
        rowString += "<td>" + toYesNo(stratItem["autonFoul2"]) + "</td>";
        rowString += "<td>" + toYesNo(stratItem["teleopFoul1"]) + "</td>";
        rowString += "<td>" + toYesNo(stratItem["teleopFoul2"]) + "</td>";
        rowString += "<td>" + toYesNo(stratItem["teleopFoul3"]) + "</td>";
        rowString += "<td>" + toYesNo(stratItem["teleopFoul4"]) + "</td>";
        rowString += "<td>" + toYesNo(stratItem["endgameFoul1"]) + "</td>";

        rowString += "<td>" + toYesNo(stratItem["autonGetCoralFromFloor"]) + "</td>";
        rowString += "<td>" + toYesNo(stratItem["autonGetCoralFromStation"]) + "</td>";
        rowString += "<td>" + toYesNo(stratItem["autonGetAlgaeFromFloor"]) + "</td>";
        rowString += "<td>" + toYesNo(stratItem["autonGetAlgaeFromReef"]) + "</td>";
        rowString += "<td>" + toYesNo(stratItem["teleopFloorPickupAlgae"]) + "</td>";
        rowString += "<td>" + toYesNo(stratItem["teleopFloorPickupCoral"]) + "</td>";
        rowString += "<td>" + toYesNo(stratItem["teleopKnockOffAlgaeFromReef"]) + "</td>";
        rowString += "<td>" + toYesNo(stratItem["teleopAcquireAlgaeFromReef"]) + "</td>";

        rowString += "<td>" + stratItem["problem_comment"] + "</td>";
        rowString += "<td>" + stratItem["general_comment"] + "</td>";
        rowString += "<td>" + stratItem["scoutname"] + "</td>";
        tbodyRef.insertRow().innerHTML = rowString;
      }
      const matchColumn = 0;
      sortTableByMatch("strategicDataTable2", matchColumn);
    }

    // This is the main function that runs when we want to load teams.
    function buildTeamComparePage(teamNum1, teamNum2) {
      let mdp1 = null;
      let mdp2 = null;
      let teamInfo1 = null;
      let teamInfo2 = null;
      console.log("==> teamCompare: buildTeamComparePage()");

      // Get team1 name from TBA
      $.get("api/tbaAPI.php", {
        getTeamInfo: teamNum1
      }).done(function (teamInfo1) {
        //          console.log("=> getTeamInfo: " + teamInfo1);
        let teamStr1 = teamNum1;
        if (teamInfo1 === null) {
          return alert("Can't load teamName from TBA; check if TBA Key was set in db_config");
        }
        let jTeamInfo = JSON.parse(teamInfo1)["response"];
        teamStr1 += " - " + jTeamInfo["nickname"] + "       ";;
        console.log("==> teamCompare: team1: " + teamStr1);
        document.getElementById("team1Title").innerHTML = teamStr1;

        // Get team2 name from TBA
        $.get("api/tbaAPI.php", {
          getTeamInfo: teamNum2
        }).done(function (teamInfo2) {
          //            console.log("=> getTeamInfo: " + teamInfo2);
          let teamStr2 = teamNum2;
          if (teamInfo2 === null) {
            return alert("Can't load teamName from TBA; check if TBA Key was set in db_config");
          }
          let kTeamInfo = JSON.parse(teamInfo2)["response"];
          teamStr2 += " - " + kTeamInfo["nickname"];
          console.log("==> teamCompare: team2: " + teamStr2);
          document.getElementById("team2Title").innerHTML = teamStr2;
        });

        // Get team1 match data
        $.get("api/dbReadAPI.php", {
          getTeamMatchData: teamNum1
        }).done(function (teamMatches) {
          console.log("=> getTeamMatchData");
          mdp1 = new matchDataProcessor(JSON.parse(teamMatches));
          console.log("done with mdp 1");
          loadMatchData(teamNum1, teamNum2, mdp1, mdp2);
        });
        // Get team2 match data
        $.get("api/dbReadAPI.php", {
          getTeamMatchData: teamNum2
        }).done(function (teamMatches2) {
          console.log("=> getTeamMatchData");
          mdp2 = new matchDataProcessor(JSON.parse(teamMatches2));
          console.log("done with mdp2");
          loadMatchData(teamNum1, teamNum2, mdp1, mdp2);
        });

        // Do team1 Strategic Data Table.
        $.get("api/dbReadAPI.php", {
          getTeamStrategicData: teamNum1
        }).done(function (strategicData) {
          console.log("=> getTeamStrategicData");
          loadStrategicData1(teamNum1, JSON.parse(strategicData));
        });

        // Do team2 Strategic Data Table.
        $.get("api/dbReadAPI.php", {
          getTeamStrategicData: teamNum2
        }).done(function (strategicData2) {
          console.log("=> getTeamStrategicData2");
          loadStrategicData2(teamNum2, JSON.parse(strategicData2));
        });
      });
    }

    /////////////////////////////////////////////////////////////////////////////
    //
    // Process the generated html
    //    When the team lookup page load button is pressed
    //      In parallel, start retrieving each of these for the selected team:
    //        - Team info (name) from TBA
    //
    document.addEventListener("DOMContentLoaded", function () {

      // Pressing enter in team number field loads the page
      let input = document.getElementById("enterTeamNumber1");
      let inputSecond = document.getElementById("enterTeamNumber1");
      let inputThird = document.getElementById("enterTeamNumber1");
      let input2 = document.getElementById("enterTeamNumber2");
      let input2Second = document.getElementById("enterTeamNumber2");
      let input2Third = document.getElementById("enterTeamNumber2");
      input.addEventListener("keypress", function (event) {
        if (event.key === "Enter") {
          event.preventDefault();
          document.getElementById("loadTeamButton").click();
        }
      });
      inputSecond.addEventListener("keypress", function (event2) {
        if (event2.key === "Enter") {
          event2.preventDefault();
          document.getElementById("loadTeamButton").click();
        }
      });
      inputThird.addEventListener("keypress", function (event3) {
        if (event3.key === "Enter") {
          event3.preventDefault();
          document.getElementById("loadTeamButton").click();
        }
      });

      // Load team data for the number entered
      document.getElementById("loadTeamButton").addEventListener('click', function () {
        let teamNum1 = document.getElementById("enterTeamNumber1").value.trim();
        let teamNum2 = document.getElementById("enterTeamNumber2").value.trim();
        if (validateTeamNumber(teamNum1, null) > 0 && validateTeamNumber(teamNum2, null) > 0) {
          buildTeamComparePage(teamNum1, teamNum2);
        }
      });
    });


  </script>

  <script src="./scripts/compareMatchNumbers.js"></script>
  <script src="./scripts/compareTeamNumbers.js"></script>
  <script src="./scripts/sortFrcTables.js"></script>
  <script src="./scripts/matchDataProcessor.js"></script>
  <script src="./scripts/validateTeamNumber.js"></script>

  <script src="./external/charts/chart.umd.js"></script>
