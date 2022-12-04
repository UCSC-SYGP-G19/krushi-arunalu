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