let data = null;

const fetchHiddenCategories = async() => {
    const res = await fetch('http://localhost/krushi-arunalu/product-categories/showHiddenCategories');
    if (res.status === 200){
        data = await res.json();
        renderHiddenCategories(data);
    }
}

const renderHiddenCategories = (data) => {
    let output = "";

    if (data != null) {
        data.forEach((element) => {
            let category = `
<div class="col-2 mb-4">
            <div class="hidden-product-card pb-2 p-3">
                 <div class="text-center">
                      <h4 class="pt-2 pb-0 name fw-bold">
                        ${element.name}</h4>
                      <span class="description text-black py-1 pb-2 fs-2">
                        ${element.description}</span> <br>
                      <a href = '${ window.location.href}/restore-hidden-category/${element.id}'
                          class = "btn-xs btn-outlined-secondary text-center my-2">
                          Restore
                      </a>
                 </div>
            </div>
            </div>
             `;

            output += category;
        });

        hiddenCategoriesSection.innerHTML = output;
        btnShowHiddenCategories.innerText = "Hide hidden categories";
        btnShowHiddenCategories.value = "hide";

    } else {
        console.log("Error fetching data");
    }
}

const btnShowHiddenCategories = document.querySelector("#hidden-categories-toggle");
const hiddenCategoriesSection = document.querySelector("#hidden-categories");

btnShowHiddenCategories.addEventListener('click', () => {
    if (btnShowHiddenCategories.value === "show") {
        fetchHiddenCategories();
    } else {
        hiddenCategoriesSection.innerHTML = '';
        btnShowHiddenCategories.innerText = 'Show hidden categories';
        btnShowHiddenCategories.value = "show";
    }
});



