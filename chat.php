<!doctype html>
<?php
require 'core/init.php';
if ($user->isloggedin() === false) {
  header('Location: ../login.php');
}
$currentUserId = $_SESSION['user_id'];
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

  <title>Chat | Linkedin Clone</title>

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
  <link rel="stylesheet" href="../../assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css" />

  <!-- Page CSS -->

  <link rel="stylesheet" href="../../assets/vendor/css/pages/app-chat.css" />

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


            <div class="app-chat card overflow-hidden">
              <div class="row g-0">
                <!-- Sidebar Left -->
                <div class="col app-chat-sidebar-left app-sidebar overflow-hidden" id="app-chat-sidebar-left">
                  <div
                    class="chat-sidebar-left-user sidebar-header d-flex flex-column justify-content-center align-items-center flex-wrap px-6 pt-12">
                    <div class="avatar avatar-xl avatar-online chat-sidebar-avatar">
                      <img src="../../assets/img/avatars/1.png" alt="Avatar" class="rounded-circle" />
                    </div>
                    <h5 class="mt-4 mb-0">John Doe</h5>
                    <span>Admin</span>
                    <i
                      class="bx bx-x bx-lg cursor-pointer close-sidebar"
                      data-bs-toggle="sidebar"
                      data-overlay
                      data-target="#app-chat-sidebar-left"></i>
                  </div>
                  <div class="sidebar-body px-6 pb-6">
                    <div class="my-6">
                      <label for="chat-sidebar-left-user-about" class="text-uppercase text-muted mb-1">About</label>
                      <textarea
                        id="chat-sidebar-left-user-about"
                        class="form-control chat-sidebar-left-user-about"
                        rows="3"
                        maxlength="120">
