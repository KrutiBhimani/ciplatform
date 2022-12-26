<?php if (!isset($_SESSION['user_data'])) {
?>
    <script type="text/javascript">
        window.location.href = 'login';
    </script>
<?php
}
$user_id = $_SESSION['user_data']->user_id;
$where = [
    'user_id' => $user_id
];
$selectData = $this->SelectData1('user', $where);
$user = $selectData['Data'];
$pagecount = 9;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else
    $page = 1;
if ($page == "" || $page == 1) {
    $postno = 0;
} else
    $postno = ($page * $pagecount) - $pagecount;
$selectData1 = $this->Select('mission');
$cnts = $selectData1['Data'];
$cnt = ceil($cnts / $pagecount);
$selectData = $this->SelectData3($postno, $pagecount, 'ASC');
$missions = $selectData['Data'];
$row = $selectData['Row'];
$selectData = $this->SelectData('city');
$cities = $selectData['Data'];
$selectData = $this->SelectData('country');
$countries = $selectData['Data'];
$selectData = $this->SelectData('mission_theme');
$themes = $selectData['Data'];
$selectData = $this->SelectData('skill');
$skills = $selectData['Data'];
$selectData = $this->SelectData4($user_id);
$users = $selectData['Data'];
$userrow = $selectData['Row'];
foreach ($missions as $mission) {
    $selectData = $this->SelectApply('mission_application', $where);
    $appusers = $selectData['Data'];
    $selectData = $this->SelectApply('favourite_mission', $where);
    $likeusers = $selectData['Data'];
    $selectData = $this->SelectSeat();
    $seats = $selectData['Data'];
}
include 'Views/header.php';
?>
<script>
    $(document).on('click', '.six-txt1', function() {
        var t = $(this).text();
        var text = t.trim();
        $('#clickedButton').val($(this).text().trim());
        let form1 = document.getElementById("selectSort1");
        form1.submit();
    })
    $(document).ready(function() {
        $("#gridlink").click(function() {
            $("#divlist").hide();
            $("#divgrid").show();
            $("#h2").removeClass("Ellipse-574");
            $("#h1").addClass("Ellipse-574");
        });
        $("#listlink").click(function() {
            $("#divlist").show();
            $("#divgrid").hide();
            $("#h1").removeClass("Ellipse-574");
            $("#h2").addClass("Ellipse-574");
        });
    })
    $(document).ready(function() {
        $('#selectSort').change(function() {
            var selectedOptions = $('#selectSort option:selected');
            if (selectedOptions.length > 0) {
                var resultString = '';
                selectedOptions.each(function() {
                    resultString += $(this).val();
                });
                $('#divResult').html(resultString);
            }
        });
    });

    function showHide() {
        let form = document.getElementById("selectSort");
        form.submit();
    }

    function showHide1() {
        let form1 = document.getElementById("selectSort1");
        form1.submit();
    }

    function showHide2() {
        let form2 = document.getElementById("selectSort1");
        form2.submit();
    }

    function showCountry() {
        let form3 = document.getElementById("selectSort1");
        form3.submit();
    }
    function showCity() {
        let form4 = document.getElementById("selectSort1");
        form4.submit();
    }
    function showTheme() {
        let form5 = document.getElementById("selectSort1");
        form5.submit();
    }
    function showSkill() {
        let form6 = document.getElementById("selectSort1");
        form6.submit();
    }
</script>
<?php
include 'Views/home/header1.php';
include 'Views/home/header2.php';
if (isset($_GET['source']))
    $source = $_GET['source'];
else
    $source = '';
switch ($source) {
    case 'like_mission':
        $insert_data = [
            'user_id' => $_GET['user'],
            'mission_id' => $_GET['like']
        ];
        $insertEx = $this->InsertData('favourite_mission', $insert_data);
        if ($insertEx['Code']) {
?>
            <script type="text/javascript">
                window.location.href = 'home';
            </script>
        <?php
        } else {
        ?>
            <script type="text/javascript">
                window.location.href = 'home';
            </script>
        <?php
        }
        break;
    case 'unlike_mission':
        $update_data = [
            'deleted_at' => date("Y-m-d h:i:s")
        ];
        $where = [
            'user_id' => $_GET['user'],
            'mission_id' => $_GET['like']
        ];
        $delete_data = $this->UpdateData1('favourite_mission', $update_data, $where);
        if ($delete_data) {
        ?>
            <script type="text/javascript">
                window.location.href = 'home';
            </script>
        <?php
        } else {
        ?>
            <script type="text/javascript">
                window.location.href = 'home';
            </script>
            <?php
        }
        break;
    default:
        if (isset($_POST['sort'])) {
            $order = $_POST['sort'];
            $selectData = $this->SelectData3($postno, $pagecount, $order, $user_id);
            $missions = $selectData['Data'];
            $row = $selectData['Row'];
        }
        if (isset($_POST['search'])) {
            $search = $_POST['search'];
            $where = [
                'mission.title' => $search,
                'city.name' => $search,
                'mission_theme.title' => $search,
                'mission.short_description' => $search,
                'mission.organization_name' => $search
            ];
            $selectData = $this->SelectData3($postno, $pagecount, 'Oldest', $user_id, $where);
            $missions = $selectData['Data'];
            $row = $selectData['Row'];
        }
        if (isset($_POST['country'])) {
            $country = $_POST['country'];
            $where = [
                'country.name' => $country
            ];
            $selectData = $this->SelectData3($postno, $pagecount, 'Oldest', $user_id, $where);
            $missions = $selectData['Data'];
            $row = $selectData['Row'];
        }
        if (isset($_POST['city'])) {
            $where = array();
            foreach ($_POST['city'] as $item) {
                $where[] = $item;
            }
            $selectData = $this->SelectData3($postno, $pagecount, 'Oldest', $user_id, $where,'city.name');
            $missions = $selectData['Data'];
            $row = $selectData['Row'];
        }
        if (isset($_POST['theme'])) {
            $where = array();
            foreach ($_POST['theme'] as $item) {
                $where[] = $item;
            }
            $selectData = $this->SelectData3($postno, $pagecount, 'Oldest', $user_id, $where,'mission_theme.title');
            $missions = $selectData['Data'];
            $row = $selectData['Row'];
        }
        if (isset($_POST['skill'])) {
            $where = array();
            foreach ($_POST['skill'] as $item) {
                $where[] = $item;
            }
            $selectData = $this->SelectData3($postno, $pagecount, 'Oldest', $user_id, $where,'skill.skill_name');
            $missions = $selectData['Data'];
            $row = $selectData['Row'];
        }
        if (isset($_POST['inviteuser'])) {
            foreach ($_POST['invite'] as $item) {
                $data = [
                    'to_user_id' => $item,
                    'from_user_id' => $user_id,
                    'mission_id' => $_POST['m_id']
                ];
                $this->InsertData('mission_invite', $data);
            }
        }
        include 'Views/home/home.php';
        break;
}
include 'Views/home/footer.php';
?>