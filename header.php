<?php header('Access-Control-Allow-Origin: *'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title><?php echo $title; ?></title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="FRC 2135">
  <link rel="icon" href="./images/favicon.ico">
  <link rel="icon" type="image/png" href="./images/favicon-32x32.png" sizes="32x32">
  <link href="./external/bootstrap-5.3.6-dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link href="./external/DataTables/datatables.min.css" rel="stylesheet" crossorigin="anonymous">

  <style type="text/css" media="screen">
    .form-check-input {
      /* darken check box borders */
      border-color: rgba(0, 0, 0, .5);
    }

    .nav-pills {
      /* navbar button text should be white */
      color: "white";
    }

    ul.nav a:hover {
      color: #fff !important;
      background-color: #000;
    }
  </style>
</head>

<body class="bg-light">
  <!-- Create collapsible navbar and navigation buttons -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <a class="navbar-brand text-white" href="#">
      <img src="./images/favicon-32x32.png" alt="Logo" width="24" height="24" class="d-inline-block align-text-top">
      <span id="navbarEventCode"> ????</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
      aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div id="navbarCollapse" class="collapse navbar-collapse">
      <ul class="navbar-nav mr-auto">
        <ul class="nav nav-pills nav-justified">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Teams</a>
            <ul class="dropdown-menu text-secondary bg-dark">
              <a class="dropdown-item text-secondary" data-toggle="pill" href="./index.php">Team Status</a>
              <a class="dropdown-item text-secondary" data-toggle="pill" href="./teamLookup.php">Team Lookup</a>
              <a class="dropdown-item text-secondary" data-toggle="pill" href="./pitPhotoUpload.php">Photo Upload</a>
              <a class="dropdown-item text-secondary" data-toggle="pill" href="./pitForm.php">Pit Form</a>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Matches</a>
            <ul class="dropdown-menu text-secondary bg-dark">
              <a class="dropdown-item text-secondary" data-toggle="pill" href="./matchQrScanner.php">QR Form</a>
              <a class="dropdown-item text-secondary" data-toggle="pill" href="./matchForm.php">Match Form</a>
              <a class="dropdown-item text-secondary" data-toggle="pill" href="./matchData.php">Match Data</a>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Strategy</a>
            <ul class="dropdown-menu text-secondary bg-dark">
              <a class="dropdown-item text-secondary" data-toggle="pill" href="./strategicSchedule.php">Strategic Schedule</a>
              <a class="dropdown-item text-secondary" data-toggle="pill" href="./strategicForm.php">Strategic Form</a>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Event</a>
            <ul class="dropdown-menu text-secondary bg-dark">
              <a class="dropdown-item text-secondary" data-toggle="pill" href="./matchSheet.php">Match Sheet</a>
              <a class="dropdown-item text-secondary" data-toggle="pill" href="./matchAverages.php">Event Averages</a>
              <a class="dropdown-item text-secondary" data-toggle="pill" href="./strategicData.php">Strategic Data</a>
              <a class="dropdown-item text-secondary" data-toggle="pill" href="./eventCoprData.php">Event COPRs</a>
            </ul>
          </li>

          <li class="nav-item">
            <a class="nav-link text-secondary" data-toggle="pill" href="./databaseStatus.php">Database</a>
          </li>
        </ul>
      </ul>
    </div>
  </nav>

  <script>
    // Handle navbar button state toggles
    const currentLocation = location.href;
    const items = document.querySelectorAll("a");
    const length = items.length;

    for (let i = 0; i < items.length; i++) {
      if (items[i].href === currentLocation) {
        // alert("add: " + items[i]);
        items[i].classList.add("active");
        items[i].classList.add("text-light");
        items[i].classList.remove("text-secondary");
      }
      else {
        // alert("remove: " + items[i]);
        items[i].classList.remove("active");
        items[i].classList.remove("text-light");
        items[i].classList.add("text-secondary");
      }
    }
  </script>
