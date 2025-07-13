<style>
    /* FONT SETUP */
    @import url("https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600;700;800;900&display=swap");
    @import url("https://fonts.googleapis.com/css2?family=Montserrat&display=swap");


    /* admin page darm mode styles */

    /* Fix dropdown item hover color in dark mode */
/* html.dark-mode .dropdown-menu .dropdown-item:hover {
    background-color: #2a2a2a !important;
    color: #ffffff !important;          
} */

.dark-mode .upgrade-gradient-card {
    background: linear-gradient(90deg, #1e1e2f, #2e2e4d, #3f3f6b);
    border: none;
    border-radius: 8px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
}

.dark-mode .nav-link:focus, 
.dark-mode .nav-link:focus-visible {
    border: none !important;
    outline: none !important;
    box-shadow: none !important;
}

  html.dark-mode .nav-tabs {
    border-bottom: none;
  }

    * {
        box-sizing: border-box;
        font-family: "Nunito", sans-serif;
    }

    html {
        font-family: "Montserrat", sans-serif;
        background-color: #fff;
        transition: background 0.2s linear;
    }

    /* DARK MODE SETUP */
    html.dark,
    .dark-mode html,
    .dark-mode #content-wrapper {
        background-color: #181818 !important;
        color: #e0e0e0 !important;
    }

    .dark-mode .card,
    .dark-mode .modal-content,
    .dark-mode .dropdown-menu,
    .dark-mode .bg-white,
    html.dark .navbar,
    html.dark .card,
    html.dark .dropdown-menu {
        background-color: #2b2b2b !important;
        color: #ffffff !important;
    }

    .dark-mode .btn-primary,
    html.dark .btn-primary {
        background-color: #4e73df;
        /* background-color: #3a3f51 !important; */
        border-color: #3a3f51 !important;
    }

    html.dark .btn-secondary {
        background-color: #6c757d !important;
        border-color: #545b62 !important;
    }

    .dark-mode .form-control,
    html.dark input,
    html.dark textarea,
    html.dark select {
        background-color: #2e2e2e !important;
        color: white !important;
        border-color: #444 !important;
    }

    html.dark a,
    .dark-mode a {
        color: #ffffff !important;
    }

    html.dark-mode .custom-gold{
        color:yellow !important;
    }
  
    /* SIDEBAR */
    #accordionSidebar {
        background-color: #4e73df;
    }

    html.dark-mode #accordionSidebar {
        background-color: #1e1e2f;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.5);
        border-right: 1px solid #333;
    }

    html.dark-mode #accordionSidebar .nav-link,
    html.dark-mode #accordionSidebar .nav-link i,
    html.dark-mode #accordionSidebar .sidebar-heading,
    html.dark-mode .sidebar-brand-text {
        color: #ffffff;
    }

    /* navbar hamburger */
html.dark-mode .topbar #sidebarToggleTop:hover {
    background-color: transparent !important;
    border: none !important;
}

 

/* DROPDOWNS */
    /* html.dark .dropdown-menu {
        background-color: #ff0000 !important;
        border-color: #555 !important;
    } */

    html.dark .dropdown-item {
        color: rgb(28, 16, 16) !important;
    }

    html.dark-mode .navbar a:hover {
    color: #1c0505 !important;
}

html.dark-mode .navbar .fa-caret-down{
    color: #ffffff;
}

    /* html.dark-mode .text-gray-500 {
        color: rgb(28, 16, 16) !important;
    } */

    /* NAVBAR ELEMENTS */
    html.dark .navbar * {
        color: white !important;
    }

    html.dark .topbar-divider {
        border-color: #555 !important;
    }

   
   html.dark-mode .notification-bell,
   html.dark-mode .white-color {
    color: #ffffff !important;
}

html.dark-mode .dark-bg {
    background-color: #1e1e2f !important;
}

html.dark-mode .select2-results__option--selectable{
    background-color: #1e1e2f !important;
    color: #ffffff !important;
}
html.dark-mode .select2-results__option--highlighted {
    background-color: #1e1e2f !important;
    color: #ffffff !important;
}
html.dark-mode .select2-container--default .select2-search--dropdown .select2-search__field{
    background-color: #1e1e2f !important;
    color: #ffffff !important;
}
html.dark-mode .select2-container--default .select2-selection--single{
    background-color:  #333 !important;
    color: #ffffff !important;
}
html.dark-mode .select2-container--default .select2-selection--single .select2-selection__rendered{
    color: #ffffff !important;
}
/* TABLES */

html.dark-mode .table {
    border-collapse: collapse !important;
    border: none !important;
}

html.dark-mode .table td, 
html.dark-mode .table th {
    border: none !important;
}

