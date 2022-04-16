<title>Alliance Rank</title>
<?php include("header.php") ?>
<div class="container row-offcanvas row-offcanvas-left">
  <div class="well column  col-lg-12  col-sm-12 col-xs-12" id="content">
      <div class="row pt-3 pb-3 mb-3">
        <div class="card col-md-12">
          <div class="card-body">
            <h2 id="allianceRankName">Alliance Rank:</h2>
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
                    <th scope="col"></th>
                    <th scope="col">Teams</th>
                  </tr>                 
                </thead>
                <tbody id="Alliance Ranking Page">
    
                    <tr>
                        <th scope="row">Red 1</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    
                    <tr>
                        <th scope="row">Red 2</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    
                    <tr>
                        <th scope="row">Red 3</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    
                    <tr>
                        <th scope="row">Blue 1</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    
                    <tr>
                        <th scope="row">Blue 2</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    
                    <tr>
                        <th scope="row">Blue 3</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td> 
                    </tr>
                    
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
                    <th scope="col"></th>
                    <th scope="col">Rank</th>
                    <th scope="col">Team #</th>
                    <th scope="col">Pic</th>
                  </tr>                 
                </thead>
                <tbody id="Alliance Ranking Page">
    
                    <tr>
                        <th scope="row">1</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    
                    <tr>
                        <th scope="row">2</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    
                    <tr>
                        <th scope="row">3</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    
                    <tr>
                        <th scope="row">4</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    
                    <tr>
                        <th scope="row">5</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    
                    <tr>
                        <th scope="row">6</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td> 
                    </tr>
                    
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
        

        
                




 <div class="row pt-78 pb-3 mb-3">
      <button id="submitData" type="button" class="btn btn-success">Submit Ranking: 0</button>
    </div> 

</div>
    
   </div>

</div>
      
   

<?php include("footer.php") ?>
