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

    new Chart(chartCanvas, {
        data: {
            labels: data.map(d => d.month),
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
                                x: Date.parse(d.month),
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
                    type: 'time',
                    time: {
                        unit: 'month',
                        // displayFormats: {
                        //   quarter: 'MM'
                        // }
                    }
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