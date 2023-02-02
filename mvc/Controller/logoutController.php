<?php
if (isset($_SESSION['admin_data'])) {
  unset($_SESSION['admin_data']);
  session_destroy();
} else if (isset($_SESSION['user_data'])) {
  unset($_SESSION['user_data']);
  session_destroy();
}
include 'mvc/Views/home/header.php';
?>

<div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-2">
      <div class="modal-header" style="border-bottom:0 ;">
        <p class="mb-0" style="font-size:20px ;font-weight:bold">Loging Out</p>
        <a href="login" src="mvc/Assets/images/cancel1.png"></a>
      </div>
      <div class="modal-body pb-0">
        <p class="mb-1" style="font-size:18px">Loged out Successfully</p>
      </div>
      <div class="modal-footer" style="border-top:0 ;">

        <a href="login" class="col-example7 text-center">Ok</a>
      </div>
    </div>
  </div>
</div>