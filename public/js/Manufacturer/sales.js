let sales = null;

const buttonContainer = document.querySelector('#btn-container');
const salesList = document.querySelector('#sales');

const fetchSalesList = async () => {
  const res = await fetch(`${URL_ROOT}/manufacturer-sales/getSalesAsJson`);
  if (res.status === 200) {
    sales = await res.json();
    renderSalesList(sales);
  }
}

const loadProductImages = (data, orderId) => {
  let products = "";

  data.order_items[orderId].forEach((item) => {
    let product = `<div class="mb-1 product-image">
                <img alt="Product image" height="100%" width="100%"
                src="${URL_ROOT}/public/img/products/${item.image_url}">
            </div>`
    products += product;
  });
  return products;
}

const renderSalesList = (data) => {
  let output = "";


  if (data != null) {
    if (data.length === 0) {
      output = renderMessageCard("No sales to show");
    } else {
      data.order_details.forEach((element) => {
        console.log(data.order_items[element.order_id]);
        let row = `
                <tr class="row">
                    <td class="col-1">${element.order_id}</td>
                        <td class="col-2 d-inline-flex justify-content-center">`
          + loadProductImages(data, element.order_id) +
          `</td>
                        <td class="col-2">${element.order_date}</td>
                        <td class="col-2">${element.order_total}</td>
                        <td class="col-1">
                            ${renderStatus(element.order_status)}
                        </td>
                        <td class="col-2 text-center">
                            <div class="row align-items-center justify-content-center gap-1">
                                <a href='${URL_ROOT}/manufacturer-sales/orderDetails/${element.order_id}'
                                class="btn-xs btn-outlined-primary-dark text-center">
                                View Details
                                </a>
                            </div>
                        </td>
                        <td class="col-2 pr-3">
                            <div class="row align-items-center justify-content-center gap-1" id="btn-container">
                                ${renderButtons(element)}
                            </div>
                        </td>
                    </tr>
                `;
        output += row;
      });
      salesList.innerHTML = output
    }
  } else {
    salesList.innerHTML = renderMessageCard("Error Fetching Data");
  }
}

const renderStatus = (orderStatus) => {
  let status = "";

  switch (orderStatus) {
    case("Pending"):
      status = `<span class="badge badge-warning">` + orderStatus + `</span>`
      break;
    case("Accepted"):
      status = `<span class="badge badge-primary">` + orderStatus + `</span>`
      break;
    case("Rejected"):
      status = `<span class="badge badge-danger">` + orderStatus + `</span>`
      break;
    case("Delivered"):
      status = `<span class="badge badge-success">` + orderStatus + `</span>`
      break;
    case("Shipped"):
      status = `<span class="badge badge-secondary">` + orderStatus + `</span>`
      break;
    default:
      status = `<span>` + orderStatus + `</span>`
      break;
  }
  return status;
}

const renderButtons = (element) => {
  let btnList = "";

  if (element.order_status === "Pending") {
    btnList = `
            <div class="px-1">
                <a href='${URL_ROOT}/manufacturer-sales/accept/${element.order_id}>'
                class="btn-xs btn-outlined-primary-dark text-center">
                Accept
                </a>
            </div>
            <div class="px-1">
                <a href='${URL_ROOT}/manufacturer-sales/reject/${element.order_id}'
                    class="btn-xs btn-outlined-error text-center">
                    Reject
                </a>
            </div>
        `;
  } else if (element.order_status === "Accepted") {
    btnList = `
            <div class="px-1">
                <a href='${URL_ROOT}/manufacturer-sales/ship/${element.order_id}>'
                class="btn-xs btn-outlined-primary-dark text-center">
                Ship Items
                </a>
            </div>
        `;
  } else {
    btnList = ``;
  }
  return btnList;
}

document.addEventListener("DOMContentLoaded", () => {
  if (sales == null) {
    salesList.innerHTML = renderMessageCard("Loading");
    fetchSalesList();
  } else {
    renderSalesList(sales);
  }
})
