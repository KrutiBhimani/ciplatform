<?php if (!isset($_SESSION['user_data'])) {
  $row = 4;
  $where = [
    'slug' => 'policy'
  ];
  $selectData = $this->SelectData12('cms_page', $where);
  $pages = $selectData['Data'];
  echo '<!DOCTYPE html>';
  include 'mvc/Views/home/header.php';
  include 'mvc/Views/home/policy.php';
  include 'mvc/Views/footer.php';
} else {
  $user_id = $_SESSION['user_data']->user_id;
  $where = [
    'user_id' => $user_id
  ];
  $selectData = $this->SelectData1('user', $where);
  $user = $selectData['Data'];
  $selectData = $this->SelectNote();
  $notes = $selectData['Data'];
  $row = 4;
  $where = [
    'slug' => 'policy'
  ];
  $selectData = $this->SelectData12('cms_page', $where);
  $pages = $selectData['Data'];
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
              <a href='home'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
            </div>
            <div class="modal-body pb-0">
              <p class="mb-1" style="font-size:18px">message sent</p>
            </div>
            <div class="modal-footer" style="border-top:0 ;">

              <a href="policy" class="col-example7 text-center">Ok</a>
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
              <a href='home'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
            </div>
            <div class="modal-body pb-0">
              <p class="mb-1" style="font-size:18px">Something went wrong</p>
            </div>
            <div class="modal-footer" style="border-top:0 ;">

              <a href="policy" class="col-example7 text-center">Ok</a>
            </div>
          </div>
        </div>
      </div>
<?php
    }
  }
  echo '<!DOCTYPE html>';
  include 'mvc/Views/home/header.php';
  include 'mvc/Views/home/header1.php';
  include 'mvc/Views/home/policy.php';
  include 'mvc/Views/home/footer.php';
}

?>