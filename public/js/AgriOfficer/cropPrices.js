let selectedDate = null;
const datePicker = document.querySelector("#date-picker");
const priceCardsContainer = document.querySelector("#price-cards-container");

const fetchPricesForDate = async (date) => {
  const res = await fetch(`${URL_ROOT}/CropPrices/getDataAsJson/${date}`);
  if (res.status === 200) {
    console.log(await res.json)
    return await res.json();
  } else {
    alert("Something went wrong");
  }
}

const setCropPrice = async (cropId) => {
  const currentCropCard = document.querySelector(`#crop-card-${cropId}`);
  const minPrice = currentCropCard.querySelector('input[name="min-price"]').value;
  const maxPrice = currentCropCard.querySelector('input[name="max-price"]').value;

  let formData = new FormData;
  formData.append("cropId", cropId);
  formData.append("date", selectedDate);
  formData.append("minPrice", minPrice);
  formData.append("maxPrice", maxPrice);

  const res = await fetch(`${URL_ROOT}/CropPrices/setPrice`, {
    method: "POST", body: formData
  });

  console.log(await res.json);


  if (res.status === 201) {
    alert("Prices saved successfully");
    currentCropCard.querySelector("form").remove();
    currentCropCard.querySelector("ul").innerHTML += `
                        <li>Agri officer set price for district: <strong> Rs. ${minPrice} - Rs. ${maxPrice}</strong></li>
`;
  } else {
    alert("Something went wrong");
  }
}

const handleDateChange = async (selectedDate) => {
  priceCardsContainer.innerHTML = spinnerHtml();
  const data = await fetchPricesForDate(selectedDate);

  const renderPricesList = (cropPrices) => {
    let output = "";
    cropPrices.forEach((cropPrice) => {
      output += `
                <li>${cropPrice.market_name === null ? "Agri officer set price for district:" : cropPrice.market_name} : <strong> Rs. ${cropPrice.low_price} - Rs. ${cropPrice.high_price}</strong></li>
            `
    })

    return output
  }

  if (data != null) {
    if (data.crops.length > 0) {
      output = "";
      data.crops.forEach((crop) => {
        output += `
            <div class="col-12 col-6-md p-3"> 
                                            <div class="product-card p-4" id="crop-card-${crop.id}">
                                                <img src="${URL_ROOT}/public/img/crops/${crop.name}.jpg" class="card-img-top" alt="${crop.name}">
                                                <div class="card-body">
                                                    <h2 class="card-title">${crop.name}</h2>
                                                    <ul>
                                                        ${renderPricesList(data.marketPrices[crop.id])}
                                                    </ul>
                                                    `

        if (data.marketPrices[crop.id].filter((e) => {
          return e.market_name === null
        }).length === 0) {
          output += `<form class="row gap-2 justify-content-center">
                                                        <div class="form-section-title col-6">
                                                            <label for="min-price">Enter the minimum price:</label>
                                                            <input type="number" name="min-price" min="0">
                                                        </div>
                                                        <div class="form-section-title col-6">
                                                            <label for="max-price">Enter the maximum price:</label>
                                                            <input type="number" name="max-price" min="0">
                                                        </div>

                                                        <button type="button"
                                                        onclick="setCropPrice(${crop.id})"
                                                                class="btn-lg btn-primary-light mt-3 text-center text-white">
                                                            Submit
                                                        </button>
                                                    </form>`
        }


        output += `</div>
                                            </div>
                                        </div>
            `
      });

      priceCardsContainer.innerHTML = output;
    }
  }
}

document.addEventListener("DOMContentLoaded", () => {
  datePicker.addEventListener("change", async (e) => {
    selectedDate = e.target.value;

    if (selectedDate != null) {
      await handleDateChange(selectedDate);
    }
  });

  datePicker.valueAsDate = new Date();
  datePicker.dispatchEvent(new Event("change"));
});
