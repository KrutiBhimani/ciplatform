<br />
<form class="m-3" method="post" enctype="multipart/form-data">
    <table class="table table-borderless" style="border: 1px solid #dee2e6;">
        <thead class="table-light border-bottom">
            <tr>
                <td class="p-3 fs-6" scope="col">Story Detail</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="p-3 fs-6">
                    <p class="mb-1 mt-4" style="font-size:20px;">Story Title</p>
                    => <?php echo $story->story_title; ?><br />
                    <p class="mb-1 mt-4" style="font-size:20px;">Mission Title</p>
                    => <?php echo $story->mission_title; ?><br />
                    <p class="mb-1 mt-4" style="font-size:20px;">Story Description</p>
                    => <?php echo $story->story_desc; ?><br />
                    <p class="mb-1 mt-4" style="font-size:20px;">Story Photo</p>
                    <?php foreach ($medias as $media) {
                        if ($media->type == 'png') { ?>
                            <img class="m-3" src="../<?php echo $media->path; ?>" height="140px" width="180px">
                    <?php
                        }
                    } ?>
                    <br />
                    <p class="mb-1 mt-4" style="font-size:14px;">Story Video</p>
                    <?php
                    foreach ($medias as $media) {
                        if ($media->type == 'video') {
                            echo "<iframe height='150px' width='300px' class='m-3' src='$media->path'></iframe>";
                        }
                    }
                    ?>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="d-flex align-content-end justify-content-end">
        <a class="col-example mt-4 mb-4 me-3" onClick="javascript:return confirm('Are you sure to change status to approve?');" href="story?source=approve_story&edit=<?php $id = $story->story_id;
                                                                                                                                    $salt = "SECRET_STUFF";
                                                                                                                                    $encrypted_id = base64_encode($id . $salt);
                                                                                                                                    echo $encrypted_id; ?>"><i class='fa fa-check-circle-o mt-1 mb-1 me-2'></i>Approve</a>
        <a class="col-example mt-4 mb-4 me-3" onClick="javascript:return confirm('Are you sure to change status to decline?');" href="story?source=decline_story&edit=<?php $id = $story->story_id;
                                                                                                                                    $salt = "SECRET_STUFF";
                                                                                                                                    $encrypted_id = base64_encode($id . $salt);
                                                                                                                                    echo $encrypted_id; ?>"><i class='fa fa-times-circle-o mt-1 mb-1 me-2'></i>Decline</a>
        <a class="col-example mt-4 mb-4" onClick="javascript:return confirm('Are you sure to delete?');" href="story?source=delete_story&delete=<?php $id = $story->story_id;
                                                                                                                                $salt = "SECRET_STUFF";
                                                                                                                                $encrypted_id = base64_encode($id . $salt);
                                                                                                                                echo $encrypted_id; ?>">
            <i class='fa fa-trash-o mt-1 mb-1 me-2' aria-hidden='true'></i>Delete</a>
    </div>
</form><br />