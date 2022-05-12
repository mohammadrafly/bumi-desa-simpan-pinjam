<?= $this->extend('layout/dashboard') ?>

<?= $this->section('content') ?>

            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><?= $pages; ?></h4>
                  <form class="forms-sample" method="POST" action="<?= base_url('dashboard/permohonan/update'); ?>">
                  <?= csrf_field() ?>
                    <input type="text" hidden name="id_permohonan" class="form-control" id="exampleInputName1" value="<?= $data['id_permohonan']; ?>">
                    <div class="form-group">
                      <label for="exampleInputName1">NIK</label>
                      <input type="text" name="name" class="form-control" id="exampleInputName1" placeholder="Nama" value="<?= $data['nik']; ?>" disabled>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Judul Permohonan</label>
                      <input type="text" name="judul_permohonan" class="form-control" id="exampleInputName1" placeholder="Judul Permohonan" value="<?= $data['judul_permohonan']; ?>" disabled>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Nominal</label>
                      <input type="number" name="nominal_permohonan" class="form-control" id="exampleInputName1" placeholder="Nominal" value="<?= $data['nominal_permohonan']; ?>" disabled>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Deskripsi</label>
                      <textarea type="text" name="deskripsi_permohonan" class="form-control" id="exampleInputName1" placeholder="Deskripsi" disabled><?= $data['deskripsi_permohonan']; ?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleSelectGender">Jenis Permohonan</label>
                        <select name="jenis_permohonan" class="form-control" id="exampleSelectGender" disabled>
                          <option selected value="<?= $data['jenis_permohonan']; ?>"><?= $data['jenis_permohonan']; ?></option>
                        </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleSelectGender">Status Permohonan</label>
                        <select name="status_permohonan" class="form-control" id="exampleSelectGender">
                          <option selected value="<?= $data['status_permohonan']; ?>"><?= $data['status_permohonan']; ?></option>
                          <option value="HOLD">HOLD</option>
                          <option value="DITERIMA">DITERIMA</option>
                          <option value="DITOLAK">DITOLAK</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>

<?= $this->endSection() ?>