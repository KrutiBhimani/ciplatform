<?php if (!isset($_SESSION['user_data'])) {
?>
    <script type="text/javascript">
        window.location.href = 'login';
    </script>
<?php
}
include 'Views/header.php';
include 'Views/home/header1.php';
include 'Views/home/header2.php';
include 'Views/home/home.php';
include 'Views/home/footer.php';
?>