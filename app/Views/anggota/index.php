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
                                <th>Nama</th>
                                <th>Phone</th>
                                <th>Nik</th>
                                <th>Alamat</th>
                                <?php if(session()->get('role') === 'superadmin'): ?>

                                <?php elseif(session()->get('role') === 'admin'): ?>
                                <th>Option</th>
                                <?php endif ?>
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
                                <td><?php echo $row->phone; ?></td>
                                <td><?php echo $row->nik; ?></td>
                                <td><?php echo $row->alamat; ?></td>
                                <?php if(session()->get('role') === 'superadmin'): ?>

                                <?php elseif(session()->get('role') === 'admin'): ?>
                                <td>
                                    <a href="<?= base_url('dashboard/pengguna/ganti/password/'.$row->id); ?>" 
                                    class="btn-sm btn-primary"><i class="mdi mdi-account-convert"></i>
                                    </a>
                                    <a href="<?= base_url('dashboard/pengguna/edit/'.$row->id); ?>" 
                                    class="btn-sm btn-warning"><i class="mdi mdi-table-edit"></i>
                                    </a>
                                    <a href="<?= base_url('dashboard/pengguna/delete/'.$row->id); ?>" 
                                    class="btn-sm btn-danger"><i class="mdi mdi-delete-forever"></i>
                                    </a>
                                </td>
                                <?php endif ?>
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