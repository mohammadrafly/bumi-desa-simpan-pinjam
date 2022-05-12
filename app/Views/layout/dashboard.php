<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Bumdes v.2 </title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?= base_url('vendors/feather/feather.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('vendors/mdi/css/materialdesignicons.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('vendors/ti-icons/css/themify-icons.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('vendors/typicons/typicons.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('vendors/simple-line-icons/css/simple-line-icons.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('vendors/css/vendor.bundle.base.css'); ?>">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="<?= base_url('vendors/datatables.net-bs4/dataTables.bootstrap4.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('js/select.dataTables.min.css'); ?>">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?= base_url('css/vertical-layout-light/style.css'); ?>">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?= base_url('images/favicon.png'); ?>" />
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
            <span class="icon-menu"></span>
          </button>
        </div>
        <div>
          <a class="navbar-brand brand-logo" href="<?= base_url('index.html'); ?>">
            <img src="<?= base_url('images/logo.svg'); ?>" alt="logo" />
          </a>
          <a class="navbar-brand brand-logo-mini" href="<?= base_url('index.html'); ?>">
            <img src="<?= base_url('images/logo-mini.svg'); ?>" alt="logo" />
          </a>
        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-top"> 
        <ul class="navbar-nav">
          <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
            <h1 class="welcome-text">Good Morning, <span class="text-black fw-bold"><?= session()->get('name'); ?></span></h1>
            <h3 class="welcome-sub-text">Your performance summary this week </h3>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          <li class="d-none d-lg-block">
                    <span>
                    <?php if (!empty(session()->getFlashdata('error'))) : ?>
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                          <?php echo session()->getFlashdata('error'); ?>
                      </div>
                    <?php endif; ?>
                    </span>
          </li>
          <li class="nav-item dropdown d-none d-lg-block user-dropdown">
            <a class="nav-link" id="UserDropdown" href="<?= base_url('#'); ?>" data-bs-toggle="dropdown" aria-expanded="false">
              <img class="img-xs rounded-circle" src="<?= base_url('images/faces/face8.jpg'); ?>" alt="Profile image"> </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <div class="dropdown-header text-center">
                <img class="img-md rounded-circle" src="<?= base_url('images/faces/face8.jpg'); ?>" alt="Profile image">
                <p class="mb-1 mt-3 font-weight-semibold"><?= session()->get('name'); ?></p>
                <p class="fw-light text-muted mb-0"><?= session()->get('email'); ?></p>
              </div>
              <a class="dropdown-item" href="<?= base_url('dashboard/profile/u/'.session()->get('nik')); ?>"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My Profile</a>
              <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-help-circle-outline text-primary me-2"></i> FAQ</a>
              <a class="dropdown-item" href="<?= base_url('logout'); ?>"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <div id="right-sidebar" class="settings-panel">
        <i class="settings-close ti-close"></i>
        <ul class="nav nav-tabs border-top" id="setting-panel" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="todo-tab" data-bs-toggle="tab" href="<?= base_url('#todo-section'); ?>" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="chats-tab" data-bs-toggle="tab" href="<?= base_url('#chats-section'); ?>" role="tab" aria-controls="chats-section">CHATS</a>
          </li>
        </ul>
        <div class="tab-content" id="setting-content">
          <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
            <div class="add-items d-flex px-3 mb-0">
              <form class="form w-100">
                <div class="form-group d-flex">
                  <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                  <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task">Add</button>
                </div>
              </form>
            </div>
            <div class="list-wrapper px-3">
              <ul class="d-flex flex-column-reverse todo-list">
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Team review meeting at 3.00 PM
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Prepare for presentation
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Resolve all the low priority tickets due today
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Schedule meeting for next week
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Project review
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
              </ul>
            </div>
            <h4 class="px-3 text-muted mt-5 fw-light mb-0">Events</h4>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                <i class="ti-control-record text-primary me-2"></i>
                <span>Feb 11 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Creating component page build a js</p>
              <p class="text-gray mb-0">The total number of sessions</p>
            </div>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                <i class="ti-control-record text-primary me-2"></i>
                <span>Feb 7 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
              <p class="text-gray mb-0 ">Call Sarah Graves</p>
            </div>
          </div>
          <!-- To do section tab ends -->
          <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
            <div class="d-flex align-items-center justify-content-between border-bottom">
              <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
              <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 fw-normal">See All</small>
            </div>
            <ul class="chat-list">
              <li class="list active">
                <div class="profile"><img src="images/faces/face1.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Thomas Douglas</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">19 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face2.jpg" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <div class="wrapper d-flex">
                    <p>Catherine</p>
                  </div>
                  <p>Away</p>
                </div>
                <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                <small class="text-muted my-auto">23 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face3.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Daniel Russell</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">14 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face4.jpg" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <p>James Richardson</p>
                  <p>Away</p>
                </div>
                <small class="text-muted my-auto">2 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face5.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Madeline Kennedy</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">5 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face6.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Sarah Graves</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">47 min</small>
              </li>
            </ul>
          </div>
          <!-- chat tab ends -->
        </div>
      </div>
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <?php if(session()->get('role') === 'superadmin'): ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('dashboard'); ?>">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item nav-category">Data Master</li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('dashboard/pengguna'); ?>">
              <i class="menu-icon mdi mdi-account-circle-outline"></i>
              <span class="menu-title">Data Pengguna</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('dashboard/transaksi'); ?>">
              <i class="menu-icon mdi mdi-cash-usd"></i>
              <span class="menu-title">Data Transaksi</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('dashboard/permohonan'); ?>">
              <i class="menu-icon mdi mdi-archive"></i>
              <span class="menu-title">Data Permohonan</span>
            </a>
          </li>
            <?php elseif(session()->get('role') === 'customer'): ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('dashboard'); ?>">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item nav-category">Menu</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon mdi mdi-credit-card-scan"></i>
              <span class="menu-title">My Transaction</span>
              <i class="menu-arrow"></i> 
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?= base_url('dashboard/my/transaksi/u/'.session()->get('nik').'/simpanan') ;?>">Simpanan</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?= base_url('dashboard/my/transaksi/u/'.session()->get('nik').'/pinjaman') ;?>">Pinjaman</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?= base_url('dashboard/my/transaksi/u/'.session()->get('nik').'/angsuran') ;?>">Angsuran</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?= base_url('dashboard/my/transaksi/u/'.session()->get('nik').'/penarikan') ;?>">Penarikan</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('dashboard/my/permohonan/u/'.session()->get('nik')); ?>">
              <i class="menu-icon mdi mdi-archive"></i>
              <span class="menu-title">My Permohonan</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('dashboard/profile/u/'.session()->get('nik')); ?>">
              <i class="menu-icon mdi mdi-account-circle-outline"></i>
              <span class="menu-title">My Profile</span>
            </a>
          </li>
            <?php elseif(session()->get('role') === 'admin'): ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('dashboard'); ?>">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item nav-category">Data Master</li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('dashboard/transaksi'); ?>">
              <i class="menu-icon mdi mdi-cash-usd"></i>
              <span class="menu-title">Data Transaksi</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('dashboard/permohonan'); ?>">
              <i class="menu-icon mdi mdi-archive"></i>
              <span class="menu-title">Data Permohonan</span>
            </a>
          </li>
            <?php endif ?>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
        <?= $this->renderSection('content') ?>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Made with ❤️ by BUMDES </a></span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright                © <script>
                  document.write(new Date().getFullYear())
                </script>. All rights reserved.</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="<?= base_url('vendors/js/vendor.bundle.base.js'); ?>"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="<?= base_url('vendors/chart.js/Chart.min.js'); ?>"></script>
  <script src="<?= base_url('vendors/bootstrap-datepicker/bootstrap-datepicker.min.js'); ?>"></script>
  <script src="<?= base_url('vendors/progressbar.js/progressbar.min.js'); ?>"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="<?= base_url('js/off-canvas.js'); ?>"></script>
  <script src="<?= base_url('js/hoverable-collapse.js'); ?>"></script>
  <script src="<?= base_url('js/template.js'); ?>"></script>
  <script src="<?= base_url('js/settings.js'); ?>"></script>
  <script src="<?= base_url('js/todolist.js'); ?>"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="<?= base_url('js/jquery.cookie.js'); ?>" type="text/javascript"></script>
  <script src="<?= base_url('js/dashboard.js'); ?>"></script>
  <script src="<?= base_url('js/Chart.roundedBarCharts.js'); ?>"></script>
  <!-- End custom js for this page-->
</body>

</html>

