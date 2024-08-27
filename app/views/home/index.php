<?php 
  // Count number of segments in URL to determine current page
  $page = count(explode("/", $_SERVER['REQUEST_URI']));

  // Extract category from URL for detail product page to add quantity
  if($page == 6) {
    $category = explode("/", $_SERVER['REQUEST_URI'])[5];
  }

  // Extract category from URL for detail product page with subcategory to add quantity
  if($page == 9) {
    $category = explode("/", $_SERVER['REQUEST_URI'])[6];
  } 
?>

<!-- Content -->
<div class="d-flex flex-column align-items-center gap-4 mb-3">
  <!-- Container -->
  <div class="container">    
    <div class="row">
      <!-- Product -->
      <div class="col-xl-8 col-12 d-flex flex-row flex-wrap justify-content-start gap-4">
        <?php foreach($data["products"] as $product) : ?>
          <!-- Card -->
          <div class="card p-1 product-card" style="height: <?= (isset($data["product_id"]) && (int)$data["product_id"] === $product["id"]) ? '22rem' : '18rem' ?>">
            <!-- Image -->
            <img src="<?= BASEURL ?>/img/products/<?= $product["image"]?>.jpg" class="card-img-top" />
            <!-- Actions -->
            <div class="card-body">
              <div class="d-flex flex-row gap-2">
                <!-- View -->
                <a href="<?= BASEURL ?>/home/detail/<?= $product["id"] ?>" class="btn w-50 fw-semibold text-white" style="background-color: #29978C;">
                  View
                </a>
                <!-- Buy -->
                <a href="<?= $page == 4 || $page == 7 ? BASEURL . '/home/index/cart/' : BASEURL . '/home/index/category/' . $category . '/cart/' ?><?= $product["id"] ?>" class="btn w-50 fw-semibold text-white" style="background-color: #29978C;">
                  Buy
                </a>
              </div>
            </div>
            <!-- Order -->
            <?php if(isset($data["product_id"]) && (int)$data["product_id"] === $product["id"] ) : ?>
              <form action="<?= BASEURL ?>/home/order/<?= $product["id"] ?>" method="post" class="row g-2" style="padding: 0 10% 0 4%;">
                <!-- Input -->
                <div class="col-md-9 col-11">
                  <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Quantity" />
                </div>
                <!-- Submit -->
                <div class="col-md-3 col-1">
                  <button type="submit" class="btn btn-primary mb-3" style="background-color: #e5fffa; border: 1px solid #29978C;">
                    <i class="fa fa-cart-plus" style="color: #29978C; font-size: 18px;"></i>
                  </button>
                </div>
              </form>
            <?php endif ?>
          </div>
        <?php endforeach ?>
      </div>
      <!-- Filter -->
      <div class="col-xl-4 card px-2 filter-card" style="width: 340px; border: none;">
        <!-- Title -->
        <div class="fw-semibold mb-1" style="font-size: 18px;">
          Filter
        </div>
        <!-- Category -->
        <div class="d-flex flex-column gap-2">
          <?php foreach($data["category"] as $category) : ?>
            <div class="d-flex align-items-center justify-content-between">
              <!-- Content -->
              <div class="d-flex align-items-center gap-2">
                <!-- Square -->
                <div class="d-flex justify-content-center align-items-center" style="width: 16px; height: 16px; background-color: #EBF4D7;">
                  <div style="width: 10px; height: 10px; background-color: #ACD156;"></div>
                </div>
                <!-- Title -->
                <div class="fw-semibold text-secondary" style="font-size: 15px;"><?= ucwords($category) ?></div>
              </div>
              <!-- Button -->
              <a href="<?= BASEURL ?>/home/category/<?= str_replace(" ", "-", $category) ?>" class="text-light d-flex p-1 justify-content-center align-items-center rounded-pill text-decoration-none" style="background-color: #ACD156; width: 30px; height: 18px;"> 
                <i class="fa fa-angle-right"></i>
              </a>
          </div>
          <?php endforeach?>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Pagination -->
<div class="d-flex flex-column align-items-center pagination-product pt-2">
  <?= Home::pagination($data); ?>
</div>