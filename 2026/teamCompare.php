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
            <h5 id="teamTitle" class="card-title">Team # </h5>

            <!-- Auton collapsible graph -->
            <div class="card mb-3" style="background-color:#D5E6DE">
              <div class="card-header">
                <h5 class="text-center">
                  <a href="#collapseAutonCoralGraph" data-bs-toggle="collapse" aria-expanded="false">Auton Scoring</a>
                </h5>
              </div>
              <div id="collapseAutonCoralGraph" class="card-body collapse">
                <canvas id="autoChart" width="400" height="360"></canvas>
              </div>
            </div>
      </div>

    </div>
  </div>
</div>

<?php include 'inc/footer.php'; ?>

<!-- Javascript page handlers -->


<script>

  let autoChart;
  let teleopChart;
  let endgameChart;

  // Round data to no more than two decimal digits
  function roundTwoPlaces(val) {
    return Math.round((val + Number.EPSILON) * 100) / 100;
  }

  ///// AUTON GRAPH STARTS HERE /////

  function loadAutonGraph(matchData) {
    console.log("==> teamCompare: loadAutonGraph()");

    // Declare variables
    let matchList = []; // List of matches to use as x labels
    let datasets = []; // Each entry is a dict with a label and data attribute
    let autonLeaveTips = []; // holds custom tooltips for auton leave start line data      
    let autonAlgaeProcTips = []; // holds custom tooltips for auton algae processor
    let autonAlgaeNetTips = []; // holds custom tooltips for auton algae net
    let autonCoralL1Tips = []; // holds custom tooltips for auton coral L1
    let autonCoralL2Tips = []; // holds custom tooltips for auton coral L2
    let autonCoralL3Tips = []; // holds custom tooltips for auton coral L3
    let autonCoralL4Tips = []; // holds custom tooltips for auton coral 4      

    datasets.push({ label: "Leave", data: [], backgroundColor: '#F7CF58' });      // Yellow
    datasets.push({ label: "Processor", data: [], backgroundColor: '#B4E7D6' });  // Teal - algae
    datasets.push({ label: "Net", data: [], backgroundColor: '#4C9F7C' });        // Darker Teal - algae
    datasets.push({ label: "L1", data: [], backgroundColor: '#D98AB3' });         // Light pink - coral branch
    datasets.push({ label: "L2", data: [], backgroundColor: '#CE649B' });         // Medium light pink - coral branch
    datasets.push({ label: "L3", data: [], backgroundColor: '#C54282' });         // Medium dark pink - coral branch
    datasets.push({ label: "L4", data: [], backgroundColor: '#9D3468' });         // Dark pink - coral branch

    // Go thru each matchData QR code string and build up a table of the data, so we can
    // later sort it so the matches are listed in the right order. 
    let mydata = [];
    for (let i = 0; i < matchData.length; i++) {
      let matchItem = matchData[i];
      let matchnum = matchItem["matchnumber"];
      let autonLeave = matchItem["autonLeave"];
      let autonAlgaeProcessor = matchItem["autonAlgaeProcessor"];
      let autonAlgaeNet = matchItem["autonAlgaeNet"];
      let autonCoralOne = matchItem["autonCoralL1"];
      let autonCoralTwo = matchItem["autonCoralL2"];
      let autonCoralThree = matchItem["autonCoralL3"];
      let autonCoralFour = matchItem["autonCoralL4"];
      mydata.push({
        matchnum: matchnum,
        leave: autonLeave,
        processor: autonAlgaeProcessor,
        net: autonAlgaeNet,
        one: autonCoralOne,
        two: autonCoralTwo,
        three: autonCoralThree,
        four: autonCoralFour
      });
    }

    mydata.sort(function (rowA, rowB) {
      return (compareMatchNumbers(rowA["matchnum"], rowB["matchnum"]));
    });

    // Build data sets; go thru each mydata row and populate the graph datasets.
    for (let i = 0; i < mydata.length; i++) {
      let matchnum = mydata[i]["matchnum"];
      matchList.push(matchnum);
      let tipStr = "";

      function storeAndGetTip(value, tipPrefix, dataset, yesNo) {
        dataset.push(value);
        if (yesNo) {
          value = (value) ? "Yes" : "No";
        }
        return tipPrefix + value;
      }

      autonLeaveTips.push({ xlabel: matchnum, tip: storeAndGetTip(mydata[i]["leave"], "Leave=", datasets[0]["data"], true) });
      autonAlgaeProcTips.push({ xlabel: matchnum, tip: storeAndGetTip(mydata[i]["processor"], "Processor=", datasets[1]["data"], false) });
      autonAlgaeNetTips.push({ xlabel: matchnum, tip: storeAndGetTip(mydata[i]["net"], "Net=", datasets[2]["data"], false) });
      autonCoralL1Tips.push({ xlabel: matchnum, tip: storeAndGetTip(mydata[i]["one"], "L1=", datasets[3]["data"], false) });
      autonCoralL2Tips.push({ xlabel: matchnum, tip: storeAndGetTip(mydata[i]["two"], "L2=", datasets[4]["data"], false) });
      autonCoralL3Tips.push({ xlabel: matchnum, tip: storeAndGetTip(mydata[i]["three"], "L3=", datasets[5]["data"], false) });
      autonCoralL4Tips.push({ xlabel: matchnum, tip: storeAndGetTip(mydata[i]["four"], "L4=", datasets[6]["data"], false) });
    }

    // Define the graph as a line chart:
    if (autoChart !== undefined) {
      autoChart.destroy();
    }

    // Create the Auton graph
    const ctx = document.getElementById('autoChart').getContext('2d');
    autoChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: matchList,
        datasets: datasets
      },
      options: {
        scales: {
          x: { stacked: true },
          y: { stacked: true, min: 0, ticks: { precision: 0 }, max: 5 } // Set Y axis maximum value - 4 coral + algae in  auto plus leave
        },
        plugins: {
          tooltip: {
            callbacks: {  // Special tooltip handling
              label: function (tooltipItem, ddata) {

                function getTip(matchno, tipList) {
                  for (let i = 0; i < tipList.length; i++)
                    if (tipList[i].xlabel === matchno)
                      return tipList[i].tip;
                }

                let matchnum = tooltipItem.label;
                let tipStr = datasets[tooltipItem.datasetIndex].label;
                switch (tooltipItem.datasetIndex) {
                  case 0: return getTip(matchnum, autonLeaveTips);
                  case 1: return getTip(matchnum, autonAlgaeProcTips);
                  case 2: return getTip(matchnum, autonAlgaeNetTips);
                  case 3: return getTip(matchnum, autonCoralL1Tips);
                  case 4: return getTip(matchnum, autonCoralL2Tips);
                  case 5: return getTip(matchnum, autonCoralL3Tips);
                  case 6: return getTip(matchnum, autonCoralL4Tips);
                  default: return "missing tip string!"
                }
                return tipStr;
              }
            }
          }
        }
      }
    });
  }

  ///// AUTON GRAPH ENDS HERE /////


  // MAIN PAGE PROCESSORS HERE



  // Check if our URL directs to a specific team
  function checkURLForTeamSpec() {
    console.log("=> teamCompare: checkURLForTeamSpec()");
    let sp = new URLSearchParams(window.location.search);
    if (sp.has('teamNum')) {
      return sp.get('teamNum');
    }
    return null;
  }

  function clearTeamComparePage() {
    // Clear existing data
    document.getElementById("teamTitle").innerText = "";
    document.getElementById("autonTable").querySelector('tbody').innerHTML = "";
  }

  // This is the main function that runs when we want to load a team 
  function buildTeamComparePage(teamNum) {
    console.log("==> teamCompare: buildTeamComparePage()");
    clearTeamComparePage();

    // Get team name from TBA
    $.get("api/tbaAPI.php", {
      getTeamInfo: teamNum
    }).done(function (teamInfo) {
      console.log("=> getTeamInfo:\n" + teamInfo);
      let teamName = "";
      if (teamInfo === null) {
        return alert("Can't load teamName from TBA; check if TBA Key was set in db_config");
      }
      let jTeamInfo = JSON.parse(teamInfo)["response"];
      teamName += " " + jTeamInfo["nickname"];
      console.log("==> teamCompare: for " + teamNum + teamName);
      document.getElementById("teamTitle").innerHTML = teamNum + teamName;
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

    // Check URL for source team to load
    let initTeamNumber = checkURLForTeamSpec();
    if (validateTeamNumber(initTeamNumber, null) > 0) {
      document.getElementById("enterTeamNumber1").value = initTeamNumber;
      buildTeamCmparePage(initTeamNumber);
    }

    // Pressing enter in team number field loads the page
    let input = document.getElementById("enterTeamNumber1");
    input.addEventListener("keypress", function (event) {
      if (event.key === "Enter") {
        event.preventDefault();
        document.getElementById("loadTeamButton").click();
      }
    });

    // Load team data for the number entered
    document.getElementById("loadTeamButton").addEventListener('click', function () {
      let teamNum = document.getElementById("enterTeamNumber1").value.trim();
      if (validateTeamNumber(teamNum, null) > 0) {
        buildTeamComparePage(teamNum);
      }
    });
  });
</script>

<script src="./scripts/compareMatchNumbers.js"></script>
<script src="./scripts/compareTeamNumbers.js"></script>
<script src="./scripts/sortFrcTables.js"></script>
<script src="./scripts/matchDataProcessor.js"></script>
<script src="./scripts/validateTeamNumber.js"></script>
