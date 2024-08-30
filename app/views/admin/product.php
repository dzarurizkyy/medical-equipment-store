<!-- Container -->
<div class="container table-responsive my-3">
  <!-- Add -->
  <div class="mb-4" style="float: right;">
    <button type="button" class="btn d-flex justify-content-center gap-2" data-bs-toggle="modal" data-bs-target="#add" style="background-color: #29978C; color: #FFF;">
      <!-- Icon -->
      <div><i class="fa fa-plus"></i></div>
      <!-- Text -->
      <div class="fw-semibold">Add Product</div>
    </button>
  </div>
  <!-- Table -->
  <table class="table table-hover">
    <!-- Column Name -->
    <thead class="table-light">
      <tr style="text-align: center; line-height: 30px">
        <th>No</th>
        <th>Image</th>
        <th>Name</th>
        <th>Category</th>
        <th>Supplier</th>
        <th>Stock</th>
        <th>Price</th>
        <th>Action</th>
      </tr>
    </thead>
    <!-- Column Data -->
    <tbody>
      <?php foreach($data["product"] as $index => $product) : ?>
        <tr>
          <!-- No -->
          <td style="text-align: center"><?= ++$index ?></td>
          <!-- Image -->
          <td style="text-align: center">
            <img src="<?= BASEURL ?>/img/products/<?= $product["image"] ?>.jpg" width="100"/>
          </td>
          <!-- Name -->
          <td style="text-align: center"><?= $product["name"] ?></td>
          <!-- Category -->
          <td style="text-align: center"><?= $product["category"] ?></td>
          <!-- Supplier -->
          <td style="text-align: center"><?= $product["supplier_name"] ?></td>
          <!-- Stock -->
          <td style="text-align: center"><?= $product["stock"] ?></td>
          <!-- Price -->
          <td style="text-align: center">Rp<?= $product["price"] ?></td>
          <!-- Action -->
          <td>
            <div class="d-flex justify-content-center gap-2">
              <!-- Update -->
              <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#update" style="background-color: #29978C; color: #FFF;" data-id="<?= $product["id"]?>" data-image="<?= $product["image"]?>" data-name="<?= $product["name"]?>" data-description="<?= $product["description"]?>" data-category="<?= $product["category"]?>" data-supplier="<?= $product["supplier_id"]?>" data-stock="<?= $product["stock"]?>" data-price="<?= $product["price"]?>">
                <i class="fa fa-refresh"></i>
              </button>
              <!-- Delete -->
              <a href="<?= BASEURL ?>/admin/product/delete/<?= $product["id"] ?>" class="btn" style="background-color: #DC3545; color: #FFF;">
                <i class="fa fa-trash"></i>
              </a>
            </div>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>

<!-- Add Modal -->
<div class="modal fade" id="add" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Header -->
      <div class="modal-header">
        <h1 class="modal-title fs-5 fw-bold">Add Product</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!-- Form -->
      <form action="<?= BASEURL ?>/admin/product/add" method="post" enctype="multipart/form-data">
        <!-- Body -->
        <div class="modal-body">
          <!-- Name -->
          <div class="mb-3">
            <label for="name" class="form-label fw-semibold">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required />
          </div>
          <!-- Description -->
          <div class="mb-3">
            <label for="description" class="form-label fw-semibold">Description</label>
            <input type="text" class="form-control" id="description" name="description" placeholder="Enter description" required />
          </div>
          <!-- Category -->
          <div class="mb-3">
            <label for="category" class="form-label fw-semibold">Category</label>
            <input type="text" class="form-control" id="category" name="category" placeholder="Enter category" required />
          </div>
          <!-- Supplier -->
          <div class="mb-3">
            <label for="supplier" class="form-label fw-semibold">Supplier</label>
            <select class="form-select" id="supplier_id" name="supplier_id" required>
              <?php foreach(array_reverse($data["supplier"]) as $supplier) : ?>
                <option value="<?= $supplier["id"] ?>"><?= $supplier["id"]?> - <?= $supplier["name"] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <!-- Stock -->
          <div class="mb-3">
            <label for="stock" class="form-label fw-semibold">Stock</label>
            <input type="number" class="form-control" id="stock" name="stock" placeholder="Enter stock" required />
          </div>
          <!-- Price -->
          <div class="mb-3">
            <label for="price" class="form-label fw-semibold">Price</label>
            <input type="number" class="form-control" id="price" name="price" placeholder="Enter price" required />
          </div>
          <!-- Image -->
          <div class="mb-3">
            <label for="image" class="form-label fw-semibold">Image</label>
            <input type="file" class="form-control" id="image" name="image" required />
          </div>
        </div>
        <!-- Button -->
        <div class="modal-footer">
          <!-- Close -->
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <!-- Submit -->
          <button type="submit" class="btn" style="background-color: #29978C; border: none; color: #FFF;">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Update Modal -->
