let allProducers = null;
let connectedProducers = null;

const fetchAllProducersList = async() => {
    const res = await fetch(`${URL_ROOT}/producers/getAllProducersAsJson`);
    if (res.status === 200) {
        allProducers = await res.json();
        renderAllProducersList(allProducers);
    }
}

const fetchConnectedProducersList = async() => {
    const res = await fetch(`${URL_ROOT}/producers/getConnectedProducersAsJson`);
    if (res.status === 200) {
        connectedProducers = await res.json();
        renderConnectedProducersList(connectedProducers);
    }
}

const renderAllProducersList = (data) => {

    if (data == null) {
        tblManufacturers.innerHTML = renderMessageCard("Error fetching data");
        return;
    }

    if (data.length === 0) {
        tblManufacturers.innerHTML = renderMessageCard("No data to show");
        return;
    }

    let output = `
      <thead>
      <tr class="row">
          <th class="col-2"></th>
          <th class="col-2">Name</th>
          <th class="col-2">District</th>
          <th class="col-3">Cultivating Crops</th>
          <th class="col-3"></th>
      </tr>
      </thead>
      <tbody>`;

    data.forEach((element) => {
        let row = ` 
            <tr class = "row">
                <td class = "col-2 align-items-flex-end d-flex">
                    <div class="col-5 pt-1">
                         <img class="avatar m-auto" alt="User avatar" width="60%" height="60%"
                         src="${URL_ROOT}/img/user-avatars/${element.image_url}"/>
                     </div>
                </td>
                <td class = "col-2"> ${element.producer_name} </td>
                <td class = "col-2"> ${element.district} </td>
                <td class = "col-3"> ${element.crop_names} </td>
                <td class = "col-3 pr-5" >
                    <div class = "row justify-content-end align-items-center gap-1" >
                        <div class = "col-12" >
                            ${renderConnectBtn(element)}
                        </div>
                    </div>
                </td>  
            </tr> `;

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

    producersTable.innerHTML = output;
}

const renderConnectedProducersList = (data) => {

    if (data == null) {
        tblManufacturers.innerHTML = renderMessageCard("Error fetching data");
        return;
    }

    if (data.length === 0) {
        tblManufacturers.innerHTML = renderMessageCard("No data to show");
        return;
    }

    let output = `
      <thead>
      <tr class="row">
          <th class="col-1"></th>
          <th class="col-1">Producer ID</th>
          <th class="col-2">Name</th>
          <th class="col-2">Cultivating Crops</th>
          <th class="col-2">Address</th>
          <th class="col-2">Contact No.</th>
          <th class="col-2"></th>
      </tr>
      </thead>
      <tbody>`;

    data.forEach((element) => {
        let row = ` 
            <tr class = "row">
                <td class = "col-1 align-items-center justify-content-center d-flex pl-3">
                    <div class="pt-1">
                         <img class="avatar m-auto" alt="User avatar" width="60%" height="60%"
                         src="${URL_ROOT}/img/user-avatars/${element.image_url}"/>
                     </div>
                </td>
                <td class = "col-1"> ${element.producer_id} </td>
                <td class = "col-2"> ${element.producer_name} </td>
                <td class = "col-2" > ${element.crop_names} </td>
                <td class = "col-2" > ${element.address} </td>
                <td class = "col-2" > ${element.contact_no} </td>
                <td class="col-2 pr-4">
                <div class="row justify-content-end align-items-center gap-1">
                    <div class="col-6">
                        <a href="${URL_ROOT}/messages/${element.producer_id}"
                           class="btn-xs btn-outlined-primary-dark text-center">Message</a>
                    </div>
                    <div class="col-6">
                        <a href="${URL_ROOT}/connection-requests/remove/${element.producer_id}"
                           class="btn-xs btn-outlined-error-dark text-center">Remove</a>
                    </div>
                </div>
            </td>
            </tr> `;

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

    producersTable.innerHTML = output;
}

const renderConnectBtn = (element) => {
    let output = "";
    if (element.is_connected === "Accepted") {
        output = ` <a href="${URL_ROOT}/messages/${element.producer_id}"
              class="btn-xs btn-outlined-primary-dark text-center">Message</a> `;
    } else if (element.is_connected === "Pending") {
        output = `Pending`;
    }
    else {
        output = ` <a href = "${URL_ROOT}/connection-requests/send/${element.producer_id}"
            class = "btn-xs btn-outlined-primary-dark text-center">
                Connect
        </a> `;
    }
    return output;
}


document.addEventListener("DOMContentLoaded", () => {
    producersTable.innerHTML = renderMessageCard("Loading");
    fetchAllProducersList();
});

const btnAll = document.querySelector("#btn-all-producers");
const btnConnected = document.querySelector("#btn-connected-producers");
const producersTable = document.querySelector("#producers-table");

btnAll.addEventListener("click", () => {
    btnConnected.classList.remove('active-tab');
    btnAll.classList.add('active-tab');
    if (allProducers == null) {
        producersTable.innerHTML = renderMessageCard("Loading");
        fetchAllProducersList();
    } else {
        renderAllProducersList(allProducers);
    }
});

btnConnected.addEventListener("click", () => {
    btnAll.classList.remove('active-tab');
    btnConnected.classList.add('active-tab');
    if (connectedProducers == null) {
        producersTable.innerHTML = renderMessageCard("Loading");
        fetchConnectedProducersList();
    } else {
        renderConnectedProducersList(connectedProducers);
    }
});
