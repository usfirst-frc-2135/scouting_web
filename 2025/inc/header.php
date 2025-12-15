<?php header('Access-Control-Allow-Origin: *'); ?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
  <title><?php echo $title; ?></title>
  <meta charset="UTF-8">
  <meta name="description" content="Scouting Data Web">
  <meta name="author" content="FRC 2135">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" href="./images/favicon.ico">
  <link rel="icon" type="image/png" href="./images/favicon-32x32.png" sizes="32x32">
  <link href="./external/bootstrap-5.3.6-dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

  <style type="text/css" media="screen">
    .form-check-input {
      /* darken check box borders */
      border-color: rgba(0, 0, 0, .5);
    }

    .nav-pills {
      /* navbar pill button text should be white */
      color: "white";
    }

    ul.nav a:hover {
      /* brighten menu text when hovering over an item */
      color: #fff !important;
      background-color: #000;
    }
  </style>
</head>

<body>
  <!-- Create collapsible navbar and navigation buttons -->
  <nav class="navbar navbar-expand-sm bg-dark sticky-top">
    <a class="navbar-brand text-white" href="./index.php">
      <img src="./images/favicon-32x32.png" alt="Logo" width="24" height="24" class="d-inline-block align-text-top">
      <span id="navbarEventCode"> ????</span>
    </a>
    <div class="align-left me-auto">
      <button id="modeSwitch" class="btn btn-secondary btn-sm">M</button>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
      aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div id="navbarCollapse" class="collapse navbar-collapse">
      <ul class="navbar-nav mr-auto">
        <ul class="nav nav-pills flex-column flex-sm-row">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white-50 text-end text-sm-start" href="#" role="button"
              data-bs-toggle="dropdown" aria-expanded="false">Teams</a>
            <ul class="dropdown-menu bg-dark">
              <li><a class="dropdown-item text-white-50 text-end text-sm-start" data-toggle="pill" href="./pitStatus.php">Pit
                  Status</a></li>
              <li><a class="dropdown-item text-white-50 text-end text-sm-start" data-toggle="pill" href="./teamLookup.php">Team
                  Lookup</a></li>
              <li><a class="dropdown-item text-white-50 text-end text-sm-start" data-toggle="pill" href="./pitPhotoUpload.php">Photo
                  Upload</a></li>
              <li><a class="dropdown-item text-white-50 text-end text-sm-start" data-toggle="pill" href="./pitForm.php">Pit
                  Scouting</a>
              </li>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white-50 text-end text-sm-start" href="#" role="button"
              data-bs-toggle="dropdown" aria-expanded="false">Matches</a>
            <ul class="dropdown-menu bg-dark">
              <li><a class="dropdown-item text-white-50 text-end text-sm-start" data-toggle="pill" href="./matchQrScanner.php">QR
                  Scanner</a></li>
              <!-- <li><a class="dropdown-item text-white-50 text-end text-sm-start" data-toggle="pill"
                  href="./matchFormReefscape.php">Match
                  Form</a></li>-->
              <li><a class="dropdown-item text-white-50 text-end text-sm-start" data-toggle="pill" href="./matchData.php">Match
                  Data</a></li>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white-50 text-end text-sm-start" href="#" role="button"
              data-bs-toggle="dropdown" aria-expanded="false">Strategy</a>
            <ul class="dropdown-menu bg-dark">
              <li><a class="dropdown-item text-white-50 text-end text-sm-start" data-toggle="pill"
                  href="./strategicSchedule.php">Strategic Schedule</a>
              </li>
              <li><a class="dropdown-item text-white-50 text-end text-sm-start" data-toggle="pill"
                  href="./strategicForm.php">Strategic Scouting</a></li>
              <li><a class="dropdown-item text-white-50 text-end text-sm-start" data-toggle="pill"
                  href="./strategicData.php">Strategic Data</a></li>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white-50 text-end text-sm-start" href="#" role="button"
              data-bs-toggle="dropdown" aria-expanded="false">Event</a>
            <ul class="dropdown-menu bg-dark">
              <li><a class="dropdown-item text-white-50 text-end text-sm-start" data-toggle="pill" href="./matchSheet.php">Match
                  Sheet</a></li>
              <li><a class="dropdown-item text-white-50 text-end text-sm-start" data-toggle="pill" href="./eventAverages.php">Event
                  Averages</a></li>
              <li><a class="dropdown-item text-white-50 text-end text-sm-start" data-toggle="pill" href="./eventCoprData.php">Event
                  COPRs</a></li>
              <li><a class="dropdown-item text-white-50 text-end text-sm-start" data-toggle="pill" href="./teamCompare.php">Team
                  Compare </a></li>
            </ul>
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
    let frcEventCode = null;

    for (let i = 0; i < items.length; i++) {
      let menuLink = items[i];
      if (menuLink.href === currentLocation) {
        menuLink.classList.add("active");
        menuLink.classList.add("text-light");
        menuLink.classList.remove("text-secondary");
      }
      else {
        menuLink.classList.remove("active");
        menuLink.classList.remove("text-light");
        menuLink.classList.add("text-secondary");
      }
    }

    //
    // Update navbar with the event code if available
    //
    document.addEventListener("DOMContentLoaded", function () {
      // Load dark
      localStorage.getItem('dark-light') == 'dark' ? document.documentElement.setAttribute('data-bs-theme', 'dark') : document.documentElement.setAttribute('data-bs-theme', 'light');

      // Update the navbar with the event code
      $.post("api/dbAPI.php", {
        getDBStatus: true
      }, function (dbStatus) {
        console.log("=> getDBStatus");
        let jDbStatus = JSON.parse(dbStatus);
        if (jDbStatus["server"] !== "") {
          $.get("api/dbAPI.php", {
            getEventCode: true
          }, function (eventCode) {
            frcEventCode = eventCode.trim();
            console.log("=> index: getEventCode: " + frcEventCode + "\n");
            document.getElementById("navbarEventCode").innerText = frcEventCode;
          });
        }
        else {
          console.warn("DB server undefined -- cannot retrieve event code!");
        }
      });
    });

    document.getElementById('modeSwitch').addEventListener('click', () => {
      if (document.documentElement.getAttribute('data-bs-theme') == 'dark') {
        document.documentElement.setAttribute('data-bs-theme', 'light')
        localStorage.setItem('dark-light', 'light');
      }
      else {
        document.documentElement.setAttribute('data-bs-theme', 'dark')
        localStorage.setItem('dark-light', 'dark');
      }
    })
  </script>
