let data = null;

const fetchCustomerInquiries = async() => {
    const res = await fetch('http://localhost/krushi-arunalu/inquiries/getCustomerInquiries');
    if (res.status === 200){
        data = await res.json();
        renderCustomerInquiries(data);
    }
}

const renderCustomerInquiries = (data) => {
    let output = "";

    if (data != null){
        data.forEach((element) => {
            let inquiryCard = `
                <div class="row inquiry-wrapper px-4 py-3 d-block mb-3 text-justify" id="inquiry-${element.inquiry_id}-card">
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
                        <button class="btn-xs btn-view-responses px-3 fs-3" id="view-responses" onClick="fetchResponses(${element.inquiry_id})">
                        View Responses
                        </button>
                    </div>
                    <div class="py-2"><hr></div>
                    <div class="row pl-4 inquiry-response-list">
                    </div>
                    <div class="row pt-1 align-items-center justify-content-end gap-1 pl-3 pr-2">
                        <div class="col-1 text-center">
                            <img alt="CompanyLogo" class="user-profile-pic" src="./public/img/user-avatars/${element.company_logo}">
                        </div>
                        <div class="col-10 py-2">
                            <textarea class="col-12" rows="3" id="response-input" placeholder="Write a Response"></textarea>
                        </div>
                        <div class="col-1">
                            <button class="btn-sm btn-primary-light mb-1 text-white" onclick="sendResponse(${element.inquiry_id})">Send</button>
                        </div>
                    </div>
</div>
                </div>
            `;
            output += inquiryCard;
        });
        inquiries.innerHTML = output;
    }
    else {
        inquiries.innerHTML = "No Inquiries";
    }
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

const fetchResponses = async(id) => {
    const res = await fetch('http://localhost/krushi-arunalu/inquiries/getInquiryResponses/' + id);
    if (res.status === 200){
        data = await res.json();
        renderInquiryResponses(data, id);
    }
}

const renderInquiryResponses = (data, inquiryId) => {

    const inquiryCard = document.querySelector(`#inquiry-${inquiryId}-card`);
    const responsesList = inquiryCard.querySelector(".inquiry-response-list");

    let output = "";

    if (data != null){
        data.forEach((element) => {
            let response = `
                <div class="row col-12 py-3" id="inquiry-card-${element.inquiry_id}">
                        <div class="py-1 px-4 d-flex gap-1">
                            <img src="../../krushi-arunalu/public/img/user-avatars/${element.company_logo}" alt="ProfilePic" class="col-1">
                            <div class="response-card">
                                <div class="text-justify pt-2 px-3">
                                    ${element.response}
                                </div>
                                <div class="pr-3 text-right fw-bold py-1">
                                    Responded on
                                    <span>${element.responded_time}</span
                                </div>
                            </div>
                        </div>
                    </div>
            `;
            output += response;
        });
        responsesList.innerHTML = output;
    }
    else{
        responsesList.innerHTML = "No responses";
    }

    let btnViewResponses = inquiryCard.querySelector(".btn-view-responses");
    btnViewResponses.innerHTML = "Hide Responses";

}

const inquiries = document.querySelector('#inquiries');
document.addEventListener("DOMContentLoaded", () => fetchCustomerInquiries());


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
    }
}


