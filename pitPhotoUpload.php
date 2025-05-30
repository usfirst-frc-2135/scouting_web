<?php
$title = 'Photo Upload';
require 'header.php';
?>

<div class="container row-offcanvas row-offcanvas-left">
  <div id="content" class="column card-lg-12 col-sm-12 col-xs-12">

    <div class="row pt-3 pb-3 mb-3">
      <div class="row justify-content-md-center">
        <h2 class="col-md-6"><?php echo $title; ?></h2>
      </div>

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
          <button id="closeMessage" class="btn-close" type="button" aria-label="Close"></button>
        </div>

      </div>
    </div>

  </div>
</div>

<?php include 'footer.php'; ?>

<script>

  const loadButton = document.getElementById("loadingButton");
  loadButton.style.visibility = 'hidden';

  function showSuccessMessage(message) {
    $("#robotPic").val("");
    $("#teamNumber").val("");

    $("#uploadMessageText").text(message);
    $("#uploadMessage").addClass("alert-success");
    $("#uploadMessage").removeClass("alert-danger");
    $("#uploadMessage").show();
  }

  function showErrorMessage(message) {
    $("#uploadMessageText").text(message);
    $("#uploadMessage").removeClass("alert-success");
    $("#uploadMessage").addClass("alert-danger");
    $("#uploadMessage").show();
  }

  function uploadError(data) {
    showErrorMessage(data);
  }

  function uploadSuccess(data) {
    data = JSON.parse(data);
    const loadButton = document.getElementById("loadingButton");
    if (data["success"]) {
      loadButton.style.visibility = 'hidden';
      showSuccessMessage("Upload successful, clearing form!");
    } else {
      loadButton.style.visibility = 'hidden';
      showErrorMessage(data["message"]);
    }
    console.log(data);
  }

  //
  // Process the generated html
  //
  $(document).ready(function () {

    // Upload photo to the server
    $("#upload").on('click', function (event) {
      if (document.getElementById("robotPic").value != "" && document.getElementById("teamNumber").value != "") {
        const loadButton = document.getElementById("loadingButton");
        loadButton.style.visibility = 'visible';

        if ($("#replacePic").is(":checked") == true) {
          var teamNum = $("#teamNumber").val();
          console.log("Going to remove existing photo for team #" + teamNum);

          // First get list of robot-pic files for this team.
          $.get("readAPI.php", {
            getTeamImages: teamNum
          }).done(function (data) {
            var teamPics = JSON.parse(data);

            // If there are any existing pics, delete them.
            for (let picFile of teamPics) {
              $.ajax({
                url: 'deleteFile.php',
                data: { 'file': "<?php echo dirname(__FILE__) . '/' ?>" + picFile },
                success: function (response) {
                  console.log("Deleted existing photo: " + picFile);
                },
                error: function () {
                  console.log("Could NOT delete existing photo: " + picFile);
                }
              });
            }
          });
          // Reload the list of team images 
          $.get("readAPI.php", {
            getTeamImages: teamNum
          }).done(function (data) {
            console.log("Reloaded team images");
          });
        }

        // Now upload the new pic
        var uploadPost = new FormData();
        uploadPost.append("teamPic", $("#robotPic")[0].files[0]);
        uploadPost.append("teamNum", $("#teamNumber").val());
        $.ajax({
          type: "POST",
          url: "writeAPI.php",
          data: uploadPost,
          cache: false,
          contentType: false,
          processData: false,
          error: uploadError,
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
