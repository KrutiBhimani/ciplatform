<?php if (isset($_POST['forgot'])) {
    $email = mysqli_real_escape_string($this->connection, $_POST['email']);
    $resetEx = $this->ResetPass($email);
    if ($resetEx['Code']) {
        $_SESSION['reset_data'] = $resetEx['Data'];
        $token = md5(2418 * 2) . substr(md5(uniqid(rand(), 1)), 3, 10);
        if ($_SESSION['reset_data']) {
            $link = "<a href='http://localhost/ci-platform/mvc/reset?key=" . $_SESSION['reset_data']->email . "&t=" . $token . "'>Click To Reset password</a>";
            require '../mvc/Libraries/PHPMailer/PHPMailerAutoload.php';
            require_once('../mvc/Libraries/PHPMailer/src/PHPMailer.php');
            require_once('../mvc/Libraries/PHPMailer/src/Exception.php');
            require_once('../mvc/Libraries/PHPMailer/src/OAuthTokenProvider.php');
            require_once('../mvc/Libraries/PHPMailer/src/OAuth.php');
            require_once('../mvc/Libraries/PHPMailer/src/POP3.php');
            require_once('../mvc/Libraries/PHPMailer/src/SMTP.php');
            if (empty($errors)) {
                $insert_data = [
                    'email' => $_SESSION['reset_data']->email,
                    'created_at' => date("Y/m/d H:i:s"),
                    'token' => $token
                ];
                $insertEx = $this->InsertData('password_reset', $insert_data);
                $mail = new PHPMailer\PHPMailer\PHPMailer(true); //defaults to using php "mail()"; the true param means it will throw exceptions on errors, which we need to catch
                try {
                    $mail->SMTPDebug = 1;                               // Enable verbose debug output
                    $mail->isSMTP();                                    // Set mailer to use SMTP
                    $mail->Host = 'smtp.office365.com'; // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                             // Enable SMTP authentication
                    $mail->Username = 'krutibhimani11@outlook.com';           // SMTP username
                    $mail->Password = 'kruti123';                       // SMTP password
                    $mail->SMTPSecure = 'tls';                          // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = 587;                                  // TCP port to connect, tls=587, ssl=465
                    $mail->From = 'krutibhimani11@outlook.com';
                    $mail->FromName = 'kruti bhimani';
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
                        <script type="text/javascript">
                            alert("message sent to your email.");
                            window.location.href = 'forgot';
                        </script>
            <?php }
                    $errors[] = "Send mail sucsessfully";
                }
                // catch (phpmailerException $e) 
                // {
                //   $errors[] = $e->errorMessage(); //Pretty error messages from PHPMailer
                // } 
                catch (Exception $e) {
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
$selectData = $this->SelectBanner();
$banners = $selectData['Data'];
include 'Views/header.php';
include 'Views/forgotpsd.php';
include 'Views/footer.php';
?>