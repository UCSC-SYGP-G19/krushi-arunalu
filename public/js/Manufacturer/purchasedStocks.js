let data = null;

const fetchPurchasedStocks = async () => {
    const res = await fetch(`${URL_ROOT}/purchased-stocks/getJsonForPurchasedStocks`);
    if (res.status === 200) {
        data = await res.json();
        renderPurchasedStocks(data);
    }
}

const renderPurchasedStocks = (data) => {
    let output = "";

    if (data != null) {
        data.forEach((element) => {
            let row = `
                <tr class="row py-2" id="stock-item-${element.stock_item_id}">
                    <td class="col-2">${element.crop_id}</td>
                    <td class="col-2">${element.category_name}</td>
                    <td class="col-3">${element.crop_name}</td>
                    <td class="col-1 text-right">${element.total_quantity}</td>
                    <td class="col-1 text-left pl-3">
                        <img alt="Edit" class="edit-icon"
                        src="${URL_ROOT}/public/img/icons/other/edit-icon.png"
                        onclick="updateStockQuantity(${element.stock_item_id}, ${element.total_quantity})">
                    </td>
                    <td class="col-3">${element.last_purchased_date}</td>
                </tr>
             `;
            output += row;
        });
        purchasedStocksList.innerHTML = output;
    } else {
        renderMessageCard("Error fetching data")
    }
}

const updateStockQuantity = async (cropId, totalQuantity) => {

    modalWindow.innerHTML = `
            <dialog open class="modal-window-box" id="modal-window-box">
                <div class="modal-content pt-1">
                    <div class="px-3 pb-2 modal-window-title">
                        <h4>Update Purchased Stock Quantity</h4>
                    </div>
                    <hr>
                    <div class="px-3 pt-2">
                        <label>Total Quantity</label>
                        <input class="px-1 text-right" id="quantity-box" type="text" name="total-quantity" placeholder="Enter current stock quantity"
                            value="${totalQuantity}">
                    </div>
                    <div class="text-right px-3 py-2">
                        <button class="btn-sm btn-primary-light text-white mr-1" type="submit"
                            onclick="updateQtyInDb(${cropId})">Update</button>
                        <button class="btn-close btn-sm btn-outlined-error" id="close-button" type="reset"
                            onclick="closeWindow()">
                        Close</button>
                    </div>
                </div>
            </dialog>
            `;
}

const updateQtyInDb = async (id) => {

    const quantityBox = document.querySelector('#quantity-box');
    const quantity = quantityBox.value;
    let formData = new FormData();
    formData.append("totalQuantity", quantity);
    const res = await fetch('http://localhost/krushi-arunalu/purchased-stocks/sendUpdatedQuantity/' + id, {
        method: "POST",
        body: formData
    });
    if (res.status === 200) {
        closeWindow();
        fetchPurchasedStocks();
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Quantity Successfully Updated',
            confirmButtonText: 'OK',
        });
    }

}

const closeWindow = () => {
    const modalWindow = document.querySelector('#change-stock-quantity');
    modalWindow.querySelector('dialog').close();
};

document.addEventListener("DOMContentLoaded", () => {
    if (data == null) {
        purchasedStocksList.innerHTML = renderMessageCard("Loading");
        fetchPurchasedStocks();
    }
    renderPurchasedStocks();
});

const purchasedStocksList = document.querySelector("#purchased-stocks");
const modalWindow = document.querySelector('#change-stock-quantity');
const closeButton = modalWindow.querySelector('#close-button');
const dialogBox = modalWindow.querySelector('#modal-window-box');