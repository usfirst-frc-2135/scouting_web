<title>Raw COPR Data</title>
<?php include("header.php") ?>
<div class="container row-offcanvas row-offcanvas-left">
    <div class="well column  col-lg-12  col-sm-12 col-xs-12" id="content">
    
      <div class="row pt-3 pb-3 mb-3">
        <h1> Raw COPR Data </h1>

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
        
    
    function requestAPI() {
        //output: gets the API data from our server
        $.get( "tbaAPI.php", {getCOPRs: 1}).done( function( data ) {
            var dataObj = JSON.parse(data);  
            var data = dataObj["data"];
            var keys = dataObj["keys"];
            
            keysToTable(keys);
            dataToTable(data, keys);
            // sorttable.makeSortable($("#dataTable"));
            sorttable.makeSortable(document.getElementById("dataTable"));
        });
        
    }
    
    
    $(document).ready(function() {
        requestAPI();
    });
    
    
    

    
    
</script>
    
    
