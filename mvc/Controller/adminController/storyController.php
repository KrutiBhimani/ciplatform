<?php
$case = 7;
include 'Views/header.php';
$firstname = $_SESSION['admin_data']->first_name;
$lastname = $_SESSION['admin_data']->last_name;
$avtar = $_SESSION['admin_data']->avatar;
include 'Views/adminsidebar.php';
if (isset($_GET['source']))
    $source = $_GET['source'];
else
    $source = '';
switch ($source) {
    case 'view_story':
        $encrypted_id = $_GET['view'];
        $salt = "SECRET_STUFF";
        $decrypted_id_raw = base64_decode($encrypted_id);
        $decrypted_id = preg_replace(sprintf('/%s/', $salt), '', $decrypted_id_raw);
        $story_id = $decrypted_id;
        $selectData = $this->SelectViewStory($story_id);
        $story = $selectData['Data'];
        $where = [
            'story_id' => $story_id
        ];
        $selectData1 = $this->SelectData('story_media', 0, 0, $where);
        $medias = $selectData1['Data'];
        include "Views/Admin/view_story.php";
        break;
    case 'approve_story':
        $encrypted_id = $_GET['edit'];
        $salt = "SECRET_STUFF";
        $decrypted_id_raw = base64_decode($encrypted_id);
        $decrypted_id = preg_replace(sprintf('/%s/', $salt), '', $decrypted_id_raw);
        $story_id = $decrypted_id;
        $update_data = [
            'status' => 'PUBLISHED',
            'updated_at' => date("Y-m-d h:i:s")
        ];
        $where = [
            'story_id' => $story_id
        ];
        $upd_data = $this->UpdateData1('story', $update_data, $where);
        if ($upd_data) {
?>
            <script type="text/javascript">
                alert("Data update successfully.");
                window.location.href = 'story';
            </script>
        <?php
        } else {
        ?>
            <script type="text/javascript">
                alert("Something Went Wrong.");
                window.location.href = 'story';
            </script>
        <?php
        }
        break;
    case 'decline_story':
        $encrypted_id = $_GET['edit'];
        $salt = "SECRET_STUFF";
        $decrypted_id_raw = base64_decode($encrypted_id);
        $decrypted_id = preg_replace(sprintf('/%s/', $salt), '', $decrypted_id_raw);
        $story_id = $decrypted_id;
        $update_data = [
            'status' => 'DECLINED',
            'updated_at' => date("Y-m-d h:i:s")
        ];
        $where = [
            'story_id' => $story_id
        ];
        $upd_data = $this->UpdateData1('story', $update_data, $where);
        if ($upd_data) {
        ?>
            <script type="text/javascript">
                alert("Data update successfully.");
                window.location.href = 'story';
            </script>
        <?php
        } else {
        ?>
            <script type="text/javascript">
                alert("Something Went Wrong.");
                window.location.href = 'story';
            </script>
        <?php
        }
        break;
    case 'delete_story':
        $encrypted_id = $_GET['delete'];
        $salt = "SECRET_STUFF";
        $decrypted_id_raw = base64_decode($encrypted_id);
        $decrypted_id = preg_replace(sprintf('/%s/', $salt), '', $decrypted_id_raw);
        $story_id = $decrypted_id;
        $update_data = [
            'deleted_at' => date("Y-m-d h:i:s")
        ];
        $where = [
            'story_id' => $story_id
        ];
        $delete_data = $this->UpdateData1('story', $update_data, $where);
        if ($delete_data) {
        ?>
            <script type="text/javascript">
                alert("Data deleted successfully.");
                window.location.href = 'story';
            </script>
        <?php
        } else {
        ?>
            <script type="text/javascript">
                alert("Something Went Wrong.");
                window.location.href = 'story';
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
        $selectData = $this->Select('story');
        $cnt = $selectData['Data'];
        $cnt = ceil($cnt / $pagecount);
        $selectData = $this->SelectJoinStory($postno, $pagecount);
        $storys = $selectData['Data'];
        if (isset($_POST['search'])) {
            $where = [
                'story.title' => $_POST['search'],
                'mission.title' => $_POST['search'],
                'first_name' => $_POST['search'],
                'last_name' => $_POST['search']
            ];
            $selectData = $this->SelectJoinStory(0, 0, $where);
            $storys = $selectData['Data'];
        }
        include "Views/Admin/view_all_story.php";
}
?>