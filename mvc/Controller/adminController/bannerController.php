<?php if (!isset($_SESSION['admin_data'])) {
?>
    <script type="text/javascript">
        window.location.href = 'login';
    </script>
    <?php
}
$case = 8;
include 'mvc/Views/header.php';
$admin_id = $_SESSION['admin_data']->admin_id;
$where = [
    'admin_id' => $admin_id
];
$selectData = $this->SelectData1('admin', $where);
$admin = $selectData['Data'];
include 'mvc/Views/Admin/adminsidebar.php';
if (isset($_GET['source']))
    $source = $_GET['source'];
else
    $source = '';
switch ($source) {
    case 'add_banner':
        if (isset($_POST['add_banner'])) {
            $image = $_FILES['image']['name'];
            $image_temp = $_FILES['image']['tmp_name'];
            $insert_data = [
                'title' => $_POST['title'],
                'text' => $_POST['text'],
                'sort_order' => $_POST['sort_order'],
                'image' => $image
            ];
            $insertEx = $this->InsertData('banner', $insert_data);
            if ($insertEx['Code']) {
                if (!is_null($image)) {
                    move_uploaded_file($image_temp, 'mvc/Assets/uplodes/' . $image);
                }
    ?>
                <script type="text/javascript">
                    window.location.href = 'banner';
                </script>
            <?php
            } else {
            ?>
                <script type="text/javascript">
                    alert("Something Went Wrong.");
                    window.location.href = 'page?source=add_banner';
                </script>
            <?php
            }
        }
        include "mvc/Views/Admin/add_banner.php";
        break;
    case 'edit_banner':
        $encrypted_id = $_GET['edit'];
        $salt = "SECRET_STUFF";
        $decrypted_id_raw = base64_decode($encrypted_id);
        $decrypted_id = preg_replace(sprintf('/%s/', $salt), '', $decrypted_id_raw);
        $banner_id = $decrypted_id;
        $where = [
            'banner_id' => $banner_id
        ];
        $selectData = $this->SelectData1('banner', $where);
        $banner = $selectData['Data'];
        if (isset($_POST['edit_banner'])) {
            $image = $_FILES['image']['name'];
            $image_temp = $_FILES['image']['tmp_name'];
            if (empty($image)) {
                $selectData12 = $this->SelectData1('banner', $where);
                $image = $selectData12['Data']->image;
            }
            $update_data = [
                'title' => $_POST['title'],
                'text' => $_POST['text'],
                'sort_order' => $_POST['sort_order'],
                'image' => $image,
                'updated_at' => date("Y-m-d h:i:s")
            ];
            $where = [
                'banner_id' => $banner_id
            ];
            $upd_data = $this->UpdateData1('banner', $update_data, $where);
            if ($upd_data) {
                if (!is_null($avatar)) {
                    move_uploaded_file($avatar_temp, 'mvc/Assets/uplodes/' . $avatar);
                }
            ?>
                <script type="text/javascript">
                    window.location.href = 'banner';
                </script>
            <?php
            } else {
            ?>
                <script type="text/javascript">
                    alert("Something Went Wrong.");
                    window.location.href = 'banner?source=edit_banner&edit=<?php
                                                                            $id = $banner->banner_id;
                                                                            $salt = "SECRET_STUFF";
                                                                            $encrypted_id = base64_encode($id . $salt);
                                                                            echo $encrypted_id; ?>';
                </script>
            <?php
            }
        }
        include "mvc/Views/Admin/edit_banner.php";
        break;
    case 'delete_banner':
        $encrypted_id = $_GET['delete'];
        $salt = "SECRET_STUFF";
        $decrypted_id_raw = base64_decode($encrypted_id);
        $decrypted_id = preg_replace(sprintf('/%s/', $salt), '', $decrypted_id_raw);
        $banner_id = $decrypted_id;
        $update_data = [
            'deleted_at' => date("Y-m-d h:i:s")
        ];
        $where = [
            'banner_id' => $banner_id
        ];
        $delete_data = $this->UpdateData1('banner', $update_data, $where);
        if ($delete_data) {
            ?>
            <script type="text/javascript">
                window.location.href = 'banner';
            </script>
        <?php
        } else {
        ?>
            <script type="text/javascript">
                alert("Something Went Wrong.");
                window.location.href = 'banner';
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
        $selectData = $this->Select('banner');
        $cnt = $selectData['Data'];
        $cnt = ceil($cnt / $pagecount);
        $selectData = $this->SelectData('banner', $postno, $pagecount);
        $banners = $selectData['Data'];
        if (isset($_POST['search'])) {
            $where = [
                'title' => $_POST['search'],
                'sort_order' => $_POST['search']
            ];
            $selectData = $this->SelectData('banner', 0, 0, $where);
            $banners = $selectData['Data'];
        }
        include "mvc/Views/Admin/view_all_banner.php";
}
include 'mvc/Views/footer.php';
?>