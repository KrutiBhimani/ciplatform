<?php 
$admin_id = $_SESSION['admin_data']->admin_id;
$where = [
    'admin_id' => $admin_id
];
$selectData = $this->SelectData1('admin', $where);
$admin = $selectData['Data'];
include 'Views/header.php';
include 'Views/admin/header1.php';
include 'Views/admin/timesheet.php';
include 'Views/footer.php';
?>