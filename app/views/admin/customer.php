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
          <th>Username</th>
          <th>Email</th>
          <th>Birth</th>
          <th>Gender</th>
          <th>City</th>
          <th>Phone Number</th>
          <th>Action</th>
        </tr>
      </thead>
      <!-- Column Data -->
      <tbody >
        <?php foreach($data["customer"] as $index => $customer) : ?>
          <tr>
            <!-- No -->
            <td class="text-center" style="vertical-align: middle;"><?= ++$index ?></td>
            <!-- Username -->
            <td style="vertical-align: middle;"><?= $customer["username"] ?></td>
            <!-- Email -->
            <td style="vertical-align: middle;"><?= $customer["email"] ?></td>
            <!-- Birthdate -->
            <td class="text-center" style="vertical-align: middle;"><?= $customer["birth"] ?></td>
            <!-- Gender -->
            <td class="text-center" style="vertical-align: middle;"><?= ucfirst($customer["gender"]) ?></td>
            <!-- City -->
            <td class="text-center" style="vertical-align: middle;"><?= $customer["city"] ?></td>
            <!-- Phone Number -->
            <td class="text-center" style="vertical-align: middle;"><?= $customer["phone_number"] ?></td>
            <!-- Action -->
            <td class="d-flex gap-2 justify-content-center">
              <!-- Update -->
              <button type="button" class="btn" style="background-color: #29978C; color: #FFF;" data-bs-toggle="modal" data-bs-target="#edit" data-id="<?= $customer["id"] ?>" data-username="<?= $customer["username"] ?>" data-email="<?= $customer["email"] ?>" data-birth="<?= $customer["birth"] ?>" data-gender="<?= $customer["gender"] ?>" data-city="<?= $customer["city"] ?>" data-phone="<?= $customer["phone_number"] ?>" data-address="<?= $customer["address"]?>">
                <i class="fa fa-refresh"></i>
              </button>
              <!-- Reset -->
              <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#resetPassword" data-reset="<?= $customer["id"] ?>" >
                <i class="fa fa-lock"></i>
              </button>
              <!-- Delete -->
              <a href="<?= BASEURL ?>/admin/customer/delete/<?= $customer["id"] ?>" class="btn" style="background-color: #DC3545; color: #FFF;">
                <i class="fa fa-trash"></i>
              </a>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Update Modal -->
<div class="modal fade" id="edit" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Header -->
      <div class="modal-header">
        <!-- Title -->
        <h1 class="modal-title fs-4 fw-bold" id="exampleModalLabel">Edit Customer</h1>
        <!-- Close -->
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!-- Form -->
      <form action="<?= BASEURL ?>/admin/customer/update" method="post">
        <!-- Body -->
        <div class="modal-body">
          <!-- ID -->
          <input type="hidden" class="form-control" id="customer_id"  name="customer_id" />
          <!-- Username -->
          <div class="mb-3">
            <label for="username" class="form-label fw-semibold">Username</label>
            <input type="text" class="form-control" id="username" name="username" />
          </div>
          <!-- Email -->
          <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Email</label>
            <input type="email" class="form-control" id="email" name="email" />
          </div>
          <!-- Birthdate -->
          <div class="mb-3">
            <label for="birth" class="form-label fw-semibold">Birthdate</label>
            <input type="date" class="form-control" id="birth" name="birth" />
          </div>
          <!-- Gender -->
          <div class="mb-3">
            <label for="gender" class="form-label fw-semibold">Gender</label>
            <select class="form-select" id="gender" name="gender">
              <option value="male">Male</option>
              <option value="female">Female</option>
            </select>
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
          <!-- Phone Number -->
          <div class="mb-3">
            <label for="phone" class="form-label fw-semibold">Phone Number</label>
            <input type="number" class="form-control" id="phone" name="phone" />
          </div>
          <!-- Address -->
          <div class="mb-3">
            <label for="address" class="form-label fw-semibold">Address</label>
            <textarea class="form-control" id="address" name="address"></textarea>
          </div>
        </div>
        <!-- Footer -->
        <div class="modal-footer">
          <!-- Close -->
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <!-- Edit -->
          <button type="submit" class="btn px-3" style="background-color: #29978C; color: #FFF;">Edit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Reset Modal -->
<div class="modal fade" id="resetPassword" tabindex="-1"  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Header -->
      <div class="modal-header">
        <!-- Title -->
        <h1 class="modal-title fs-4 fw-bold">Change Password</h1>
        <!-- Close -->
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!-- Form -->
      <form action="<?= BASEURL ?>/admin/customer/reset" method="post">
        <!-- Body -->
        <div class="modal-body">
          <!-- ID -->
          <input type="hidden" class="form-control" id="resetId"  name="resetId" />
          <!-- Password -->
          <div class="mb-3">
            <label for="password" class="form-label fw-semibold">Password</label>
            <input type="text" class="form-control" id="password" name="password" placeholder="Enter your new password" />
          </div>
        </div>
        <!-- Footer -->
        <div class="modal-footer">
          <!-- Close -->
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <!-- Submit -->
          <button type="submit" class="btn" style="background-color: #29978C; color: #FFF">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Jquery  -->
<script src="<?= BASEURL ?>/js/jquery-3.7.1.min.js"></script>

<!-- Reset (AJAX) -->
<script>
  $('#resetPassword').on('show.bs.modal', function (event) {
    var button      = $(event.relatedTarget) 
    var resetId = button.data('reset')
    var modal       = $(this)

    modal.find('.modal-body #resetId').val(resetId)
  })
</script>

<!-- Update (AJAX) -->
<script>
  $('#edit').on('show.bs.modal', function (event) {
    var button      = $(event.relatedTarget) 
    var customer_id = button.data('id')
    var username    = button.data('username')  
    var email       = button.data('email')  
    var birth       = button.data('birth')  
    var gender      = button.data('gender')  
    var city        = button.data('city') 
    var phone       = button.data("phone") 
    var address     = button.data("address") 
    var modal       = $(this)

    modal.find('.modal-body #customer_id').val(customer_id)
    modal.find('.modal-body #username').val(username)
    modal.find('.modal-body #email').val(email)
    modal.find('.modal-body #birth').val(birth)
    modal.find('.modal-body #gender').val(gender)
    modal.find('.modal-body #city').val(city)
    modal.find('.modal-body #phone').val(phone)
    modal.find('.modal-body #address').val(address)
  })
</script>