<title>Pit Scouting</title>
<?php include("header.php") ?>
<div class="container row-offcanvas row-offcanvas-left">
    <div class="well column  col-lg-12  col-sm-12 col-xs-12" id="content">
      <div class="row pt-3 pb-3 mb-3">
        <div class="card col-md-6 mx-auto">
          <div id="pitScoutingMessage" style="display: none" class="alert alert-dismissible fade show" role="alert">
          <div id="uploadMessageText"></div>
          <button type="button" class="btn-close" id="closeMessage" aria-label="Close"></button>
          </div>
          <div class="card-header">
            Pit Scouting
          </div>
            <div class="card-body">
              <form id="pitScoutingForm" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                  <label for="teamNumber" class="form-label">Team Number</label>
                  <input type="number" class="form-control" id="teamNumber">
                </div>
                <div class="mb-3">
                  <label for="batteries" class="form-label">Number of Batteries</label>
                  <input type="number" class="form-control" id="batteries">
                </div>
                <div class="mb-3">
                  <label for="programmingLanguage" class="form-label">Programming Language</label>
                  <input type="text" class="form-control" id="batteries">
                </div>
                <div class="mb-3">
                  <label for="driveType" class="form-label">Drive Train Type</label>
                  <div class="input-group mb-3">
                  <select class="form-select" id="inputGroupSelect01">
                  <option selected>Choose...</option>
                  <option value="1">West Coast</option>
                  <option value="2">other</option>
                  <option value="3">other</option>
                  </select>
            </div>
                </div>
                <div class="d-grid gap-2 col-6 mx-auto">
                  <button class="btn btn-primary" type="button" id="submit">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
</div>

<?php include("footer.php") ?>

<script>        
</script>
    
    
