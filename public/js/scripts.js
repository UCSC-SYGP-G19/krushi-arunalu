// Allow to collapse or expand sidebar
const btnToggleSidebar = document.querySelector('#btn-toggle-sidebar');

if (localStorage.getItem("sidebarCollapsed") === "true") {
    document.querySelector('aside.sidebar').classList.toggle('sidebar-collapsed');
}

if (btnToggleSidebar) {
  btnToggleSidebar.addEventListener('click', () => {
    let sidebarCollapsed = document.querySelector('aside.sidebar').classList.toggle('sidebar-collapsed');
    localStorage.setItem("sidebarCollapsed", sidebarCollapsed.toString());
  });
}

// Allow to toggle navbar options dropdown
const btnToggleNavbarOptions = document.querySelector('#btn-toggle-navbar-options');

if (btnToggleNavbarOptions) {
  btnToggleNavbarOptions.addEventListener('click', () => {
    document.querySelector('#navbar-options-panel').classList.toggle('visible');
  });

  document.addEventListener('click', (e) => {
    if (e.target.closest('#btn-toggle-navbar-options') === null) {
      document.querySelector('#navbar-options-panel').classList.remove('visible');
    }
  });
}

const renderMessageCard = (message) => {
  return `<div class="message-card p-3 mb-2">${message}</div>`;
}

const handleEditClick = (path) => {
  location.href = path;
}

const handleDeleteClick = (path) => {
  Swal.fire({
    title: 'Are you sure?',
    showCancelButton: true,
    confirmButtonText: 'Yes',
  }).then((result) => {
    if (result.isConfirmed) {
      location.href = path;
    }
  })
}

// Show flash messages sent by the server
if (message != null) {
  Swal.fire({
    title: message.title,
    text: message.content,
    icon: message.type,
    confirmButtonText: 'OK'
  })
}


