let received_req = null;
let sent_req = null;

const fetchReceivedRequests = async() => {
    const res = await fetch('http://localhost/krushi-arunalu/connection-requests/getJsonForReceivedRequests');
    if (res.status === 200) {
        received_req = await res.json();
        renderReceivedRequests(received_req);
    }
}

const fetchSentRequests = async() => {
    const res = await fetch('http://localhost/krushi-arunalu/connection-requests/getJsonForSentRequests');
    if (res.status === 200) {
        sent_req = await res.json();
        renderSentRequests(sent_req);
    }
}

const renderReceivedRequests = (data) => {
    let output = "";

    if (data != null) {
        data.forEach((element) => {
            let row = `
                <div class="request-card-wrapper col-12 p-3 d-flex justify-content-space-between mb-3">
                    <div class="d-flex">
                        <div class="profile-pic">
                            <img class="user-profile-pic" src="../public/img/producer/${element.profile_pic}" alt="User profile icon" height="56px">
                        </div>
                        <div class="d-block">
                            <div class="user-name px-4 pt-1 fw-bold">
                                ${element.sender_name}
                            </div>
                            <div class="user-location px-4">
                                ${element.location}
                            </div>
                        </div>
                    </div>
                    <div class="btn-container d-flex">
                        <div class="mx-2">
                            <a class="btn-md btn-primary-light text-center text-white" href="accept/${element.request_id}">
                                Accept
                            </a>
                        </div>
                        <div class="mx-2">
                            <a class="md btn-outlined-error text-center text-error" href="decline/${element.request_id}">
                                Decline
                            </a>
                        </div>
                    </div>
                </div>
            `;
            output += row;
        });
        receivedRequests.innerHTML = output;
    }
    else {
        output = "No Pending Requests";
    }
}

const renderSentRequests = (data) => {
    let output = "";

    if (data != null) {
        data.forEach((element) => {
            let row = `
                <div class="request-card-wrapper col-12 p-3 d-flex justify-content-space-between mb-3">
                    <div class="d-flex">
                        <div class="profile-pic">
                            <img class="user-profile-pic" src="../public/img/producer/${element.profile_pic}" alt="User profile icon" height="56px">
                        </div>
                        <div class="d-block">
                            <div class="user-name px-4 pt-1 fw-bold">
                                ${element.receiver_name}
                            </div>
                            <div class="user-location px-4">
                                ${element.location}
                            </div>
                        </div>
                    </div>
                    <div class="btn-container d-flex">
                        <div class="mr-4">
                            <a class="md btn-outlined-error text-center text-error" href="decline/${element.request_id}">
                                Delete Request
                            </a>
                        </div>
                    </div>
                </div>
            `;
            output += row;
        });
        sentRequests.innerHTML = output;
    }
    else {
        output = "No Sent Requests";
    }
}

document.addEventListener("DOMContentLoaded", () => fetchReceivedRequests());
const receivedRequests = document.querySelector("#requests");

const sentRequests = document.querySelector("#requests");

const btnReceived = document.querySelector("#btn-received");
const btnSent = document.querySelector("#btn-sent");

btnReceived.addEventListener("click", () => {
    renderReceivedRequests(received_req);
    btnSent.classList.remove('active-page');
    btnSent.classList.add('inactive-page');
    btnReceived.classList.remove('inactive-page');
    btnReceived.classList.add('active-page');
});

btnSent.addEventListener("click", () => {
    fetchSentRequests();
    btnReceived.classList.remove('active-page');
    btnReceived.classList.add('inactive-page');
    btnSent.classList.remove('inactive-page');
    btnSent.classList.add('active-page');
});