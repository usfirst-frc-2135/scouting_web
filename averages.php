<!-- this was copy and pasted from rawData.php so the java will need to change -->
<title>Averages</title>
<?php include("header.php") ?>
<div class="container row-offcanvas row-offcanvas-left">
    <div class="well column  col-lg-12  col-sm-12 col-xs-12" id="content">
        <h5>Averages</h5>
        
        <div class="row g-3">
            <div class="col-md-3">
                <div class="input-group">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Select</button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Qm</a></li>
                    <li><a class="dropdown-item" href="#">Qf</a></li>
                    <li><a class="dropdown-item" href="#">Sf</a></li>
                    <li><a class="dropdown-item" href="#">F</a></li>
                  </ul>
                  <input type="text" class="form-control" aria-label="Text input with dropdown button">
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="input-group">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Select</button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Qm</a></li>
                    <li><a class="dropdown-item" href="#">Qf</a></li>
                    <li><a class="dropdown-item" href="#">Sf</a></li>
                    <li><a class="dropdown-item" href="#">F</a></li>
                  </ul>
                  <input type="text" class="form-control" aria-label="Text input with dropdown button">
                </div>
            </div>
        </div>
        
    
        
        
        
        
            
        
            
      <div class="row pt-3 pb-3 mb-3">
          <div class="overflow-auto">
              <table class="table table-striped table-bordered table-hover sortable">
              <thead>
                <tr>
                    <td rowspan="3" class="text-center fw-bold">Team #</td>
                    <td colspan="2" class="text-center fw-bold">Total Pts</td>
                    <th colspan="2" class="text-center">Total Auto Pts</th>
                    <th colspan="2" class="text-center">Total Teleop Pts</th>
                    <th colspan="2" class="text-center">Climb Pts</th>
                    <th colspan="4" class="text-center">Auton</th>
                    <th colspan="4" class="text-center">Teleop</th>
                    <th colspan="5" class="text-center">Endgame</th>
                    <td colspan="2" class="text-center fw-bold">Died (0/1)</td>
                </tr>
                <tr>
                    <th rowspan="2">AVG</th>
                    <th rowspan="2">MAX</th>
                    <th rowspan="2">AVG</th>
                    <th rowspan="2">MAX</th>
                    <th rowspan="2">AVG</th>
                    <th rowspan="2">MAX</th>
                    <th rowspan="2">AVG</th>
                    <th rowspan="2">MAX</th>
                    <th colspan="2" class="text-center">Upper</th>
                    <th colspan="2" class="text-center">Lower</th>
                    <th colspan="2" class="text-center">Upper</th>
                    <th colspan="2" class="text-center">Lower</th>
                    <th colspan="5" class="text-center">Climb %</th>
                </tr>
                <tr>
                  <th scope="col">AVG</th>
                  <th scope="col">MAX</th>
                  <th scope="col">AVG</th>
                  <th scope="col">MAX</th>
                  <th scope="col">AVG</th>
                  <th scope="col">MAX</th>
                  <th scope="col">AVG</th>
                  <th scope="col">MAX</th>
                  <th scope="col">0</th>
                  <th scope="col">1</th>
                  <th scope="col">2</th>
                  <th scope="col">3</th>
                  <th scope="col">4</th>
                  <th scope="col">AVG</th>
                  <th scope="col">MAX</th>
                </tr>
              </thead>
              <tbody id="tableData">
              </tbody>
            </table>
          </div>
        </div>
    </div>
</div>


<td colspan="2">&nbsp;</td>


<?php include("footer.php") ?>

<script>
    function dataToTable(dataObj){
        for (let i = 0; i < dataObj.length; i++) {
            var rowString = "<tr><td>"+dataObj[i]["teamnumber"]+"</td>"
            +"<td>"+dataObj[i]["startpos"]+"</td>"
            +"<td>"+dataObj[i]["tarmac"]+"</td>"
            +"<td>"+dataObj[i]["autonhighpoints"]+"</td>"
            +"<td>"+dataObj[i]["autonlowpoints"]+"</td>"
            +"<td>"+dataObj[i]["teleophighpoints"]+"</td>"
            +"<td>"+dataObj[i]["teleoplowpoints"]+"</td>"
            +"<td>"+dataObj[i]["climbed"]+"</td>"
            +"<td>"+dataObj[i]["died"]+"</td>"
            +"</td>";
            
            $("#tableData").append(rowString);
            
        }
        
    }
        

    
    
    function requestAPI() {
        //output: gets the API data from our server
        $.get( "readAPI.php", {getAllData: 1}).done( function( data ) {
            var dataObj = JSON.parse(data);        
            var mdp = new matchDataProcessor(dataObj);
            var dataAvg = mdp.getAverages();
            //dataToTable(dataAvg);
            console.log(dataAvg);
        });
        
    }
    
    
    $(document).ready(function() {
        requestAPI();
    });
    
</script>
    
<script type="text/javascript" src="./scripts/matchDataProcessor.js"></script>