<title>Raw Data</title>
<?php include("header.php") ?>
<div class="container row-offcanvas row-offcanvas-left">
    <div class="well column  col-lg-12  col-sm-12 col-xs-12" id="content">
    
      <div class="row pt-3 pb-3 mb-3">

        <table id="rawDataTable" class="table table-striped table-hover sortable">
          <thead>
            <tr>
              <th scope="col">Match #</th>
              <th scope="col">Team #</th>
              <th scope="col">Start Position</th>
              <th scope="col">Tarmac Cross</th>
              <th scope="col">Auto Upper Hub</th>
              <th scope="col">Auto Low Hub</th>
              <th scope="col">Teleop Upper Hub</th>
              <th scope="col">Teleop Low Hub</th>
              <th scope="col">Climb</th>
              <th scope="col">Died</th>
              <th scope="col">Comment</th>
              <th scope="col">Scout Name</th>
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
    function dataToTable(dataObj){
        for (let i = 0; i < dataObj.length; i++) {
            var rowString = "<tr><td>"+dataObj[i]["matchnumber"]+"</td>"
            +"<td>"+dataObj[i]["teamnumber"]+"</td>"
            +"<td>"+dataObj[i]["startpos"]+"</td>"
            +"<td>"+dataObj[i]["tarmac"]+"</td>"
            +"<td>"+dataObj[i]["autonhighpoints"]+"</td>"
            +"<td>"+dataObj[i]["autonlowpoints"]+"</td>"
            +"<td>"+dataObj[i]["teleophighpoints"]+"</td>"
            +"<td>"+dataObj[i]["teleoplowpoints"]+"</td>"
            +"<td>"+dataObj[i]["climbed"]+"</td>"
            +"<td>"+dataObj[i]["died"]+"</td>"
            +"<td>"+dataObj[i]["comment"]+"</td>"
            +"<td>"+dataObj[i]["scoutname"]+"</td>"
            +"</td>";
            
            $("#tableData").append(rowString);
            
        }
        
    }
        
    
    function requestAPI() {
        //output: gets the API data from our server
        $.get( "readAPI.php", {getAllData: 1}).done( function( data ) {
            var dataObj = JSON.parse(data);        
            dataToTable(dataObj);
            sorttable.makeSortable(document.getElementById("rawDataTable"));
        });
        
    }
    
    
    $(document).ready(function() {
        requestAPI();
        sorttable.makeSortable(document.getElementById("rawDataTable"));
    });
    
    
    

    
    
</script>
    
    
