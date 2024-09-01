<!-- Container -->
<div class="container d-flex table-responsive my-3">
  <!-- Card -->
  <div class="w-100 px-3" style="overflow-x: auto">
    <!-- Table -->
    <table class="table table-hover">
      <!-- Column Name -->
      <thead class="table-light">
        <tr>
          <th style="text-align: center">No</th>
          <th style="text-align: center">ID</th>
          <th style="text-align: center">Customer</th>
          <th style="text-align: center">City</th>
          <th style="text-align: center">Address</th>
          <th style="text-align: center">Created</th>
          <th style="text-align: center">View</th>
        </tr>
      </thead>
      <!-- Column Data -->
      <tbody>
        <?php foreach($data["history"] as $index => $history) : ?>
          <?php
            $created_at = explode(" ", $history["created_at"]);
            $created_at = $created_at[0] 
          ?>
          <tr>
            <!-- No -->
            <td style="text-align: center"><?= ++$index ?></td>
            <!-- ID -->
            <td style="text-align: center"><?= $history["id"] ?></td>
            <!-- Customer -->
            <td><?= $history["customer"] ?></td>
            <!-- City -->
            <td style="text-align: center"><?= $history["city"] ?></td>
            <!-- Address -->
            <td><?= $history["address"] ?></td>
            <!-- Created -->
            <td style="text-align: center"><?= $created_at ?></td>
            <!-- View -->
            <td style="text-align: center">
              <a href="<?= BASEURL ?>/admin/history/view/<?= $history["id"]?>" class="btn btn-primary">
                <i class="fa fa-eye"></i>
              </a>
            </td>
          </tr>
        <?php endforeach?>
      </tbody>
    </table>
  </div>
</div>

<!-- Modal -->
<?php if(isset($data["detail"])) : ?>
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
    z-index: 1">
      <!-- Card -->
      <div style="
        background-color: white;
        border-radius: 6px;
        padding: 20px;
        max-width: 700px;
        width: 100%;">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center">
          <!-- Title -->
          <div class="fw-bold fs-5">Detail Order</div>
          <!-- Close -->
          <a href="<?= BASEURL ?>/admin/history" style="color: #D3D3D3; font-size: 18px">
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
              <th style="text-align: center">No</th>
              <th style="text-align: center">Product</th>
              <th style="text-align: center">Quantity</th>
              <th style="text-align: center">Total</th>
              <th style="text-align: center">Payment</th>
              <th style="text-align: center">Status</th> 
              <th style="text-align: center">Created</th> 
            </thead>
            <!-- Column Data -->
            <tbody>
              <?php foreach($data["detail"] as $index => $detail) : ?>
                <?php
                  $created_at = explode(" ", $detail["created_at"]);
                  $created_at = $created_at[0] 
                ?>
                <tr>
                  <!-- No -->
                  <td style="text-align: center"><?= ++$index ?></td>
                  <!-- Product -->
                  <td style="text-align: center"><?= $detail["product"] ?></td>
                  <!-- Quantity -->
                  <td style="text-align: center"><?= $detail["quantity"] ?></td>
                  <!-- Total -->
                  <td style="text-align: center">Rp<?= $detail["total"] ?></td>
                  <!-- Payment -->
                  <td style="text-align: center"><?= ucfirst($detail["payment"]) ?></td>
                  <!-- Status -->
                  <td style="text-align: center">
                    <span class="badge text-bg-<?= $detail["status"] === 'disetujui' ? 'success' : 'danger'?>" style="width: 78px;"><?= ucfirst($detail["status"]) ?></span>
                  </td>
                  <!-- Created -->
                  <td style="text-align: center"><?= $created_at ?></td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
  </div>
<?php endif ?>