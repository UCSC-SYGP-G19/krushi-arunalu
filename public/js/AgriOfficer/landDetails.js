let data = null;
let table = {}

const fetchLandDetailsList = async () => {
    const res = await fetch(`${URL_ROOT}/land-details/getLandDetailsAsJson`);
    if (res.status === 200) {
        data = await res.json();
    } else {
        console.log("Error fetching data");
    }
}

const renderLandDetailsTable = (data) => {
    if (data == null) {
        landsSection.innerHTML = renderMessageCard("Error fetching data");
        return;
    }

    if (data.length === 0) {
        landsSection.innerHTML = renderMessageCard("No data to show");
        return;
    }

    console.log(data);

    table = {
        headers: [
            {key: "id", label: "Land Id", class: "col-3", sortable: true},
            {key: "name", label: "Owner name", class: "col-3 p-2", sortable: true},
            {key: "address", label: "Address", class: "col-3", sortable: true},
            {key: "contact_no", label: "Contact no", class: "col-3", sortable: false},
        ],
        data: data,
        showSearchAndFilter: true,
        showPagination: true,
        showRowsPerPage: true,
        showSort: true,
        currentPage: 1,
        rowsPerPage: 10,
        activeSortField: "address",
        activeSortOrder: "desc",
        customBody: null,
        noContentMessage: "No data available",
        // actionLabels: ["Edit", "Delete"],
        // actionUrls: ["edit", "delete"],
    }

    renderTable(landsSection, table);
}

const landsSection = document.querySelector("#lands-section");

document.addEventListener("DOMContentLoaded", () => {
    landsSection.innerHTML = renderMessageCard("Loading");
    fetchLandDetailsList().then(r => {
        renderLandDetailsTable(data);
    })
});
