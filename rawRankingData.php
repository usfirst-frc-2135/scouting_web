<title>Raw Data</title>
<?php include("header.php") ?>
<div class="container row-offcanvas row-offcanvas-left">
    <div class="well column  col-lg-12  col-sm-12 col-xs-12" id="content">
    
      <div class="row pt-3 pb-3 mb-3">
        <h2>Raw Ranking Data</h2>
        <div id="freezeTableDiv">
          <table id="rawDataTable" class="table table-striped table-hover sortable">
            <thead>
              <tr>
                <th scope="col">Match Key</th>
                <th scope="col">Raw Rank</th>
                <th scope="col">Delete Row</th>
              </tr>
            </thead>
            <tbody id="tableData">
            </tbody>
          </table>

          </div>
        </div>
    </div>
</div>


<?php include("footer.php") ?>

<script>
  
  var frozenTable = null;
  var localData = {}
  
    function dataToTable(dataObj){
      $("#tableData").html("");
      localData = {};
      for (let i = 0; i < dataObj.length; i++) {
        var rowString = "";
        rowString += "<tr>";
        rowString += "<td>" + dataObj[i]["matchkey"] + "</td>";
        rowString += "<td>" + dataObj[i]["teamrank"] + "</td>";
        rowString += '<td><button onclick="deleteRow('+i+')" type="button" class="delete-row btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/></svg></button></td>';
        rowString += "</tr>";
        $("#tableData").append(rowString);
        localData[i] = dataObj[i];
      }
    }
        
    
    function requestAPI() {
      //output: gets the API data from our server
      $.get( "readAPI.php", {getRawRankingData: 1}).done( function( data ) {
        var dataObj = JSON.parse(data);        
        dataToTable(dataObj);
      });
    }
    
    function deleteRow(index){
      var sortedTeamList = localData[index]["teamrank"];
      var key = localData[index]["matchkey"];
      $.post( "writeAPI.php", {deleteAllianceRankData: sortedTeamList, matchKey: key}).done( function( data ) {
        requestAPI();
      });
    }
    
    
    $(document).ready(function() {
      requestAPI();
    });
    
    
    

    
    
</script>
    
    
