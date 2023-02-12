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
  <link href="./external/bootstrap-5.1.3/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" </head>

<body class="bg-light">
  <header class="navbar navbar-expand-md navbar-dark sticky-top bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#">FRC 2135</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link" href="./index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./qrScanner.php">QR Scanner</a>
          </li>
		  <li class="nav-item">
            <a class="nav-link" href="./dbStatus.php">DB Status</a>
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
            <a class="nav-link" href="./pitScouting.php">Pit Scouting</a>
          </li>
		  <li class="nav-item">
            <a class="nav-link" href="./pictureUpload.php">Picture Upload</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./picklist.php">Picklist</a>
          </li>
		  <li class="nav-item">
            <a class="nav-link" href="./driveRank.php">Drive Rank</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./allianceRanking.php">Alliance Rank</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./rawCoprData.php">COPRs</a>
          </li>
        </ul>
      </div>
    </div>
  </header>