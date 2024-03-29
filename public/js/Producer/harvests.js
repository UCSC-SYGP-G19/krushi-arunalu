let data = null;
let table = {}

const fetchHarvestsList = async () => {
  const res = await fetch(`${URL_ROOT}/harvests/getMyHarvestsAsJson`);
  if (res.status === 200) {
    data = await res.json();
  } else {
    console.log("Error fetching data");
  }
}

// renderOptionsBar = () => {
//   return `<div class="row table-controls gap-1">
//     <div class="col-8">
//         <label>
//             <input type="text" placeholder="Search" class="with-search-icon"/>
//         </label>
//     </div>
//     <div class="col-2">
//         <label>
//             <select name="table_filter" id="table_filter" class="with-filter-icon">
//                 <option value="">Filter</option>
//             </select>
//         </label>
//     </div>
//     <div class="col-2">
//         <label>
//             <select name="table_sort" id="table_sort" class="with-sort-icon">
//                 <option value="">Sort</option>
//             </select>
//         </label>
//     </div>
// </div>`;
// }

// const renderActions = (element) => {
//   const editUrl = `"${URL_ROOT}/harvests/edit/${element.harvest_id}"`
//   const deleteUrl = `"${URL_ROOT}/harvests/delete/${element.harvest_id}"`
//
//   return `
//       <div class='col'>
//         <button class='btn-xs btn-outlined-secondary text-center' onclick='handleEditClick(${editUrl})'> Edit </button>
//       </div>
//       <div class='col'>
//         <button class='btn-xs btn-outlined-error-dark text-center' onclick='handleDeleteClick(${deleteUrl})'> Delete</button>
//       </div>`;
// }

const renderHarvestsTable = (data) => {
  if (data == null) {
    harvestsSection.innerHTML = renderMessageCard("Error fetching data");
    return;
  }

  if (data.length === 0) {
    harvestsSection.innerHTML = renderMessageCard("No data to show");
    return;
  }

  console.log(data);

  // let output = `
  // ${renderOptionsBar()}
  // <table>
  //     <thead>
  //     <tr class="row">
  //         <th class="col-2">Harvested date</th>
  //         <th class="col-2">Crop name</th>
  //         <th class="col-2">Harvested quantity</th>
  //         <th class="col-2">Remaining quantity</th>
  //         <th class="col-2">Expected price</th>
  //         <th class="col-2"></th>
  //     </tr>
  //     </thead>
  //     <tbody>`;
  //
  // data.forEach((element) => {
  //   let row = `
  //       <tr class="row">
  //           <td class="col-2">${element.harvested_date}</td>
  //           <td class="col-2"> ${element.crop_name}</td>
  //           <td class="col-2"> ${element.harvested_quantity}</td>
  //           <td class="col-2"> ${element.remaining_quantity}</td>
  //           <td class="col-2"> ${element.expected_price}</td>
  //           <td class="col-2 pr-5">
  //               <div class="row justify-content-end align-items-center gap-1">
  //                       ${renderActions(element)}
  //               </div>
  //           </td>
  //       </tr> `;
  //
  //   output += row;
  // });
  //
  // output += `</tbody>
  //
  // <tfoot>
  // <tr class="row justify-content-end pagination">
  //     <td class="col-3 text-right"><span>Rows per page:</span><label>
  //         <select name="table_filter" id="table_filter">
  //             <option value="">10</option>
  //         </select>
  //     </label></td>
  //     <td class="col-2">1-2 of 25
  //         <span class="arrow-icons">
  //               <span class="left-arrow">
  //                   <svg width="9" height="15" viewBox="0 0 9 15" fill="none"
  //                        xmlns="http://www.w3.org/2000/svg">
  //                   <path d="M7.10107 13.4121L1.10107 7.41211L7.10107 1.41211"
  //                         stroke="#B1B1B1" stroke-width="2" stroke-linecap="round"
  //                         stroke-linejoin="round"/>
  //               </svg>
  //               </span>
  //
  //               <span class="right-arrow">
  //                   <svg width="9" height="15" viewBox="0 0 9 15" fill="none"
  //                        xmlns="http://www.w3.org/2000/svg">
  //                   <path d="M1.854 13.3516L7.854 7.35156L1.854 1.35156"
  //                         stroke="#B1B1B1" stroke-width="2" stroke-linecap="round"
  //                         stroke-linejoin="round"/>
  //               </svg>
  //               </span>
  //         </span>
  //     </td>
  // </tfoot></table>`

  table = {
    headers: [
      {key: "harvested_date", label: "Harvested date", class: "col-2", sortable: true},
      {key: "crop_name", label: "Crop name", class: "col-2", sortable: true},
      {key: "harvested_quantity", label: "Harvested quantity", class: "col-2", sortable: false},
      {key: "remaining_quantity", label: "Remaining quantity", class: "col-2", sortable: false},
      {key: "expected_price", label: "Expected price", class: "col-2", sortable: true},
      {key: "actions", label: "", class: "col-2", sortable: false},
    ],
    data: data,
    showSearchAndFilter: true,
    showPagination: true,
    showRowsPerPage: true,
    showSort: true,
    primaryKey: "harvest_id",
    activeLink: "harvests",
    currentPage: 1,
    rowsPerPage: 10,
    activeSortField: "harvested_date",
    activeSortOrder: "desc",
    customBody: null,
    noContentMessage: "No data available",
    actionLabels: ["Edit", "Delete"],
    actionUrls: ["edit", "delete"],
  }

  renderTable(harvestsSection, table);
}

const harvestsSection = document.querySelector("#harvests-section");

document.addEventListener("DOMContentLoaded", () => {
  harvestsSection.innerHTML = renderMessageCard("Loading");
  fetchHarvestsList().then(r => {
    renderHarvestsTable(data);
  })
});
