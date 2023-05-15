let producers = null;

const fetchAllProducersList = async () => {
    const res = await fetch(`${URL_ROOT}/producers/getProducersAsJson`);
    if (res.status === 200) {
        producers = await res.json();
        renderAllProducersList(producers);
    }
}

const renderAllProducersList = (data) => {

    if (data == null) {
        producersTable.innerHTML = renderMessageCard("Error fetching data");
        return;
    }

    if (data.length === 0) {
        producersTable.innerHTML = renderMessageCard("No data to show");
        return;
    }

    let output = `
      <thead>
      <tr class="row">
          <th class="col-2"></th>
          <th class="col-2">Name</th>
          <th class="col-2">District</th>
          <th class="col-4">Cultivating Crops</th>
          <th class="col-2">Contact Number</th>
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
                <td class = "col-4"> ${element.crop_names} </td>
                <td class = "col-2">${element.contact_no}</td>
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

document.addEventListener("DOMContentLoaded", () => {
    producersTable.innerHTML = renderMessageCard("Loading");
    fetchAllProducersList();
});

const producersTable = document.querySelector("#producers-table");

