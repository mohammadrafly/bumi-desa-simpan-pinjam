<?= $this->extend('layout/dashboard') ?>

<?= $this->section('content') ?>

            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><?= $pages; ?></h4>
                  <form class="forms-sample" method="POST" action="<?= base_url('dashboard/transaksi/simpanan/store'); ?>">
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
                      <label for="exampleSelectGender">Jenis simpanan</label>
                        <select name="jenis_simpanan" class="form-control" id="exampleSelectGender">
                          <option value="POKOK">Pokok</option>
                          <option value="SUKARELA">Sukarela</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>

<?= $this->endSection() ?>