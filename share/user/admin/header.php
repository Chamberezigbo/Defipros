<!DOCTYPE html>
<html>

<head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <title>APA</title>
     <meta name="description" content="">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <meta name="robots" content="all,follow">
     <!-- Google fonts - Poppins -->
     <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
     <!-- Choices CSS-->
     <link rel="stylesheet" href="vendor/choices.js/public/assets/styles/choices.min.css">
     <!-- theme stylesheet-->
     <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
     <!-- Custom stylesheet - for your changes-->
     <link rel="stylesheet" href="css/custom.css">
     <!-- Favicon-->
     <link rel="shortcut icon" href="img/favicon.ico">
     <script src="../../../wp-content/process/jquery.min.js"></script>
     <link rel="stylesheet" href="../../../wp-content/process/toastr-master/build/toastr.min.css">
     <!-- Place this script before the </head> tag -->
     <script src="https://unpkg.com/octavalidate@1.2.5/native/validate.js"></script>
     <!-- Tweaks for older IEs-->
     <!--[if lt IE 9]>
     <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
     <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>

<body>
     <div class="page">
          <!-- Main Navbar-->
          <header class="header z-index-50">
               <nav class="nav navbar py-3 px-0 shadow-sm text-white position-relative">
                    <!-- Search Box-->
                    <div class="search-box shadow-sm">
                         <button class="dismiss d-flex align-items-center">
                              <svg class="svg-icon svg-icon-heavy">
                                   <use xlink:href="#close-1"> </use>
                              </svg>
                         </button>
                         <form id="searchForm" action="#" role="search">
                              <input class="form-control shadow-0" type="text" placeholder="What are you looking for...">
                         </form>
                    </div>
                    <div class="container-fluid w-100">
                         <div class="navbar-holder d-flex align-items-center justify-content-between w-100">
                              <!-- Navbar Header-->
                              <div class="navbar-header">
                                   <!-- Navbar Brand --><a class="navbar-brand d-none d-sm-inline-block" href="index.php">
                                        <div class="brand-text d-none d-lg-inline-block"><span>APA </span><strong> Financial</strong></div>
                                        <div class="brand-text d-none d-sm-inline-block d-lg-none"><strong>APA</strong></div>
                                   </a>
                                   <!-- Toggle Button--><a class="menu-btn active" id="toggle-btn" href="#"><span></span><span></span><span></span></a>
                              </div>
                              <!-- Navbar Menu -->
                              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                                   <!-- Search-->
                                   <li class="nav-item d-flex align-items-center"><a id="search" href="#">
                                             <svg class="svg-icon svg-icon-xs svg-icon-heavy">
                                                  <use xlink:href="#find-1"> </use>
                                             </svg></a></li>
                                   <!-- Notifications-->
                                   <li class="nav-item dropdown"> <a class="nav-link text-white" id="notifications" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                             <svg class="svg-icon svg-icon-xs svg-icon-heavy">
                                                  <use xlink:href="#chart-1"> </use>
                                             </svg><span class="badge bg-red badge-corner fw-normal">1</span></a>
                                        <ul class="dropdown-menu dropdown-menu-end mt-3 shadow-sm" aria-labelledby="notifications">
                                             <li><a class="dropdown-item py-3" href="#">
                                                       <div class="d-flex">
                                                            <div class="icon icon-sm bg-blue">
                                                                 <svg class="svg-icon svg-icon-xs svg-icon-heavy">
                                                                      <use xlink:href="#envelope-1"> </use>
                                                                 </svg>
                                                            </div>
                                                            <div class="ms-3"><span class="h6 d-block fw-normal mb-1 text-xs text-gray-600">You have 6 new messages </span><small class="small text-gray-600">4 minutes ago</small></div>
                                                       </div>
                                                  </a></li>
                                        </ul>
                                   </li>
                                   <!-- Languages dropdown    -->
                                   <li class="nav-item dropdown"><a class="nav-link text-white dropdown-toggle d-flex align-items-center" id="languages" href="#" data-bs-toggle="dropdown" aria-expanded="false"><img class="me-2" src="img/flags/16/GB.png" alt="English"><span class="d-none d-sm-inline-block">English</span></a>
                                        <ul class="dropdown-menu dropdown-menu-end mt-3 shadow-sm" aria-labelledby="languages">
                                             <li><a class="dropdown-item" rel="nofollow" href="#"> <img class="me-2" src="img/flags/16/DE.png" alt="English"><span class="text-xs text-gray-700">German</span></a></li>
                                             <li><a class="dropdown-item" rel="nofollow" href="#"> <img class="me-2" src="img/flags/16/FR.png" alt="English"><span class="text-xs text-gray-700">French </span></a></li>
                                        </ul>
                                   </li>
                                   <!-- Logout    -->
                                   <li class="nav-item"><a class="nav-link text-white" href="logout.php"> <span class="d-none d-sm-inline">Logout</span>
                                             <svg class="svg-icon svg-icon-xs svg-icon-heavy">
                                                  <use xlink:href="#security-1"> </use>
                                             </svg></a></li>
                              </ul>
                         </div>
                    </div>
               </nav>
          </header>
          <div class="page-content d-flex align-items-stretch">
               <!-- Side Navbar -->
               <nav class="side-navbar z-index-40">
                    <!-- Sidebar Header-->
                    <div class="sidebar-header d-flex align-items-center py-4 px-3">
                         <div class="ms-3 title">
                              <h1 class="h4 mb-2">Admin</h1>
                         </div>
                    </div>
                    <!-- Sidebar Navidation Menus--><span class="text-uppercase text-gray-400 text-xs letter-spacing-0 mx-3 px-2 heading">Main</span>
                    <ul class="list-unstyled py-4" id="navbarA">
                         <li class="sidebar-item"><a class="sidebar-link" href="index.php">
                                   <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
                                        <use xlink:href="#real-estate-1"> </use>
                                   </svg>Home </a></li>
                         <li class="sidebar-item btna"><a class="sidebar-link" href="users.php">
                                   <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
                                        <use xlink:href="#portfolio-grid-1"> </use>
                                   </svg>All Users</a></li>
                         <li class="sidebar-item btna"><a class="sidebar-link" href="payment-methods.php">
                                   <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
                                        <use xlink:href="#sales-up-1"> </use>
                                   </svg>Set Payment Method </a></li>
                         <li class="sidebar-item btna"><a class="sidebar-link" href="crypto.php">
                                   <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
                                        <use xlink:href="#survey-1"> </use>
                                   </svg>Crypto Exchange</a></li>
                         <li class="sidebar-item btna"><a class="sidebar-link" href="newsletter.php">
                                   <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
                                        <use xlink:href="#survey-1"> </use>
                                   </svg>Newsletter</a></li>
                         <li class="sidebar-item btna"><a class="sidebar-link" href="new-notice.php">
                                   <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
                                        <use xlink:href="#survey-1"> </use>
                                   </svg>Create Notice</a></li>
                         <li class="sidebar-item btna"><a class="sidebar-link" href="packages.php">
                                   <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
                                        <use xlink:href="#survey-1"> </use>
                                   </svg>Manage Packages</a></li>
                         <!-- <li class="sidebar-item btna"><a class="sidebar-link" href="#exampledropdownDropdown" data-bs-toggle="collapse">
                                   <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
                                        <use xlink:href="#browser-window-1"> </use>
                                   </svg>Invest</a>
                              <ul class="collapse list-unstyled " id="exampledropdownDropdown">
                                   <li><a class="sidebar-link" href="plans.php">Suscribe to a Plan</a></li>
                                   <li><a class="sidebar-link" href="index.php">My Investment</a></li>
                              </ul>
                         </li> -->
                         <li class="sidebar-item"><a class="sidebar-link" href="referels.php">
                                   <i class="fa-solid fa-arrows-rotate me-xl-2 fa-1x"></i>
                                   </svg>Referels</a>
                         </li>
                         <li class="sidebar-item"><a class="sidebar-link" href="add-bonus.php">
                                   <i class="fa-solid fa-arrows-rotate me-xl-2 fa-1x"></i>
                                   </svg>bonus</a>
                         </li>
                         <li class="sidebar-item"><a class="sidebar-link" href="add-profit.php">
                                   <i class="fa-solid fa-arrows-rotate me-xl-2 fa-1x"></i>
                                   </svg>Profit</a>
                         </li>
                         <li class="sidebar-item"><a class="sidebar-link" href="all-transactions.php">
                                   <i class="fa-solid fa-arrows-rotate me-xl-2 fa-1x"></i>
                                   </svg>All Transactions</a>
                         </li>
                    </ul>
                    <!-- <span class="text-uppercase text-gray-400 text-xs letter-spacing-0 mx-3 px-2 heading">Extras</span>
                    <ul class="list-unstyled py-4">
                         <li class="sidebar-item"> <a class="sidebar-link" href="deposit.php">
                                   <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
                                        <use xlink:href="#imac-screen-1"> </use>
                                   </svg>Fund your Account</a></li>
                         <li class="sidebar-item"> <a class="sidebar-link" href="withdrawals.php">
                                   <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
                                        <use xlink:href="#chart-1"> </use>
                                   </svg>Withdraw Funds</a></li>
                         <li class="sidebar-item"> <a class="sidebar-link" href="">
                                   <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
                                        <use xlink:href="#quality-1"> </use>
                                   </svg>Account Settings</a></li> -->
                    <!-- <li class="sidebar-item"> <a class="sidebar-link" href="#">
                                   <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
                                        <use xlink:href="#security-shield-1"> </use>
                                   </svg>Demo </a></li>
                    </ul> -->
               </nav>