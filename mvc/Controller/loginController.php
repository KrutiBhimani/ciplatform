<?php

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($this->connection, $_POST['email']);
    $password = mysqli_real_escape_string($this->connection, $_POST['password']);

    $loginEx = $this->LoginData($email, $password);
    if ($loginEx['Code']) {
        $_SESSION['user_data'] = $loginEx['Data1'];
        $_SESSION['admin_data'] = $loginEx['Data2'];
        if ($_SESSION['user_data']) {
?>
            <script type="text/javascript">
                window.location.href = 'home';
            </script>
        <?php
        } else if ($_SESSION['admin_data']) {
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
}
$selectData = $this->SelectBanner();
$banners = $selectData['Data'];
include 'Views/header.php';
include 'Views/login.php';

?>