let productCategories = null;
let table = {}

const fetchProductCategories = async () => {
  const res = await fetch(`${URL_ROOT}/product-categories/getAllCategoriesAsJson`);
  if (res.status === 200) {
    productCategories = await res.json();
    renderProductCategoriesTable(productCategories);
  } else {
    console.log("Error fetching data");
  }
}

const renderProductCategoriesTable = (data) => {
  if (data == null) {
    productCategoriesTable.innerHTML = renderMessageCard("Error fetching data");
    return;
  }

  if (data.length === 0) {
    productCategoriesTable.innerHTML = renderMessageCard("No data to show");
    return;
  }

  table = {
    headers: [
      {key: "name", label: "Category name", class: "col-5 py-2", sortable: true},
      {key: "description", label: "Description", class: "col-7", sortable: true},
    ],
    data: data,
    showSearchAndFilter: true,
    showPagination: true,
    showRowsPerPage: true,
    showSort: true,
    primaryKey: "id",
    activeLink: "product-categories",
    currentPage: 1,
    rowsPerPage: 10,
    activeSortField: "name",
    activeSortOrder: "desc",
    customBody: null,
    noContentMessage: "No data available",
    actionLabels: [""],
    actionUrls: [""],
  }

  renderTable(productCategoriesTable, table);
}

const productCategoriesTable = document.querySelector("#product-categories");

document.addEventListener("DOMContentLoaded", () => {
  if (data == null) {
    productCategoriesTable.innerHTML = renderMessageCard("Loading");
    fetchProductCategories();
  } else {
    renderProductCategoriesTable(data);
  }
});
