<style>
    /* FONT SETUP */
    @import url("https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600;700;800;900&display=swap");
    @import url("https://fonts.googleapis.com/css2?family=Montserrat&display=swap");


    /* admin page darm mode styles */
    :root {
  /* Light Mode Colors */
  --color-bg-light:  #ffffff;
  --color-text-light: #181818;
  --color-primary-light: #4e73df;
  --color-secondary-light: #6c757d;
  --color-border-light: #ddd;
  
  /* Dark Mode Colors */
  --color-bg-dark:#181818;
  --color-card-dark: #1a1a27;
  --color-card-alt-dark: #1e1e2f;
  --color-card-accent-dark: #2b2b2b;
  
  --color-text-dark: #e0e0e0;
  --color-text-muted-dark: #a0a0c0;
  --color-primary-dark: #4e73df;
  --color-border-dark: #2d2d42;
  
  /* Status Colors */
  --color-success: #28a745;
  --color-danger: #dc3545;
  --color-warning: #ffc107;
  
  /* Input/Select Colors */
  --color-input-dark: #2e2e2e;
  --color-input-border-dark: #444;
 
  /* Gradient for upgrade cards */
  --gradient-upgrade-dark: linear-gradient(90deg, var(--color-card-alt-dark), #2e2e4d, #3f3f6b);
}


.dark-mode .upgrade-gradient-card {
    background: var(--color-card-dark);
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
        background-color: var(--color-bg-dark);
        transition: background 0.2s linear;
    }

    /* DARK MODE SETUP */
    html.dark,
    .dark-mode html,
    .dark-mode #content-wrapper {
        background-color: var(--color-text-light) !important;
        color: var(--color-text-dark) !important;
    }

    .dark-mode .card,
    .dark-mode .modal-content,
    .dark-mode .dropdown-menu,
    .dark-mode .bg-white,
    html.dark .navbar,
    html.dark .card,
    html.dark .dropdown-menu {
        background-color: var(--color-card-accent-dark) !important;
        color: var( --color-bg-light) !important;
    }

    .dark-mode .btn-primary,
    html.dark .btn-primary {
        background-color: var(--color-primary-dark);
        border-color: #3a3f51 !important;
    }

    html.dark .btn-secondary {
        background-color: var(--color-secondary-light) !important;
        border-color: #545b62 !important;
    }

    .dark-mode .form-control,
    html.dark input,
    html.dark textarea,
    html.dark select {
        background-color: var(--color-input-dark) !important;
        color: var( --color-bg-light) !important;
        border-color: var(--color-input-border-dark) !important;
    }

    html.dark a,
    .dark-mode a {
        color: var(--color-bg-light) !important;
    }

    html.dark-mode .custom-gold{
        color: var(--color-warning) !important;
    }
  
    /* SIDEBAR */

    html.dark-mode #accordionSidebar {
        background-color: var(--color-card-alt-dark);
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.5);
        border-right: 1px solid var(--color-card-accent-dark);
    }

    html.dark-mode #accordionSidebar .nav-link,
    html.dark-mode #accordionSidebar .nav-link i,
    html.dark-mode #accordionSidebar .sidebar-heading,
    html.dark-mode .sidebar-brand-text {
        color: var(--color-bg-light);
    }

    /* navbar hamburger */
html.dark-mode .topbar #sidebarToggleTop:hover {
    background-color: transparent !important;
    border: none !important;
}

/* DROPDOWNS */

    html.dark .dropdown-item {
        color: rgb(28, 16, 16) !important;
    }

    html.dark-mode .navbar a:hover {
    color: #1c0505 !important;
}

html.dark-mode .navbar .fa-caret-down{
    color: var(--color-bg-light);
}

    /* NAVBAR ELEMENTS */
    html.dark .navbar * {
        color: var(--color-bg-light) !important;
    }

    html.dark .topbar-divider {
        border-color: var(--color-input-border-dark) !important;
    }
   
   html.dark-mode .notification-bell,
   html.dark-mode .white-color {
    color: var(  --color-bg-light) !important;
}

html.dark-mode .dark-bg {
    background-color: var(--color-card-alt-dark) !important;
}

