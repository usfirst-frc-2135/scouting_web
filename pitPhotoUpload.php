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
                  <input id="robotPic" class="form-control" type="file">
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="replacePic" class="form-label">Replace Existing Photos</label>
              <input id="replacePic" class="form-check-input" type="checkbox">
            </div>

            <div class="d-grid gap-2 col-6 mx-auto">
              <button id="upload" class="btn btn-primary" type="button">Upload</button>
            </div>
          </form>
        </div>

        <button id="loadingButton" class="btn btn-primary mb-3">
          <span class="spinner-border spinner-border-sm"></span>Loading ...
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

  const loadButton = document.getElementById("loadingButton");
  loadButton.style.visibility = 'hidden';

  // Display success to user
  function showSuccessMessage(message) {
    console.log("==> pitPhotoUpload: showSuccessMessage()" + message);
    $("#robotPic").val("");
    $("#teamNumber").val("");

    document.getElementById("uploadMessageText").innerHTML = message;
    document.getElementById("uploadMessage").classList.add("alert-success");
    document.getElementById("uploadMessage").classList.remove("alert-danger");
    document.getElementById("uploadMessage").style.display = "block";
  }

  // Display error to user
  function showErrorMessage(message) {
    console.log("==> pitPhotoUpload: showErrorMessage(): " + message);

    document.getElementById("uploadMessageText").innerHTML = message;
    document.getElementById("uploadMessage").classList.add("alert-danger");
    document.getElementById("uploadMessage").classList.remove("alert-success");
    document.getElementById("uploadMessage").style.display = "block";
  }

  // Display success to user
  function uploadSuccess(msg) {
    console.log("==> pitPhotoUpload: uploadSuccess(): " + msg);
    msg = JSON.parse(msg);
    const loadButton = document.getElementById("loadingButton");
    if (msg["success"]) {
      loadButton.style.visibility = 'hidden';
      showSuccessMessage("Upload successful, clearing form!");
    } else {
      loadButton.style.visibility = 'hidden';
      showErrorMessage(msg["message"]);
    }
  }

  //
  // Process the generated html
  //
  $(document).ready(function () {
    // Update the navbar with the event code
    $.get("api/tbaAPI.php", {
      getEventCode: true
    }, function (eventCode) {
      eventCode = eventCode.trim();
      console.log("=> pitPhotoUpload: getEventCode: " + eventCode);
      document.getElementById("navbarEventCode").innerHTML = eventCode;
    });

    // Upload photo to the server
    $("#upload").on('click', function (event) {
      console.log("=> pitPhotoUpload: upload clicked!");
      if (document.getElementById("robotPic").value != "" && document.getElementById("teamNumber").value != "") {
        let teamNum = document.getElementById("teamNumber").value;

        if (validateTeamNumber(teamNum, null) > 0) {
          const loadButton = document.getElementById("loadingButton");
          loadButton.style.visibility = 'visible';

          // Replace checkbox is ticked
          if (document.getElementById("replacePic").checked === true) {
            console.log("==> Going to remove existing photos for team #" + teamNum);

            // First get list of robot-pic files for this team.
            $.get("api/dbReadAPI.php", {
              getImagesForTeam: teamNum
            }).done(function (imagesData) {
              console.log("=> getImagesForTeam");
              let teamImages = JSON.parse(imagesData);

              // If there are any existing images, delete them.
              for (let picFile of teamImages) {
                $.ajax({
                  url: 'api/deleteFile.php',
                  data: { 'file': "<?php echo dirname(__FILE__) . '/' ?>" + picFile },
                  success: function (response) {
                    console.log("==> Deleted existing photo: " + picFile);
                    document.getElementById("replacePic").checked = false;
                  },
                  error: function () {
                    console.error("Could NOT delete existing photo: " + picFile);
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
              uploadPost.append("teamPic", $("#robotPic")[0].files[0]);
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
          alert("Team Number is invalid - must be integer with optional last alpha!");
          const loadButton = document.getElementById("loadingButton");
          loadButton.style.visibility = 'hidden';
        }
      }
      else {
        alert("Please fill out all fields!");
        const loadButton = document.getElementById("loadingButton");
        loadButton.style.visibility = 'hidden';
      }

      document.getElementById("closeMessage").addEventListener('click', function () {
        $("#uploadMessage").hide();
        document.getElementById("replacePic").checked = false;
      });
    });
  });
</script>

<script src="./scripts/validateTeamNumber.js"></script>
