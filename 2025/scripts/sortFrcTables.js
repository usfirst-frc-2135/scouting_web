/*
  Global Variable Definition
*/

/*
  Function Definition

*/
//
//  Sort a table based on team numbers and/or match numbers
//
//  Params:
//    tableId - the html ID of the <table> tag element
//    teamCol - the column number of the team numbers in the table (-1 means no team sort)
//    matchCol - the column number of the match numbers in the table (-1 means no column sort)
//
//  Return:
//    tableId is sorted in place per the request
//
function sortFrcTables(tableId, teamCol, matchCol) {

  let tableRef = document.getElementById(tableId);
  let rows = Array.prototype.slice.call(tableRef.querySelectorAll("tbody > tr")); // All "tr" in <tbody>

  // Sort the rows based on column 1 match number
  if (matchCol !== -1) {
    rows.sort(function (rowA, rowB) {
      return (compareMatchNumbers(rowA.cells[matchCol].textContent, rowB.cells[matchCol].textContent));
    });
  }

  // Sort the rows based on column 1 match number
  if (teamCol !== -1) {
    rows.sort(function (rowA, rowB) {
      return (compareTeamNumbers(rowA.cells[teamCol].textContent, rowB.cells[teamCol].textContent));
    });
  }

  // Update the table body with the sorted rows.
  rows.forEach(function (row) {
    tableRef.querySelector("tbody").appendChild(row);
  });
}

//
//  Sort table by team number
//  Params:
//    tableId - the html ID of the <table> tag element
//    teamCol - the column number of the team numbers in the table
//  Return:
//    tableId is sorted in place by team number
//
function sortTableByTeam(tableId, teamCol) {
  sortFrcTables(tableId, teamCol, -1);
}

//
//  Sort table by match number
//  Params:
//    tableId - the html ID of the <table> tag element
//    matchCol - the column number of the match numbers in the table
//  Return:
//    tableId is sorted in place by match number
//
function sortTableByMatch(tableId, matchCol) {
  sortFrcTables(tableId, -1, matchCol);
}

//
//  Sort table by match number and team number
//  Params:
//    tableId - the html ID of the <table> tag element
//    teamCol - the column number of the team numbers in the table
//    matchCol - the column number of the match numbers in the table
//  Return:
//    tableId is sorted in place by match number and team number
//
function sortTableByMatchAndTeam(tableId, teamCol, matchCol) {
  sortFrcTables(tableId, teamCol, matchCol);
}