<div class="modal fade" id="update" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Header -->
      <div class="modal-header">
        <h1 class="modal-title fs-5 fw-bold">Update Product</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!-- Form -->
      <form action="<?= BASEURL ?>/admin/product/update" method="post" enctype="multipart/form-data">
        <!-- Body -->
        <div class="modal-body">
          <!-- ID -->
          <input type="hidden" class="form-control" id="id" name="id" />
          <!-- Name -->
          <div class="mb-3">
            <label for="name" class="form-label fw-semibold">Name</label>
            <input type="text" class="form-control" id="name" name="name" />
          </div>
          <!-- Description -->
          <div class="mb-3">
            <label for="description" class="form-label fw-semibold">Description</label>
            <input type="text" class="form-control" id="description" name="description" />
          </div>
          <!-- Category -->
          <div class="mb-3">
            <label for="category" class="form-label fw-semibold">Category</label>
            <input type="text" class="form-control" id="category" name="category" />
          </div>
          <!-- Supplier -->
          <div class="mb-3">
            <label for="supplier" class="form-label fw-semibold">Supplier</label>
            <select class="form-select" id="supplier_id" name="supplier_id">
              <?php foreach(array_reverse($data["supplier"]) as $supplier) : ?>
                <option value="<?= $supplier["id"] ?>"><?= $supplier["id"]?> - <?= $supplier["name"] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <!-- Stock -->
          <div class="mb-3">
            <label for="stock" class="form-label fw-semibold">Stock</label>
            <input type="number" class="form-control" id="stock" name="stock" />
          </div>
          <!-- Price -->
          <div class="mb-3">
            <label for="price" class="form-label fw-semibold">Price</label>
            <input type="number" class="form-control" id="price" name="price"  />
          </div>
           <!-- Image -->
           <div class="mb-3">
            <label for="image" class="form-label fw-semibold">Image</label>
            <input type="file" class="form-control" id="image" name="image"/>
            <input type="hidden" class="form-control" id="image_name" name="image_name" />
          </div>
        </div>
        <!-- Button -->
        <div class="modal-footer">
          <!-- Close -->
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <!-- Submit -->
          <button type="submit" class="btn" style="background-color: #29978C; border: none; color: #FFF;">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="<?= BASEURL ?>/js/jquery-3.7.1.min.js"></script>
<script>
  $("#update").on("show.bs.modal", function (event) {
    var button      = $(event.relatedTarget)

    var id          = button.data("id")
    var name        = button.data("name")
    var description = button.data("description")
    var category    = button.data("category")
    var supplierId  = button.data("supplier")
    var stock       = button.data("stock")
    var price       = button.data("price")
    var image       = button.data("image")

    var modal       = $(this)

    modal.find('.modal-body #id').val(id)
    modal.find('.modal-body #name').val(name)
    modal.find('.modal-body #description').val(description)
    modal.find('.modal-body #category').val(category)
    modal.find('.modal-body #supplier_id').val(supplierId)
    modal.find('.modal-body #stock').val(stock)
    modal.find('.modal-body #price').val(price)
    modal.find('.modal-body #image_name').val(image)
  })
</script>

