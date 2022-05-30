<?= $this->extend('layout/dashboard') ?>

<?= $this->section('content') ?>

            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><?= $pages; ?></h4>
                  <form class="forms-sample" method="POST" action="<?= base_url('dashboard/transaksi/penarikan/store'); ?>">
                  <?= csrf_field() ?>
                    <input type="number" name="nik" class="form-control" id="exampleInputName1" placeholder="<?= $nik; ?>" value="<?= $nik; ?>" hidden>
                    <div class="form-group">
                      <label for="exampleInputName1">ID Simpanan</label>
                      <input type="number" name="id_simpanan" class="form-control" id="exampleInputName1" placeholder="<?= $id; ?>" value="<?= $id; ?>" disabled>
                      <input type="number" name="id_simpanan" class="form-control" id="exampleInputName1" placeholder="<?= $id; ?>" value="<?= $id; ?>" hidden>
                    </div>
                    <div class="form-group">
                      <input type="number" name="nominal_simpanan" class="form-control" id="exampleInputName1" value="<?= $nominal; ?>" placeholder="<?= $nominal; ?>" hidden>
                      <label for="exampleInputName1">Nominal</label>
                      <input type="number" name="nominal" class="form-control" id="exampleInputName1" placeholder="Nominal">
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>

<?= $this->endSection() ?>