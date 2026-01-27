
![2135-Logo](https://frc2135.org/scouting/2026/images/favicon-32x32.png)

# Scouting Web App (github: scouting_web)

## What does it do?

This repo is for the scouting web application. This web application is used to capture pit, match, and strategic data during an FRC competition. Input for pit and strategic data are collected on web forms, and the match data is collected by a QR scanner form. Robot photos can also be uploaded via a web form.

Collected data can be viewed through a match data page and strategic data page. The team related data can also be viewed through a team lookup page to show scoring averages, maximums, and trends. Match analyses are provided by a match sheet page that combines information from all 6 robots in a scheduled match with cumulative statistics on how the match might happen. Event related data can be also viewed through an event averages table and the COPR data from the Blue Alliance. 

## What web tools does it use?

Web pages are written to use Bootstrap, PHP, and javascript to gather and display the results from the main database. The scouting database is in a MySQL server on our team web site, Web pages access the scouting database over Internet connections and also pull information from the Blue Alliance.

## How is the database structured?

A MySQL instance of the scouting database consists of six tables:  pit data, match data, strategic data, team aliases, scout names, and cached TBA responses.
- The pit data table is keyed on the event code and the team number, since it is not match dependent.
- The match data table is keyed on the event code, match number, and team number and contains data for that team in that particular match.
- The strategic data table is similarly keyed on the event code, match number and team number.
- The team aliases table holds an alias map for multi-robot events that use temporary team numbers.
- The scout names table holds a list of the scout names at a particular event.
- The TBA table is keyed on the request string sent to the TBA server to retrieve info (i.e. "/frc/teams/").

A single database can span multiple events, and matches not keyed to the selected event will be filtered out in the responses. (As long as the database schema does not change between events.)

## Where is the source code stored?

This is stored in the "scouting_web" repo on the team's github at:

https://github.com/usfirst-frc-2135/scouting_web

## How to make changes to the web site?

While the scouting web database is hosted on the team web site at frc2135.org, it can be difficult to make changes, deploy, and test on a live web server. It is much easier to set up a local web server on the development computer to add features and debug, and then only deploy the scouting web pages once it's ready to release for production use. The team uses the application MAMP (Mac OS, Apache, MySQL, and Perl/Python/PHP) to host a development MySQL server right on the user's computer. With the right settings, the developer has a great deal of control and insight while running the pages that access the database.

## Glossary

**Match Data** - normal scouting data collected for every robot in every match at an event (or a collection of those matches).

**Pit Data** - scouting data collected for a team robot usually before an event starts (or a collection of those robots).

**Strategic Data** - scouting data collected by strategic scouts for select matches that evaluate a robot's performance for future play.

**Match Number** - this can mean the full match ID (e.g. "qm5") or just the numeric portion of the full match ID (e.g. 5).

**Competition Level** - this is the prefix "p", "qm", "sf", or "f" for a full match ID (e.g. "qm" for match ID "qm5").

**Team Number** - the FRC-assigned official team number. At multi-robot events, this number may have a letter suffix.

**Team Alias** - the event-assigned team number placed on bumpers and used with the FMS. Numbers are in the range 9900-9999.

## Scouting Web App Organization - Top Menus

**Team Scouting Info** - activities related to capturing information about a robot (photo upload, pit scouting, team lookup).

**Match Scouting Info** - activities related to capturing information about a match or matches during an event (QR form, match scouting form, match data table).

**Strategic Scouting Info** - activities related to capturing strategic scouting data during an event (strategic scouting schedule, strategic scouting form, strategic data table).

**Event Scouting Info** - activities related to reviewing data for an event in order to make strategy decisions (match sheet, event averages, COPR data).

# Scouting App Project Organization

The scouting web app consists of a hosted web site containing PHP web pages and javascript helper utilities. The directory structure is detailed below:
- scouting_web (this is the github repo root directory)
  - 2025 (this subdirectory level is a mirror of what is placed on the live web site) 
    - api - directory of PHP files for accessing the MySQL database and The Blue Alliance
    - external - the javascript libraries used by the web site
      - bootstrap - the framework used to build web pages and widgets
      - charts - used to create charts withing the data lookup pages
      - freeze-table - used to freeze the header and first column in larger data tables for easy viewing
      - jquery - required by freeze-table (we no longer use jquery within our web pages--only javascript)
      - sorttable - utility to automatically provde sorting functions to data tables
      - zxing - used for QR code scanning and decoding
    - images - graphic images used by the web site such as favicon.ico
    - inc - header.php and footer.php include files
    - qr-code - screenshots of QR codes used for web site testing
    - robot-pics - location for uploaded photos of robots during pit scouting
    - scripts - javascript utilities for commonly used functions
    - *.php - the main webpages used by the scouting app web site -- the names should match the web menu interface
  - phpinfo.php - a simple php file for running phpconfig on our web host
  - LICENSE - the MIT license covering use of this repo
  - README.md - THIS FILE

# Scouting App Setup

## Setting the event code for a new event:

To change the event code at the actual website scouting data: 
- Go to the https://frc2135.org/scouting/2025/ path in your browser. The pit status page will be shown.
- Click on the event code (or ????) in the upper left corner to get to the dbStatus page.
- In the dbStatus page, you only need to change the event code to the one you want. (e.g. 2026cafr)
- Scroll down to the bottom of the page and click "Write Config" (no other buttons need to be clicked). This writes a file onto the server that changes the active event for everyone using the scouting web app on this server.

## Normal dbStatus Settings for website

The normal dbStatus settings are as shown below. They shouldn’t need to be edited to change the event code or access the picklist page:
 
- Server URL:  `localhost` (^1)
- Database Name:  `scouting2026`
- User Name:  `scoutingsql26`
- Password:  `xxxxxxx` (ask for this) 
- tbakey:  `Dpiv26v...` (ask for this)


(^1) (because the SQL code is executing on the web server and can identify itself with 'localhost')| 


### When creating a new database on the actual website:

To initially create a new database on the team's website, Mr. Mullins has to physically create the new database using frc2135.org/cpanel.

- Go to "MySQL Databases"
- Create the new database (e.g. scouting2026)
- Add the `scoutingsql26` user with all privileges

Tables within the database are created automatically when the scouting web app connects to a new database.

## Scouting Web App File Locations

__Base Path__

The Java script PHP files and directories (these are the files stored for the Scouring Web App in github) are found here (this is the `<base_path>`):

On the live team website (frc2135.org):
- `/public_html/scouting/2025/`

For the localhost on a (Mac OS X) development computer:
- `/Applications/MAMP/htdocs/scouting/2025`

__Robot Photo Image Files__

The robot photo image files are uploaded from the __Picture Upload__ page. These files should be deleted each year for the new FRC challenge. They are placed in this location with this naming pattern:

- `<base_path>/robot-pics/<team_number>-<image_number>.<suffix>` 

__Database and Tables Files__

When a new database and tables are created, a database (db) config file is created: 

On the live team website (frc2135):
 - `/public_html/../db_config.ini` - this is stored "above" the public_html directory to keep it hidden from general users.

For the localhost on a (Mac OS X) development computer:
 - `/Applications/MAMP/db_config.ini`

Files that appear to hold the database/table data are also created by MySQL:

On the live team website (frc2135):
 - `/public_html/../.mysql_backup/<database_name>.sql.gz`
(GZ file can be unzipped using “gzip -d <file>”)

For the localhost on a (Mac OS X) development computer:
 - `/Applications/MAMP/db/mysql57/<database_name>/<table_name>.frm` and `<table_name>.ibd`

These files can be deleted once that database or table is no longer valid or used.

__Viewing Data in Tables__

The way to access the database is by navigating to `localhost/phpMyAdmin` in your browser (if you can't find this, you should be able to navigate to http://localhost/MAMP/ which should have info on how to get to phpMyAdmin). On the left you should see all the database names and you can click on one to show all the tables in that database. You can click on the table name and it should show you the structure and data in each table. This should show you everything you want to know about the tables.

__Debugging PHP code__

For debugging PHP code, use this command to print out a message to the error log file:

`error_log(“<msg_text>”);`

Where <msg_text> can be a string or reference a PHP variable such as $var in this way:<br>

         `error_log(“---> this is the data: $var”);`

The issued message will be found near the bottom of the error log file, here:

On the live team website (frc2135):
- `/public_html/scouting/2025/api/error_log`

For the localhost on a (Mac OS X) development computer:
- `/Applications/MAMP/logs/php_error.log`
