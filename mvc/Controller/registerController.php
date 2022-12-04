<?php if (isset($_POST['register'])) {
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    if ($password == $password2) {
        $insert_data = [
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
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
}
$selectData = $this->SelectBanner();
$banners = $selectData['Data'];
include 'Views/header.php';
include 'Views/registration.php';
include 'Views/footer.php';
?>