/* Keep your existing table styles */
html.dark-mode .table thead th {
    background-color: #1e1e2f !important;
    color: #ffffff !important;
}

html.dark-mode .table td {
    color: #e0e0e0 !important;
}

/* Your pagination styles */
html.dark-mode .pagination .page-item .page-link {
    background-color: #1e1e2f !important;
    border-color: #333 !important;
    color: #ffffff !important;
}

html.dark-mode .pagination .page-item.active .page-link {
    background-color: #000000 !important;
    border-color: #000000 !important;
    color: #ffffff !important;
}

html.dark-mode .pagination .page-item:hover .page-link {
    background-color: #333 !important;
    color: #ffffff !important;
}

    
/* SSL History Table - Dark Mode */
html.dark-mode #sslChecksTable {
    border: none !important;
}

html.dark-mode #sslChecksTable.table-bordered thead th,
html.dark-mode #sslChecksTable.table-bordered thtml td {
    border: none !important;
    background-color: #1e1e2f !important;
    color: #e0e0e0 !important;
}

html.dark-mode #sslChecksTable.table-bordered {
    border-collapse: separate !important;
    border-spacing: 0 !important;
}

html.dark-mode .card {
    background-color: #1e1e2f !important;
    border: none !important;
}
html.dark-mode #historyDropdownBtn{
      color: #e0e0e0 !important;
    border: 1px solid #e0e0e0; 
     background-color: #1e1e2f !important;
}


/* Monitors Section - Dark Mode */
html.dark-mode .monitor-card {
    background-color: #1e1e2f !important;
    border: 1px solid #2d2d42 !important;
    color: #e0e0e0 !important;
}

html.dark-mode .monitor-card:hover {
    box-shadow: 0 0.15rem 1.75rem 0 rgba(0, 0, 0, 0.3) !important;
}

html.dark-mode .monitor-name {
    color: #ffffff !important;
}

html.dark-mode .monitor-url {
    color: #a0a0c0 !important;
}

html.dark-mode .status-indicator-up {
    background-color: #28a745 !important;
    box-shadow: 0 0 0 2px #1e1e2f, 0 0 0 4px #28a745 !important;
}

html.dark-mode .status-indicator-down {
    background-color: #dc3545 !important;
    box-shadow: 0 0 0 2px #1e1e2f, 0 0 0 4px #dc3545 !important;
}

html.dark-mode .status-indicator-paused {
    background-color: #ffc107 !important;
    box-shadow: 0 0 0 2px #1e1e2f, 0 0 0 4px #ffc107 !important;
}


html.dark-mode .status-badge {
    border-radius: 0.375rem !important;
    padding: 0.25rem 0.5rem !important;
    font-weight: 600 !important;
}

html.dark-mode .bg-success-100 {
    background-color: rgba(40, 167, 69, 0.2) !important;
}

html.dark-mode .text-success-800 {
    color: #28a745 !important;
}

html.dark-mode .bg-danger-100 {
    background-color: rgba(220, 53, 69, 0.2) !important;
}

html.dark-mode .text-danger-800 {
    color: #dc3545 !important;
}

html.dark-mode .bg-warning-100 {
    background-color: rgba(255, 193, 7, 0.2) !important;
}

html.dark-mode .text-warning-800 {
    color: #ffc107 !important;
}


html.dark-mode .bars-container {
    background-color: #1a1a27 !important;
    border: 1px solid #2d2d42 !important;
}

html.dark-mode .bar-segment-wrapper:hover .bar-segment {
    opacity: 0.8 !important;
}

html.dark-mode .uptime-legend {
    border-top: 1px solid #2d2d42 !important;
    color: #a0a0c0 !important;
}

html.dark-mode .legend-item span {
    color: #e0e0e0 !important;
}

/* Monitor stats */
html.dark-mode .monitor-stats {
    color: #a0a0c0 !important;
     background-color: #1a1a27 !important;
     border: none !important;
}

html.dark-mode .stat-value {
    color: #ffffff !important;
    font-weight: 600 !important;
}


html.dark-mode .card {
    background-color: #1a1a27 !important;
    border: none !important;
}

html.dark-mode .card-header {
    background-color: #1a1a27 !important;
    /* border-bottom: 1px solid #2d2d42 !important; */
}

html.dark-mode .text-primary {
    color: #6cb2eb !important;
}

/* Monitors Section - ends */


/* Dark mode for premium blade */
.dark-mode .upgrade-container {
    /* background-color: #1a1a1a; */
    color: #e0e0e0;
}

.dark-mode .page-header h2 {
    color: #ffffff;
}

.dark-mode .page-header p {
    color: #b0b0b0;
}


.dark-mode .pricing-card {
   background-color: #1a1a27 !important;
    color: #e0e0e0;
}


