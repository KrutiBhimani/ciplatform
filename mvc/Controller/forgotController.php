<?php if (isset($_POST['forgot'])) {
  $email = mysqli_real_escape_string($this->connection, $_POST['email']);
  $resetEx = $this->ResetPass($email);
  if ($resetEx['Code']) {
    $_SESSION['reset_data'] = $resetEx['Data'];
    $token = md5(2418 * 2) . substr(md5(uniqid(rand(), 1)), 3, 10);
    if ($_SESSION['reset_data']) {
      $link = "<a href='http://localhost/ci-platform/reset?key=" . $_SESSION['reset_data']->email . "&t=" . $token . "'>Click To Reset password</a>";
      require 'mvc/Libraries/PHPMailer/PHPMailerAutoload.php';
      require_once('mvc/Libraries/PHPMailer/src/PHPMailer.php');
      require_once('mvc/Libraries/PHPMailer/src/Exception.php');
      require_once('mvc/Libraries/PHPMailer/src/OAuthTokenProvider.php');
      require_once('mvc/Libraries/PHPMailer/src/OAuth.php');
      require_once('mvc/Libraries/PHPMailer/src/POP3.php');
      require_once('mvc/Libraries/PHPMailer/src/SMTP.php');
      if (empty($errors)) {
        $insert_data = [
          'email' => $_SESSION['reset_data']->email,
          'created_at' => date("Y/m/d H:i:s"),
          'token' => $token
        ];
        $abc = 'tatva123';
        $insertEx = $this->InsertData('password_reset', $insert_data);
        $mail = new PHPMailer\PHPMailer\PHPMailer(true); //defaults to using php "mail()"; the true param means it will throw exceptions on errors, which we need to catch
        try {
          // $mail->SMTPDebug = 1;                               // Enable verbose debug output
          $mail->isSMTP();                                    // Set mailer to use SMTP
          $mail->Host = 'smtp.office365.com'; // Specify main and backup SMTP servers
          $mail->SMTPAuth = true;                             // Enable SMTP authentication
          $mail->Username = 'tatvakruti@outlook.com';           // SMTP username
          $mail->Password = $abc;                       // SMTP password
          $mail->SMTPSecure = 'tls';                          // Enable TLS encryption, `ssl` also accepted
          $mail->Port = 587;                                  // TCP port to connect, tls=587, ssl=465
          $mail->From = 'tatvakruti@outlook.com';
          $mail->FromName = 'tatva kruti';
          $mail->addAddress($email);     // Add a recipient
          $mail->addReplyTo($email);
          $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
          $mail->isHTML(false);                                  // Set email format to HTML
          $mail->Subject = 'Reset Password';
          $mail->Body    = 'Click On This Link to Reset Password ' . $link . '';
          $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
          if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
          } else { ?>
            <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-2">
                  <div class="modal-header" style="border-bottom:0 ;">
                    <p class="mb-0" style="font-size:20px ;font-weight:bold">Password</p>
                    <a href='forgot'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
                  </div>
                  <div class="modal-body pb-0">
                    <p class="mb-1" style="font-size:18px">message sent to your email.</p>
                  </div>
                  <div class="modal-footer" style="border-top:0 ;">

                    <a href="forgot" class="col-example7 text-center">Ok</a>
                  </div>
                </div>
              </div>
            </div>
          <?php }
          $errors[] = "Send mail sucsessfully";
        } catch (Exception $e) {
          $errors[] = $e->getMessage(); //Boring error messages from anything else!
          ?>
          <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content p-2">
                <div class="modal-header" style="border-bottom:0 ;">
                  <p class="mb-0" style="font-size:20px ;font-weight:bold">Password</p>
                  <a href="forgot" src="mvc/Assets/images/cancel1.png"></a>
                </div>
                <div class="modal-body pb-0">
                  <p class="mb-1" style="font-size:18px">something went wrong!</p>
                </div>
                <div class="modal-footer" style="border-top:0 ;">

                  <a href="forgot" class="col-example7 text-center">Ok</a>
                </div>
              </div>
            </div>
          </div>
      <?php
        }
      }
    } else { ?>
      <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content p-2">
            <div class="modal-header" style="border-bottom:0 ;">
              <p class="mb-0" style="font-size:20px ;font-weight:bold">Password</p>
              <a href='forgot'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
            </div>
            <div class="modal-body pb-0">
              <p class="mb-1" style="font-size:18px">User not found.</p>
            </div>
            <div class="modal-footer" style="border-top:0 ;">

              <a href="forgot" class="col-example7 text-center">Ok</a>
            </div>
          </div>
        </div>
      </div>
    <?php }
  }
  if ($email == null || $email == '') { ?>
    <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-2">
          <div class="modal-header" style="border-bottom:0 ;">
            <p class="mb-0" style="font-size:20px ;font-weight:bold">Password</p>
            <a href='forgot'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
          </div>
          <div class="modal-body pb-0">
            <p class="mb-1" style="font-size:18px">please enter email.</p>
          </div>
          <div class="modal-footer" style="border-top:0 ;">

            <a href="forgot" class="col-example7 text-center">Ok</a>
          </div>
        </div>
      </div>
    </div>
<?php }
} ?>
<script>
  function validateForm() {
    let y = document.forms["myForm"]["email"].value;
    if (y == "") {
      document.getElementById("error1").innerHTML = "Email Address is required";
      return false;
    }
  }
</script>
<?php
$selectData = $this->SelectBanner();
$banners = $selectData['Data'];
include 'mvc/Views/header.php';
include 'mvc/Views/forgotpsd.php';
include 'mvc/Views/footer.php';
?>