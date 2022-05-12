<?= $this->extend('layout/dashboard') ?>

<?= $this->section('content') ?>

            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><?= $pages; ?></h4>
                  <form class="forms-sample" method="POST" action="<?= base_url('dashboard/pengguna/store'); ?>">
                  <?= csrf_field() ?>
                    <div class="form-group">
                      <label for="exampleInputName1">Nama</label>
                      <input type="text" name="name" class="form-control" id="exampleInputName1" placeholder="Nama">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Username</label>
                      <input type="text" name="username" class="form-control" id="exampleInputName1" placeholder="Username">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Email address</label>
                      <input type="email" name="email" class="form-control" id="exampleInputEmail3" placeholder="Email">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword4">Password</label>
                      <input type="password" name="password" class="form-control" id="exampleInputPassword4" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">NIK</label>
                      <input type="text" name="nik" class="form-control" id="exampleInputName1" placeholder="NIK">
                    </div>
                    <div class="form-group">
                      <label for="exampleSelectGender">Gender</label>
                        <select name="gender" class="form-control" id="exampleSelectGender">
                          <option value="laki-laki">Laki-Laki</option>
                          <option value="perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleSelectGender">Role</label>
                        <select name="role" class="form-control" id="exampleSelectGender">
                          <option value="admin">Admin</option>
                          <option value="superadmin">Superadmin</option>
                          <option value="customer">Customer</option>
                        </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleTextarea1">Alamat</label>
                      <textarea name="alamat" class="form-control" id="exampleTextarea1" rows="4"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>

<?= $this->endSection() ?>