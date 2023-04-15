let data = null;

const fetchProducersList = async() => {
    const res = await fetch(`${URL_ROOT}/producers/getJsonForProducers`);
    if (res.status === 200) {
        data = await res.json();
        renderProducersList(data);
    }
}

const renderProducersList = (data) => {
    let output = "";

    if (data != null) {
        data.forEach((element) => {
            let row = ` 
            <tr class = "row">
                <td class = "col-2"> ${element.producer_id} </td>
                <td class = "col-4"> ${element.producer_name} </td>
                <td class = "col-4" > ${element.crop_names} </td>
                <td class = "col-2 pr-5" >
                    <div class = "row justify-content-end align-items-center gap-1" >
                        <div class = "col-12" >
                            ${renderConnectBtn(element)}
                        </div>
                    </div>
                </td>  
            </tr> `;

            output += row;
        });

        producersTable.innerHTML = output;
    } else {
        console.log("Error fetching data");
    }
}

const renderConnectBtn = (element) => {
    let output = "";
    if (element.is_connected === "Connected") {
        output = `Connected`
    } else if (element.is_connected === "Pending") {
        output = `Pending`;
    }
    else {
        output = ` <a href = "${URL_ROOT}/producer/sendConnectionRequest/${element.producer_id}"
            class = "btn-xs btn-outlined-primary-dark text-center">
                Connect
        </a> `;
    }
    return output;
}

document.addEventListener("DOMContentLoaded", () => fetchProducersList());
const btnAll = document.querySelector("#btn-all-producers");
const btnConnected = document.querySelector("#btn-connected-producers");
const producersTable = document.querySelector("#producers-table");

btnAll.addEventListener("click", () => {
    renderProducersList(data);
    btnConnected.classList.remove('active-page');
    btnConnected.classList.add('inactive-page');
    btnAll.classList.remove('inactive-page');
    btnAll.classList.add('active-page');
});

btnConnected.addEventListener("click", () => {
    renderProducersList(data.filter(element => {return element.is_connected === "Connected"}));
    btnAll.classList.remove('active-page');
    btnAll.classList.add('inactive-page');
    btnConnected.classList.remove('inactive-page');
    btnConnected.classList.add('active-page');
});
