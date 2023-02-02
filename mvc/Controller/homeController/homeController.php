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
$selectData = $this->SelectNote();
$notes = $selectData['Data'];
$pagecount = 9;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else
  $page = 1;
if ($page == "" || $page == 1) {
  $postno = 0;
} else
  $postno = ($page * $pagecount) - $pagecount;
$selectData1 = $this->Select('mission');
$cnts = $selectData1['Data'];
$cnt = ceil($cnts / $pagecount);
$selectData = $this->SelectData3($postno, $pagecount, 'ASC');
$missions = $selectData['Data'];
$row = $selectData['Row'];
foreach ($missions as $mission) {
  $selectData = $this->SelectApply('mission_application', $where);
  $appusers = $selectData['Data'];
  $selectData = $this->SelectApply('favourite_mission', $where);
  $likeusers = $selectData['Data'];
  $selectData = $this->SelectSeat();
  $seats = $selectData['Data'];
}
$selectData = $this->SelectData5('city');
$cities = $selectData['Data'];
$selectData = $this->SelectData5('country');
$countries = $selectData['Data'];
$selectData = $this->SelectData5('mission_theme');
$themes = $selectData['Data'];
$selectData = $this->SelectData5('skill');
$skills = $selectData['Data'];
$selectData = $this->SelectData4($user_id);
$users = $selectData['Data'];
$userrow = $selectData['Row'];

include 'mvc/Views/home/header.php';
?>
<script>
  $(document).on('click', '.six-txt1', function() {
    var t = $(this).text();
    var text = t.trim();
    $('#clickedButton').val($(this).text().trim());
    let form1 = document.getElementById("selectSort1");
    form1.submit();
  })
  $(document).ready(function() {
    $("#gridlink").click(function() {
      $("#divlist").hide();
      $("#divgrid").show();
      $("#h2").removeClass("Ellipse-574");
      $("#h1").addClass("Ellipse-574");
    });
    $("#listlink").click(function() {
      $("#divlist").show();
      $("#divgrid").hide();
      $("#h1").removeClass("Ellipse-574");
      $("#h2").addClass("Ellipse-574");
    });
  })
  $(document).ready(function() {
    $('#selectSort').change(function() {
      var selectedOptions = $('#selectSort option:selected');
      if (selectedOptions.length > 0) {
        var resultString = '';
        selectedOptions.each(function() {
          resultString += $(this).val();
        });
        $('#divResult').html(resultString);
      }
    });
  });

  function showHide() {
    let form = document.getElementById("selectSort1");
    form.submit();
  }

  function showHide2() {
    let form2 = document.getElementById("selectSort3");
    form2.submit();
  }

  function removecountry() {
    $("option:selected").removeAttr("selected");
    let form3 = document.getElementById("selectSort1");
    form3.submit();
  }

  function remove(value) {
    $('input[value="' + value + '"]').removeAttr('checked');
    let form3 = document.getElementById("selectSort1");
    form3.submit();
  }
</script>
<?php
if (isset($_GET['source']))
  $source = $_GET['source'];
else
  $source = '';
