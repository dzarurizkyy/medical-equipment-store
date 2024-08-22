<!-- Container -->
<div style="background-image: url('<?= BASEURL ?>/img/assets/Background.jpg'); background-repeat: no-repeat;  background-size: cover; background-attachment: fixed; height: 100vh;">
  <!-- Card -->
  <div class="container d-flex align-items-center justify-content-center flex-column p-4 h-100">
    <!-- Auth -->
    <div class="row col-lg-6 col-12">
      <div class="card text-center p-3 shadow rounded-4 bg-light">
        <!-- Header -->
        <div class="d-flex justify-content-center align-items-center gap-3 mt-2 mb-3">
          <!-- Image -->
          <div>
            <img src="<?= BASEURL ?>/img/Assets/Logo.png" width="84" />
          </div>
          <!-- Title -->
          <div class="fw-bold fs-5 text-secondary text-opacity-75 lh-2">
            <div>Selamat datang di Toko Alat Kesehatan</div>
          </div>
        </div>
        <!-- Form -->
        <form action="<?= BASEURL ?>/<?= $data["controller"]?>" method="post">
          <div class="card-body d-flex flex-column gap-1">
            <!-- Username -->
            <div class="input-group mb-2">
              <span class="input-group-text"><i class="fa fa-user"></i></span>
              <input type="text" class="form-control p-2" placeholder="Username" name="username" id="username" required />
            </div>
            <!-- Password -->
            <div class="input-group mb-2">
              <span class="input-group-text"><i class="fa fa-lock" style="font-size: 18px;"></i></span>
              <input type="password" class="form-control p-2" placeholder="Password" name="password" id="password" required />
            </div>
            <!-- Alternative Links -->
            <div class="d-flex flex-column justify-content-center mt-2 gap-2">
              <?= Auth::register() ?>
            </div>
            <!-- Button -->
            <div class="d-flex justify-content-center align-items-center gap-2">
              <button type="submit" class="btn btn-primary fw-bold p-2" style="background-color: #29978C; border: none; width: 180px; height: 42px;">
                Login
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <!-- CTA -->
    <div><?= Auth::CTA() ?></div>
  </div>
</div>
