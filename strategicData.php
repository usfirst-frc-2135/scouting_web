<?php
$title = 'Strategic Data';
require 'header.php';
?>

<div class="container row-offcanvas row-offcanvas-left">
  <div class="column card-lg-12 col-sm-12 col-xs-12" id="content">

    <div class="row pt-3 pb-3 mb-3">
      <h2><?php echo $title; ?></h2>
    </div>

    <div id="freezeTableDiv">
      <style type="text/css" media="screen">
        table tr {
          border: 1px solid black;
        }

        table td,
        table th {
          border-right: 1px solid black;
        }
      </style>
      <table id="rawDataTable" class="table table-striped table-hover sortable">
        <colgroup>
          <col span="2" style="background-color:transparent">
          <col span="1" style="background-color:#cfe2ff">
          <col span="1" style="background-color:transparent">
          <col span="1" style="background-color:#cfe2ff">
          <col span="1" style="background-color:transparent">
          <col span="1" style="background-color:#cfe2ff">
          <col span="1" style="background-color:#transparent">
          <col span="1" style="background-color:#cfe2ff">
          <col span="1" style="background-color:transparent">
          <col span="1" style="background-color:#cfe2ff">
          <col span="1" style="background-color:#transparent">
          <col span="1" style="background-color:#cfe2ff">
          <col span="1" style="background-color:#transparent">
          <col span="1" style="background-color:#cfe2ff">
          <col span="1" style="background-color:#transparent">
          <col span="1" style="background-color:#cfe2ff">
          <col span="1" style="background-color:#transparent">
          <col span="1" style="background-color:#cfe2ff">
          <col span="1" style="background-color:#transparent">
          <col span="1" style="background-color:#cfe2ff">
          <col span="1" style="background-color:#transparent">
          <col span="1" style="background-color:#cfe2ff">
          <col span="1" style="background-color:#transparent">
          <col span="1" style="background-color:#cfe2ff">
          <col span="1" style="background-color:#transparent">
        </colgroup>
        <thead>
          <tr>
            <th colspan="1"> </th>
            <th colspan="1"> </th>
            <th colspan="24" class="text-center">Strategic Scouting Data</th>
          </tr>
          <tr>
            <th colspan="1"> </th>
            <th colspan="1"> </th>
            <th colspan="24" class="text-center">Table</th>
          </tr>
          <tr>
            <th colspan="1"> </th>
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
            <th scope="col" class="text-center">Team</th>
            <th scope="col" class="text-center">Match</th>
            <th scope="col" class="text-center">Drive Skill</th>
            <th scope="col" class="text-center">Block</th>
            <th scope="col" class="text-center">Note</th>
            <th scope="col" class="text-center">Block Path</th>
            <th scope="col" class="text-center">Block Station</th>
            <th scope="col" class="text-center">Note</th>
            <th scope="col" class="text-center">Pin</th>
            <th scope="col" class="text-center">Auton Barge Contact</th>
            <th scope="col" class="text-center">Auton Cage Contact</th>
            <th scope="col" class="text-center">Anchor Contact</th>
            <th scope="col" class="text-center">Barge Contact</th>
            <th scope="col" class="text-center">Reef Contact</th>
            <th scope="col" class="text-center">Cage Contact</th>
            <th scope="col" class="text-center">Contact Climbing Robot</th>
            <th scope="col" class="text-center">Get Floor Coral</th>
            <th scope="col" class="text-center">Get Stn Coral</th>
            <th scope="col" class="text-center">Get Floor Algae</th>
            <th scope="col" class="text-center">Get Reef Algae</th>
            <th scope="col" class="text-center">Get Floor Coral</th>
            <th scope="col" class="text-center">Get Floor Algae</th>
            <th scope="col" class="text-center">Knock Algae</th>
            <th scope="col" class="text-center">Acquire Reef Algae</th>
            <th scope="col" class="text-center">Problem Note</th>
            <th scope="col" class="text-center">General Note</th>
            <th scope="col" class="text-center">Scout</th>
          </tr>
        </thead>
        <tbody id="tableData">
        </tbody>
      </table>

    </div>
  </div>
</div>

<?php include 'footer.php'; ?>

