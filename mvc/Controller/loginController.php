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
            <script type="text/javascript">
                window.location.href = 'home';
            </script>
        <?php
        }
        $_SESSION['admin_data'] = $loginEx['Data2'];
        if ($_SESSION['admin_data']) {
        ?>
            <script type="text/javascript">
                window.location.href = 'user';
            </script>
        <?php
        }
    } else {
        ?>
        <script type="text/javascript">
            alert("<?php echo $loginEx['Message'] ?>");
            window.location.href = 'login';
        </script>
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
include 'Views/header.php';
include 'Views/login.php';
include 'Views/footer.php';

?>