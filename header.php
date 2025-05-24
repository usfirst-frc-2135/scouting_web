<?php header('Access-Control-Allow-Origin: *'); ?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="FRC 2135">
  <link rel="icon" href="./images/favicon.ico">
  <link rel="icon" type="image/png" href="./images/favicon-32x32.png" sizes="32x32">
  <link href="./external/bootstrap-5.1.3/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <style>
    /* a {
      color: #000;
      text-decoration: none;
    } */
    .nav {
      text-decoration: none;
      border-radius: 10px;
      padding: 0px 10px;
      margin: auto;
      text-align: center;
      float: left;
    }

    /* .nav li {
         list-style-type: none;
         float: left;
         margin: 0;
         padding: 0;
         overflow: hidden;
        } */
    .nav li a {
      display: inline-block;
      color: #A9A9A9;
      margin: auto;
      width: 76px;
      float: left;
    }

    .nav a:hover {
      color: #fff;
    }

    .nav li a.selected {
      text-decoration: none;
      list-style-type: none;
      margin: auto;
      text-align: center;
      float: left;
      padding: 10px 0px;
      background-color: #0d6efd;
      color: #fff;
    }
  </style>
</head>

<body class="bg-light">
  <!-- planning to look somewhere to investigate how far the header expands, see if i can ... idk what it says after-->
  <header class="navbar navbar-expand-md navbar-dark sticky-top bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#">FRC 2135</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
        aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="nav" style="text-align:center">
          <li class="nav-item">
            <a class="nav-link" href="./index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./rawData.php">Raw Data</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./averages.php">Averages</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./teamLookup.php">Team Lookup</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./matchSheet.php">Match Sheet</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./strategicData.php">Strategic Data</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./pitScouting.php">Pit Scouting</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./strategicScouting.php">Strategic Scouting</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./pictureUpload.php">Picture Upload</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./qrScanner.php">QR Scanner</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./coprData.php">COPRs</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./picklist.php">Picklist</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./strategicSchedule.php">Strategic Schedule</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./dbStatus.php">DB Status</a>
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
