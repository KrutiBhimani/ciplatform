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
                }
                $selectData = $this->SelectBanner();
                $banners = $selectData['Data'];
                include 'Views/header.php';
                include 'Views/resetpsd.php';
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