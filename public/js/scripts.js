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

// Allow to toggle navbar options dropdown
const btnToggleNotificationPanel = document.querySelector('#btn-toggle-notification-panel');

if (btnToggleNotificationPanel) {
  btnToggleNotificationPanel.addEventListener('click', () => {
    btnToggleNotificationPanel.classList.toggle('active');
    document.querySelector('#notifications-panel').classList.toggle('visible');
  });

  document.addEventListener('click', (e) => {
    if (e.target.closest('#btn-toggle-notification-panel') === null) {
      btnToggleNotificationPanel.classList.remove('active');
      document.querySelector('#notifications-panel').classList.remove('visible');
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

const handleNotificationBellClick = () => {
  document.querySelector('#notifications-panel').classList.toggle('visible');
}

function toast(type, title = "", content, duration = 3000) {
  const body = document.querySelector('body');
  const toast = document.createElement('aside');

  toast.classList.add('toast');
  toast.classList.add('enter');

  if (type === 'success') {
    toast.innerHTML = `<div class="check"></div>`;
  } else if (type === 'error') {
    toast.innerHTML = `<div class="error"></div>`;
  } else if (type === 'loading') {
    toast.innerHTML = `<div class="loading"></div>`;
  } else {
    toast.innerHTML = ``;
  }

  toast.innerHTML += `<span> <strong>${title} </strong>${content} </span>`;

  body.appendChild(toast);
  setTimeout(() => {
      toast.classList.remove('enter');
      toast.classList.add('exit');
    }
    , duration);
  setTimeout(() => {
    toast.remove();
  }, duration + 500);
}

// Show flash messages sent by the server
if (message != null) {
  Swal.fire({
    title: message.title,
    text: message.content,
    icon: message.type,
    confirmButtonText: 'OK'
  });
}

// Show toasts sent by the server
if (toastMessage != null) {
  toast(
    toastMessage.type,
    toastMessage.title,
    toastMessage.content,
  );
}
