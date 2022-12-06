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