<?= $this->extend('layout/auth') ?>

<?= $this->section('content') ?>


              <form class="pt-3" method="POST" action="<?= base_url('login'); ?>">
              <?= csrf_field() ?>
                <div class="form-group">
                  <input type="text" name="username" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Masuk</button>
                </div>
                <!-- 
                <div class="mt-3">
                  <h6 class="fw-light">Belum punya Akun?<a href="<?= base_url('register') ?>">Daftar</a></h6>
                </div>     
              </form>
             -->

<?= $this->endSection() ?>