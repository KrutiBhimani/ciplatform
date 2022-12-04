<?php if (!isset($_SESSION['admin_data'])) {
?>
    <script type="text/javascript">
        window.location.href = 'login';
    </script>
    <?php
}
$case = 1;
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
    case 'add_user':
        $selectData = $this->SelectData('country');
        $countries = $selectData['Data'];
        $resultString = 0;
    ?>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#selectCountries').change(function() {
                    var selectedOptions = $('#selectCountries option:selected');
                    if (selectedOptions.length > 0) {
                        $resultString = $(this).val();
                        document.getElementById("divResult").value = $resultString;
                    }
                });
            })
        </script>
        <?php
        $selectData = $this->SelectData('city');
        $cities = $selectData['Data'];

        if (isset($_POST['add_user'])) {
            $avatar = $_FILES['avatar']['name'];
            $avatar_temp = $_FILES['avatar']['tmp_name'];
            $insert_data = [
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'phone_number' => $_POST['phone_number'],
                'city_id' => $_POST['city_id'],
                'country_id' => $_POST['country_id'],
                'employee_id' => $_POST['employee_id'],
                'department' => $_POST['department'],
                'profile_text' => $_POST['profile_text'],
                'status' => $_POST['status'],
                'avatar' => $avatar
            ];
            $insertEx = $this->InsertData('user', $insert_data);
            if ($insertEx['Code']) {
                if (!is_null($avatar)) {
                    move_uploaded_file($avatar_temp, '../mvc/Assets/uplodes/' . $avatar);
                }
        ?>
                <script type="text/javascript">
                    alert("<?php echo $insertEx['Message'] ?>");
                    window.location.href = 'user';
                </script>
            <?php
            } else {
            ?>
                <script type="text/javascript">
                    alert("<?php echo $insertEx['Message'] ?>");
                    window.location.href = 'user?source=add_user';
                </script>
            <?php
            }
        }
        include "Views/Admin/add_user.php";
        break;
    case 'edit_user':
        $encrypted_id = $_GET['edit'];
        $salt = "SECRET_STUFF";
        $decrypted_id_raw = base64_decode($encrypted_id);
        $decrypted_id = preg_replace(sprintf('/%s/', $salt), '', $decrypted_id_raw);
        $user_id = $decrypted_id;
        $selectData9 = $this->SelectById($user_id);
        $user = $selectData9['Data'];
        if (isset($_POST['edit_user'])) {
            $avatar = $_FILES['avatar']['name'];
            $avatar_temp = $_FILES['avatar']['tmp_name'];
            if (empty($avatar)) {
                $selectData12 = $this->SelectId($user_id);
                $avatar = $selectData12['Data']->avatar;
            }
            $update_data = [
                'user_id' => $user_id,
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'phone_number' => $_POST['phone_number'],
                'city_id' => $_POST['city_id'],
                'country_id' => $_POST['country_id'],
                'employee_id' => $_POST['employee_id'],
                'department' => $_POST['department'],
                'profile_text' => $_POST['profile_text'],
                'status' => $_POST['status'],
                'avatar' => $avatar,
                'updated_at' => date("Y-m-d h:i:s")
            ];
            $upd_data = $this->UpdateData('user', $update_data, $user_id);
            if ($upd_data) {
                if (!is_null($avatar)) {
                    move_uploaded_file($avatar_temp, '../mvc/Assets/uplodes/' . $avatar);
                }
            ?>
                <script type="text/javascript">
                    alert("Data update successfully.");
                    window.location.href = 'user';
                </script>
            <?php
            } else {
            ?>
                <script type="text/javascript">
                    alert("Something Went Wrong.");
                    window.location.href = 'user?source=edit_user&edit=<?php
                                                                        $id = $user->user_id;
                                                                        $salt = "SECRET_STUFF";
                                                                        $encrypted_id = base64_encode($id . $salt);
                                                                        echo $encrypted_id; ?>';
                </script>
            <?php
            }
        }
        include "Views/Admin/edit_user.php";
        break;
    case 'delete_user':
        $encrypted_id = $_GET['delete'];
        $salt = "SECRET_STUFF";
        $decrypted_id_raw = base64_decode($encrypted_id);
        $decrypted_id = preg_replace(sprintf('/%s/', $salt), '', $decrypted_id_raw);
        $user_id = $decrypted_id;
        $update_data = [
            'deleted_at' => date("Y-m-d h:i:s")
        ];
        $where = [
            'user_id' => $user_id
        ];
        $delete_data = $this->UpdateData1('user', $update_data, $where);

        if ($delete_data) {
            ?>
            <script type="text/javascript">
                alert("Data deleted successfully.");
                window.location.href = 'user';
            </script>
        <?php
        } else {
        ?>
            <script type="text/javascript">
                alert("Something Went Wrong.");
                window.location.href = 'user';
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
        $selectData1 = $this->Select('user');
        $cnt = $selectData1['Data'];
        $cnt = ceil($cnt / $pagecount);
        $selectData1 = $this->SelectData('user', $postno, $pagecount);
        $users = $selectData1['Data'];
        if (isset($_POST['search'])) {
            $where = [
                'first_name' => $_POST['search'],
                'last_name' => $_POST['search'],
                'email' => $_POST['search'],
                'employee_id' => $_POST['search'],
                'department' => $_POST['search']
            ];
            $selectData1 = $this->SelectData('user', 0, 0, $where);
            $users = $selectData1['Data'];
        }
        include "Views/Admin/view_all_user.php";
}
include 'Views/footer.php';
?>