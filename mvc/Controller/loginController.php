<?php

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($this->connection, $_POST['email']);
    $password = mysqli_real_escape_string($this->connection, $_POST['password']);
    $salt = "SeCrEtStUfFfOrPaSsWoRd";
    $password = base64_encode($password . $salt);
    $loginEx = $this->LoginData($email, $password);
    if ($loginEx['Code']) {
        $_SESSION['user_data'] = $loginEx['Data1'];
        if ($_SESSION['user_data']) {
?>
            <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content p-2">
                <div class="modal-header" style="border-bottom:0 ;">
                  <p class="mb-0" style="font-size:20px ;font-weight:bold">Login</p>
                  <a href='home'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
                </div>
                <div class="modal-body pb-0">
                    <p class="mb-1" style="font-size:18px">User login</p>
                  </div>
                  <div class="modal-footer" style="border-top:0 ;">
                
                <a href="home" class="col-example7 text-center">Ok</a>
                  </div>
              </div>
            </div>
          </div>
        <?php
        }
        else{
          $_SESSION['admin_data'] = $loginEx['Data2'];
          if ($_SESSION['admin_data']) {
              ?>
              <script  type="text/javascript">
                  window.location.href = "user";
              </script>
              <?php
          }
        } 
    } else {
        ?>
        <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content p-2">
                <div class="modal-header" style="border-bottom:0 ;">
                  <p class="mb-0" style="font-size:20px ;font-weight:bold">Login</p>
                  <a href='login'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
                </div>
                <div class="modal-body pb-0">
                    <p class="mb-1" style="font-size:18px">Please enter valid Details</p>
                  </div>
                  <div class="modal-footer" style="border-top:0 ;">
                
                <a href="login" class="col-example7 text-center">Ok</a>
                  </div>
              </div>
            </div>
          </div>
<?php
    }
} ?>
<script>
    function validateForm() {
        let y = document.forms["myForm"]["email"].value;
        if (y == "") {
            document.getElementById("error1").innerHTML = "Email Address is required";
            return false;
        }
        let x = document.forms["myForm"]["password"].value;
        if (x == "") {
            document.getElementById("error2").innerHTML = "Password is required";
            return false;
        }

    }
</script>
<?php
$selectData = $this->SelectBanner();
$banners = $selectData['Data'];
include 'mvc/Views/header.php';
include 'mvc/Views/login.php';
include 'mvc/Views/footer.php';

?>