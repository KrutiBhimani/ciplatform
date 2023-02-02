<?php if (!isset($_SESSION['user_data'])) {
?>
  <script type="text/javascript">
    window.location.href = 'login';
  </script>
  <?php
}
$user_id = $_SESSION['user_data']->user_id;
$row = 4;
$where = [
  'user_id' => $user_id
];
$selectData = $this->SelectData1('user', $where);
$user = $selectData['Data'];
$selectData = $this->SelectNote();
$notes = $selectData['Data'];
$encrypted_id = $_GET['key'];
$salt = "SECRET_STUFF";
$decrypted_id_raw = base64_decode($encrypted_id);
$decrypted_id = preg_replace(sprintf('/%s/', $salt), '', $decrypted_id_raw);
$story_id = $decrypted_id;
$selectData = $this->Storys($story_id);
$story = $selectData['Data'];
$where3 = [
  'story_id' => $story->story_id,
];
$selectData = $this->SelectApply('story_media', $where3);
$medias = $selectData['Data'];
if (isset($_POST['contact'])) {
  $insert_data = [
    'user_id' => $user->user_id,
    'subject' => $_POST['subject'],
    'message' => $_POST['message']
  ];
  $insertEx = $this->InsertData('contact', $insert_data);
  if ($insertEx['Code']) {
  ?>
    <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-2">
          <div class="modal-header" style="border-bottom:0 ;">
            <p class="mb-0" style="font-size:20px ;font-weight:bold">Contact</p>
            <a href='story_detail?key=<?php $id = $story_id;
                                      $salt = "SECRET_STUFF";
                                      $encrypted_id = base64_encode($id . $salt);
                                      echo $encrypted_id; ?>'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
          </div>
          <div class="modal-body pb-0">
            <p class="mb-1" style="font-size:18px">message sent</p>
          </div>
          <div class="modal-footer" style="border-top:0 ;">

            <a href="story_detail?key=<?php $id = $story_id;
                                      $salt = "SECRET_STUFF";
                                      $encrypted_id = base64_encode($id . $salt);
                                      echo $encrypted_id; ?>" class="col-example7 text-center">Ok</a>
          </div>
        </div>
      </div>
    </div>
  <?php
  } else {
  ?>
    <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-2">
          <div class="modal-header" style="border-bottom:0 ;">
            <p class="mb-0" style="font-size:20px ;font-weight:bold">Contact</p>
            <a href='story_detail?key=<?php $id = $story_id;
                                      $salt = "SECRET_STUFF";
                                      $encrypted_id = base64_encode($id . $salt);
                                      echo $encrypted_id; ?>'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
          </div>
          <div class="modal-body pb-0">
            <p class="mb-1" style="font-size:18px">Something went wrong</p>
          </div>
          <div class="modal-footer" style="border-top:0 ;">

            <a href="story_detail?key=<?php $id = $story_id;
                                      $salt = "SECRET_STUFF";
                                      $encrypted_id = base64_encode($id . $salt);
                                      echo $encrypted_id; ?>" class="col-example7 text-center">Ok</a>
          </div>
        </div>
      </div>
    </div>
    <?php
  }
}
if (isset($_POST['inviteuser'])) {
  $email = $_POST['email'];
  $inviteEx = $this->ResetPass($email);
  if ($inviteEx['Code']) {
    $_SESSION['invite_data'] = $inviteEx['Data'];
    if ($_SESSION['invite_data']) {
      $link = "<a href='http://localhost/ci-platform/login'>Click To Get Started</a>";
      require 'mvc/Libraries/PHPMailer/PHPMailerAutoload.php';
      require_once('mvc/Libraries/PHPMailer/src/PHPMailer.php');
      require_once('mvc/Libraries/PHPMailer/src/Exception.php');
      require_once('mvc/Libraries/PHPMailer/src/OAuthTokenProvider.php');
      require_once('mvc/Libraries/PHPMailer/src/OAuth.php');
      require_once('mvc/Libraries/PHPMailer/src/POP3.php');
      require_once('mvc/Libraries/PHPMailer/src/SMTP.php');
      if (empty($errors)) {
        $data = [
          'to_user_id' => $_SESSION['invite_data']->user_id,
          'from_user_id' => $user_id,
          'story_id' => $_POST['s_id']
        ];
        $abc = 'tatva123';
        $insertEx = $this->InsertData('story_invite', $data);
        $mail = new PHPMailer\PHPMailer\PHPMailer(true); //defaults to using php "mail()"; the true param means it will throw exceptions on errors, which we need to catch
        try {
          // $mail->SMTPDebug = 1;                               // Enable verbose debug output
          $mail->isSMTP();                                    // Set mailer to use SMTP
          $mail->Host = 'smtp.office365.com'; // Specify main and backup SMTP servers
          $mail->SMTPAuth = true;                           // Enable SMTP authentication
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
          $mail->Subject = 'Invited';
          $mail->Body    = 'You gets invitation by user ' . $link . '';
          $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
          if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
          } else {
    ?>
            <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-2">
                  <div class="modal-header" style="border-bottom:0 ;">
                    <p class="mb-0" style="font-size:20px ;font-weight:bold">Invite</p>
                    <a href='story_detail?key=<?php $id = $_POST['s_id'];
                                              $salt = "SECRET_STUFF";
                                              $encrypted_id = base64_encode($id . $salt);
                                              echo $encrypted_id; ?>'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
                  </div>
                  <div class="modal-body pb-0">
                    <p class="mb-1" style="font-size:18px">message sent to your email.</p>
                  </div>
                  <div class="modal-footer" style="border-top:0 ;">

                    <a href="story_detail?key=<?php $id = $_POST['s_id'];
                                              $salt = "SECRET_STUFF";
                                              $encrypted_id = base64_encode($id . $salt);
                                              echo $encrypted_id; ?>" class="col-example7 text-center">Ok</a>
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
                  <p class="mb-0" style="font-size:20px ;font-weight:bold">Invite</p>
                  <a href='story_detail?key=<?php $id = $_POST['s_id'];
                                            $salt = "SECRET_STUFF";
                                            $encrypted_id = base64_encode($id . $salt);
                                            echo $encrypted_id; ?>'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
                </div>
                <div class="modal-body pb-0">
                  <p class="mb-1" style="font-size:18px">something went wrong!</p>
                </div>
                <div class="modal-footer" style="border-top:0 ;">

                  <a href="story_detail?key=<?php $id = $_POST['s_id'];
                                            $salt = "SECRET_STUFF";
                                            $encrypted_id = base64_encode($id . $salt);
                                            echo $encrypted_id; ?>" class="col-example7 text-center">Ok</a>
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
              <p class="mb-0" style="font-size:20px ;font-weight:bold">Invite</p>
              <a href='story_detail?key=<?php $id = $_POST['s_id'];
                                        $salt = "SECRET_STUFF";
                                        $encrypted_id = base64_encode($id . $salt);
                                        echo $encrypted_id; ?>'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
            </div>
            <div class="modal-body pb-0">
              <p class="mb-1" style="font-size:18px">User not found.</p>
            </div>
            <div class="modal-footer" style="border-top:0 ;">

              <a href="story_detail?key=<?php $id = $_POST['s_id'];
                                        $salt = "SECRET_STUFF";
                                        $encrypted_id = base64_encode($id . $salt);
                                        echo $encrypted_id; ?>" class="col-example7 text-center">Ok</a>
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
            <p class="mb-0" style="font-size:20px ;font-weight:bold">Invite</p>
            <a href='story_detail?key=<?php $id = $_POST['s_id'];
                                      $salt = "SECRET_STUFF";
                                      $encrypted_id = base64_encode($id . $salt);
                                      echo $encrypted_id; ?>'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
          </div>
          <div class="modal-body pb-0">
            <p class="mb-1" style="font-size:18px">please enter email.</p>
          </div>
          <div class="modal-footer" style="border-top:0 ;">

            <a href="story_detail?key=<?php $id = $_POST['s_id'];
                                      $salt = "SECRET_STUFF";
                                      $encrypted_id = base64_encode($id . $salt);
                                      echo $encrypted_id; ?>" class="col-example7 text-center">Ok</a>
          </div>
        </div>
      </div>
    </div>
<?php }
}
include 'mvc/Views/home/header.php';
?>
<script type="text/javascript">
  $(document).ready(function() {
    $('.carousel-item').on({
      click: function() {
        var imageURL = $(this).attr('src');
        var duration = 0;

        $('#mainImage').fadeOut(duration, function() {
          $(this).attr('src', imageURL);
        }).fadeIn(duration);

      }
    }, 'img');

    var mainImageElement = $('#mainImage');
    var height = parseInt(mainImageElement.attr('height'));
    var width = parseInt(mainImageElement.attr('width'))
  });
</script>
<?php
include 'mvc/Views/home/header1.php';
include 'mvc/Views/home/story_detail.php';
include 'mvc/Views/home/footer.php';
?>