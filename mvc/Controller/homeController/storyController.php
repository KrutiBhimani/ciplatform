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
  if ($insertEx['Code']) {
  ?>
    <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-2">
          <div class="modal-header" style="border-bottom:0 ;">
            <p class="mb-0" style="font-size:20px ;font-weight:bold">Contact</p>
            <a href='stories'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
          </div>
          <div class="modal-body pb-0">
            <p class="mb-1" style="font-size:18px">message sent</p>
          </div>
          <div class="modal-footer" style="border-top:0 ;">

            <a href="stories" class="col-example7 text-center">Ok</a>
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
            <a href='stories'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
          </div>
          <div class="modal-body pb-0">
            <p class="mb-1" style="font-size:18px">Something went wrong</p>
          </div>
          <div class="modal-footer" style="border-top:0 ;">

            <a href="stories" class="col-example7 text-center">Ok</a>
          </div>
        </div>
      </div>
    </div>
  <?php
  }
}
if (isset($_POST['notification'])) {

  $note = $_POST['note'];
  $selectData = $this->SelectNote($note);
  $notes = $selectData['Data']; ?>
<?php } else {
  $selectData = $this->SelectNote();
  $notes = $selectData['Data'];
}
include 'mvc/Views/home/header.php';
include 'mvc/Views/home/header1.php';
include 'mvc/Views/home/story.php';
include 'mvc/Views/home/footer.php';
?>