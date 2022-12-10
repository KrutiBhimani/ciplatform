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
foreach ($missions as $mission) {
    $selectData = $this->SelectApply('mission_application', $where);
    $appusers = $selectData['Data'];
    $selectData = $this->SelectApply('favourite_mission', $where);
    $likeusers = $selectData['Data'];
    // $selectData = $this->SelectApply('mission_invite', $where);
    // $inviteusers = $selectData['Data'];
}
if (isset($_POST['sort'])) {
    echo 'hello';
}
include 'Views/header.php';
include 'Views/home/header1.php';
include 'Views/home/header2.php';
?>
<script>
    $(document).on('click', '.six-txt', function() {
        $('#clickedButton').val($(this).text());
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
</script>
<?php
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
        include 'Views/home/home.php';
        break;
}
include 'Views/home/footer.php';
?>