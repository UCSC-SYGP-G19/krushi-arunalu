let data = null;

const addItemToCart = async (productId, quantity) => {
  //console.log(productId)
  alert(quantity + "new item(s) have been added to your cart");
  const res = await fetch('http://localhost/krushi-arunalu/Marketplace/addToCartJson/' + productId + '?quantity');
  //console.log(res);
  if (res.status === 200) {
    data = await res.json();
    alert(quantity + "new item(s) have been added to your cart");
  }
}

const btnAddToCart = document.querySelector(".btn-add-to-cart");

