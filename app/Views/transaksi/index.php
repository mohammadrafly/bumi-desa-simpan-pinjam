<?= $this->extend('layout/dashboard') ?>

<?= $this->section('content') ?>

          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link" id="home-tab" data-bs-toggle="tab" role="tab" aria-controls="overview" aria-selected="true"><?= $pages; ?></a>
                    </li>
                  </ul>
                  <div>
                    <div class="btn-wrapper">
                      <a href="<?= base_url('dashboard/pengguna/add'); ?>" class="btn btn-otline-dark align-items-center"><i class="icon-plus"></i> Add Pengguna</a>
                      <a href="<?= base_url('#'); ?>" class="btn btn-otline-dark"><i class="icon-printer"></i> Print</a>
                      <a href="<?= base_url('dashboard/pengguna/export'); ?>" class="btn btn-primary text-white me-0"><i class="icon-download"></i> Export</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($content): ?>
                            <?php 
                            $no = 1;
                            foreach($content as $row): ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['nik']; ?></td>
                                <td>
                                    <a href="<?= base_url('dashboard/transaksi/simpanan/pengguna/'.$row['nik']); ?>" class="btn-sm btn-primary text-white">Simpanan</a>
                                    <a href="<?= base_url('dashboard/transaksi/pinjaman/pengguna/'.$row['nik']); ?>" class="btn-sm btn-primary text-white">Pinjaman</a>
                                    <a href="<?= base_url('dashboard/transaksi/angsuran/pengguna/'.$row['nik']); ?>" class="btn-sm btn-primary text-white">Angsuran</a>
                                    <a href="<?= base_url('dashboard/transaksi/penarikan/pengguna/'.$row['nik']); ?>" class="btn-sm btn-primary text-white">Penarikan</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                      </table>
                    <?= $pager->links('content', 'bootstrap_pagination'); ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

<?= $this->endSection() ?>