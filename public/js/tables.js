function renderTable(DOMElement, table) {

  let html = "";
  if (table.showSearchAndFilter) {
    html += generateSearchAndFilter();
  }
  html += "<table>";
  html += generateTableHeader(table.headers);
  if (table.customBody === null) {
    html += generateTableBody(table);
  } else {
    html += table.customBody;
  }
  if (table.showPagination) {
    html += generateTableFooter(table);
  }
  html += "</table>";
  DOMElement.innerHTML = html;
  if (!table.showPagination) {
    DOMElement.querySelector("tbody tr:last-child").classList.add("table-end");
  }
  updateSortArrows(table.activeSortField, table.activeSortOrder);

  document.querySelector("#table-pagination-length-selector").value = table.rowsPerPage;
  document.querySelector("#table-pagination-length-selector").addEventListener("change", (e) => {
    table.rowsPerPage = e.target.value;
    renderTable(document.querySelector(`#${table.activeLink}-section`), table);
  });

  updatePagination(table);
}

// Updater functions
function updatePagination(table, rowCount) {
  if(rowCount === undefined) {
    rowCount = table.data.length;
  }
  if(rowCount < table.rowsPerPage) {
    document.querySelector("#table-pagination-length-selector").disabled = true;
  }else{
    document.querySelector("#table-pagination-length-selector").disabled = false;
  }
  const paginationCurrentRange = document.querySelector("#pagination-current-range");
  const paginationTotalRows = document.querySelector("#pagination-total-rows");

  let start = table.currentPage === 1 ? 1 : (table.currentPage - 1) * table.rowsPerPage + 1;
  let end = table.currentPage * table.rowsPerPage;
  if (rowCount < end) {
    end = rowCount;
  }

  paginationCurrentRange.innerText = `${start} - ${end}`;
  paginationTotalRows.innerText = rowCount;

  const paginationArrows = document.querySelectorAll(".pagination .arrow-icons span");
  paginationArrows.forEach((arrow) => {
    arrow.classList.remove("disabled");
  });
  if (table.currentPage === 1) {
    document.querySelector(".pagination .arrow-icons .left-arrow").classList.add("disabled");
  }
  if (table.currentPage > (rowCount / table.rowsPerPage)) {
    document.querySelector(".pagination .arrow-icons .right-arrow").classList.add("disabled");
  }

  // hide rows according to pagination
  const tableRows = document.querySelectorAll("tbody tr[data-filtered='false']");
  tableRows.forEach((row, index) => {
    if (index < start - 1 || index > end - 1) {
      row.style.display = "none";
    } else {
      if(row.getAttribute("data-filtered") !== "true") {
        row.style.display = "";
      }
    }
  });
}

function updateSortArrows(activeSortField, activeSortOrder) {
  const activeSortArrows = document.querySelector(`#sort_${activeSortField}`);
  if (activeSortArrows) {
    const allSortArrowIcons = document.querySelectorAll(".sort-arrows svg");
    allSortArrowIcons.forEach((icon) => {
      icon.classList.remove("active");
    });
    if (activeSortOrder === "asc") {
      activeSortArrows.setAttribute("datasrc", "asc");
      activeSortArrows.querySelector(".up-arrow").classList.add("active");
    } else {
      activeSortArrows.setAttribute("datasrc", "desc");
      activeSortArrows.querySelector(".down-arrow").classList.add("active");
    }
  }

}

// Functions to generate HTML elements
function generateTableHeader(tableHeaders) {
  let html = "<thead>";
  html += "<tr class='row'>";
  for (const [key, value] of Object.entries(tableHeaders)) {
    html += `<th class='${value.class}'>${value.label}`;
    html += generateSortArrows(value);
    html += `</th>`;
  }
  html += "</tr>";
  html += "</thead>";
  return html;
}

function generateTableBody(table) {
  let html = "<tbody>";
  if (table.data.length > 0) {
    for (const row of table.data) {
      html += "<tr class='row'>";
      for (const [key, value] of Object.entries(table.headers)) {
        if (row.hasOwnProperty(value.key)) {
          html += `<td class='${table.headers[key].class}' data-key='${table.headers[key].key}'>${row[value.key]}</td>`;
        } else {
          if (value.key === "actions") {
            html += `<td class='${table.headers[key].class}'>
                      <div class='row justify-content-center align-items-center gap-1'>
                          ${generateEditDeleteActions(row, table.activeLink, table.actionLabels, table.actionUrls, table.primaryKey)}
                      </div>
                    </td>`;
          } else {
            html += `<td class='${table.headers[key].class}'></td>`;
          }
        }
      }
      html += "</tr>";
    }
  } else {
    html += `<tr class='no-content'><td class='col-12 text-center py-4'>${table.noContentMessage}</td></tr>`;
  }
  html += "</tbody>"
  return html;
}

