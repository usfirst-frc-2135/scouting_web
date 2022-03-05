<title>Team Lookup</title>
<?php include("header.php") ?>
<div class="container row-offcanvas row-offcanvas-left">
    <div class="well column  col-lg-12  col-sm-12 col-xs-12" id="content">
        <div class="row pt-3 pb-3 mb-3 gx-3">
        
        <div>
          <div class="input-group mb-3">
            <input id="writeTeamNumber" type="text" class="form-control" placeholder="writeTeamNumber" aria-label="writeTeamNumber">
            <button id="loadTeam" type="button" class="btn btn-primary">Load Team</button>
          </div>
        </div>
        
        
            <div class="col-lg-6 col-sm-6 col-xs-6 gx-3">
                <div class="card mb-3">
                    <div id="robotPicsCarousel" class="carousel slide" data-bs-ride="carousel">
                      <div id="robotPics" class="carousel-inner">
                        
                      </div>
                      <button class="carousel-control-prev" type="button" data-bs-target="#robotPicsCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                      </button>
                      <button class="carousel-control-next" type="button" data-bs-target="#robotPicsCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                      </button>
                    </div>
                    
                    <div class="card-body">
                      <h5 class="card-title">robot picture</h5>
                      <p class="card-text">pit scouting data here if used</p>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">All Matches</h5>
                        <div class="overflow-auto">
                            <table class="table table-striped table-hover sortable">
                              <thead>
                                <tr>
                                  <th scope="col">Match #</th>
                                  <th scope="col">Start Position</th>
                                  <th scope="col">Tarmac Cross</th>
                                  <th scope="col">Auto Upper Hub</th>
                                  <th scope="col">Auto Low Hub</th>
                                  <th scope="col">Teleop Upper Hub</th>
                                  <th scope="col">Teleop Low Hub</th>
                                  <th scope="col">Climb</th>
                                  <th scope="col">Died</th>
                                </tr>
                              </thead>
                                <tbody id="tableData">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-xs-6 gx-3">
                <div class="card mb-3">
                     <div class="card-body">
                        <h5 class="card-title">Match Averages</h5>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="overflow-auto">
                                        <h5 class="text-center">Auton</h5>
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                              <td>&nbsp;</td>
                                              <th scope="col">0</th>
                                              <th scope="col">1</th>
                                              <th scope="col">2</th>
                                              <th scope="col">3</th>
                                              <th scope="col">4</th>
                                              <th scope="col">5</th>
                                              <th scope="col">6</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                <th scope="row">Start</th>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                              <td>&nbsp;</td>
                                              <th scope="col">AVG</th>
                                              <th scope="col">MAX</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Cross</th>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Upper Hub</th>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Lower Hub</th>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th scope="col">TOTAL</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                         <div class="card mb-3">
                                <div class="card-body">
                                    <div class="overflow-auto">
                                        <h5 class="text-center">Teleop</h5>
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                              <td>&nbsp;</td>
                                              <th scope="col">AVG</th>
                                              <th scope="col">MAX</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Upper Hub</th>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Lower Hub</th>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th scope="col">TOTAL</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                         <div class="card mb-3">
                                <div class="card-body">
                                    <div class="overflow-auto">
                                        <h5 class="text-center">Endgame</h5>
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                              <td>&nbsp;</td>
                                              <th scope="col">0</th>
                                              <th scope="col">1</th>
                                              <th scope="col">2</th>
                                              <th scope="col">3</th>
                                              <th scope="col">4</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                <th scope="row">Climb</th>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                              <td>&nbsp;</td>
                                              <th scope="col">AVG</th>
                                              <th scope="col">MAX</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Died</th>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th scope="col">TOTAL</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                         <table class="table table-striped">
                                            <thead>
                                            <tr>
                                              <td>&nbsp;</td>
                                              <th scope="col">AVG</th>
                                              <th scope="col">MAX</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">TOTAL PTS</th>
                                                </tr>
                                            </tbody>
                                        </table>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Graph</h5>
                        </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Start Position Reference</h5>
                    </div>
                   <img src="./images/startingPositionB.png" class="card-img-top" alt="starting position image">
                </div>
            </div>            
        </div>
    </div>
</div>

        
        
<?php include("footer.php") ?>

<script>
    function dataToTable(dataObj){
        for (let i = 0; i < dataObj.length; i++) {
            var rowString = "<tr><td>"+dataObj[i]["matchnumber"]+"</td>"
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
            dataToTable(dataObj);
        });
        
    }
    
    function checkGet(){
      let sp = new URLSearchParams(window.location.search);
      if (sp.has('teamNum')){
        return sp.get('teamNum')
      }
      return null;
    }
    
    
    function clearTeamPics(){
      $("#robotPics").html("");
    }
    
    function loadTeamPics(teamPics){
      /* Takes list of Team Pic paths and loads them
      */
      var first = true;
      for(let uri of teamPics){
        var tags = "";
        if (first){
          tags += "<div class='carousel-item active'>";
        }
        else {
          tags += "<div class='carousel-item'>";
        }
        first = false;
        tags += "  <img src='./"+uri+"' class='d-block w-100'>";
        tags += "</div>";
        $("#robotPics").append(tags);
        console.log(tags);
      }
    }
    
    function loadTeam(team){
      /* This is the main function that runs when we want to load a new team onto the page
      
      */
      
      // Clear existing data
      clearTeamPics();
      
      // Write new data
      
      // Add new images/startingPositionB
      $.get( "readAPI.php", {getTeamImages: team}).done( function( data ) {
        var listOfImages = JSON.parse(data);        
        loadTeamPics(listOfImages);
      });
    }
    
    $(document).ready(function() {
        var initTeamNumber = checkGet()
        if (initTeamNumber){
          loadTeam(initTeamNumber);
        }
        
        $("#loadTeam").click(function(){
          loadTeam($("#writeTeamNumber").val());
        });
    });
    
    
    

    
    
</script>
    
    
