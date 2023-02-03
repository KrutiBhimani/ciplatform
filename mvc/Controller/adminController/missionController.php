<?php if (!isset($_SESSION['admin_data'])) {
?>
    <script type="text/javascript">
        window.location.href = 'login';
    </script>
    <?php
}
$case = 3;
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
    case 'add_mission':
    ?>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#selecttype').change(function() {
                    var selectedOptions = $('#selecttype option:selected');
                    if (selectedOptions.length > 0) {
                        var resultString = '';
                        selectedOptions.each(function() {
                            var val = $(this).val();
                            if (val == "TIME")
                                resultString += "<p class='mb-1 mt-4' style='font-size:14px;'>Total Seats</p><input type='number' class='popup' name='total_seat'><p class='mb-1 mt-4' style='font-size:14px;' >Registration Deadline</p><input type='date' class='popup' name='deadline'>";
                            else
                                resultString += "<p class='mb-1 mt-4' style='font-size:14px;'>Goal</p><input type='text' class='popup' name='goal_objective_text'><p class='mb-1 mt-4' style='font-size:14px;' >Goal Value*</p><input type='number' class='popup' name='goal_value'>";
                        });
                        $('#divResult').html(resultString);
                    }
                });
            });
        </script>
        <?php
        $selectData = $this->SelectData('city');
        $cities = $selectData['Data'];
        $selectData = $this->SelectData('country');
        $countries = $selectData['Data'];
        $selectData = $this->SelectData('mission_theme');
        $themes = $selectData['Data'];
        $selectData = $this->SelectData('skill');
        $skills = $selectData['Data'];
        if (isset($_POST['add_mission'])) {

            $insert_data = [
                'title' => $_POST['title'],
                'short_description' => $_POST['short_description'],
                'description' => $_POST['description'],
                'city_id' => $_POST['city_id'],
                'Country_id' => $_POST['country_id'],
                'organization_name' => $_POST['organization_name'],
                'organization_detail' => $_POST['organization_detail'],
                'start_date' => $_POST['start_date'],
                'end_date' => $_POST['end_date'],
                'mission_type' => $_POST['mission_type'],
                'theme_id' => $_POST['theme_id'],
                'availability' => $_POST['availability']
            ];
            $insertEx = $this->InsertData('mission', $insert_data);
            if ($insertEx['Code']) {
                $selectData = $this->GetMission();
                $mission_id = $selectData['Data']->max;
                if (!empty($_POST['skill_id'])) {
                    $skil = $_POST['skill_id'];
                    foreach ($skil as $item) {
                        $this->exp($mission_id, $item);
                    }
                }
                if (!empty(array_filter($_FILES['media_name']['name']))) {
                    foreach ($_FILES['media_name']['tmp_name'] as $key => $image) {
                        $media_name_temp = $_FILES['media_name']['tmp_name'][$key];
                        $media_name = $_FILES['media_name']['name'][$key];
                        move_uploaded_file($media_name_temp, 'mvc/Assets/uplodes/' . $media_name);
                        $media_type = substr(strstr($media_name, '.'), 1);
                        $media_path = 'mvc/Assets/uplodes/' . $media_name;
                        $insert_data = [
                            'mission_id' => $mission_id,
                            'media_name' => $media_name,
                            'media_type' => $media_type,
                            'media_path' => $media_path
                        ];
                        $this->InsertData('mission_media', $insert_data);
                    }
                }
                if (!empty(array_filter($_FILES['document_name']['name']))) {
                    foreach ($_FILES['document_name']['tmp_name'] as $key => $image) {
                        $document_name_temp = $_FILES['document_name']['tmp_name'][$key];
                        $document_name = $_FILES['document_name']['name'][$key];
                        move_uploaded_file($document_name_temp, 'mvc/Assets/uplodes/' . $document_name);
                        $document_type = substr(strstr($document_name, '.'), 1);
                        $document_path = 'mvc/Assets/uplodes' . $document_name;
                        $insert_data = [
                            'mission_id' => $mission_id,
                            'document_name' => $document_name,
                            'document_type' => $document_type,
                            'document_path' => $document_path
                        ];
                        $this->InsertData('mission_document', $insert_data);
                    }
                }
                if ($_POST['mission_type'] != '') {
                    if ($_POST['mission_type'] == 'TIME') {
                        $insert_data = [
                            'mission_id' => $mission_id,
                            'total_seat' => $_POST['total_seat'],
                            'deadline' => $_POST['deadline']
                        ];
                        $this->InsertData('time_mission', $insert_data);
                    } else {
                        $insert_data = [
                            'mission_id' => $mission_id,
                            'goal_objective_text' => $_POST['goal_objective_text'],
                            'goal_value' => $_POST['goal_value']
                        ];
                        $this->InsertData('goal_mission', $insert_data);
                    }
                }
                $selectData1 = $this->SelectData('user');
                $users = $selectData1['Data'];
                foreach ($users as $user) {
                    $insert_data = [
                        'message' => 'new mission added',
                        'user_id' => $user->user_id,
                        'category' => 1,
                    ];
                    $this->InsertData('notification', $insert_data);
                }

        ?>
                <script type="text/javascript">
                    window.location.href = 'mission';
                </script>
            <?php
            } else {
            ?>
                <script type="text/javascript">
                    alert("Something Went Wrong.");
                    window.location.href = 'mission?source=add_mission';
                </script>
            <?php
            }
        }
        include "mvc/Views/Admin/add_mission.php";
        break;
    case 'edit_mission':
        $encrypted_id = $_GET['edit'];
        $salt = "SECRET_STUFF";
        $decrypted_id_raw = base64_decode($encrypted_id);
        $decrypted_id = preg_replace(sprintf('/%s/', $salt), '', $decrypted_id_raw);
        $mission_id = $decrypted_id;
        $selectData = $this->SelectData2($mission_id);
        $mission = $selectData['Data'];
        $selectData = $this->SelectData('city');
        $cities = $selectData['Data'];
        $selectData = $this->SelectData('country');
        $countries = $selectData['Data'];
        $selectData = $this->SelectData('mission_theme');
        $themes = $selectData['Data'];
        $selectData = $this->SelectData('skill');
        $skills = $selectData['Data'];
        $selectData = $this->GetSelectedSkill($mission_id);
        $selectedSkills = $selectData['Data'];
        if (isset($_POST['edit_mission'])) {
            $update_data = [
                'title' => $_POST['title'],
                'short_description' => $_POST['short_description'],
                'description' => $_POST['description'],
                'city_id' => $_POST['city_id'],
                'Country_id' => $_POST['country_id'],
                'organization_name' => $_POST['organization_name'],
                'organization_detail' => $_POST['organization_detail'],
                'start_date' => $_POST['start_date'],
                'end_date' => $_POST['end_date'],
                'mission_type' => $_POST['mission_type'],
                'theme_id' => $_POST['theme_id'],
                'availability' => $_POST['availability'],
                'updated_at' => date("Y-m-d h:i:s")
            ];
            $where = [
                'mission_id' => $mission_id,
            ];
            $upd_data = $this->UpdateData1('mission', $update_data, $where);
            if (!empty(array_filter($_FILES['media_name']['name']))) {
                $this->DeleteData3('mission_media', $mission_id);
                foreach ($_FILES['media_name']['tmp_name'] as $key => $image) {
                    $media_name_temp = $_FILES['media_name']['tmp_name'][$key];
                    $media_name = $_FILES['media_name']['name'][$key];
                    move_uploaded_file($media_name_temp, 'mvc/Assets/uplodes/' . $media_name);
                    $media_type = substr(strstr($media_name, '.'), 1);
                    $media_path = 'mvc/Assets/uplodes/' . $media_name;
                    $insert_data = [
                        'mission_id' => $mission_id,
                        'media_name' => $media_name,
                        'media_type' => $media_type,
                        'media_path' => $media_path
                    ];
                    $this->InsertData('mission_media', $insert_data);
                }
            }
            if (!empty(array_filter($_FILES['document_name']['name']))) {
                $this->DeleteData3('mission_document', $mission_id);
                foreach ($_FILES['document_name']['tmp_name'] as $key => $image) {
                    $document_name_temp = $_FILES['document_name']['tmp_name'][$key];
                    $document_name = $_FILES['document_name']['name'][$key];
                    move_uploaded_file($document_name_temp, 'mvc/Assets/uplodes/' . $document_name);
                    $document_type = substr(strstr($document_name, '.'), 1);
                    $document_path = 'mvc/Assets/uplodes/' . $document_name;
                    $insert_data = [
                        'mission_id' => $mission_id,
                        'document_name' => $document_name,
                        'document_type' => $document_type,
                        'document_path' => $document_path
                    ];
                    $this->InsertData('mission_document', $insert_data);
                }
            }
            if ($_POST['mission_type'] == 'TIME') {
                $insert_data = [
                    'mission_id' => $mission_id,
                    'total_seat' => $_POST['total_seat'],
                    'deadline' => $_POST['deadline']
                ];
                $update_data = [
                    'total_seat' => $_POST['total_seat'],
                    'deadline' => $_POST['deadline'],
                    'updated_at' => date("Y-m-d h:i:s")
                ];
                $delete_data = [
                    'deleted_at' => date("Y-m-d h:i:s")
                ];
                if ($mission->mission_type == 'TIME') {
                    $this->UpdateData1('time_mission', $update_data, $where);
                } else if ($mission->mission_type == 'GOAL') {
                    $this->InsertData('time_mission', $insert_data);
                    $this->UpdateData1('goal_mission', $delete_data, $where);
                }
            }
            if ($_POST['mission_type'] == 'GOAL') {
                $insert_data = [
                    'mission_id' => $mission_id,
                    'goal_objective_text' => $_POST['goal_objective_text'],
                    'goal_value' => $_POST['goal_value']
                ];
                $update_data = [
                    'goal_objective_text' => $_POST['goal_objective_text'],
                    'goal_value' => $_POST['goal_value'],
                    'updated_at' => date("Y-m-d h:i:s")
                ];
                $delete_data = [
                    'deleted_at' => date("Y-m-d h:i:s")
                ];
                if ($mission->mission_type == 'GOAL') {
                    $this->UpdateData1('goal_mission', $update_data, $where);
                } else if ($mission->mission_type == 'TIME') {
                    $this->InsertData('goal_mission', $insert_data);
                    $this->UpdateData1('time_mission', $delete_data, $where);
                }
            }
            // if ($_POST['mission_skill_id']){
            //     $skil = $_POST['mission_skill_id'];
            //     $updated_at = date("Y-m-d h:i:s");
            //     foreach ($skil as $item) {
            //         $this->updateexp($mission_id, $item,$updated_at);
            //     }
            // }
            if ($upd_data) {
            ?>
                <script type="text/javascript">
                    window.location.href = 'mission';
                </script>
            <?php
            } else {
            ?>
                <script type="text/javascript">
                    alert("Something Went Wrong.");
                    window.location.href = 'mission?source=edit_mission&edit=<?php $id = $mission->mission_id;
                                                                                $salt = "SECRET_STUFF";
                                                                                $encrypted_id = base64_encode($id . $salt);
                                                                                echo $encrypted_id; ?>';
                </script>
            <?php
            }
        }
        include "mvc/Views/Admin/edit_mission.php";
        break;
    case 'delete_mission':
        $encrypted_id = $_GET['delete'];
        $salt = "SECRET_STUFF";
        $decrypted_id_raw = base64_decode($encrypted_id);
        $decrypted_id = preg_replace(sprintf('/%s/', $salt), '', $decrypted_id_raw);
        $mission_id = $decrypted_id;
        $update_data = [
            'deleted_at' => date("Y-m-d h:i:s")
        ];
        $where = [
            'mission_id' => $mission_id
        ];
        $delete_data = $this->UpdateData1('mission', $update_data, $where);
        $delete_data = $this->UpdateData1('goal_mission', $update_data, $where);
        $delete_data = $this->UpdateData1('mission_document', $update_data, $where);
        $delete_data = $this->UpdateData1('mission_media', $update_data, $where);
        $delete_data = $this->UpdateData1('time_mission', $update_data, $where);
        $delete_data = $this->UpdateData1('mission_skill', $update_data, $where);
        if ($delete_data) {
            ?>
            <script type="text/javascript">
                window.location.href = 'mission';
            </script>
        <?php
        } else {
        ?>
            <script type="text/javascript">
                alert("Something Went Wrong.");
                window.location.href = 'mission';
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
        $selectData1 = $this->Select('mission');
        $cnt = $selectData1['Data'];
        $cnt = ceil($cnt / $pagecount);
        $selectData1 = $this->SelectData('mission', $postno, $pagecount);
        $missions = $selectData1['Data'];
        if (isset($_POST['search'])) {
            $where = [
                'title' => $_POST['search'],
                'start_date' => $_POST['search'],
                'end_date' => $_POST['search'],
                'mission_type' => $_POST['search']
            ];
            $selectData1 = $this->SelectData('mission', 0, 0, $where);
            $missions = $selectData1['Data'];
        }
        include "mvc/Views/Admin/view_all_mission.php";
}
include 'mvc/Views/footer.php';
?>