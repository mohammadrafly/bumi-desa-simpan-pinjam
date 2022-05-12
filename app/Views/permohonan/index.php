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
                      <a href="<?= base_url('dashboard/permohonan/add'); ?>" class="btn btn-otline-dark align-items-center"><i class="icon-plus"></i> Add permohonan</a>
                      <a href="<?= base_url('dashboard/permohonan/export'); ?>" class="btn btn-primary text-white me-0"><i class="icon-download"></i> Export</a>
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
                                <th>ID permohonan</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>Nominal</th>
                                <th>NIK</th>
                                <th>Jenis Permohonan</th>
                                <th>Status Permohonan</th>
                                <th>Waktu Dikirim</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($content): ?>
                            <?php 
                            $no = 1;
                            foreach($content as $row): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $row['id_permohonan']; ?></td>
                                <td><?= $row['judul_permohonan']; ?></td>
                                <td><?= $row['deskripsi_permohonan']; ?></td>
                                <td><?= $row['nominal_permohonan']; ?></td>
                                <td><?= $row['nik']; ?></td>
                                <td><?= $row['jenis_permohonan']; ?></td>
                                <td>
                                    <?php if($row['status_permohonan'] === 'HOLD'): ?>
                                      <span class="badge bg-warning text-white"><?= $row['status_permohonan'] ?></span>
                                    <?php elseif($row['status_permohonan'] === 'DITERIMA'): ?>
                                      <span class="badge bg-success text-white"><?= $row['status_permohonan'] ?></span>
                                    <?php elseif($row['status_permohonan'] === 'DITOLAK'): ?>
                                      <span class="badge bg-danger text-white"><?= $row['status_permohonan'] ?></span>
                                    <?php endif ?>
                                </td>
                                <td><?= $row['created_at']; ?></td>
                                <td>
                                    <a href="<?= base_url('dashboard/permohonan/edit/'.$row['id_permohonan']); ?>" class="btn-sm btn-warning text-white"><i class="mdi mdi-table-edit"></i></a>
                                    <a href="<?= base_url('dashboard/permohonan/delete/'.$row['id_permohonan']); ?>" class="btn-sm btn-danger text-white"><i class="mdi mdi-delete-forever"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                      </table>
                    <?= $permohonan->links('content', 'bootstrap_pagination'); ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

<?= $this->endSection() ?>