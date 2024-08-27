<!-- Container -->
<div style="background-image: url('<?= BASEURL ?>/img/assets/Background.png'); background-repeat: no-repeat;  background-size: cover; background-attachment: fixed;">
  <!-- Card -->
  <div class="container d-flex justify-content-center p-4">
    <!-- Row -->
    <div class="row col-lg-6 col-12">
      <div class="card text-center p-4 shadow rounded-4 bg-light">
        <!-- Title -->
        <div class="fw-bold fs-3 my-2 text-secondary text-opacity-75">FORM REGISTRASI</div>
        <!-- Form -->
        <form action="<?= BASEURL ?>/auth/registration" method="post">
          <div class="card-body d-flex flex-column gap-1">
            <!-- Username -->
            <div class="input-group mb-2">
              <span class="input-group-text"><i class="fa fa-user"></i></span>
              <input type="text" class="form-control" placeholder="Username" name="username" id="username" required />
            </div>
            <!-- Password -->
            <div class="input-group mb-2">
              <span class="input-group-text"><i class="fa fa-lock" style="font-size: 18px;"></i></span>
              <input type="password" class="form-control" placeholder="Password" name="password" id="password" required />
            </div>
            <!-- Confirm Password -->
            <div class="input-group mb-2">
              <span class="input-group-text"><i class="fa fa-lock" style="font-size: 18px;"></i></span>
              <input type="password" class="form-control" placeholder="Confirm Password" name="confirm" id="confirm" required />
            </div>
            <!-- Email -->
            <div class="input-group mb-2">
              <span class="input-group-text"><i class="fa fa-envelope" style="font-size: 12px;"></i></span>
              <input type="email" class="form-control" placeholder="Email" name="email" id="email" required />
            </div>
            <!-- Date of Birth -->
            <div class="input-group mb-2">
              <span class="input-group-text"><i class="fa fa-birthday-cake" style="font-size: 12px;"></i></span>
              <input type="date" class="form-control" name="birth" id="birth" required />
            </div>
            <!-- Gender -->
            <div class="d-flex gap-4 align-items-center my-3">
              <div class="form-check">
                <input class="form-check-input" type="radio" id="male" name="gender" value="male" />
                <label class="form-check-label" for="male">Male</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" id="female" name="gender" value="female" />
                <label class="form-check-label" for="female">Female</label>
              </div>
            </div>
            <!-- Location -->
            <div class="input-group mb-2">
              <span class="input-group-text"><i class="fa fa-map-marker" style="font-size: 22px;"></i></span>
              <input type="text" class="form-control" placeholder="Address" name="address" id="address" required />
            </div>
            <!-- City -->
            <div class="input-group mb-2">
              <label class="input-group-text" for="city"><i class="fa fa-building" style="font-size: 14px;"></i></label>
              <select class="form-select" id="city" name="city">
                <option value="Surabaya">Surabaya</option>
                <option value="Jakarta">Jakarta</option>
                <option value="Malang">Malang</option>
              </select>
            </div>  
            <!-- Phone Number -->
            <div class="input-group mb-3">
              <span class="input-group-text"><i class="fa fa-phone" style="font-size: 16px;"></i></span>
              <input type="number" class="form-control" placeholder="Contact No" id="phone_number" name="phone_number" required />
            </div>
            <!-- Button -->
            <div class="mt-3 d-flex justify-content-center align-items-center gap-2">
              <!-- Submit -->
              <button type="submit" class="btn btn-primary fw-bold p-2" style="background-color: #29978C; border: none; width: 130px; height: 44px;">
                Submit
              </button>
              <!-- Clear -->
              <a href="<?= BASEURL ?>/auth/registration" class="btn btn-danger fw-bold p-2" style="background-color: #EE595D; border: none; width: 130px; height: 44px;">
                Clear
              </a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
