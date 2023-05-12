let responses = null;
let inquiries = null;

const fetchCustomerInquiries = async () => {
    const res = await fetch('http://localhost/krushi-arunalu/inquiries/getCustomerInquiries');
    if (res.status === 200) {
        inquiries = await res.json();
        renderCustomerInquiries(inquiries);
    }
}

const renderCustomerInquiries = (data) => {
    let output = "";

    if (data != null){
        data.forEach((element) => {
            let inquiryCard = `
                <div class="row inquiry-wrapper px-4 py-3 d-block mb-3 text-justify" 
                    id="inquiry-${element.inquiry_id}-card">
                    <div class="d-block col-12">
                        <div class="text-black fw-bold fs-4">
                        ${element.content}
                        </div>
                        <div class="product-name fw-bold fs-3 text-secondary">
                        ${element.product_name}
                        </div>
                    </div>
                    <div class="col-12">
                    <div class="row py-1 justify-content-end">
                       <div class="responded text-white py-1 px-2 mr-2" hidden>Responded ✓️</div>
                       <div class="text-primary-light fw-bold p-1">
                           ${element.customer_name}
                           <span class="text-secondary px-3">
                              asked on ${element.asked_date}
                           </span>
                       </div>
                    </div>
                    <div class="row py-2">
                        <button class="btn-xs btn-view-responses px-3 fs-3" id="view-responses" value="show" 
                        onClick="viewResponses(${element.inquiry_id})">
                        View Responses
                        </button>
                    </div>
                    <div class="py-2"><hr></div>
                    <div class="row pl-4 inquiry-response-list"></div>
                    <div class="row pt-1 align-items-center justify-content-end gap-1 pl-3 pr-2">
                        <div class="col-1 text-center">
                            <img alt="CompanyLogo" class="user-profile-pic" src="./public/img/user-avatars/${element.company_logo}">
                        </div>
                        <div class="col-10 py-2">
                            <textarea class="col-12" rows="3" id="response-input" placeholder="Write a Response"></textarea>
                        </div>
                        <div class="col-1">
                            <button class="btn-sm btn-primary-light mb-1 text-white" onclick="sendResponse(${element.inquiry_id})">
                            Send</button>
                        </div>
                    </div>
</div>
                </div>
            `;
            output += inquiryCard;
        });
        inquiriesSection.innerHTML = output;
    } else {
        inquiriesSection.innerHTML = "No Inquiries";
    }
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

const viewResponses = (inquiryId) => {
    const inquiryCard = document.querySelector(`#inquiry-${inquiryId}-card`);
    const responsesList = inquiryCard.querySelector(".inquiry-response-list");
    const btnViewResponses = inquiryCard.querySelector(".btn-view-responses");

    if (btnViewResponses.value === "show") {
        fetchResponses(inquiryId);
    } else {
        responsesList.innerHTML = "";
        btnViewResponses.innerHTML = "View Responses";
        btnViewResponses.value = "show";
    }
}

const fetchResponses = async (id) => {
    const res = await fetch('http://localhost/krushi-arunalu/inquiries/getInquiryResponses/' + id);
    if (res.status === 200) {
        responses = await res.json();
        renderInquiryResponses(responses, id);
    }
}

const renderInquiryResponses = (data, inquiryId) => {

    const inquiryCard = document.querySelector(`#inquiry-${inquiryId}-card`);
    const responsesList = inquiryCard.querySelector(".inquiry-response-list");
    const btnViewResponses = inquiryCard.querySelector(".btn-view-responses");

    let output = "";

    if (data != null) {
        if (data.length === 0) {
            output = renderMessageCard("No responses yet");
        }
        data.forEach((element) => {
            let response = `
                <div class="col-12 py-3" id="inquiry-card-${element.inquiry_id}">
                    <div class="response-card-wrapper py-1 px-3 row">
                        <div class="col-1">
                            <img src="../../krushi-arunalu/public/img/user-avatars/${element.company_logo}"
                            alt="ProfilePic" class="company-logo">
                        </div>
                        <div class="response-card col-11"
                        id="response-${element.response_id}">
                            <div class="row gap-1">
                                <div class="col-10">
                                    <div class="response-content text-justify pt-2 px-3" id="response-content">
                                        ${element.response}
                                    </div>
                                    <div class="pr-3 text-right fw-bold py-1">
                                        Responded on
                                        <span>${element.responded_time}</span>
                                    </div>
                                </div>
                                <div class="col-2 d-flex align-items-center justify-content-space-around pr-3">
                                    <button onclick="updateResponse(${element.response_id})" 
                                        class="btn-sm fs-2 py-1 px-2 btn-primary-light text-white">Edit</button>
                                    <a href="${URL_ROOT}/inquiries/deleteResponse/${element.response_id}"
                                    class="btn-sm fs-2 py-1 px-2 btn-outlined-error">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            output += response;
        });
        responsesList.innerHTML = output;
    } else {
        responsesList.innerHTML = renderMessageCard("No responses");
    }
    btnViewResponses.innerHTML = "Hide Responses";
    btnViewResponses.value = "hide";

}

const inquiriesSection = document.querySelector('#inquiries');

//fetch and customer inquiries

document.addEventListener("DOMContentLoaded", () => {
    if (inquiries == null) {
        inquiriesSection.innerHTML = renderMessageCard("Loading");
        fetchCustomerInquiries();
    } else {
        renderCustomerInquiries(inquiries);
    }
});


// Send a response

const sendResponse = async (inquiryId) => {
    const responseBox = document.querySelector(`#inquiry-${inquiryId}-card`).querySelector("textarea");
    const responseText = responseBox.value;
    let formData = new FormData;
    formData.append("responseMessage", responseText)
    const res = await fetch('http://localhost/krushi-arunalu/inquiries/addResponseToDb/' + inquiryId, {
        method: "POST",
        body: formData
    });
    if (res.status === 200) {
        responseBox.value = "";
        fetchCustomerInquiries();
    }
}

//Update a response

const updateResponse = (responseId) => {

    const responseNode = document.querySelector(`#response-${responseId}`).querySelector(".response-content");
    const responseContent = responseNode.innerText;

    //const modalWindowBox = document.querySelector('#modal-window-box');

    document.querySelector("dialog").innerHTML = `
                <div class="modal-content pt-1">
                    <div class="px-3 pb-2 modal-window-title">
                        <h4>Update Response</h4>
                    </div>
                    <hr>
                    <div class="px-3 pt-3 pb-2">
                        <textarea class="px-2 py-1 min-w-100" id="response-box" name="response" rows="5">${responseContent}
                        </textarea>
                    </div>
                    <div class="text-right px-3 py-2">
                        <button class="btn-sm btn-primary-light text-white mr-1" type="submit"
                            onclick="updateResponseInDb(${responseId})">Update</button>
                        <button class="btn-close btn-sm btn-outlined-error" id="close-button" type="reset"
                            onclick="closeWindow()">
                        Close</button>
                    </div>
                </div>
            `;
    document.querySelector('dialog').showModal();
}

const updateResponseInDb = async (responseId) => {

    const responseBox = document.querySelector('#response-box');
    const response = responseBox.value;
    let formData = new FormData();
    formData.append("totalQuantity", response);
    const res = await fetch('http://localhost/krushi-arunalu/inquiries/sendUpdatedResponse/' + responseId, {
        method: "POST",
        body: formData
    });
    if (res.status === 200) {
        closeWindow();
        fetchCustomerInquiries();
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Successfully Updated the Response',
            confirmButtonText: 'OK',
        });
    }

}

const closeWindow = () => {
    //const modalWindowBox = document.querySelector('#modal-window-box');
    document.querySelector('dialog').close();
};


