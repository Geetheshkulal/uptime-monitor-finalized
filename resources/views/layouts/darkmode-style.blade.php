<style>
    /* FONT SETUP */
    @import url("https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600;700;800;900&display=swap");
    @import url("https://fonts.googleapis.com/css2?family=Montserrat&display=swap");

    * {
        box-sizing: border-box;
        font-family: "Nunito", sans-serif;
    }

    body {
        font-family: "Montserrat", sans-serif;
        background-color: #fff;
        transition: background 0.2s linear;
    }

    /* DARK MODE SETUP */
    body.dark,
    .dark-mode body,
    .dark-mode #content-wrapper {
        background-color: #181818 !important;
        color: #e0e0e0 !important;
    }

    .dark-mode .card,
    .dark-mode .modal-content,
    .dark-mode .dropdown-menu,
    .dark-mode .bg-white,
    body.dark .navbar,
    body.dark .card,
    body.dark .dropdown-menu {
        background-color: #2b2b2b !important;
        color: #ffffff !important;
    }

    .dark-mode .btn-primary,
    body.dark .btn-primary {
        background-color: #3a3f51 !important;
        border-color: #3a3f51 !important;
    }

    body.dark .btn-secondary {
        background-color: #6c757d !important;
        border-color: #545b62 !important;
    }

    .dark-mode .form-control,
    body.dark input,
    body.dark textarea,
    body.dark select {
        background-color: #2e2e2e !important;
        color: white !important;
        border-color: #444 !important;
    }

    body.dark a,
    .dark-mode a {
        color: #ffffff !important;
    }

    /* SIDEBAR */
    #accordionSidebar {
        background-color: #4e73df;
    }

    body.dark-mode #accordionSidebar {
        background-color: #1e1e2f;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.5);
        border-right: 1px solid #333;
    }

    body.dark-mode #accordionSidebar .nav-link,
    body.dark-mode #accordionSidebar .nav-link i,
    body.dark-mode #accordionSidebar .sidebar-heading,
    body.dark-mode .sidebar-brand-text {
        color: #ffffff;
    }

 

    /* DROPDOWNS */
    body.dark .dropdown-menu {
        background-color: #333 !important;
        border-color: #555 !important;
    }

    body.dark .dropdown-item {
        color: white !important;
    }

    body.dark .dropdown-item:hover {
        background-color: #444 !important;
    }

    /* NAVBAR ELEMENTS */
    body.dark .navbar * {
        color: white !important;
    }

    body.dark .topbar-divider {
        border-color: #555 !important;
    }

   
   body.dark-mode .notification-bell,
   body.dark-mode .white-color {
    color: #ffffff !important;
}

    /* TABLES */

    body.dark-mode .table thead th {
    background-color: #1e1e2f !important;
    color: #ffffff !important;
}

    body.dark-mode .table td {
        border-top: 1px solid #333 !important;
        color: #e0e0e0 !important;
    }

    /* DataTables pagination fix for dark mode */
body.dark-mode .dataTables_wrapper .dataTables_paginate .pagination .paginate_button {
    background-color: #2b2b2b !important;
    color: #ffffff !important;
    border: 1px solid #444 !important;
}

body.dark-mode .dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background-color: #084bbf !important;
    color: white !important;
    border: 1px solid #084bbf !important;
}

body.dark-mode .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
    background-color: #1e1e1e !important;
    color: #777 !important;
    border: 1px solid #333 !important;
    cursor: not-allowed;
}

    /* body.dark .table {
        background-color: #2c2f33 !important;
        color: white !important;
    } */


    /* SCROLLBAR HIDING */
    #accordionSidebar::-webkit-scrollbar {
        display: none;
    }

    /* BADGE COUNTER */
    .badge-counter {
        position: absolute;
        transform: scale(0.7);
        transform-origin: top right;
        right: 2.25rem;
        margin-top: -0.25rem;
        font-size: small;
    }

    /* ICON CIRCLE */
    .icon-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #helpDropdown {
        padding: 10px 15px;
        font-size: 1rem;
        font-weight: 600;
    }

    #helpDropdown i {
        font-size: 1.2rem;
    }

    #helpDropdown .fa-caret-down {
        font-size: 0.9rem;
        margin-left: 5px;
    }

    /* DARK MODE SWITCH */
    #darkModeToggle i {
        transition: color 0.3s ease;
    }

    body.dark #darkModeToggle i {
        color: white !important;
    }
</style>
