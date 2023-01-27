<?php if ($row > 3) { ?>
  <footer id="footer2" class="d-flex position-relative" style="border-top:2px solid rgb(225, 225, 225)">
    <div class="position-absolute top-100 w-100">
      <div class="container-lg pt-4 pb-3 mb-1">
        <a href="policy" class="Forma-1-copy-13">Privacy policy</a><br />
        <a href="#" style="color: black;" data-bs-toggle="modal" data-bs-target="#popup22">contact us</a>
      </div>
    </div>
    <div id="footer" class="position-absolute w-100" style="z-index: 9;">
      <div class="float-end mt-3 me-3">
        <img src="mvc/Assets/images/cross.png" alt="" class="img-fluid" onclick="$('#footer').remove();" style="cursor: pointer;">
      </div>
      <div class="container-lg">
        <div class="d-flex justify-content-between pt-4 pb-3">
          <div>
            <span>This website makes use of cookies to enhance browsing experience and provide additional
              functionality.</span><br />
            <a href="policy" class="Forma-1-copy-12">Privacy policy</a>
          </div>
          <div>
            <div class="col-example12">I&nbsp;Agree</div>
          </div>
        </div>
      </div>
    </div>
  </footer>
<?php } else { ?>
  <footer id="footer2" class="d-flex position-relative">
    <div class="position-fixed bottom-0 w-100" style="border-top:2px solid rgb(225, 225, 225)">
      <div class="container-lg pt-3 pb-3 mb-1">
        <a href="policy" class="Forma-1-copy-13">Privacy policy</a><br />
        <a href="#" style="color: black;" data-bs-toggle="modal" data-bs-target="#popup22">contact us</a>
      </div>
    </div>
    <div id="footer" class="position-fixed bottom-0 w-100" style="z-index: 9;">
      <div class="float-end mt-3 me-3">
        <img src="mvc/Assets/images/cross.png" alt="" class="img-fluid" onclick="$('#footer').remove();" style="cursor: pointer;">
      </div>
      <div class="container-lg">
        <div class="d-flex justify-content-between pt-4 pb-3">
          <div>
            <span style="font-size: calc(6px + 0.5vw);">This website makes use of cookies to enhance browsing experience and provide additional
              functionality.</span><br />
            <a href="policy" class="Forma-1-copy-12" style="font-size: calc(6px + 0.5vw);">Privacy policy</a>
          </div>
          <div>
            <div class="col-example12" style="font-size: calc(6px + 0.5vw);">I&nbsp;Agree</div>
          </div>
        </div>
      </div>
    </div>
  </footer>
<?php } ?>
<div id="popup22" class="modal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-2">
      <div class="modal-header pb-0" style="border-bottom:0 ;">
        <p class="mb-0" style="font-size:20px ;">contact Us</p>
        <img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png" data-bs-dismiss="modal" style="cursor: pointer;height:13px">
      </div>
      <form class="m-0" method="post" enctype="multipart/form-data">
        <div class="modal-body pb-0">
          <p class="mb-1">Name*</p>
          <input type="text" class="popup" name="" value="<?php echo $user->first_name . ' ' . $user->last_name ?>" disabled>
          <p class="mb-1 mt-3">Email Address*</p>
          <input type="email" class="popup" name="" value="<?php echo $user->email ?>" disabled>
          <p class="mb-1 mt-3">Subject*</p>
          <input type="text" class="popup" name="subject" placeholder="Enter your subject">
          <p class="mb-1 mt-3">Message*</p>
          <textarea class="popup1" rows="4" name="message" placeholder="Enter your message"></textarea>
        </div>
        <div class="modal-footer" style="border-top:0 ;">
          <button type="button" class="col-example8" data-bs-dismiss="modal">Cancle
          </button>
          <button type="submit" name='contact' class="col-example7" data-bs-dismiss="modal">Save
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

</body>

</html>