<?php if (!isset($_SESSION['user_data'])) {
?>
    <script type="text/javascript">
        window.location.href = 'login';
    </script>
<?php
}
include 'Views/header.php';
include 'Views/navbar1.php';
include 'Views/navbar2.php';
include 'Views/home.php';
?>