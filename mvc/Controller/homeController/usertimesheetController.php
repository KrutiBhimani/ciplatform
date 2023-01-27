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
$selectData = $this->SelectData3(0, 0, 'Newest');
$missions = $selectData['Data'];
$selectData = $this->timesheethour($user_id);
$hours = $selectData['Data'];
$selectData = $this->timesheetgoal($user_id);
$goals = $selectData['Data'];
if (isset($_POST['add_hours'])) {
    $time = $_POST['h'] . ':' . $_POST['m'] . ':00';
    $insert_data = [
        'user_id' => $user_id,
        'mission_id' => $_POST['mission_id'],
        'notes' => $_POST['notes'],
        'date_volunteered' => $_POST['date_volunteered'],
        'time' => $time
    ];
    $insertEx = $this->InsertData('timesheet', $insert_data);
}
if (isset($_POST['add_goals'])) {
    $insert_data = [
        'user_id' => $user_id,
        'mission_id' => $_POST['mission_id'],
        'notes' => $_POST['notes'],
        'date_volunteered' => $_POST['date_volunteered'],
        'action' => $_POST['action']
    ];
    $insertEx = $this->InsertData('timesheet', $insert_data);
}
if (isset($_POST['edit_hours'])) {
    $time = $_POST['h'] . ':' . $_POST['m'] . ':00';
    $update_data = [
        'mission_id' => $_POST['mission_id'],
        'notes' => $_POST['notes'],
        'date_volunteered' => $_POST['date_volunteered'],
        'time' => $time,
        'updated_at' => date("Y-m-d h:i:s")
    ];
    $where = [
        'user_id' => $user_id,
        'timesheet_id' => $_POST['timesheet_id']
    ];
    $upd_data = $this->UpdateData1('timesheet', $update_data, $where);
    if ($upd_data) {
    ?>
        <script type="text/javascript">
            window.location.href = 'user_timesheet';
        </script>
    <?php
    }
}
if (isset($_POST['edit_goals'])) {
    $update_data = [
        'mission_id' => $_POST['mission_id'],
        'notes' => $_POST['notes'],
        'date_volunteered' => $_POST['date_volunteered'],
        'action' => $_POST['action'],
        'updated_at' => date("Y-m-d h:i:s")
    ];
    $where = [
        'user_id' => $user_id,
        'timesheet_id' => $_POST['timesheet_id']
    ];
    $upd_data = $this->UpdateData1('timesheet', $update_data, $where);
    if ($upd_data) {
    ?>
        <script type="text/javascript">
            window.location.href = 'user_timesheet';
        </script>
    <?php
    }
}
if (isset($_POST['delete_hours'])) {
    $update_data = [
        'deleted_at' => date("Y-m-d h:i:s")
    ];
    $where = [
        'user_id' => $user_id,
        'timesheet_id' => $_POST['timesheet_id']
    ];
    $upd_data = $this->UpdateData1('timesheet', $update_data, $where);
    if ($upd_data) {
    ?>
        <script type="text/javascript">
            window.location.href = 'user_timesheet';
        </script>
<?php
    }
}
include 'mvc/Views/home/header.php';
include 'mvc/Views/home/header1.php';
include 'mvc/Views/home/user_timesheet.php';
include 'mvc/Views/home/footer.php';
?>