.dark-mode .pricing-card.basic {
    background-color: #252525;
}

.dark-mode .pricing-card.premium {
    background-color: #2a2a2a;
    border-color: #ffc107;
}

.dark-mode .pricing-card .features-list {
    color: #d0d0d0;
}

.dark-mode .pricing-card .features-list i.text-success {
    color: #4caf50 !important;
}

.dark-mode .pricing-card .features-list i.text-danger {
    color: #f44336 !important;
}

.dark-mode .applied-coupon-msg {
    background-color: #3a3a3a;
    color: #a5d6a7;
}

.dark-mode .card-badge {
    background-color: #2980b9;
    color: #fff;
}

.dark-mode .current-plan {
    background-color: #2980b9;
    color: #fff;
}

.dark-mode .btn-warning {
    background-color: #d4a017;
    color: #fff;
} 
 
.dark-mode .btn-disabled {
    background-color: #3a3a3a !important;
    color: #777 !important;
}

.dark-mode .modal-content {
    background-color: #2d2d2d;
    color: #e0e0e0;
}
html.dark-mode .modal-header {
    border-bottom: 1px solid #444;
}
html.dark-mode .modal-footer {
    border-top: 1px solid #444;
}
html.dark-mode .modal-header .close {
    color: #ffffff;
}

.dark-mode .form-control {
    background-color: #3a3a3a;
    border-color: #555;
    color: #e0e0e0;
}

.dark-mode .form-control:focus {
    background-color: #4a4a4a;
    color: #fff;
}

/* dark mode for premium blade ends */

.dark-mode .custom-select{
     background-color: #2c2c2c; 
    color: #fff;
    border:none;
}

/* raise ticket file input */
html.dark-mode .custom-file-label {
    background-color: #2a2a2a;
    color: #ffffff;
    border-color: #555;
}

html.dark-mode .custom-file-input:focus ~ .custom-file-label {
    border-color: #888;
    box-shadow: 0 0 0 0.1rem rgba(255, 255, 255, 0.25);
}

html.dark-mode .custom-file-input {
    background-color: #2a2a2a;
    color: #ffffff;
    border-color: #555;
}
html.dark-mode .custom-file-label::after {
    background-color: #444;
    color: #fff;
    border-left: 1px solid #555;
}
/* raise ticket file input ends */

/* dark mode for quill editor */
html.dark-mode .ql-toolbar.ql-snow {
    background-color: #1a1a27 ;
    border-color: #444;
    color: #fff;
}

html.dark-mode .ql-toolbar.ql-snow .ql-picker,
html.dark-mode .ql-toolbar.ql-snow .ql-picker-label,
html.dark-mode .ql-toolbar.ql-snow .ql-picker-item {
    color: #fff;
}

html.dark-mode .ql-toolbar.ql-snow button {
    color: #fff;
    border: none;
}

html.dark-mode .ql-toolbar.ql-snow .ql-stroke {
    stroke: #ffffff;
}

html.dark-mode .ql-toolbar.ql-snow .ql-fill {
    fill: #ffffff;
}

html.dark-mode .ql-toolbar.ql-snow .ql-picker-options {
    background-color: #3a3a3a;
    color: #fff;
}

html.dark-mode .ql-container.ql-snow {
    background-color: #1e1e1e;
    color: #e0e0e0;
    border-color: #444;
}
html.dark-mode .ql-editor::before {
    color: #aaa;
}

/* quill editor ends */


/* quill editor for adding comment */
html.dark-mode .comment{
    background-color: #1a1a27 !important;
    color: #e0e0e0;
    border:'none';
}

html.dark-mode .comment-header{
    background-color: #1a1a27 !important;
    color: #e0e0e0;
}
html.dark-mode .new-comment-header{
       background-color: #1a1a27 !important;
    color: #e0e0e0;
}

html.dark-mode .ql-editor {
    background-color: #1a1a27 !important;
    color: #f0f0f0 !important;
}

html.dark-mode .commment-black{
    color:  #1a1a27 !important;
}

/* quill editor for adding comments ends */

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

    /* #helpDropdown .fa-caret-down {
        font-size: 0.9rem;
        margin-left: 5px;
    } */

    /* DARK MODE SWITCH */
    #darkModeToggle i {
        transition: color 0.3s ease;
    }

    html.dark #darkModeToggle i {
        color: white !important;
        border: 'none' !important;
    }
    
    /* Skeleton background in dark mode */
html.dark-mode .card-body.skeleton {
    background-color: #1a1a27 !important;
    border-radius: 0.4rem;
}

html.dark-mode #sslDetailsContainer .list-group-item{
    background-color: #1a1a27 ;
}




</style>
