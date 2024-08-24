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
          <a class="nav-link active fw-semibold text-light" href="#">Home</a>
        </li>
        <!-- Status -->
        <li class="nav-item ">
          <a class="nav-link fw-semibold text-light" href="#">Status</a>
        </li>
      </ul>
      <!-- Cart -->
      <a class="navbar-text fw-semibold text-decoration-none text-light fs-4" href="#">
        <!-- Icon -->
        <i class="fa fa-shopping-cart position-relative">
          <!-- Badge -->
          <?php if(Home::cart($_SESSION["user_id"]) !== 0) :?>
            <div class="badge rounded-pill bg-danger position-absolute top-0 start-100 translate-middle" style="font-size: 10px;">
              <?= Home::cart($_SESSION["user_id"]) ?>
            </div>
          <?php endif; ?>
        </i>
      </a>
    </div>
  </div>
</nav>
