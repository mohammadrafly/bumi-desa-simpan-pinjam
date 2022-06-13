<?= $this->extend('layout/dashboard') ?>

<?= $this->section('content') ?>

            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><?= $pages; ?></h4>
                  <form class="forms-sample" method="POST" action="<?= base_url('PenggunaController/updatePassword'); ?>">
                  <?= csrf_field() ?>
                    <input type="text" hidden name="id" class="form-control" id="exampleInputName1" value="<?= $data['id']; ?>">
                    <div class="form-group">
                      <label for="exampleInputName1">Password Baru</label>
                      <input type="password" name="password" class="form-control" id="exampleInputName1" placeholder="Masukkan Password Baru">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Konfrimasi Password Baru</label>
                      <input type="password" name="conf_password" class="form-control" id="exampleInputName1" placeholder="Masukkan Password Baru">
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                  </form>
                </div>
              </div>
            </div>

<?= $this->endSection() ?>