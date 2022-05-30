<?= $this->extend('layout/dashboard') ?>

<?= $this->section('content') ?>

            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">My Profile</h4>
                  <form class="form-sample" method="POST" action="<?= base_url('dashboard/profile/update'); ?>" enctype="multipart/form-data">
                  <?= csrf_field() ?>
                    <p class="card-description">
                      Personal info 
                    </p>
                    <input class="form-control" placeholder="NIK" name="id" value="<?= $content['id']; ?>" hidden/>
                    <input class="form-control" placeholder="NIK" name="nik" value="<?= $content['nik']; ?>" hidden/>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                          <div class="col-sm-9">
                            <input type="text" name="name" class="form-control" value="<?= $content['name']; ?>"/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Username</label>
                          <div class="col-sm-9">
                            <input class="form-control" name="username" placeholder="Username" value="<?= $content['username']; ?>"/>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Gender</label>
                          <div class="col-sm-9">
                            <select name="gender" class="form-control">
                              <option selected value="<?= $content['gender']; ?>"><?= $content['gender']; ?></option>
                              <option value="laki-laki">Laki-laki</option>
                              <option value="perempuan">Perempuan</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Alamat</label>
                          <div class="col-sm-9">
                            <select name="alamat" class="form-control" id="exampleSelectGender">
                              <option selected value="<?= $content['alamat']; ?>"><?= $content['alamat']; ?></option>
                              <option value="Sarpaan RT 01/RW 01">Sarpaan RT 01/RW 01</option>
                              <option value="Sarpaan RT 02/RW 01">Sarpaan RT 02/RW 01</option>
                              <option value="Sarpaan RT 03/RW 01">Sarpaan RT 03/RW 01</option>
                              <option value="Tal Bantal RT 03/RW 01">Tal Bantal RT 03/RW 01</option>
                              <option value="Tal Bantal RT 02/RW 02">Tal Bantal RT 02/RW 02</option>
                              <option value="Tal Bantal RT 03/RW 02">Tal Bantal RT 03/RW 02</option>
                              <option value="Podak RT 01/RW 03">Podak RT 01/RW 03</option>
                              <option value="Podak RT 02/RW 03">Podak RT 02/RW 03</option>
                              <option value="Griya Mapan RT 01/RW 04">Griya Mapan RT 01/RW 04</option>
                              <option value="Griya Mapan RT 02/RW 04">Griya Mapan RT 02/RW 04</option>
                              <option value="Griya Mapan RT 03/RW 04">Griya Mapan RT 03/RW 04</option>
                              <option value="Griya Mapan RT 04/RW 04">Griya Mapan RT 04/RW 04</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">NIK</label>
                          <div class="col-sm-9">
                            <input class="form-control" placeholder="NIK" name="nik" value="<?= $content['nik']; ?>" disabled/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Foto Diri</label>
                          <div class="col-sm-9">
                          <?php if($content['foto_diri'] === NULL): ?>
                            <img data-enlargeable width="100" style="cursor: zoom-in" src="<?= base_url('images/default.png') ;?>" width="100px">
                          <?php elseif($content['foto_diri']): ?>
                            <img data-enlargeable width="100" style="cursor: zoom-in" src="<?= base_url('profile/'.$content['foto_diri']) ?>" width="100px">
                          <?php endif ?>
                            <input class="form-control" type="file" name="foto_diri" value="<?= $content['foto_diri'] ?>"/>
                          </div>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                  </form>
                </div>
              </div>
            </div>

<?= $this->endSection() ?>