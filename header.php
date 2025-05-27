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
  <style>
    .nav .navbar {
      text-decoration: none;
      margin: auto;
      float: none;
      text-align: center;
    }

    li {
      text-decoration: none;
      margin: auto;
      float: none;
      list-style-type: none;
      overflow: hidden;
    }

    .nav li a {
      text-decoration: none;
      margin: auto;
      float: none;
      text-align: center;
      list-style-type: none;
      display: block;
      width: 84px;
      color: #A9A9A9;
    }


    .nav a:hover {
      color: #fff;
    }

    .nav li a.selected {
      text-decoration: none;
      margin: auto;
      float: none;
      text-align: center;
      list-style-type: none;
      width: 76px;
      background-color: #0d6efd;
      color: #fff;
    }
  </style>
</head>

<body class="bg-light">
  <!-- planning to look somewhere to investigate how far the header expands, see if i can ... idk what it says after-->
  <header class="navbar navbar-expand-lg bg-dark navbar-dark sticky-top">
    <div class="container">
      <a class="navbar-brand" href="#">FRC 2135</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
        aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="nav" style="text-align:center">
          <li class="nav-item">
            <a class="nav-link" href="./index.php">Scouting Status</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./pitScouting.php">Pit Scouting</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./photoUpload.php">Photo Upload</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./qrScanner.php">QR Scanner</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./rawData.php">Match Data</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./averages.php">Match Averages</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./strategicSchedule.php">Strategic Schedule</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./strategicScouting.php">Strategic Scouting</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./strategicData.php">Strategic Data</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./teamLookup.php">Team Lookup</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./matchSheet.php">Match Sheet</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./picklist.php">Picklist</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./coprData.php">Event COPRs</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./dbStatus.php">Database Status</a>
          </li>
        </ul>
      </div>
    </div>
  </header>

  <script>
    const currentLocation = location.href;
    const items = document.querySelectorAll("a");
    const length = items.length;

    for (let i = 0; i < items.length; i++) {
      if (items[i].href === currentLocation) {
        items[i].className = "selected";
      }
    }
  </script>
