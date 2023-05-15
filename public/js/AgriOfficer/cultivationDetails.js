let data = null;
let table = {}

const fetchCultivationDetailsList = async () => {
  const res = await fetch(`${URL_ROOT}/cultivation-details/getCultivationDetailsAsJson`);
  if (res.status === 200) {
    data = await res.json();
  } else {
    console.log("Error fetching data");
  }
}

const renderCultivationDetailsTable = (data) => {
  if (data == null) {
    CultivationsSection.innerHTML = renderMessageCard("Error fetching data");
    return;
  }

  if (data.length === 0) {
    CultivationsSection.innerHTML = renderMessageCard("No data to show");
    return;
  }

  console.log(data);


  table = {
    headers: [
      {key: "crop_name", label: "Crop", class: "col-3 p-2", sortable: true},
      {key: "cultivation_land_id", label: "Land ID", class: "col-1 p-2", sortable: true},
      {key: "land_area_in_acres", label: "Land area (acres)", class: "col-2 p-2", sortable: true},
      {key: "cultivation_cultivated_area", label: "Cultivated area (acres)", class: "col-2 p-2", sortable: true},
      {key: "cultivation_cultivated_date", label: "Cultivated date", class: "col-2 p-2", sortable: true},
      {key: "cultivation_expected_harvest_date", label: "Expected harvest date", class: "col-2 p-2", sortable: true},
    ],
    data: data,
    showSearchAndFilter: true,
    showPagination: true,
    showRowsPerPage: true,
    showSort: true,
    //primaryKey: "crop_name",
    //activeLink: "harvests",
    currentPage: 1,
    rowsPerPage: 10,
    activeSortField: "address",
    activeSortOrder: "desc",
    customBody: null,
    noContentMessage: "No data available",
    // actionLabels: ["Edit", "Delete"],
    // actionUrls: ["edit", "delete"],
  }

  renderTable(CultivationsSection, table);
}

const CultivationsSection = document.querySelector("#cultivations-section");

document.addEventListener("DOMContentLoaded", () => {
  CultivationsSection.innerHTML = renderMessageCard("Loading");
  fetchCultivationDetailsList().then(r => {
    renderCultivationDetailsTable(data);
  })
});
