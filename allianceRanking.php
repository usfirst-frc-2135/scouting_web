<title>Alliance Rank</title>
<?php include("header.php") ?>
<div class="container row-offcanvas row-offcanvas-left">
  <div class="well column  col-lg-12  col-sm-12 col-xs-12" id="content">
    <div class="row pt-3 pb-3 mb-3">
      <div class="card col-md-12">
        <div class="card-body">
          <h2 id="allianceRankName">Alliance Rank</h2>
          <a href="./rawRankingData.php">Raw Ranking Data</a>
        </div>
      </div>
    </div>
    <div class="card mb-3">
      <div class="card-body">
        <h5 id="teamTitle" class="card-title">Match ????</h5>
        <div class="row g-3 justify-content-md-center">
          <div class="input-group mb-3">
            <select class="form-select" id="writeCompLevel" aria-label="Comp Level Select">
              <option value="QM">QM</option>
              <option value="QF">QF</option>
              <option value="SF">SF</option>
              <option value="F">F</option>
            </select>
            <input id="writeMatchNumber" type="text" class="form-control" placeholder="Match Number" aria-label="writeMatchNumber">
            <button id="loadMatch" type="button" class="btn btn-primary">Show Match</button>
          </div>
        </div>
      </div>
      <div class="row pt-3 pb-3 mb-3 g-3">
        <div class="col-lg-6 col-sm-6 col-xs-6 gx-3">
          <div class="card mb-3">
            <div class="card-header">
              Team List
            </div>
            <div class="card-body overflow-auto">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col"></th>
                    <th scope="col">Color</th>
                    <th scope="col">Team</th>
                  </tr>
                </thead>
                <tbody id="rawAllianceRows">
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-xs-6 gx-3">
          <div class="card mb-3">
            <div class="card-header">
              Drag to Rank
            </div>
            <div class="card-body overflow-auto">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col"></th>
                    <th scope="col">Color</th>
                    <th scope="col">Team #</th>
                  </tr>
                </thead>
                <tbody id="sortedAllianceRank">

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row pt-78 pb-3 mb-3">
      <button id="submitData" type="button" class="btn btn-success">Submit Ranking</button>
    </div>

  </div>

</div>

</div>

<?php include("footer.php") ?>

<script>
  var sortedTable = null;
  var unsortedTable = null;

  var matchList = null;
  var lockMatchList = false;

  function loadTeams(redTeams, blueTeams) {
    var icon_svg = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrows-move" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M7.646.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 1.707V5.5a.5.5 0 0 1-1 0V1.707L6.354 2.854a.5.5 0 1 1-.708-.708l2-2zM8 10a.5.5 0 0 1 .5.5v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 14.293V10.5A.5.5 0 0 1 8 10zM.146 8.354a.5.5 0 0 1 0-.708l2-2a.5.5 0 1 1 .708.708L1.707 7.5H5.5a.5.5 0 0 1 0 1H1.707l1.147 1.146a.5.5 0 0 1-.708.708l-2-2zM10 8a.5.5 0 0 1 .5-.5h3.793l-1.147-1.146a.5.5 0 0 1 .708-.708l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L14.293 8.5H10.5A.5.5 0 0 1 10 8z"/></svg>';

    $("#rawAllianceRows").html("");
    for (let j = 0; j != 2; j++) {
      var teamList = j == 0 ? redTeams : blueTeams;
      var color = j == 0 ? "Red" : "Blue";
      var colorClass = j == 0 ? "table-danger" : "table-info";
      for (let i = 0; i < teamList.length; i++) {
        var row = "";
        row += "<tr data-team='" + teamList[i] + "' class='" + colorClass + "'>";
        row += "  <td scope='col' class='pickHandle'>" + icon_svg + "</td>";
        row += "  <td scope='col' >" + color + "</td>";
        row += "  <td scope='col' >" + teamList[i] + "</td>";
        row += "</tr>";
        $("#rawAllianceRows").append(row);
      }
    }
  }

  function getSortedTeams() {
    var teamList = [];
    for (let tr of $("#sortedAllianceRank tr")) {
      teamList.push(Number($(tr).attr("data-team")));
    }
    return teamList;
  }

  function updateMatchNumber(matchNumber) {
    $("#teamTitle").html("Match " + matchNumber);
  }

  function getMatchRequestKey() {
    var key = "";
    key += $("#writeCompLevel").val();
    key += $("#writeMatchNumber").val();
    key = key.toUpperCase();
    return key;
  }

  function alertSuccess() {
    alert("Data successfully submitted!");
    $("#rawAllianceRows").html("");
    $("#sortedAllianceRank").html("");
    updateMatchNumber("????");
  }

  function alertFailure() {
    alert("Data NOT submitted!");
  }

  function stripTeamTags(teamList) {
    var out = []
    for (let i = 0; i != teamList.length; i++) {
      var team = teamList[i];
      team = team.toUpperCase();
      team = team.replace("FRC", "");
      out.push(parseInt(team, 10));
    }
    return out;
  }

  function makeCachedMatchListRequest(completeFunction) {
    if (matchList == null) {
      $.get("tbaAPI.php", {
        getMatchList: 1
      }).done(function(data) {
        if (!lockMatchList) {
          lockMatchList = true; // A good enough mutex
          rawMatchData = JSON.parse(data)["response"];
          matchList = {};
          for (let mi in rawMatchData) {
            var newMatch = {};
            var match = rawMatchData[mi];
            newMatch["comp_level"] = match["comp_level"];
            newMatch["match_number"] = match["comp_level"] == "qm" ? match["match_number"] : match["set_number"];
            newMatch["red_teams"] = stripTeamTags(match["alliances"]["red"]["team_keys"]);
            newMatch["blue_teams"] = stripTeamTags(match["alliances"]["blue"]["team_keys"]);
            var key = newMatch["comp_level"] + newMatch["match_number"];
            key = key.toUpperCase();
            matchList[key] = newMatch;
          }
          lockMatchList = false; // Release mutex
          // Run Complete Function
          completeFunction();
        }
      });
    } else {
      completeFunction();
    }
  }

  $(document).ready(function() {

    unsortedTable = new Sortable(document.getElementById('rawAllianceRows'), {
      group: 'shared',
      animation: 150,
      sort: true,
      delayOnTouchOnly: true,
      fallbackTolerance: 3,
      scroll: true,
      handle: '.pickHandle'
    });

    sortedTable = new Sortable(document.getElementById('sortedAllianceRank'), {
      group: 'shared',
      animation: 150,
      sort: true,
      delayOnTouchOnly: true,
      fallbackTolerance: 3,
      scroll: true,
      handle: '.pickHandle'
    });

    $("#loadMatch").click(function() {
      // Load New Match
      makeCachedMatchListRequest(function() {
        var key = getMatchRequestKey();
        if (!(key in matchList)) {
          alert("Match " + key + " not found in loaded match list!");
        } else {
          loadTeams(matchList[key]["red_teams"], matchList[key]["blue_teams"]);
          updateMatchNumber(key);
        }
      });
    });

    $("#submitData").click(function() {
      // Submit Current Ranking
      var sortedTeamList = getSortedTeams();
      if (sortedTeamList.length != 0) {
        $.post("writeAPI.php", {
          writeAllianceRankData: JSON.stringify(sortedTeamList),
          matchKey: getMatchRequestKey()
        }).done(function(data) {
          if (data == "success") {
            alertSuccess();
          } else {
            alertFailure();
          }
        }).fail(function() {
          alertFailure();
        });
      }
    });

  });
</script>