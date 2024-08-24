<!-- Container -->
<div class="container d-flex flex-column gap-4">
  <!-- Title -->
  <div class="d-flex flex-row gap-2 align-items-center">
    <!-- Back to homepage -->
    <a href="<?= BASEURL ?>/home" class="text-decoration-none text-black pe-1">
      <i class="	fa fa-arrow-left" style="font-size: 18px;"></i>
    </a>
    <!-- Title -->
    <div class="fw-bold" style="font-size: 18px; color: #21259">
      Detail Product
    </div>
  </div>
  <!-- Card -->
  <div class="card mb-3" style="max-width: 38rem;">
    <div class="row g-0">
      <!-- Image -->
      <div class="col-md-4 p-3">
        <img src="<?= BASEURL ?>/img/products/<?= $data["product"]["image"]?>.jpg" class="img-fluid rounded-start" alt="...">
      </div>
      <!-- Content -->
      <div class="col-md-8 d-flex align-items-center">
        <div class="card-body">
          <!-- Description -->
          <div>
            <!-- Category -->
            <div class="text-secondary fw-normal mb-2" style="font-size: 12px;"><?= $data["product"]["category"]?></div>
            <!-- Name -->
            <h4 class="card-title fw-bold"><?= $data["product"]["name"] ?></h5>
            <!-- Description -->
            <p class="mt-2"><?= $data["product"]["description"] ?>.</p> 
          </div>
          <hr />
          <!-- Actions -->
          <div class="card-text d-flex justify-content-between align-items-center ">
            <!-- Supplier -->
            <div>
              <small class="text-body-secondary">Supplier : <?= $data["product"]["supplier"]?></small>
            </div>
            <div>
              <!-- Price -->
              <div class="badge rounded-pill text-bg-danger">Price : Rp<?= $data["product"]["price"]?></div>
              <!-- Stock -->
              <div class="badge rounded-pill text-bg-primary">Stock : <?= $data["product"]["stock"]?></div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>