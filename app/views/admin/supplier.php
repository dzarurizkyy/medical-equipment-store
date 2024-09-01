<!-- Container -->
<div class="container table-responsive my-3">
  <!-- Add -->
  <div class="mb-4" style="float: right">
    <button type="button" class="btn d-flex justify-content-center gap-2" data-bs-toggle="modal" data-bs-target="#add" style="background-color: #29978C; color: #FFF">
      <div><i class="fa fa-plus"></i></div>
      <div class="fw-semibold">Add Supplier</div>
    </button>
  </div>
  <!-- Card -->
  <div class="w-100 px-1" style="overflow-x: auto; white-space: nowrap">
    <!-- Table -->
    <table class="table table-hover">
      <!-- Column Name -->
      <thead class="table-light">
        <tr class="text-center">
          <th>No</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone Number</th>
          <th>City</th>
          <th>Address</th>
          <th>Action</th>
        </tr>
      </thead>
      <!-- Column Data -->
      <tbody>
        <?php foreach($data["supplier"] as $index => $supplier) : ?>
          <tr>
            <!-- No -->
            <td class="text-center" style="vertical-align: middle;"><?= ++$index ?></td>
            <!-- Name -->
            <td style="vertical-align: middle;"><?= $supplier["name"] ?></td>
            <!-- Email -->
            <td style="vertical-align: middle;"><?= $supplier["email"] ?></td>
            <!-- Phone Number -->
            <td class="text-center" style="vertical-align: middle;"><?= $supplier["phone_number"] ?></td>
            <!-- City -->
            <td style="vertical-align: middle;"><?= $supplier["city"] ?></td>
            <!-- Address -->
            <td style="vertical-align: middle;"><?= $supplier["address"] ?></td>
            <!-- Action -->
            <td class="d-flex gap-2">
              <!-- Update -->
              <button type="button" class="btn" style="background-color: #29978C; color: #FFF;" data-bs-toggle="modal" data-bs-target="#update" data-id="<?= $supplier["id"]?>" data-name="<?= $supplier["name"]?>" data-email="<?= $supplier["email"]?>" data-phone="<?= $supplier["phone_number"]?>" data-city="<?= $supplier["city"]?>" data-address="<?= $supplier["address"]?>">
                <i class="fa fa-refresh"></i>
              </button>
              <!-- Delete -->
              <a href="<?= BASEURL ?>/admin/supplier/delete/<?= $supplier["id"] ?>" class="btn" style="background-color: #DC3545; color: #FFF;">
                <i class="fa fa-trash"></i>
              </a>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Add Modal -->
<div class="modal fade" tabindex="-1" id="add">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Header -->
      <div class="modal-header">
        <!-- Title -->
        <h4 class="modal-title fw-bold">Add Supplier</h5>
        <!-- Close -->
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!-- Form -->
      <form action="<?= BASEURL ?>/admin/supplier/add" method="post">
        <!-- Body -->
        <div class="modal-body">
          <!-- Name -->
          <div class="mb-3">
            <label for="name" class="form-label fw-semibold">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required />
          </div>
          <!-- Email -->
          <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required />
          </div>
          <!-- Phone Number -->
          <div class="mb-3">
            <label for="phone" class="form-label fw-semibold">Phone Number</label>
            <input type="number" class="form-control" id="phone" name="phone" placeholder="Enter phone number" required />
          </div>
          <!-- City -->
          <div class="mb-3">
            <label for="city" class="form-label fw-semibold">City</label>
            <select class="form-select" id="city" name="city" required>
              <option value="Jakarta">Jakarta</option>
              <option value="Yogyakarta">Yogyakarta</option>
              <option value="Surabaya">Surabaya</option>
              <option value="Bali">Bali</option>
            </select>
          </div>
          <!-- Address -->
          <div class="mb-3">
            <label for="address" class="form-label fw-semibold">Address</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Enter address" required>
          </div>
        </div>
        <!-- Footer -->
        <div class="modal-footer">
          <!-- Close -->
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <!-- Submit -->
          <button type="submit" class="btn" style="background-color: #29978C; color: #FFF;">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Update Modal -->
<div class="modal fade" tabindex="-1" id="update">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Header -->
      <div class="modal-header">
        <!-- Title -->
        <h4 class="modal-title">Update Supplier</h5>
        <!-- Close -->
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!-- Form -->
      <form action="<?= BASEURL ?>/admin/supplier/update" method="post">
        <!-- Body -->
        <div class="modal-body">
          <!-- ID -->
          <input type="hidden" class="form-control" id="id" name="id" />
          <!-- Name -->
          <div class="mb-3">
            <label for="name" class="form-label fw-semibold">Name</label>
            <input type="text" class="form-control" id="name" name="name" />
          </div>
          <!-- Email -->
          <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Email</label>
            <input type="email" class="form-control" id="email" name="email">
          </div>
          <!-- Phone Number -->
          <div class="mb-3">
            <label for="phone" class="form-label fw-semibold">Phone Number</label>
            <input type="number" class="form-control" id="phone" name="phone" />
          </div>
          <!-- City -->
          <div class="mb-3">
            <label for="city" class="form-label fw-semibold">City</label>
            <select class="form-select" id="city" name="city">
              <option value="Jakarta">Jakarta</option>
              <option value="Yogyakarta">Yogyakarta</option>
              <option value="Surabaya">Surabaya</option>
              <option value="Bali">Bali</option>
            </select>
          </div>
          <!-- Address -->
          <div class="mb-3">
            <label for="address" class="form-label fw-semibold">Address</label>
            <input type="text" class="form-control" id="address" name="address" />
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn" style="background-color: #29978C; color: #FFF;">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Jquery -->
<script src="<?= BASEURL ?>/js/jquery-3.7.1.min.js"></script>

<!-- Update (AJAX) -->
<script>
  $("#update").on("show.bs.modal", function (event) {
    var button      = $(event.relatedTarget)
    var id          = button.data("id")
    var name        = button.data("name")
    var email       = button.data("email")
    var phone       = button.data("phone")
    var city        = button.data("city")
    var address     = button.data("address")
    var modal       = $(this)

    modal.find('.modal-body #id').val(id)
    modal.find('.modal-body #name').val(name)
    modal.find('.modal-body #email').val(email)
    modal.find('.modal-body #phone').val(phone)
    modal.find('.modal-body #city').val(city)
    modal.find('.modal-body #address').val(address)
  })
</script>