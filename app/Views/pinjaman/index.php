<?= $this->extend('layout/dashboard') ?>

<?= $this->section('content') ?>

          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link" id="home-tab" data-bs-toggle="tab" role="tab" aria-controls="overview" aria-selected="true"><?= $pages; ?> <p name="nik"><?= $user['name'] ?></p></a>
                    </li>
                  </ul>
                  <div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Id Pinjaman</th>
                                <th>Nominal</th>
                                <th>Jenis Pinjaman</th>
                                <th>Kode Penarikan</th>
                                <th>Status Pinjaman</th>
                                <th>Tanggal</th>
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
                                <td><?= $row->id_pinjaman; ?></td>
                                <td><?= number_to_currency($row->nominal, 'IDR'); ?></td>
                                <td><?= $row->jenis_pinjaman; ?></td>
                                <td><?= $row->kode_penarikan; ?></td>
                                <td>
                                    <?php if($row->status_pinjaman === 'TELAH DIAMBIL'): ?>
                                      <span class="badge bg-success text-white"><?= $row->status_pinjaman ?></span>
                                    <?php elseif($row->status_pinjaman === 'BELUM DIAMBIL'): ?>
                                      <span class="badge bg-warning text-white"><?= $row->status_pinjaman ?></span>
                                    <?php endif ?>
                                </td>
                                <td><?= $row->created_at ?></td>
                                <td>
                                <?php if(session()->get('role') === 'superadmin'): ?>
                                    <a href="<?= base_url('dashboard/transaksi/pinjaman/view/'.$row->id_pinjaman); ?>" class="btn-sm btn-primary text-white"><i class="mdi mdi-eye"></i></a>
                                <?php elseif(session()->get('role') === 'admin'): ?>
                                    <a href="<?= base_url('dashboard/transaksi/pinjaman/edit/'.$row->id_pinjaman.'/'.$user['nik']); ?>" class="btn-sm btn-warning text-white"><i class="mdi mdi-table-edit"></i></a>
                                    <a href="<?= base_url('dashboard/transaksi/pinjaman/delete/'.$row->id_pinjaman.'/'.$user['nik']); ?>" class="btn-sm btn-danger text-white"><i class="mdi mdi-delete-forever"></i></a>
                                    <a href="<?= base_url('dashboard/transaksi/pinjaman/view/'.$row->id_pinjaman.'/'.$user['nik']); ?>" class="btn-sm btn-primary text-white"><i class="mdi mdi-eye"></i></a>
                                <?php endif ?>  
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