function generateTableFooter(table) {
  let html = "";
  if (table.data.length > 0) {
    html += "<tfoot>";
    html += "<tr class='row justify-content-end pagination' data-filtered='false'>";
    if (table.showRowsPerPage) {
      html += `<td class='col-3 text-right'><span>Rows per page:</span>
                                        <label>
                                            <select name='table_filter' id="table-pagination-length-selector">
                                                <option value='5' ${table.data.length < 5 && "disabled"}>5</option>
                                                <option value='10' ${table.data.length < 10 && "disabled"}>10</option>
                                                <option value='25' ${table.data.length < 25 && "disabled"}>25</option>
                                                <option value='50' ${table.data.length < 50 && "disabled"}>50</option>
                                                <option value='100' ${table.data.length < 100 && "disabled"}>100</option>
                                            </select>
                                        </label>
                                    </td>`;
    }
    html += `<td class='col-2'><span id="pagination-current-range"></span> of <span id="pagination-total-rows"></span>
                    <span class='arrow-icons'>
                      <span class='left-arrow' onclick="handlePaginationLeftClick()">
                          <svg width='9' height='15' viewBox='0 0 9 15' fill='none'
                          xmlns='http://www.w3.org/2000/svg'>
                              <path d='M7.10107 13.4121L1.10107 7.41211L7.10107 1.41211'
                                  stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/>
                          </svg>
                      </span>
              
                      <span class='right-arrow' onclick="handlePaginationRightClick()">
                          <svg width='9' height='15' viewBox='0 0 9 15' fill='none'
                              xmlns='http://www.w3.org/2000/svg'>
                                  <path d='M1.854 13.3516L7.854 7.35156L1.854 1.35156'
                                      stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/>
                          </svg>
                      </span>
                    </span>
             </td>`;
    html += "</tr>";
    html += "</tfoot>";
  }
  return html;
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

function generateSortArrows(element) {
  console.log(element);
  if (element.sortable) {
    return `<span class="sort-arrows mx-2" id="sort_${element.key}" datasrc="null" onclick="handleSortArrowsClick('${element.key}')">
              <svg class="up-arrow" width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M9 5L5 1L1 5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              <svg class="down-arrow" width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M1 0.999999L5 5L9 1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </span>`;
  }
  return "";
}

// Handler functions
function handlePaginationLeftClick() {
  if (table.currentPage > 1) {
    table.currentPage--;
  }
  updatePagination(table);
}

function handlePaginationRightClick() {
  if (table.currentPage < table.data.length) {
    table.currentPage++;
  }
  updatePagination(table);
}

function handleSortArrowsClick(key) {
  const sortArrows = document.querySelector(`#sort_${key}`);
  const sortDirection = sortArrows.getAttribute("datasrc");
  const newSortDirection = sortDirection === "asc" ? "desc" : "asc";
  sortArrows.setAttribute("datasrc", newSortDirection);
  updateSortArrows(key, newSortDirection);
  console.log(key, newSortDirection);
  handleSort(key, newSortDirection);
}

function handleSort(key, sortDirection) {
  const tableBody = document.querySelector("tbody");
  const tableRows = tableBody.querySelectorAll("tr");
  const sortedRows = Array.from(tableRows).sort((a, b) => {
    const aVal = a.querySelector(`td[data-key=${key}]`).innerText;
    const bVal = b.querySelector(`td[data-key=${key}]`).innerText;
    if (sortDirection === "asc") {
      return aVal.localeCompare(bVal);
    } else {
      return bVal.localeCompare(aVal);
    }
  });
  tableBody.innerHTML = "";
  sortedRows.forEach((row) => {
    tableBody.appendChild(row);
  });
  updatePagination(table);
}

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
      row.setAttribute("data-filtered", "false");
      resultCount++;
    } else {
      row.style.display = "none";
      row.setAttribute("data-filtered", "true");
    }
  }
  updatePagination(table, resultCount);
}
