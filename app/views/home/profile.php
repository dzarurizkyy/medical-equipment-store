<?php
  // Remove leading 0 and 8 and convert to +62
  $phone_number = ltrim($data["user"]["phone_number"], '08');
  $phone_number = '62' . $phone_number;
?>

<!-- Container -->
<div class="d-flex justify-content-center p-3">
  <!-- Card -->
  <div class="d-flex flex-column justify-content-center card py-4 px-5 mb-4 rounded-2">
    <!-- Top -->
    <div class="d-flex flex-column align-items-center justify-content-center pb-3" style="border-bottom: 1px solid #E5E5E5">
      <!-- Image -->
      <div>
        <img src="<?= BASEURL ?>/img/assets/<?= $data['user']['gender'] === 'male' ? 'Male' : 'Female'?>.png" width="180"/>
      </div>
      <!-- Username -->
      <div class="fw-bold fs-3"><?= ucwords($data["user"]["username"]) ?></div>
      <!-- Role -->
      <div class="text-secondary" style="font-size: 18px;">User</div>
      <!-- Link -->
      <div class="d-flex gap-2 mt-2 pt-2">
        <!-- Phone Number -->
        <a href="https:/wa.me/62<?= $phone_number ?>" class="d-flex justify-content-center align-items-center text-decoration-none" style="border-radius: 20px; width: 30px; height: 30px; background-color: #29978C;">
          <i class="fa fa-phone" style="color: #FFF"></i>
        </a>
        <!-- Email -->
        <a href="mailto:<?= $data["user"]["email"] ?>" class="d-flex justify-content-center align-items-center text-decoration-none" style="border-radius: 20px; width: 30px; height: 30px; background-color: #29978C;">
          <i class="fa fa-envelope" style="color: #FFF"></i>
        </a>
      </div>
    </div>
    <!-- Bottom -->
    <div class="mt-4 mb-2 d-flex flex-column gap-2">
      <!-- Gender -->
      <div>
        <div class="text-secondary fw-medium">Gender</div>
        <div style="font-size: 18px;"><?= ucfirst($data["user"]["gender"]) ?></div>
      </div>
      <!-- Birthdate -->
      <div>
        <div class="text-secondary fw-medium">Birthdate</div>
        <div style="font-size: 18px;"><?= date("j F Y", strtotime($data["user"]["birth"])) ?></div>
      </div>
      <!-- City -->
      <div>
        <div class="text-secondary fw-medium">City</div>
        <div style="font-size: 18px;"><?= $data["user"]["city"] ?></div>
      </div>
      <!-- Address -->
      <div>
        <div class="text-secondary fw-medium">Address</div>
        <div style="font-size: 18px;"><?= $data["user"]["address"] ?></div>
      </div>
    </div>
  </div>
</div>