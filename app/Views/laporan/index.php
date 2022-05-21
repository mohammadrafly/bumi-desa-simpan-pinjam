<?= $this->extend('layout/dashboard') ?>

<?= $this->section('content') ?>

          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active ps-0"><?= $pages ?></a>
                    </li>
                  </ul>
                </div>
                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview"> 
                    <div class="row">
                      <div class="col-sm-12">
                        
                        <div class="statistics-details d-flex align-items-center justify-content-between">
                          <div>
                            <p class="statistics-title">Export Pengguna</p>
                            <a href="<?= base_url('dashboard/pengguna/export') ?>" class="btn btn-outline-secondary"><i class="mdi mdi-account-multiple-outline"></i>Download Data Pengguna</a>
                          </div>
                          <div>
                            <p class="statistics-title">Export Simpanan</p>
                            <a href="<?= base_url('dashboard/transaksi/simpanan/export') ?>" class="btn btn-outline-secondary"><i class="mdi mdi-arrow-down-bold-circle-outline"></i>Download Data Simpanan</a>
                          </div>
                          <div>
                            <p class="statistics-title">Export Pinjaman</p>
                            <a href="<?= base_url('dashboard/transaksi/pinjaman/export') ?>" class="btn btn-outline-secondary"><i class="mdi mdi-arrow-up-bold-circle-outline"></i>Download Data Pinjaman</a>
                          </div>
                          <div class="d-none d-md-block">
                            <p class="statistics-title">Export Angsuran</p>
                            <a href="<?= base_url('dashboard/transaksi/angsuran/export') ?>" class="btn btn-outline-secondary"><i class="mdi mdi-av-timer"></i>Download Data Angsuran</a>
                          </div>
                          <div class="d-none d-md-block">
                            <p class="statistics-title">Export Permohonan</p>
                            <a href="<?= base_url('dashboard/permohonan/export') ?>" class="btn btn-outline-secondary"><i class="mdi mdi-archive"></i>Download Data Permohonan</a>
                          </div>
                          <div class="d-none d-md-block">
                            <p class="statistics-title">Export Penarikan</p>
                            <a href="<?= base_url('dashboard/transaksi/penarikan/export') ?>" class="btn btn-outline-secondary"><i class="mdi mdi-credit-card-scan"></i>Download Data Penarikan</a>
                          </div>
                          <div class="d-none d-md-block">
                            <p class="statistics-title">Export Pembayaran</p>
                            <a href="<?= base_url('dashboard/transaksi/pembayaran/export') ?>" class="btn btn-outline-secondary"><i class="mdi mdi-cash-multiple"></i>Download Data Pembayaran</a>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
<?= $this->endSection() ?>