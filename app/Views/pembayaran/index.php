<?= $this->extend('layout/dashboard') ?>

<?= $this->section('content') ?>

          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link" id="home-tab" data-bs-toggle="tab" role="tab" aria-controls="overview" aria-selected="true"><?= $pages; ?> <p name="nik">Angsuran ID: <?= $id ?></p></a>
                    </li>
                  </ul>
                  <div>
                  <?php if(session()->get('role') === 'superadmin'): ?>

                  <?php elseif(session()->get('role') === 'admin'): ?>
                    <div class="btn-wrapper">
                      <a href="<?= base_url('dashboard/transaksi/pembayaran/add/'.$id); ?>" class="btn btn-otline-dark align-items-center"><i class="icon-plus"></i> Add Pembayaran</a>
                    </div>
                  <?php endif ?>
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
                                <th>Id pembayaran</th>
                                <th>Nadzar</th>
                                <th>Nominal</th>
                                <th>Waktu Transaksi</th>
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
                                <td><?= $row->id_pembayaran; ?></td>
                                <td><?= number_to_currency($row->biaya_admin, 'IDR'); ?></td>
                                <td><?= number_to_currency($row->nominal, 'IDR'); ?></td>
                                <td><?= $row->created_at; ?></td>
                                <td>
                                    <a href="<?= base_url('dashboard/transaksi/pembayaran/view/'.$row->id_pembayaran); ?>" class="btn-sm btn-primary text-white"><i class="mdi mdi-eye"></i></a>
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
          </div>

<?= $this->endSection() ?>