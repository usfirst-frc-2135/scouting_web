<title>Picture Upload</title>
<?php include("header.php") ?>

<div class="container row-offcanvas row-offcanvas-left">
    <div class="well column  col-lg-12  col-sm-12 col-xs-12" id="content">
      <div class="row pt-3 pb-3 mb-3">
      
        <div class="card col-md-6 mx-auto">
        
        <div id="uploadMessage" style="display: none" class="alert alert-dismissible fade show" role="alert">
          <div id="uploadMessageText"></div>
          <button type="button" class="btn-close" id="closeMessage" aria-label="Close"></button>
        </div>
        
        
          <div class="card-header">
            Upload Robot Picture
          </div>
            <div class="card-body">
              <form id="uploadForm" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                  <label for="teamNumber" class="form-label">Team Number</label>
                  <input type="number" class="form-control" id="teamNumber" placeholder="2135">
                </div>
                <div class="mb-3">
                  <label for="robotPic" class="form-label">Robot Picture</label>
                  <input class="form-control" type="file" id="robotPic">
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
</div>
<?php include("footer.php") ?>
<script>

  function showSuccessMessage(message){
    $("#robotPic").val("");
    $("#teamNumber").val("");
    
    $("#uploadMessageText").text(message);
    $("#uploadMessage").addClass("alert-success");
    $("#uploadMessage").removeClass("alert-danger");
    $("#uploadMessage").show();
  }
  
  function showErrorMessage(message){
    $("#uploadMessageText").text(message);
    $("#uploadMessage").removeClass("alert-success");
    $("#uploadMessage").addClass("alert-danger");
    $("#uploadMessage").show();
  }

  function uploadError(data){
    showErrorMessage(data);
  }
  
  function uploadSuccess(data){
    data = JSON.parse(data);
    if(data["success"]){
      showSuccessMessage("Upload successful, clearing form!");
    }
    else {
      showErrorMessage(data["message"]);
    }
    console.log(data);
  }
  
  $(document).ready(function() {
    $("#upload").on('click', function(event){
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
          error   : uploadError,
          success : uploadSuccess
      });
    });
    
    $("#closeMessage").on('click', function(event){
      $("#uploadMessage").hide();
    });
  });
    
</script>