<script>
  var frozenTable = null;

  function sortTable() {
    // Assumes the entries are team numbers or match numbers. Note a team number could have end in 
    // a "B", "C", "D", or "E".

    var table = document.getElementById("rawDataTable");
    var rows = Array.prototype.slice.call(table.querySelectorAll("tbody> tr"));

    // Sort the rows based on column 1 team number value, then col2 match number
    rows.sort(function (rowA, rowB) {
      var cellA = rowA.cells[0].textContent.trim(); // rowA team num
      var cellB = rowB.cells[0].textContent.trim(); // rowB team num
      var matchA = rowA.cells[1].textContent.trim(); // rowA match num              
      var matchB = rowB.cells[1].textContent.trim(); // rowB match num                         
      return (sortRows(cellA, cellB, matchA, matchB));
    });

    // Update the table body with the sorted rows 
    rows.forEach(function (row) {
      table.querySelector("tbody").appendChild(row);
    });
  }

  function sortOnMatch(matchA, matchB) {
    matchA = matchA.toUpperCase();  // make upper case
    matchB = matchB.toUpperCase();  // make upper case
    Aprefix = "qm";  // assume qm if there is no prefix
    Bprefix = "qm";
    Amnum = matchA;
    Bmnum = matchB;
    if (matchA.charAt(0) == "Q") {        // QM
      Amnum = matchA.substr(2, matchA.length);
      Aprefix = "qm";
    }
    else if (matchA.charAt(0) == "P") {    // P
      Amnum = matchA.substr(1, matchA.length);
      Aprefix = "p";
    }
    else if (matchA.charAt(0) == "S") {    // SF
      Amnum = matchA.substr(2, matchA.length);
      Aprefix = "sf";
    }
    if (matchB.charAt(0) == "Q") {
      Bmnum = matchB.substr(2, matchB.length);
      Bprefix = "qm";
    }
    else if (matchB.charAt(0) == "P") {
      Bmnum = matchB.substr(1, matchB.length);
      Bprefix = "p";
    }
    else if (matchB.charAt(0) == "S") {
      Bmnum = matchB.substr(2, matchB.length);
      Bprefix = "sf";
    }
    if (Aprefix == Bprefix)
      return (Amnum - Bmnum);
    if (Aprefix == "p")
      return (0);
    if (Bprefix == "p")
      return (1);
    if (Aprefix == "qm")
      return (0);
    return 1;
  }

  // Returns 0 if rowA is before rowB; else returns 1. Assumes the row has a
  // team number and may have a B, C, D, or E letter at the end. Note the letter may be lower case.
  // If team numbers are the same, then sort by match num (2nd col).
  function sortRows(cellA, cellB, matchA, matchB) {

    cellA = cellA.toUpperCase();  // make letter upper case
    cellB = cellB.toUpperCase();
    cellA = cellA.replace(/[^0-9a-zA-Z]/g, '');  // remove any non-alphanumeric chars
    cellB = cellB.replace(/[^0-9a-zA-Z]/g, '');  // remove any non-alphanumeric chars
    var cellA_num = cellA;
    var cellB_num = cellB;
    var A_let = 0;
    var B_let = 0;

    if (cellA.charAt(cellA.length - 1) == "B") {
      cellA_num = cellA.substr(0, cellA.length - 1);
      A_let = 1;
    }
    else if (cellA.charAt(cellA.length - 1) == "C") {
      cellA_num = cellA.substr(0, cellA.length - 1);
      A_let = 2;
    }
    else if (cellA.charAt(cellA.length - 1) == "D") {
      cellA_num = cellA.substr(0, cellA.length - 1);
      A_let = 3;
    }
    else if (cellA.charAt(cellA.length - 1) == "E") {
      cellA_num = cellA.substr(0, cellA.length - 1);
      A_let = 4;
    }
    if (cellB.charAt(cellB.length - 1) == "B") {
      cellB_num = cellB.substr(0, cellB.length - 1);
      B_let = 1;
    }
    else if (cellB.charAt(cellB.length - 1) == "C") {
      cellB_num = cellB.substr(0, cellB.length - 1);
      B_let = 2;
    }
    else if (cellB.charAt(cellB.length - 1) == "D") {
      cellB_num = cellB.substr(0, cellB.length - 1);
      B_let = 3;
    }
    else if (cellB.charAt(cellB.length - 1) == "E") {
      cellB_num = cellB.substr(0, cellB.length - 1);
      B_let = 4;
    }

    // Now determine which cell goes first.
    if (A_let == 0 && B_let == 0)   // no letters, so just compare team numbers.
    {
      if (cellA == cellB)  // same team and letters
      {
        return (sortOnMatch(matchA, matchB));
      }
      return (cellA - cellB);
    }
    if (cellA_num == cellB_num)   // same team number, with letters on at least one
    {
      if (A_let == 0)  // no letter in cellA, so it will be before cellB
        return (0);
      if (B_let == 0)  // no letter in cellB, so it will be before cellA
        return (1);
      if (A_let == B_let)  // letters are the same 
        return (sortOnMatch(matchA, matchB));
      if (A_let > B_let)  // cellA letter is higher than B
        return (1);
      return (0);
    }
    // not same team number, with letters, so just compare team number part
    return (cellA_num - cellB_num);
  }


  // Converts a given "1" to yes, "0" to no, anything else to empty string.
  function convertToYesNo(value) {
    var convertedVal = "";
    if (value == "1")
      convertedVal = "yes";
    else if (value == "0")
      convertedVal = "-";
    else if (value == "2")
      convertedVal = "no";
    else if (value == "3")
      convertedVal = "-";
    return convertedVal;
  }

  function dataToTable(dataObj, pitData) {
    for (let i = 0; i < dataObj.length; i++) {
      var driverability = dataObj[i]["driverability"];
      var driveVal = "";
      if (driverability == "1")
        driveVal = "Jerky";
      else if (driverability == "2")
        driveVal = "Slow";
      else if (driverability == "3")
        driveVal = "Average";
      else if (driverability == "4")
        driveVal = "Quick";
      else if (driverability == "5")
        driveVal = "-";

      var teamnum = dataObj[i]["teamnumber"];

      var rowString = "<tr><td align=\"center\">" + teamnum + "</td>" +
        "<td align=\"center\">" + dataObj[i]["matchnumber"] + "</td>" +
        "<td align=\"center\">" + driveVal + "</td>" +
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["against_tactic1"]) + "</td>" +
        "<td align=\"center\">" + dataObj[i]["against_comment"] + "</td>" +
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["defense_tactic1"]) + "</td>" +
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["defense_tactic2"]) + "</td>" +
        "<td align=\"center\">" + dataObj[i]["defense_comment"] + "</td>" +
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["foul1"]) + "</td>" +
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["autonFoul1"]) + "</td>" +
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["autonFoul2"]) + "</td>" +
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["teleopFoul1"]) + "</td>" +
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["teleopFoul2"]) + "</td>" +
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["teleopFoul3"]) + "</td>" +
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["teleopFoul4"]) + "</td>" +
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["endgameFoul1"]) + "</td>" +
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["autonGetCoralFromFloor"]) + "</td>" +
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["autonGetCoralFromStation"]) + "</td>" +
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["autonGetAlgaeFromFloor"]) + "</td>" +
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["autonGetAlgaeFromReef"]) + "</td>" +
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["teleopFloorPickupAlgae"]) + "</td>" +
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["teleopFloorPickupCoral"]) + "</td>" +
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["teleopKnockOffAlgaeFromReef"]) + "</td>" +
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["teleopAcquireAlgaeFromReef"]) + "</td>" +
        "<td align=\"center\">" + dataObj[i]["problem_comment"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["general_comment"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["scoutname"] + "</td>" +
        "</td>";
      $("#tableData").append(rowString);
      console.log(convertToYesNo(dataObj[i]["autonGetCoralFromFloor"]));
    }
  }

  function requestAPI() {
    // get Strategic Scouting Data
    $.get("readAPI.php", {
      getAllStrategicData: 1
    }).done(function (data) {
      var dataObj = JSON.parse(data);
      dataToTable(dataObj);
      setTimeout(function () {
        sorttable.makeSortable(document.getElementById("rawDataTable"));
        frozenTable = $('#freezeTableDiv').freezeTable({
          'backgroundColor': "white",
          'columnNum': 2,
          'frozenColVerticalOffset': 0
        });
      }, 1);
      sortTable();
    });
  }

  //
  // Process the generated html
  //
  $(document).ready(function () {
    requestAPI();

    // Submit the strategic form data
    $("#rawDataTable").click(function () {
      if (frozenTable) {
        frozenTable.update();
      }
    });
  });
</script>