html.dark-mode .select2-results__option--selectable{
    background-color: var(--color-card-alt-dark) !important;
    color: var(  --color-bg-light) !important;
}
html.dark-mode .select2-results__option--highlighted {
    background-color: var(--color-card-alt-dark) !important;
    color: var(  --color-bg-light) !important;
}
html.dark-mode .select2-container--default .select2-search--dropdown .select2-search__field{
    background-color: var(--color-card-alt-dark) !important;
    color: var(  --color-bg-light) !important;
}
html.dark-mode .select2-container--default .select2-selection--single{
    background-color:  var(--color-card-accent-dark) !important;
    color: var(  --color-bg-light) !important;
}
html.dark-mode .select2-container--default .select2-selection--single .select2-selection__rendered{
    color: var(  --color-bg-light) !important;
}


html.dark-mode .select2-dropdown{
    background-color: var(--color-card-alt-dark) !important;
    border: none !important;
}
html.dark-mode .select2-container--default .select2-selection--single,
html.dark-mode .select2-container--default .select2-selection--multiple {
    background-color: var(--color-card-accent-dark) !important;
    color: var(  --color-bg-light) !important;
    border-color: var(  --color-input-border-dark) !important;
}

html.dark-mode .select2-container--default .select2-selection--single .select2-selection__rendered,
html.dark-mode .select2-container--default .select2-selection--multiple .select2-selection__rendered {
    color: var(  --color-bg-light) !important;
}

html.dark-mode .select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: var(--color-input-border-dark) !important;
    border: 1px solid var(--color-input-border-dark) !important;
    color: var(--color-bg-light) !important;
}

html.dark-mode .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: var(--color-border-light) !important;
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
    background-color: var(--color-card-alt-dark) !important;
    color: var(  --color-bg-light) !important;
}

html.dark-mode .table td {
    color: var(--color-text-dark) !important;
}

/* Your pagination styles */
html.dark-mode .pagination .page-item .page-link {
    background-color: var(--color-card-alt-dark) !important;
    border-color: var(--color-card-accent-dark) !important;
    color: var(--color-bg-light) !important;
}

html.dark-mode .pagination .page-item.active .page-link {
    background-color: var(--color-card-accent-dark) !important;
    border-color: var(--color-card-accent-dark)!important;
    color: var(  --color-bg-light) !important;
}

html.dark-mode .pagination .page-item:hover .page-link {
    background-color: var(--color-card-accent-dark) !important;
    color: var(--color-bg-light) !important;
}

    
/* SSL History Table - Dark Mode */
html.dark-mode #sslChecksTable {
    border: none !important;
}

html.dark-mode #sslChecksTable.table-bordered thead th,
html.dark-mode #sslChecksTable.table-bordered thtml td {
    border: none !important;
    background-color: var(--color-card-alt-dark) !important;
    color: var(--color-text-dark) !important;
}

html.dark-mode #sslChecksTable.table-bordered {
    border-collapse: separate !important;
    border-spacing: 0 !important;
}

html.dark-mode .card {
    background-color: var(--color-card-alt-dark) !important;
   
}
html.dark-mode #historyDropdownBtn{
      color: var(--color-text-dark) !important;
    border: 1px solid var(--color-text-dark); 
     background-color: var(--color-card-alt-dark) !important;
}


/* Monitors Section - Dark Mode */
html.dark-mode .monitor-card {
    background-color: var(--color-card-alt-dark) !important;
    border: 1px solid var(--color-border-dark) !important;
    color: var(--color-text-dark) !important;
}

html.dark-mode .monitor-card:hover {
    box-shadow: 0 0.15rem 1.75rem 0 rgba(0, 0, 0, 0.3) !important;
}

html.dark-mode .monitor-name {
    color: var(--color-bg-light) !important;
}

html.dark-mode .monitor-url {
    color: var(--color-text-muted-dark) !important;
}

html.dark-mode .status-indicator-up {
    background-color: var(--color-success) !important;
    box-shadow: 0 0 0 2px var(--color-card-alt-dark), 0 0 0 4px var(--color-success) !important;
}

