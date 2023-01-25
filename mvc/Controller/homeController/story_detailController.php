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
}
if (isset($_POST['inviteuser'])) {
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
                    'story_id' => $_POST['s_id']
                ];
                $insertEx = $this->InsertData('story_invite', $data);
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
                    } else {
    ?>
                        <script type="text/javascript">
                            alert("message sent to your email.");
                            window.location.href = 'story_detail?key=<?php $id = $_POST['s_id'];
                                                        $salt = "SECRET_STUFF";
                                                        $encrypted_id = base64_encode($id . $salt);
                                                        echo $encrypted_id; ?>';
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
                window.location.href = 'story_detail?key=<?php $id = $_POST['s_id'];
                                                        $salt = "SECRET_STUFF";
                                                        $encrypted_id = base64_encode($id . $salt);
                                                        echo $encrypted_id; ?>';
            </script>
<?php }
    }
}
include 'Views/home/header.php';
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
include 'Views/home/header1.php';
include 'Views/home/story_detail.php';
include 'Views/home/footer.php';
?>