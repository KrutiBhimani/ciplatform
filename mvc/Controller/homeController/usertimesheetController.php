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
$row = 0;
$selectData = $this->SelectData1('user', $where);
$user = $selectData['Data'];
if (isset($_POST['contact'])) {
    $insert_data = [
        'user_id' => $user->user_id,
        'subject' => $_POST['subject'],
        'message' => $_POST['message']
    ];
    $insertEx = $this->InsertData('contact', $insert_data);
}
include 'Views/home/header.php';
include 'Views/home/header1.php';
include 'Views/home/user_timesheet.php';
include 'Views/home/footer.php';
?>