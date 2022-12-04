<?php if (!isset($_SESSION['admin_data'])) {
?>
    <script type="text/javascript">
        window.location.href = 'login';
    </script>
    <?php
}
$case = 4;
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
    case 'add_theme':
        if (isset($_POST['add_theme'])) {
            $insert_data = [
                'title' => $_POST['title'],
                'status' => $_POST['status']
            ];
            $insertEx = $this->InsertData('mission_theme', $insert_data);
            echo $insertEx;
            if ($insertEx['Code']) {
?>
                <script type="text/javascript">
                    alert("<?php echo $insertEx['Message'] ?>");
                    window.location.href = 'theme';
                </script>
            <?php
            } else {
            ?>
                <script type="text/javascript">
                    alert("<?php echo $insertEx['Message'] ?>");
                    window.location.href = 'theme?source=add_theme';
                </script>
            <?php
            }
        }
        include "Views/Admin/add_theme.php";
        break;
    case 'edit_theme':
        $encrypted_id = $_GET['edit'];
        $salt = "SECRET_STUFF";
        $decrypted_id_raw = base64_decode($encrypted_id);
        $decrypted_id = preg_replace(sprintf('/%s/', $salt), '', $decrypted_id_raw);
        $mission_theme_id = $decrypted_id;
        $where = [
            'mission_theme_id' => $mission_theme_id
        ];
        $selectData = $this->SelectData1('mission_theme', $where);
        $theme = $selectData['Data'];
        if (isset($_POST['edit_theme'])) {
            $update_data = [
                'title' => $_POST['title'],
                'status' => $_POST['status'],
                'updated_at' => date("Y-m-d h:i:s")
            ];
            $where = [
                'mission_theme_id' => $mission_theme_id
            ];
            $upd_data = $this->UpdateData1('mission_theme', $update_data, $where);
            if ($upd_data) {
            ?>
                <script type="text/javascript">
                    alert("Data update successfully.");
                    window.location.href = 'theme';
                </script>
            <?php
            } else {
            ?>
                <script type="text/javascript">
                    alert("Something Went Wrong.");
                    window.location.href = 'theme?source=edit_theme&edit=<?php $id = $theme->mission_theme_id;
                                                                            $salt = "SECRET_STUFF";
                                                                            $encrypted_id = base64_encode($id . $salt);
                                                                            echo $encrypted_id; ?>';
                </script>
            <?php
            }
        }
        include "Views/Admin/edit_theme.php";
        break;
    case 'delete_theme':
        $encrypted_id = $_GET['delete'];
        $salt = "SECRET_STUFF";
        $decrypted_id_raw = base64_decode($encrypted_id);
        $decrypted_id = preg_replace(sprintf('/%s/', $salt), '', $decrypted_id_raw);
        $mission_theme_id = $decrypted_id;
        $update_data = [
            'deleted_at' => date("Y-m-d h:i:s")
        ];
        $where = [
            'mission_theme_id' => $mission_theme_id
        ];
        $delete_data = $this->UpdateData1('mission_theme', $update_data, $where);
        if ($delete_data) {
            ?>
            <script type="text/javascript">
                alert("Data deleted successfully.");
                window.location.href = 'theme';
            </script>
        <?php
        } else {
        ?>
            <script type="text/javascript">
                alert("Something Went Wrong.");
                window.location.href = 'theme';
            </script>
<?php
        }
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
        $selectData = $this->Select('mission_theme');
        $cnt = $selectData['Data'];
        $cnt = ceil($cnt / $pagecount);
        $selectData = $this->SelectData('mission_theme', $postno, $pagecount);
        $themes = $selectData['Data'];
        if (isset($_POST['search'])) {
            $where = [
                'title' => $_POST['search']
            ];
            $selectData = $this->SelectData('mission_theme', 0, 0, $where);
            $themes = $selectData['Data'];
        }
        include "Views/Admin/view_all_theme.php";
}
include 'Views/footer.php';
?>