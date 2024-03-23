<title>Picture Upload</title>
<?php include("header.php") ?>

<div class="container row-offcanvas row-offcanvas-left">
  <div class="well column  col-lg-12  col-sm-12 col-xs-12" id="content">
    <div class="row pt-3 pb-3 mb-3">
        <div class="row g-3 justify-content-md-center">
            <div class="row justify-content-md-center">
              <h2 class="col-md-6"> Upload Robot Picture </h2>
            </div>
        </div>

      <div class="card col-md-6 mx-auto">

        <button class="btn btn-primary" id="loading">
          <span class="spinner-border spinner-border-sm"></span>
          Loading..
        </button>
        <div id="uploadMessage" style="display: none" class="alert alert-dismissible fade show" role="alert">
          <div id="uploadMessageText"></div>
          <button type="button" class="btn-close" id="closeMessage" aria-label="Close"></button>
        </div>

        <div class="card-body">
          <form id="uploadForm" method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="teamNumber" class="form-label">Team Number</label>
              <input type="text" class="form-control" id="teamNumber" placeholder="#">
            </div>
              
            <div class="mb-3">
              <label for="robotPic" class="form-label">Robot Picture</label>
              <input class="form-control" type="file" id="robotPic">
            </div>
              
            <div class="mb-3">
              <label for="replacePic" class="form-label">Replace Existing Pictures</label>
              <input class="form-check-input" type="checkbox" id="replacePic">
            </div>

            <div class="d-grid gap-2 col-6 mx-auto">
              <button class="btn btn-primary" type="button" id="upload">Upload</button>
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>
</div>
<?php include("footer.php") ?>
<script>
    
  const button = document.getElementById("loading");
  button.style.visibility = 'hidden';
    
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
    if (data["success"]) {
      const button = document.getElementById("loading");
      button.style.visibility = 'hidden';
      showSuccessMessage("Upload successful, clearing form!");
    } else {
      const button = document.getElementById("loading");
      button.style.visibility = 'hidden';
      showErrorMessage(data["message"]);
    }
    console.log(data);
  }

  $(document).ready(function() {
    $("#upload").on('click', function(event) {
          if(document.getElementById("robotPic").value != "" && document.getElementById("teamNumber").value != "") {
            const button = document.getElementById("loading");
            button.style.visibility = 'visible';
    
      if ( $("#replacePic").is(":checked") == true) 
      {
        var teamNum = $("#teamNumber").val();
        console.log("Going to remove existing photo for team #"+teamNum); 

        // First get list of robot-pic files for this team.
        $.get("readAPI.php", {
          getTeamImages: teamNum 
        }).done(function(data) {
          var teamPics = JSON.parse(data);

          // If there are any existing pics, delete them.
          for (let picFile of teamPics) {
            $.ajax({
              url:'deleteFile.php',
              data: {'file' : "<?php echo dirname(__FILE__) . '/'?>" + picFile },
              success:function(response){
                console.log("Deleted existing picture: "+picFile); 
              },
              error:function(){
                console.log("Could NOT delete existing picture: "+picFile); 
              }
            });
          }
        });
        // Reload the list of team images 
        $.get("readAPI.php", {
          getTeamImages: teamNum 
        }).done(function(data) {
          console.log("Reloaded team images" );
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
        const button = document.getElementById("loading");
        button.style.visibility = 'hidden';
    }
    $("#closeMessage").on('click', function(event) {
      $("#uploadMessage").hide();
      $("#replacePic").prop("checked",false); 
    });
    });
  });
</script>
