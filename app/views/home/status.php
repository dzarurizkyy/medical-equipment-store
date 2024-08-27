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
          <!-- Status -->
          <div class="badge text-decoration-none px-2" style="color:<?= $product["status"] !== 'dibatalkan' ? '#58913b' : '#e05260'?>; background-color:<?= $product["status"] !== 'dibatalkan' ? '#d2f9c8;' : '#f6cbcf'?>" >
            <?= ucfirst($product["status"]) ?>
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
          <?php if($product["status"] != "dibatalkan" && $product["status"] != "disetujui") : ?>
            <div>
              <a href="<?= BASEURL ?>/home/status/cancel/<?= $product["id"] ?>" class="btn btn-danger px-4 py-1 fw-semibold" style="font-size: 14px;">
                Cancel
              </a>
            </div>
          <?php endif; ?>
          <!-- Feedback -->
          <?php if($product["status"] === "disetujui" && Home::existFeedback($product["id"]) !== 1) : ?>
            <div>
              <button type="button" class="btn text-light" data-bs-toggle="modal" data-bs-target="#feedback" class="btn btn-success" style="font-size: 14px; padding: 5px 14px; font-weight: 600; background-color: #29978C;" data-id="<?= $product["id"] ?>">
                Feedback
              </button>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  <?php endforeach ?>
</div>

<!-- Modal -->
<div class="modal fade" id="feedback" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Header -->
      <div class="modal-header">
        <!-- Title -->
        <h1 class="modal-title fs-5" id="exampleModalLabel">Feedback</h1>
        <!-- Close -->
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!-- Form -->
      <form action="<?= BASEURL ?>/home/feedback" method="post">
        <!-- Body -->
        <div class="modal-body">
          <!-- Order ID -->
          <input type="hidden" name="order_id" id="order_id" />
          <!-- Rating -->
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Rating</label>
            <input type="number" class="form-control" id="rating" name="rating" placeholder="Please give rating from 1 to 5" required />
          </div>
          <!-- Message -->
          <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea class="form-control" placeholder="Leave a message here" id="message" name="message" required></textarea>
          </div>
        </div>
        <!-- Footer -->
        <div class="modal-footer">
          <!-- Close -->
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <!-- Submit -->
          <button type="submit" class="btn text-light" style="background-color: #29978C; border: none">
            Submit
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  // This script listens for the 'show.bs.modal' event on the '#feedback' modal.
  $('#feedback').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var order_id = button.data('id') 
    var modal = $(this)
    // Set the value of the '#order_id' input field to the order_id
    modal.find('.modal-body #order_id').val(order_id)
  })
</script>
