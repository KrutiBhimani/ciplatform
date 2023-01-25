<?php if (!isset($_SESSION['user_data'])) {
?>
    <script type="text/javascript">
        window.location.href = 'login';
    </script>
<?php
}
$user_id = $_SESSION['user_data']->user_id;
$row = 4;
$where = [
    'user_id' => $user_id
];
$selectData = $this->SelectData1('user', $where);
$user = $selectData['Data'];
$pagecount = 9;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else
    $page = 1;
if ($page == "" || $page == 1) {
    $postno = 0;
} else
    $postno = ($page * $pagecount) - $pagecount;
$selectData1 = $this->Story();
$cnts = $selectData1['Row'];
$cnt = ceil($cnts / $pagecount);
$selectData = $this->Story($postno, $pagecount);
$stories = $selectData['Data'];
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
include 'Views/home/story.php';
include 'Views/home/footer.php';
?>