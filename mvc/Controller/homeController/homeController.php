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

include 'Views/home/header.php';
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
?>
            <script type="text/javascript">
                window.location.href = 'home';
            </script>
        <?php
        } else {
        ?>
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
        ?>
            <script type="text/javascript">
                window.location.href = 'home';
            </script>
        <?php
        } else {
        ?>
            <script type="text/javascript">
                window.location.href = 'home';
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
        ?>
            <script type="text/javascript">
                window.location.href = 'home';
            </script>
        <?php
        } else {
        ?>
            <script type="text/javascript">
                window.location.href = 'home';
            </script>
            <?php
        }
        break;
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
            // foreach ($_POST['invite'] as $item) {
            //     $data = [
            //         'to_user_id' => $item,
            //         'from_user_id' => $user_id,
            //         'mission_id' => $_POST['m_id']
            //     ];
            //     $this->InsertData('mission_invite', $data);
            // }
            $email = $_POST['email'];
            $inviteEx = $this->ResetPass($email);
            if ($inviteEx['Code']) {
                $_SESSION['invite_data'] = $inviteEx['Data'];
                if ($_SESSION['invite_data']) {
                    $link = "<a href='http://localhost/ci-platform/mvc/login'>Click To Get Started</a>";
                    require '../mvc/Libraries/PHPMailer/PHPMailerAutoload.php';
                    require_once('../mvc/Libraries/PHPMailer/src/PHPMailer.php');
                    require_once('../mvc/Libraries/PHPMailer/src/Exception.php');
                    require_once('../mvc/Libraries/PHPMailer/src/OAuthTokenProvider.php');
                    require_once('../mvc/Libraries/PHPMailer/src/OAuth.php');
                    require_once('../mvc/Libraries/PHPMailer/src/POP3.php');
                    require_once('../mvc/Libraries/PHPMailer/src/SMTP.php');
                    if (empty($errors)) {
                        $data = [
                            'to_user_id' => $_SESSION['invite_data']->user_id,
                            'from_user_id' => $user_id,
                            'mission_id' => $_POST['m_id']
                        ];
                        $insertEx = $this->InsertData('mission_invite', $data);
                        $mail = new PHPMailer\PHPMailer\PHPMailer(true); //defaults to using php "mail()"; the true param means it will throw exceptions on errors, which we need to catch
                        try {
                            // $mail->SMTPDebug = 1;                               // Enable verbose debug output
                            $mail->isSMTP();                                    // Set mailer to use SMTP
                            $mail->Host = 'smtp.office365.com'; // Specify main and backup SMTP servers
                            $mail->SMTPAuth = true;                             // Enable SMTP authentication
                            $mail->Username = 'krutibhimani11@outlook.com';           // SMTP username
                            $mail->Password = 'kruti321';                       // SMTP password
                            $mail->SMTPSecure = 'tls';                          // Enable TLS encryption, `ssl` also accepted
                            $mail->Port = 587;                                  // TCP port to connect, tls=587, ssl=465
                            $mail->From = 'krutibhimani11@outlook.com';
                            $mail->FromName = 'kruti bhimani';
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
                                <script type="text/javascript">
                                    alert("message sent to your email.");
                                    window.location.href = 'home';
                                </script>
                    <?php }
                            $errors[] = "Send mail sucsessfully";
                        } catch (Exception $e) {
                            $errors[] = $e->getMessage(); //Boring error messages from anything else!
                        }
                    }
                } else { ?>
                    <script type="text/javascript">
                        alert("user not found");
                        window.location.href = 'forgot';
                    </script>
<?php }
            }
        }
        if (isset($_POST['contact'])) {
            $insert_data = [
                'user_id' => $user->user_id,
                'subject' => $_POST['subject'],
                'message' => $_POST['message']
            ];
            $insertEx = $this->InsertData('contact', $insert_data);
        }
        include 'Views/home/header1.php';
        include 'Views/home/header2.php';
        include 'Views/home/home.php';
        break;
}

include 'Views/home/footer.php';
?>