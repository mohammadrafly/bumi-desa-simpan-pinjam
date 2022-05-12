<?= $this->extend('layout/dashboard') ?>

<?= $this->section('content') ?>

            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><?= $pages; ?></h4>
                  <form class="forms-sample" method="POST" action="<?= base_url('dashboard/transaksi/simpanan/update'); ?>">
                  <?= csrf_field() ?>
                    <input type="text" hidden name="id_simpanan" class="form-control" id="exampleInputName1" value="<?= $data['id_simpanan']; ?>">
                    <div class="form-group">
                      <label for="exampleInputName1">Nominal</label>
                      <input type="text" name="nominal" class="form-control" id="exampleInputName1" placeholder="Nominal" value="<?= $data['nominal']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleSelectstatu_simpanan">Jenis simpanan</label>
                        <select name="jenis_simpanan" value="<?= $data['jenis_simpanan']; ?>" class="form-control" id="exampleSelectstatu_simpanan">
                          <option selected value="<?= $data['jenis_simpanan']; ?>"><?= $data['jenis_simpanan']; ?></option>
                        </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleSelectstatu_simpanan">Status simpanan</label>
                        <select name="status_simpanan" value="<?= $data['status_simpanan']; ?>" class="form-control" id="exampleSelectstatu_simpanan">
                          <option selected value="<?= $data['status_simpanan']; ?>"><?= $data['status_simpanan']; ?></option>
                          <option value="TELAH DEPOSIT">TELAH DEPOSIT</option>
                          <option value="BELUM DEPOSIT">BELUM DEPOSIT</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>

<?= $this->endSection() ?>