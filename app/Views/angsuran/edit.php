<?= $this->extend('layout/dashboard') ?>

<?= $this->section('content') ?>

            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><?= $pages; ?></h4>
                  <form class="forms-sample" method="POST" action="<?= base_url('dashboard/transaksi/angsuran/update'); ?>">
                  <?= csrf_field() ?>
                    <input type="text" hidden name="id_angsuran" class="form-control" id="exampleInputName1" value="<?= $data['id_angsuran']; ?>">
                    <div class="form-group">
                      <label for="exampleInputName1">Nominal</label>
                      <input type="text" name="nominal" class="form-control" id="exampleInputName1" placeholder="Nominal" value="<?= $data['nominal']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Waktu</label>
                      <input type="text" name="waktu" class="form-control" id="exampleInputName1" placeholder="Waktu" value="<?= $data['waktu']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleSelectstatu_angsuran">Status angsuran</label>
                        <select name="status_angsuran" value="<?= $data['status_angsuran']; ?>" class="form-control" id="exampleSelectstatu_angsuran">
                          <option selected value="<?= $data['status_angsuran']; ?>"><?= $data['status_angsuran']; ?></option>
                          <option value="LUNAS">LUNAS</option>
                          <option value="BELUM LUNAS">BELUM LUNAS</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>

<?= $this->endSection() ?>