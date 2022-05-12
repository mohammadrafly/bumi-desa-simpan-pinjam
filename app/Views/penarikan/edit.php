<?= $this->extend('layout/dashboard') ?>

<?= $this->section('content') ?>

            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><?= $pages; ?></h4>
                  <form class="forms-sample" method="POST" action="<?= base_url('dashboard/transaksi/penarikan/update'); ?>">
                  <?= csrf_field() ?>
                    <input type="text" hidden name="id_penarikan" class="form-control" id="exampleInputName1" value="<?= $data['id_penarikan']; ?>">
                    <div class="form-group">
                      <label for="exampleInputName1">Nominal</label>
                      <input type="text" name="nominal" class="form-control" id="exampleInputName1" placeholder="Nominal" value="<?= $data['nominal']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleSelectstatu_penarikan">Status penarikan</label>
                        <select name="status_penarikan" value="<?= $data['status_penarikan']; ?>" class="form-control" id="exampleSelectstatu_penarikan">
                          <option selected value="<?= $data['status_penarikan']; ?>"><?= $data['status_penarikan']; ?></option>
                          <option value="BELUM DIAMBIL">BELUM DIAMBIL</option>
                          <option value="TELAH DIAMBIL">TELAH DIAMBIL</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>

<?= $this->endSection() ?>