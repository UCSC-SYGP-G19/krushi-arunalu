const fetchManufacturersList = async () => {
    const res = await fetch(`${URL_ROOT}/manufacturers/getManufacturersAsJson`);
    if (res.status === 200) {
        manufacturersList = await res.json();
        renderManufacturersTable(manufacturersList);
    }
}

const renderManufacturersTable = (data) => {
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
          <th class="col-2">Manufacturer ID</th>
          <th class="col-3">Name</th>
          <th class="col-3">Address</th>
          <th class="col-2">Contact No</th>
      </tr>
      </thead>
      <tbody>`;

    data.forEach((element) => {
        let row = `
        <tr class="row">
            <td class="col-2"><img
                    src="${URL_ROOT}/img/user-avatars/${element.image_url}"
                    width="72" class="m-2" alt="User avatar"/></td>
            <td class="col-2"> ${element.manufacturer_id}</td>
            <td class="col-3"> ${element.manufacturer_name}</td>
            <td class="col-3"> ${element.address}</td>
            <td class="col-2 pr-5"> ${element.contact_no}</td>
        </tr> `;

        output += row;
    });

    output += `</tbody>
  <tfoot>
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

let manufacturersList = null;

document.addEventListener("DOMContentLoaded", () => {
    tblManufacturers.innerHTML = renderMessageCard("Loading");
    fetchManufacturersList();
});

const tblManufacturers = document.querySelector("#manufacturers-table");
