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
            <input type="text" placeholder="Search" class="with-search-icon" id="table-search-box" onkeyup="handleTableSearchType()"/>
        </label>
    </div>
    <div class="col-2">
        <button name="table_filter" id="table_filter" class="with-filter-icon" onclick="handleFiltersClick()" value="show">
                <span class="icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10 5H4" stroke="black" stroke-width="1.5" stroke-linecap="round"/>
                <path d="M14 5H20" stroke="black" stroke-width="1.5" stroke-linecap="round"/>
                <path d="M16 12H4" stroke="black" stroke-width="1.5" stroke-linecap="round"/>
                <path d="M8 19H20" stroke="black" stroke-width="1.5" stroke-linecap="round"/>
                <path d="M8 19C8 17.8954 7.10457 17 6 17C4.89543 17 4 17.8954 4 19C4 20.1046 4.89543 21 6 21C7.10457 21 8 20.1046 8 19Z" stroke="black" stroke-width="1.5" stroke-linecap="round"/>
                <path d="M20 12C20 10.8954 19.1046 10 18 10C16.8954 10 16 10.8954 16 12C16 13.1046 16.8954 14 18 14C19.1046 14 20 13.1046 20 12Z" stroke="black" stroke-width="1.5" stroke-linecap="round"/>
                <path d="M14 5C14 3.89543 13.1046 3 12 3C10.8954 3 10 3.89543 10 5C10 6.10457 10.8954 7 12 7C13.1046 7 14 6.10457 14 5Z" stroke="black" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
                </span>
                <span class="text pl-1">Show filters</span>
        </button>
    </div>
<!--    <div class="col-2">-->
<!--        <label>-->
<!--            <select name="table_sort" id="table_sort" class="with-sort-icon">-->
<!--                <option value="">Sort</option>-->
<!--            </select>-->
<!--        </label>-->
<!--    </div>-->
<div class="col-12" id="filters-panel" style="display: none">
<h4 class="p-2 fw-normal text-center text-gold"><em>No filters available</em></h4>
</div>
</div>`
}

// filter the data array and pass to generateTableBodyFunction
// function handleTableSearchType() {
//   const searchBox = document.getElementById("table-search-box");
//   const tableBody = document.querySelector("tbody");
//   const tableHeaders = document.querySelectorAll("thead th");
//   const tableData = JSON.parse(tableBody.dataset.tableData);
//   const activeLink = tableBody.dataset.activeLink;
//   const primaryKey = tableBody.dataset.primaryKey;
//   const noContentMessage = tableBody.dataset.noContentMessage;
//   const actionLabels = tableBody.dataset.actionLabels;
//   const actionUrls = tableBody.dataset.actionUrls;
//
//   const filteredData = tableData.filter((row) => {
//     for (const [key, value] of Object.entries(row)) {
//       if (value.toString().toLowerCase().includes(searchBox.value.toLowerCase())) {
//         return true;
//       }
//     }
//     return false;
//   });
//   tableBody.innerHTML = generateTableBody(tableHeaders, filteredData, activeLink, actionLabels, actionUrls, primaryKey, noContentMessage);
//
// }

function handleFiltersClick() {
  const filterButton = document.querySelector("#table_filter");
  const filtersPanel = document.querySelector("#filters-panel");
  if (filterButton.value === "show") {
    filterButton.value = "hide";
    filterButton.querySelector(".icon").style.display = "none";
    filterButton.querySelector(".text").innerHTML = "Hide filters";
    filtersPanel.style.display = "block";
  } else {
    filterButton.value = "show";
    filterButton.querySelector(".icon").style.display = "inline-block";
    filterButton.querySelector(".text").innerHTML = "Show filters";
    filtersPanel.style.display = "none";
  }
}

function handleTableSearchType() {
  const tableRows = document.querySelectorAll("tbody tr");
  const searchBox = document.querySelector("#table-search-box");
  const searchValue = searchBox.value.toLowerCase();
  let resultCount = 0;
  for (const row of tableRows) {
    const rowText = row.innerText.toLowerCase();
    if (rowText.indexOf(searchValue) > -1) {
      row.style.display = "";
      resultCount++;
    } else {
      row.style.display = "none";
    }
  }
  const pagination = document.querySelector("tfoot .pagination");
  pagination.innerHTML = `<td class='col-3 text-right'><span>Rows per page:</span>
                                        <label> 
                                            <select name='table_filter' id='table_filter'>
                                                <option value=''>${resultCount}</option>
                                            </select>
                                        </label>
                                    </td>
                                    <td class='col-2'>1-${resultCount} of ${resultCount}</td>`;
  
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
