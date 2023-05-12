let selectedCrop = {
  id: null,
  name: null
};
let selectedMarket = {
  id: null,
  name: null
};
let selectedDistrict = {
  id: null,
  name: null
};
let selectedLand = {
  id: null,
  name: null
};

let selectedAgriOfficerPrice = {
  district: {
    id: null,
    name: null,
  },
  date: null
};

const chartContainer1 = document.querySelector("#chart-container-1");
const landDropdown = document.querySelector("#land_dropdown");
const cropDropdown = document.querySelector("#crop_dropdown");
const districtDropdown = document.querySelector("#district_dropdown");
const cropMarketDropdown = document.querySelector("#crop_market_dropdown");
const chartHints = document.querySelector("#chart-hints");
const bestCultivationsContainer = document.querySelector("#best-cultivations-container");
const agriOfficerSetPricesContainer = document.querySelector("#agri-officer-set-prices-container");
const priceDistrictDropdown = document.querySelector("#agri_officer_prices_district_dropdown");
const priceDatePicker = document.querySelector("#agri_officer_prices_date_picker");

const fetchDataForSelectedCropAndMarket = async (cropId, marketId) => {
  let formData = new FormData();
  formData.append("cropId", cropId);
  formData.append("marketId", marketId);

  const res = await fetch(`${URL_ROOT}/producerDashboard/getDataForCropAndMarketAsJson`, {
    method: "POST",
    body: formData
  });

  if (res.status === 200) {
    return await res.json();
  } else {
    toast("error", "", "Error fetching data");
    return null;
  }
}

const fetchDataForSelectedCropAndDistrict = async (cropId, districtId) => {
  let formData = new FormData();
  formData.append("cropId", cropId);
  formData.append("districtId", districtId);

  const res = await fetch(`${URL_ROOT}/producerDashboard/getDataForCropAndDistrictAsJson`, {
    method: "POST",
    body: formData
  });

  if (res.status === 200) {
    return await res.json();
  } else {
    toast("error", "", "Error fetching data");
    return null;
  }
}

const fetchBestCropsForLand = async (landId) => {
  const res = await fetch(`${URL_ROOT}/producerDashboard/getBestCropsForLand/${landId}`);

  if (res.status === 200) {
    return await res.json();
  } else {
    toast("error", "", "Error fetching best cultivations data");
    return null;
  }
}

const fetchAgriOfficerSetCropPricesForDistrictOnDate = async (districtId, date) => {
  let formData = new FormData();
  formData.append("districtId", districtId);
  formData.append("date", date);

  const res = await fetch(`${URL_ROOT}/producerDashboard/fetchAgriOfficerSetCropPricesForDistrictOnDate`, {
    method: "POST",
    body: formData
  });

  if (res.status === 200) {
    return await res.json();
  } else {
    toast("error", "", "Error fetching agri-officer crop prices data");
    return null;
  }
}

const handlePriceVariationDropdownChange = async () => {
  if (selectedCrop.id != null) {
    if (selectedMarket.id != null) {
      // toast("loading", "", "Loading", 1000);
      chartHints.innerHTML = spinnerHtml();
      const data = await fetchDataForSelectedCropAndMarket(selectedCrop.id, selectedMarket.id);
      if (data != null && data.length > 0) {
        document.querySelector(".data-courtesy-tag").classList.remove("d-none");
        renderChartUsingChartJs(chartContainer1, data, `Wholesale price variation of ${selectedCrop.name} in ${selectedMarket.name} during 2023`);
      } else {
        chartHints.classList.remove("d-none");
        chartHints.innerHTML = `
    <div class="col-12 py-1">
       <p class="text-center">
          No data available for ${selectedCrop.name} in ${selectedMarket.name}
        </p>                                         
    </div>`;
        chartContainer1.querySelector(".canvas-wrapper").innerHTML = "";
      }

    } else if (selectedDistrict.id != null) {
      // toast("loading", "", "Loading", 1000);
      chartHints.innerHTML = spinnerHtml();
      const data = await fetchDataForSelectedCropAndDistrict(selectedCrop.id, selectedDistrict.id);
      if (data != null && data.length > 0) {
        document.querySelector(".data-courtesy-tag").classList.add("d-none");
        renderChartUsingChartJs(chartContainer1, data, `Agri-officer set price variation of ${selectedCrop.name} in ${selectedDistrict.name} during 2023`);
      } else {
        chartHints.classList.remove("d-none");
        chartHints.innerHTML = `
    <div class="col-12 py-1">
       <p class="text-center">
          No data available for ${selectedCrop.name} in ${selectedDistrict.name}
        </p>                                         
    </div>`;
        chartContainer1.querySelector(".canvas-wrapper").innerHTML = "";
      }


    } else {
      chartHints.innerHTML = `
    <div class="col-12 py-1">
       <p class="text-center">
          Select a market or a district to view chart
        </p>                                         
    </div>`;
      toast("warning", "", "Select a market or a district to view data");
    }
  } else {
    chartHints.innerHTML = `
    <div class="col-12 py-1">
       <p class="text-center">
          Select a crop to view chart
        </p>                                         
    </div>`;
    toast("warning", "", "Select a crop to view data");
  }
}

