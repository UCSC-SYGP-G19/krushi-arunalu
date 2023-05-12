let crops = null;

const cropCategory = document.querySelector("#crop_category_dropdown");
const crop = document.querySelector("#crop_dropdown");

document.addEventListener("DOMContentLoaded", () => {
    getCropsOfSelectedCategory();
});

const fetchOptionsForCropSelection = async (categoryId) => {
    const res = await fetch(`${URL_ROOT}/manufacturer-crop-requests/getCropsAsJson/` + categoryId);
    if (res.status === 200) {
        crops = await res.json();
        setOptionsForCropSelection(crops);
    }
}

const getCropsOfSelectedCategory = () => {
    cropCategory.addEventListener("change", (e) => {
        const selectedCategory = e.target.value;
        fetchOptionsForCropSelection(selectedCategory);
    });
}

const setOptionsForCropSelection = (data) => {
    data.forEach((element) => {
        let option = document.createElement("option");
        option.text = element.name;
        option.value = element.id;
        crop.add(option);
        console.log("Success");
    });
}