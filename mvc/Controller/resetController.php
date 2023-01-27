<?php if ($_GET['key'] && $_GET['t']) {
    $email = $_GET['key'];
    $token = $_GET['t'];
    $hourEx = $this->CheckHour($token);
    if ($hourEx['Code']) {
        $created_at = $hourEx['Data']->created_at;
        $start_date = new DateTime($created_at);
        $end_date = new DateTime(date("Y-m-d H:i:s"));
        $interval = $start_date->diff($end_date);
        $min = $interval->format('%i');
        $hour = $interval->format('%h');
        $mon = $interval->format('%m');
        $day = $interval->format('%d');
        $year = $interval->format('%y');
        $diff = $year + $mon + $day * 24 * 60 + $hour * 60 + $min;
        if ($diff <= 240) {
            if (isset($_SESSION['reset_data'])) {
                $email = $_SESSION['reset_data']->email;
                if (isset($_POST['reset'])) {
                    $password = mysqli_real_escape_string($this->connection, $_POST['password']);
                    $password2 = mysqli_real_escape_string($this->connection, $_POST['password2']);
                    if ($password == $password2) {
                        $salt = "SeCrEtStUfFfOrPaSsWoRd";
                        $password = base64_encode($password . $salt);
                        $changeEx = $this->UpdatePass($email, $password);
                        if ($changeEx['Code']) {
?>
                            <script type="text/javascript">
                                alert("<?php echo $changeEx['Message'] ?>");
                                window.location.href = 'login';
                            </script>
                        <?php
                        } else {
                        ?>
                            <script type="text/javascript">
                                alert("<?php echo $changeEx['Message'] ?>");
                                window.location.href = 'register';
                            </script>
                <?php
                        }
                    }
                } ?>
                <script>
                    function validateForm() {
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
                include 'mvc/Views/resetpsd.php';
                include 'mvc/Views/footer.php';
            }
        } else { ?>
            <script type="text/javascript">
                alert("link expired");
                window.location.href = 'forgot';
            </script>
    <?php }
    }
} else { ?>
    <script type="text/javascript">
        window.location.href = 'forgot';
    </script>
<?php }
?>