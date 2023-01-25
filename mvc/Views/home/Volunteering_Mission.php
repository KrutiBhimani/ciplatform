<br /><br />
<?php foreach ($missions as $mission) { ?>
    <div class="container-lg">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div style="height:100%;">
                    <img id='mainImage' class="ps-1 pe-1 mt-2" src="../<?php echo $mission->media_path; ?>" height="80%" width="100%" style='object-fit: cover;'>
                    <div class="row pe-3 ps-3 pt-1">
                        <div class="top-content p-0" id='style-sheet-modern'>
                            <div class="container-fluid p-0 m-0">
                                <div id="carousel-example" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner row w-100 mx-auto" role="listbox">
                                        <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3 active p-1">
                                            <img src="../<?php echo $mission->media_path; ?>" class="img-fluid mx-auto d-block" style="object-fit: cover;height: 100px; width:100%" alt="img1">
                                        </div>

                                        <?php foreach ($medias as $key => $media) { ?>
                                            <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3 p-1">
                                                <img src="../<?php echo $media->media_path; ?>" class="img-fluid mx-auto d-block" style="object-fit: cover;height: 100px; width:100%" alt="img1">
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
                <p class="mb-3" style="font-size:calc(15px + 1vw);"><?php echo $mission->mission_title; ?></p>
                <p class="mb-3" style="color: gray; font-size: calc(11px + 0.15vw);"><?php echo $mission->short_description ?></p>
                <?php if ($mission->mission_type == 'TIME') { ?>
                    <div class="d-flex align-items-center">
                        <hr class="flex-grow-1 div">
                        <div class="bdg2">
                            <?php
                            $current = date("Y-m-d h:i:s");
                            if ($mission->start_date != null && $mission->end_date != null) {
                                $start_date = date("d-m-Y", strtotime($mission->start_date));
                                $end_date = date("d-m-Y", strtotime($mission->end_date));
                                echo "From $start_date until $end_date";
                            } else if ($mission->end_date >= $current || $mission->deadline >= $current) {
                                echo "Ongoing Opportunity";
                            } else if ($mission->end_date == null && $mission->deadline == null) {
                                echo "Ongoing Opportunity";
                            } else {
                                echo 'closed';
                            }
                            ?>
                        </div>
                        <hr class="flex-grow-1 div">
                    </div>
                <?php } else { ?>
                    <div class="d-flex align-items-center">
                        <hr class="flex-grow-1 div">
                        <div class="bdg2"><?php echo $mission->goal_objective_text; ?>
                        </div>
                        <hr class="flex-grow-1 div">
                    </div>
                <?php } ?>
                <div class="d-flex justify-content-around mt-2 mb-2">
                    <?php
                    if ($mission->mission_type == 'TIME') {
                        if ($mission->total_seat != null) { ?>
                            <div style="color:black;">
                                <div class="d-flex justify-content-around">
                                    <div class="pe-3">
                                        <img src="../mvc/Assets/images/Seats-left.png" alt="" style="height:23px">
                                    </div>
                                    <div>
                                        <h4 class="mb-2" style="font-size:calc(13px + 0.1vw);">
                                            <?php
                                            $key = 0;
                                            foreach ($seats as $seat) {
                                                if ($seat->mission_id == $mission->mission_id) {
                                                    $key = 1;
                                                    break;
                                                }
                                            }
                                            if ($key == 1) {
                                                echo $mission->total_seat - $seat->count;
                                            } else {
                                                echo $mission->total_seat;
                                            }
                                            ?>
                                        </h4>
                                        <h6 class="mb-2" style="font-size:12px ;color:gray;">Seats Left</h6>
                                    </div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div style="color:black;">
                                <div class="d-flex justify-content-around">
                                    <div class="pe-3">
                                        <img src="../mvc/Assets/images/Already-volunteered.png" alt="" style="height:20px">
                                    </div>
                                    <div>
                                        <h4 class="mb-2" style="font-size:calc(13px + 0.1vw);">
                                            <?php
                                            $key = 0;
                                            foreach ($seats as $seat) {
                                                if ($seat->mission_id == $mission->mission_id) {
                                                    $key = 1;
                                                    break;
                                                }
                                            }
                                            if ($key == 1) {
                                                echo $seat->count;
                                            } else {
                                                echo '0';
                                            }
                                            ?>
                                        </h4>
                                        <h6 class="mb-2" style="font-size:12px ;color:gray;">Already volunteered</h6>
                                    </div>
                                </div>
                            </div>
                        <?php }
                        if ($mission->deadline != null) { ?>
                            <div style="color:black;">
                                <div class="d-flex justify-content-around">
                                    <div class="pe-3">
                                        <img src="../mvc/Assets/images/deadline.png" alt="" style="height:28px">
                                    </div>
                                    <div>
                                        <h4 class="mb-2" style="font-size:calc(13px + 0.1vw);">
                                            <?php
                                            $deadline = date("d/m/Y", strtotime($mission->deadline));
                                            echo "$deadline";
                                            ?>
                                        </h4>
                                        <h6 class="mb-2" style="font-size:12px ;color:gray;">Deadline</h6>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    } else { ?>
                        <div style="color:black;">
                            <div class="d-flex justify-content-around">
                                <div class="pe-3">
                                    <img src="../mvc/Assets/images/achieved.png" alt="" style="height:22px">
                                </div>
                                <div style="width: 100%;">
                                    <div class="mt-1 mb-3" style="background-color:#EEEEEE; height:7px; width:100%; border-radius: 10px;">
                                        <div style="background-color:#f88634; height:7px; border-radius: 10px; width:80%;">
                                        </div>
                                    </div>
                                    <h6 class="mb-2" style="font-size:12px ;color:gray;">8000 achieved</h6>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <hr class="div" />
                <div class="row mt-3 mb-3">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12 mt-2">
                        <div class="col-example2 text-center" style="font-size:calc(13px + 0.1vw);">
                            <?php
                            $key = 0;
                            foreach ($likeusers as $likeuser) {
                                if ($likeuser->mission_id == $mission->mission_id) {
                                    $key = 1;
                                    break;
                                }
                            }
                            if ($key == 1) {
                                echo "<a href='Volunteering_Mission?source=unlike_mission&id=$mission->missionid' style='color: inherit; text-decoration: inherit;'><i class='fa fa-heart text-danger me-2' aria-hidden='true'></i>Remove From Favourite</a>";
                            } else {
                                echo "<a href='Volunteering_Mission?source=like_mission&id=$mission->missionid' style='color: inherit; text-decoration: inherit;'><i class='fa fa-heart-o text-dark me-2' aria-hidden='true'></i>Add To Favourite</a>";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12 mt-2">
                        <div class="col-example2 text-center" style="font-size:calc(13px + 0.1vw);">
                            <a href="#" style="color: inherit; text-decoration: inherit;" data-bs-toggle="modal" data-bs-target="#popup<?php echo $mission->missionid ?>">
                                <img src="../mvc/Assets/images/add1.png" alt="" class="mb-1" style="height:15px ;">
                                Recommend to a Co-Worker
                            </a>
                        </div>
                        <div id="popup<?php echo $mission->missionid ?>" class="modal">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content p-2">
                                    <div class="modal-header pb-0" style="border-bottom:0 ;">
                                        <p class="mb-0" style="font-size:20px ;">Invite</p>
                                    </div>
                                    <form class="m-0" method="post" enctype="multipart/form-data">
                                        <input type="text" name='m_id' value="<?php echo $mission->missionid ?>" hidden>
                                        <div class="modal-body pb-0">
                                            <p class="mb-1 mt-3">Email </p>
                                            <input type="email" class="popup" name="email" place-holder='enter user email to invite'>
                                        </div>
                                        <div class="modal-footer mt-4" style="border-top:0 ;">
                                            <button type="reset" class="col-example8" data-bs-dismiss="modal">Cancle
                                            </button>
                                            <button type="submit" name='inviteuser' class="col-example7" data-bs-dismiss="modal">Invite
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <hr class="flex-grow-1 div">
                    <div class="ps-2 pe-2">
                        <?php
                        $key = 0;
                        foreach ($appusers as $appuser) {
                            if ($appuser->mission_id == $mission->missionid) {
                                $key = 1;
                                break;
                            }
                        }
                        if ($rating == 1 && $key == 1) {
                            for ($x = 1; $x <= 5; $x++) {
                                if ($x < ($rateduser->rating + 1)) {
                                    echo "<a href='Volunteering_Mission?source=editrating&rate=$x&id=$mission->missionid'><img src='../mvc/Assets/images/selected-star.png' style='height:20px; cursor: pointer;'></a>";
                                } else {
                                    echo "<a href='Volunteering_Mission?source=editrating&rate=$x&id=$mission->missionid'><img src='../mvc/Assets/images/star.png' style='height:22px; cursor: pointer;'></a>";
                                }
                            }
                        } else if ($rating == 0 && $key == 1) {
                            for ($x = 1; $x <= 5; $x++) {
                                echo "<a href='Volunteering_Mission?source=addrating&rate=$x&id=$mission->missionid'><img src='../mvc/Assets/images/star.png' style='height:22px; cursor: pointer;'></a>";
                            }
                        } else {
                            for ($x = 0; $x < 5; $x++) {
                                if ($x < $mission->rating) {
                                    echo "<img src='../mvc/Assets/images/selected-star.png' alt='' class='ps-1'>";
                                } else {
                                    echo "<img src='../mvc/Assets/images/star.png' alt='' class='ps-1'>";
                                }
                            }
                        }
                        ?>
                    </div>

                    <hr class="flex-grow-1 div">
                </div>
                <div class="row mt-3 mb-3 ms-1 me-1">
                    <div class="col col-example3 pe-2 ps-2">
                        <img src="../mvc/Assets/images/pin1.png" style="height:18px;">
                        <h6 class="mt-3 mb-1" style="color:gray; font-size:10px">City</h6>
                        <h4 class="mb-0" style="font-size:calc(11px + 0.1vw);"><?php echo $mission->city_name; ?></h4>
                    </div>
                    <div class="col col-example3 pe-2 ps-2">
                        <img src="../mvc/Assets/images/web.png" style="height:18px;">
                        <h6 class="mt-3 mb-1" style="color:gray; font-size:10px">Theme</h6>
                        <h4 class="mb-0" style="font-size:calc(11px + 0.1vw);"><?php echo $mission->theme_title; ?></h4>
                    </div>
                    <div class="col col-example3 pe-2 ps-2">
                        <img src="../mvc/Assets/images/calender.png" style="height:17px;">
                        <h6 class="mt-3 mb-1" style="color:gray; font-size:10px">Date</h6>
                        <h4 class="mb-0" style="font-size:calc(11px + 0.1vw);">
                            <?php if ($mission->mission_type == 'TIME') { ?>
                                <?php
                                $current = date("Y-m-d h:i:s");
                                if ($mission->start_date != null && $mission->end_date != null) {
                                    $start_date = date("d-m-Y", strtotime($mission->start_date));
                                    $end_date = date("d-m-Y", strtotime($mission->end_date));
                                    echo "From $start_date until $end_date";
                                } else if ($mission->end_date >= $current || $mission->deadline >= $current) {
                                    echo "Ongoing Opportunity";
                                }else if ($mission->end_date == null && $mission->deadline == null) {
                                    echo "Ongoing Opportunity";
                                } else {
                                    echo 'Closed';
                                }
                                ?>
                            <?php } else {
                                echo "Ongoing Opportunity";
                            } ?>
                        </h4>
                    </div>
                    <div class="col col-example3 pe-2 ps-2">
                        <img src="../mvc/Assets/images/organization.png" style="height:15px;">
                        <h6 class="mt-3 mb-1" style="color:gray; font-size:10px">Organization</h6>
                        <h4 class="mb-0" style="font-size:calc(11px + 0.1vw);"><?php echo $mission->organization_name; ?></h4>
                    </div>

                </div>
                <div class="d-flex align-items-center justify-content-center">
                <?php
                    $key = 0;
                    foreach ($appusers as $appuser) {
                      if ($appuser->mission_id == $mission->missionid) {
                        $key = 1;
                        break;
                      }
                    }
                    if ($mission->mission_type == 'TIME') {
                      $current = date("Y-m-d h:i:s");
                      if ($mission->deadline != null && $current > $mission->deadline) {
                        $key = 1;
                      } else if ($mission->end_date != null && $current > $mission->end_date) {
                        $key = 1;
                      }
                    }
                    $k = 0;
                    $c = 10;
                    foreach ($seats as $seat) {
                      if ($seat->mission_id == $mission->missionid) {
                        $k = 1;
                        break;
                      }
                    }
                    if ($k == 1) {
                      $c = $mission->total_seat - $seat->count;
                    }
                    if ($key == 1 || $c == 0) {?>
                      
                    <?php } else {?>
                        <a href="home?source=apply&id=<?php echo $mission->missionid ?>" style="color: inherit;">
                        <div class="col-example" style="font-size:calc(15px + 0.1vw); font-weight: 400;">Apply Now
                            <img src="../mvc/Assets/images/right-arrow.png" alt="" class="ps-3">
                        </div>
                    </a>
                    <?php }
                    ?>
                
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-8 col-md-8 col-sm-12 col-12">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active gray" data-toggle="tab" href="#mission">Mission</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link gray" data-toggle="tab" href="#organization">Organization</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link gray" data-toggle="tab" href="#comments">Comments</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane show active" id="mission">
                        <?php echo $mission->description;
                        if (!empty($documents)) { ?>
                            <h4 class="mt-4 mb-2" style="font-size:calc(11px + 0.8vw);">Documents</h4>
                            <div class="d-flex flex-wrap">
                                <?php foreach ($documents as $document) { ?>
                                    <button class="col-example5 mt-2" style="font-size:calc(13px + 0.1vw);">
                                        <?php
                                        if ($document->document_type == 'pdf') { ?>
                                            <img src="../mvc/Assets/images/pdf.png" alt="" style="height:18px ;">
                                        <?php }
                                        if ($document->document_type == 'doc' || $document->document_type == 'docx') { ?>
                                            <img src="../mvc/Assets/images/doc.png" alt="" style="height:18px ;">
                                        <?php }
                                        if ($document->document_type == 'xls' || $document->document_type == 'xlsx') { ?>
                                            <img src="../mvc/Assets/images/xlsx.png" alt="" style="height:18px ;">
                                        <?php } ?>
                                        <a href="../<?php echo $document->document_path ?>" target="_blank" style="color: inherit;"><?php echo $document->document_name ?></a>
                                    </button>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="tab-pane" id="organization">
                        <p class="gray pt-3">
                            <?php echo $mission->organization_detail ?>
                        </p>
                    </div>
                    <div class="tab-pane" id="comments">
                        <form class="m-0" method="post" enctype="multipart/form-data">
                            <textarea class="mt-3 ps-3 pe-3 textarea" rows="3" name="comment_text" placeholder="Enter your comments..."></textarea>
                            <button type="submit" name="add_comment" class="col-example mt-3" style="font-size:15px; width:fit-content">
                                Post Comment
                            </button>
                        </form>
                        <?php if ($comment_count > 0) { ?>
                            <div class="pt-1 pb-1 ps-3 pe-3" style="background-color:#f7f7f7;<?php if ($comment_count > 4) {
                                                                                                    echo 'height: 450px;overflow-y: auto;';
                                                                                                } ?>">
                                <?php foreach ($comments as $comment) { ?>
                                    <div class="row mt-2 mb-2 p-3 ms-0 me-0" style="background-color:white;">
                                        <div class="col-lg-1 col-md-2 col-sm-2 col-12 p-0">
                                            <img src="../mvc/Assets/<?php if ($comment->avatar == '') echo 'images/user1.png';
                                                                    else echo 'uplodes/' . $comment->avatar; ?>" class="rounded-circle" height="45px">
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-10 col-12 p-0">
                                            <p class="mb-1" style="font-size:14px ;"><?php echo $comment->first_name . ' ' . $comment->last_name ?></p>
                                            <p class="mb-2" style="font-size:10px ;"><?php echo date("l, F d, Y, h:i A", strtotime($comment->comment_date)); ?></p>
                                            <p class="mb-0" style="font-size:12px ;"><?php echo $comment->comment_text ?></p>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="col-example3 ps-3 pe-3 pt-3 pb-0 mt-3">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active1 gray pt-0 ps-0" data-toggle="tab" href="#info">Information</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="info">
                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <td>Skills</td>
                                        <td>
                                            <?php
                                            $k = '';
                                            foreach ($skills as $skill) {
                                                $k .= $skill->skill_name . ', ';
                                            }
                                            $k = rtrim($k, ', ');
                                            echo $k; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Days</td>
                                        <td><?php echo $mission->availability ?></td>
                                    </tr>
                                    <tr>
                                        <td style="border-bottom: 0;">Rating</td>
                                        <td style="border-bottom: 0;">
                                            <?php for ($x = 0; $x < 5; $x++) {
                                                if ($x < $mission->rating) {
                                                    echo "<img src='../mvc/Assets/images/selected-star.png' height='15px'>";
                                                } else {
                                                    echo "<img src='../mvc/Assets/images/star.png' height='15px'>";
                                                }
                                            } ?>
                                            <span class="gray2">(by <?php
                                                                    if (empty($ratings)) {
                                                                        echo '0';
                                                                    } else {
                                                                        foreach ($ratings as $rating) {
                                                                            echo $rating->count;
                                                                        }
                                                                    } ?> volunteers)</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-example3 pt-3 pb-0 mt-3">
                    <ul class="nav nav-tabs ms-3 me-3">
                        <li class="nav-item ">
                            <a class="nav-link active1 gray pt-0 ps-0" data-toggle="tab" href="#Volunteer">Recent
                                Volunteers</a>
                        </li>
                    </ul>
                    <div class="tab-content ps-3 pe-3 pt-4 pb-1">
                        <div class="tab-pane show active ps-3 pe-3" id="Volunteer">
                            <div class="row">
                                <?php
                                $count = 0;
                                foreach ($vols as $vol) { ?>
                                    <div class="col-4 text-center p-0">
                                        <img src="../mvc/Assets/<?php if ($vol->avatar == '') echo 'images/user1.png';
                                                                else echo 'uplodes/' . $vol->avatar; ?>" class="rounded-circle" height="60px">
                                        <p style="font-size:11px ;"><?php echo $vol->first_name . ' ' . $vol->last_name; ?></p>
                                    </div>
                                <?php $count++;
                                } ?>
                            </div>

                        </div>
                    </div>
                    <table class="table table-bordered m-0 text-center">
                        <tr style="border-bottom: 0; border-start:0;">
                            <td style="border-bottom: 0; border-start: 0;"><img src="../mvc/Assets/images/left.png" height="12px">
                            </td>
                            <td style="border-bottom: 0; border-start: 0;"><?php echo $count ?> Recent Volunteers</td>
                            <td style="border-bottom: 0; border-end: 0;"><img src="../mvc/Assets/images/right-arrow1.png" height="12px">
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php if ($a == 1) { ?>
        <hr class="div mt-5 mb-5">
        <div class="container-lg">
            <div class="row row-eq-height justify-content-center">
                <p class="text-center" style="font-size:30px ;font-weight: 350;">
                    Related Missions
                </p>
                <?php 
                    foreach ($missio as $missi) {
                         ?>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-5 d-flex align-items-stretch">
                            <div class="card box border-0">
                                <div class="gfg">
                                    <img src="../<?php echo $missi->media_path; ?>" alt="" class="img-fluid" style="width:100%;">
                                    <div class="d-flex align-items-center first-txt"><img src="../mvc/Assets/images/pin.png" alt="" class="img-fluid pe-1" style="height:12px;"><?php echo $missi->city_name; ?></div>
                                    <?php if ($missi->mission_type == 'TIME') {
                                        $current = date("Y-m-d h:i:s");
                                        if ($missi->deadline != null) {
                                            if ($current > $missi->deadline) {
                                                echo '<div class="d-flex align-items-center five-txt" style="background-color:red;">CLOSED</div>';
                                            }
                                        } else if ($missi->end_date != null) {
                                            if ($current > $missi->end_date) {
                                                echo '<div class="d-flex align-items-center five-txt" style="background-color:red;">CLOSED</div>';
                                            }
                                        }
                                    }
                                    ?>
                                    <?php
                                    $key = 0;
                                    foreach ($appusers as $appuser) {
                                        if ($appuser->mission_id == $missi->missionid) {
                                            $key = 1;
                                            break;
                                        }
                                    }
                                    if ($key == 1) {
                                        echo '<div class="d-flex align-items-center five-txt">APPLIED</div>';
                                    }
                                    ?>
                                    <div class="d-flex align-items-center second-txt2 p-2">
                                        <?php
                                        $key = 0;
                                        foreach ($likeusers as $likeuser) {
                                            if ($likeuser->mission_id == $missi->missionid) {
                                                $key = 1;
                                                break;
                                            }
                                        }
                                        if ($key == 1) {
                                            echo "<a href='home?source=unlike_mission&id=$missi->missionid&user=$user_id'><i class='fa fa-heart text-danger' aria-hidden='true'></i></a>";
                                        } else {
                                            echo "<a href='home?source=like_mission&id=$missi->missionid&user=$user_id'><i class='fa fa-heart-o' aria-hidden='true' style='color:white'></i></a>";
                                        }
                                        ?>
                                    </div>
                                    <div class="d-flex align-items-center third-txt p-2"><a href="" style="color: black;" data-bs-toggle="modal" data-bs-target="#popup<?php echo $missi->missionid ?>"><img src="../mvc/Assets/images/user.png" alt="" class="img-fluid" style="height:17px"></a></div>
                                    <div id="popup<?php echo $missi->missionid ?>" class="modal">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content p-2">
                                                <div class="modal-header pb-0" style="border-bottom:0 ;">
                                                    <p class="mb-0" style="font-size:20px ;">Invite</p>
                                                </div>
                                                <form class="m-0" method="post" enctype="multipart/form-data">
                                                    <input type="text" name='m_id' value="<?php echo $missi->missionid ?>" hidden>
                                                    <div class="modal-body pb-0">
                                                        <!-- <select class="Rounded-Rectangle-9 w-100" name="invite[]" multiple size="<?php echo $userrow ?>" style="overflow-y: auto;">
                                  <?php
                                    foreach ($users as $user) { ?>
                                    <option class="fs-6 p-2" value="<?php echo $user->user_id ?>">
                                      <?php echo $user->first_name . " " . $user->last_name ?>
                                    </option>
                                  <?php } ?>
                                </select> -->
                                                        <p class="mb-1 mt-3">Email </p>
                                                        <input type="email" class="popup" name="email" place-holder='enter user email to invite'>
                                                    </div>
                                                    <div class="modal-footer mt-4" style="border-top:0 ;">
                                                        <button type="reset" class="col-example8" data-bs-dismiss="modal">Cancle
                                                        </button>
                                                        <button type="submit" name='inviteuser' class="col-example7" data-bs-dismiss="modal">Invite
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex four-txt justify-content-center">
                                        <div class="bdg1"><?php echo $missi->theme_title; ?></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" style="color:black">
                                        <div class="card-body pb-3 remove">
                                            <a href="Volunteering_Mission?id=<?php $id = $missi->mission_id;
                                                                                $salt = "SECRET_STUFF";
                                                                                $encrypted_id = base64_encode($id . $salt);
                                                                                echo $encrypted_id; ?>" style="color:black;">
                                                <h2 class="card-title mb-2" style="font-size:calc(15px + 0.3vw);"><?php echo $missi->mission_title; ?></h2>
                                            </a>
                                            <p class="mb-2" style="color:gray; font-size:calc(11px + 0.1vw);">
                                                <?php
                                                $key = 0;
                                                foreach ($appusers as $appuser) {
                                                    if ($appuser->mission_id == $missi->missionid) {
                                                        $key = 1;
                                                        break;
                                                    }
                                                }
                                                if ($missi->mission_type == 'TIME') {
                                                    $current = date("Y-m-d h:i:s");
                                                    if ($missi->deadline != null && $current > $missi->deadline) {
                                                        $key = 1;
                                                    } else if ($missi->end_date != null && $current > $missi->end_date) {
                                                        $key = 1;
                                                    }
                                                }
                                                $k = 0;
                                                $c = 10;
                                                foreach ($seats as $seat) {
                                                    if ($seat->mission_id == $missi->missionid) {
                                                        $k = 1;
                                                        break;
                                                    }
                                                }
                                                if ($k == 1) {
                                                    $c = $missi->total_seat - $seat->count;
                                                }
                                                if ($key == 1 || $c == 0) {
                                                    echo 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit...';
                                                } else {
                                                    echo $missi->short_description;
                                                }
                                                ?>
                                            </p>
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <h6 class="m-0" style="font-size:calc(11px + 0.1vw);"><?php echo $missi->organization_name; ?></h6>
                                                </div>
                                                <div class="icon">
                                                    <?php for ($x = 0; $x < 5; $x++) {
                                                        if ($x < $missi->rating) {
                                                            echo "<img src='../mvc/Assets/images/selected-star.png' alt='' class='ps-1 star'>";
                                                        } else {
                                                            echo "<img src='../mvc/Assets/images/star.png' alt='' class='ps-1 star'>";
                                                        }
                                                    } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $key = 0;
                                    foreach ($appusers as $appuser) {
                                        if ($appuser->mission_id == $missi->missionid) {
                                            $key = 1;
                                            break;
                                        }
                                    }
                                    if ($missi->mission_type == 'TIME') {
                                        $current = date("Y-m-d h:i:s");
                                        if ($missi->deadline != null && $current > $missi->deadline) {
                                            $key = 1;
                                        } else if ($missi->end_date != null && $current > $missi->end_date) {
                                            $key = 1;
                                        }
                                    }
                                    $k = 0;
                                    $c = 10;
                                    foreach ($seats as $seat) {
                                        if ($seat->mission_id == $missi->missionid) {
                                            $k = 1;
                                            break;
                                        }
                                    }
                                    if ($k == 1) {
                                        $c = $missi->total_seat - $seat->count;
                                        if ($c == 0) {
                                            $key = 1;
                                        }
                                    }
                                    if ($key == 0) { ?>
                                        <?php if ($missi->mission_type == 'TIME') { ?>
                                            <div class="d-flex align-items-center">
                                                <hr class="flex-grow-1 div m-0">
                                                <div class="bdg">
                                                    <?php
                                                    if ($missi->start_date != null && $missi->end_date != null) {
                                                        $start_date = date("d-m-Y", strtotime($missi->start_date));
                                                        $end_date = date("d-m-Y", strtotime($missi->end_date));
                                                        echo "From $start_date until $end_date";
                                                    } else {
                                                        echo "Ongoing Opportunity";
                                                    }
                                                    ?>
                                                </div>
                                                <hr class="flex-grow-1 div m-0">
                                            </div>
                                        <?php } else { ?>
                                            <div class="d-flex align-items-center">
                                                <hr class="flex-grow-1 div m-0">
                                                <div class="bdg"><?php echo $missi->goal_objective_text; ?>
                                                </div>
                                                <hr class="flex-grow-1 div m-0">
                                            </div>
                                        <?php } ?>
                                        <div class="card-body pt-2 pb-2 padremove">
                                            <div class="row">
                                                <?php
                                                if ($missi->mission_type == 'TIME') {
                                                    if ($missi->total_seat != null) { ?>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6" style="color:black;">
                                                            <div class="row">
                                                                <div class="col-lg-1 col-md-1 col-sm-1 col-1 m-1 mt-0 mb-0"><img src="../mvc/Assets/images/Seats-left.png" alt="" style="height:23px"></div>
                                                                <div class="col-lg-9 col-md-9 col-sm-9 col-9">
                                                                    <h4 class="mb-2" style="font-size:calc(13px + 0.1vw);">
                                                                        <?php
                                                                        $key = 0;
                                                                        foreach ($seats as $seat) {
                                                                            if ($seat->mission_id == $missi->missionid) {
                                                                                $key = 1;
                                                                                break;
                                                                            }
                                                                        }
                                                                        if ($key == 1) {
                                                                            echo $missi->total_seat - $seat->count;
                                                                        } else {
                                                                            echo $missi->total_seat;
                                                                        }
                                                                        ?>
                                                                    </h4>
                                                                    <h6 class="mb-2" style="font-size:12px ;color:gray;">Seats Left</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6" style="color:black;">
                                                            <div class="row">
                                                                <div class="col-lg-1 col-md-1 col-sm-1 col-1 m-1 mt-0 mb-0"><img src="../mvc/Assets/images/Already-volunteered.png" alt="" style="height:20px"></div>
                                                                <div class="col-lg-9 col-md-9 col-sm-9 col-9">
                                                                    <h4 class="mb-2" style="font-size:calc(13px + 0.1vw);">
                                                                        <?php
                                                                        $key = 0;
                                                                        foreach ($seats as $seat) {
                                                                            if ($seat->mission_id == $missi->missionid) {
                                                                                $key = 1;
                                                                                break;
                                                                            }
                                                                        }
                                                                        if ($key == 1) {
                                                                            echo $seat->count;
                                                                        } else {
                                                                            echo '0';
                                                                        }
                                                                        ?>
                                                                    </h4>
                                                                    <h6 class="mb-2" style="font-size:11px ;color:gray;">Already volunteered</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php }
                                                    if ($missi->deadline != null) { ?>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6" style="color:black;">
                                                            <div class="row">
                                                                <div class="col-lg-1 col-md-1 col-sm-1 col-1 m-1 mt-0 mb-0"><img src="../mvc/Assets/images/deadline.png" alt="" style="height:28px"></div>
                                                                <div class="col-lg-9 col-md-9 col-sm-9 col-9">
                                                                    <h4 class="mb-2" style="font-size:calc(13px + 0.1vw);">
                                                                        <?php
                                                                        $deadline = date("d/m/Y", strtotime($missi->deadline));
                                                                        echo "$deadline";
                                                                        ?>
                                                                    </h4>
                                                                    <h6 class="mb-2" style="font-size:12px ;color:gray;">Deadline</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php }
                                                } else { ?>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6" style="color:black;">
                                                        <div class="row">
                                                            <div class="col-lg-1 col-md-1 col-sm-1 col-1 m-1 mt-0 mb-0"><img src="../mvc/Assets/images/achieved.png" alt="" style="height:22px"></div>
                                                            <div class="col-lg-9 col-md-9 col-sm-9 col-9">
                                                                <div class="mt-1 mb-3" style="background-color:#EEEEEE; height:7px; width:100%; border-radius: 10px;">
                                                                    <div style="background-color:#f88634; height:7px; border-radius: 10px; width:80%;">
                                                                    </div>
                                                                </div>
                                                                <h6 class="mb-2" style="font-size:12px ;color:gray;">8000 achieved</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php }  ?>
                                </div>
                                <hr class="div">
                                <div class="d-flex align-items-center justify-content-center">
                                    <button class=" col-example mt-3" style="font-size:calc(13px + 0.1vw);">
                                        <?php
                                        $key = 0;
                                        foreach ($appusers as $appuser) {
                                            if ($appuser->mission_id == $missi->missionid) {
                                                $key = 1;
                                                break;
                                            }
                                        }
                                        if ($missi->mission_type == 'TIME') {
                                            $current = date("Y-m-d h:i:s");
                                            if ($missi->deadline != null && $current > $missi->deadline) {
                                                $key = 1;
                                            } else if ($missi->end_date != null && $current > $missi->end_date) {
                                                $key = 1;
                                            }
                                        }
                                        $k = 0;
                                        $c = 10;
                                        foreach ($seats as $seat) {
                                            if ($seat->mission_id == $missi->missionid) {
                                                $k = 1;
                                                break;
                                            }
                                        }
                                        if ($k == 1) {
                                            $c = $missi->total_seat - $seat->count;
                                        }
                                        if ($key == 1 || $c == 0) { ?>
                                            <a href="Volunteering_Mission?id=<?php $id = $missi->mission_id;
                                                                                $salt = "SECRET_STUFF";
                                                                                $encrypted_id = base64_encode($id . $salt);
                                                                                echo $encrypted_id; ?>" style="color: inherit;">View Detail</a>
                                        <?php } else { ?>
                                            <a href="home?source=apply&id=<?php echo $missi->mission_id;?>" style="color: inherit;">Apply</a>
                                        <?php }
                                        ?>
                                        <i class="fa fa-arrow-right ps-2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php 
                } ?>
            </div>
            <br>
        </div>
<?php } else {
        echo '<br/><br/><br/>';
    }
} ?>