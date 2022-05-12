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
                      <a href="<?= base_url('dashboard/my/permohonan/u/'.session()->get('nik').'/new'); ?>" class="btn btn-otline-dark align-items-center"><i class="icon-plus"></i> Add permohonan</a>

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
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($content): ?>
                            <?php 
                            $no = 1;
                            foreach($content as $row): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $row->id_permohonan; ?></td>
                                <td><?= $row->judul_permohonan; ?></td>
                                <td><?= $row->deskripsi_permohonan; ?></td>
                                <td><?= number_to_currency($row->nominal_permohonan, 'IDR'); ?></td>
                                <td><?= $row->nik; ?></td>
                                <td><?= $row->jenis_permohonan; ?></td>
                                <td>
                                    <?php if($row->status_permohonan === 'HOLD'): ?>
                                      <span class="badge bg-warning text-white"><?= $row->status_permohonan ?></span>
                                    <?php elseif($row->status_permohonan === 'DITERIMA'): ?>
                                      <span class="badge bg-success text-white"><?= $row->status_permohonan ?></span>
                                    <?php elseif($row->status_permohonan === 'DITOLAK'): ?>
                                      <span class="badge bg-danger text-white"><?= $row->status_permohonan ?></span>
                                    <?php endif ?>
                                </td>
                                <td><?= $row->created_at; ?></td>
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
          </div>

<?= $this->endSection() ?>