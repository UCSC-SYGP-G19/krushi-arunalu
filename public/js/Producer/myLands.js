function showAlert(message) {
  Swal.fire({
    icon: 'warning',
    text: message,
  });
}

function handleLandDeleteClick(landId) {
  window.location.href = `${URL_ROOT}/my-lands/delete/${landId}`;
}

function handleLandEditClick(landId) {
  window.location.href = `${URL_ROOT}/my-lands/edit/${landId}`;
}
