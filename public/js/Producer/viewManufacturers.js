const fetchAllManufacturersList = async () => {
  const res = await fetch('http://localhost/krushi-arunalu/manufacturers/getAllManufacturersForProducerAsJson');
  if (res.status === 200) {
    allManufacturersList = await res.json();
  } else {
    allManufacturersList = null;
    console.log("Error fetching data");
  }
}

const fetchConnectedManufacturersList = async () => {
  const res = await fetch('http://localhost/krushi-arunalu/manufacturers/getConnectedManufacturersForProducerAsJson');
  if (res.status === 200) {
    connectedManufacturersList = await res.json();
    renderConnectedManufacturersTable(connectedManufacturersList);
  } else {
    connectedManufacturersList = null;
    console.log("Error fetching data");
  }
}

const renderConnectedManufacturersTable = (data) => {
  let output = `<thead>
                  <tr class="row">
                    <th class="col-1"></th>
                    <th class="col-1">Manufacturer ID</th>
                    <th class="col-2">Name</th>
                    <th class="col-4">Address</th>
                    <th class="col-2">Contact No.</th>
                    <th class="col-2"></th>
                  </tr>
                </thead>
                <tbody>`;

  data.forEach((element) => {
    let row = ` 
            <tr class="row">
                <td class="col-1"> <img src=${window.location.origin + "/krushi-arunalu/img/manufacturer/" + element.manufacturer_image_url} width="72" class="m-2"/> </td>
                <td class="col-1"> ${element.manufacturer_id} </td>
                <td class="col-2"> ${element.manufacturer_name} </td>
                <td class="col-4" > ${element.manufacturer_address} </td>
                <td class="col-2" > ${element.manufacturer_contact_no} </td>
                <td class="col-2 pr-5" >
                    <div class="row justify-content-end align-items-center gap-1" >
                        <div class="col-12" >
                            <a href="${window.location.href}/send-connection-requests/${element.manufacturer_id}"
            class="btn-xs btn-outlined-error-dark text-center">Remove</a> 
                        </div>
                    </div>
                </td>   
            </tr>`;

    output += row;
  });

  output += `</tbody>
  <tfoot>
    <tr class="row justify-content-end pagination">
        <td class="col-3 text-right"><span>Rows per page:</span>
            <label>
                <select name="table_filter" id="table_filter">
                    <option value="">10</option>
                </select>
            </label>
        </td>
        <td class="col-2">1-2 of 25
            <span class="arrow-icons">
                <span class="left-arrow">
                    <svg width="9" height="15" viewBox="0 0 9 15" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.10107 13.4121L1.10107 7.41211L7.10107 1.41211"
                          stroke="#B1B1B1" stroke-width="2" stroke-linecap="round"
                          stroke-linejoin="round"/>
                </svg>
                </span>

                <span class="right-arrow">
                    <svg width="9" height="15" viewBox="0 0 9 15" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.854 13.3516L7.854 7.35156L1.854 1.35156"
                          stroke="#B1B1B1" stroke-width="2" stroke-linecap="round"
                          stroke-linejoin="round"/>
                </svg>
                </span>
            </span>
        </td>
  </tfoot>`

  tblManufacturers.innerHTML = output;
}

const renderAllManufacturersTable = (data) => {
  let output = `<thead>
                  <tr class="row">
                    <th class="col-1"></th>
                    <th class="col-1">Manufacturer ID</th>
                    <th class="col-3">Name</th>
                    <th class="col-5">Description</th>
                    <th class="col-2"></th>
                    </tr>
                </thead><tbody>`;

  data.forEach((element) => {
    let row = ` 
            <tr class="row">
                <td class="col-1"> <img src=${window.location.origin + "/krushi-arunalu/img/manufacturer/" + element.manufacturer_image_url} width="72" class="m-2"/> </td>
                <td class="col-1"> ${element.manufacturer_id} </td>
                <td class="col-3"> ${element.manufacturer_name} </td>
                <td class="col-5" > ${element.manufacturer_description} </td>
                <td class="col-2 pr-5" >
                    <div class="row justify-content-end align-items-center gap-1" >
                        <div class="col-12" >
                            ${renderConnectionStatus(element)}
                        </div>
                    </div>
                </td>  
            </tr> `;

    output += row;
  });

  output += `</tbody><tfoot>
                                    <tr class="row justify-content-end pagination">
                                        <td class="col-3 text-right"><span>Rows per page:</span><label>
                                                <select name="table_filter" id="table_filter">
                                                    <option value="">10</option>
                                                </select>
                                            </label></td>
                                        <td class="col-2">1-2 of 25
                                            <span class="arrow-icons">
                                                <span class="left-arrow">
                                                    <svg width="9" height="15" viewBox="0 0 9 15" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M7.10107 13.4121L1.10107 7.41211L7.10107 1.41211"
                                                          stroke="#B1B1B1" stroke-width="2" stroke-linecap="round"
                                                          stroke-linejoin="round"/>
                                                </svg>
                                                </span>

                                                <span class="right-arrow">
                                                    <svg width="9" height="15" viewBox="0 0 9 15" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1.854 13.3516L7.854 7.35156L1.854 1.35156"
                                                          stroke="#B1B1B1" stroke-width="2" stroke-linecap="round"
                                                          stroke-linejoin="round"/>
                                                </svg>
                                                </span>
                                            </span>
                                        </td>
                                    </tfoot>`

  tblManufacturers.innerHTML = output;
}

const renderConnectionStatus = (element) => {
  if (element.request_status == null) {
    return ` <a href="${window.location.href}/send-connection-requests/${element.manufacturer_id}"
            class="btn-xs btn-outlined-primary-dark text-center">
                Connect
        </a> `;
  }
  return element.request_status;
}


let allManufacturersList = null;
let connectedManufacturersList = null;

document.addEventListener("DOMContentLoaded", () => {
  fetchAllManufacturersList().then(r => {
    renderAllManufacturersTable(allManufacturersList);
  })
});
const btnAll = document.querySelector("#btn-all-manufacturers");
const btnConnected = document.querySelector("#btn-connected-manufacturers");
const tblManufacturers = document.querySelector("#manufacturers-table");

btnAll.addEventListener("click", () => {
  btnConnected.classList.remove('active-tab');
  btnAll.classList.add('active-tab');
  if (allManufacturersList == null) {
    tblManufacturers.innerHTML = `<tbody><tr class="py-3"><td class="p-3">Loading</td></tr></tbody>`;
    fetchAllManufacturersList().then(r => {
      renderAllManufacturersTable(allManufacturersList);
    });
  } else {
    renderAllManufacturersTable(allManufacturersList);
  }
});

btnConnected.addEventListener("click", () => {
  btnConnected.classList.add('active-tab');
  btnAll.classList.remove('active-tab');
  if (connectedManufacturersList == null) {
    tblManufacturers.innerHTML = `<tbody><tr class="py-3"><td class="p-3">Loading</td></tr></tbody>`;
    fetchConnectedManufacturersList().then(r => {
      renderConnectedManufacturersTable(connectedManufacturersList);
    });
  } else {
    renderConnectedManufacturersTable(connectedManufacturersList);
  }

});
