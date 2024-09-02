<!-- Navbar -->
<nav class="navbar navbar-expand-lg p-2 mb-5" style="background-color: #29978C;">
  <!-- Container -->
  <div class="container">
    <!-- Image -->
    <a class="navbar-brand text-light" href="<?= BASEURL ?>">
      <img src="<?= BASEURL ?>/img/assets/Navbar.png" width="38"/>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Menu -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <!-- Home -->
        <li class="nav-item">
          <a class="nav-link active fw-semibold text-light" href="<?= BASEURL ?>">Home</a>
        </li>
        <!-- Status -->
        <li class="nav-item ">
          <a class="nav-link fw-semibold text-light" href="<?= BASEURL ?>/home/status">Status</a>
        </li>
        <!-- Profile -->
        <li class="nav-item d-lg-none d-block">
          <a class="nav-link fw-semibold text-light" href="<?= BASEURL ?>/home/profile">Profile</a>
        </li>
        <!-- Cart -->
        <li class="nav-item d-lg-none d-block">
          <a class="nav-link fw-semibold text-light" href="<?= BASEURL ?>/home/cart">Cart</a>
        </li>
      </ul>
      <div class="d-lg-flex d-none flex-row gap-3 align-items-center">
        <!-- Person -->
        <a href="<?= BASEURL ?>/home/profile" class="mt-2">
          <!-- Icon -->
          <i class="fa fa-user-circle" style="color: #FFF; font-size: 22px;"></i>
        </a>
        <!-- Cart -->
        <a class="navbar-text fw-semibold text-decoration-none text-light fs-4" href="<?= BASEURL ?>/home/cart">
          <!-- Icon -->
          <i class="fa fa-shopping-cart position-relative">
            <!-- Badge -->
            <?php if(Home::totalCart($_SESSION["user_id"]) !== 0) :?>
              <div class="badge rounded-pill bg-danger position-absolute top-0 start-100 translate-middle" style="font-size: 10px;">
                <?= Home::totalCart($_SESSION["user_id"]) ?>
              </div>
            <?php endif; ?>
          </i>
        </a>
      </div>
    </div>
  </div>
</nav>
