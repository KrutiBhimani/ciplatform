<div class="container-fluid">
  <div class="row height100per">
    <div class="col-lg-8 col-md-8 col-sm-12 col-12 p-0">
      <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators" style="bottom:2%">
          <?php foreach ($banners as $banner) {
            $less = $banner->sort_order - 1;
            if ($banner->sort_order == 1) { ?>
              <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?php echo $less ?>" class="active" aria-current="true" aria-label="Slide <?php echo $banner->sort_order ?>" style="border-top: 0; border-bottom:0;border-radius:15px;width:8px;height: 8px;"></li>
            <?php } else { ?>
              <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?php echo $less ?>" aria-label="Slide <?php echo $banner->sort_order ?>" style="border-top: 0; border-bottom:0;border-radius:15px;width:8px;height: 8px;"></li>
          <?php }
          } ?>
        </div>
        <div class="carousel-inner">
          <?php foreach ($banners as $banner) {
            if ($banner->sort_order == 1) { ?>
              <div class='carousel-item active'>
              <?php } else { ?>
                <div class='carousel-item'>
                <?php } ?>
                <img src="mvc/Assets/uplodes/<?php echo $banner->image; ?>" class="d-block w-100" alt="..." style="height:100% ;">
                <div class="carousel-caption" style="text-align:start; bottom:10%">
                  <p class="Sed-ut-perspiciatis-unde-omnis-iste-natus-voluptatem mb-3"><?php echo $banner->title; ?></p>
                  <p class="Lorem-ipsum-dolor-sit-amet-consectetur-adipiscing-elit-sed-do m-0"><?php echo $banner->text; ?></p>
                </div>
                </div>
              <?php } ?>
              </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-12 d-md-flex align-items-center position-relative">
        <div class="Layer-52">
          <br />
          <form name="myForm" onsubmit="return validateForm()" method="post" enctype="multipart/form-data">
            <p class="text-center text-1 mb-2">New Password</p>
            <p class="text-center text-2">please enter new password in the fields below.</p>
            <div class="form-group mb-3">
              <span class="Email">New password</span>
              <input type="password" placeholder="Enter your new password..." name="password" class="Rounded-Rectangle-2 form-control" style="font-size:14px; height:40px;">
              <span id="errorp1" style="color:#f88634"></span>
            </div>
            <div class="form-group mb-3">
              <span class="Email">Confirm new password</span>
              <input type="password" placeholder="Enter your new password again..." name="password2" class="Rounded-Rectangle-2 form-control" style="font-size:14px; height:40px;">
              <span id="errorp1" style="color:#f88634"></span>
            </div>
            <span id=error style="color: red;"></span>
            <button class="login" name="reset" type="submit">Change Password</button>
          </form>
          <p class="text-center">
            <a href="login" class="back">Login</a>
          </p><br /><br />
        </div>
        <a href="policy" class="text-center position-absolute bottom-0 start-50 translate-middle p-0 m-0 mt-3 Privacy-Policy">Privacy Policy</a>
      </div>
    </div>
  </div>