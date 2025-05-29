<?php
$title = 'Event COPRs';
require 'header.php';
?>

<div class="container row-offcanvas row-offcanvas-left">
  <div class="column card-lg-12 col-sm-12 col-xs-12" id="content">

    <div class="row pt-3 pb-3 mb-3">
      <h2 id="COPRHeader"><?php echo $title; ?>: ???</h2>
    </div>

    <div class="input-group mb-3">
        <input id="eventCode" type="text" class="form-control" placeholder="FRC event code" aria-label="eventCode">
        <button id="loadEvent" type="button" class="btn btn-primary">Load Event</button>
    </div>

    <div class="table-responsive">
      <div id="freezeTableDiv">
        <table id="dataTable" class="table table-striped table-hover">
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

  function dataToTable(dataObj, keys) {
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
    dataToTable(data, keys);
    // sorttable.makeSortable($("#dataTable"));
    // sorttable.makeSortable(document.getElementById("dataTable"));
  }

  function requestAPI() {
    //output: gets the COPR data from TBA
    $.get("tbaAPI.php", {
      getCOPRs: 1
    }).done(function (data) {
      processData(data);
        sorttable.makeSortable(document.getElementById("dataTable"));
        frozenTable = $('#freezeTableDiv').freezeTable({
          'backgroundColor': "white",
          'columnNum': 1,
          'frozenColVerticalOffset': 0
        });
    });
  }

  //
  // Process the generated html
  //
  $(document).ready(function () {
    requestAPI();

    $("#loadEvent").click(function () {
      $.get("tbaAPI.php", {
        getCOPRs: 1,
        eventcode: $("#eventCode").val()
      }).done(function (data) {
        processData(data);
        setTimeout(function () {
          sorttable.makeSortable(document.getElementById("dataTable"));
          frozenTable = $('#freezeTableDiv').freezeTable({
            'backgroundColor': "white",
            'columnNum': 1,
            'frozenColVerticalOffset': 0
          });
        }, 200);
      });
    });

    $("#dataTable").click(function () {
      if (frozenTable) {
        frozenTable.update();
      }
    });

  });
</script>
