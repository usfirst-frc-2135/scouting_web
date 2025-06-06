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
    }
  </style>
</head>

<body class="bg-light">
  <!-- Create collapsible navbar and navigation buttons -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <a class="navbar-brand text-white" href="#">FRC 2135</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
      aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div id="navbarCollapse" class="collapse navbar-collapse">
      <ul class="navbar-nav mr-auto">
        <ul class="nav nav-pills nav-justified">
          <li class="nav-item">
            <a class="nav-link text-secondary active" data-toggle="pill" href="./index.php">Scouting Status</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-secondary" data-toggle="pill" href="./pitForm.php">Pit Scouting</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-secondary" data-toggle="pill" href="./pitPhotoUpload.php">Photo Upload</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-secondary" data-toggle="pill" href="./matchQrScanner.php">QR Scanner</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-secondary" data-toggle="pill" href="./matchData.php">Match Data</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-secondary" data-toggle="pill" href="./matchAverages.php">Match Averages</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-secondary" data-toggle="pill" href="./strategicSchedule.php">Strategic Schedule</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-secondary" data-toggle="pill" href="./strategicForm.php">Strategic Scouting</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-secondary" data-toggle="pill" href="./strategicData.php">Strategic Data</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-secondary" data-toggle="pill" href="./teamLookup.php">Team Lookup</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-secondary" data-toggle="pill" href="./matchSheet.php">Match Sheet</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-secondary" data-toggle="pill" href="./eventCoprData.php">Event COPRs</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-secondary" data-toggle="pill" href="./databaseStatus.php">Database Status</a>
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
