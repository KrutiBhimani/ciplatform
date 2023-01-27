<?php if (isset($_POST['register'])) {
  $password = $_POST['password'];
  $password2 = $_POST['password2'];
  if ($password == $password2) {
    $salt = "SeCrEtStUfFfOrPaSsWoRd";
    $encrypted_password = base64_encode($password . $salt);
    $insert_data = [
      'first_name' => $_POST['first_name'],
      'last_name' => $_POST['last_name'],
      'email' => $_POST['email'],
      'password' => $encrypted_password,
      'phone_number' => $_POST['phone_number'],
      'city_id' => 1,
      'country_id' => 1
    ];
    $insertEx = $this->InsertData('user', $insert_data);
    if ($insertEx['Code']) {
?>
      <script type="text/javascript">
        alert("<?php echo 'your registration is successfull!' ?>");
        window.location.href = 'login';
      </script>
    <?php
    } else {
    ?>
      <script type="text/javascript">
        alert("<?php echo 'please try again!' ?>");
        window.location.href = 'register';
      </script>
<?php
    }
  }
} ?>
<script>
  function validateForm() {
    let x = document.forms["myForm"]["phone_number"].value;
    if (x == "") {
      document.getElementById("errorpn").innerHTML = "Phone number is required";
      return false;
    }
    let y = document.forms["myForm"]["email"].value;
    if (y == "") {
      document.getElementById("errorea").innerHTML = "Email Address is required";
      return false;
    }
    let z = document.forms["myForm"]["password"].value;
    if (z == "") {
      document.getElementById("errorp1").innerHTML = "Password is required";
      return false;
    }
    let a = document.forms["myForm"]["password2"].value;
    if (a == "") {
      document.getElementById("errorp2").innerHTML = "Confirm password is required";
      return false;
    }
    if (a != z) {
      document.getElementById("errorp2").innerHTML = "Password and confirm password need to be same ";
      return false;
    }
  }
</script>
<?php
$selectData = $this->SelectBanner();
$banners = $selectData['Data'];
include 'mvc/Views/header.php';
include 'mvc/Views/registration.php';
include 'mvc/Views/footer.php';
?>