const handleBestCultivationsForLandChange = async () => {
  if (selectedLand.id != null) {
    // toast("loading", "", "Loading", 1000);
    bestCultivationsContainer.innerHTML = spinnerHtml();

    const data = await fetchBestCropsForLand(selectedLand.id);
    if (data != null && data.length > 0) {
      let output = "";
      data.forEach(row => {
        let imgUrl = `${URL_ROOT}/public/img/crops/${row.crop_image_url}`;
        output += `<li class="py-1 row">
            <div class="col-2">
              <div class="crop-pic-rounded" style="background-image: url(${imgUrl})">
              </div>
            </div>
            <div class="col-10 pl-2 m-auto">
              <h4 class="fw-bold">${row.crop_name}</h4>
<!--              <h5 class="fw-normal">Subheading</h5>-->
            </div>
          </li>`;
      });

      bestCultivationsContainer.innerHTML = output;

    } else {
      bestCultivationsContainer.innerHTML = `
    <div class="col-12 py-1">
       <p class="text-center">
          No data available for ${selectedCrop.name} in ${selectedMarket.name}
        </p>                                         
    </div>`;
    }

  }
}

const handleAgriOfficerPricesDropdownChange = async () => {
  if (selectedAgriOfficerPrice.district.id != null) {
    if (selectedAgriOfficerPrice.date != null) {
      // toast("loading", "", "Loading", 1000);
      agriOfficerSetPricesContainer.innerHTML = spinnerHtml();
      const data = await fetchAgriOfficerSetCropPricesForDistrictOnDate(selectedAgriOfficerPrice.district.id, selectedAgriOfficerPrice.date);

      if (data != null && data.length > 0) {
        let output = "<ul>";

        data.forEach(row => {
          output += `<li class="py-1 row">
                        <div class="col-6">
                            <h4 class="fw-bold">${row.crop_name}</h4>
                            <h5 class="fw-normal">Retail Price</h5>
                        </div>
                        <div class="col-6">
                            <h4 class="fw-bold text-primary-light">Rs. ${row.low_price} - Rs. ${row.high_price}</h4>
                            <h5 class="fw-normal">Per KG</h5>
                        </div>
                     </li>`;
        });

        output += "</ul>"

        agriOfficerSetPricesContainer.innerHTML = output;

      } else {
        agriOfficerSetPricesContainer.innerHTML = `
    <div class="col-12 pt-4 pb-3 mt-5 px-5">
       <p class="text-center fs-3 text-secondary pt-1">
          No crops prices available for ${selectedAgriOfficerPrice.district.name} on ${selectedAgriOfficerPrice.date}
        </p>                                         
    </div>`;
      }
    } else {
      // toast("warning", "", "Select a date to view crop prices set by agri-officers");
    }
  } else {
    toast("warning", "", "Select a district to view crop prices set by agri-officers");
  }
}

