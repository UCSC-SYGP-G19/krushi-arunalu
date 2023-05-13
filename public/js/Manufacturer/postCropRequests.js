let crops = null;

const cropCategoryDropdown = document.querySelector("#crop_category_dropdown");
const cropDropdown = document.querySelector("#crop_dropdown");

const fetchOptionsForCropSelection = async (categoryId) => {
    const res = await fetch(`${URL_ROOT}/manufacturer-crop-requests/getCropsAsJson/` + categoryId);
    if (res.status === 200) {
        crops = await res.json();
        console.log(cropDropdown);
        setOptionsForCropSelection(crops);
        cropDropdown.removeAttribute("disabled");
    }
}

const getCropsOfSelectedCategory = () => {
    cropCategoryDropdown.addEventListener("change", (e) => {
        const selectedCategory = e.target.value;
        fetchOptionsForCropSelection(selectedCategory);
    });
}

const setOptionsForCropSelection = (data) => {
    cropDropdown.innerHTML = "";
    let option = document.createElement("option");
    option.text = "Select crop";
    option.value = "0";
    cropDropdown.add(option);

    data.forEach((element) => {
        let option = document.createElement("option");
        option.text = element.name;
        option.value = element.id;
        cropDropdown.add(option);
    });
}

document.addEventListener("DOMContentLoaded", () => {
    getCropsOfSelectedCategory();
});

cropDropdown.setAttribute("disabled", "disabled");