<?php include 'header.php'; ?>

<title>QR Scanner</title>

<div class="container row-offcanvas row-offcanvas-left">
  <div class="well column  col-lg-12  col-sm-12 col-xs-12" id="content">

    <div class="d-grid col-3 mt-3 mx-auto">
      <button id="submitData" type="button" class="btn btn-success"> Click to Submit Data: 0</button>
    </div>

    <div class="row pt-3 pb-3 mb-3">
      <div id="interactive" class="viewport">
        <video autoplay="true" id="camera"></video>
      </div>
    </div>

    <br>

    <div class="row">
      <select id="cameraSelect" class="form-select form-select mb-3" aria-label=".form-select-lg example">
      </select>
    </div>

    <table class="table">
      <thead>
        <tr>
          <th scope="col">Event Code</th>
          <th scope="col">Match Code</th>
          <th scope="col">Team Number</th>
          <th scope="col">Scout</th>
          <th scope="col">Delete</th>
        </tr>
      </thead>
      <tbody id="qrValidationTable">
      </tbody>
    </table>

  </div>
</div>

<?php include 'footer.php'; ?>

<script src="./scripts/qrHandler.js"></script>
