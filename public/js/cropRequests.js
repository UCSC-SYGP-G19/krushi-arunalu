let cropRequestsList = null;
let myResponsesList = null;

const fetchCropRequests = async () => {
  const res = await fetch(window.location.origin + '/krushi-arunalu/producer-crop-requests/getRequestsAsJson');
  if (res.status === 200) {
    cropRequestsList = await res.json();
    console.log(cropRequestsList);
  }
}

const fetchMyResponses = async (cropRequestId) => {
  const res = await fetch(window.location.origin + '/krushi-arunalu/producer-crop-requests/getMyResponsesAsJson/' + cropRequestId);
  if (res.status === 200) {
    myResponsesList[cropRequestId] = await res.json();
    console.log(myResponsesList);
  }
}

const fetchAndRenderMyResponses = async (cropRequestId) => {
  const responsesListNode = document.querySelector(`#crop-request-${cropRequestId}`).querySelector('.request-responses-list');
  if (myResponsesList == null) {
    myResponsesList = {};
  }
  if (!(cropRequestId in myResponsesList)) {
    await fetchMyResponses(cropRequestId);
  }
  renderMyResponses(responsesListNode, myResponsesList[cropRequestId]);
}

const handleResponseEditClick = (requestId, responseId) => {
  const requestNode = document.querySelector(`#crop-request-${requestId}`)
  const responseNode = requestNode.querySelector(`#response-${responseId}`);
  requestNode.querySelectorAll(".edit-button").forEach((button) => button.disabled = false);
  responseNode.querySelector(".edit-button").disabled = true;
  requestNode.querySelector("form").action = `${URL_ROOT}/producer-crop-requests/update-my-response/${responseId}`;

  const responseData = myResponsesList[requestId].find((response) => response.response_id === responseId);
  requestNode.querySelector(`#accepted_quantity_${requestId}`).value = responseData.accepted_quantity;
  requestNode.querySelector(`#accepted_price_${requestId}`).value = responseData.accepted_price;
  requestNode.querySelector(`#accepted_delivery_date_${requestId}`).value = responseData.accepted_delivery_date;
  requestNode.querySelector(`#remarks_${requestId}`).value = responseData.remarks;
  requestNode.querySelector("button[type='submit']").value = "Update";
  requestNode.querySelector("button[type='submit']").innerText = "Update response";

  requestNode.querySelector("button[type='reset']").addEventListener("click", () => {
    requestNode.querySelector("form").action = `${URL_ROOT}/producer-crop-requests/submit-response/${requestId}`;
    requestNode.querySelector("button[type='submit']").value = "Submit";
    requestNode.querySelector("button[type='submit']").innerText = "Submit response";
    requestNode.querySelectorAll(".edit-button").forEach((button) => button.disabled = false);
    requestNode.querySelector("button[type='reset']").removeEventListener("click", () => {
    });
  });
}

const handleResponseDeleteClick = async (responseId) => {
  window.location.href = `${URL_ROOT}/producer-crop-requests/delete-my-response/${responseId}`;
  // const res = await fetch(`${URL_ROOT}/producer-crop-requests/delete-my-response/` + responseId);
  // if (res.status === 200) {
  //   const responseNode = document.querySelector(`#response-${responseId}`);
  //   responseNode.remove();
  // } else {
  //   alert("Error deleting response");
  // }
}

