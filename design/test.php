<?php
include "db.php";
session_start();
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $email = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);
    $flag = 0;
    $query1 = "SELECT * FROM user WHERE email = '$email'";
    $result1 = mysqli_query($connection, $query1);
    while ($row = mysqli_fetch_assoc($result1)) {
        $id = $row['user_id'];
        $db_email = $row['email'];
        $user_password = $row['password'];
        $user_fname = $row['first_name'];
        $user_lname = $row['last_name'];
        $user_image = $row['avatar'];
        if ($email == $db_email && $password == $user_password) {
            $flag = 1;
            $_SESSION['user_id'] = $id;
            $_SESSION['email'] = $db_email;
            $_SESSION['password'] = $user_password;
            header('Location:../design/home.php');
        }
    }
    $query2 = "SELECT * FROM admin WHERE email = '$email'";
    $result2 = mysqli_query($connection, $query2);
    while ($row = mysqli_fetch_assoc($result2)) {
      $id = $row['admin_id'];
      $db_email = $row['email'];
      $user_password = $row['password'];
      $user_fname = $row['first_name'];
      $user_lname = $row['last_name'];
      $admin_image = $row['avatar'];
      if ($email == $db_email && $password == $user_password) {
          $flag = 1;
          $_SESSION['admin_id'] = $id;
          $_SESSION['email'] = $db_email;
          $_SESSION['password'] = $user_password;
          header('Location:../design/adminpanel.php');
      }
  }
    if ($flag == 0)
    {
        header('Location:../design/login.php');
    }
}
?>
<?php
include "db.php";
//session_start();
if (isset($_POST['register'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    $phone_number = $_POST['phone_number'];
    if (!empty($email) && !empty($password1) && !empty($password2) && !empty($phone_number)) 
    {
        $phone_number = mysqli_real_escape_string($connection, $phone_number);
        $password1 = mysqli_real_escape_string($connection, $password1);
        $email = mysqli_real_escape_string($connection, $email);
        $first_name = mysqli_real_escape_string($connection, $first_name);
        $last_name = mysqli_real_escape_string($connection, $last_name);
        $query = "INSERT INTO user(first_name,last_name,email,password,phone_number,city_id,country_id) VALUES ('$first_name','$last_name','$email','$password1','$phone_number',1,1)";
        $result = mysqli_query($connection, $query);
        if (!$result)
        {
            die("QUERY FAILED" . mysqli_error($connection));
            header('Location:../design/registration.php');
        }
        else
        {
            header('Location:../design/home.php');
        }
    }
    else
    {
        header('Location:../design/registration.php');
    }
}?>
<?php
include "db.php";
if(isset($_POST['reset']) && $_POST['email'])
{
  $email = $_POST['email'];
  $select=mysqli_query($connection, "select email,password from user where email='$email'");
  if(mysqli_num_rows($select)==1)
  {
    $created_at = date("Y/m/d H:i:s");
    $token = md5(2418*2);
    $addKey = substr(md5(uniqid(rand(),1)),3,10);
    $token = $token . $addKey;
    while($row=mysqli_fetch_array($select))
    {
      $email=$row['email'];
      $password=$row['password'];
    }
    $link="<a href='http://localhost/ci-platform/design/resetpsd.php?key=".$email."&t=".$token."'>Click To Reset password</a>";
    require 'PHPMailerAutoload.php';
    require_once('../PHPMailer/src/PHPMailer.php');
    require_once('../PHPMailer/src/Exception.php');
    require_once('../PHPMailer/src/OAuthTokenProvider.php');
    require_once('../PHPMailer/src/OAuth.php');
    require_once('../PHPMailer/src/POP3.php');
    require_once('../PHPMailer/src/SMTP.php');
    if (empty($errors)) 
    {
     mysqli_query($connection,
     "INSERT INTO `password_reset` (`email`, `token`, `created_at`) VALUES ('$email', '$token', '$created_at');");
      $mail = new PHPMailer\PHPMailer\PHPMailer(true); //defaults to using php "mail()"; the true param means it will throw exceptions on errors, which we need to catch
      try 
      {
        //$mail->SMTPDebug = 1;                               // Enable verbose debug output
        $mail->isSMTP();                                    // Set mailer to use SMTP
        $mail->Host = 'smtp.office365.com'; // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                             // Enable SMTP authentication
        $mail->Username = 'krutipatel5773@outlook.com';           // SMTP username
        $mail->Password = 'kruti9607';                       // SMTP password
        $mail->SMTPSecure = 'tls';                          // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                  // TCP port to connect, tls=587, ssl=465
        $mail->From = 'krutipatel5773@outlook.com';
        $mail->FromName = 'kruti bhimani';
        $mail->addAddress($email);     // Add a recipient
        $mail->addReplyTo($email);
        $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
        $mail->isHTML(false);                                  // Set email format to HTML
        $mail->Subject = 'Reset Password';
        $mail->Body    = 'Click On This Link to Reset Password '.$link.'';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        if(!$mail->send())
        {
          echo 'Message could not be sent.';
          echo 'Mailer Error: ' . $mail->ErrorInfo;
        } 
        else 
        {
          include "forgetpsd.php";
          echo '<script>alert("Message has been sent")</script>';
        }
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
  }	
  else
  {
    include "forgetpsd.php";
    echo '<script>alert("user not found")</script>';
  }
}
?>
<?php
include('db.php');
if(isset($_POST['change']) && $_POST['email'] && $_POST['password1'])
{
  $email=$_POST['email'];
  $pass1=$_POST['password1'];
  $select=mysqli_query($connection, "update user set password='$pass1' where email='$email'");
  header('Location:../design/login.php');
}
?>
