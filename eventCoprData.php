<?php
$title = 'Event COPRs';
require 'header.php';
?>

<div class="container row-offcanvas row-offcanvas-left">
  <div id="content" class="column card-lg-12 col-sm-12 col-xs-12">

    <div class="row pt-3 pb-3 mb-3">
      <h2 id="COPRHeader" class="col-4"><?php echo $title; ?>: ???</h2>

      <div class="col-2">
        <button id="loadEvent" class="btn btn-primary" type="button">Reload COPRs</button>
      </div>
    </div>

    <div id="freeze-table" class="freeze-table">
      <table id="coprTable" class="table table-striped table-hover">
        <thead>
          <tr id="tableKeys">
          </tr>
        </thead>
        <tbody id="tableData">
        </tbody>
      </table>
    </div>
  </div>
</div>

<style>
  th:first-child,
  td:first-child,
  tr {
    position: sticky;
    left: 0px;
    z-index: 1;
    background: rgba(255, 255, 255, 1);
  }
</style>

<?php include 'footer.php'; ?>

<script>
  var frozenTable = null;

  function buildCOPRDataTable(dataObj, keys) {
    $("#tableData").html("");
    for (let team in dataObj) {
      var row = '<tr>';
      row += '<td>' + team + '</td>';
      for (let j = 0; j < keys.length; j++) {
        row += '<td>' + dataObj[team][keys[j]] + '</td>';
      }
      row += '</tr>';
      $("#tableData").append(row);
    }
  }

  function keysToTable(keys) {
    var header = '<th scope="col">Team</th>';
    for (let i = 0; i < keys.length; i++) {
      header += '<th scope="col">' + keys[i] + '</th>'
    }
    $("#tableKeys").html(header);
  }

  function setHeader(ec) {
    $("#COPRHeader").html("Event COPRs: " + ec);
  }

  function processData(data) {
    var dataObj = JSON.parse(data);
    var data = dataObj["data"];
    var keys = dataObj["keys"];
    var ec = dataObj["eventCode"];

    setHeader(ec);
    keysToTable(keys);
    buildCOPRDataTable(data, keys);
  }

  function requestAPI() {
    //output: gets the COPR data from TBA
    $.get("tbaAPI.php", {
      getCOPRs: 1
    }).done(function (data) {
      console.log("==> requestAPI:\n" + data);
      processData(data);
      setTimeout(function () {
        sorttable.makeSortable(document.getElementById("coprTable"));
        frozenTable = $('#freeze-table').freezeTable({
          'freezeHead': true,
          'freezeColumn': true,
          'freezeColumnHead': true,
          'scrollBar': true,
          'fixedNavbar': '.navbar',
          'scrollable': true,
          'fastMode': true,
          // 'container': '#navbar',
          'columnNum': 1,
          'columnKeep': true,
          'columnBorderWidth': 2,
          'backgroundColor': 'blue',
          'frozenColVerticalOffset': 0
        });
      }, 500);
    });
  }

  //
  // Process the generated html
  //
  $(document).ready(function () {
    requestAPI();

    $("#loadEvent").click(function () {
      requestAPI();
    });

    $("#coprTable").click(function () {
      if (frozenTable) {
        frozenTable.update();
      }
    });

  });
</script>
