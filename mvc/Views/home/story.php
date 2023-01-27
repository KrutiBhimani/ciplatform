<br /><br />
<div class="example mt-3">
    <img class="image1" src="mvc/Assets/images/Grow-Trees-On-the-path-to-environment-sustainability-login - Copy.png">
    <div class="middle">
        <p class="txt1 mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
            incididunt ut
            labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
            laboris nisi ut aliquip</p>
        <a href="share_story">
            <div class="text text-center">Share your Story
                <i class="fa fa-arrow-right pl-2"></i>
            </div>
        </a>

    </div>
</div>
<div class="container-lg">
    <div class="row row-eq-height justify-content-center mt-5">
        <?php foreach ($stories as $story) { ?>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-5 d-flex align-items-stretch">
                <div class="card box border-0">
                    <div class="gfg1">
                        <img src="<?php echo $story->path ?>" alt="" class="img-fluid image2" style="width:100%; height:170px">
                        <div class="middle1">
                            <a href="story_detail?key=<?php $id = $story->story_id;
                                                        $salt = "SECRET_STUFF";
                                                        $encrypted_id = base64_encode($id . $salt);
                                                        echo $encrypted_id; ?>">
                                <div class="text1 text-center">View Detail
                                    <i class="fa fa-arrow-right pl-2"></i>
                                </div>
                            </a>
                        </div>
                        <div class="d-flex four-txt justify-content-center">
                            <div class="bdg1"><?php echo $story->title ?></div>
                        </div>
                    </div>
                    <div class="card-body remove">
                        <h2 class="card-title mb-2" style="font-size:calc(15px + 0.3vw);"><?php echo $story->story_title ?></h2>
                        <p class="mb-3" style="color:gray; font-size:calc(11px + 0.1vw);"><?php echo substr($story->sdescription, 0, 99) . '...'; ?></p>

                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                <img src="mvc/Assets/<?php if ($story->avatar == '') echo 'images/user1.png';
                                                        else echo 'uplodes/' . $story->avatar; ?>" class="rounded-circle" height="34px" width="34px">
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-8 pt-2 pb-2">
                                <p class="mb-0" style="font-size:12px ;"><?php echo $story->first_name . ' ' . $story->last_name ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <nav aria-label="Page navigation example">
            <ul class="pagination pager justify-content-center">
                <?php
                $next = $page + 1;
                $previous = $page - 1;
                if ($page == 1) {
                    echo "<li class='page-item'><a class='page-link' style='border-radius:5px; padding:9px; height:30px; width:30px; margin:4px;'><img src='mvc/Assets/images/previous.png' alt=''></a></li>";
                    echo "<li class='page-item'><a class='page-link' style='border-radius:5px; padding:9px; height:30px; width:30px; margin:4px;'><img src='mvc/Assets/images/left.png' alt=''></a></li>";
                } else {
                    echo "<li class='page-item'><a class='page-link' href='stories?page=1' style='border-radius:5px; padding:9px; height:30px; width:30px; margin:4px;'><img src='mvc/Assets/images/previous.png' alt=''></a></li>";
                    echo "<li class='page-item'><a class='page-link' href='stories?page=$previous' style='border-radius:5px; padding:9px; height:30px; width:30px; margin:4px;'><img src='mvc/Assets/images/left.png' alt=''></a></li>";
                }
                for ($i = 1; $i <= $cnt; $i++) {
                    if ($i == $page)
                        echo "<li class='page-item'><a class='page-link active text-center' href='stories?page=$i' style='border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px;'><b>$i</b></a></li>";
                    else
                        echo "<li class='page-item'><a class='page-link text-center' href='stories?page=$i' style='border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px; color:black;'>$i</a></li>";
                }
                if ($page == $cnt) {
                    echo "<li class='page-item'><a class='page-link' style='border-radius:5px; padding:9px; height:30px; width:30px; margin:4px;'><img src='mvc/Assets/images/arrow.png' alt=''></a></li>";
                    echo "<li class='page-item'><a class='page-link' style='border-radius:5px; padding:9px; height:30px; width:30px; margin:4px;'><img src='mvc/Assets/images/next.png' alt=''></a></li>";
                } else {
                    echo "<li class='page-item'><a class='page-link' href='stories?page=$next' style='border-radius:5px; padding:9px; height:30px; width:30px; margin:4px;'><img src='mvc/Assets/images/arrow.png' alt=''></a></li>";
                    echo "<li class='page-item'><a class='page-link' href='stories?page=$cnt' style='border-radius:5px; padding:9px; height:30px; width:30px; margin:4px;'><img src='mvc/Assets/images/next.png' alt=''></a></li>";
                }
                ?>
            </ul>
        </nav>
    </div><br>

</div>