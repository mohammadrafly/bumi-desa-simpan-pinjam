<?= $this->extend('layout/dashboard') ?>

<?= $this->section('content') ?>

            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><?= $pages; ?></h4>
                  <?php if (!empty(session()->getFlashdata('error'))) : ?>
                      <div class="alert alert-warning alert-dismissible fade show" role="alert">
                          <?php echo session()->getFlashdata('error'); ?>
                      </div>
                  <?php endif; ?>
                  <?php if (!empty(session()->getFlashdata('success'))) : ?>
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                          <?php echo session()->getFlashdata('success'); ?>
                      </div>
                  <?php endif; ?>
                  <form class="forms-sample" method="POST" action="<?= base_url('dashboard/my/permohonan/u/'.$id.'/new/store'); ?>">
                  <?= csrf_field() ?>
                    <div class="form-group">
                      <label for="exampleSelectGender">NIK</label>
                        <select name="nik" class="form-control" id="exampleSelectGender">
                          <option value="<?= $id ;?>"><?= $id ;?> -> <?= $content['name'] ;?> </option>
                        </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Judul Permohonan</label>
                      <input type="text" name="judul_permohonan" class="form-control" id="exampleInputName1" placeholder="Judul Permohonan">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Nominal</label>
                      <input type="number" name="nominal_permohonan" class="form-control" id="exampleInputName1" placeholder="Nominal">
                    </div>
                    <div class="form-group">
                      <label for="exampleSelectGender">Jenis Permohonan</label>
                        <select name="jenis_permohonan" class="form-control" id="exampleSelectGender">
                          <option value="SIMPAN">SIMPAN</option>
                          <option value="PINJAM">PINJAM</option>
                          <option value="PENARIKAN">PENARIKAN</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>

<?= $this->endSection() ?>