const renderChartUsingChartJs = (node, data, chartTitle) => {
  node.querySelector("#chart-hints").innerHTML = "";
  const canvasWrapper = node.querySelector(".canvas-wrapper");
  canvasWrapper.innerHTML = `<canvas id="chart-canvas" class="m-auto min-w-100"></canvas>`;
  const chartCanvas = canvasWrapper.querySelector("#chart-canvas");

  const timeZoneStr = " 00:00:00 GMT+0530";

  new Chart(chartCanvas, {
    data: {
      labels: data.map(d => d.date),
      // fillColor: "#8B0000",
      // highlightFill: "#15742D",
      // strokeColor: "rgba(220,220,220,0.8)",
      // highlightStroke: "rgba(210,210,120)",
      datasets: [
        {
          type: 'line',
          label: 'Low price',
          data: data.map(d => {
              return {
                x: Date.parse(d.date + timeZoneStr),
                y: d.low_price
              }
            }
          ),
          borderWidth: 2,
          backgroundColor: "#CC3636",
        },
        {
          type: 'line',
          label: 'High price',
          data: data.map(d => {
              return {
                x: Date.parse(d.date + timeZoneStr),
                y: d.high_price
              }
            }
          ),
          borderWidth: 2,
          backgroundColor: "#E7A811",
        },
        {
          type: 'bar',
          label: 'Avg price',
          data: data.map(d => {
              return {
                x: Date.parse(d.date + timeZoneStr),
                y: (d.low_price + d.high_price) / 2
              }
            }
          ),
          borderWidth: 1,
          backgroundColor: "#D9F0BE",
        }
      ]
    },
    options: {
      plugins: {
        title: {
          display: true,
          text: chartTitle
        },
      },
      scales: {
        x: {
          title: {
            display: true,
            text: 'Time of year'
          },
          type: 'time',
          time: {
            unit: 'day',
            // displayFormats: {
            //   quarter: 'MM YYYY'
            // }
          }
        },
        y: {
          title: {
            display: true,
            text: 'Whole-sale price per KG'
          },
          type: 'linear',
          ticks: {
            callback: function (value, index, ticks) {
              return 'Rs. ' + value;
            }
          }
        }
      }
    }
  });

  chartCanvas.scrollIntoView({behavior: "smooth", block: "end"});
  chartHints.classList.add("d-none");
}

cropDropdown.addEventListener("change", async (e) => {
  selectedCrop.id = e.target.value;
  selectedCrop.name = e.target.options[e.target.selectedIndex].text;
  // toast("success", "", `${selectedCrop.name} selected`);

  handlePriceVariationDropdownChange();
});

cropMarketDropdown.addEventListener("change", async (e) => {
  selectedMarket.id = e.target.value;
  selectedMarket.name = e.target.options[e.target.selectedIndex].text;
  // toast("success", "", `${selectedMarket.name} selected`);

  if (selectedDistrict.id != null) {
    selectedDistrict.id = null;
    districtDropdown.selectedIndex = 0;
  }

  handlePriceVariationDropdownChange();
});

districtDropdown.addEventListener("change", async (e) => {
  selectedDistrict.id = e.target.value;
  selectedDistrict.name = e.target.options[e.target.selectedIndex].text;
  // toast("success", "", `${selectedMarket.name} selected`);

  if (selectedDistrict.id != null) {
    selectedMarket.id = null;
    cropMarketDropdown.selectedIndex = 0;
  }

  handleAgriOfficerPricesDistrictChange();
});

// if (cropDropdown.selectedIndex !== 0) {
//   cropDropdown.dispatchEvent(new Event("change"));
// }
//
// if (cropMarketDropdown.selectedIndex !== 0) {
//   cropMarketDropdown.dispatchEvent(new Event("change"));
// }


landDropdown.addEventListener("change", async (e) => {
  selectedLand.id = e.target.value;
  selectedLand.name = e.target.options[e.target.selectedIndex].text;
  // toast("success", "", `${selectedLand.name} selected`);

  handleBestCultivationsForLandChange();
});

priceDatePicker.addEventListener("change", async (e) => {
  selectedAgriOfficerPrice.date = e.target.value;
  // toast("success", "", `${selectedDate} selected`);
  handleAgriOfficerPricesDropdownChange();
});
priceDistrictDropdown.addEventListener("change", async (e) => {
  selectedAgriOfficerPrice.district.id = e.target.value;
  selectedAgriOfficerPrice.district.name = e.target.options[e.target.selectedIndex].text;
  // toast("success", "", `${selectedLand.name} selected`);

  handleAgriOfficerPricesDropdownChange();
});

// find if landDropdown has any options
if (landDropdown.options.length > 0) {
  landDropdown.selectedIndex = 0;
  landDropdown.dispatchEvent(new Event("change"));
}

if (priceDistrictDropdown.options.length > 0) {
  priceDistrictDropdown.selectedIndex = 0;
  priceDistrictDropdown.dispatchEvent(new Event("change"));
}

priceDatePicker.valueAsDate = new Date();
priceDatePicker.dispatchEvent(new Event("change"));
priceDatePicker.max = new Date().toISOString().split("T")[0];
