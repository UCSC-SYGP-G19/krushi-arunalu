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
            {key: "crop_name", label: "CROP", class: "col-3", sortable: true},
            {key: "land_id", label: "Land Id", class: "col-1", sortable: true},
            {key: "cultivated_area", label: "Cultivated Area", class: "col-2", sortable: true},
            {key: "cultivated_date", label: "Cultivation Start Date", class: "col-3", sortable: true},
            {key: "expected_harvest_date", label: "Expected Harvest Date", class: "col-3", sortable: true},
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