<?php
$title = 'QR Scanner';
require 'inc/header.php';
?>

<div class="container row-offcanvas row-offcanvas-left">
  <div id="content" class="column card-lg-12 col-sm-12 col-xs-12">

    <!-- Page Title -->
    <div class="row pt-3 pb-3 mb-3">
      <div class="row justify-content-md-center">
        <h2 class="col-md-6"><?php echo $title; ?></h2>
      </div>

      <!-- Main card to hold the QR scanner -->
      <div class="card col-md-6 mx-auto">
        <div class="card-body">
          <div id="interactive" class="viewport mt-3">
            <video id="camera" class="col-12" autoplay="true"></video>
          </div>
          <select id="cameraSelector" class="form-select mb-3" aria-label="Camera Select">
          </select>
          <div class="d-grid gap-2 col-6 mx-auto">
            <button id="submitData" class="btn btn-success mb-3" type="button">Click to Submit Data: 0</button>
          </div>
        </div>
      </div>

    </div>

    <table id="qrScanTable" class="table">
      <thead>
        <tr>
          <th scope="col">Event Code</th>
          <th scope="col">Match Code</th>
          <th scope="col">Team Number</th>
          <th scope="col">Scout</th>
          <th scope="col">Delete</th>
        </tr>
      </thead>
      <tbody class="table-group-divider"> </tbody>
    </table>

  </div>
</div>

<?php include 'inc/footer.php'; ?>

<!-- Javascript page handlers -->

<script>

  // Update the navbar with the event code
  document.addEventListener("DOMContentLoaded", () => {

    $.get("api/tbaAPI.php", {
      getEventCode: true
    }, function (eventCode) {
      eventCode = eventCode.trim();
      console.log("=> matchQrScanner: getEventCode: " + eventCode);
      document.getElementById("navbarEventCode").innerText = eventCode;
    });
  });

</script>

<script src="./scripts/qrHandler.js"></script>
