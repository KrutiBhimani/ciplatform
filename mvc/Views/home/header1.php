<div class="fixed-top border-sm-block" style="background-color:white ; border-bottom:2px solid rgb(225, 225, 225);z-index:1;">
    <div class="container-lg">
        <div class="d-flex justify-content-between position-relative">
            <nav class="navbar navbar-expand-sm ps-0 pe-0 " style="background-color:white ;">
                <a href="home"><img class="d-none d-sm-block" src="mvc/Assets/images/logo.png"></a>
                <div class="container-fluid">
                    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"><img src="mvc/Assets/images/list.png" /></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <!-- <li class="nav-item dropdown me-3">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Explore
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="home?source=toptheme">Top Themes</a></li>
                                <li><a class="dropdown-item" href="home?source=mostranked">Most Ranked</a></li>
                                <li><a class="dropdown-item" href="home?source=topfav">Top Favourite</a></li>
                                <li><a class="dropdown-item" href="home?source=random">Random</a></li>
                            </ul>
                        </li> -->
                            <li class="nav-item">
                                <a class="nav-link" href="stories">Stories</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="policy">Policy</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <nav class="navbar d-sm-none navbar-expand position-absolute top-0 end-0 pb-0" style="background-color:white ;">
                <div class="collapse navbar-collapse" id="navbarSupportedContent1">
                    <ul class="navbar-nav me-auto mb-lg-0">
                        <li class="nav-item me-3 hello">
                            <a class="nav-link dropdown-toggle position-relative mt-2" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="mvc/Assets/images/bell.png">
                                <div class="rounded-circle position-absolute top-0 end-0" style="background-color:#f88634; font-size:10px;padding:0px 3px;font-weight:bold;color:white;">11</div>
                            </a>
                            <div class="dropdown-menu position-absolute top-100 right-0" aria-labelledby="navbarDropdown" style='right:0;'>
                                <div style="display: flex;justify-content:space-between;color:gray;">
                                    <i class="fa fa-cog p-2" aria-hidden="true"></i>
                                    Notification
                                    <a href='home?source=clear&user=<?php echo $note->user_id; ?>&server=<?php echo $server; ?>'>Clear all</a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="mvc/Assets/<?php if ($user->avatar == '') echo 'images/user1.png';
                                                        else echo 'uplodes/' . $user->avatar; ?>" class="rounded-circle col" style="height: 30px;width: 60px;">
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="edit_user">My Profile</a></li>
                                <li><a class="dropdown-item" href="user_timesheet">volunteering timesheet</a></li>
                                <li><a class="dropdown-item" href="logout">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <nav class="navbar d-none d-sm-block navbar-expand" style="background-color:white ;">
                <div class="collapse navbar-collapse" id="navbarSupportedContent1">
                    <ul class="navbar-nav me-auto mb-lg-0">
                        <li class="nav-item me-3 hello">
                            <a class="nav-link dropdown-toggle position-relative mt-2" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="mvc/Assets/images/bell.png">
                                <?php $count = 0;
                                $lc = 0;
                                $server = $_SERVER['PATH_INFO'];
                                $server = ltrim($server, '/');
                                foreach ($notes as $note) {
                                    if ($note->user_id == $user->user_id) {
                                        $count++;
                                    }
                                } ?>
                                <div class="rounded-circle position-absolute top-0 end-0" style="background-color:#f88634; font-size:10px;padding:0px 3px;font-weight:bold;color:white;"><?php echo $count; ?></div>
                            </a>
                            <div class="dropdown-menu position-absolute top-100 right-0" aria-labelledby="navbarDropdown" style='right:0;left:-100px'>
                                <div class='d-flex align-items-center' style="display: flex;justify-content:space-between;color:gray;">
                                    <a href="#" style="color: black;" data-bs-toggle="modal" data-bs-target="#popupfdsds"><i class="fa fa-cog pl-2 pr-0 pb-2 pt-1" aria-hidden="true" style="font-size:25px;color:gray"></i></a>
                                    Notification
                                    <a href='home?source=clear&user=<?php echo $user->user_id; ?>&server=<?php echo $server; ?>' style='font-size:13px;color:gray;padding:0px 5px'>Clear all</a>
                                </div>
                                <?php foreach ($notes as $note) {
                                    $created_at = $note->created_at;
                                    $start_date = new DateTime($created_at);
                                    $end_date = new DateTime(date("Y-m-d H:i:s"));
                                    $interval = $start_date->diff($end_date);
                                    $min = $interval->format('%i');
                                    $hour = $interval->format('%h');
                                    $mon = $interval->format('%m');
                                    $day = $interval->format('%d');
                                    $year = $interval->format('%y');
                                    $diff = $year + $mon + $day * 24 * 60 + $hour * 60 + $min;
                                    if ($diff < 1440 && $note->user_id == $user->user_id) {
                                        $lc++;
                                ?>
                                        <hr class='div' />
                                        <div class='p-2 pr-3 row align-items-center'>
                                            <img class='col-lg-2 col-md-2 col-sm-2 col-2 rounded-circle' src="mvc/Assets/images/add.png" height='27px' width='22px'>
                                            <span class='col-lg-9 col-md-9 col-sm-9 col-9 m-0 p-0'><?php echo $note->message ?></span>
                                            <?php if ($note->status == 1) { ?>
                                                <a class="col-lg-1 col-md-1 col-sm-1 col-1 rounded-circle text-end me-2" href="home?source=read&note=<?php echo $note->notification_id; ?>&user=<?php echo $user->user_id; ?>&server=<?php echo $server; ?>" style="background-color:#f88634;padding-right:0;height:15px;flex:0 0 0;"></a>
                                            <?php } else { ?>
                                                <div class="col-lg-1 col-md-1 col-sm-1 col-1 rounded-circle text-end me-2" style="background-color:gray;padding-right:0;height:15px;flex:0 0 0;"></div>
                                            <?php } ?>
                                        </div>
                                <?php }
                                } ?>
                                <?php if ($lc < $count) { ?>
                                    <div class='w-100 text-center' style="border-top:1px solid #dddddd;border-bottom:1px solid #dddddd;background-color:#e8e8e8;color:gray;">Older</div>
                                <?php } ?>
                                <?php foreach ($notes as $note) {
                                    $created_at = $note->created_at;
                                    $start_date = new DateTime($created_at);
                                    $end_date = new DateTime(date("Y-m-d H:i:s"));
                                    $interval = $start_date->diff($end_date);
                                    $min = $interval->format('%i');
                                    $hour = $interval->format('%h');
                                    $mon = $interval->format('%m');
                                    $day = $interval->format('%d');
                                    $year = $interval->format('%y');
                                    $diff = $year + $mon + $day * 24 * 60 + $hour * 60 + $min;
                                    if ($diff >= 1440 && $note->user_id == $user->user_id) {

                                ?>
                                        <hr class='div' />
                                        <div class='p-2 pr-3 row align-items-center'>
                                            <img class='col-lg-2 col-md-2 col-sm-2 col-2 rounded-circle' src="mvc/Assets/images/add.png" height='27px' width='22px'>
                                            <span class='col-lg-9 col-md-9 col-sm-9 col-9 m-0 p-0'><?php echo $note->message ?></span>
                                            <?php if ($note->status == 1) { ?>
                                                <a class="col-lg-1 col-md-1 col-sm-1 col-1 rounded-circle text-end me-2" href="home?source=read&note=<?php echo $note->notification_id; ?>&user=<?php echo $note->user_id; ?>&server=<?php echo $server; ?>" style="background-color:#f88634;padding-right:0;height:15px;flex:0 0 0;"></a>
                                            <?php } else { ?>
                                                <div class="col-lg-1 col-md-1 col-sm-1 col-1 rounded-circle text-end me-2" style="background-color:gray;padding-right:0;height:15px;flex:0 0 0;"></div>
                                            <?php } ?>
                                        </div>
                                <?php }
                                } ?>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="mvc/Assets/<?php if ($user->avatar == '') echo 'images/user1.png';
                                                        else echo 'uplodes/' . $user->avatar; ?>" class="rounded-circle col p-0" style="height: 30px;width: 30px;">
                                <label><?php echo $user->first_name . ' ' . $user->last_name; ?></label>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="edit_user">My Profile</a></li>
                                <li><a class="dropdown-item" href="user_timesheet">volunteering timesheet</a></li>
                                <li><a class="dropdown-item" href="logout">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>
