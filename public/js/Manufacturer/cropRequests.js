let cropRequests = null;
let responseList = null;

const fetchCropRequests = async () => {
  const res = await fetch(`${URL_ROOT}/manufacturer-crop-requests/getRequestsAsJson`);
  if (res.status === 200) {
    cropRequests = await res.json();
    renderCropRequests(cropRequests);
  }
}

const fetchResponses = async (cropRequestId) => {
  const res = await fetch(`${URL_ROOT}/manufacturer-crop-requests/getResponsesAsJson/` + cropRequestId);
  if (res.status === 200) {
    responseList[cropRequestId] = await res.json();
  }
}

const fetchAndRenderResponses = async (cropRequestId) => {
  const responsesListNode = document.querySelector(`#crop-request-${cropRequestId}`).querySelector('.request-responses-list');
  if (responseList == null) {
    responseList = {};
  }
  if (!(cropRequestId in responseList)) {
    await fetchResponses(cropRequestId);
  }
  renderResponses(responsesListNode, responseList[cropRequestId]);
}

const renderPricesLine = (element) => `
    <div>
        <span class="pr-1">Expected price range: </span>
        <span class="fw-bold">Rs. ${element.low_price} to Rs. ${element.high_price} per unit</span>
    </div>`;

const renderResponseInfoLine = (element) => `
    <div class="fs-3"><span
            class="text-primary-light fw-bold pr-1">${element.response_count} response${element.response_count !== 1 ? "s" : ""} - </span>
        <span class="badge badge-light-green text-black fw-bold px-2 mt-0 mb-1">
            ${element.fulfilled_quantity} KG fulfilled / ${element.required_quantity} KG required
        </span>
    </div>`;


const viewCropRequests = (e) => {
  const cropRequestCard = document.querySelector(`#crop-request-${e}`);
  if (cropRequestCard.getAttribute("datatype") === "collapsed") {
    cropRequestCard.setAttribute("datatype", "expanded");
    const currentCropRequest = cropRequests.find(r => r.id === e);
    cropRequestCard.querySelector(".third-line").innerHTML = renderPricesLine(currentCropRequest);
    cropRequestCard.innerHTML += renderExpandedSection(currentCropRequest);
    fetchAndRenderResponses(e);
  } else {
    cropRequestCard.setAttribute("datatype", "collapsed");
    cropRequestCard.querySelector(".third-line").innerHTML = renderResponseInfoLine(cropRequests.find(r => r.id === e));
    cropRequestCard.querySelector(".expanded-section").remove();
  }
}

const renderCropRequests = (data) => {
  let output = "";

  if (data != null) {
    if (data.length === 0) {
      output = renderMessageCard("No crop requests");
    } else {
      data.forEach((element) => {
        let row = `
            <div class="crop-request-card p-3 px-4 mb-3" id="crop-request-${element.id}" datatype="collapsed">
                <div class="row clickable" onclick="viewCropRequests(${element.id})">
                    <div class="col-1">
                        <div class="image-window">
                            <img alt="Image" height="100%" width="100%"
                                 src="${URL_ROOT}/public/img/crops/${element.image_url}">
                        </div>
                    </div>
                    <div class="col-8 pt-1 px-4">
                        <div class="row">
                            <div class="col-12 fs-4">
                                <h4 class="text-black">
                                    <span class="fw-bold">${element.crop_name}</span>
                                    <span class="fw-normal"> - ${element.required_quantity} KG</span>
                                </h4>
                            </div>
                            <div class="col-12 fs-3 text-grey-dark pt-1">
                                <span class="pr-1">Requested on: </span>
                                <span class="fw-bold">${element.posted_date_time}</span>
                                <span class="px-1"> | Required on: </span>
                                <span class="fw-bold">${element.required_date}</span>
                            </div>
                            
                            <div class="col-12 pt-2 fs-3 third-line">
                                ${renderResponseInfoLine(element)}
                            </div>

                        </div>

                    </div>
                    <div class="col-3 py-3 justify-content-end align-items-baseline d-flex px-3">
                            <a class="btn-xs btn-outlined-secondary mr-1 edit-button"
                                href="${URL_ROOT}/manufacturerCropRequests/edit/${element.id}">
                                   Edit
                            </a>
                            <a class="btn-xs btn-outlined-error ml-1 delete-button"
                                href="${URL_ROOT}/manufacturerCropRequests/delete/${element.id}">
                                    Delete
                            </a>
                    </div>
                </div>
            </div>
        `;
        output += row;
      });
      requestList.innerHTML = output;
    }
  } else {
    output = renderMessageCard("Error fetching data");
  }
  requestList.innerHTML = output;
}

