<?= $this->extend('layout/dashboard') ?>

<?= $this->section('content') ?>

            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><?= $pages; ?></h4>
                  <form class="forms-sample" method="POST" action="<?= base_url('dashboard/transaksi/pinjaman/store'); ?>">
                  <?= csrf_field() ?>
                    <div class="form-group">
                      <label for="exampleInputName1">NIK</label>
                      <input type="number" name="nik" class="form-control" id="exampleInputName1" placeholder="<?= $nik; ?>" value="<?= $nik; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Nominal</label>
                      <input type="number" name="nominal" class="form-control" id="exampleInputName1" placeholder="Nominal">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputbiaya_dmin3">Biaya Admin</label>
                      <input type="number" name="biaya_admin" class="form-control" id="exampleInputbiaya_dmin3" placeholder="Biaya Admin">
                    </div>
                    <div class="form-group">
                      <label for="exampleSelectGender">Jenis Pinjaman</label>
                        <select name="jenis_pinjaman" class="form-control" id="exampleSelectGender">
                          <option value="BIASA">Biasa</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>

<?= $this->endSection() ?>