<div class="fixed-top border-sm-block" style="background-color:white ; border-bottom:2px solid rgb(225, 225, 225)">
    <div class="container-lg">
        <div class="d-flex justify-content-between position-relative">
            <nav class="navbar navbar-expand-sm" style="background-color:white ;">
                <img class="d-none d-sm-block" src="../mvc/Assets/images/logo.png">
                <div class="container-fluid">
                    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="../design/storylist.php">Stories</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Policy
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Volunteering</a></li>
                                    <li><a class="dropdown-item" href="#">Sponsored</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <nav class="navbar d-sm-none navbar-expand position-absolute top-0 end-0 pb-0" style="background-color:white ;">
                <div class="collapse navbar-collapse" id="navbarSupportedContent1">
                    <ul class="navbar-nav me-auto mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="../mvc/Assets/uplodes/<?php if ($avatar == '') echo 'user1.png';
                                                    else echo $avatar; ?>" class="rounded-circle m-2 mt-0 mb-0 col" width="29" height="29">
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
            <nav class="navbar d-none d-sm-block navbar-expand" style="background-color:white ;">
                <div class="collapse navbar-collapse" id="navbarSupportedContent1">
                    <ul class="navbar-nav me-auto mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="../mvc/Assets/<?php if ($admin->avatar == '') echo 'images/user1.png'; else echo 'uplodes/'.$admin->avatar; ?>" class="rounded-circle m-2 mt-0 mb-0 col" width="29" height="29">
                                <label><?php echo $admin->first_name . ' ' . $admin->last_name; ?></label>
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
</div>