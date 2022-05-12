<?= $this->extend('layout/dashboard') ?>

<?= $this->section('content') ?>

            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">My Profile</h4>
                  <form class="form-sample" method="POST" action="<?= base_url('dashboard/profile/update'); ?>">
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
                          <label class="col-sm-3 col-form-label">Email</label>
                          <div class="col-sm-9">
                            <input class="form-control" placeholder="email" name="email" value="<?= $content['email']; ?>"/>
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
                          <label class="col-sm-3 col-form-label">Alamat</label>
                          <div class="col-sm-9">
                            <input class="form-control" placeholder="alamat" name="alamat" value="<?= $content['alamat']; ?>"/>
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