Hey there, we’re just writing to let you know that you’ve been subscribed to a repository on GitHub.</textarea>
                    </div>
                    <div class="my-6">
                      <p class="text-uppercase text-muted mb-1">Status</p>
                      <div class="d-grid gap-2 pt-2 text-heading ms-2">
                        <div class="form-check form-check-success">
                          <input
                            name="chat-user-status"
                            class="form-check-input"
                            type="radio"
                            value="active"
                            id="user-active"
                            checked />
                          <label class="form-check-label" for="user-active">Online</label>
                        </div>
                        <div class="form-check form-check-warning">
                          <input
                            name="chat-user-status"
                            class="form-check-input"
                            type="radio"
                            value="away"
                            id="user-away" />
                          <label class="form-check-label" for="user-away">Away</label>
                        </div>
                        <div class="form-check form-check-danger">
                          <input
                            name="chat-user-status"
                            class="form-check-input"
                            type="radio"
                            value="busy"
                            id="user-busy" />
                          <label class="form-check-label" for="user-busy">Do not Disturb</label>
                        </div>
                        <div class="form-check form-check-secondary">
                          <input
                            name="chat-user-status"
                            class="form-check-input"
                            type="radio"
                            value="offline"
                            id="user-offline" />
                          <label class="form-check-label" for="user-offline">Offline</label>
                        </div>
                      </div>
                    </div>
                    <div class="my-6">
                      <p class="text-uppercase text-muted mb-1">Settings</p>
                      <ul class="list-unstyled d-grid gap-4 ms-2 pt-2 text-heading">
                        <li class="d-flex justify-content-between align-items-center">
                          <div>
                            <i class="bx bx-lock-alt me-1"></i>
                            <span class="align-middle">Two-step Verification</span>
                          </div>
                          <div class="form-check form-switch mb-0 me-1">
                            <input type="checkbox" class="form-check-input" checked />
                          </div>
                        </li>
                        <li class="d-flex justify-content-between align-items-center">
                          <div>
                            <i class="bx bx-bell me-1"></i>
                            <span class="align-middle">Notification</span>
                          </div>
                          <div class="form-check form-switch mb-0 me-1">
                            <input type="checkbox" class="form-check-input" />
                          </div>
                        </li>
                        <li>
                          <i class="bx bx-user me-1"></i>
                          <span class="align-middle">Invite Friends</span>
                        </li>
                        <li>
                          <i class="bx bx-trash me-1"></i>
                          <span class="align-middle">Delete Account</span>
                        </li>
                      </ul>
                    </div>
                    <div class="d-flex mt-6">
                      <button
                        class="btn btn-primary w-100"
                        data-bs-toggle="sidebar"
                        data-overlay
                        data-target="#app-chat-sidebar-left">
                        <i class="bx bx-log-out bx-sm me-2"></i>Logout
                      </button>
                    </div>
                  </div>
                </div>
                <!-- /Sidebar Left-->

                <!-- Chat & Contacts -->
                <div
                  class="col app-chat-contacts app-sidebar flex-grow-0 overflow-hidden border-end"
                  id="app-chat-contacts">
                  <div class="sidebar-header px-6 border-bottom d-flex align-items-center">
                    <div class="d-flex align-items-center me-6 me-lg-0">
                      <div
                        class="flex-shrink-0 avatar avatar-online me-4"
                        data-bs-toggle="sidebar"
                        data-overlay="app-overlay-ex"
                        data-target="#app-chat-sidebar-left">
                        <img
                          class="user-avatar rounded-circle cursor-pointer"
                          src="../../assets/img/avatars/1.png"
                          alt="Avatar" />
                      </div>
                      <div class="flex-grow-1 input-group input-group-merge rounded-pill">
                        <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search bx-sm"></i></span>
                        <input
                          type="text"
                          class="form-control chat-search-input"
                          placeholder="Search..."
                          aria-label="Search..."
                          aria-describedby="basic-addon-search31" />
                      </div>
                    </div>
                    <i
                      class="bx bx-x bx-lg cursor-pointer position-absolute top-50 end-0 translate-middle d-lg-none d-block"
                      data-overlay
                      data-bs-toggle="sidebar"
                      data-target="#app-chat-contacts"></i>
                  </div>
                  <div class="sidebar-body">
                    <!-- Chats -->
                    <ul class="list-unstyled chat-contact-list py-2 mb-0" id="chat-list">
                      <li class="chat-contact-list-item chat-contact-list-item-title mt-0">
                        <h5 class="text-primary mb-0">Chats</h5>
                      </li>
                      <li class="chat-contact-list-item chat-list-item-0 d-none">
                        <h6 class="text-muted mb-0">No Chats Found</h6>
                      </li>
                      <!-- Chats will be populated dynamically -->
                    </ul>
                    <!-- Contacts -->
                    <ul class="list-unstyled chat-contact-list mb-0 py-2" id="contact-list">
                      <li class="chat-contact-list-item chat-contact-list-item-title mt-0">
                        <h5 class="text-primary mb-0">Contacts</h5>
                      </li>
                      <!-- Contacts can be static or dynamic -->
                    </ul>
                  </div>
                </div>
                <!-- /Chat contacts -->

                <!-- Chat History -->
                <div class="col app-chat-history">
                  <div class="chat-history-wrapper">
                    <div class="chat-history-header border-bottom" id="chat-header">
                      <!-- Dynamic header content -->
                    </div>
                    <div class="chat-history-body" id="chat-body">
                      <ul class="list-unstyled chat-history" id="message-list">
                        <!-- Messages will be populated dynamically -->
                      </ul>
                    </div>
                    <div class="chat-history-footer shadow-xs">
                      <form class="form-send-message d-flex justify-content-between align-items-center" id="sendMessageForm">
                        <input
                          class="form-control message-input border-0 me-4 shadow-none"
                          name="content"
                          placeholder="Type your message here..."
                          required />
                        <div class="message-actions d-flex align-items-center">
                          <i class="speech-to-text bx bx-microphone bx-md btn btn-icon cursor-pointer text-heading"></i>
                          <label for="attach-doc" class="form-label mb-0">
                            <i class="bx bx-paperclip bx-md cursor-pointer btn btn-icon mx-1 text-heading"></i>
                            <input type="file" id="attach-doc" hidden />
                          </label>
                          <button type="submit" class="btn btn-primary d-flex send-msg-btn">
                            <span class="align-middle d-md-inline-block d-none">Send</span>
                            <i class="bx bx-paper-plane bx-sm ms-md-2 ms-0"></i>
                          </button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

                <!-- /Chat History -->

               

                <div class="app-overlay"></div>
              </div>
            </div>
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
  <script src="../../assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js"></script>

  <!-- Main JS -->
  <script src="../../assets/js/main.js"></script>

  <!-- Page JS -->
  <script src="../../assets/js/app-chat.js"></script>
  <script>
    const currentUserId = <?php echo json_encode($currentUserId); ?>;
    let selectedUserId = null;

    // Fetch and display interacted users (Chats)
    function loadInteractedUsers() {
      fetch('/api.php?action=getInteractedUsers', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          },
          body: `user_id=${encodeURIComponent(currentUserId)}`
        })
        .then(response => response.json())
        .then(data => {
          const chatList = document.getElementById('chat-list');
          chatList.innerHTML = '<li class="chat-contact-list-item chat-contact-list-item-title mt-0"><h5 class="text-primary mb-0">Chats</h5></li>';

          if (data.success && data.users.length > 0) {
            data.users.forEach(user => {
              const li = document.createElement('li');
              li.className = 'chat-contact-list-item mb-1';
              li.innerHTML = `
                            <a class="d-flex align-items-center" data-user-id="${user.user_id}">
                                <div class="flex-shrink-0 avatar ${user.status === 'online' ? 'avatar-online' : 'avatar-offline'}">
                                    <img src="${user.profile_picture_url || '../../assets/img/avatars/default.png'}" alt="Avatar" class="rounded-circle" />
                                </div>
                                <div class="chat-contact-info flex-grow-1 ms-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="chat-contact-name text-truncate m-0 fw-normal">${user.first_name} ${user.last_name}</h6>
                                        <small class="text-muted">${user.last_message_time || 'N/A'}</small>
                                    </div>
                                    <small class="chat-contact-status text-truncate">${user.last_message || 'No messages yet'}</small>
                                </div>
                            </a>
                        `;
              li.querySelector('a').addEventListener('click', () => loadChatHistory(user.user_id, `${user.first_name} ${user.last_name}`, user.profile_picture_url));
              chatList.appendChild(li);
            });
          } else {
            chatList.innerHTML += '<li class="chat-contact-list-item chat-list-item-0"><h6 class="text-muted mb-0">No Chats Found</h6></li>';
          }
        })
        .catch(error => console.error('Error loading chats:', error));
    }

    // Load chat history for a selected user
    function loadChatHistory(otherUserId, name, avatarUrl) {
      selectedUserId = otherUserId;

      // Update chat header
      const header = document.getElementById('chat-header');
      header.innerHTML = `
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex overflow-hidden align-items-center">
                        <i class="bx bx-menu bx-lg cursor-pointer d-lg-none d-block me-4" data-bs-toggle="sidebar" data-overlay data-target="#app-chat-contacts"></i>
                        <div class="flex-shrink-0 avatar avatar-online">
                            <img src="${avatarUrl || '../../assets/img/avatars/default.png'}" alt="Avatar" class="rounded-circle" />
                        </div>
                        <div class="chat-contact-info flex-grow-1 ms-4">
                            <h6 class="m-0 fw-normal">${name}</h6>
                            <small class="user-status text-body">Online</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="bx bx-phone bx-md cursor-pointer d-sm-inline-flex d-none btn btn-icon text-secondary me-1"></i>
                        <i class="bx bx-video bx-md cursor-pointer d-sm-inline-flex d-none btn btn-icon text-secondary me-1"></i>
                        <i class="bx bx-search bx-md cursor-pointer d-sm-inline-flex d-none btn btn-icon text-secondary me-1"></i>
                        <div class="dropdown">
                            <button class="btn btn-icon text-secondary dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="true" id="chat-header-actions">
                                <i class="bx bx-dots-vertical-rounded bx-md"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="chat-header-actions">
                                <a class="dropdown-item" href="javascript:void(0);">View Contact</a>
                                <a class="dropdown-item" href="javascript:void(0);">Mute Notifications</a>
                                <a class="dropdown-item" href="javascript:void(0);">Block Contact</a>
                                <a class="dropdown-item" href="javascript:void(0);">Clear Chat</a>
                                <a class="dropdown-item" href="javascript:void(0);">Report</a>
                            </div>
                        </div>
                    </div>
                </div>
            `;

      // Fetch and display chat history
      fetch('/api.php?action=getChatHistory', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          },
          body: `user_id=${encodeURIComponent(currentUserId)}&other_user_id=${encodeURIComponent(otherUserId)}`
        })
        .then(response => response.json())
        .then(data => {
          const messageList = document.getElementById('message-list');
          messageList.innerHTML = '';

          if (data.success && data.messages.length > 0) {
            data.messages.forEach(msg => {
              const isSender = msg.sender_id == currentUserId;
              const li = document.createElement('li');
              li.className = `chat-message ${isSender ? 'chat-message-right' : ''}`;
              li.innerHTML = `
                            <div class="d-flex overflow-hidden">
                                ${!isSender ? `
                                    <div class="user-avatar flex-shrink-0 me-4">
                                        <div class="avatar avatar-sm">
                                            <img src="${msg.sender_avatar || '../../assets/img/avatars/default.png'}" alt="Avatar" class="rounded-circle" />
                                        </div>
                                    </div>
                                ` : ''}
                                <div class="chat-message-wrapper flex-grow-1">
                                    <div class="chat-message-text">
                                        <p class="mb-0">${msg.content}</p>
                                    </div>
                                    <div class="${isSender ? 'text-end' : ''} text-muted mt-1">
                                        ${isSender ? '<i class="bx bx-check-double bx-16px text-success me-1"></i>' : ''}
                                        <small>${new Date(msg.timestamp).toLocaleTimeString()}</small>
                                    </div>
                                </div>
                                ${isSender ? `
                                    <div class="user-avatar flex-shrink-0 ms-4">
                                        <div class="avatar avatar-sm">
                                            <img src="${msg.sender_avatar || '../../assets/img/avatars/default.png'}" alt="Avatar" class="rounded-circle" />
                                        </div>
                                    </div>
                                ` : ''}
                            </div>
                        `;
              messageList.appendChild(li);
            });
            messageList.scrollTop = messageList.scrollHeight; // Scroll to bottom
          }
        })
        .catch(error => console.error('Error loading chat history:', error));
    }

    // Handle message sending
    document.getElementById('sendMessageForm').addEventListener('submit', function(event) {
      event.preventDefault();
      if (!selectedUserId) {
        alert('Please select a user to message.');
        return;
      }

      const form = event.target;
      const content = form.querySelector('.message-input').value.trim();
      if (!content) return;

      fetch('/api.php?action=sendMessage', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          },
          body: `sender_id=${encodeURIComponent(currentUserId)}&recipient_id=${encodeURIComponent(selectedUserId)}&content=${encodeURIComponent(content)}`
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            form.reset();
            loadChatHistory(selectedUserId, document.querySelector('#chat-header h6').textContent, document.querySelector('#chat-header img').src);
          } else {
            alert(data.message);
          }
        })
        .catch(error => console.error('Error sending message:', error));
    });

    // Initial load
    loadInteractedUsers();
  </script>
</body>

</html>