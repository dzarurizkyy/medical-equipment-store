<!-- Container -->
<div class="container table-responsive my-3">
  <!-- Card -->
  <div class="w-100 px-1" style="overflow-x: auto; white-space: nowrap">
    <!-- Table -->
    <table class="table table-hover">
      <!-- Column Name -->
      <thead class="table-light text-center">
        <tr>
          <th>No</th>
          <th>ID</th>
          <th>Customer</th>
          <th>City</th>
          <th>Address</th>
          <th>Created</th>
          <th>View</th>
        </tr>
      </thead>
      <!-- Column Data -->
      <tbody>
        <?php foreach($data["history"] as $index => $history) : ?>
          <?php
            // To only get date from created_at
            $created_at = explode(" ", $history["created_at"]);
            $created_at = $created_at[0] 
          ?>
          <tr>
            <!-- No -->
            <td class="text-center" style="vertical-align: middle;"><?= ++$index ?></td>
            <!-- ID -->
            <td class="text-center" style="vertical-align: middle;"><?= $history["id"] ?></td>
            <!-- Customer -->
            <td style="vertical-align: middle;"><?= $history["customer"] ?></td>
            <!-- City -->
            <td class="text-center" style="vertical-align: middle;"><?= $history["city"] ?></td>
            <!-- Address -->
            <td style="vertical-align: middle;"><?= $history["address"] ?></td>
            <!-- Created -->
            <td class="text-center" style="vertical-align: middle;"><?= $created_at ?></td>
            <!-- View -->
            <td class="text-center" style="vertical-align: middle;">
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
      <div class="shadow" style="
        background-color: white;
        border-radius: 6px;
        padding: 20px;
        max-width: 540px;
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
        <div style="overflow-x: auto; white-space: nowrap">
          <!-- Table -->
          <table class="table table-bordered table-responsive">
            <!-- Column Title -->
            <thead>
              <th class="text-center">No</th>
              <th class="text-center">Product</th>
              <th class="text-center">Quantity</th>
              <th class="text-center">Total</th>
              <th class="text-center">Payment</th>
              <th class="text-center">Status</th> 
              <th class="text-center">Created</th> 
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
                  <td class="text-center"><?= ++$index ?></td>
                  <!-- Product -->
                  <td class="text-center"><?= $detail["product"] ?></td>
                  <!-- Quantity -->
                  <td class="text-center"><?= $detail["quantity"] ?></td>
                  <!-- Total -->
                  <td class="text-center">Rp<?= $detail["total"] ?></td>
                  <!-- Payment -->
                  <td class="text-center"><?= ucfirst($detail["payment"]) ?></td>
                  <!-- Status -->
                  <td class="text-center">
                    <span class="badge text-bg-<?= $detail["status"] === 'disetujui' ? 'success' : 'danger'?>" style="width: 78px;"><?= ucfirst($detail["status"]) ?></span>
                  </td>
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