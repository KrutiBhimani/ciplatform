<br /><br />

<div class="container-lg">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <div style="height:100%;">
                <img id='mainImage' class="ps-1 pe-1" src="<?php echo $story->path ?>" height="80%" width="100%" style='object-fit: cover;'>
                <div class="row pe-3 ps-3 pt-1">
                    <div class="top-content p-0" id='style-sheet-modern'>
                        <div class="container-fluid p-0 m-0">
                            <div id="carousel-example" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner row w-100 mx-auto" role="listbox">
                                    <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3 active p-1">
                                        <img src="<?php echo $story->path; ?>" class="img-fluid mx-auto d-block" style="object-fit: cover;height: 100px; width:100%" alt="img1">
                                    </div>

                                    <?php foreach ($medias as $key => $media) { ?>
                                        <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3 p-1">
                                            <?php if ($media->type == 'video') { ?>
                                                <iframe class="img-fluid mx-auto d-block" src='<?php echo $media->path; ?>' style="object-fit: cover;height: 100px; width:100%"></iframe>
                                            <?php } else { ?>
                                                <img src="<?php echo $media->path; ?>" class="img-fluid mx-auto d-block" style="object-fit: cover;height: 100px; width:100%" alt="img1">
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <a class="carousel-control-prev" href="#carousel-example" role="button" data-slide="prev" style="background-color: black; width:5%;top:4px;bottom:4px;left:3px;">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carousel-example" role="button" data-slide="next" style="background-color: black; width:5%;top:4px;bottom:4px;right:3px;">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-12 mt-5">
            <div class="d-flex justify-content-between">
                <div>
                    <img src="mvc/Assets/<?php if ($story->avatar == '') echo 'images/user1.png';
                                            else echo 'uplodes/' . $story->avatar; ?>" class="rounded-circle" height="82px" width="78">
                    <p class="mb-0" style="font-size:13px ;"><?php echo $story->first_name . ' ' . $story->last_name ?></p>
                </div>
                <div class="d-flex align-items-end">
                    <div class="bdg2"><img src="mvc/Assets/images/eye.png" class="me-2">12000 view</div>
                </div>
            </div>
            <p class="mt-4" style="font-size:calc(11px + 0.2vw);"><?php echo $story->why_i_volunteer ?></p>
            <div class="row mt-3 mb-3">
                <div class="col-lg-7 col-md-12 col-sm-12 col-12 mt-2">
                    <div class="col-example2 text-center" style="font-size:calc(13px + 0.2vw);">
                        <a href="#" style="color: inherit; text-decoration: inherit;" data-bs-toggle="modal" data-bs-target="#popup<?php echo $story->story_id ?>">
                            <img src="mvc/Assets/images/add1.png" alt="" class="mb-1" style="height:15px ;">
                            Recommend to a Co-Worker
                        </a>
                    </div>
                    <div id="popup<?php echo $story->story_id ?>" class="modal">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content p-2">
                                <div class="modal-header pb-0" style="border-bottom:0 ;">
                                    <p class="mb-0" style="font-size:20px ;">Invite</p>
                                    <img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png" data-bs-dismiss="modal" style="cursor: pointer;height:13px">
                                </div>
                                <form class="m-0" method="post" enctype="multipart/form-data">
                                    <input type="text" name='s_id' value="<?php echo $story->story_id ?>" hidden>
                                    <div class="modal-body pb-0">
                                        <p class="mb-1 mt-3">Email </p>
                                        <input type="email" class="popup" name="email" place-holder='enter user email to invite'>
                                    </div>
                                    <div class="modal-footer mt-4" style="border-top:0 ;">
                                        <button type="reset" class="col-example8" data-bs-dismiss="modal">Cancle
                                        </button>
                                        <button id="button1" type="submit" name='inviteuser' class="col-example7" data-bs-dismiss="modal">Invite
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12 col-sm-12 col-12 mt-2">
                    <div class="col-example text-center" style="font-size:calc(13px + 0.2vw);">
                        <a href="Volunteering_Mission?id=<?php $id = $story->mission_id;
                                                            $salt = "SECRET_STUFF";
                                                            $encrypted_id = base64_encode($id . $salt);
                                                            echo $encrypted_id; ?>" style="color: inherit; text-decoration: inherit;">
                            Open Mission
                            <i class="fa fa-arrow-right ps-3"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active1 gray ps-0" data-toggle="tab" href="#mission"><?php echo $story->story_title ?></a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane show active" id="mission">
                    <p style="font-size:calc(10px + 0.1vw);" class="mt-4 mb-3">
                        <?php echo $story->sdescription; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>