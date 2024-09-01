<!-- Container -->
<div class="container d-flex table-responsive my-3">
    <div class="w-100 px-3" style="overflow-x: auto;">
      <!-- Table -->
      <table class="table table-hover">
        <!-- Column Name -->
        <thead class="table-light">
          <tr>
            <th style="text-align: center;">No</th>
            <th style="text-align: center;">ID</th>
            <th style="text-align: center;">Customer</th>
            <th style="text-align: center;">City</th>
            <th style="text-align: center;">Address</th>
            <th style="text-align: center;">Created At</th>
            <th style="text-align: center;">Action</th>
          </tr>
        </thead>
        <!-- Column Data -->
        <tbody>
          <?php foreach($data["orders"] as $index => $orders) : ?>
            <?php 
              $created_at = explode(" ", $orders["created_at"]);
              $created_at = ($created_at)[0];
            ?>
            <tr>
              <!-- No -->
              <td><?= ++$index ?></td>
              <!-- ID -->
              <td><?= $orders["id"] ?></td>
              <!-- Customer -->
              <td><?= $orders["username"] ?></td>
              <!-- City -->
              <td style="text-align: center;"><?= $orders["city"] ?></td>
              <!-- Address -->
              <td><?= $orders["address"] ?></td>
              <!-- Created At -->
              <td style="text-align: center;"><?= $created_at ?></td>
              <!-- Action -->
              <td class="d-flex gap-2 justify-content-center">
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
</div>

<!-- Modal -->
<?php if(isset($data["order"])) : ?>
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
          <div style="overflow-x: auto;">
            <!-- Table -->
            <table class="table table-bordered table-responsive">
              <!-- Column Title -->
              <thead>
                <tr>
                  <th style="text-align: center">Name</th>
                  <th style="text-align: center">Quantity</th>
                  <th style="text-align: center">Total</th>
                  <th style="text-align: center">Payment</th>
                  <th style="text-align: center">Created At</th>
                </tr>
              </thead>
              <!-- Column Name -->
              <tbody>
                <?php foreach($data["order"] as $order) : ?>
                  <?php 
                    $created_at = explode(" ", $orders["created_at"]);
                    $created_at = ($created_at)[0];
                  ?>
                  <tr>
                    <!-- Name -->
                    <td><?= $order["name"] ?></td>
                    <!-- Quantity -->
                    <td style="text-align: center"><?= $order["quantity"] ?></td>
                    <!-- Total -->
                    <td style="text-align: center">Rp<?= $order["total"] ?></td>
                    <!-- Payment -->
                    <td style="text-align: center"><?= ucfirst($order["payment"]) ?></td>
                    <!-- Created At -->
                    <td style="text-align: center"><?= $created_at ?></td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
      </div>
  </div>
<?php endif ?>
