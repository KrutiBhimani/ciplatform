<div class="fixed-top border-sm-block" style="background-color:white ; border-bottom:2px solid rgb(225, 225, 225)">
    <div class="container-lg">
        <div class="d-flex justify-content-between position-relative">
            <nav class="navbar navbar-expand-sm" style="background-color:white ;">
                <img class="d-none d-sm-block" src="mvc/Assets/images/logo.png">
                <div class="container-fluid">
                    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"><img src="mvc/Assets/images/list.png" /></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
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
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="mvc/Assets/<?php if ($user->avatar == '') echo 'images/user1.png';
                                                        else echo 'uplodes/' . $user->avatar; ?>" class="rounded-circle col" style="height: 30px;width: 60px;">
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