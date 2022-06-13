<?= $this->extend('layout/dashboard') ?>

<?= $this->section('content') ?>

            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><?= $pages; ?></h4>
                  <form class="forms-sample" method="POST" action="<?= base_url('dashboard/transaksi/pembayaran/store'); ?>">
                  <?= csrf_field() ?>
                    <input hidden name="id_angsuran"  value="<?= $id; ?>" placeholder="<?= $id; ?>">
                    <div class="form-group">
                      <label for="exampleInputName1">ID Angsuran</label>
                      <input type="number" name="id_angsuran" class="form-control" id="exampleInputName1" placeholder="<?= $id; ?>" disabled>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Nadzar</label>
                      <input type="number" name="biaya_admin" class="form-control" id="exampleInputName1" placeholder="Nadzar">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Nominal</label>
                      <input type="number" name="nominal" class="form-control" id="exampleInputName1" placeholder="Nominal">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Tanggal</label>
                      <input type="date" name="created_at" class="form-control" id="exampleInputName1" placeholder="Tanggal">
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                  </form>
                </div>
              </div>
            </div>

<?= $this->endSection() ?>