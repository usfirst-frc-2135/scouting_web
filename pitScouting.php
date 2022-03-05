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
                  <label for="batteryChargers" class="form-label">Number of Battery Chargers</label>
                  <input type="number" class="form-control" id="batteries">
                </div>
                <div>
                  <label class="form-label">Pit Organization</label>
                </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="pitScore1" value="option1">
                    <label class="form-check-label" for="pitScore1">1</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="pitScore2" value="option2">
                    <label class="form-check-label" for="pitScore2">2</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="pitScore3" value="option2">
                    <label class="form-check-label" for="pitScore3">3</label>
                  </div>
                <div>
                  <label class="form-label">Does the team have spare parts?</label>
                </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="sparePartsYes" value="option1">
                    <label class="form-check-label" for="sparePartsYes">Yes</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="sparePartsNo" value="option2">
                    <label class="form-check-label" for="sparePartsNo">No</label>
                  </div>
                <div class="mb-3">
                  <label for="driveType" class="form-label">Programming Language</label>
                  <div class="input-group mb-3">
                    <select class="form-select" id="programmingLanguage">
                    <option selected>Choose...</option>
                    <option id="java" value="1">Java</option>
                    <option id="labView" value="2">LabView</option>
                    <option id="C++" value="3">C++</option>
                    <option id="python" value="4">Python</option>
                    <option id="other" value="5">Other</option>
                    </select>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="driveMotors" class="form-label">Drive Motors</label>
                  <div class="input-group mb-3">
                    <select class="form-select" id="driveMotors">
                    <option selected>Choose...</option>
                    <option id="falcons" value="1">Falcons</option>
                    <option id="neos" value="2">Neos</option>
                    <option id="cims" value="3">Cims</option>
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
    
    
