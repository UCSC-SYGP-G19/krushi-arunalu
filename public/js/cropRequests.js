let cropRequestsList = null;

const fetchCropRequests = async () => {
  const res = await fetch(window.location.origin + '/krushi-arunalu/producer-crop-requests/getRequestsAsJson');
  if (res.status === 200) {
    cropRequestsList = await res.json();
    console.log(cropRequestsList);
  }
}
const renderCropRequests = (data) => {
  let output = "";

  if (data != null) {
    if (data.length === 0) {
      output = renderMessageCard("No crop requests to show");
    } else {
      data.forEach((element) => {
        let row = `
                <div class="crop-request-card p-3 px-4 mb-3" datasrc=${element.id} datatype="collapsed">
                            <div class="row clickable" onClick="handleCardClick(${element.id})">
                                <div class="col-1">
                                    <div class="image-window">
                                        <img alt="Product image" height="100%" width="100%"
                                        src="${window.location.origin}/krushi-arunalu/public/img/products/cloves.jpg">
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
                                <span class="company-info text-primary-light fw-bold">${element.manufacturer_name}</span>
                                    <!--<a class="btn-md btn-outlined-secondary mx-2"
                                    href="${window.location.origin}/krushi-arunalu/manufacturer-crop-requests/edit/${element.id}">
                                      Edit
                                    </a>
                                    <a class="btn-md btn-outlined-error mx-2"
                                    href="${window.location.origin}/krushi-arunalu/manufacturer-crop-requests/delete/${element.id}">
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

const renderPricesLine = (element) => `<div>
                                        <span class="pr-1">Expected price range: </span>
                                        <span class="fw-bold">Rs. ${element.low_price} to Rs. ${element.high_price} per unit</span>
                                    </div>`;

const renderResponseInfoLine = (element) => `<div class="fs-3"><span class="text-primary-light fw-bold pr-1">${element.response_count} responses - </span>
                                        <span class="badge badge-light-green text-black fw-bold px-2 mt-0 mb-1">
                                        ${element.fulfilled_quantity} KG fulfilled / ${element.required_quantity} KG required</span></div>`;
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
                                    <div class="row pt-2 justify-content-center">
                                        <div class="col-11">
                                         <form action="${window.location.origin}/krushi-arunalu/producer-crop-requests/submit-response" method="post">
                                            <div class="row gap-2">
                                                <div class="col-4">
                                                    <label for="accepted_quantity">Accepted quantity (KG)</label>
                                                    <input type="number" id="accepted_quantity" name="accepted_quantity" placeholder="Enter accepted quantity" min="0" max=${element.required_quantity - element.fulfilled_quantity} value="">
                                                </div>
                                                <div class="col-4">
                                                    <label for="accepted_price">Accepted price (Rs.)</label>
                                                    <input type="number" id="accepted_price" name="accepted_price" placeholder="Set accepted price" min=${element.low_price} max=${element.high_price} value="">
                                                </div>
                                                <div class="col-4">
                                                    <label for="accepted_delivery_date">Accepted delivery date</label>
                                                    <input type="date" id="accepted_delivery_date" name="accepted_delivery_date" value="">
                                                </div>
                                            </div>
                                            <div class="row gap-2">
                                                <div class="col-12">
                                                  <label for="remarks">Remarks</label>
                                                    <textarea name="remarks" id="remarks" rows="8" placeholder="Add remarks"></textarea>
                                                </div>
                                            </div>
                                            <div class="row gap-2 mt-1 justify-content-center">
                                                <button class="mr-2 btn-lg btn-primary-light text-center text-white fs-3" type="submit" name="submit_response" value="submit">Submit response
                                                </button>
                                                <button class="ml-2 btn-lg btn-outlined-error text-center text-error fs-3" type="reset" name="cancel_response" value="cancel">Cancel
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

document.addEventListener("DOMContentLoaded", () => {
  requestsList.innerHTML = renderMessageCard("Loading");
  fetchCropRequests().then(r => {
    renderCropRequests(cropRequestsList);
  })
});

const handleCardClick = (e) => {
  console.log(e);
  const card = document.querySelector(`.crop-request-card[datasrc="${e}"]`);
  if (card.getAttribute("datatype") === "collapsed") {
    card.setAttribute("datatype", "expanded");
    const currentCropRequest = cropRequestsList.find(r => r.id === e);
    card.querySelector(".third-line").innerHTML = renderPricesLine(currentCropRequest);
    card.innerHTML += renderExpandedSection(currentCropRequest);
  } else {
    card.setAttribute("datatype", "collapsed");
    card.querySelector(".third-line").innerHTML = renderResponseInfoLine(cropRequestsList.find(r => r.id === e));
    card.querySelector(".expanded-section").remove();
  }
}

const requestsList = document.querySelector("#crop-requests-list");
