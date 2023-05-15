let data = null;
let table = {}

const fetchCultivationsList = async () => {
  const res = await fetch(`${URL_ROOT}/cultivations/getMyCultivationsAsJson`);
  if (res.status === 200) {
    data = await res.json();
  } else {
    console.log("Error fetching data");
  }
}

const renderCultivationsTable = (data) => {
  if (data == null) {
    cultivationsTable.innerHTML = renderMessageCard("Error fetching data");
    return;
  }

  if (data.length === 0) {
    cultivationsTable.innerHTML = renderMessageCard("No data to show");
    return;
  }

  console.log(data);

  table = {
    headers: [
      {key: "land_name", label: "Land name", class: "col-2", sortable: true},
      {key: "status", label: "Status", class: "col-1", sortable: false},
      {key: "crop_name", label: "Crop name", class: "col-2", sortable: false},
      {key: "cultivated_area", label: "Cultivated area", class: "col-1", sortable: true},
      {key: "cultivated_date", label: "Cultivated date", class: "col-2", sortable: true},
      {key: "expected_harvest_date", label: "Expected harvest date", class: "col-2", sortable: true},
      {key: "actions", label: "", class: "col-2", sortable: false},
    ],
    data: data,
    showSearchAndFilter: true,
    showPagination: true,
    showRowsPerPage: true,
    showSort: true,
    primaryKey: "cultivation_id",
    activeLink: "cultivations",
    currentPage: 1,
    rowsPerPage: 10,
    activeSortField: "cultivated_date",
    activeSortOrder: "desc",
    customBody: null,
    noContentMessage: "No data available",
    actionLabels: ["Edit", "Delete"],
    actionUrls: ["edit", "delete"],
  }

  renderTable(cultivationsTable, table);
}

const cultivationsTable = document.querySelector("#cultivations-section");

document.addEventListener("DOMContentLoaded", () => {
  cultivationsTable.innerHTML = renderMessageCard("Loading");
  fetchCultivationsList().then(r => {
    renderCultivationsTable(data);
  })
});