<div id="popupfdsds" class="modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-2">
            <div class="modal-header pb-0" style="border-bottom:0 ;">
                <p class="mb-0" style="font-size:20px ;">Notification Setting</p>
                <img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png" data-bs-dismiss="modal" style="cursor: pointer;height:13px">
            </div>

            <div class='w-100 mt-3 mb-3 pr-3 pl-3 pt-2 pb-2' style="border-top:1px solid #dddddd;border-bottom:1px solid #dddddd;background-color:#e8e8e8;color:gray;">Get a notification for</div>
            <form class="m-0" method="post" enctype="multipart/form-data">
                <div class="modal-body pb-0 mb-3">
                    <div class="d-flex justify-content-between">
                        <p class="mb-1">New Mission</p>
                        <input type="checkbox" class="cb" name="note[]" value="1" <?php if (isset($_POST['note'])) {
                                                                                        foreach ($_POST['note'] as $item) {
                                                                                            if (1 == $item) {
                                                                                                echo 'checked';
                                                                                            }
                                                                                        }
                                                                                    } ?>>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="mb-1">New Story</p>
                        <input type="checkbox" class="cb" name="note[]" value="2" <?php if (isset($_POST['note'])) {
                                                                                        foreach ($_POST['note'] as $item) {
                                                                                            if (2 == $item) {
                                                                                                echo 'checked';
                                                                                            }
                                                                                        }
                                                                                    } ?>>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="mb-1">Story Status</p>
                        <input type="checkbox" class="cb" name="note[]" value="4" <?php if (isset($_POST['note'])) {
                                                                                        foreach ($_POST['note'] as $item) {
                                                                                            if (4 == $item) {
                                                                                                echo 'checked';
                                                                                            }
                                                                                        }
                                                                                    } ?>>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="mb-1">Mission Application Status</p>
                        <input type="checkbox" class="cb" name="note[]" value="5" <?php if (isset($_POST['note'])) {
                                                                                        foreach ($_POST['note'] as $item) {
                                                                                            if (5 == $item) {
                                                                                                echo 'checked';
                                                                                            }
                                                                                        }
                                                                                    } ?>>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="mb-1">Mission Invites</p>
                        <input type="checkbox" class="cb" name="note[]" value="3" <?php if (isset($_POST['note'])) {
                                                                                        foreach ($_POST['note'] as $item) {
                                                                                            if (3 == $item) {
                                                                                                echo 'checked';
                                                                                            }
                                                                                        }
                                                                                    } ?>>
                    </div>
                </div>
                <div class="modal-footer" style="border-top:0 ;">
                    <button type="button" class="col-example8" data-bs-dismiss="modal">Cancle
                    </button>
                    <button type="submit" name='notification' class="col-example7" data-bs-dismiss="modal">Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>