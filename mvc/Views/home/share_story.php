<br /><br /><br />
<div class="container-lg">
    <p class="fs-2 fw-light pt-5">Share your story</p>
    <form name="myForm" onsubmit="return validateForm()" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col">
                <p class="mb-1">Select mission</p>
                <select class="popup pt-0 pb-0" id="mission_id" name='mission_id'>
                    <option value="" selected="" disabled="" hidden="">Select your mission</option>
                    <?php foreach ($missions as $mission) { ?>
                        <option value="<?php echo $mission->mission_id ?>" <?php if (!empty($story)) {
                                                                                if ($story->mission_id == $mission->mission_id) {
                                                                                    echo 'selected';
                                                                                }
                                                                            } ?>><?php echo $mission->mission_title ?></option>
                    <?php } ?>
                </select>
                <span id="error1" style="color:#f88634"></span>
            </div>
            <div class="col">
                <p class="mb-1">My Story Title</p>
                <input type="text" class="popup" name="title" value="<?php if (!empty($story)) {
                                                                            echo $story->title;
                                                                        } ?>" placeholder="Enter story title">
            </div>
            <div class="col removecal">
                <p class="mb-1">Date</p>
                <input type="datetime-local" step="1" name="published_at" value="<?php if (!empty($story)) {
                                                                                        echo $story->published_at;
                                                                                    } ?>" class="popup" value="Select date">
            </div>
        </div>
        <p class="mb-1 mt-4">My Story</p>
        <textarea rows="5" placeholder="Enter your message" name="description" class="popup1"><?php if (!empty($story)) {
                                                                                                    echo $story->description;
                                                                                                } ?></textarea>
        <p class="mb-1 mt-4">Enter Video URL</p>
        <textarea rows="2" placeholder="Enter your url" name="url" class="popup1"><?php if (!empty($story)) {
                                                                                        if (!empty($medias)) {
                                                                                            foreach ($medias as $media) {
                                                                                                if ($media->type == 'video') {
                                                                                                    echo $media->path;
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                    } ?></textarea>
        <script>
            $(function() {
                // Multiple images preview in browser
                var imagesPreview = function(input, placeToInsertImagePreview) {

                    if (input.files) {
                        var filesAmount = input.files.length;

                        for (i = 0; i < filesAmount; i++) {
                            var reader = new FileReader();

                            reader.onload = function(event) {
                                $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview).height(80).width(80).addClass('hj');
                            }

                            reader.readAsDataURL(input.files[i]);
                        }
                    }

                };

                $('#gallery-photo-add').on('change', function() {
                    imagesPreview(this, 'div.gallery');
                    $('.hide').remove();
                });
            });
        </script>
        <p class="mb-1 mt-3">Mission Images</p>
        <label for="gallery-photo-add" class="custom-file-upload">
            <img src="../mvc/Assets/images/drag-and-drop.png" style="height:calc(20px + 2vw);"><br />
        </label>
        <input type="file" name='media_name[]' id="gallery-photo-add" onchange="readURL(this);" multiple style="display: none;" />
        <div class="hide">
            <?php if (!empty($story)) {
                if (!empty($medias)) {
                    foreach ($medias as $media) {
                        if ($media->type != 'video') { ?>
                            <img src="../<?php echo $media->path ?>" style="height:80px;width:80px;">
            <?php }
                    }
                }
            } ?>
        </div>
        <div class="gallery"></div>
        <div class="d-flex justify-content-between mt-3 mb-5">
            <div>
                <button type="button" class="col-example8">Cancle</button>
            </div>
            <div>
                <button type="submit" name='draft' class="col-example7">Save</button>
                <button type="submit" name='publish' class="col-example7">Submit</button>
            </div>
        </div>
    </form>
</div>