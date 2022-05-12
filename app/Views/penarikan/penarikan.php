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
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID penarikan</th>
                                <th>Nominal</th>
                                <th>Kode Penarikan</th>
                                <th>Status penarikan</th>
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
                                <td><?= $row->id_penarikan; ?></td>
                                <td><?= number_to_currency($row->nominal, 'IDR'); ?></td>
                                <td><?= $row->kode_penarikan; ?></td>
                                <td>
                                    <?php if($row->status_penarikan === 'TELAH DIAMBIL'): ?>
                                      <span class="badge bg-success text-white"><?= $row->status_penarikan ?></span>
                                    <?php elseif($row->status_penarikan === 'BELUM DIAMBIL'): ?>
                                      <span class="badge bg-warning text-white"><?= $row->status_penarikan ?></span>
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