<title>Raw COPR Data</title>
<?php include("header.php") ?>
<div class="container row-offcanvas row-offcanvas-left">
  <div class="well column  col-lg-12  col-sm-12 col-xs-12" id="content">
    <div class="row pt-3 pb-3 mb-3">
      <h1 id="COPRHeader">COPR Data: ???</h1>
      
      <div>
        <div class="input-group mb-3">
          <input id="eventCode" type="text" class="form-control" placeholder="eventCode" aria-label="eventCode">
          <button id="loadEvent" type="button" class="btn btn-primary">Load Event</button>
        </div>
      </div>
      
      <div class="table-responsive">
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
  th:first-child, td:first-child, tr{
    position: sticky;
    left: 0px;
    z-index: 1;
    background: rgba(255, 255, 255, 1);
  }
</style>

<?php include("footer.php") ?>

<script>
    function dataToTable(dataObj, keys){
      $("#tableData").html("");
      for (let team in dataObj){
        var row = '<tr>';
        row += '<td>'+team+'</td>';
        for (let j = 0; j < keys.length; j++){
          row += '<td>'+dataObj[team][keys[j]]+'</td>';
        }
        row += '</tr>';
        $("#tableData").append(row);
      } 
    }
    
    function keysToTable(keys){
      var header = '<th scope="col">Team</th>';
      for(let i = 0; i < keys.length; i++){
        header += '<th scope="col">'+keys[i]+'</th>'
      }
      $("#tableKeys").html(header);
    }
    
    function setHeader(ec){
      $("#COPRHeader").html("COPR Data: "+ec);
    }
    
    function processData(data){
      var dataObj = JSON.parse(data);  
      var data = dataObj["data"];
      var keys = dataObj["keys"];
      var ec  = dataObj["eventCode"];
      
      setHeader(ec);
      keysToTable(keys);
      dataToTable(data, keys);
      // sorttable.makeSortable($("#dataTable"));
      // sorttable.makeSortable(document.getElementById("dataTable"));
    }
    
    function requestAPI() {
      //output: gets the API data from our server
      $.get( "tbaAPI.php", {getCOPRs: 1}).done( function( data ) {
        processData(data);
        sorttable.makeSortable(document.getElementById("dataTable"));
      });
    }
    
    
    $(document).ready(function() {
      requestAPI();
      
      $("#loadEvent").click(function(){
        $.get( "tbaAPI.php", {getCOPRs: 1, eventcode: $("#eventCode").val()}).done( function( data ) {
          processData(data);
          setTimeout(function(){sorttable.makeSortable(document.getElementById("rawDataTable"))}, 200);
        });
      });
    });
    
    
    

    
    
</script>
    
    
