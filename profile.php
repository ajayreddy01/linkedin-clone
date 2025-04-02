<!doctype html>

<?php
require 'core/init.php';
if ($user->isloggedin() === false) {
  header('Location: ../login.php');
}
$user_data = $user->getuserdata($_SESSION['user_id']);
?>
<html
  lang="en"
  class="light-style layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../../assets/"
  data-template="horizontal-menu-template"
  data-style="light">

<head>
  <meta charset="utf-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>User Profile - Profile | Linkedin Clone</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="../../assets/img/favicon/favicon.ico" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet" />

  <!-- Icons -->
  <link rel="stylesheet" href="../../assets/vendor/fonts/boxicons.css" />
  <link rel="stylesheet" href="../../assets/vendor/fonts/fontawesome.css" />
  <link rel="stylesheet" href="../../assets/vendor/fonts/flag-icons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="../../assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="../../assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="../../assets/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
  <link rel="stylesheet" href="../../assets/vendor/libs/typeahead-js/typeahead.css" />
  <link rel="stylesheet" href="../../assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
  <link rel="stylesheet" href="../../assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
  <link rel="stylesheet" href="../../assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css" />

  <!-- Page CSS -->
  <link rel="stylesheet" href="../../assets/vendor/css/pages/page-profile.css" />

  <!-- Helpers -->
  <script src="../../assets/vendor/js/helpers.js"></script>
  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
  <script src="../../assets/vendor/js/template-customizer.js"></script>
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="../../assets/js/config.js"></script>
</head>

