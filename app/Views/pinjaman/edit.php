<?= $this->extend('layout/dashboard') ?>

<?= $this->section('content') ?>

            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><?= $pages; ?></h4>
                  <form class="forms-sample" method="POST" action="<?= base_url('dashboard/transaksi/pinjaman/update'); ?>">
                  <?= csrf_field() ?>
                    <input type="text" hidden name="id_pinjaman" class="form-control" id="exampleInputName1" value="<?= $data['id_pinjaman']; ?>">
                    <div class="form-group">
                      <label for="exampleInputName1">Nominal</label>
                      <input type="text" name="nominal" class="form-control" id="exampleInputName1" placeholder="Nominal" value="<?= $data['nominal']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Biaya Admin</label>
                      <input type="text" name="biaya_admin" class="form-control" id="exampleInputName1" placeholder="Biaya Admin" value="<?= $data['biaya_admin']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleSelectstatu_pinjaman">Jenis Pinjaman</label>
                        <select name="jenis_pinjaman" value="<?= $data['jenis_pinjaman']; ?>" class="form-control" id="exampleSelectstatu_pinjaman">
                          <option selected value="<?= $data['jenis_pinjaman']; ?>"><?= $data['jenis_pinjaman']; ?></option>
                        </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleSelectstatu_pinjaman">Status Pinjaman</label>
                        <select name="status_pinjaman" value="<?= $data['status_pinjaman']; ?>" class="form-control" id="exampleSelectstatu_pinjaman">
                          <option selected value="<?= $data['status_pinjaman']; ?>"><?= $data['status_pinjaman']; ?></option>
                          <option value="TELAH DIAMBIL">TELAH DIAMBIL</option>
                          <option value="BELUM DIAMBIL">BELUM DIAMBIL</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>

<?= $this->endSection() ?>