const renderCropRequests = (data) => {
  let output = "";

  if (data != null) {
    if (data.length === 0) {
      output = renderMessageCard("No crop requests to show");
    } else {
      data.forEach((element) => {
        let row = `
            <div class="crop-request-card p-3 px-4 mb-3" id="crop-request-${element.id}" datatype="collapsed">
                <div class="row clickable" onClick="handleCropRequestClick(${element.id})">
                    <div class="col-1">
                        <div class="image-window">
                            <img alt="Product image" height="100%" width="100%"
                                 src="${URL_ROOT}/public/img/products/cloves.jpg">
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
                    <div class="col-3 py-4 justify-content-end d-flex px-3">
                        <span class="company-info text-gold fw-bold"><em>${element.manufacturer_name}</em></span>
                            <!--<a class="btn-md btn-outlined-secondary mx-2"
                                    href="${URL_ROOT}/manufacturer-crop-requests/edit/${element.id}">
                                      Edit
                                    </a>
                                    <a class="btn-md btn-outlined-error mx-2"
                                    href="${URL_ROOT}/manufacturer-crop-requests/delete/${element.id}">
                                      Delete
                                    </a>-->
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
  requestsList.innerHTML = output;
}

const renderMyResponses = (node, data) => {
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
                                <div class="col-6 text-primary-light fw-bold text-right">
                                    <span>${element.response_date_time}</span>
                                    <span class="ml-3">
                                      <button class="btn-xs btn-outlined-secondary mr-1 edit-button"
                                              onclick="handleResponseEditClick(${element.request_id}, ${element.response_id})">
                                        Edit
                                    </button>
                                    <button class="btn-xs btn-outlined-error ml-1 delete-button"
                                            onclick="handleResponseDeleteClick(${element.response_id})">
                                        Delete
                                    </button>
                                  </span>
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

const renderPricesLine = (element) => `
    <div>
        <span class="pr-1">Expected price range: </span>
        <span class="fw-bold">Rs. ${element.low_price} to Rs. ${element.high_price} per unit</span>
    </div>`;

const renderResponseInfoLine = (element) => `
    <div class="fs-3"><span
            class="text-primary-light fw-bold pr-1">${element.response_count} response${element.response_count !== 1 ? "s" : ""} - </span>
        <span class="badge badge-light-green text-black fw-bold px-2 mt-0 mb-1">
                                        ${element.fulfilled_quantity} KG fulfilled / ${element.required_quantity} KG required</span>
    </div>`;
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
                <div class="col-12 text-center text-primary-light pb-3 pt-1 fs-4"><h3>My responses</h3></div>
                <div class="col-12 request-responses-list">
                    ${renderMessageCard("Loading...")}
                </div>
            </div>

            <div class="row mb-1">
                <div class="col-12">
                    <hr/>
                </div>
            </div>

            <div class="row pt-2 justify-content-center">
                <div class="col-12 px-3">
                    <form action="${URL_ROOT}/producer-crop-requests/submit-response" method="post">
                        <div class="row gap-2">
                            <div class="col-4">
                                <label for="accepted_quantity">Accepted quantity (KG)</label>
                                <input required type="number" id="accepted_quantity_${element.id}"
                                       name="accepted_quantity"
                                       placeholder="Enter accepted quantity" min="1"
                                       max=${element.required_quantity - element.fulfilled_quantity} value="">
                            </div>
                            <div class="col-4">
                                <label for="accepted_price">Accepted price (Rs.)</label>
                                <input required type="number" id="accepted_price_${element.id}" name="accepted_price"
                                       placeholder="Set accepted price" min=${element.low_price}
                                       max=${element.high_price} value="">
                            </div>
                            <div class="col-4">
                                <label for="accepted_delivery_date">Accepted delivery date</label>
                                <input required type="date" id="accepted_delivery_date_${element.id}"
                                       name="accepted_delivery_date"
                                       value="">
                            </div>
                        </div>
                        <div class="row gap-2">
                            <div class="col-12">
                                <label for="remarks">Remarks</label>
                                <textarea name="remarks" id="remarks_${element.id}" rows="8"
                                          placeholder="Add remarks"></textarea>
                            </div>
                        </div>
                        <div class="row gap-2 mt-1 justify-content-center">
                            <input type="hidden" name="crop_request_id" value=${element.id}>
                            <button class="mr-2 btn-lg btn-primary-light text-center text-white fs-3" type="submit"
                                    name="submit_response" value="submit">Submit response
                            </button>
                            <button class="ml-2 btn-lg btn-outlined-error text-center text-error fs-3" type="reset"
                                    name="cancel_response" value="cancel">Cancel
                            </button>
                        </div>
                    </form>
                </div>
                <!--<div class="col-12 text-center responses-list">
                    Loading responses ...
                </div>-->
            </div>
        </div>
    </div>`;

const handleCropRequestClick = (e) => {
  console.log(e);
  const cropRequestCard = document.querySelector(`#crop-request-${e}`);
  if (cropRequestCard.getAttribute("datatype") === "collapsed") {
    cropRequestCard.setAttribute("datatype", "expanded");
    const currentCropRequest = cropRequestsList.find(r => r.id === e);
    cropRequestCard.querySelector(".third-line").innerHTML = renderPricesLine(currentCropRequest);
    cropRequestCard.innerHTML += renderExpandedSection(currentCropRequest);
    fetchAndRenderMyResponses(e);
  } else {
    cropRequestCard.setAttribute("datatype", "collapsed");
    cropRequestCard.querySelector(".third-line").innerHTML = renderResponseInfoLine(cropRequestsList.find(r => r.id === e));
    cropRequestCard.querySelector(".expanded-section").remove();
  }
}

const requestsList = document.querySelector("#crop-requests-list");

document.addEventListener("DOMContentLoaded", () => {
  requestsList.innerHTML = renderMessageCard("Loading");
  fetchCropRequests().then(r => {
    renderCropRequests(cropRequestsList);
  })
});
