<?php if (!isset($_SESSION['user_data'])) {
?>
  <script type="text/javascript">
    window.location.href = 'login';
  </script>
<?php
}
$user_id = $_SESSION['user_data']->user_id;
$where = [
  'user_id' => $user_id
];
$selectData = $this->SelectData1('user', $where);
$user = $selectData['Data'];
$row = 4;
$encrypted_id = $_GET['id'];
$salt = "SECRET_STUFF";
$decrypted_id_raw = base64_decode($encrypted_id);
$decrypted_id = preg_replace(sprintf('/%s/', $salt), '', $decrypted_id_raw);
$mission_id = $decrypted_id;
$mission_id1 = $decrypted_id;
$where = [
  'mission.mission_id' => $mission_id,
];
$selectData = $this->SelectData3(0, 0, '', $user_id, $where, 'kdn');
$missions = $selectData['Data'];
foreach ($missions as $mission) {
  $where1 = [
    'user_id' => $user_id
  ];
  $selectData = $this->SelectApply('mission_application', $where1, 'dfdsf');
  $appusers = $selectData['Data'];
  $selectData = $this->SelectApply('mission_application', $where1);
  $appuse = $selectData['Data'];
  $where2 = [
    'user_id' => $user_id,
    'mission_id' => $mission->mission_id,
  ];
  $selectData = $this->SelectApply2('mission_rating', $where2);
  $rateduser = $selectData['Data'];
  if ($selectData['Data']) {
    $rating = 1;
  } else {
    $rating = 0;
  }
  $selectData = $this->SelectApply('favourite_mission', $where1);
  $likeusers = $selectData['Data'];
  $selectData = $this->SelectSeat();
  $seats = $selectData['Data'];
  $where3 = [
    'mission_id' => $mission->mission_id,
  ];
  $selectData = $this->SelectApply('mission_media', $where3);
  $medias = $selectData['Data'];
  $selectData = $this->SelectApply('mission_document', $where3);
  $documents = $selectData['Data'];
  $selectData = $this->SelectComment($mission->mission_id);
  $comments = $selectData['Data'];
  $comment_count = $selectData['Row'];
  $selectData = $this->SelectSkill($mission->mission_id);
  $skills = $selectData['Data'];
  $selectData = $this->Selectrateduser($mission->mission_id);
  $ratings = $selectData['Data'];
  $selectData = $this->Selectvols($mission->mission_id);
  $vols = $selectData['Data'];
  $a = 1;
  $where = [
    'city.name' => $mission->city_name
  ];
  $selectData = $this->SelectData34($where, $mission->mission_id);
  $missio = $selectData['Data'];
  if (empty($missio)) {
    $where = [
      'country.name' => $mission->country_name
    ];
    $selectData = $this->SelectData34($where, $mission->mission_id);
    $missio = $selectData['Data'];
    if (empty($missio)) {
      $where = [
        'mission_theme.title' => $mission->theme_title
      ];
      $selectData = $this->SelectData34($where, $mission->mission_id);
      $missio = $selectData['Data'];
      if (empty($missio)) {
        $a = 0;
      }
    }
  }
} ?>
<?php
if (isset($_GET['source']))
  $source = $_GET['source'];
else
  $source = '';