<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
    <div class="layout-container">
      <!-- Navbar -->

      <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
        <div class="container-xxl">
          <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
            <a href="index.html" class="app-brand-link gap-2">
              <span class="app-brand-logo demo">
                <svg
                  width="25"
                  viewBox="0 0 25 42"
                  version="1.1"
                  xmlns="http://www.w3.org/2000/svg"
                  xmlns:xlink="http://www.w3.org/1999/xlink">
                  <defs>
                    <path
                      d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z"
                      id="path-1"></path>
                    <path
                      d="M5.47320593,6.00457225 C4.05321814,8.216144 4.36334763,10.0722806 6.40359441,11.5729822 C8.61520715,12.571656 10.0999176,13.2171421 10.8577257,13.5094407 L15.5088241,14.433041 L18.6192054,7.984237 C15.5364148,3.11535317 13.9273018,0.573395879 13.7918663,0.358365126 C13.5790555,0.511491653 10.8061687,2.3935607 5.47320593,6.00457225 Z"
                      id="path-3"></path>
                    <path
                      d="M7.50063644,21.2294429 L12.3234468,23.3159332 C14.1688022,24.7579751 14.397098,26.4880487 13.008334,28.506154 C11.6195701,30.5242593 10.3099883,31.790241 9.07958868,32.3040991 C5.78142938,33.4346997 4.13234973,34 4.13234973,34 C4.13234973,34 2.75489982,33.0538207 2.37032616e-14,31.1614621 C-0.55822714,27.8186216 -0.55822714,26.0572515 -4.05231404e-15,25.8773518 C0.83734071,25.6075023 2.77988457,22.8248993 3.3049379,22.52991 C3.65497346,22.3332504 5.05353963,21.8997614 7.50063644,21.2294429 Z"
                      id="path-4"></path>
                    <path
                      d="M20.6,7.13333333 L25.6,13.8 C26.2627417,14.6836556 26.0836556,15.9372583 25.2,16.6 C24.8538077,16.8596443 24.4327404,17 24,17 L14,17 C12.8954305,17 12,16.1045695 12,15 C12,14.5672596 12.1403557,14.1461923 12.4,13.8 L17.4,7.13333333 C18.0627417,6.24967773 19.3163444,6.07059163 20.2,6.73333333 C20.3516113,6.84704183 20.4862915,6.981722 20.6,7.13333333 Z"
                      id="path-5"></path>
                  </defs>
                  <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
                      <g id="Icon" transform="translate(27.000000, 15.000000)">
                        <g id="Mask" transform="translate(0.000000, 8.000000)">
                          <mask id="mask-2" fill="white">
                            <use xlink:href="#path-1"></use>
                          </mask>
                          <use fill="#696cff" xlink:href="#path-1"></use>
                          <g id="Path-3" mask="url(#mask-2)">
                            <use fill="#696cff" xlink:href="#path-3"></use>
                            <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3"></use>
                          </g>
                          <g id="Path-4" mask="url(#mask-2)">
                            <use fill="#696cff" xlink:href="#path-4"></use>
                            <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4"></use>
                          </g>
                        </g>
                        <g
                          id="Triangle"
                          transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) ">
                          <use fill="#696cff" xlink:href="#path-5"></use>
                          <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5"></use>
                        </g>
                      </g>
                    </g>
                  </g>
                </svg>
              </span>
              <span class="app-brand-text demo menu-text fw-bold text-heading">Linkedin Clone</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-xl-none">
              <i class="d-flex align-items-center justify-content-center"></i>
            </a>
          </div>

          <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
              <i class="bx bx-menu bx-md"></i>
            </a>
          </div>

          <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <ul class="navbar-nav flex-row align-items-center ms-auto">


              <li class="nav-item me-2 me-xl-0">
                <a class="nav-link search-toggler" href="chat.php">
                  <i class='bx bx-message-rounded-dots'></i>
                </a>
              </li>

              <li class="nav-item me-2 me-xl-0">
                <a class="nav-link search-toggler" href="post.php">
                  <i class='bx bx-add-to-queue'></i>
                </a>
              </li>

              <!-- Notification -->
              <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-2">
                <a
                  class="nav-link dropdown-toggle hide-arrow"
                  href="javascript:void(0);"
                  data-bs-toggle="dropdown"
                  data-bs-auto-close="outside"
                  aria-expanded="false">
                  <span class="position-relative">
                    <i class="bx bx-bell bx-md"></i>
                    <span class="badge rounded-pill bg-danger badge-dot badge-notifications border"></span>
                  </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end p-0">
                  <li class="dropdown-menu-header border-bottom">
                    <div class="dropdown-header d-flex align-items-center py-3">
                      <h6 class="mb-0 me-auto">Notification</h6>
                      <div class="d-flex align-items-center h6 mb-0">
                        <span class="badge bg-label-primary me-2">8 New</span>
                        <a
                          href="javascript:void(0)"
                          class="dropdown-notifications-all p-2"
                          data-bs-toggle="tooltip"
                          data-bs-placement="top"
                          title="Mark all as read"><i class="bx bx-envelope-open text-heading"></i></a>
                      </div>
                    </div>
                  </li>
                  <li class="dropdown-notifications-list scrollable-container">
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item list-group-item-action dropdown-notifications-item">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar">
                              <img src="../../assets/img/avatars/1.png" alt class="rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <h6 class="small mb-0">Congratulation Lettie 🎉</h6>
                            <small class="mb-1 d-block text-body">Won the monthly best seller gold badge</small>
                            <small class="text-muted">1h ago</small>
                          </div>
                          <div class="flex-shrink-0 dropdown-notifications-actions">
                            <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                            <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="bx bx-x"></span></a>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item list-group-item-action dropdown-notifications-item">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar">
                              <span class="avatar-initial rounded-circle bg-label-danger">CF</span>
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <h6 class="small mb-0">Charles Franklin</h6>
                            <small class="mb-1 d-block text-body">Accepted your connection</small>
                            <small class="text-muted">12hr ago</small>
                          </div>
                          <div class="flex-shrink-0 dropdown-notifications-actions">
                            <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                            <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="bx bx-x"></span></a>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar">
                              <img src="../../assets/img/avatars/2.png" alt class="rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <h6 class="small mb-0">New Message ✉️</h6>
                            <small class="mb-1 d-block text-body">You have new message from Natalie</small>
                            <small class="text-muted">1h ago</small>
                          </div>
                          <div class="flex-shrink-0 dropdown-notifications-actions">
                            <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                            <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="bx bx-x"></span></a>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item list-group-item-action dropdown-notifications-item">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar">
                              <span class="avatar-initial rounded-circle bg-label-success"><i class="bx bx-cart"></i></span>
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <h6 class="small mb-0">Whoo! You have new order 🛒</h6>
                            <small class="mb-1 d-block text-body">ACME Inc. made new order $1,154</small>
                            <small class="text-muted">1 day ago</small>
                          </div>
                          <div class="flex-shrink-0 dropdown-notifications-actions">
                            <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                            <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="bx bx-x"></span></a>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar">
                              <img src="../../assets/img/avatars/9.png" alt class="rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <h6 class="small mb-0">Application has been approved 🚀</h6>
                            <small class="mb-1 d-block text-body">Your ABC project application has been approved.</small>
                            <small class="text-muted">2 days ago</small>
                          </div>
                          <div class="flex-shrink-0 dropdown-notifications-actions">
                            <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                            <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="bx bx-x"></span></a>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar">
                              <span class="avatar-initial rounded-circle bg-label-success"><i class="bx bx-pie-chart-alt"></i></span>
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <h6 class="small mb-0">Monthly report is generated</h6>
                            <small class="mb-1 d-block text-body">July monthly financial report is generated </small>
                            <small class="text-muted">3 days ago</small>
                          </div>
                          <div class="flex-shrink-0 dropdown-notifications-actions">
                            <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                            <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="bx bx-x"></span></a>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar">
                              <img src="../../assets/img/avatars/5.png" alt class="rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <h6 class="small mb-0">Send connection request</h6>
                            <small class="mb-1 d-block text-body">Peter sent you connection request</small>
                            <small class="text-muted">4 days ago</small>
                          </div>
                          <div class="flex-shrink-0 dropdown-notifications-actions">
                            <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                            <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="bx bx-x"></span></a>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item list-group-item-action dropdown-notifications-item">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar">
                              <img src="../../assets/img/avatars/6.png" alt class="rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <h6 class="small mb-0">New message from Jane</h6>
                            <small class="mb-1 d-block text-body">Your have new message from Jane</small>
                            <small class="text-muted">5 days ago</small>
                          </div>
                          <div class="flex-shrink-0 dropdown-notifications-actions">
                            <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                            <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="bx bx-x"></span></a>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar">
                              <span class="avatar-initial rounded-circle bg-label-warning"><i class="bx bx-error"></i></span>
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <h6 class="small mb-0">CPU is running high</h6>
                            <small class="mb-1 d-block text-body">CPU Utilization Percent is currently at 88.63%,</small>
                            <small class="text-muted">5 days ago</small>
                          </div>
                          <div class="flex-shrink-0 dropdown-notifications-actions">
                            <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                            <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="bx bx-x"></span></a>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </li>
                  <li class="border-top">
                    <div class="d-grid p-4">
                      <a class="btn btn-primary btn-sm d-flex" href="javascript:void(0);">
                        <small class="align-middle">View all notifications</small>
                      </a>
                    </div>
                  </li>
                </ul>
              </li>
              <!--/ Notification -->
              <!-- User -->
              <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a
                  class="nav-link dropdown-toggle hide-arrow p-0"
                  href="javascript:void(0);"
                  data-bs-toggle="dropdown">
                  <div class="avatar avatar-online">
                    <img src="<?php if (!empty($user_data->profile_picture_url)) {
                                echo $user_data->profile_picture_url;
                              } else {
                                echo '../../assets/img/avatars/1.png';
                              } ?>" alt class="w-px-40 h-auto rounded-circle" />
                  </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                    <a class="dropdown-item" href="pages-account-settings-account.html">
                      <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                          <div class="avatar avatar-online">
                            <img src="<?php if (!empty($user_data->profile_picture_url)) {
                                        echo $user_data->profile_picture_url;
                                      } else {
                                        echo '../../assets/img/avatars/1.png';
                                      } ?>" alt class="w-px-40 h-auto rounded-circle" />
                          </div>
                        </div>
                        <div class="flex-grow-1">
                          <h6 class="mb-0"><?php echo $user_data->first_name . ' ' . $user_data->last_name; ?></h6>

                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider my-1"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" href="profile.php">
                      <i class="bx bx-user bx-md me-3"></i><span>My Profile</span>
                    </a>
                  </li>

                  <li>
                    <div class="dropdown-divider my-1"></div>
                  </li>

                  <li>
                    <a class="dropdown-item" href="logout.php">
                      <i class="bx bx-power-off bx-md me-3"></i><span>Log Out</span>
                    </a>
                  </li>
                </ul>
              </li>
              <!--/ User -->
            </ul>
          </div>

          <!-- Search Small Screens -->
          
        </div>
      </nav>

      <!-- / Navbar -->

      <!-- Layout container -->
      <div class="layout-page">
        <!-- Content wrapper -->
        <div class="content-wrapper">


          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Header -->
            <div class="row">
              <div class="col-12">
                <div class="card mb-6">
                  <div class="user-profile-header-banner">
                    <img src="../../assets/img/pages/profile-banner.png" alt="Banner image" class="rounded-top" />
                  </div>
                  <div class="user-profile-header d-flex flex-column flex-lg-row text-sm-start text-center mb-8">
                    <div class="flex-shrink-0 mt-1 mx-sm-0 mx-auto">
                      <img
                        src="<?php if (!empty($user_data->profile_picture_url)) {
                                echo $user_data->profile_picture_url;
                              } else {
                                echo '../../assets/img/avatars/1.png';
                              } ?>"
                        alt="user image"
                        class="d-block h-auto ms-0 ms-sm-6 rounded-3 user-profile-img" />
                    </div>
                    <div class="flex-grow-1 mt-3 mt-lg-5">
                      <div
                        class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-5 flex-md-row flex-column gap-4">
                        <div class="user-profile-info">
                          <h4 class="mb-2 mt-lg-7"><?php echo $user_data->first_name . ' ' . $user_data->last_name; ?></h4>
                          <ul
                            class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-4 mt-4">
                            <li class="list-inline-item">
                              <i class="bx bx-palette me-2 align-top"></i><span class="fw-medium"><?php echo $user_data->headline; ?></span>
                            </li>
                            <li class="list-inline-item">
                              <i class="bx bx-map me-2 align-top"></i><span class="fw-medium"><?php echo $user_data->industry; ?></span>
                            </li>
                            <li class="list-inline-item">
                              <i class="bx bx-calendar me-2 align-top"></i><span class="fw-medium"> <?php echo $user_data->contact_info; ?></span>
                            </li>
                          </ul>
                        </div>
                        <a href="javascript:void(0)" class="btn btn-primary mb-1">
                          <i class="bx bx-user-check bx-sm me-2"></i>Connected
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--/ Header -->

            <!-- Navbar pills -->
            <div class="row">
              <div class="col-md-12">
                <div class="nav-align-top">
                  <ul class="nav nav-pills flex-column flex-sm-row mb-6">
                    <li class="nav-item">
                      <a class="nav-link active" href="profile.php"><i class="bx bx-user bx-sm me-1_5"></i> Profile</a>
                    </li>

                    <li class="nav-item">
                      <a class="nav-link" href="post.php"><i class="bx bx-grid-alt bx-sm me-1_5"></i> Posts</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="connections.php"><i class="bx bx-link bx-sm me-1_5"></i> Connections</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <!--/ Navbar pills -->

            <!-- User Profile Content -->
            <div class="row">
              <div class="col-xl-4 col-lg-5 col-md-5">
                
              </div>
              <div class="col-xl-8 col-lg-7 col-md-7">
                <!-- Profile Edit Form -->
                <form id="editProfileForm" class="mb-5">
                  <div class="card">
                    <div class="card-header">Edit Profile</div>
                    <div class="card-body row g-3">
                      <div class="col-md-6">
                        <label class="form-label">First Name</label>
                        <input type="text" name="first_name" value="<?php if(isset($user_data->first_name)){echo $user_data->first_name;}?>" class="form-control" required>
                      </div>
                      <div class="col-md-6">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="last_name" value="<?php if(isset($user_data->last_name)){echo $user_data->last_name;}?>" class="form-control" required>
                      </div>
                      <div class="col-md-6">
                        <label class="form-label">Headline</label>
                        <input type="text" name="headline" value="<?php if(isset($user_data->headline)){echo $user_data->headline;}?>" class="form-control">
                      </div>
                      <div class="col-md-6">
                        <label class="form-label">Location</label>
                        <input type="text" name="location" value="<?php if(isset($user_data->location)){echo $user_data->location;}?>" class="form-control">
                      </div>
                     
                      <div class="col-12">
                        <label class="form-label">Bio</label>
                        <textarea name="bio" class="form-control"><?php if(isset($user_data->bio)){echo $user_data->bio;}?></textarea>
                      </div>
                      
                      <div class="col-12">
                        <button class="btn btn-primary mt-3" type="submit">Update Profile</button>
                      </div>
                    </div>
                  </div>
                </form>

                <!-- Education Section -->
                <div class="mb-5">
                  <h4>Education <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#educationModal">+ Add</button></h4>
                  <ul id="educationList" class="list-group"></ul>
                </div>

                <!-- Skills Section -->
                <div class="mb-5">
                  <h4>Skills <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#skillModal">+ Add</button></h4>
                  <ul id="skillsList" class="list-group"></ul>
                </div>

                <!-- Experience Section -->
                <div>
                  <h4>Experience <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#experienceModal">+ Add</button></h4>
                  <ul id="experienceList" class="list-group"></ul>
                </div>
              </div>

              <!-- Education Modal -->
              <div class="modal fade" id="educationModal" tabindex="-1">
                <div class="modal-dialog">
                  <form class="modal-content" id="educationForm">
                    <div class="modal-header">
                      <h5 class="modal-title">Add / Edit Education</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                      <input type="hidden" name="education_id" id="education_id">
                      <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                      <div class="mb-3">
                        <label>Institution Name</label>
                        <input type="text" name="institution_name" class="form-control" required>
                      </div>
                      <div class="mb-3">
                        <label>Degree</label>
                        <input type="text" name="degree" class="form-control">
                      </div>
                      <div class="mb-3">
                        <label>Field of Study</label>
                        <input type="text" name="field_of_study" class="form-control">
                      </div>
                      <div class="mb-3">
                        <label>Start Date</label>
                        <input type="date" name="start_date" class="form-control">
                      </div>
                      <div class="mb-3">
                        <label>End Date</label>
                        <input type="date" name="end_date" class="form-control">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                  </form>
                </div>
              </div>

              <!-- Skill Modal -->
              <div class="modal fade" id="skillModal" tabindex="-1">
                <div class="modal-dialog">
                  <form class="modal-content" id="skillForm">
                    <div class="modal-header">
                      <h5 class="modal-title">Add / Edit Skill</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                      <input type="hidden" name="skill_id" id="skill_id">
                      <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                      <div class="mb-3">
                        <label>Skill Name</label>
                        <input type="text" name="skill_name" class="form-control" required>
                      </div>
                      <div class="mb-3">
                        <label>Proficiency Level</label>
                        <input type="text" name="proficiency_level" class="form-control">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                  </form>
                </div>
              </div>

              <!-- Experience Modal -->
              <div class="modal fade" id="experienceModal" tabindex="-1">
                <div class="modal-dialog">
                  <form class="modal-content" id="experienceForm">
                    <div class="modal-header">
                      <h5 class="modal-title">Add / Edit Experience</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                      <input type="hidden" name="experience_id" id="experience_id">
                      <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                      <div class="mb-3">
                        <label>Company Name</label>
                        <input type="text" name="company_name" class="form-control" required>
                      </div>
                      <div class="mb-3">
                        <label>Job Title</label>
                        <input type="text" name="job_title" class="form-control">
                      </div>
                      <div class="mb-3">
                        <label>Location</label>
                        <input type="text" name="location" class="form-control">
                      </div>
                      <div class="mb-3">
                        <label>Start Date</label>
                        <input type="date" name="start_date" class="form-control">
                      </div>
                      <div class="mb-3">
                        <label>End Date</label>
                        <input type="date" name="end_date" class="form-control">
                      </div>
                      <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control"></textarea>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!--/ User Profile Content -->
        </div>
        <!--/ Content -->


        <div class="content-backdrop fade"></div>
      </div>
      <!--/ Content wrapper -->
    </div>

    <!--/ Layout container -->
  </div>
  </div>

  <!-- Overlay -->
  <div class="layout-overlay layout-menu-toggle"></div>

  <!-- Drag Target Area To SlideIn Menu On Small Screens -->
  <div class="drag-target"></div>

  <!--/ Layout wrapper -->

  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->

  <script src="../../assets/vendor/libs/jquery/jquery.js"></script>
  <script src="../../assets/vendor/libs/popper/popper.js"></script>
  <script src="../../assets/vendor/js/bootstrap.js"></script>
  <script src="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="../../assets/vendor/libs/hammer/hammer.js"></script>
  <script src="../../assets/vendor/libs/i18n/i18n.js"></script>
  <script src="../../assets/vendor/libs/typeahead-js/typeahead.js"></script>
  <script src="../../assets/vendor/js/menu.js"></script>

  <!-- endbuild -->

  <!-- Vendors JS -->
  <script src="../../assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>

  <!-- Main JS -->
  <script src="../../assets/js/main.js"></script>

  <!-- Page JS -->
  <script src="../../assets/js/app-user-view-account.js"></script>
  <script>
  const apiUrl = '/api/index.php';
  const userId = <?php echo json_encode($_SESSION['user_id']); ?>;

  // Profile Update
  $('#editProfileForm').submit(function(e) {
    e.preventDefault();
    const formData = $(this).serialize() + '&user_id=' + userId;
    $.post(apiUrl + '?action=updateProfile', formData, res => alert(res.message));
  });

  // Load Education
  function loadEducation() {
    $.post(apiUrl + '?action=getEducation', { user_id: userId }, function(res) {
      const list = $('#educationList').empty();
      res.education.forEach(item => {
        list.append(`<li class="list-group-item d-flex justify-content-between align-items-center">
          <span>${item.institution_name} - ${item.degree}</span>
          <button class="btn btn-sm btn-primary" onclick='editEducation(${JSON.stringify(item)})'>Edit</button>
        </li>`);
      });
    });
  }

  $('#educationForm').submit(function(e) {
    e.preventDefault();
    const action = $('#education_id').val() ? 'editEducation' : 'addEducation';
    $.post(apiUrl + '?action=' + action, $(this).serialize(), res => {
      alert(res.message);
      $('#educationModal').modal('hide');
      loadEducation();
    });
  });

  function editEducation(data) {
    for (let key in data) $('#educationForm [name=' + key + ']').val(data[key]);
    $('#educationModal').modal('show');
  }

  // Load Skills
  function loadSkills() {
    $.post(apiUrl + '?action=getSkills', { user_id: userId }, function(res) {
      const list = $('#skillsList').empty();
      res.skills.forEach(item => {
        list.append(`<li class="list-group-item d-flex justify-content-between align-items-center">
          <span>${item.skill_name} (${item.proficiency_level})</span>
          <button class="btn btn-sm btn-primary" onclick='editSkill(${JSON.stringify(item)})'>Edit</button>
        </li>`);
      });
    });
  }

  $('#skillForm').submit(function(e) {
    e.preventDefault();
    const action = $('#skill_id').val() ? 'editSkill' : 'addSkill';
    $.post(apiUrl + '?action=' + action, $(this).serialize(), res => {
      alert(res.message);
      $('#skillModal').modal('hide');
      loadSkills();
    });
  });

  function editSkill(data) {
    for (let key in data) $('#skillForm [name=' + key + ']').val(data[key]);
    $('#skillModal').modal('show');
  }

  // Load Experience
  function loadExperience() {
    $.post(apiUrl + '?action=getExperience', { user_id: userId }, function(res) {
      const list = $('#experienceList').empty();
      res.experience.forEach(item => {
        list.append(`<li class="list-group-item d-flex justify-content-between align-items-center">
          <span>${item.company_name} - ${item.job_title}</span>
          <button class="btn btn-sm btn-primary" onclick='editExperience(${JSON.stringify(item)})'>Edit</button>
        </li>`);
      });
    });
  }

  $('#experienceForm').submit(function(e) {
    e.preventDefault();
    const action = $('#experience_id').val() ? 'editExperience' : 'addExperience';
    $.post(apiUrl + '?action=' + action, $(this).serialize(), res => {
      alert(res.message);
      $('#experienceModal').modal('hide');
      loadExperience();
    });
  });

  function editExperience(data) {
    for (let key in data) $('#experienceForm [name=' + key + ']').val(data[key]);
    $('#experienceModal').modal('show');
  }

  // Load all data on page load
  $(document).ready(function() {
    loadEducation();
    loadSkills();
    loadExperience();
  });
</script>
</body>

</html>