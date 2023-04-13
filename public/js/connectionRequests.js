let receivedRequestsList = null;
let sentRequestsList = null;

const fetchReceivedRequests = async () => {
  const res = await fetch(window.location.origin + '/krushi-arunalu/connection-requests/getReceivedRequestsAsJson');
  if (res.status === 200) {
    console.log(res);
    receivedRequestsList = await res.json();
    console.log(receivedRequestsList);
    renderReceivedRequests(receivedRequestsList);
  }
}

const fetchSentRequests = async () => {
  const res = await fetch(window.location.origin + '/krushi-arunalu/connection-requests/getSentRequestsAsJson');
  if (res.status === 200) {
    sentRequestsList = await res.json();
    renderSentRequests(sentRequestsList);
  }
}

const renderReceivedRequests = (data) => {
  let output = "";

  if (data != null) {
    if (data.length === 0) {
      output = renderMessageCard("No requests to show");
    } else {
      data.forEach((element) => {
        let row = `
                <div class="connection-request-wrapper px-3 py-2 row mb-3">
                <div class="col-12 justify-content-space-between">
                    <div class="row pt-1">
                        <div class="col-9">
                            <div class="row">
                              <div class="col-1 text-align-center justify-content-center pt-1">
                              <img class="avatar m-auto" alt="User avatar"
                                src="${window.location.origin}/krushi-arunalu/public/img/user-avatars/${element.sender_image_url}">
                              </div>
                            <div class="col-11 px-3 pt-1">
                                <h3 class="title fw-bold">
                                    ${element.sender_name}
                                </h3>
                                <div class="sub-title-1">
                                    <div class="text-secondary py-1">${element.sender_address}</div>
                                    <div><a class="text-primary-light" href="tel:${element.sender_contact_no}">
                                      ${element.sender_contact_no}
                                    </a></div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="row align-items-center justify-content-end gap-1 px-2">
                                <div class="col p-2">
                                    <a class="btn-md btn-primary-light text-center text-white" 
                                        href="accept/${element.connection_request_id}">
                                        Accept
                                    </a>
                                </div>
                                <div class="col p-2">
                                    <a class="btn-md btn-outlined-error text-center text-error"
                                    href="decline/${element.connection_request_id}">
                                        Decline
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 pb-1 px-2">
                        <div class="text-right text-secondary sub-title-2">
                          Sent on ${element.sent_date_time}
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
  requestsList.innerHTML = output;
}

const renderSentRequests = (data) => {
  let output = "";

  if (data != null) {
    if (data.length === 0) {
      output = renderMessageCard("No requests to show");
    } else {
      data.forEach((element) => {
        let row = `
                <div class="connection-request-wrapper px-3 py-2 row mb-3">
                <div class="col-12 justify-content-space-between">
                    <div class="row">
                        <div class="col-9">
                            <div class="row">
                              <div class="col-1 text-align-center justify-content-center pt-1">
                              <img class="avatar m-auto" alt="User avatar"
                                src="${window.location.origin}/krushi-arunalu/public/img/user-avatars/${element.receiver_image_url}">
                              </div>
                            <div class="col-11 px-3 m-auto">
                                <h2 class="title fw-bold">
                                    ${element.receiver_name}
                                </h2>
                                <div class="text-left text-secondary sub-title-1 pt-1">
                                  Sent on ${element.sent_date_time}
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="col-3 m-auto">
                            <div class="row align-items-center justify-content-end gap-1 px-2 m-auto">
                                <div class="col p-2">
                                    <a class="btn-md btn-outlined-error text-center text-error"
                                    href="remove/${element.connection_request_id}">
                                        Delete Request
                                    </a>
                                </div>
                            </div>
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
  requestsList.innerHTML = output;
}

document.addEventListener("DOMContentLoaded", () => {
  requestsList.innerHTML = renderMessageCard("Loading");
  fetchReceivedRequests().then(r => {
    renderReceivedRequests(receivedRequestsList);
  })
});
const requestsList = document.querySelector("#requests-list");
const btnReceived = document.querySelector("#btn-received-requests");
const btnSent = document.querySelector("#btn-sent-requests");

btnReceived.addEventListener("click", () => {
  btnSent.classList.remove('active-tab');
  btnReceived.classList.add('active-tab');
  if (receivedRequestsList == null) {
    requestsList.innerHTML = renderMessageCard("Loading");
    fetchReceivedRequests().then(r => {
      renderReceivedRequests(receivedRequestsList);
    });
  } else {
    renderReceivedRequests(receivedRequestsList);
  }
});

btnSent.addEventListener("click", () => {
  btnSent.classList.add('active-tab');
  btnReceived.classList.remove('active-tab');
  if (sentRequestsList == null) {
    requestsList.innerHTML = renderMessageCard("Loading");
    fetchSentRequests().then(r => {
      renderSentRequests(sentRequestsList);
    });
  } else {
    renderSentRequests(sentRequestsList);
  }
});