switch ($source) {
  case 'like_mission':
    $insert_data = [
      'user_id' => $_GET['user'],
      'mission_id' => $_GET['like']
    ];
    $insertEx = $this->InsertData('favourite_mission', $insert_data);
    if ($insertEx['Code']) {
      include 'mvc/Views/home/header1.php';
      include 'mvc/Views/home/header2.php';
      include 'mvc/Views/home/home.php';
?>
      <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content p-2">
            <div class="modal-header" style="border-bottom:0 ;">
              <p class="mb-0" style="font-size:20px ;font-weight:bold">Like</p>
              <a href='home'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
            </div>
            <div class="modal-body pb-0">
              <p class="mb-1" style="font-size:18px">Mission Liked</p>
            </div>
            <div class="modal-footer" style="border-top:0 ;">

              <a href="home" class="col-example7 text-center">Ok</a>
            </div>
          </div>
        </div>
      </div>
      <!-- <script src= "https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script src= "https://cdn.jsdelivr.net/npm/sweetalert2@11.4.8/dist/sweetalert2.all.min.js"></script> -->
      <script type="text/javascript">
        // Swal.fire('This is a customized alert box.',);
        //alert("mission liked");
        //window.location.href = 'home';
      </script>
    <?php
    } else {
      include 'mvc/Views/home/header1.php';
      include 'mvc/Views/home/header2.php';
      include 'mvc/Views/home/home.php';
    ?>
      <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content p-2">
            <div class="modal-header" style="border-bottom:0 ;">
              <p class="mb-0" style="font-size:20px ;font-weight:bold">Like</p>
              <a href='home'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
            </div>
            <div class="modal-body pb-0">
              <p class="mb-1" style="font-size:18px">Something went wrong</p>
            </div>
            <div class="modal-footer" style="border-top:0 ;">

              <a href="home" class="col-example7 text-center">Ok</a>
            </div>
          </div>
        </div>
      </div>
      <script type="text/javascript">
        window.location.href = 'home';
      </script>
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
      include 'mvc/Views/home/header1.php';
      include 'mvc/Views/home/header2.php';
      include 'mvc/Views/home/home.php';
    ?><div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content p-2">
            <div class="modal-header" style="border-bottom:0 ;">
              <p class="mb-0" style="font-size:20px ;font-weight:bold">Apply</p>
              <a href='home'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
            </div>
            <div class="modal-body pb-0">
              <p class="mb-1" style="font-size:18px">Mission Applied</p>
            </div>
            <div class="modal-footer" style="border-top:0 ;">

              <a href="home" class="col-example7 text-center">Ok</a>
            </div>
          </div>
        </div>
      </div>
      <script type="text/javascript">
        //window.location.href = 'home';
      </script>
    <?php
    } else {
      include 'mvc/Views/home/header1.php';
      include 'mvc/Views/home/header2.php';
      include 'mvc/Views/home/home.php';
    ?><div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content p-2">
            <div class="modal-header" style="border-bottom:0 ;">
              <p class="mb-0" style="font-size:20px ;font-weight:bold">Apply</p>
              <a href='home'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
            </div>
            <div class="modal-body pb-0">
              <p class="mb-1" style="font-size:18px">Something went Wrong</p>
            </div>
            <div class="modal-footer" style="border-top:0 ;">

              <a href="home" class="col-example7 text-center">Ok</a>
            </div>
          </div>
        </div>
      </div>
      <script type="text/javascript">
        //window.location.href = 'home';
      </script>
    <?php
    }
    break;
  case 'unlike_mission':
    $update_data = [
      'deleted_at' => date("Y-m-d h:i:s")
    ];
    $where = [
      'user_id' => $_GET['user'],
      'mission_id' => $_GET['like']
    ];
    $delete_data = $this->UpdateData1('favourite_mission', $update_data, $where);
    if ($delete_data) {
      include 'mvc/Views/home/header1.php';
      include 'mvc/Views/home/header2.php';
      include 'mvc/Views/home/home.php';
    ?>
      <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content p-2">
            <div class="modal-header" style="border-bottom:0 ;">
              <p class="mb-0" style="font-size:20px ;font-weight:bold">Dislike</p>
              <a href='home'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
            </div>
            <div class="modal-body pb-0">
              <p class="mb-1" style="font-size:18px">Mission Disliked</p>
            </div>
            <div class="modal-footer" style="border-top:0 ;">

              <a href="home" class="col-example7 text-center">Ok</a>
            </div>
          </div>
        </div>
      </div>
      <script type="text/javascript">
        //window.location.href = 'home';
      </script>
    <?php
    } else {
      include 'mvc/Views/home/header1.php';
      include 'mvc/Views/home/header2.php';
      include 'mvc/Views/home/home.php';
    ?>
      <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content p-2">
            <div class="modal-header" style="border-bottom:0 ;">
              <p class="mb-0" style="font-size:20px ;font-weight:bold">Dislike</p>
              <a href='home'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
            </div>
            <div class="modal-body pb-0">
              <p class="mb-1" style="font-size:18px">Something went wrong</p>
            </div>
            <div class="modal-footer" style="border-top:0 ;">

              <a href="home" class="col-example7 text-center">Ok</a>
            </div>
          </div>
        </div>
      </div>
      <script type="text/javascript">
        //window.location.href = 'home';
      </script>
    <?php
    }
    break;
  case 'read':
    $update_data = [
      'status' => 0
    ];
    $where = [
      'user_id' => $_GET['user'],
      'notification_id' => $_GET['note']
    ];
    $delete_data = $this->UpdateData1('notification', $update_data, $where);
    if ($delete_data) {
    ?>
      <script type="text/javascript">
        window.location.href = '<?php echo $_GET['server'] ?>';
      </script>
    <?php
    } else {
    ?>
      <script type="text/javascript">
        window.location.href = '<?php echo $_GET['server'] ?>';
      </script>
    <?php
    }
    break;
  case 'clear':
    $delete_data = $this->DeleteData('notification', $_GET['user']);
    if ($delete_data) {
    ?>
      <script type="text/javascript">
        window.location.href = '<?php echo $_GET['server'] ?>';
      </script>
    <?php
    } else {
    ?>
      <script type="text/javascript">
        window.location.href = '<?php echo $_GET['server'] ?>';
      </script>
      <?php
    }
    break;
  case 'toptheme':
    $selectData = $this->toptheme();
    $topthemes = $selectData['Data'];
    $missions = array();
    foreach ($topthemes as $toptheme) {
      $selectData = $this->selecttoptheme($toptheme->theme_id);
      $missions = $selectData['Data'];
    }
  case 'mostranked':
    $selectData = $this->toptheme();
    $topthemes = $selectData['Data'];
    $missions = array();
    foreach ($topthemes as $toptheme) {
      $selectData = $this->selecttoptheme($toptheme->theme_id);
      $missions = $selectData['Data'];
    }
  case 'topfav':
    $selectData = $this->toptheme();
    $topthemes = $selectData['Data'];
    $missions = array();
    foreach ($topthemes as $toptheme) {
      $selectData = $this->selecttoptheme($toptheme->theme_id);
      $missions = $selectData['Data'];
    }
  case 'random':
    $selectData = $this->toptheme();
    $topthemes = $selectData['Data'];
    $missions = array();
    foreach ($topthemes as $toptheme) {
      $selectData = $this->selecttoptheme($toptheme->theme_id);
      $missions = $selectData['Data'];
    }
  default:
    if (isset($_POST['skill']) || isset($_POST['theme']) || isset($_POST['city']) || isset($_POST['country']) || isset($_POST['search']) || isset($_POST['sort']) || isset($_GET['pag'])) {
      $skill = array();
      $theme = array();
      $city = array();
      $country = array();
      $where = array();
      $order = 'Oldest';
      if (isset($_POST['search'])) {
        $search = $_POST['search'];
        $where = [
          'mission.title' => $search,
          'city.name' => $search,
          'mission_theme.title' => $search,
          'mission.short_description' => $search,
          'mission.organization_name' => $search
        ];
      }
      if (isset($_POST['country']) && $_POST['country'] != 'none') {
        $country = [
          'country.name' => $_POST['country']
        ];
      }
      if (isset($_POST['skill'])) {
        foreach ($_POST['skill'] as $item) {
          $skill[] = $item;
        }
      }
      if (isset($_POST['theme'])) {
        foreach ($_POST['theme'] as $item) {
          $theme[] = $item;
        }
      }
      if (isset($_POST['city'])) {
        foreach ($_POST['city'] as $item) {
          $city[] = $item;
        }
      }
      if (isset($_POST['sort'])) {
        $order = $_POST['sort'];
      }

      $selectData = $this->SelectData3($postno, $pagecount, $order, $user_id, $where, 'kdn', $country, $city, $theme, $skill);
      $missions = $selectData['Data'];
      $row = $selectData['Row'];
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
              'mission_id' => $_POST['m_id']
            ];
            $abc = 'tatva123';
            $insertEx = $this->InsertData('mission_invite', $data);
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
              $mail->Subject = 'Invited';
              $mail->Body    = 'You gets invitation by user ' . $link . '';
              $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
              if (!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
              } else { ?>
                <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content p-2">
                      <div class="modal-header" style="border-bottom:0 ;">
                        <p class="mb-0" style="font-size:20px ;font-weight:bold">Invite</p>
                        <a href='home'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
                      </div>
                      <div class="modal-body pb-0">
                        <p class="mb-1" style="font-size:18px">message sent to your email.</p>
                      </div>
                      <div class="modal-footer" style="border-top:0 ;">

                        <a href="home" class="col-example7 text-center">Ok</a>
                      </div>
                    </div>
                  </div>
                </div>
                <script type="text/javascript">
                  //window.location.href = 'home';
                </script>
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
                      <a href="home" src="mvc/Assets/images/cancel1.png"></a>
                    </div>
                    <div class="modal-body pb-0">
                      <p class="mb-1" style="font-size:18px">something went wrong!</p>
                    </div>
                    <div class="modal-footer" style="border-top:0 ;">

                      <a href="home" class="col-example7 text-center">Ok</a>
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
                  <a href='home'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
                </div>
                <div class="modal-body pb-0">
                  <p class="mb-1" style="font-size:18px">User not found.</p>
                </div>
                <div class="modal-footer" style="border-top:0 ;">

                  <a href="home" class="col-example7 text-center">Ok</a>
                </div>
              </div>
            </div>
          </div>
          <script type="text/javascript">
            //window.location.href = 'home';
          </script>
        <?php }
      }
      if ($email == null || $email == '') { ?>
        <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-2">
              <div class="modal-header" style="border-bottom:0 ;">
                <p class="mb-0" style="font-size:20px ;font-weight:bold">Invite</p>
                <a href='home'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
              </div>
              <div class="modal-body pb-0">
                <p class="mb-1" style="font-size:18px">please enter email.</p>
              </div>
              <div class="modal-footer" style="border-top:0 ;">

                <a href="home" class="col-example7 text-center">Ok</a>
              </div>
            </div>
          </div>
        </div>
      <?php }
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
                <a href='home'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
              </div>
              <div class="modal-body pb-0">
                <p class="mb-1" style="font-size:18px">message sent</p>
              </div>
              <div class="modal-footer" style="border-top:0 ;">

                <a href="home" class="col-example7 text-center">Ok</a>
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
                <a href='home'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
              </div>
              <div class="modal-body pb-0">
                <p class="mb-1" style="font-size:18px">Something went wrong</p>
              </div>
              <div class="modal-footer" style="border-top:0 ;">

                <a href="home" class="col-example7 text-center">Ok</a>
              </div>
            </div>
          </div>
        </div>
<?php
      }
    }
    include 'mvc/Views/home/header1.php';
    include 'mvc/Views/home/header2.php';
    include 'mvc/Views/home/home.php';
    break;
}

include 'mvc/Views/home/footer.php';
?>