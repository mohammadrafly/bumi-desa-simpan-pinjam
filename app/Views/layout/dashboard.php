<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>BUMDes</title>
  <!-- plugins:css -->
  <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
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
  <link rel="shortcut icon" href="<?= base_url('images/logo.png'); ?>" />
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
          <a class="navbar-brand brand-logo" href="<?= base_url('dashboard'); ?>">
            <img src="<?= base_url('images/logo.png'); ?>" alt="logo" />
          </a>
          <a class="navbar-brand brand-logo-mini" href="<?= base_url('dashboard'); ?>">
            <img src="<?= base_url('images/logo.png'); ?>" alt="logo" />
          </a>
        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-top"> 
        <ul class="navbar-nav">
          <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
            <h1 class="welcome-text">Selamat Datang! <span class="text-black fw-bold"><?= session()->get('name'); ?></span></h1>
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
                          <?php if(session()->get('foto_diri') === NULL): ?>
                            <img class="img-xs rounded-circle" src="<?= base_url('images/default.png') ;?>"> </a>
                          <?php elseif(session()->get('foto_diri')): ?>
                            <img class="img-xs rounded-circle" src="<?= base_url('profile/'.session()->get('foto_diri')) ?>"> </a>
                          <?php endif ?>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <div class="dropdown-header text-center">
                          <?php if(session()->get('foto_diri') === NULL): ?>
                            <img class="img-xs rounded-circle" src="<?= base_url('images/default.png') ;?>"> </a>
                          <?php elseif(session()->get('foto_diri')): ?>
                            <img class="img-xs rounded-circle" src="<?= base_url('profile/'.session()->get('foto_diri')) ?>"> </a>
                          <?php endif ?>
                <p class="mb-1 mt-3 font-weight-semibold"><?= session()->get('name'); ?></p>
                <p class="fw-light text-muted mb-0"><?= session()->get('email'); ?></p>
              </div>
              <a class="dropdown-item" href="<?= base_url('dashboard/profile/u/'.session()->get('nik')); ?>"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My Profile</a>
              <a class="dropdown-item" href="<?= base_url('dashboard/profile/faq') ?>"><i class="dropdown-item-icon mdi mdi-help-circle-outline text-primary me-2"></i> FAQ</a>
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
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <?php if(session()->get('role') === 'superadmin' || session()->get('role') === 'admin'): ?>
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
            <a class="nav-link" href="<?= base_url('dashboard/anggota'); ?>">
              <i class="menu-icon mdi mdi-account-multiple"></i>
              <span class="menu-title">Data Anggota</span>
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
          <li class="nav-item nav-category">Lainnya</li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('dashboard/laporan'); ?>">
              <i class="menu-icon mdi mdi-chart-bubble"></i>
              <span class="menu-title">Laporan</span>
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
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Made with ❤️ by BUMDes </a></span>
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
  <script>
    $(document).ready(function () {
    $('#example').DataTable();
});
  </script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
</body>

</html>

