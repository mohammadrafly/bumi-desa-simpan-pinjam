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
                      <label for="exampleInputPassword4">Password</label>
                      <input type="password" name="password" class="form-control" id="exampleInputPassword4" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword4">Nomor HP</label>
                      <input type="number" name="phone" class="form-control" id="exampleInputPassword4" placeholder="Nomor HP">
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
                      <label for="exampleSelectGender">Alamat</label>
                        <select name="alamat" class="form-control" id="exampleSelectGender">
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
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>

<?= $this->endSection() ?>