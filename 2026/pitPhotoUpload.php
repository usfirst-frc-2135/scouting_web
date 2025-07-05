<?php
$title = 'Photo Upload';
require 'inc/header.php';
?>

<div class="container row-offcanvas row-offcanvas-left">
  <div id="content" class="column card-lg-12 card-md-12 col-sm-12 col-xs-12">

    <!-- Page Title -->
    <div class="row pt-3 pb-3 mb-3">
      <div class="row justify-content-md-center">
        <h2 class="col-md-6"><?php echo $title; ?></h2>
      </div>

      <!-- Main photo upload card -->
      <div class="card col-md-6 mx-auto">

        <div class="card-body">
          <form id="uploadForm" method="post" enctype="multipart/form-data">
            <div class="col-7 col-md-5 mb-3">
              <label for="teamNumber" class="form-label">Team Number</label>
              <input id="teamNumber" class="form-control" type="text" placeholder="FRC team number" name="teamNumber">
            </div>

            <div class="mb-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <label for="robotPic" class="form-label">Robot Photo</label>
                  <input id="robotPic" class="form-control mb-3" type="file">
                </div>
              </div>
              <div class="row text-center">
                <output id="photoList"></output>
              </div>
            </div>

            <div class="d-grid gap-2 col-6 mx-auto mb-3">
              <button id="upload" class="btn btn-primary" type="button">Upload</button>
            </div>
          </form>

          <div class="text-center mt-3">
            <label for="replacePic" class="form-label">Replace Existing Photos</label>
            <input id="replacePic" class="form-check-input" type="checkbox">
          </div>

        </div>

        <button id="loadingSpinner" class="btn btn-primary mb-3" type="button" disabled>
          <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
          <span role="status">Loading...</span>
        </button>
        <div id="uploadMessage" class="alert alert-dismissible fade show" style="display: none" role="alert">
          <div id="uploadMessageText"></div>
          <button id="closeMessage" class="btn-close" type="button" aria-label="Photo Upload Close"></button>
        </div>

      </div>

    </div>
  </div>
</div>

<?php include 'inc/footer.php'; ?>

<!-- Javascript page handlers -->

<script>


  // Check if our URL directs to a specific team
  function checkURLForTeamSpec() {
    console.log("=> pitPhotoUpload: checkURLForTeamSpec()");
    let sp = new URLSearchParams(window.location.search);
    if (sp.has('teamNum')) {
      return sp.get('teamNum');
    }
    return null;
  }

  // Display success to user
  function showSuccessMessage(message) {
    console.log("==> pitPhotoUpload: showSuccessMessage()" + message);
    document.getElementById("robotPic").value = "";
    document.getElementById("teamNumber").value = "";

    document.getElementById("uploadMessageText").innerHTML = message;
    document.getElementById("uploadMessage").classList.add("alert-success");
    document.getElementById("uploadMessage").classList.remove("alert-danger");
    document.getElementById("uploadMessage").style.display = "block";
  }

  // Display error to user
  function showErrorMessage(message) {
    console.log("==> pitPhotoUpload: showErrorMessage: " + message);

    document.getElementById("uploadMessageText").innerHTML = message;
    document.getElementById("uploadMessage").classList.add("alert-danger");
    document.getElementById("uploadMessage").classList.remove("alert-success");
    document.getElementById("uploadMessage").style.display = "block";
  }

  // Display success to user
  function uploadSuccess(msg) {
    console.log("==> pitPhotoUpload: uploadSuccess: " + msg);
    loadingSpinner.style.visibility = 'hidden';
    let jMsg = JSON.parse(msg);
    if (jMsg["success"]) {
      showSuccessMessage("Upload successful, clearing form!");
    } else {
      showErrorMessage(jMsg["message"]);
    }
  }

  // Upload the selected image file to the server
  function handlePhotoUpload() {
    console.log("=> pitPhotoUpload: handlePhotoUpload");
    if (document.getElementById("robotPic").value != "" && document.getElementById("teamNumber").value != "") {
      let teamNum = document.getElementById("teamNumber").value;

      if (validateTeamNumber(teamNum, null) > 0) {
        loadingSpinner.style.visibility = 'visible';

        // Replace checkbox is ticked
        if (document.getElementById("replacePic").checked) {
          console.log("==> Going to remove existing photos for team #" + teamNum);

          // First get list of robot-pic files for this team.
          $.get("api/dbReadAPI.php", {
            getImagesForTeam: teamNum
          }).done(function (teamImages) {
            console.log("=> getImagesForTeam\n" + teamImages);
            let jTeamImages = JSON.parse(teamImages);

            // If there are any existing images, delete them.
            for (let imageFile of jTeamImages) {
              $.ajax({
                url: 'api/deleteFile.php',
                data: { 'file': "<?php echo dirname(__FILE__) . '/' ?>" + imageFile },
                success: function (response) {
                  console.log("==> Deleted existing photo: " + imageFile);
                  document.getElementById("replacePic").checked = false;
                },
                error: function () {
                  console.error("Could NOT delete existing photo: " + imageFile);
                }
              });
            }
          });
        }

        // Load/reload the list of team images 
        setTimeout(function () {
          $.get("api/dbReadAPI.php", {
            getImagesForTeam: teamNum
          }).done(function (teamImages) {
            console.log("=> getImagesForTeam\n" + teamImages);

            // Now upload the selected image
            let uploadPost = new FormData();
            uploadPost.append("teamPic", document.getElementById("robotPic").files[0]);
            uploadPost.append("teamNum", document.getElementById("teamNumber").value);
            $.ajax({
              type: "POST",
              url: "api/dbWriteAPI.php",
              data: uploadPost,
              cache: false,
              contentType: false,
              processData: false,
              error: showErrorMessage,
              success: uploadSuccess
            });
          });
        }, 500);
      }
      else {
        loadingSpinner.style.visibility = 'hidden';
        alert("Team Number is invalid - must be integer with optional last alpha!");
      }
    }
    else {
      loadingSpinner.style.visibility = 'hidden';
      alert("Please fill in all fields!");
    }

    document.getElementById("closeMessage").addEventListener('click', function () {
      document.getElementById("uploadMessage").style.display = "none";
      document.getElementById("replacePic").checked = false;
    });
  }

  // Handles FileReader events when an image file has been selected
  function handleFileSelect(evt) {
    let files = evt.target.files;
    let f = files[0];
    let reader = new FileReader();
    reader.onload = (
      function (theFile) {
        return function (e) {
          document.getElementById('photoList').innerHTML = [
            '<img src="', e.target.result, '" title="', theFile.name, '" width="300" />'
          ].join('');
        };
      }
    )(f);
    reader.readAsDataURL(f);
  }

  /////////////////////////////////////////////////////////////////////////////
  //
  // Process the generated html
  //
  document.addEventListener("DOMContentLoaded", () => {

    const loadingSpinner = document.getElementById("loadingSpinner");
    loadingSpinner.style.visibility = 'hidden';

    // Check URL for source team to load
    let initTeamNumber = checkURLForTeamSpec();
    if (initTeamNumber) {
      document.getElementById("teamNumber").value = initTeamNumber;
    }

    // Confirm the file selction selection is supported
    if (!window.FileReader) {
      console.warn("This browser does not support 'FileReader'");
      return alert("This browser does not support 'FileReader'");
    }

    // Attach image upload processor
    document.getElementById('robotPic').addEventListener('change', handleFileSelect, false);

    // Attach image file reader selection from disk
    document.getElementById("upload").addEventListener('click', handlePhotoUpload);
  });
</script>

<script src="./scripts/validateTeamNumber.js"></script>
