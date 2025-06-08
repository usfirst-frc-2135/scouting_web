<?php
$title = 'Photo Upload';
require 'header.php';
?>

<div class="container row-offcanvas row-offcanvas-left">
  <div id="content" class="column card-lg-12 col-sm-12 col-xs-12">

    <!-- Page Title -->
    <div class="row pt-3 pb-3 mb-3">
      <div class="row justify-content-md-center">
        <h2 class="col-md-6"><?php echo $title; ?></h2>
      </div>

      <!-- Main photo upload card -->
      <div class="card col-md-6 mx-auto">

        <div class="card-body">
          <form id="uploadForm" method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="teamNumber" class="form-label">Team Number</label>
              <input id="teamNumber" class="form-control" type="text" placeholder="FRC team number" name="teamNumber">
            </div>

            <div class="mb-3">
              <label for="robotPic" class="form-label">Robot Photo</label>
              <input id="robotPic" class="form-control" type="file">
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

        <button id="loadingButton" class="btn btn-primary">
          <span class="spinner-border spinner-border-sm"></span>
          Loading..
        </button>
        <div id="uploadMessage" class="alert alert-dismissible fade show" style="display: none" role="alert">
          <div id="uploadMessageText"></div>
          <button id="closeMessage" class="btn-close" type="button" aria-label="Photo Upload Close"></button>
        </div>

      </div>

    </div>

  </div>
</div>

<?php include 'footer.php'; ?>

<!-- Javascript page handlers -->

<script>

  const loadButton = document.getElementById("loadingButton");
  loadButton.style.visibility = 'hidden';

  function showSuccessMessage(message) {
    console.log("==> pitPhotoUpload.php: showSuccessMessage()" + message);
    $("#robotPic").val("");
    $("#teamNumber").val("");

    $("#uploadMessageText").text(message);
    $("#uploadMessage").addClass("alert-success");
    $("#uploadMessage").removeClass("alert-danger");
    $("#uploadMessage").show();
  }

  function showErrorMessage(message) {
    console.log("==> pitPhotoUpload.php: showErrorMessage(): " + message);

    $("#uploadMessageText").text(message);
    $("#uploadMessage").removeClass("alert-success");
    $("#uploadMessage").addClass("alert-danger");
    $("#uploadMessage").show();
  }

  function uploadSuccess(msg) {
    console.log("==> pitPhotoUpload.php: uploadSuccess(): " + msg);
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
      console.log("==> pitPhotoUpload - getEventCode: " + eventCode);
      $("#navbarEventCode").html(eventCode);
    });

    // Upload photo to the server
    $("#upload").on('click', function (event) {
      if (document.getElementById("robotPic").value != "" && document.getElementById("teamNumber").value != "") {
        const loadButton = document.getElementById("loadingButton");
        loadButton.style.visibility = 'visible';

        // Replace checkbox is ticked
        if ($("#replacePic").is(":checked") == true) {
          var teamNum = $("#teamNumber").val();
          console.log("Going to remove existing photos for team #" + teamNum);

          // First get list of robot-pic files for this team.
          $.get("api/readAPI.php", {
            getImagesForTeam: teamNum
          }).done(function (imagesData) {
            console.log("==> getImagesForTeam");
            var teamPics = JSON.parse(imagesData);

            // If there are any existing pics, delete them.
            for (let picFile of teamPics) {
              $.ajax({
                url: 'deleteFile.php',
                data: { 'file': "<?php echo dirname(__FILE__) . '/' ?>" + picFile },
                success: function (response) {
                  console.log("Deleted existing photo: " + picFile);
                },
                error: function () {
                  console.error("Could NOT delete existing photo: " + picFile);
                }
              });
            }
          });

          // Reload the list of team images 
          setTimeout(function () {
            $.get("api/readAPI.php", {
              getImagesForTeam: teamNum
            }).done(function (teamImages) {
              console.log("==> getImagesForTeam\n" + teamImages);
            });
          }, 500);
        }

        // Now upload the new pic
        var uploadPost = new FormData();
        uploadPost.append("teamPic", $("#robotPic")[0].files[0]);
        uploadPost.append("teamNum", $("#teamNumber").val());
        $.ajax({
          type: "POST",
          url: "api/writeAPI.php",
          data: uploadPost,
          cache: false,
          contentType: false,
          processData: false,
          error: showErrorMessage,
          success: uploadSuccess
        });
      }
      else {
        alert("Please fill out all fields!");
        const loadButton = document.getElementById("loadingButton");
        loadButton.style.visibility = 'hidden';
      }

      $("#closeMessage").on('click', function (event) {
        $("#uploadMessage").hide();
        $("#replacePic").prop("checked", false);
      });
    });
  });
</script>
