let selectedCrop = {
  id: null,
  name: null
};
let selectedMarket = {
  id: null,
  name: null
};

const chartContainer1 = document.querySelector("#chart-container-1");
const cropDropdown = document.querySelector("#crop_dropdown");
const cropMarketDropdown = document.querySelector("#crop_market_dropdown");
const chartHints = document.querySelector("#chart-hints");

const fetchDataForSelectedCropAndMarket = async ($cropId, $marketId) => {
  let formData = new FormData();
  formData.append("cropId", $cropId);
  formData.append("marketId", $marketId);

  const res = await fetch(`${URL_ROOT}/producerDashboard/getDataForCropAndMarketAsJson`, {
    method: "POST",
    body: formData
  });

  if (res.status === 200) {
    return await res.json();
  } else {
    toast("Error fetching data", "error");
    return null;
  }
}

const handleOnChange = async () => {
  if (selectedCrop.id != null) {
    if (selectedMarket.id != null) {
      // toast("loading", "", "Loading", 1000);
      chartHints.innerHTML = spinnerHtml();
      const data = await fetchDataForSelectedCropAndMarket(selectedCrop.id, selectedMarket.id);
      if (data != null && data.length > 0) {
        renderChartUsingChartJs(chartContainer1, data);
      } else {
        chartHints.innerHTML = `
    <div class="col-12 py-1">
       <p class="text-center">
          No data available for ${selectedCrop.name} in ${selectedMarket.name}
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

const renderChartUsingChartJs = (node, data) => {
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
          text: `Wholesale price variation of ${selectedCrop.name} in ${selectedMarket.name} during 2023`
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
  document.querySelector(".data-courtesy-tag").classList.remove("d-none");
}

cropDropdown.addEventListener("change", async (e) => {
  selectedCrop.id = e.target.value;
  selectedCrop.name = e.target.options[e.target.selectedIndex].text;
  // toast("success", "", `${selectedCrop.name} selected`);

  handleOnChange();
});

cropMarketDropdown.addEventListener("change", async (e) => {
  selectedMarket.id = e.target.value;
  selectedMarket.name = e.target.options[e.target.selectedIndex].text;
  // toast("success", "", `${selectedMarket.name} selected`);
  handleOnChange();
});

// if (cropDropdown.selectedIndex !== 0) {
//   cropDropdown.dispatchEvent(new Event("change"));
// }
//
// if (cropMarketDropdown.selectedIndex !== 0) {
//   cropMarketDropdown.dispatchEvent(new Event("change"));
// }

