<?php if (!isset($_SESSION['admin_data'])) {
?>
    <script type="text/javascript">
        window.location.href = 'login';
    </script>
    <?php
}
$case = 0;
$admin_id = $_SESSION['admin_data']->admin_id;
$where = [
    'admin_id' => $admin_id
];
$selectData = $this->SelectData1('admin', $where);
$admin = $selectData['Data'];
if (isset($_POST['edit_admin'])) {
    $salt = "SeCrEtStUfFfOrPaSsWoRd";
    $encrypted_password = base64_encode($_POST['password'] . $salt);
    $avatar = $_FILES['avatar']['name'];
    $avatar_temp = $_FILES['avatar']['tmp_name'];
    if (empty($avatar)) {
        $avatar = $admin->avatar;
    }
    $update_data = [
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'email' => $_POST['email'],
        'password' => $encrypted_password,
        'phone_number' => $_POST['phone_number'],
        'avatar' => $avatar,
        'updated_at' => date("Y-m-d h:i:s")
    ];
    $upd_data = $this->UpdateData1('admin', $update_data, $where);
    if ($upd_data) {
        if (!is_null($avatar)) {
            move_uploaded_file($avatar_temp, 'mvc/Assets/uplodes/' . $avatar);
        }
    ?>
        <script type="text/javascript">
            window.location.href = 'user';
        </script>
    <?php
    } else {
    ?>
        <script type="text/javascript">
            alert("Something Went Wrong.");
            window.location.href = 'edit_admin?edit=<?php $id = $admin_id;
                                                    $salt = "SECRET_STUFF";
                                                    $encrypted_id = base64_encode($id . $salt);
                                                    echo $encrypted_id; ?>';
        </script>
<?php
    }
}
include 'mvc/Views/header.php';
include 'mvc/Views/Admin/adminsidebar.php';
include "mvc/Views/Admin/edit_admin.php";
include 'mvc/Views/footer.php';
?>