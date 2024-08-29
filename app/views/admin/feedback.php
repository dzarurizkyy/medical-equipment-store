<!-- Container -->
<div class="container table-responsive my-3">
  <!-- Table -->
  <table class="table table-hover">
    <!-- Column Name -->
    <thead class="table-light">
      <tr style="text-align: center; line-height: 30px;">
        <th>No</th>
        <th>Customer</th>
        <th>Product</th>
        <th>Rating</th>
        <th>Message</th>
        <th>Created At</th>
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
          <td style="text-align: center"><?= ++$index ?></td>
          <!-- Customer -->
          <td><?= $feedback["customer"] ?></td>
          <!-- Product -->
          <td><?= $feedback["product"] ?></td>
          <!-- Rating -->
          <td style="text-align: center"><?= $feedback["rating"] ?></td>
          <!-- Message -->
          <td><?= $feedback["message"] ?></td>
          <!-- Created At -->
          <td style="text-align: center"><?= $feedback["created_at"] ?></td>
          <!-- Action -->
          <td style="text-align: center">
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