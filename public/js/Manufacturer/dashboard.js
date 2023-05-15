let sales = null;

const fetchMonthlySales = async () => {
  const res = await fetch(`${URL_ROOT}/manufacturer-dashboard/getSalesPerMonthAsJson`);
  if (res.status === 200) {
    sales = await res.json();
    renderMonthlySalesChart(monthlySalesChart, sales, "Monthly Sales of Products");
  }
}

const renderMonthlySalesChart = (node, data, chartTitle) => {
  //node.querySelector("#chart-hints").innerHTML = "";
  const canvasWrapper = node.querySelector("#canvas-wrapper");
  console.log(node);
  canvasWrapper.innerHTML = `<canvas id="chart-canvas" class="m-auto min-w-100"></canvas>`;
  const chartCanvas = canvasWrapper.querySelector("#chart-canvas");

  // console.log(data.map(d => d.month));
  //
  // for (let i = 1; i<=12; i++){
  //     let output = {
  //         month: i,
  //         monthly_sales = 0;
  //     }
  //
  //     const isFound = data.some(element => {
  //         return element.month === i;
  //     });
  //
  //     if(isFound){
  //        output.month =
  //     }
  // }

  new Chart(chartCanvas, {
    data: {
      labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
      // fillColor: "#8B0000",
      // highlightFill: "#15742D",
      // strokeColor: "rgba(220,220,220,0.8)",
      // highlightStroke: "rgba(210,210,120)",
      datasets: [
        {
          type: 'bar',
          label: 'Month',
          data: data.map(d => {
              return {
                x: d.month,
                y: d.monthly_sales
              }
            }
          ),
          borderWidth: 1,
          backgroundColor: "#5ab2ed",
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
            text: 'Month'
          },
          type: 'linear',
        },
        y: {
          title: {
            display: true,
            text: 'Total Sales'
          },
          type: 'linear',
          // ticks: {
          //     callback: function (value, index, ticks) {
          //         return value;
          //     }
          // }
        }
      }
    }
  });

  chartCanvas.scrollIntoView({behavior: "smooth", block: "end"});
}

const monthlySalesChart = document.querySelector('#monthly_sales_container');

document.addEventListener("DOMContentLoaded", () => {
  if (sales == null) {
    //monthlySalesChart.innerHTML = spinnerHtml();
    fetchMonthlySales();
  } else {
    renderMonthlySalesChart(monthlySalesChart, sales, "Monthly Sales of Products");
  }

});
