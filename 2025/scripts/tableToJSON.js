/*
  Global Variable Definition
*/

/*
  Function Definition
*/

//
//  Accept a table ID tag and return the JSON object
//
//  Return:
//    JSON object representing the table
//
function tableToJSON(tableId) {
  const table = document.getElementById(tableId);
  const headers = Array.from(table.querySelectorAll('th')).map(th => th.textContent.trim());
  const rows = Array.from(table.querySelectorAll('tr')).slice(1); // Skip header row

  // Scan HTML table and covert to JSON
  return rows.map(row => {
    const cells = Array.from(row.querySelectorAll('td'));
    return headers.reduce((obj, header, index) => {
      obj[header] = cells[index]?.textContent.trim() || "";
      return obj;
    }, {});
  });
};
