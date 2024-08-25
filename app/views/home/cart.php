<div>
  <!-- Cart -->
  <div class="container" style="margin-bottom: 100px;">
    <?php foreach($data["orders"] as $product) : ?>
      <?php
        // Convert string into date  
        $product["created_at"] = strtotime($product["created_at"]);
        $product["created_at"] = date("d M Y", $product["created_at"]);
        
        $data["total"] += $product["total"];
      ?>
  
      <!-- Card -->
      <div class="card mb-3" style="max-width: 100%;">
        <!-- Header -->
        <div class="card-header d-flex justify-content-between align-items-center">
          <!-- Left -->
          <div class="d-flex align-items-center gap-3">
            <!-- Icon -->
            <div>
              <i class="fa fa-shopping-bag" style="color: #29978C; font-size: 20px;"></i>
            </div>
            <!-- Date -->
            <div>
              <div class="fw-bold" style="font-size: 12px;">Shopping</div>
              <div style="font-size: 11px;"><?= $product["created_at"]?></div>
            </div>
          </div>
          <!-- Right -->
          <div>
            <!-- Category -->
            <div class="badge text-decoration-none px-2" style="background-color: #d7f4f1; color: #29978C">
              <?= $product["category"] ?>
            </div>
            <!-- Supplier -->
            <div class="badge text-decoration-none px-2" style="color: #928a33; background-color: #efedd2;">
              <?= $product["supplier"] ?>
            </div>
          </div>
        </div>
        <!-- Body -->
        <div class="row g-0 p-3">
          <!-- Image -->
          <div class="col-md-1 w-full d-flex justify-content-center">
            <img src="<?= BASEURL ?>/img/products/<?= $product["image"] ?>.jpg" class="img-fluid rounded-start" />
          </div>
          <!-- Description -->
          <div class="col-md-11">
            <div class="card-body">
              <!-- Title -->
              <div class="fw-bold fs-5"><?= $product["name"] ?></div>
              <!-- Quantity -->
              <div class="card-text"><small class="text-body-secondary"><?= $product["quantity"] ?> products</small></div>
            </div>
          </div>
          <!-- Action -->
          <div class="px-3 pt-2 d-flex justify-content-between align-items-center">
            <!-- Total -->
            <div>
              <div style="font-size: 12px;">Total Product</div>
              <div class="fw-bold" style="font-size: 16px;">Rp<?= $product["total"] ?></div>
            </div>
            <!-- Cancel -->
            <div>
              <a href="<?= BASEURL ?>/home/cart/cancel/<?= $product["id"] ?>" class="btn btn-danger px-4 py-1 fw-semibold" style="font-size: 14px;">
                Cancel
              </a>
            </div>
          </div>
        </div>
      </div>
  
    <?php endforeach ?>
  </div>
  <!-- Checkout -->
  <?php if(Home::totalCart($_SESSION["user_id"]) != 0 ) :  ?>
    <form action="<?= BASEURL?>/home/checkout" method="post" class="d-flex justify-content-between align-items-center px-4 py-3 position-fixed bottom-0 w-100" style="background-color: #29978C; color: #FFFFFF;">
      <!-- Payment -->
      <div class="d-flex gap-3">
        <!-- Cash -->
        <div class="form-check">
          <input class="form-check-input" type="radio" value="cash" id="cash" name="checkout" style="border-radius: 4px;" required />
          <label class="form-check-label" for="cash">
            Cash
          </label>
        </div>
        <!-- Debit -->
        <div class="form-check">
          <input class="form-check-input" type="radio" value="debit" id="debit" name="checkout" style="border-radius: 4px;" />
          <label class="form-check-label" for="debit">
            Debit
          </label>
        </div>
      </div>
      <!-- Button -->
      <div class="d-flex gap-3 align-items-center">
        <!-- Total -->
        <div class="d-flex flex-column text-end">
          <div style="font-size: 14px;">Total</div>
          <div class="fw-bold" style="font-size: 18px;">Rp<?= $data["total"] ?></div>
        </div>
        <!-- Submit -->
        <div>
          <button type="submit" class="btn fw-bold" style="background-color: #d1e8dc; color: #418366;">Checkout</button>
          </div>
      </div>
    </form>
  <?php endif ?>
</div>