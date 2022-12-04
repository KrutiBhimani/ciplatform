<?php if (!isset($_SESSION['admin_data'])) {
?>
    <script type="text/javascript">
        window.location.href = 'login';
    </script>
    <?php
}
$case = 2;
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
    case 'add_page':
        if (isset($_POST['add_page'])) {
            $insert_data = [
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'slug' => $_POST['slug'],
                'status' => $_POST['status']
            ];
            $insertEx = $this->InsertData('cms_page', $insert_data);
            echo $insertEx;
            if ($insertEx['Code']) {
?>
                <script type="text/javascript">
                    alert("<?php echo $insertEx['Message'] ?>");
                    window.location.href = 'page';
                </script>
            <?php
            } else {
            ?>
                <script type="text/javascript">
                    alert("<?php echo $insertEx['Message'] ?>");
                    window.location.href = 'page?source=add_page';
                </script>
            <?php
            }
        }
        include "Views/Admin/add_page.php";
        break;
    case 'edit_page':
        $encrypted_id = $_GET['edit'];
        $salt = "SECRET_STUFF";
        $decrypted_id_raw = base64_decode($encrypted_id);
        $decrypted_id = preg_replace(sprintf('/%s/', $salt), '', $decrypted_id_raw);
        $cms_page_id = $decrypted_id;
        $where = [
            'cms_page_id' => $cms_page_id
        ];
        $selectData = $this->SelectData1('cms_page', $where);
        $pagei = $selectData['Data'];
        if (isset($_POST['edit_page'])) {
            $update_data = [
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'slug' => $_POST['slug'],
                'status' => $_POST['status'],
                'updated_at' => date("Y-m-d h:i:s")
            ];
            $where = [
                'cms_page_id' => $cms_page_id
            ];
            $upd_data = $this->UpdateData1('cms_page', $update_data, $where);
            if ($upd_data) {
            ?>
                <script type="text/javascript">
                    alert("Data update successfully.");
                    window.location.href = 'page';
                </script>
            <?php
            } else {
            ?>
                <script type="text/javascript">
                    alert("Something Went Wrong.");
                    window.location.href = 'page?source=edit_page&edit=<?php $id = $pag->cms_page_id;
                                                                        $salt = "SECRET_STUFF";
                                                                        $encrypted_id = base64_encode($id . $salt);
                                                                        echo $encrypted_id; ?> ';
                </script>
            <?php
            }
        }
        include "Views/Admin/edit_page.php";
        break;
    case 'delete_page':
        $encrypted_id = $_GET['delete'];
        $salt = "SECRET_STUFF";
        $decrypted_id_raw = base64_decode($encrypted_id);
        $decrypted_id = preg_replace(sprintf('/%s/', $salt), '', $decrypted_id_raw);
        $cms_page_id = $decrypted_id;
        $update_data = [
            'deleted_at' => date("Y-m-d h:i:s")
        ];
        $where = [
            'cms_page_id' => $cms_page_id
        ];
        $delete_data = $this->UpdateData1('cms_page', $update_data, $where);
        if ($delete_data) {
            ?>
            <script type="text/javascript">
                alert("Data deleted successfully.");
                window.location.href = 'page';
            </script>
        <?php
        } else {
        ?>
            <script type="text/javascript">
                alert("Something Went Wrong.");
                window.location.href = 'page';
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
        $selectData = $this->Select('cms_page');
        $cnt = $selectData['Data'];
        $cnt = ceil($cnt / $pagecount);
        $selectData = $this->SelectData('cms_page', $postno, $pagecount);
        $pages = $selectData['Data'];

        if (isset($_POST['search'])) {
            $where = [
                'title' => $_POST['search']
            ];
            $selectData1 = $this->SelectData('cms_page', 0, 0, $where);
            $pages = $selectData1['Data'];
        }
        include "Views/Admin/view_all_page.php";
}
include 'Views/footer.php';
?>