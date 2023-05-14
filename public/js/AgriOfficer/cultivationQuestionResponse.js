const handleOnEditClick = (responseId) => {
    const responseNode = document.querySelector(`#response-card-${responseId}`);
    const responseContent = responseNode.querySelector(".response-content").innerText;
    const responseInputBox = document.querySelector("#response-input");
    responseInputBox.value = responseContent;

    const form = document.querySelector("form");
    form.action = `../editResponse/${responseId}`;
    const submitButton = form.querySelector("button[type=submit]");
    submitButton.innerText = "Update"

    const cancelButton = form.querySelector("button[type=reset]");
    cancelButton.style.display = "block";
    cancelButton.addEventListener("click", () => {
        form.action = `../respond/${responseId}`;
        submitButton.innerText = "Send";
        cancelButton.style.display = "none";
    });
}


