let x = document.querySelector("#response-input");

function editResponse(response) {
    console.log(response);
}

// function handleClick(cropRequestId) {
//     console.log(cropRequestId);
//     fetchMyResponses(cropRequestId);
//
// }
//
//
// const handleClick = (responseId) => {    //querySelector eken kohomada foreach eke ethule tiyena response eke content eke hariyatama capture karaganne...responsees godak tiyeana nisa
//     const responseNode = document.querySelector(`#response-${responseId}`);
//     //responseNode.querySelector(".edit-button").disabled = true;
//     requestNode.querySelector("form").action = `${URL_ROOT}/producerCropRequests/responseUpdate/${responseId}`;
//
//     const responseData = myResponsesList[requestId].find((response) => response.response_id === responseId);
//     requestNode.querySelector("button[type='submit']").value = "Update";
//     requestNode.querySelector("button[type='submit']").innerText = "Update response";
//
//     requestNode.querySelector("button[type='reset']").addEventListener("click", () => {
//         requestNode.querySelector("form").action = `${URL_ROOT}/producerCropRequests/addResponse/${requestId}`;
//         requestNode.querySelector("button[type='submit']").value = "Submit";
//         requestNode.querySelector("button[type='submit']").innerText = "Submit response";
//         requestNode.querySelectorAll(".edit-button").forEach((button) => button.disabled = false);
//         requestNode.querySelector("button[type='reset']").removeEventListener("click", () => {
//         });
//     });
// }