switch ($source) {
  case 'like_mission':
    $insert_data = [
      'user_id' => $user_id,
      'mission_id' => $_GET['id']
    ];
    $insertEx = $this->InsertData('favourite_mission', $insert_data);
    if ($insertEx['Code']) {
      include 'mvc/Views/home/header.php';
?>
      <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content p-2">
            <div class="modal-header" style="border-bottom:0 ;">
              <p class="mb-0" style="font-size:20px ;font-weight:bold">Like</p>
              <a href='Volunteering_Mission?id=<?php $id = $_GET['id'];
                                                $salt = "SECRET_STUFF";
                                                $encrypted_id = base64_encode($id . $salt);
                                                echo $encrypted_id; ?>'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
            </div>
            <div class="modal-body pb-0">
              <p class="mb-1" style="font-size:18px">Mission Liked</p>
            </div>
            <div class="modal-footer" style="border-top:0 ;">

              <a href="Volunteering_Mission?id=<?php $id = $_GET['id'];
                                                $salt = "SECRET_STUFF";
                                                $encrypted_id = base64_encode($id . $salt);
                                                echo $encrypted_id; ?>" class="col-example7 text-center">Ok</a>
            </div>
          </div>
        </div>
      </div>
    <?php
    } else {
      include 'mvc/Views/home/header.php';
    ?>
      <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content p-2">
            <div class="modal-header" style="border-bottom:0 ;">
              <p class="mb-0" style="font-size:20px ;font-weight:bold">Like</p>
              <a href='Volunteering_Mission?id=<?php $id = $_GET['id'];
                                                $salt = "SECRET_STUFF";
                                                $encrypted_id = base64_encode($id . $salt);
                                                echo $encrypted_id; ?>'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
            </div>
            <div class="modal-body pb-0">
              <p class="mb-1" style="font-size:18px">Something went wrong</p>
            </div>
            <div class="modal-footer" style="border-top:0 ;">

              <a href="Volunteering_Mission?id=<?php $id = $_GET['id'];
                                                $salt = "SECRET_STUFF";
                                                $encrypted_id = base64_encode($id . $salt);
                                                echo $encrypted_id; ?>" class="col-example7 text-center">Ok</a>
            </div>
          </div>
        </div>
      </div>
    <?php
    }
    break;
  case 'unlike_mission':
    $update_data = [
      'deleted_at' => date("Y-m-d h:i:s")
    ];
    $where = [
      'user_id' => $user_id,
      'mission_id' => $_GET['id'],
    ];
    $delete_data = $this->UpdateData1('favourite_mission', $update_data, $where);
    if ($delete_data) {
      include 'mvc/Views/home/header.php';
    ?>
      <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content p-2">
            <div class="modal-header" style="border-bottom:0 ;">
              <p class="mb-0" style="font-size:20px ;font-weight:bold">Disike</p>
              <a href='Volunteering_Mission?id=<?php $id = $_GET['id'];
                                                $salt = "SECRET_STUFF";
                                                $encrypted_id = base64_encode($id . $salt);
                                                echo $encrypted_id; ?>'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
            </div>
            <div class="modal-body pb-0">
              <p class="mb-1" style="font-size:18px">Mission Disliked</p>
            </div>
            <div class="modal-footer" style="border-top:0 ;">

              <a href="Volunteering_Mission?id=<?php $id = $_GET['id'];
                                                $salt = "SECRET_STUFF";
                                                $encrypted_id = base64_encode($id . $salt);
                                                echo $encrypted_id; ?>" class="col-example7 text-center">Ok</a>
            </div>
          </div>
        </div>
      </div>
    <?php
    } else {
      include 'mvc/Views/home/header.php';
    ?>
      <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content p-2">
            <div class="modal-header" style="border-bottom:0 ;">
              <p class="mb-0" style="font-size:20px ;font-weight:bold">Disike</p>
              <a href='Volunteering_Mission?id=<?php $id = $_GET['id'];
                                                $salt = "SECRET_STUFF";
                                                $encrypted_id = base64_encode($id . $salt);
                                                echo $encrypted_id; ?>'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
            </div>
            <div class="modal-body pb-0">
              <p class="mb-1" style="font-size:18px">Something went wrong</p>
            </div>
            <div class="modal-footer" style="border-top:0 ;">

              <a href="Volunteering_Mission?id=<?php $id = $_GET['id'];
                                                $salt = "SECRET_STUFF";
                                                $encrypted_id = base64_encode($id . $salt);
                                                echo $encrypted_id; ?>" class="col-example7 text-center">Ok</a>
            </div>
          </div>
        </div>
      </div>
    <?php
    }
    break;
  case 'apply':
    $insert_data = [
      'user_id' => $user_id,
      'mission_id' => $_GET['id'],
      'applied_at' => date("Y-m-d h:i:s"),
      'approval_status' => 'PENDING'
    ];
    $insertEx = $this->InsertData('mission_application', $insert_data);
    if ($insertEx['Code']) {
      include 'mvc/Views/home/header.php';
    ?>
      <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content p-2">
            <div class="modal-header" style="border-bottom:0 ;">
              <p class="mb-0" style="font-size:20px ;font-weight:bold">Apply</p>
              <a href='Volunteering_Mission?id=<?php $id = $_GET['id'];
                                                $salt = "SECRET_STUFF";
                                                $encrypted_id = base64_encode($id . $salt);
                                                echo $encrypted_id; ?>'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
            </div>
            <div class="modal-body pb-0">
              <p class="mb-1" style="font-size:18px">mission Applied</p>
            </div>
            <div class="modal-footer" style="border-top:0 ;">

              <a href="Volunteering_Mission?id=<?php $id = $_GET['id'];
                                                $salt = "SECRET_STUFF";
                                                $encrypted_id = base64_encode($id . $salt);
                                                echo $encrypted_id; ?>" class="col-example7 text-center">Ok</a>
            </div>
          </div>
        </div>
      </div>
    <?php
    } else {
      include 'mvc/Views/home/header.php';
    ?>
      <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content p-2">
            <div class="modal-header" style="border-bottom:0 ;">
              <p class="mb-0" style="font-size:20px ;font-weight:bold">Apply</p>
              <a href='Volunteering_Mission?id=<?php $id = $_GET['id'];
                                                $salt = "SECRET_STUFF";
                                                $encrypted_id = base64_encode($id . $salt);
                                                echo $encrypted_id; ?>'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
            </div>
            <div class="modal-body pb-0">
              <p class="mb-1" style="font-size:18px">Something went wrong</p>
            </div>
            <div class="modal-footer" style="border-top:0 ;">

              <a href="Volunteering_Mission?id=<?php $id = $_GET['id'];
                                                $salt = "SECRET_STUFF";
                                                $encrypted_id = base64_encode($id . $salt);
                                                echo $encrypted_id; ?>" class="col-example7 text-center">Ok</a>
            </div>
          </div>
        </div>
      </div>
    <?php
    }
    break;
  case 'addrating':
    $insert_data = [
      'user_id' => $user_id,
      'mission_id' => $_GET['id'],
      'rating' => $_GET['rate']
    ];
    $insertEx = $this->InsertData('mission_rating', $insert_data);
    if ($insertEx['Code']) {
      include 'mvc/Views/home/header.php';
    ?>
      <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content p-2">
            <div class="modal-header" style="border-bottom:0 ;">
              <p class="mb-0" style="font-size:20px ;font-weight:bold">Rating</p>
              <a href='Volunteering_Mission?id=<?php $id = $_GET['id'];
                                                $salt = "SECRET_STUFF";
                                                $encrypted_id = base64_encode($id . $salt);
                                                echo $encrypted_id; ?>'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
            </div>
            <div class="modal-body pb-0">
              <p class="mb-1" style="font-size:18px">Rating Added</p>
            </div>
            <div class="modal-footer" style="border-top:0 ;">

              <a href="Volunteering_Mission?id=<?php $id = $_GET['id'];
                                                $salt = "SECRET_STUFF";
                                                $encrypted_id = base64_encode($id . $salt);
                                                echo $encrypted_id; ?>" class="col-example7 text-center">Ok</a>
            </div>
          </div>
        </div>
      </div>
    <?php
    } else {
      include 'mvc/Views/home/header.php';
    ?>
      <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content p-2">
            <div class="modal-header" style="border-bottom:0 ;">
              <p class="mb-0" style="font-size:20px ;font-weight:bold">Rating</p>
              <a href='Volunteering_Mission?id=<?php $id = $_GET['id'];
                                                $salt = "SECRET_STUFF";
                                                $encrypted_id = base64_encode($id . $salt);
                                                echo $encrypted_id; ?>'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
            </div>
            <div class="modal-body pb-0">
              <p class="mb-1" style="font-size:18px">Something went wrong</p>
            </div>
            <div class="modal-footer" style="border-top:0 ;">

              <a href="Volunteering_Mission?id=<?php $id = $_GET['id'];
                                                $salt = "SECRET_STUFF";
                                                $encrypted_id = base64_encode($id . $salt);
                                                echo $encrypted_id; ?>" class="col-example7 text-center">Ok</a>
            </div>
          </div>
        </div>
      </div>
    <?php
    }
    break;
  case 'editrating':
    $update_data = [
      'rating' => $_GET['rate'],
      'updated_at' => date("Y-m-d h:i:s")
    ];
    $where = [
      'user_id' => $user_id,
      'mission_id' => $_GET['id'],
    ];
    $insertEx = $this->UpdateData1('mission_rating', $update_data, $where);
    if ($insertEx['Code']) {
      include 'mvc/Views/home/header.php';
    ?>
      <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content p-2">
            <div class="modal-header" style="border-bottom:0 ;">
              <p class="mb-0" style="font-size:20px ;font-weight:bold">Rating</p>
              <a href='Volunteering_Mission?id=<?php $id = $_GET['id'];
                                                $salt = "SECRET_STUFF";
                                                $encrypted_id = base64_encode($id . $salt);
                                                echo $encrypted_id; ?>'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
            </div>
            <div class="modal-body pb-0">
              <p class="mb-1" style="font-size:18px">Rating updated</p>
            </div>
            <div class="modal-footer" style="border-top:0 ;">

              <a href="Volunteering_Mission?id=<?php $id = $_GET['id'];
                                                $salt = "SECRET_STUFF";
                                                $encrypted_id = base64_encode($id . $salt);
                                                echo $encrypted_id; ?>" class="col-example7 text-center">Ok</a>
            </div>
          </div>
        </div>
      </div>
    <?php
    } else {
      include 'mvc/Views/home/header.php';
    ?>
      <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content p-2">
            <div class="modal-header" style="border-bottom:0 ;">
              <p class="mb-0" style="font-size:20px ;font-weight:bold">Rating</p>
              <a href='Volunteering_Mission?id=<?php $id = $_GET['id'];
                                                $salt = "SECRET_STUFF";
                                                $encrypted_id = base64_encode($id . $salt);
                                                echo $encrypted_id; ?>'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
            </div>
            <div class="modal-body pb-0">
              <p class="mb-1" style="font-size:18px">Something went wrong</p>
            </div>
            <div class="modal-footer" style="border-top:0 ;">

              <a href="Volunteering_Mission?id=<?php $id = $_GET['id'];
                                                $salt = "SECRET_STUFF";
                                                $encrypted_id = base64_encode($id . $salt);
                                                echo $encrypted_id; ?>" class="col-example7 text-center">Ok</a>
            </div>
          </div>
        </div>
      </div>
      <?php
    }
    break;
  default:
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
              'mission_id' => $_POST['m_id']
            ];
            $abc = 'tatva123';
            $insertEx = $this->InsertData('mission_invite', $data);
            $insert_data = [
              'message' => 'you get invitation',
              'user_id' => $_SESSION['invite_data']->user_id,
              'category' => 3
            ];
            $this->InsertData('notification', $insert_data);
            $mail = new PHPMailer\PHPMailer\PHPMailer(true); //defaults to using php "mail()"; the true param means it will throw exceptions on errors, which we need to catch
            try {
              // $mail->SMTPDebug = 1;                               // Enable verbose debug output
              $mail->isSMTP();                                    // Set mailer to use SMTP
              $mail->Host = 'smtp.office365.com'; // Specify main and backup SMTP servers
              $mail->SMTPAuth = true;                              // Enable SMTP authentication
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
      ?><div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content p-2">
                      <div class="modal-header" style="border-bottom:0 ;">
                        <p class="mb-0" style="font-size:20px ;font-weight:bold">Invite</p>
                        <a href='Volunteering_Mission?id=<?php $id = $_POST['m_id'];
                                                          $salt = "SECRET_STUFF";
                                                          $encrypted_id = base64_encode($id . $salt);
                                                          echo $encrypted_id; ?>'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
                      </div>
                      <div class="modal-body pb-0">
                        <p class="mb-1" style="font-size:18px">message sent to your email.</p>
                      </div>
                      <div class="modal-footer" style="border-top:0 ;">

                        <a href="Volunteering_Mission?id=<?php $id = $_POST['m_id'];
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
                      <a href='Volunteering_Mission?id=<?php $id = $_POST['m_id'];
                                                        $salt = "SECRET_STUFF";
                                                        $encrypted_id = base64_encode($id . $salt);
                                                        echo $encrypted_id; ?>'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
                    </div>
                    <div class="modal-body pb-0">
                      <p class="mb-1" style="font-size:18px">something went wrong!</p>
                    </div>
                    <div class="modal-footer" style="border-top:0 ;">

                      <a href="Volunteering_Mission?id=<?php $id = $_POST['m_id'];
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
                  <a href='Volunteering_Mission?id=<?php $id = $_POST['m_id'];
                                                    $salt = "SECRET_STUFF";
                                                    $encrypted_id = base64_encode($id . $salt);
                                                    echo $encrypted_id; ?>'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
                </div>
                <div class="modal-body pb-0">
                  <p class="mb-1" style="font-size:18px">user not found</p>
                </div>
                <div class="modal-footer" style="border-top:0 ;">

                  <a href="Volunteering_Mission?id=<?php $id = $_POST['m_id'];
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
                <a href='Volunteering_Mission?id=<?php $id = $_POST['m_id'];
                                                  $salt = "SECRET_STUFF";
                                                  $encrypted_id = base64_encode($id . $salt);
                                                  echo $encrypted_id; ?>'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
              </div>
              <div class="modal-body pb-0">
                <p class="mb-1" style="font-size:18px">please enter email.</p>
              </div>
              <div class="modal-footer" style="border-top:0 ;">

                <a href="Volunteering_Mission?id=<?php $id = $_POST['m_id'];
                                                  $salt = "SECRET_STUFF";
                                                  $encrypted_id = base64_encode($id . $salt);
                                                  echo $encrypted_id; ?>" class="col-example7 text-center">Ok</a>
              </div>
            </div>
          </div>
        </div>
      <?php }
    }
    if (isset($_POST['add_comment'])) {
      $data = [
        'user_id' => $user_id,
        'mission_id' => $mission_id,
        'comment_text' =>  $_POST['comment_text'],
        'approval_status' => 'PUBLISHED'
      ];
      $loginEx = $this->InsertData('comment', $data);
      if ($loginEx['Code']) {
        include 'mvc/Views/home/header.php';
      ?>
        <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-2">
              <div class="modal-header" style="border-bottom:0 ;">
                <p class="mb-0" style="font-size:20px ;font-weight:bold">Comment</p>
                <a href='Volunteering_Mission?id=<?php $id = $mission_id;
                                                  $salt = "SECRET_STUFF";
                                                  $encrypted_id = base64_encode($id . $salt);
                                                  echo $encrypted_id; ?>'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
              </div>
              <div class="modal-body pb-0">
                <p class="mb-1" style="font-size:18px">Comment added</p>
              </div>
              <div class="modal-footer" style="border-top:0 ;">

                <a href="Volunteering_Mission?id=<?php $id = $mission_id;
                                                  $salt = "SECRET_STUFF";
                                                  $encrypted_id = base64_encode($id . $salt);
                                                  echo $encrypted_id; ?>" class="col-example7 text-center">Ok</a>
              </div>
            </div>
          </div>
        </div>
      <?php
      } else {
        include 'mvc/Views/home/header.php';
      ?>
        <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-2">
              <div class="modal-header" style="border-bottom:0 ;">
                <p class="mb-0" style="font-size:20px ;font-weight:bold">Comment</p>
                <a href='Volunteering_Mission?id=<?php $id = $mission_id;
                                                  $salt = "SECRET_STUFF";
                                                  $encrypted_id = base64_encode($id . $salt);
                                                  echo $encrypted_id; ?>'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
              </div>
              <div class="modal-body pb-0">
                <p class="mb-1" style="font-size:18px">Something went wrong</p>
              </div>
              <div class="modal-footer" style="border-top:0 ;">

                <a href="Volunteering_Mission?id=<?php $id = $mission_id;
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
    if (isset($_POST['notification'])) {

      $note = $_POST['note'];
      $selectData = $this->SelectNote($note);
      $notes = $selectData['Data']; ?>
      <?php } else {
      $selectData = $this->SelectNote();
      $notes = $selectData['Data'];
    }
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
                <a href='Volunteering_Mission?id=<?php $id = $mission_id;
                                                  $salt = "SECRET_STUFF";
                                                  $encrypted_id = base64_encode($id . $salt);
                                                  echo $encrypted_id; ?>'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
              </div>
              <div class="modal-body pb-0">
                <p class="mb-1" style="font-size:18px">message sent</p>
              </div>
              <div class="modal-footer" style="border-top:0 ;">

                <a href="Volunteering_Mission?id=<?php $id = $mission_id;
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
                <a href='Volunteering_Mission?id=<?php $id = $mission_id;
                                                  $salt = "SECRET_STUFF";
                                                  $encrypted_id = base64_encode($id . $salt);
                                                  echo $encrypted_id; ?>'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
              </div>
              <div class="modal-body pb-0">
                <p class="mb-1" style="font-size:18px">Something went wrong</p>
              </div>
              <div class="modal-footer" style="border-top:0 ;">

                <a href="Volunteering_Mission?id=<?php $id = $mission_id;
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
    include 'mvc/Views/home/header1.php';
    include 'mvc/Views/home/Volunteering_Mission.php';
    include 'mvc/Views/home/footer.php';
    break;
}
?>