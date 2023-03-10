
const dropAreas = document.querySelectorAll(".image-upload"),
    content = document.querySelectorAll(".upload-content"),
    finalImages = document.querySelectorAll(".upload-preview"),
    browseButtons = document.querySelectorAll(".btn-browse"),
    uploadInputs = document.querySelectorAll(".upload-input");

browseButtons.forEach((browseButton, index) => {
    browseButton.onclick = (event) => {
        event.preventDefault();
        uploadInputs[index].click();
    }
})

let file;

uploadInputs.forEach((uploadInput, index) => {
    uploadInput.addEventListener("change", function () {
        file = this.files[0];
        previewFile(file,index);
    });
})

dropAreas.forEach((dropArea, index) => {
    dropArea.addEventListener("dragover", (event) => {
        event.preventDefault();
        dropArea.classList.add("drag");
    });

    dropArea.addEventListener("dragleave", (event) => {
        event.preventDefault();
        dropArea.classList.remove("drag");
    });

    dropArea.addEventListener("drop", (event) => {
        event.preventDefault();
        dropArea.classList.remove("drag");
        const file = event.dataTransfer.files[0];
        uploadInputs[index].files = event.dataTransfer.files;
        previewFile(file, index);
    });
})


function previewFile(file, index)
{
    let selectedContent = content[index];
    let fileType = file.type;
    let validExtensions = ["image/jpeg", "image/jpg", "image/png"];
    if (validExtensions.includes(fileType)) {
        let fileReader = new FileReader();
        fileReader.readAsDataURL(file);
        fileReader.onload = () => {
            let fileURL = fileReader.result;
            console.log(fileURL);
            if (typeof (fileURL) === "string") {
                const preview = new Image();
                preview.setAttribute("height", "100%");
                preview.src = fileURL;
                selectedContent.setAttribute("style", "display:none;")

                const closeBtn = document.createElement("button");
                closeBtn.id = "btn-cancel";
                closeBtn.className = "btn-cancel";
                closeBtn.innerHTML =  "&times;";
                closeBtn.addEventListener("click", (e) => {
                    e.preventDefault();
                    deleteImg(index)
                });
                finalImages[index].appendChild(closeBtn);
                finalImages[index].appendChild(preview);
            } else {
                console.log("Error while previewing image");
            }
        }
    } else {
        alert("This is not an image file");
        dropAreas[index].classList.remove("drag");
    }
}

//remove image

function deleteImg(index)
{
    const selectedContent = content[index];
    const finalImage = finalImages[index];
    uploadInputs[index].value = "";
    while (finalImage.firstChild) {
        finalImage.removeChild(finalImage.firstChild);
    }
    selectedContent.setAttribute("style", "display:flex;")
}

//upload image

