function renderTable(DOMElement,
                     showSearchAndFilter = false,
                     activeLink,
                     tableHeaders,
                     tableData, primaryKey = "id",
                     noContentMessage = "No data available",
                     actionLabels = ["Edit", "Delete"],
                     actionUrls = ["edit", "delete"]) {

  let html = "";
  if (showSearchAndFilter) {
    html += generateSearchAndFilter();
  }
  html += "<table>";
  html += "<thead>";
  html += "<tr class='row'>";
  for (const [key, value] of Object.entries(tableHeaders)) {
    html += `<th class='${value.class}'>${value.label}</th>`;
  }
  html += "</tr>";
  html += "</thead>";
  html += generateTableBody(tableHeaders, tableData, activeLink, actionLabels, actionUrls, primaryKey);
  if (tableData.length > 0) {
    html += "<tfoot>";
    html += "<tr class='row justify-content-end pagination'>";
    html += `<td class='col-3 text-right'><span>Rows per page:</span>
                                        <label>
                                            <select name='table_filter' id='table_filter'>
                                                <option value=''>${tableData.length}</option>`;
    html += "</select></label></td>";
    html += `<td class='col-2'>1-${tableData.length} of ${tableData.length}</td>`;
    html += "</tr>";
    html += "</tfoot>";
  }

  html += "</table>";
  DOMElement.innerHTML = html;
}

function generateEditDeleteActions(element, activeLink, actionLabels, actionUrls, primaryKey) {
  const editUrl = `"${URL_ROOT}/${activeLink}/${actionUrls[0]}/${element[primaryKey]}"`
  const deleteUrl = `"${URL_ROOT}/${activeLink}/${actionUrls[1]}/${element[primaryKey]}"`

  return `
      <div class='col'>
        <button class='btn-xs btn-outlined-secondary text-center' onclick='handleEditClick(${editUrl})'>${actionLabels[0]}</button>
      </div>
      <div class='col'>
        <button class='btn-xs btn-outlined-error-dark text-center' onclick='handleDeleteClick(${deleteUrl})'>${actionLabels[1]}</button>
      </div>`;
}

function generateSearchAndFilter() {
  return `<div class="row table-controls gap-1">
    <div class="col-10">
        <label>
            <input type="text" placeholder="Search" class="with-search-icon" id="table-search-box"/>
        </label>
    </div>
    <div class="col-2">
        <button name="table_filter" id="table_filter" class="with-filter-icon">
                Show filters
        </button>
    </div>
<!--    <div class="col-2">-->
<!--        <label>-->
<!--            <select name="table_sort" id="table_sort" class="with-sort-icon">-->
<!--                <option value="">Sort</option>-->
<!--            </select>-->
<!--        </label>-->
<!--    </div>-->
</div>`
}

function generateTableBody(tableHeaders, tableData, activeLink, actionLabels, actionUrls, primaryKey, noContentMessage) {
  let html = "<tbody>";
  if (tableData.length > 0) {
    for (const row of tableData) {
      html += "<tr class='row'>";
      for (const [key, value] of Object.entries(tableHeaders)) {
        if (row.hasOwnProperty(value.key)) {
          html += `<td class='${tableHeaders[key].class}'>${row[value.key]}</td>`;
        } else {
          if (value.key === "actions") {
            html += `<td class='${tableHeaders[key].class}'>
                      <div class='row justify-content-center align-items-center gap-1'>
                          ${generateEditDeleteActions(row, activeLink, actionLabels, actionUrls, primaryKey)}
                      </div>
                    </td>`;
          } else {
            html += `<td class='${tableHeaders[key].class}'></td>`;
          }
        }
      }
      html += "</tr>";
    }
  } else {
    html += `<tr class='no-content'><td class='col-12 text-center py-4'>${noContentMessage}</td></tr>`;
  }
  html += "</tbody>"
  return html;
}
