let requestsList = null;

const fetchApprovalRequests = async () => {
    const res = await fetch(`${URL_ROOT}/product-categories/getApprovalRequestsAsJson`);
    if (res.status === 200) {
        requestsList = await res.json();
        renderApprovalRequests(requestsList);
    }
}

const renderApprovalRequests = (data) => {
    let output = "";

    if (data == null) {
        pendingApprovalList.innerHTML = renderMessageCard("Error fetching data");
    }

    if (data.length === 0) {
        pendingApprovalList.innerHTML = renderMessageCard("No pending approvals to show");
    } else {
        data.forEach((element) => {
            let row = `
            <div class="connection-request-wrapper px-3 py-2 row mb-3">
                <div class="col-12 justify-content-space-between">
                    <div class="row pt-1">
                        <div class="col-9">
                            <div class="row">
                                <div class="col-11 px-3 pt-1">
                                    <h3 class="title fw-bold">
                                        ${element.name}
                                    </h3>
                                    <div class="sub-title-1">
                                        <div class="text-secondary py-1">${element.description}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="row align-items-center justify-content-end gap-1 px-2">
                                <div class="col p-2">
                                    <a class="btn-sm btn-primary-light text-center text-white"
                                       href="${URL_ROOT}/product-categories/approve/${element.id}">
                                        Approve
                                    </a>
                                </div>
                                <div class="col p-2">
                                    <a class="btn-sm btn-outlined-error text-center text-error"
                                       href="${URL_ROOT}/product-categories/decline/${element.id}">
                                        Decline
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
        pendingApprovalList.innerHTML = output;
    }
}

document.addEventListener("DOMContentLoaded", () => {
    pendingApprovalList.innerHTML = renderMessageCard("Loading");
    fetchApprovalRequests();
});
const pendingApprovalList = document.querySelector("#pending-approval-list");