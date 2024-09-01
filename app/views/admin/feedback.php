<!-- Container -->
<div class="container table-responsive my-3">
  <!-- Card -->
  <div class="w-100 px-1" style="overflow-x: auto; white-space: nowrap">
    <!-- Table -->
    <table class="table table-hover">
      <!-- Column Name -->
      <thead class="table-light">
        <tr class="text-center">
          <th>No</th>
          <th>Customer</th>
          <th>Product</th>
          <th>Rating</th>
          <th>Message</th>
          <th>Created</th>
          <th>Action</th>
        </tr>
      </thead>
      <!-- Column Data -->
      <tbody>
        <?php foreach($data["feedback"] as $index => $feedback) : ?>
          <?php 
            // To only get date from created_at
            $feedback["created_at"] = explode(" ", $feedback["created_at"]);  
            $feedback["created_at"] = $feedback["created_at"][0];
          ?>
          <tr>
            <!-- No -->
            <td class="text-center" style="vertical-align: middle;"><?= ++$index ?></td>
            <!-- Customer -->
            <td style="vertical-align: middle;"><?= $feedback["customer"] ?></td>
            <!-- Product -->
            <td style="vertical-align: middle;"><?= $feedback["product"] ?></td>
            <!-- Rating -->
            <td style="text-align: center; vertical-align: middle;"><?= $feedback["rating"] ?></td>
            <!-- Message -->
            <td style="vertical-align: middle;"><?= $feedback["message"] ?></td>
            <!-- Created At -->
            <td style="text-align: center; vertical-align: middle;"><?= $feedback["created_at"] ?></td>
            <!-- Action -->
            <td class="text-center">
              <!-- Delete -->
              <a href="<?= BASEURL ?>/admin/feedback/delete/<?= $feedback["id"] ?>" class="btn" style="background-color: #DC3545; color: #FFF;">
                <i class="fa fa-trash"></i>
              </a>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>