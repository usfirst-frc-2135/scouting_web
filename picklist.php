<title>Pick List</title>
<?php include("header.php") ?>
<div class="container row-offcanvas row-offcanvas-left">
    <div class="well column  col-lg-12  col-sm-12 col-xs-12" id="content">
      <div class="row pt-3 pb-3 mb-3">
        <div class="card col-md-12">
          <div class="card-header">
            Pick List
          </div>
          <div class="card-body">
            <table class="table table-striped table-hover sortable">
              <thead>
                <tr>
                  <th scope="col">Team #</th>
                  <th scope="col">Data</th>
                </tr>
              </thead>
              <tbody id="picklistDiv">
                <tr>
                  <td scope="col">2135</td>
                  <td scope="col">AAA</td>
                </tr>
                <tr>
                  <td scope="col">3476</td>
                  <td scope="col">BBB</td>
                </tr>
                <tr>
                  <td scope="col">973</td>
                  <td scope="col">CCC</td>
                </tr>
                <tr>
                  <td scope="col">1619</td>
                  <td scope="col">DDD</td>
                </tr>
                <tr>
                  <td scope="col">2910</td>
                  <td scope="col">EEE</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      
      <div class="row pt-3 pb-3 mb-3">
        <div class="card col-md-12">
          <div class="card-header">
            Not Sorted
          </div>
          <div class="card-body">
            <table class="table table-striped table-hover sortable">
              <thead>
                <tr>
                  <th scope="col">Team #</th>
                  <th scope="col">Data</th>
                </tr>
              </thead>
              <tbody id="unsortedDiv">
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
      
      <div class="row pt-3 pb-3 mb-3">
        <div class="card col-md-12">
          <div class="card-header">
            Do Not Pick
          </div>
          <div class="card-body">
            <table class="table table-striped table-hover sortable">
              <thead>
                <tr>
                  <th scope="col">Team #</th>
                  <th scope="col">Data</th>
                </tr>
              </thead>
              <tbody id="doNotPickDiv">
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>


<?php include("footer.php") ?>

<script>
    
    
    $(document).ready(function() {
        // $("#picklistDiv").sortable();
        // $("#unsortedDiv").sortable();
        
        new Sortable(document.getElementById('picklistDiv'), {
          group: 'shared',
          animation: 150
        });
        
        new Sortable(document.getElementById('unsortedDiv'), {
          group: 'shared',
          animation: 150
        });
        
        new Sortable(document.getElementById('doNotPickDiv'), {
          group: 'shared',
          animation: 150
        });

    });
     
</script>
    
    
