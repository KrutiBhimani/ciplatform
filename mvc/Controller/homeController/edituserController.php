<?php if (!isset($_SESSION['user_data'])) {
?>
    <script type="text/javascript">
        window.location.href = 'login';
    </script>
<?php
}
$user_id = $_SESSION['user_data']->user_id;
$where = [
    'user_id' => $user_id
];
$selectData = $this->SelectData1('user', $where);
$user = $selectData['Data'];
include 'Views/header.php';
include 'Views/home/header1.php';
include 'Views/home/edit_user.php';
include 'Views/home/footer.php';
?>