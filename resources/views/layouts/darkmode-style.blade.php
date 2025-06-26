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

body.dark-mode .table {
    border-collapse: collapse !important;
    border: none !important;
}

body.dark-mode .table td, 
body.dark-mode .table th {
    border: none !important;
}

/* Keep your existing table styles */
body.dark-mode .table thead th {
    background-color: #1e1e2f !important;
    color: #ffffff !important;
}

body.dark-mode .table td {
    color: #e0e0e0 !important;
}

/* Your pagination styles */
body.dark-mode .pagination .page-item .page-link {
    background-color: #1e1e2f !important;
    border-color: #333 !important;
    color: #ffffff !important;
}

body.dark-mode .pagination .page-item.active .page-link {
    background-color: #000000 !important;
    border-color: #000000 !important;
    color: #ffffff !important;
}

body.dark-mode .pagination .page-item:hover .page-link {
    background-color: #333 !important;
    color: #ffffff !important;
}

    
/* SSL History Table - Dark Mode */
body.dark-mode #sslChecksTable {
    border: none !important;
}

body.dark-mode #sslChecksTable.table-bordered thead th,
body.dark-mode #sslChecksTable.table-bordered tbody td {
    border: none !important;
    background-color: #1e1e2f !important;
    color: #e0e0e0 !important;
}

body.dark-mode #sslChecksTable.table-bordered {
    border-collapse: separate !important;
    border-spacing: 0 !important;
}

body.dark-mode .card {
    background-color: #1e1e2f !important;
    border: none !important;
}
body.dark-mode #historyDropdownBtn{
      color: #e0e0e0 !important;
    border: 1px solid #e0e0e0; 
     background-color: #1e1e2f !important;
}

/* body.dark-mode .card-header {
    background-color: #1a1a27 !important;
    border-bottom: 1px solid #2d2d42 !important;
} */


/* Monitors Section - Dark Mode */
body.dark-mode .monitor-card {
    background-color: #1e1e2f !important;
    border: 1px solid #2d2d42 !important;
    color: #e0e0e0 !important;
}

body.dark-mode .monitor-card:hover {
    box-shadow: 0 0.15rem 1.75rem 0 rgba(0, 0, 0, 0.3) !important;
}

body.dark-mode .monitor-name {
    color: #ffffff !important;
}

body.dark-mode .monitor-url {
    color: #a0a0c0 !important;
}

body.dark-mode .status-indicator-up {
    background-color: #28a745 !important;
    box-shadow: 0 0 0 2px #1e1e2f, 0 0 0 4px #28a745 !important;
}

body.dark-mode .status-indicator-down {
    background-color: #dc3545 !important;
    box-shadow: 0 0 0 2px #1e1e2f, 0 0 0 4px #dc3545 !important;
}

body.dark-mode .status-indicator-paused {
    background-color: #ffc107 !important;
    box-shadow: 0 0 0 2px #1e1e2f, 0 0 0 4px #ffc107 !important;
}


body.dark-mode .status-badge {
    border-radius: 0.375rem !important;
    padding: 0.25rem 0.5rem !important;
    font-weight: 600 !important;
}

body.dark-mode .bg-success-100 {
    background-color: rgba(40, 167, 69, 0.2) !important;
}

body.dark-mode .text-success-800 {
    color: #28a745 !important;
}

body.dark-mode .bg-danger-100 {
    background-color: rgba(220, 53, 69, 0.2) !important;
}

body.dark-mode .text-danger-800 {
    color: #dc3545 !important;
}

body.dark-mode .bg-warning-100 {
    background-color: rgba(255, 193, 7, 0.2) !important;
}

body.dark-mode .text-warning-800 {
    color: #ffc107 !important;
}


body.dark-mode .bars-container {
    background-color: #1a1a27 !important;
    border: 1px solid #2d2d42 !important;
}

body.dark-mode .bar-segment-wrapper:hover .bar-segment {
    opacity: 0.8 !important;
}

body.dark-mode .uptime-legend {
    border-top: 1px solid #2d2d42 !important;
    color: #a0a0c0 !important;
}

body.dark-mode .legend-item span {
    color: #e0e0e0 !important;
}

/* Monitor stats */
body.dark-mode .monitor-stats {
    color: #a0a0c0 !important;
     background-color: #1a1a27 !important;
     border: none !important;
}

body.dark-mode .stat-value {
    color: #ffffff !important;
    font-weight: 600 !important;
}


body.dark-mode .card {
    background-color: #1a1a27 !important;
    border: none !important;
}

body.dark-mode .card-header {
    background-color: #1a1a27 !important;
    border-bottom: 1px solid #2d2d42 !important;
}

body.dark-mode .text-primary {
    color: #6cb2eb !important;
}

/* Monitors Section - ends */

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
