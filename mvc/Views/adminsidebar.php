<div id="popup1" class="modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-2">
            <div class="modal-header pb-0" style="border-bottom:0 ;">
                <p class="mb-0" style="font-size:20px ;">Confirm Delete </p>
            </div>
            <div class="modal-body pb-0">
                Are you sure you want to delete this item?
            </div>
            <div class="modal-footer mt-3 justify-content-center" style="border-top:0 ;">
                <button type="button" class="col-example8" data-bs-dismiss="modal">Cancle
                </button>
                <button type="button" class="col-example7" data-bs-dismiss="modal">Delete
                </button>
            </div>
        </div>
    </div>
</div>
<div class="row h-100 p-0 m-0">
    <div class="col-md-2 d-md-none col-sm-2 col-2 ps-2 pe-2 position-relative" style="background-color: #f88634;">
        <div class="position-sticky top-0 pt-5">
            <div class="nav flex-column nav-pills m-0">
                <button class="nav-link active text-center" data-bs-toggle="pill" data-bs-target="#user">
                    <i class="fa fa-user p-1" aria-hidden="true"></i>
                </button>
                <button class="nav-link text-center" data-bs-toggle="pill" data-bs-target="#page">
                    <i class="fa fa-file-text p-1" aria-hidden="true"></i>
                </button>
                <button class="nav-link text-center" data-bs-toggle="pill" data-bs-target="#mission">
                    <i class="fa fa-bullseye p-1" aria-hidden="true"></i>
                </button>
                <button class="nav-link text-center" data-bs-toggle="pill" data-bs-target="#theme">
                    <i class="fa fa-object-ungroup p-1" aria-hidden="true"></i>
                </button>
                <button class="nav-link text-center" data-bs-toggle="pill" data-bs-target="#skill">
                    <i class="fa fa-pencil-square-o p-1" aria-hidden="true"></i>
                </button>
                <button class="nav-link text-center" data-bs-toggle="pill" data-bs-target="#app">
                    <i class="fa fa-clone p-1" aria-hidden="true"></i>
                </button>
                <button class="nav-link text-center" data-bs-toggle="pill" data-bs-target="#story">
                    <i class="fa fa-book p-1" aria-hidden="true"></i>
                </button>
                <button class="nav-link text-center" data-bs-toggle="pill" data-bs-target="#banner">
                    <i class="fa fa-map-signs p-1" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="d-none col-lg-2 col-md-2 d-md-block m-0 p-0 position-relative" style="background-color: #f88634;">
        <div class="position-sticky top-0 pt-4">
            <p class="p-3 mb-0" style="color:white ;">NEVIGATION</p>
            <div class="nav flex-column nav-pills ms-4 me-4" style="font-size:14px ;">
                <?php if ($case == 1) { ?>
                    <a href="user" class="nav-link text-start active">
                    <?php } else { ?>
                        <a href="user" class="nav-link text-start">
                        <?php } ?>
                        <i class="fa fa-user me-2 p-1" aria-hidden="true"></i>
                        User
                        </a>
                        <?php if ($case == 2) { ?>
                            <a href="page" class="nav-link text-start  active">
                            <?php } else { ?>
                                <a href="page" class="nav-link text-start">
                                <?php } ?>
                                <i class="fa fa-file-text me-2 p-1" aria-hidden="true"></i>
                                CMS Page
                                </a>
                                <?php if ($case == 3) { ?>
                                    <a href="mission" class="nav-link text-start active">
                                    <?php } else { ?>
                                        <a href="mission" class="nav-link text-start">
                                        <?php } ?>
                                        <i class="fa fa-bullseye me-2 p-1" aria-hidden="true"></i>
                                        Mission
                                        </a>
                                        <?php if ($case == 4) { ?>
                                            <a href="theme" class="nav-link text-start  active">
                                            <?php } else { ?>
                                                <a href="theme" class="nav-link text-start">
                                                <?php } ?>
                                                <i class="fa fa-object-ungroup me-2 p-1" aria-hidden="true"></i>
                                                Mission Theme
                                                </a>
                                                <?php if ($case == 5) { ?>
                                                    <a href="skill" class="nav-link text-start active">
                                                    <?php } else { ?>
                                                        <a href="skill" class="nav-link text-start">
                                                        <?php } ?>
                                                        <i class="fa fa-pencil-square-o me-2 p-1" aria-hidden="true"></i>
                                                        Mission Skill
                                                        </a>
                                                        <?php if ($case == 6) { ?>
                                                            <a href="app" class="nav-link text-start  active">
                                                            <?php } else { ?>
                                                                <a href="app" class="nav-link text-start">
                                                                <?php } ?>
                                                                <i class="fa fa-folder me-2 p-1" aria-hidden="true"></i></i>
                                                                Mission Application
                                                                </a>
                                                                <?php if ($case == 7) { ?>
                                                                    <a href="story" class="nav-link text-start active">
                                                                    <?php } else { ?>
                                                                        <a href="story" class="nav-link text-start">
                                                                        <?php } ?>
                                                                        <i class="fa fa-book  me-2 p-1" aria-hidden="true"></i>
                                                                        Story
                                                                        </a>
                                                                        <?php if ($case == 8) { ?>
                                                                            <a href="banner" class="nav-link text-start  active">
                                                                            <?php } else { ?>
                                                                                <a href="banner" class="nav-link text-start">
                                                                                <?php } ?>
                                                                                <i class="fa fa-map-signs me-2 p-1" aria-hidden="true"></i>
                                                                                Banner Management
                                                                                </a>
            </div>
        </div>
    </div>
    <div class="col-lg-10 col-md-10 col-sm-10 col-10 m-0 p-0 position-relative">
        <div class="position-sticky top-0" style="z-index: 2">
            <div class="d-flex justify-content-between hd ">
                <div class="p-3">
                    <?php echo date('l, F d, Y, h:i A'); ?>
                </div>
                <nav class="navbar navbar-expand" style="background-color:white ;">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent1">
                        <ul class="navbar-nav me-auto mb-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle me-4" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="../Assets/<?php if ($avtar == '') echo 'user1.png';
                                                        else echo $avtar; ?>" class="rounded-circle m-2 mt-0 mb-0 col" width="29" height="29">
                                    <label><?php echo $firstname . ' ' . $lastname; ?></label>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="edit_user.html">My Profile</a></li>
                                    <li><a class="dropdown-item" href="timesheet.html">volunteering timesheet</a></li>
                                    <li><a class="dropdown-item" href="logout">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>