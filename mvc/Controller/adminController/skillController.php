<?php if (!isset($_SESSION['admin_data'])) {
?>
    <script type="text/javascript">
        window.location.href = 'login';
    </script>
    <?php
}
$case = 5;
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
    case 'add_skill':
        if (isset($_POST['add_skill'])) {
            $insert_data = [
                'skill_name' => $_POST['skill_name'],
                'status' => $_POST['status']
            ];
            $insertEx = $this->InsertData('skill', $insert_data);
            echo $insertEx;
            if ($insertEx['Code']) {
    ?>
                <script type="text/javascript">
                    window.location.href = 'skill';
                </script>
            <?php
            } else {
            ?>
                <script type="text/javascript">
                    alert("Something Went Wrong.");
                    window.location.href = 'skill?source=add_skill';
                </script>
            <?php
            }
        }
        include "Views/Admin/add_skill.php";
        break;
    case 'edit_skill':
        $encrypted_id = $_GET['edit'];
        $salt = "SECRET_STUFF";
        $decrypted_id_raw = base64_decode($encrypted_id);
        $decrypted_id = preg_replace(sprintf('/%s/', $salt), '', $decrypted_id_raw);
        $skill_id = $decrypted_id;
        $where = [
            'skill_id' => $skill_id
        ];
        $selectData = $this->SelectData1('skill', $where);
        $skill = $selectData['Data'];
        if (isset($_POST['edit_skill'])) {
            $update_data = [
                'skill_name' => $_POST['skill_name'],
                'status' => $_POST['status'],
                'updated_at' => date("Y-m-d h:i:s")
            ];
            $where = [
                'skill_id' => $skill_id
            ];
            $upd_data = $this->UpdateData1('skill', $update_data, $where);
            if ($upd_data) {
            ?>
                <script type="text/javascript">
                    window.location.href = 'skill';
                </script>
            <?php
            } else {
            ?>
                <script type="text/javascript">
                    alert("Something Went Wrong.");
                    window.location.href = 'skill?source=edit_skill&edit=<?php $id = $skill->skill_id;
                                                                            $salt = "SECRET_STUFF";
                                                                            $encrypted_id = base64_encode($id . $salt);
                                                                            echo $encrypted_id; ?> ';
                </script>
            <?php
            }
        }
        include "Views/Admin/edit_skill.php";
        break;
    case 'delete_skill':
        $encrypted_id = $_GET['delete'];
        $salt = "SECRET_STUFF";
        $decrypted_id_raw = base64_decode($encrypted_id);
        $decrypted_id = preg_replace(sprintf('/%s/', $salt), '', $decrypted_id_raw);
        $skill_id = $decrypted_id;
        $update_data = [
            'deleted_at' => date("Y-m-d h:i:s")
        ];
        $where = [
            'skill_id' => $skill_id
        ];
        $delete_data = $this->UpdateData1('skill', $update_data, $where);
        if ($delete_data) {
            ?>
            <script type="text/javascript">
                window.location.href = 'skill';
            </script>
        <?php
        } else {
        ?>
            <script type="text/javascript">
                alert("Something Went Wrong.");
                window.location.href = 'skill';
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
        $selectData = $this->Select('skill');
        $cnt = $selectData['Data'];
        $cnt = ceil($cnt / $pagecount);
        $selectData = $this->SelectData('skill', $postno, $pagecount);
        $skills = $selectData['Data'];
        if (isset($_POST['search'])) {
            $where = [
                'skill_name' => $_POST['search']
            ];
            $selectData = $this->SelectData('skill', 0, 0, $where);
            $skills = $selectData['Data'];
        }
        include "Views/Admin/view_all_skill.php";
}
include 'Views/footer.php';
?>