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
$selectData = $this->SelectData('city');
$cities = $selectData['Data'];
$selectData = $this->SelectData('country');
$countries = $selectData['Data'];
$where = [
    'user_id' => $user_id
];
$selectData = $this->SelectedSkill('user_skill', $where);
$selected = $selectData['Data'];
$selectData = $this->SelectData('skill');
$skills = $selectData['Data'];
if (isset($_POST['contact'])) {
    $insert_data = [
        'user_id' => $user->user_id,
        'subject' => $_POST['subject'],
        'message' => $_POST['message']
    ];
    $insertEx = $this->InsertData('contact', $insert_data);
}
if (isset($_POST['edit_user'])) {
    $avatar = $_FILES['avatar']['name'];
    $avatar_temp = $_FILES['avatar']['tmp_name'];
    if (empty($avatar)) {
        $selectData12 = $this->SelectId($user_id);
        $avatar = $selectData12['Data']->avatar;
    }
    $update_data = [
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'city_id' => $_POST['city_id'],
        'country_id' => $_POST['country_id'],
        'employee_id' => $_POST['employee_id'],
        'manager' => $_POST['manager'],
        'title' => $_POST['title'],
        'department' => $_POST['department'],
        'profile_text' => $_POST['profile_text'],
        'why_i_volunteer' => $_POST['why_i_volunteer'],
        'availability' => $_POST['availability'],
        'linked_in_url' => $_POST['linked_in_url'],
        'avatar' => $avatar,
        'updated_at' => date("Y-m-d h:i:s")
    ];
    $upd_data = $this->UpdateData('user', $update_data, $user_id);
    if ($upd_data) {
        $this->DeleteData('user_skill', $user_id);
        $skil = $_POST['skill'];
        foreach ($skil as $item) {
            $this->exp1($user_id, $item);
        }
        if (!is_null($avatar)) {
            move_uploaded_file($avatar_temp, 'mvc/Assets/uplodes/' . $avatar);
        }
    ?>
        <script type="text/javascript">
            window.location.href = 'edit_user';
        </script>
        <?php
    }
}
if (isset($_POST['change'])) {
    $salt = "SeCrEtStUfFfOrPaSsWoRd";
    $pass_raw = base64_decode($user->password);
    $pass = preg_replace(sprintf('/%s/', $salt), '', $pass_raw);
    if ($_POST['password'] == $pass) {
        if ($_POST['password1'] == $_POST['password2']) {
            $encrypted_password = base64_encode($_POST['password1'] . $salt);
            $update_data = [
                'password' => $encrypted_password,
                'updated_at' => date("Y-m-d h:i:s")
            ];
            $upd_data = $this->UpdateData('user', $update_data, $user_id);
            if ($upd_data) {
        ?>
                <script type="text/javascript">
                    alert('updated');
                </script>
            <?php
            } else {
            ?>
                <script type="text/javascript">
                    alert('not updated');
                </script>
            <?php
            }
        } else {
            ?>
            <script type="text/javascript">
                alert('new password need to be same');
            </script>
        <?php
        }
    } else {
        ?>
        <script type="text/javascript">
            alert('password not same as old');
        </script>
<?php
    }
}
?>
<script>
    function validateForm() {
        let y = document.forms["myForm"]["first_name"].value;
        if (y == "") {
            document.getElementById("error1").innerHTML = "Name is required";
            return false;
        }
        if (y.length > 16) {
            document.getElementById("error1").innerHTML = "maximum 16 characters are allowed";
            return false;
        }
        let x = document.forms["myForm"]["last_name"].value;
        if (x == "") {
            document.getElementById("error2").innerHTML = "Surname is required";
            return false;
        }
        if (x.length > 16) {
            document.getElementById("error2").innerHTML = "maximum 16 characters are allowed";
            return false;
        }
        let a = document.forms["myForm"]["employee_id"].value;
        if (a.length > 16) {
            document.getElementById("error3").innerHTML = "maximum 16 characters are allowed";
            return false;
        }
        let b = document.forms["myForm"]["title"].value;
        if (b.length > 255) {
            document.getElementById("error4").innerHTML = "maximum 255 characters are allowed";
            return false;
        }
        let c = document.forms["myForm"]["department"].value;
        if (c.length > 16) {
            document.getElementById("error5").innerHTML = "maximum 16 characters are allowed";
            return false;
        }
    }
</script>
<?php
include 'mvc/Views/home/header.php';
include 'mvc/Views/home/header1.php';
include 'mvc/Views/home/edit_user.php';
include 'mvc/Views/home/footer.php';
?>