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
$selectData = $this->SelectNote();
$notes = $selectData['Data'];
if (isset($_POST['contact'])) {
  $insert_data = [
    'user_id' => $user->user_id,
    'subject' => $_POST['subject'],
    'message' => $_POST['message']
  ];
  $insertEx = $this->InsertData('contact', $insert_data);
  if ($insertEx['Code']) {
  ?>
    <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-2">
          <div class="modal-header" style="border-bottom:0 ;">
            <p class="mb-0" style="font-size:20px ;font-weight:bold">Contact</p>
            <a href='user_timesheet'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
          </div>
          <div class="modal-body pb-0">
            <p class="mb-1" style="font-size:18px">message sent</p>
          </div>
          <div class="modal-footer" style="border-top:0 ;">

            <a href="user_timesheet" class="col-example7 text-center">Ok</a>
          </div>
        </div>
      </div>
    </div>
  <?php
  } else {
  ?>
    <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-2">
          <div class="modal-header" style="border-bottom:0 ;">
            <p class="mb-0" style="font-size:20px ;font-weight:bold">Contact</p>
            <a href='user_timesheet'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
          </div>
          <div class="modal-body pb-0">
            <p class="mb-1" style="font-size:18px">Something went wrong</p>
          </div>
          <div class="modal-footer" style="border-top:0 ;">

            <a href="user_timesheet" class="col-example7 text-center">Ok</a>
          </div>
        </div>
      </div>
    </div>
  <?php
  }
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
  if ($insertEx['Code']) {
  ?>
    <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-2">
          <div class="modal-header" style="border-bottom:0 ;">
            <p class="mb-0" style="font-size:20px ;font-weight:bold">Hours</p>
            <a href='user_timesheet'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
          </div>
          <div class="modal-body pb-0">
            <p class="mb-1" style="font-size:18px">Hours added successfully</p>
          </div>
          <div class="modal-footer" style="border-top:0 ;">

            <a href="user_timesheet" class="col-example7 text-center">Ok</a>
          </div>
        </div>
      </div>
    </div>
  <?php
  } else {
  ?>
    <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-2">
          <div class="modal-header" style="border-bottom:0 ;">
            <p class="mb-0" style="font-size:20px ;font-weight:bold">Add Hours</p>
            <a href='user_timesheet'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
          </div>
          <div class="modal-body pb-0">
            <p class="mb-1" style="font-size:18px">Something went wrong</p>
          </div>
          <div class="modal-footer" style="border-top:0 ;">

            <a href="user_timesheet" class="col-example7 text-center">Ok</a>
          </div>
        </div>
      </div>
    </div>
  <?php
  }
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
  if ($insertEx['Code']) {
  ?>
    <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-2">
          <div class="modal-header" style="border-bottom:0 ;">
            <p class="mb-0" style="font-size:20px ;font-weight:bold">Goals</p>
            <a href='user_timesheet'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
          </div>
          <div class="modal-body pb-0">
            <p class="mb-1" style="font-size:18px">Goals added successfully</p>
          </div>
          <div class="modal-footer" style="border-top:0 ;">

            <a href="user_timesheet" class="col-example7 text-center">Ok</a>
          </div>
        </div>
      </div>
    </div>
  <?php
  } else {
  ?>
    <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-2">
          <div class="modal-header" style="border-bottom:0 ;">
            <p class="mb-0" style="font-size:20px ;font-weight:bold">Add Goals</p>
            <a href='user_timesheet'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
          </div>
          <div class="modal-body pb-0">
            <p class="mb-1" style="font-size:18px">Something went wrong</p>
          </div>
          <div class="modal-footer" style="border-top:0 ;">

            <a href="user_timesheet" class="col-example7 text-center">Ok</a>
          </div>
        </div>
      </div>
    </div>
  <?php
  }
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
    <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-2">
          <div class="modal-header" style="border-bottom:0 ;">
            <p class="mb-0" style="font-size:20px ;font-weight:bold">Hours</p>
            <a href='user_timesheet'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
          </div>
          <div class="modal-body pb-0">
            <p class="mb-1" style="font-size:18px">Hours updated successfully</p>
          </div>
          <div class="modal-footer" style="border-top:0 ;">

            <a href="user_timesheet" class="col-example7 text-center">Ok</a>
          </div>
        </div>
      </div>
    </div>
  <?php
  } else {
  ?>
    <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-2">
          <div class="modal-header" style="border-bottom:0 ;">
            <p class="mb-0" style="font-size:20px ;font-weight:bold">Edit Hours</p>
            <a href='user_timesheet'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
          </div>
          <div class="modal-body pb-0">
            <p class="mb-1" style="font-size:18px">Something went wrong</p>
          </div>
          <div class="modal-footer" style="border-top:0 ;">

            <a href="user_timesheet" class="col-example7 text-center">Ok</a>
          </div>
        </div>
      </div>
    </div>
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
    <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-2">
          <div class="modal-header" style="border-bottom:0 ;">
            <p class="mb-0" style="font-size:20px ;font-weight:bold">Goals</p>
            <a href='user_timesheet'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
          </div>
          <div class="modal-body pb-0">
            <p class="mb-1" style="font-size:18px">Goals updated successfully</p>
          </div>
          <div class="modal-footer" style="border-top:0 ;">

            <a href="user_timesheet" class="col-example7 text-center">Ok</a>
          </div>
        </div>
      </div>
    </div>
  <?php
  } else {
  ?>
    <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-2">
          <div class="modal-header" style="border-bottom:0 ;">
            <p class="mb-0" style="font-size:20px ;font-weight:bold">Edit Goals</p>
            <a href='user_timesheet'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
          </div>
          <div class="modal-body pb-0">
            <p class="mb-1" style="font-size:18px">Something went wrong</p>
          </div>
          <div class="modal-footer" style="border-top:0 ;">

            <a href="user_timesheet" class="col-example7 text-center">Ok</a>
          </div>
        </div>
      </div>
    </div>
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
    <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-2">
          <div class="modal-header" style="border-bottom:0 ;">
            <p class="mb-0" style="font-size:20px ;font-weight:bold">Delete</p>
            <a href='user_timesheet'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
          </div>
          <div class="modal-body pb-0">
            <p class="mb-1" style="font-size:18px">Data deleted successfully</p>
          </div>
          <div class="modal-footer" style="border-top:0 ;">

            <a href="user_timesheet" class="col-example7 text-center">Ok</a>
          </div>
        </div>
      </div>
    </div>
  <?php
  } else {
  ?>
    <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-2">
          <div class="modal-header" style="border-bottom:0 ;">
            <p class="mb-0" style="font-size:20px ;font-weight:bold">Delete</p>
            <a href='user_timesheet'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
          </div>
          <div class="modal-body pb-0">
            <p class="mb-1" style="font-size:18px">Something went wrong</p>
          </div>
          <div class="modal-footer" style="border-top:0 ;">

            <a href="user_timesheet" class="col-example7 text-center">Ok</a>
          </div>
        </div>
      </div>
    </div>
<?php
  }
}
include 'mvc/Views/home/header.php';
include 'mvc/Views/home/header1.php';
include 'mvc/Views/home/user_timesheet.php';
include 'mvc/Views/home/footer.php';
?>