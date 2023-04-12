let data = null;

const fetchHiddenProducts = async() => {
    const res = await fetch('http://localhost/krushi-arunalu/products/showHiddenProducts');
    if (res.status === 200){
        data = await res.json();
        renderHiddenProducts(data);
    }
}

const renderHiddenProducts = (data) => {
    let output = "";

    if (data != null) {
        data.forEach((element) => {
            let product = `
                <div class="hidden-product-card pb-2 p-3 col-2 m-2 mb-4">
                    <div class="image-window mb-1">
                        <img alt="Product image" height="100%" width="100%" src="./public/img/products/${element.image_url}">
                    </div>
                    <div class="text-center">
                        <h4 class="pt-2 pb-0 product-name fw-bold">
                        ${element.name}</h4>
                        <span class="product-description text-black py-1 pb-2 fs-2">
                        ${element.description}</span> <br>
                        <a href = '${ window.location.href}/restore-hide-product/${element.id}'
                            class = "btn-xs btn-outlined-secondary text-center my-2">
                            Unhide
                        </a>
                    </div>
                </div>
            `;

            output += product;
        });
        hiddenProducts.innerHTML = output;
        btnShowHiddenProducts.innerText = "Hide hidden products";
        btnShowHiddenProducts.value = "hide";

    } else {
        console.log("Error fetching data");
    }
}

const btnShowHiddenProducts = document.querySelector("#hidden-products-toggle");

btnShowHiddenProducts.addEventListener('click', () => {
    if (btnShowHiddenProducts.value === "show") {
        fetchHiddenProducts();
    } else {
        hiddenProducts.innerHTML = '';
        btnShowHiddenProducts.innerText = 'Show hidden products';
        btnShowHiddenProducts.value = "show";
    }
});

const hiddenProducts = document.querySelector("#hidden-products");

