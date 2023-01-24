<?php if (!isset($_SESSION['admin_data'])) {
?>
    <script type="text/javascript">
        window.location.href = 'login';
    </script>
    <?php
}
$case = 6;
include 'Views/header.php';
$admin_id = $_SESSION['admin_data']->admin_id;
$where = [
    'admin_id' => $admin_id
];
$selectData = $this->SelectData1('admin', $where);
$admin = $selectData['Data'];
include 'Views/Admin/adminsidebar.php';
if (isset($_GET['source']))
    $source = $_GET['source'];
else
    $source = '';
switch ($source) {
    case 'edit_app':
        $encrypted_id = $_GET['edit'];
        $salt = "SECRET_STUFF";
        $decrypted_id_raw = base64_decode($encrypted_id);
        $decrypted_id = preg_replace(sprintf('/%s/', $salt), '', $decrypted_id_raw);
        $mission_application_id = $decrypted_id;
        $update_data = [
            'approval_status' => 'APPROVE',
            'updated_at' => date("Y-m-d h:i:s")
        ];
        $where = [
            'mission_application_id' => $mission_application_id
        ];
        $upd_data = $this->UpdateData1('mission_application', $update_data, $where);
        if ($upd_data) {
    ?>
            <script type="text/javascript">
                window.location.href = 'app';
            </script>
        <?php
        } else {
        ?>
            <script type="text/javascript">
                alert("Something Went Wrong.");
                window.location.href = 'app';
            </script>
        <?php
        }
        break;
    case 'delete_app':
        $encrypted_id = $_GET['delete'];
        $salt = "SECRET_STUFF";
        $decrypted_id_raw = base64_decode($encrypted_id);
        $decrypted_id = preg_replace(sprintf('/%s/', $salt), '', $decrypted_id_raw);
        $mission_application_id = $decrypted_id;
        echo $mission_application_id;
        $update_data = [
            'approval_status' => 'DECLINE',
            'deleted_at' => date("Y-m-d h:i:s")
        ];
        $where = [
            'mission_application_id' => $mission_application_id
        ];
        $upd_data = $this->UpdateData1('mission_application', $update_data, $where);
        if ($upd_data) {
        ?>
            <script type="text/javascript">
                window.location.href = 'app';
            </script>
        <?php
        } else {
        ?>
            <script type="text/javascript">
                alert("Something Went Wrong.");
                window.location.href = 'app';
            </script>
<?php
        }
        break;
    default:
        $pagecount = 5;
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else
            $page = 1;
        if ($page == "" || $page == 1) {
            $postno = 0;
        } else
            $postno = ($page * $pagecount) - $pagecount;
        $selectData = $this->Select('mission_application');
        $cnt = $selectData['Data'];
        $cnt = ceil($cnt / $pagecount);
        $selectData = $this->SelectJoinApp($postno, $pagecount);
        $apps = $selectData['Data'];
        if (isset($_POST['search'])) {
            $where = [
                'mission.title' => $_POST['search'],
                'last_name' => $_POST['search'],
                'first_name' => $_POST['search']
            ];
            $selectData = $this->SelectJoinApp(0, 0, $where);
            $apps = $selectData['Data'];
        }
        include "Views/Admin/view_all_app.php";
}
include 'Views/footer.php';
?>