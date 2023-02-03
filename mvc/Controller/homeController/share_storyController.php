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
$selectData = $this->DraftStory($user_id);
$story = $selectData['Data'];
if (!empty($story)) {
    $selectData = $this->StoryMedia($story->story_id);
    $medias = $selectData['Data'];
}
$selectData = $this->SelectData3(0, 0, 'Newest');
$missions = $selectData['Data'];
$selectData = $this->AppliedMissions1($user_id);
$missions1 = $selectData['Data'];
if (isset($_POST['draft'])) {
    if (!empty($story)) {
        $update_data = [
            'mission_id' => $_POST['mission_id'],
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'published_at' => $_POST['published_at'],
            'updated_at' => date("Y-m-d h:i:s")
        ];
        $where = [
            'user_id' => $user_id,
            'status' => 'DRAFT'
        ];
        $upd_data = $this->UpdateData1('story', $update_data, $where);
        if ($upd_data) {
            if (isset($_POST['url'])) {
                $this->DeleteData2('story_media', $story->story_id, 'video');
                $links_array = explode("\n", $_POST['url']);
                foreach ($links_array as $url) {
                    $insert_data = [
                        'story_id' => $story->story_id,
                        'type' => 'video',
                        'path' => $url,
                    ];
                    $insertEx = $this->InsertData('story_media', $insert_data);
                }
            }
            if (!empty(array_filter($_FILES['media_name']['name']))) {
                $this->DeleteData2('story_media', $story->story_id, 'dfgg');
                foreach ($_FILES['media_name']['tmp_name'] as $key => $image) {
                    $media_name_temp = $_FILES['media_name']['tmp_name'][$key];
                    $media_name = $_FILES['media_name']['name'][$key];
                    move_uploaded_file($media_name_temp, 'mvc/Assets/uplodes/' . $media_name);
                    $media_type = substr(strstr($media_name, '.'), 1);
                    $media_path = 'mvc/Assets/uplodes/' . $media_name;
                    $insert_data = [
                        'story_id' => $story->story_id,
                        'type' => $media_type,
                        'path' => $media_path
                    ];
                    $insertEx = $this->InsertData('story_media', $insert_data);
                }
            }
    ?>
            <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content p-2">
                        <div class="modal-header" style="border-bottom:0 ;">
                            <p class="mb-0" style="font-size:20px ;font-weight:bold">Story</p>
                            <a href='stories'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
                        </div>
                        <div class="modal-body pb-0">
                            <p class="mb-1" style="font-size:18px">Story Drafted</p>
                        </div>
                        <div class="modal-footer" style="border-top:0 ;">

                            <a href="stories" class="col-example7 text-center">Ok</a>
                        </div>
                    </div>
                </div>
            </div><?php
                } else {
                    ?>
            <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content p-2">
                        <div class="modal-header" style="border-bottom:0 ;">
                            <p class="mb-0" style="font-size:20px ;font-weight:bold">Story</p>
                            <a href='story_detail'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
                        </div>
                        <div class="modal-body pb-0">
                            <p class="mb-1" style="font-size:18px">Something went wrong</p>
                        </div>
                        <div class="modal-footer" style="border-top:0 ;">

                            <a href="story_detail" class="col-example7 text-center">Ok</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php
                }
            } else {
                $insert_data = [
                    'mission_id' => $_POST['mission_id'],
                    'title' => $_POST['title'],
                    'description' => $_POST['description'],
                    'published_at' => $_POST['published_at'],
                    'user_id' => $user_id,
                    'status' => 'DRAFT'
                ];
                $insertEx = $this->InsertData('story', $insert_data);
                if ($insertEx) {
                    $selectData = $this->GetStory();
                    $story_id = $selectData['Data']->max;
                    if (isset($_POST['url'])) {
                        $this->DeleteData2('story_media', $story_id, 'video');
                        $links_array = explode("\n", $_POST['url']);
                        foreach ($links_array as $url) {
                            $insert_data = [
                                'story_id' => $story_id,
                                'type' => 'video',
                                'path' => $url,
                            ];
                            $insertEx = $this->InsertData('story_media', $insert_data);
                        }
                    }
                    if (!empty(array_filter($_FILES['media_name']['name']))) {
                        $this->DeleteData2('story_media', $story_id, 'dfgg');
                        foreach ($_FILES['media_name']['tmp_name'] as $key => $image) {
                            $media_name_temp = $_FILES['media_name']['tmp_name'][$key];
                            $media_name = $_FILES['media_name']['name'][$key];
                            move_uploaded_file($media_name_temp, 'mvc/Assets/uplodes/' . $media_name);
                            $media_type = substr(strstr($media_name, '.'), 1);
                            $media_path = 'mvc/Assets/uplodes/' . $media_name;
                            $insert_data = [
                                'story_id' => $story_id,
                                'type' => $media_type,
                                'path' => $media_path
                            ];
                            $insertEx = $this->InsertData('story_media', $insert_data);
                        }
                    }
        ?>
            <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content p-2">
                        <div class="modal-header" style="border-bottom:0 ;">
                            <p class="mb-0" style="font-size:20px ;font-weight:bold">Story</p>
                            <a href='stories'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
                        </div>
                        <div class="modal-body pb-0">
                            <p class="mb-1" style="font-size:18px">Story Drafted</p>
                        </div>
                        <div class="modal-footer" style="border-top:0 ;">

                            <a href="stories" class="col-example7 text-center">Ok</a>
                        </div>
                    </div>
                </div>
            </div><?php
                } else {
                    ?>
            <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content p-2">
                        <div class="modal-header" style="border-bottom:0 ;">
                            <p class="mb-0" style="font-size:20px ;font-weight:bold">Story</p>
                            <a href='story_detail'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
                        </div>
                        <div class="modal-body pb-0">
                            <p class="mb-1" style="font-size:18px">Something went wrong</p>
                        </div>
                        <div class="modal-footer" style="border-top:0 ;">

                            <a href="story_detail" class="col-example7 text-center">Ok</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php
                }
            }
        }
        if (isset($_POST['publish'])) {
            if (!empty($story)) {
                $update_data = [
                    'mission_id' => $_POST['mission_id'],
                    'title' => $_POST['title'],
                    'description' => $_POST['description'],
                    'published_at' => $_POST['published_at'],
                    'updated_at' => date("Y-m-d h:i:s"),
                    'status' => 'PENDING'
                ];
                $where = [
                    'user_id' => $user_id,
                    'status' => 'DRAFT'
                ];
                $upd_data = $this->UpdateData1('story', $update_data, $where);
                if ($upd_data) {
                    if (isset($_POST['url'])) {
                        $this->DeleteData2('story_media', $story->story_id, 'video');
                        $links_array = explode("\n", $_POST['url']);
                        foreach ($links_array as $url) {
                            $insert_data = [
                                'story_id' => $story->story_id,
                                'type' => 'video',
                                'path' => $url,
                            ];
                            $insertEx = $this->InsertData('story_media', $insert_data);
                        }
                    }
                    if (!empty(array_filter($_FILES['media_name']['name']))) {
                        $this->DeleteData2('story_media', $story->story_id, 'dfgg');
                        foreach ($_FILES['media_name']['tmp_name'] as $key => $image) {
                            $media_name_temp = $_FILES['media_name']['tmp_name'][$key];
                            $media_name = $_FILES['media_name']['name'][$key];
                            move_uploaded_file($media_name_temp, 'mvc/Assets/uplodes/' . $media_name);
                            $media_type = substr(strstr($media_name, '.'), 1);
                            $media_path = 'mvc/Assets/uplodes/' . $media_name;
                            $insert_data = [
                                'story_id' => $story->story_id,
                                'type' => $media_type,
                                'path' => $media_path
                            ];
                            $insertEx = $this->InsertData('story_media', $insert_data);
                        }
                    }
        ?>
            <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content p-2">
                        <div class="modal-header" style="border-bottom:0 ;">
                            <p class="mb-0" style="font-size:20px ;font-weight:bold">Story</p>
                            <a href='stories'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
                        </div>
                        <div class="modal-body pb-0">
                            <p class="mb-1" style="font-size:18px">Story posted</p>
                        </div>
                        <div class="modal-footer" style="border-top:0 ;">

                            <a href="stories" class="col-example7 text-center">Ok</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php
                } else {
        ?>
            <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content p-2">
                        <div class="modal-header" style="border-bottom:0 ;">
                            <p class="mb-0" style="font-size:20px ;font-weight:bold">Story</p>
                            <a href='story_detail'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
                        </div>
                        <div class="modal-body pb-0">
                            <p class="mb-1" style="font-size:18px">Something went wrong</p>
                        </div>
                        <div class="modal-footer" style="border-top:0 ;">

                            <a href="story_detail" class="col-example7 text-center">Ok</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php
                }
            } else {
                $insert_data = [
                    'mission_id' => $_POST['mission_id'],
                    'title' => $_POST['title'],
                    'description' => $_POST['description'],
                    'published_at' => $_POST['published_at'],
                    'user_id' => $user_id,
                    'status' => 'PENDING'
                ];
                $insertEx = $this->InsertData('story', $insert_data);
                if ($insertEx) {
                    $selectData = $this->GetStory();
                    $story_id = $selectData['Data']->max;
                    if (isset($_POST['url'])) {
                        $this->DeleteData2('story_media', $story_id, 'video');
                        $links_array = explode("\n", $_POST['url']);
                        foreach ($links_array as $url) {
                            $insert_data = [
                                'story_id' => $story_id,
                                'type' => 'video',
                                'path' => $url,
                            ];
                            $insertEx = $this->InsertData('story_media', $insert_data);
                        }
                    }
                    if (!empty(array_filter($_FILES['media_name']['name']))) {
                        $this->DeleteData2('story_media', $story_id, 'dfgg');
                        foreach ($_FILES['media_name']['tmp_name'] as $key => $image) {
                            $media_name_temp = $_FILES['media_name']['tmp_name'][$key];
                            $media_name = $_FILES['media_name']['name'][$key];
                            move_uploaded_file($media_name_temp, 'mvc/Assets/uplodes/' . $media_name);
                            $media_type = substr(strstr($media_name, '.'), 1);
                            $media_path = 'mvc/Assets/uplodes/' . $media_name;
                            $insert_data = [
                                'story_id' => $story_id,
                                'type' => $media_type,
                                'path' => $media_path
                            ];
                            $insertEx = $this->InsertData('story_media', $insert_data);
                        }
                    }
        ?>
            <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content p-2">
                        <div class="modal-header" style="border-bottom:0 ;">
                            <p class="mb-0" style="font-size:20px ;font-weight:bold">Story</p>
                            <a href='stories'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
                        </div>
                        <div class="modal-body pb-0">
                            <p class="mb-1" style="font-size:18px">Story posted</p>
                        </div>
                        <div class="modal-footer" style="border-top:0 ;">

                            <a href="stories" class="col-example7 text-center">Ok</a>
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                //window.location.href = 'share_story';
            </script>
        <?php
                } else {
        ?>
            <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content p-2">
                        <div class="modal-header" style="border-bottom:0 ;">
                            <p class="mb-0" style="font-size:20px ;font-weight:bold">Story</p>
                            <a href='story_detail'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
                        </div>
                        <div class="modal-body pb-0">
                            <p class="mb-1" style="font-size:18px">Something went wrong</p>
                        </div>
                        <div class="modal-footer" style="border-top:0 ;">

                            <a href="story_detail" class="col-example7 text-center">Ok</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php
                }
            }
        }
        if (isset($_POST['contact'])) {
            $insert_data = [
                'user_id' => $user->user_id,
                'subject' => $_POST['subject'],
                'message' => $_POST['message']
            ];
            $insertEx = $this->InsertData('contact', $insert_data);
            if ($insertEx['Code']) {
        ?>
        <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-2">
                    <div class="modal-header" style="border-bottom:0 ;">
                        <p class="mb-0" style="font-size:20px ;font-weight:bold">Contact</p>
                        <a href='share_story'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
                    </div>
                    <div class="modal-body pb-0">
                        <p class="mb-1" style="font-size:18px">message sent</p>
                    </div>
                    <div class="modal-footer" style="border-top:0 ;">

                        <a href="share_story" class="col-example7 text-center">Ok</a>
                    </div>
                </div>
            </div>
        </div>
    <?php
            } else {
    ?>
        <div class="modal show" aria-modal="true" role="dialog" style="display: block;background-color:rgba(0,0,0,.5);">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-2">
                    <div class="modal-header" style="border-bottom:0 ;">
                        <p class="mb-0" style="font-size:20px ;font-weight:bold">Contact</p>
                        <a href='share_story'><img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png"></a>
                    </div>
                    <div class="modal-body pb-0">
                        <p class="mb-1" style="font-size:18px">Something went wrong</p>
                    </div>
                    <div class="modal-footer" style="border-top:0 ;">

                        <a href="share_story" class="col-example7 text-center">Ok</a>
                    </div>
                </div>
            </div>
        </div>
    <?php
            }
        }
        if (isset($_POST['notification'])) {

            $note = $_POST['note'];
            $selectData = $this->SelectNote($note);
            $notes = $selectData['Data']; ?>
<?php } else {
            $selectData = $this->SelectNote();
            $notes = $selectData['Data'];
        }
        include 'mvc/Views/home/header.php';
?>
<script>
    function validateForm() {
        var e = document.getElementById("mission_id");
        var strUser = e.options[e.selectedIndex].value;
        if (strUser == "") {
            document.getElementById("error1").innerHTML = "Please select mission";
            return false;
        }
    }
</script>
<?php
include 'mvc/Views/home/header1.php';
include 'mvc/Views/home/share_story.php';
include 'mvc/Views/home/footer.php';
?>