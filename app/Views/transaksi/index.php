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
                </div>
              </div>
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <table id="example" class="table table-striped" style="width:100%">
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
                                <td><?php echo $row->name; ?></td>
                                <td><?php echo $row->nik; ?></td>
                                <td>
                                    <a href="<?= base_url('dashboard/transaksi/simpanan/pengguna/'.$row->nik); ?>" class="btn-sm btn-primary text-white">Simpanan</a>
                                    <a href="<?= base_url('dashboard/transaksi/pinjaman/pengguna/'.$row->nik); ?>" class="btn-sm btn-primary text-white">Pinjaman</a>
                                    <a href="<?= base_url('dashboard/transaksi/angsuran/pengguna/'.$row->nik); ?>" class="btn-sm btn-primary text-white">Angsuran</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

<?= $this->endSection() ?>