html.dark-mode .status-indicator-down {
    background-color: var( --color-danger) !important;
    box-shadow: 0 0 0 2px var(--color-card-alt-dark), 0 0 0 4px var( --color-danger) !important;
}

html.dark-mode .status-indicator-paused {
    background-color: var(--color-warning) !important;
    box-shadow: 0 0 0 2px var(--color-card-alt-dark), 0 0 0 4px var(--color-warning) !important;
}


html.dark-mode .status-badge {
    border-radius: 0.375rem !important;
    padding: 4px 35px !important;
    font-weight: 600 !important;
}

html.dark-mode .bg-success-100 {
    background-color: rgba(40, 167, 69, 0.2) !important;
}

html.dark-mode .text-success-800 {
    color: var(--color-success) !important;
}

html.dark-mode .bg-danger-100 {
    background-color: rgba(220, 53, 69, 0.2) !important;
}

html.dark-mode .text-danger-800 {
    color: var( --color-danger) !important;
}

html.dark-mode .bg-warning-100 {
    background-color: rgba(255, 193, 7, 0.2) !important;
}

html.dark-mode .text-warning-800 {
    color: var(--color-warning) !important;
}


html.dark-mode .bars-container {
    background-color: var(--color-card-dark) !important;
    border: 1px solid var(--color-border-dark) !important;
}

html.dark-mode .bar-segment-wrapper:hover .bar-segment {
    opacity: 0.8 !important;
}

html.dark-mode .uptime-legend {
    border-top: 1px solid var(--color-border-dark) !important;
    color: var(--color-text-muted-dark) !important;
}

html.dark-mode .legend-item span {
    color: var(--color-text-dark) !important;
}

/* Monitor stats */
html.dark-mode .monitor-stats {
    color: var(--color-text-muted-dark) !important;
     background-color: var(--color-card-dark) !important;
     border: none !important;
}

html.dark-mode .stat-value {
    color: var(  --color-bg-light) !important;
    font-weight: 600 !important;
}


html.dark-mode .card {
    background-color: var(--color-card-dark) !important;
    border: none;
}

html.dark-mode .card-header {
    background-color: var(--color-card-dark) !important;
    /* border-bottom: 1px solid var(--color-border-dark) !important; */
}

html.dark-mode .text-primary {
    color: var(--color-primary-dark) !important;
}

/* Monitors Section - ends */


/* Dark mode for premium blade */
.dark-mode .upgrade-container {
    /* background-color: #1a1a1a; */
    color: var(--color-text-dark);
}

.dark-mode .page-header h2 {
    color: var(--color-bg-light);
}

.dark-mode .page-header p {
    color: #b0b0b0;
}


.dark-mode .pricing-card {
   background-color: var(--color-card-dark) !important;
    color: var(--color-text-dark);
}


.dark-mode .pricing-card .features-list i.text-success {
    color: var(--color-success) !important;
}

.dark-mode .pricing-card .features-list i.text-danger {
    color: var(--color-danger) !important;
}

.dark-mode .applied-coupon-msg {
    background-color: #3a3a3a;
    color: #a5d6a7;
}

.dark-mode .card-badge {
    background-color: var(--color-primary-dark);
    color: var(  --color-bg-light);
}

.dark-mode .btn-warning {
    background-color: var(--color-warning);
    color: var(--color-bg-light);
} 
 
.dark-mode .btn-disabled {
    background-color: #3a3a3a !important;
    color: var(--color-input-border-dark) !important;
}


.dark-mode .modal-content {
    background-color: #2d2d2d;
    color: var(--color-text-dark);
}
html.dark-mode .modal-header {
    border-bottom: 1px solid var(--color-input-border-dark);
}
html.dark-mode .modal-footer {
    border-top: 1px solid var(--color-input-border-dark);
}
html.dark-mode .modal-header .close {
    color: var(--color-bg-light);
}

.dark-mode input::placeholder {
    color: var(--color-bg-light) !important;
    opacity: 0.7;
}

