let data = null;

const addItemToCart = async (productId) => {
  const productCard = document.querySelector(`#product-card-${productId}`);
  const quantity = productCard.querySelector(`input[name = "quantity"]`).value;
  const addToCartBtn = productCard.querySelector(`.btn-add-to-cart`);

  addToCartBtn.setAttribute("disabled", "disabled");
  const formData = new FormData();
  formData.append('product_id', productId);
  formData.append('quantity', quantity);
  const res = await fetch('http://localhost/krushi-arunalu/shopping-cart/addProductToCartJs', {
    method: 'POST',
    body: formData
  });
  if (res.status === 200) {
    addToCartBtn.removeAttribute("disabled");
    data = await res.json();
    toast("success", "", data.message);
    addToCartBtn.innerHTML = "Update";
    addToCartBtn.setAttribute("onclick", `updateItemInCart(productId)`);
  } else {
    addToCartBtn.removeAttribute("disabled");
    toast("error", "", data.message);
  }
}


const updateItemInCart = async (productId) => {
  const productCard = document.querySelector(`#product-card-${productId}`);
  const quantity = productCard.querySelector(`input[name = "quantity"]`).value;
  const addToCartBtn = productCard.querySelector(`.btn-add-to-cart`);
  addToCartBtn.setAttribute("disabled", "disabled");
  const formData = new FormData();
  formData.append('product_id', productId);
  formData.append('quantity', quantity);
  const res = await fetch('http://localhost/krushi-arunalu/shopping-cart/update', {
    method: 'POST',
    body: formData
  });
  if (res.status === 200) {
    data = await res.json();
    toast("success", "", data.message);

    const btnAddToCart = document.querySelector(".btn-add-to-cart");
    btnAddToCart.innerHTML = "Update";
    btnAddToCart.setAttribute("onclick", `updateItemInCart(productId)`);
  } else {
    toast("error", "", data.message);
  }
}

