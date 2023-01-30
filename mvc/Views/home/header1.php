<div class="fixed-top border-sm-block" style="background-color:white ; border-bottom:2px solid rgb(225, 225, 225)">
    <div class="container-lg">
        <div class="d-flex justify-content-between position-relative">
            <nav class="navbar navbar-expand-sm ps-0 pe-0 " style="background-color:white ;">
                <img class="d-none d-sm-block" src="mvc/Assets/images/logo.png">
                <div class="container-fluid">
                    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"><img src="mvc/Assets/images/list.png" /></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item dropdown me-3">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Explore
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="">Top Themes</a></li>
                                    <li><a class="dropdown-item" href="">Most Ranked</a></li>
                                    <li><a class="dropdown-item" href="">Top Favourite</a></li>
                                    <li><a class="dropdown-item" href="">Random</a></li>
                                </ul>
                            </li>
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
                        <li class="nav-item">
                            <img src="mvc/Assets/images/bell.png" style="height: 30px;width: 60px;">
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
                                <div class="rounded-circle position-absolute top-0 end-0" style="background-color:#f88634; font-size:10px;padding:0px 3px;font-weight:bold;color:white;">11</div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown" style='min-width:200px'>
                                <div style="display: flex;justify-content:space-between;color:gray;">
                                    <i class="fa fa-cog" aria-hidden="true"></i>
                                    Notification
                                    <a href=''>Clear all</a>
                                </div>
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
                <p class="mb-0" style="font-size:20px ;">contact Us</p>
                <img class="text-end mt-2 mb-2" src="mvc/Assets/images/cancel1.png" data-bs-dismiss="modal" style="cursor: pointer;height:13px">
            </div>
            <form class="m-0" method="post" enctype="multipart/form-data">
                <div class="modal-body pb-0">
                    <p class="mb-1">Name*</p>
                    <input type="text" class="popup" name="" value="<?php echo $user->first_name . ' ' . $user->last_name ?>" disabled>
                    <p class="mb-1 mt-3">Email Address*</p>
                    <input type="email" class="popup" name="" value="<?php echo $user->email ?>" disabled>
                    <p class="mb-1 mt-3">Subject*</p>
                    <input type="text" class="popup" name="subject" placeholder="Enter your subject">
                    <p class="mb-1 mt-3">Message*</p>
                    <textarea class="popup1" rows="4" name="message" placeholder="Enter your message"></textarea>
                </div>
                <div class="modal-footer" style="border-top:0 ;">
                    <button type="button" class="col-example8" data-bs-dismiss="modal">Cancle
                    </button>
                    <button type="submit" name='contact' class="col-example7" data-bs-dismiss="modal">Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>