const renderResponses = (node, data) => {
  let output = "";

  if (data != null) {
    if (data.length === 0) {
      output = renderMessageCard("No responses to show");
    } else {
      data.forEach((element) => {
        let row = `
            <div class="row mb-3 mt-1 px-2">
                <div class="col-1 user-profile-pic text-center pr-3">
                    <img src="${URL_ROOT}/public/img/icons/navbar/user-avatar.webp"
                         alt="User profile icon" width="90%">
                </div>
                <div class="col-11 crop-response-card-content py-3 px-4" id="response-${element.response_id}">
                    <div class="row pb-1">
                        <div class="col-12">
                            <div class="row align-items-center">
                                <div class="col-6 text-black fw-bold mb-1"><h3>${element.producer_name}</h3></div>
                                  <div class="col-4 text-primary-light fw-bold">
                                      <span>Responded on ${element.response_date_time}</span>
                                  </div>
                                  <div class="col-2 px-3 text-right align-items-center d-flex">
                                    ${renderPurchaseButton(element)}
                                  </div>
                                </div>
                            </div>
                        <div class="col-12 text-grey-dark pb-1">
                            <span class="pr-1 text-gold"><em>${element.producer_district}</em></span>
                        </div>
                        <div class="col-12 fs-3 text-grey-dark my-1">
                            <span class="pr-1">Accepted quantity : </span>
                            <span class="accepted-quantity fw-bold text-black">${element.accepted_quantity}</span>
                        </div>
                        <div class="col-6 d-flex fs-3 text-grey-dark">
                            <span class="pr-1">Accepted price : </span>
                            <span class="fw-bold text-black">Rs. ${element.accepted_price} per unit</span>
                        </div>
                        <div class="col-6 d-flex fs-3 text-grey-dark">
                            <span class="pr-1">Accepted delivery date : </span>
                            <span class="fw-bold text-black">${element.accepted_delivery_date}</span>
                        </div>
                    </div>
                </div>
            </div>
        `;
        output += row;
      });
    }
  } else {
    output = renderMessageCard("Error fetching data");
  }
  node.innerHTML = output;
}

const renderExpandedSection = (element) => `
    <div class="row">
        <div class="col-12 pt-2 mb-2 expanded-section">
            <div class="row mt-1 mb-3">
                <div class="col-12">
                    ${renderResponseInfoLine(element)}
                </div>

            </div>

            <div class="row mb-1">
                <div class="col-12">
                    <hr/>
                </div>
            </div>

            <div class="request-responses-card row px-3 mt-3 mb-2 pb-1">
                <div class="col-12 text-center text-primary-light pb-3 pt-1 fs-4"><h3>Responses</h3></div>
                <div class="col-12 request-responses-list">
                    ${renderMessageCard("Loading...")}
                </div>
            </div>
        </div>
    </div>`;

const renderPurchaseButton = (element) => {
  let output = "";

  if (element.status === "Pending") {
    output = `
          <button class="btn-sm btn-gold" id="btn-purchase" onclick="placeCropOrder(${element.response_id})">
              Purchase
          </button>
      `;
  } else {
    output = `
          <button class="btn-purchase badge badge-primary">
              Order Placed
          </button>
      `;
  }
  return output;
}

const requestList = document.querySelector("#crop-requests");

const placeCropOrder = async (responseId) => {
  const buttonPurchase = document.querySelector('#btn-purchase');
  window.location.href = URL_ROOT + '/manufacturer-orders/placeOrder/' + responseId;
  buttonPurchase.innerHTML = "Order Placed";
  buttonPurchase.setAttribute("disabled", "disabled");
}

document.addEventListener("DOMContentLoaded", () => {
  if (cropRequests == null) {
    requestList.innerHTML = renderMessageCard("Loading");
    fetchCropRequests();
  } else {
    renderCropRequests(data);
  }
  requestList.innerHTML = renderMessageCard("Loading...");
  fetchCropRequests();
});