.dark-mode .btn-close {
    filter: invert(1);
    border: none;
}
.dark-mode .form-control {
    background-color: #3a3a3a;
    border-color: var(--color-input-border-dark);
    color: var(--color-text-dark);
}

.dark-mode .form-control:focus {
    background-color: #4a4a4a;
    color: var(--color-bg-light);
}

/* dark mode for premium blade ends */

.dark-mode .custom-select{
     background-color: #2c2c2c; 
    color: var(--color-bg-light);
    border:none;
}

/* raise ticket file input */
html.dark-mode .custom-file-label {
    background-color: #2a2a2a;
    color: var(--color-bg-light);
    border-color: var(--color-input-border-dark);
}

html.dark-mode .custom-file-input:focus ~ .custom-file-label {
    border-color: #888;
    box-shadow: 0 0 0 0.1rem rgba(255, 255, 255, 0.25);
}

html.dark-mode .custom-file-input {
    background-color: #2a2a2a;
    color: var(--color-bg-light);
    border-color: var(--color-input-border-dark);
}

html.dark-mode .custom-file-label::after {
    background-color: var(--color-input-border-dark);
    color: var(--color-bg-light);
    border-left: 1px solid var(--color-input-border-dark);
}
/* raise ticket file input ends */

/* dark mode for quill editor */
html.dark-mode .ql-toolbar.ql-snow {
    background-color: var(--color-card-dark) ;
    border-color: var(--color-input-border-dark);
    color: var(--color-bg-light);
}

html.dark-mode .ql-toolbar.ql-snow .ql-picker,
html.dark-mode .ql-toolbar.ql-snow .ql-picker-label,
html.dark-mode .ql-toolbar.ql-snow .ql-picker-item {
    color: var(  --color-bg-light);
}

html.dark-mode .ql-toolbar.ql-snow button {
    color: var(--color-bg-light);
    border: none;
}

html.dark-mode .ql-toolbar.ql-snow .ql-stroke {
    stroke: var(--color-bg-light);
}

html.dark-mode .ql-toolbar.ql-snow .ql-fill {
    fill: var(--color-bg-light);
}

html.dark-mode .ql-toolbar.ql-snow .ql-picker-options {
    background-color: #3a3a3a;
    color: var(--color-bg-light);
}

html.dark-mode .ql-container.ql-snow {
    background-color: #1e1e1e;
    color: var(--color-text-dark);
    border-color: var(  --color-input-border-dark);
}
html.dark-mode .ql-editor::before {
    color: #aaa;
}

/* quill editor ends */


/* quill editor for adding comment */
html.dark-mode .comment{
    background-color: var(--color-card-dark) !important;
    color: var(--color-text-dark);
    border:'none';
}

html.dark-mode .comment-header{
    background-color: var(--color-card-dark) !important;
    color: var(--color-text-dark);
}
html.dark-mode .new-comment-header{
       background-color: var(--color-card-dark) !important;
    color: var(--color-text-dark);
}

html.dark-mode .ql-editor {
    background-color: var(--color-card-dark) !important;
    color: #f0f0f0 !important;
}

html.dark-mode .commment-black{
    color:  var(--color-card-dark) !important;
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


    /* DARK MODE SWITCH */
    #darkModeToggle i {
        transition: color 0.3s ease;
    }

    html.dark #darkModeToggle i {
        color: var(--color-bg-light) !important;
        border: 'none' !important;
    }
    
    /* Skeleton background in dark mode */
html.dark-mode .card-body.skeleton {
    background-color: var(--color-card-dark) !important;
    border-radius: 0.4rem;
}

html.dark-mode #sslDetailsContainer .list-group-item{
    background-color: var(--color-card-dark) ;
}

/* admin page dark mode */
html.dark-mode .timeline-item{
    border-bottom: none;
}
html.dark-mode .comment{
    border: none;
}
html.dark-mode .comment-header{
    border-bottom: none;
}
html.dark-mode .new-comment-header{
    border-bottom: none;
}
html.dark-mode .new-comment{
    border: none;
}
html.dark-mode #editor-container{
    border: none;
}
html.dark-mode .ql-toolbar.ql-snow{
    border: none;
}

</style>
