let cropCategories = null;
let crops = null;

const producerDropdown = document.querySelector("#producer_dropdown");
const cropCategoryDropdown = document.querySelector("#crop_category_name_dropdown");
const cropDropdown = document.querySelector("#crop_dropdown");
const buttonSubmit = document.querySelector("#btn-submit");
const buttonUpdate = document.querySelector("#btn-update");

const getCropCategoriesForSelectedProducer = () => {
    producerDropdown.addEventListener("change", (e) => {
        buttonUpdate.setAttribute("disabled", "disabled");
        const selectedProducer = e.target.value;
        console.log(selectedProducer);
        fetchOptionsForCropCategorySelection(selectedProducer);
    })
}

const fetchOptionsForCropCategorySelection = async (producerId) => {
    const res = await fetch(`${URL_ROOT}/manufacturer-orders/getCropCategoriesAsJson/` + producerId);
    if (res.status === 200) {
        cropCategories = await res.json();
        setOptionsForCropCategorySelection(cropCategories, producerId);
    }
}

const setOptionsForCropCategorySelection = (data, producerId) => {
    cropCategoryDropdown.innerHTML = "";

    if (data.length === 0) {
        let option = document.createElement("option");
        option.text = "No available crop categories";
        option.value = null;
        cropCategoryDropdown.add(option);
    } else {
        cropCategoryDropdown.removeAttribute("disabled");
        let option = document.createElement("option");
        option.text = "Select crop category";
        option.value = null;
        cropCategoryDropdown.add(option);

        data.forEach((element) => {
            let option = document.createElement("option");
            option.text = element.category_name;
            option.value = element.crop_category_name;
            cropCategoryDropdown.add(option);
        });
        getCropsOfSelectedCategory(producerId);
    }
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////

const getCropsOfSelectedCategory = (producerId) => {
    cropCategoryDropdown.addEventListener("change", (e) => {
        const selectedCategory = e.target.value;
        fetchOptionsForCropSelection(selectedCategory, producerId);
    });
}

const fetchOptionsForCropSelection = async (categoryId, producerId) => {
    const res = await fetch(`${URL_ROOT}/manufacturer-orders/getCropsAsJson/` + categoryId + `/` + producerId);
    if (res.status === 200) {
        crops = await res.json();
        console.log(cropDropdown);
        setOptionsForCropSelection(crops);
    }
}

const setOptionsForCropSelection = (data) => {
    cropDropdown.innerHTML = "";

    if (data.length === 0) {
        let option = document.createElement("option");
        option.text = "No available crops";
        option.value = null;
        cropDropdown.add(option);
    } else {
        cropDropdown.removeAttribute("disabled");
        let option = document.createElement("option");
        option.text = "Select crop";
        option.value = null;
        cropDropdown.add(option);

        data.forEach((element) => {
            let option = document.createElement("option");
            option.text = element.crop_name + " - Rs." + element.unit_price + " (remaining: " + element.remaining_qty + "KG)";
            option.value = element.crop;
            cropDropdown.add(option);
        });
        buttonSubmit.removeAttribute("disabled");
    }
}

document.addEventListener("DOMContentLoaded", () => {
    getCropCategoriesForSelectedProducer();
});

cropDropdown.setAttribute("disabled", "disabled");
cropCategoryDropdown.setAttribute("disabled", "disabled");
buttonSubmit.setAttribute("disabled", "disabled");