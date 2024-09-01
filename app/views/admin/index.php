<!-- Container -->
<div class="container d-flex table-responsive my-3">
  <!-- Card -->
  <div class="w-100 px-1" style="overflow-x: auto; white-space: nowrap">
    <!-- Table -->
    <table class="table table-hover">
      <!-- Column Name -->
      <thead class="table-light">
        <tr class="text-center">
          <th>No</th>
          <th>ID</th>
          <th>Customer</th>
          <th>City</th>
          <th>Address</th>
          <th>Created</th>
          <th>Action</th>
        </tr>
      </thead>
      <!-- Column Data -->
      <tbody>
        <?php foreach($data["orders"] as $index => $orders) : ?>
          <?php 
            // To only get date from created_at
            $created_at = explode(" ", $orders["created_at"]);
            $created_at = ($created_at)[0];
          ?>
          <tr>
            <!-- No -->
            <td class="text-center" style="vertical-align: middle;"><?= ++$index ?></td>
            <!-- ID -->
            <td class="text-center" style="vertical-align: middle;"><?= $orders["id"] ?></td>
            <!-- Customer -->
            <td style="vertical-align: middle;"><?= $orders["username"] ?></td>
            <!-- City -->
            <td class="text-center" style="vertical-align: middle;"><?= $orders["city"] ?></td>
            <!-- Address -->
            <td style="vertical-align: middle;"><?= $orders["address"] ?></td>
            <!-- Created -->
            <td class="text-center" style="vertical-align: middle;"><?= $created_at ?></td>
            <!-- Action -->
            <td class="d-flex gap-2 justify-content-center" style="vertical-align: middle;">
              <!-- View -->
              <a href="<?= BASEURL ?>/admin/index/view/<?= $orders["id"] ?>" class="btn btn-primary">
                <i class="fa fa-eye" ></i>
              </a>
              <!-- Accept -->
              <a href="<?= BASEURL ?>/admin/index/accept/<?= $orders["id"] ?>" class="btn" style="background-color: #29968B; color: #FFF">
                <i class="fa fa fa-check" ></i>
              </a>
              <!-- Decline -->
              <a href="<?= BASEURL ?>/admin/index/decline/<?= $orders["id"] ?>" class="btn" style="background-color: #DC3545; color: #FFF" onclick="return confirm('Are you sure want to decline this order?')">
                <i class="fa fa-close" ></i>
              </a>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Modal -->
<?php if(isset($data["order"])) : ?>
  <!-- Container -->
  <div style="
    position: fixed; 
    top: 0; 
    left: 0;
    width: 100%; 
    height: 100%;
    padding: 20px; 
    background: rgba(0, 0, 0, 0.5); 
    display: flex;
    align-items: center; 
    justify-content: center; 
    z-index: 1;">
      <!-- Card -->
      <div style="
        background-color: white;
        border-radius: 6px;
        padding: 20px;
        max-width: 500px;
        width: 100%;">
          <!-- Header -->
          <div class="d-flex justify-content-between align-items-center">
            <!-- Title -->
            <div class="fw-bold fs-5">Detail Order</div>
            <!-- Close -->
            <a href="<?= BASEURL ?>/admin" style="color: #D3D3D3; font-size: 18px;">
              <i class="fa fa-close"></i>
            </a>
          </div>
          <hr class="pb-2" />
          <!-- Body -->
          <div style="overflow-x: auto; white-space: nowrap">
            <!-- Table -->
            <table class="table table-bordered table-responsive">
              <!-- Column Title -->
              <thead>
                <tr class="text-center">
                  <th>No</th>
                  <th>Name</th>
                  <th>Quantity</th>
                  <th>Total</th>
                  <th>Payment</th>
                  <th>Created</th>
                </tr>
              </thead>
              <!-- Column Name -->
              <tbody>
                <?php foreach($data["order"] as $index => $order) : ?>
                  <?php 
                    // To only get date from created_at
                    $created_at = explode(" ", $orders["created_at"]);
                    $created_at = ($created_at)[0];
                  ?>
                  <tr>
                    <!-- No -->
                    <td class="text-center"><?= ++$index ?></td>
                    <!-- Name -->
                    <td><?= $order["name"] ?></td>
                    <!-- Quantity -->
                    <td class="text-center"><?= $order["quantity"] ?></td>
                    <!-- Total -->
                    <td class="text-center">Rp<?= $order["total"] ?></td>
                    <!-- Payment -->
                    <td class="text-center"><?= ucfirst($order["payment"]) ?></td>
                    <!-- Created -->
                    <td class="text-center"><?= $created_at ?></td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
      </div>
  </div>
<?php endif ?>
