<?php include "header.php"; ?>
<?php include "db.php";
session_start(); ?>
<?php
if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
    $id = $_SESSION['admin_id'];
    $query2 = "SELECT * FROM admin WHERE admin_id = $id";
    $result2 = mysqli_query($connection, $query2);
    while ($row = mysqli_fetch_assoc($result2)) {
        $id = $row['admin_id'];
        $email = $row['email'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $avatar = $row['avatar'];
?>
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
                        <?php if (isset($_POST['add_cmspage']) || isset($_POST['add_mission']) || isset($_POST['add_theme']) || isset($_POST['add_skill'])) {
                            echo "<button class='nav-link text-center' data-bs-toggle='pill' data-bs-target='#user'>";
                        } else {
                            echo "<button class='nav-link active text-center' data-bs-toggle='pill' data-bs-target='#user'>";
                        } ?>
                        <i class="fa fa-user p-1" aria-hidden="true"></i>
                        </button>
                        <?php if (isset($_POST['add_cmspage'])) {
                            echo "<button class='nav-link active text-center' data-bs-toggle='pill' data-bs-target='#page'>";
                        } else {
                            echo "<button class='nav-link text-center' data-bs-toggle='pill' data-bs-target='#page'>";
                        } ?>
                        <i class="fa fa-file-text p-1" aria-hidden="true"></i>
                        </button>
                        <?php if (isset($_POST['add_mission'])) {
                            echo "<button class='nav-link active text-center' data-bs-toggle='pill' data-bs-target='#mission'>";
                        } else {
                            echo "<button class='nav-link text-center' data-bs-toggle='pill' data-bs-target='#mission'>";
                        } ?>
                        <i class="fa fa-bullseye p-1" aria-hidden="true"></i>
                        </button>
                        <?php if (isset($_POST['add_theme'])) {
                            echo "<button class='nav-link active text-theme' data-bs-toggle='pill' data-bs-target='#theme'>";
                        } else {
                            echo "<button class='nav-link text-theme' data-bs-toggle='pill' data-bs-target='#theme'>";
                        } ?>
                        <i class="fa fa-object-ungroup p-1" aria-hidden="true"></i>
                        </button>
                        <?php if (isset($_POST['add_skill'])) {
                            echo "<button class='nav-link active text-center' data-bs-toggle='pill' data-bs-target='#skill'>";
                        } else {
                            echo "<button class='nav-link text-center' data-bs-toggle='pill' data-bs-target='#skill'>";
                        } ?>
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
                        <?php if (isset($_POST['add_cmspage']) || isset($_POST['add_mission']) || isset($_POST['add_theme']) || isset($_POST['add_skill'])) {
                            echo "<button class='nav-link text-start' data-bs-toggle='pill' data-bs-target='#user'>";
                        } else {
                            echo "<button class='nav-link active text-start' data-bs-toggle='pill' data-bs-target='#user'>";
                        } ?>
                        <i class="fa fa-user me-2 p-1" aria-hidden="true"></i>
                        User
                        </button>
                        <?php if (isset($_POST['add_cmspage'])) {
                            echo "<button class='nav-link active text-start' data-bs-toggle='pill' data-bs-target='#page'>";
                        } else {
                            echo "<button class='nav-link text-start' data-bs-toggle='pill' data-bs-target='#page'>";
                        } ?>
                        <i class="fa fa-file-text  me-2 p-1" aria-hidden="true"></i>
                        CMS Pages
                        </button>
                        <?php if (isset($_POST['add_mission'])) {
                            echo "<button class='nav-link active text-start' data-bs-toggle='pill' data-bs-target='#mission'>";
                        } else {
                            echo "<button class='nav-link text-start' data-bs-toggle='pill' data-bs-target='#mission'>";
                        } ?>
                        <i class="fa fa-bullseye  me-2 p-1" aria-hidden="true"></i>
                        Mission
                        </button>
                        <?php if (isset($_POST['add_theme'])) {
                            echo "<button class='nav-link active text-start' data-bs-toggle='pill' data-bs-target='#theme'>";
                        } else {
                            echo "<button class='nav-link text-start' data-bs-toggle='pill' data-bs-target='#theme'>";
                        } ?>
                        <i class="fa fa-object-ungroup  me-2 p-1" aria-hidden="true"></i>
                        Mission Theme
                        </button>
                        <?php if (isset($_POST['add_skill'])) {
                            echo "<button class='nav-link active text-start' data-bs-toggle='pill' data-bs-target='#skill'>";
                        } else {
                            echo "<button class='nav-link text-start' data-bs-toggle='pill' data-bs-target='#skill'>";
                        } ?>
                        <i class="fa fa-pencil-square-o  me-2 p-1" aria-hidden="true"></i>
                        Mission Skill
                        </button>
                        <button class="nav-link text-start" data-bs-toggle="pill" data-bs-target="#app">
                            <i class="fa fa-folder me-2 p-1" aria-hidden="true"></i></i>
                            Mission Application
                        </button>
                        <button class="nav-link text-start" data-bs-toggle="pill" data-bs-target="#story">
                            <i class="fa fa-book  me-2 p-1" aria-hidden="true"></i>
                            Story
                        </button>
                        <button class="nav-link text-start" data-bs-toggle="pill" data-bs-target="#banner">
                            <i class="fa fa-map-signs me-2 p-1" aria-hidden="true"></i>
                            Banner Management
                        </button>
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
                                            <img src="../Assets/<?php if ($avatar == '') echo 'user1.png';
                                                                else echo $avatar; ?>" class="rounded-circle m-2 mt-0 mb-0 col" width="29" height="29">
                                            <label><?php echo $first_name . " " . $last_name ?></label>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <li><a class="dropdown-item" href="edit_user.html">My Profile</a></li>
                                            <li><a class="dropdown-item" href="timesheet.html">volunteering timesheet</a></li>
                                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
                <div class="tab-content p-3" style="z-index: 1">
                    <?php if (isset($_POST['add_cmspage']) || isset($_POST['add_mission']) || isset($_POST['add_theme']) || isset($_POST['add_skill'])) {
                        echo "<div class='tab-pane' id='user'>";
                    } else {
                        echo "<div class='tab-pane show active' id='user'>";
                    } ?>
                    <?php if (isset($_POST['add_user'])) { ?>
                        <br />
                        <form action="test.php" method="post" enctype="multipart/form-data">
                            <table class="table table-borderless" style="border: 1px solid #dee2e6;">
                                <thead class="table-light border-bottom">
                                    <tr>
                                        <td class="p-3 fs-6" scope="col">Add</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="p-3 fs-6">
                                            <p class="mb-1" style="font-size:14px;">First Name</p>
                                            <input type="text" name="first_name" class="popup">
                                            <p class="mb-1 mt-4" style="font-size:14px;">Last Name</p>
                                            <input type="text" name="last_name" class="popup">
                                            <p class="mb-1 mt-4" style="font-size:14px;">Email</p>
                                            <input type="email" name="email" class="popup" required>
                                            <p class="mb-1 mt-4" style="font-size:14px;">Phone number</p>
                                            <input type="text" name="phone_number" class="popup" required>
                                            <p class="mb-1 mt-4" style="font-size:14px;">password</p>
                                            <input type="password" name="password" class="popup" required>
                                            <p class="mb-1 mt-4" style="font-size:14px;">Avatar</p>
                                            <input type="file" name="avatar" value="">
                                            <p class="mb-1 mt-4" style="font-size:14px;">Employee ID</p>
                                            <input type="text" name="employee_id" class="popup">
                                            <p class="mb-1 mt-4" style="font-size:14px;">Department</p>
                                            <input type="text" name="department" class="popup">
                                            <p class="mb-1 mt-4" style="font-size:14px;">City</p>
                                            <select class="popup pt-0 pb-0" name="city_id" required>
                                                <option value="none" selected="" disabled="" hidden=""></option>
                                                <?php
                                                $query = "SELECT * From city";
                                                $result = mysqli_query($connection, $query);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $city_id = $row['city_id'];
                                                    $name = $row['name'];
                                                    echo "<option value='$city_id'>$name</option>";
                                                }
                                                ?>
                                            </select>
                                            <p class="mb-1 mt-4" style="font-size:14px;">Country</p>
                                            <select class="popup pt-0 pb-0" name="country_id" required>
                                                <option value="none" selected="" disabled="" hidden=""></option>
                                                <?php
                                                $query = "SELECT * From country";
                                                $result = mysqli_query($connection, $query);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $country_id = $row['country_id'];
                                                    $name = $row['name'];
                                                    echo "<option value='$country_id'>$name</option>";
                                                }
                                                ?>
                                            </select>
                                            <p class="mb-1 mt-4" style="font-size:14px;">Profile text</p>
                                            <textarea rows="5" name="profile_text" class="popup1"></textarea>
                                            <p class="mb-1 mt-4" style="font-size:14px;">Status</p>
                                            <select class="popup pt-0 pb-0" name="status">
                                                <option value='1'>Active</option>
                                                <option value='0'>Inactive</option>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="d-flex align-content-end justify-content-end">
                                <a class="col-example8 mt-4 mb-4 me-2" href="ruff.html" style="font-size:calc(13px + 0.1vw);">
                                    cancel
                                </a>
                                <button class="col-example mt-4 mb-4" name="adduser" type="submit" style="font-size:calc(13px + 0.1vw);">
                                    save
                                </button>
                            </div>
                        </form>
                    <?php } else if (isset($_GET['edit'])) {

                        $user_id = $_GET['edit'];
                        $query = "SELECT *,city.name as city_name,country.name as country_name FROM user 
                            join city ON user.city_id = city.city_id
                            join country ON user.country_id = country.country_id
                            Where user_id = $user_id";
                        $result = mysqli_query($connection, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            $user_id = $row['user_id'];
                            $first_name = $row['first_name'];
                            $last_name = $row['last_name'];
                            $email = $row['email'];
                            $phone_number = $row['phone_number'];
                            $password = $row['password'];
                            $avatar = $row['avatar'];
                            $employee_id = $row['employee_id'];
                            $department = $row['department'];
                            $city_name = $row['city_name'];
                            $country_name = $row['country_name'];
                            $city_id = $row['city_id'];
                            $country_id = $row['country_id'];
                            $profile_text = $row['profile_text'];
                            $status = $row['status'];
                        } ?>
                        <br />
                        <form action="test.php" method="post" enctype="multipart/form-data">
                            <table class="table table-borderless" style="border: 1px solid #dee2e6;">
                                <thead class="table-light border-bottom">
                                    <tr>
                                        <td class="p-3 fs-6" scope="col">Edit</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="p-3 fs-6">
                                            <input type='number' name='user_id' value="<?php echo $user_id; ?>" hidden>
                                            <p class="mb-1" style="font-size:14px;">First Name</p>
                                            <input type="text" name="first_name" class="popup" value="<?php echo $first_name; ?>">
                                            <p class="mb-1 mt-4" style="font-size:14px;">Last Name</p>
                                            <input type="text" name="last_name" class="popup" value="<?php echo $last_name; ?>">
                                            <p class="mb-1 mt-4" style="font-size:14px;">Email</p>
                                            <input type="email" name="email" class="popup" value="<?php echo $email; ?>" required>
                                            <p class="mb-1 mt-4" style="font-size:14px;">Phone number</p>
                                            <input type="text" name="phone_number" class="popup" value="<?php echo $phone_number; ?>" required>
                                            <p class="mb-1 mt-4" style="font-size:14px;">password</p>
                                            <input type="password" name="password" class="popup" value="<?php echo $password; ?>" required>
                                            <p class="mb-1 mt-4" style="font-size:14px;">Avatar</p>
                                            <img class="m-2" style="height:50px" src="../Assets/<?php echo $avatar; ?>">
                                            <input type="file" name="avatar" value="">
                                            <p class="mb-1 mt-4" style="font-size:14px;">Employee ID</p>
                                            <input type="text" name="employee_id" class="popup" value="<?php echo $employee_id; ?>">
                                            <p class="mb-1 mt-4" style="font-size:14px;">Department</p>
                                            <input type="text" name="department" class="popup" value="<?php echo $department; ?>">
                                            <p class="mb-1 mt-4" style="font-size:14px;">City</p>
                                            <!-- <select class="popup pt-0 pb-0" name="city_id" required>
                                                <option value="<?php echo $city_id; ?>" selected="" hidden><?php echo $city_name; ?></option>
                                                <?php
                                                $query = "SELECT * From city";
                                                $result = mysqli_query($connection, $query);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $city_id = $row['city_id'];
                                                    $name = $row['name'];
                                                    echo "<option value='$city_id'>$name</option>";
                                                }
                                                ?>
                                            </select> -->
                                            <p class="mb-1 mt-4" style="font-size:14px;">Country</p>
                                            <select class="popup pt-0 pb-0" name="country_id" required>
                                                <option value="<?php echo $country_id; ?>" selected="" hidden><?php echo $country_name; ?></option>
                                                <?php
                                                $query = "SELECT * From country";
                                                $result = mysqli_query($connection, $query);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $country_id = $row['country_id'];
                                                    $name = $row['name'];
                                                    echo "<option value='$country_id'>$name</option>";
                                                }
                                                ?>
                                            </select>
                                            <p class="mb-1 mt-4" style="font-size:14px;">Profile text</p>
                                            <textarea rows="5" name="profile_text" class="popup1"><?php echo $profile_text; ?></textarea>
                                            <p class="mb-1 mt-4" style="font-size:14px;">Status</p>
                                            <select class="popup pt-0 pb-0" name="status">
                                                <option value="<?php echo $status; ?>"><?php echo $status; ?></option>
                                                <?php
                                                if ($status == '1') {
                                                    echo "<option value='0'>0</option>";
                                                } else {
                                                    echo "<option value='1'>1</option>";
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="d-flex align-content-end justify-content-end">
                                <a class="col-example8 mt-4 mb-4 me-2" href="ruff.html" style="font-size:calc(13px + 0.1vw);">
                                    cancel
                                </a>
                                <button class="col-example mt-4 mb-4" name="edituser" type="submit" style="font-size:calc(13px + 0.1vw);">
                                    save
                                </button>
                            </div>
                        </form>
                    <?php } else { ?>

                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active1 gray ps-0 pe-5 fs-4" data-toggle="tab" href="#userc">User</a>
                            </li>
                        </ul>
                        <div class="d-flex justify-content-between mt-4 mb-4">
                            <form action="adminpanel.php?search" method="post">
                                <div style="border: 2px solid #dee2e6; border-radius:5px; height:100%;">
                                    <div class="input-group">
                                        <span class="input-group-text" style="background-color:transparent; border:none;">
                                            <img src="../Assets/search.png" height="15px">
                                        </span>
                                        <input type="text" name="search" placeholder="search" class="form-control" style="border:none;border-radius:5px;background-color:transparent;">
                                    </div>
                                </div>
                            </form>
                            <form action="adminpanel.php?add_user" method="post">
                                <button class="col-example1" name="add_user" type="submit" style="font-size:calc(12px + 0.15vw);padding-top: 7px;">
                                    <i class="fa fa-plus me-2"></i>
                                    Add
                                </button>
                            </form>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="userc">
                                <table class="table" style="border: 1px solid #dee2e6;">
                                    <thead class="table-light border-bottom">
                                        <tr>
                                            <td class="p-3 pe-0 fs-6" scope="col">First Name</td>
                                            <td class="p-3 pe-0 fs-6" scope="col">Last Name</td>
                                            <td class="p-3 pe-0 fs-6" scope="col">Email</td>
                                            <td class="p-3 pe-0 fs-6" scope="col">Employee id</td>
                                            <td class="p-3 pe-0 fs-6" scope="col">Department</td>
                                            <td class="p-3 pe-0 fs-6" scope="col">Status</td>
                                            <td class="p-3 pe-0 fs-6" scope="col">Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($_POST['search'])) {
                                            $search = $_POST['search'];
                                            $query = "SELECT * FROM `user` WHERE first_name LIKE '%$search%' or last_name LIKE '%$search%' or email LIKE '%$search%' or employee_id LIKE '%$search%' or department LIKE '%$search%'";
                                            $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $user_id = $row['user_id'];
                                                $first_name = $row['first_name'];
                                                $last_name = $row['last_name'];
                                                $email = $row['email'];
                                                $employee_id = $row['employee_id'];
                                                $department = $row['department'];
                                                $status = $row['status'];
                                                echo "<tr>";
                                                echo "<td class='p-3 pe-0' style='font-size:13px;'>$first_name</td>";
                                                echo "<td class='p-3 pe-0' style='font-size:13px;'>$last_name</td>";
                                                echo "<td class='p-3 pe-0' style='font-size:13px;'>$email</td>";
                                                echo "<td class='p-3 pe-0' style='font-size:13px;'>$employee_id</td>";
                                                echo "<td class='p-3 pe-0' style='font-size:13px;'>$department</td>";
                                                echo "<td class='p-3 pe-0' style='font-size:13px;color: #7ed470;'>";
                                                if ($status == 1) {
                                                    echo "Active";
                                                } else {
                                                    echo "Inactive";
                                                }
                                                echo "</td>";
                                                echo "<td class='p-3 pe-0 p-0' style='font-size:20px;'>";
                                                echo "<a href='adminpanel.php?edit=$user_id'><i class='fa fa-pencil-square-o pe-2' style='color: #f88634;' aria-hidden='true'></i></a>";
                                                echo "<a onClick=\"javascript:return confirm('Are you sure to delete?');\" href='test.php?delete=$user_id'><i class='fa fa-trash-o text-dark' aria-hidden='true'></i></a>";
                                                echo "</td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            $pagecount = 6;
                                            if (isset($_GET['page'])) {
                                                $page = $_GET['page'];
                                            } else
                                                $page = "";
                                            if ($page == "" || $page == 1)
                                                $postno = 0;
                                            else
                                                $postno = ($page * $pagecount) - $pagecount;
                                            $query = "SELECT * FROM user";
                                            $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
                                            $cnt = mysqli_num_rows($result);
                                            $cnt = ceil($cnt / $pagecount);
                                            $query = "SELECT * FROM user LIMIT $postno,$pagecount";
                                            $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $user_id = $row['user_id'];
                                                $first_name = $row['first_name'];
                                                $last_name = $row['last_name'];
                                                $email = $row['email'];
                                                $employee_id = $row['employee_id'];
                                                $department = $row['department'];
                                                $status = $row['status'];
                                                echo "<tr>";
                                                echo "<td class='p-3 pe-0' style='font-size:13px;'>$first_name</td>";
                                                echo "<td class='p-3 pe-0' style='font-size:13px;'>$last_name</td>";
                                                echo "<td class='p-3 pe-0' style='font-size:13px;'>$email</td>";
                                                echo "<td class='p-3 pe-0' style='font-size:13px;'>$employee_id</td>";
                                                echo "<td class='p-3 pe-0' style='font-size:13px;'>$department</td>";
                                                echo "<td class='p-3 pe-0' style='font-size:13px;color: #7ed470;'>";
                                                if ($status == 1) {
                                                    echo "Active";
                                                } else {
                                                    echo "Inactive";
                                                }
                                                echo "</td>";
                                                echo "<td class='p-3 pe-0 p-0' style='font-size:20px;'>";
                                                echo "<a href='adminpanel.php?edit=$user_id'><i class='fa fa-pencil-square-o pe-2' style='color: #f88634;' aria-hidden='true'></i></a>";
                                                echo "<a onClick=\"javascript:return confirm('Are you sure to delete?');\" href='test.php?delete=$user_id'><i class='fa fa-trash-o text-dark' aria-hidden='true'></i></a>";
                                                echo "</td>";
                                                echo "</tr>";
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <?php if (isset($_POST['search'])){} else{?>
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination pager justify-content-end">
                                        <li class="page-item">
                                            <a class="page-link" href="#" style="border-radius:5px; padding:10px; height:30px; width:30px; margin:4px;"><img src="../Assets/previous.png" alt=""></a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#" style="border-radius:5px; padding:10px; height:30px; width:30px; margin:4px;"><img src="../Assets/left.png" alt=""></a></li>
                                        <?php
                                        for ($i = 1; $i <= $cnt; $i++) {
                                            if ($i == $page)
                                                echo "<li class='page-item'><a class='page-link active text-center' href='adminpanel.php?page=$i' style='border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px;'><b>$i</b></a></li>";
                                            else
                                                echo "<li class='page-item'><a class='page-link text-center' href='adminpanel.php?page=$i' style='border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px; color:black;'>$i</a></li>";
                                        }?>
                                        <li class="page-item">
                                            <a class="page-link" href="#" style="border-radius:5px; padding:10px; height:30px; width:30px; margin:4px;"><img src="../Assets/arrow.png" alt=""></a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#" style="border-radius:5px; padding:10px; height:30px; width:30px; margin:4px;"><img src="../Assets/next.png" alt=""></a></li>
                                    </ul>
                                </nav>
                                <?php }?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <?php if (isset($_POST['add_cmspage'])) {
                    echo "<div class='tab-pane show active' id='page'>";
                } else {
                    echo "<div class='tab-pane' id='page'>";
                } ?>
                <?php if (isset($_POST['add_cmspage'])) { ?>
                    <br />
                    <table class="table table-borderless" style="border: 1px solid #dee2e6;">
                        <thead class="table-light border-bottom">
                            <tr>
                                <td class="p-3 fs-6" scope="col">Add</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="p-3 fs-6">
                                    <form>
                                        <p class="mb-1" style="font-size:14px;">Title</p>
                                        <input type="text" class="popup" name="">
                                        <p class="mb-1 mt-4" style="font-size:14px;">Description</p>
                                        <textarea rows="15" name="" class="popup1"></textarea>
                                        <p class="mb-1 mt-4" style="font-size:14px;">Slug</p>
                                        <input type="text" class="popup" name="">
                                        <p class="mb-1 mt-4" style="font-size:14px;">Status</p>
                                        <select class="popup pt-0 pb-0">
                                            <option value="none" selected="" disabled="" hidden=""></option>
                                            <option value="newsest">Active</option>
                                            <option value="oldest">Inactive</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="d-flex align-content-end justify-content-end">
                        <a class="col-example8 mt-4 mb-4 me-2" href="ruff.html" style="font-size:calc(13px + 0.1vw);">
                            cancel
                        </a>
                        <a class="col-example mt-4 mb-4" href="ruff.html" style="font-size:calc(13px + 0.1vw);">
                            save
                        </a>
                    </div>
                <?php } else { ?>
                    <form action="adminpanel.php?add_cmspage" method="post">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active1 gray ps-0 pe-5 fs-4" data-toggle="tab" href="#userc">CMS
                                    Pages</a>
                            </li>
                        </ul>
                        <div class="d-flex justify-content-between mt-4 mb-4">
                            <div style="border: 2px solid #dee2e6; border-radius:5px;">
                                <div class="input-group">
                                    <span class="input-group-text" style="background-color:transparent; border:none;">
                                        <img src="../Assets/search.png" height="15px">
                                    </span>
                                    <input type="text" placeholder="search" class="form-control" style="border:none;border-radius:5px;background-color:transparent;">
                                </div>
                            </div>
                            <button class="col-example1" name="add_cmspage" type="submit" style="font-size:calc(12px + 0.15vw);background-color: white; padding-top: 7px;">
                                <i class="fa fa-plus me-2" aria-hidden="true"></i>
                                Add
                            </button>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="userc">
                                <table class="table" style="border: 1px solid #dee2e6;">
                                    <thead class="table-light border-bottom">
                                        <tr>
                                            <td class="p-3 pe-0 fs-6" scope="col">Title</td>
                                            <td class="p-3 pe-0 fs-6" scope="col">Status</td>
                                            <td class="p-3 pe-0 fs-6" scope="col">Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = "SELECT * FROM cms_page";
                                        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $title = $row['title'];
                                            $status = $row['status'];
                                            echo "<tr>";
                                            echo "<td class='p-3 pe-0' style='font-size:13px;'>$title</td>";
                                            echo "<td class='p-3 pe-0' style='font-size:13px;color: #7ed470;'>";
                                            if ($status == 1) {
                                                echo "Active";
                                            } else {
                                                echo "Inactive";
                                            }
                                            echo "</td>";
                                            echo "<td class='p-3 pe-0 p-0' style='font-size:20px;'>";
                                            echo "<i class='fa fa-pencil-square-o pe-2' style='color: #f88634;' aria-hidden='true'></i>";
                                            echo "<a href='#' data-bs-toggle='modal' data-bs-target='#popup1'><i class='fa fa-trash-o text-dark' aria-hidden='true'></i></a>";
                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination pager justify-content-end">
                                        <li class="page-item">
                                            <a class="page-link" href="#" style="border-radius:5px; padding:10px; height:30px; width:30px; margin:4px;"><img src="../Assets/previous.png" alt=""></a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#" style="border-radius:5px; padding:10px; height:30px; width:30px; margin:4px;"><img src="../Assets/left.png" alt=""></a></li>
                                        <li class="page-item"><a class="page-link active text-center" href="#" style="border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px;">1</a>
                                        </li>
                                        <li class="page-item"><a class="page-link text-center" href="#" style="border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px; color:black;">2</a>
                                        </li>
                                        <li class="page-item"><a class="page-link text-center" href="#" style="border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px; color:black;">3</a>
                                        </li>
                                        <li class="page-item"><a class="page-link text-center" href="#" style="border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px; color:black;">4</a>
                                        </li>
                                        <li class="page-item"><a class="page-link text-center" href="#" style="border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px; color:black;">5</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#" style="border-radius:5px; padding:10px; height:30px; width:30px; margin:4px;"><img src="../Assets/arrow.png" alt=""></a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#" style="border-radius:5px; padding:10px; height:30px; width:30px; margin:4px;"><img src="../Assets/next.png" alt=""></a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </form>
                <?php } ?>
            </div>
            <?php if (isset($_POST['add_mission'])) {
                echo "<div class='tab-pane show active' id='mission'>";
            } else {
                echo "<div class='tab-pane' id='mission'>";
            } ?>
            <?php if (isset($_POST['add_mission'])) { ?>
                <br />
                <table class="table table-borderless" style="border: 1px solid #dee2e6;">
                    <thead class="table-light border-bottom">
                        <tr>
                            <td class="p-3 fs-6" scope="col">Add</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="p-3 fs-6">
                                <form>
                                    <p class="mb-1" style="font-size:14px;">Title</p>
                                    <input type="text" class="popup" name="">
                                    <p class="mb-1 mt-4" style="font-size:14px;">Short Description</p>
                                    <input type="text" class="popup" name="">
                                    <p class="mb-1 mt-4" style="font-size:14px;">Description</p>
                                    <textarea rows="5" name="" class="popup1"></textarea>
                                    <p class="mb-1 mt-4" style="font-size:14px;">City</p>
                                    <select class="popup pt-0 pb-0">
                                        <option value="none" selected="" disabled="" hidden=""></option>
                                        <option value="newsest">1</option>
                                        <option value="oldest">2</option>
                                    </select>
                                    <p class="mb-1 mt-4" style="font-size:14px;">Country</p>
                                    <select class="popup pt-0 pb-0">
                                        <option value="none" selected="" disabled="" hidden=""></option>
                                        <option value="newsest">3</option>
                                        <option value="oldest">4</option>
                                    </select>
                                    <p class="mb-1 mt-4" style="font-size:14px;">Organisation Name</p>
                                    <input type="text" class="popup" name="">
                                    <p class="mb-1 mt-4" style="font-size:14px;">Organisation Detail</p>
                                    <input type="text" class="popup" name="">
                                    <p class="mb-1 mt-4" style="font-size:14px;">Start Date</p>
                                    <input type="date" class="popup" name="">
                                    <p class="mb-1 mt-4" style="font-size:14px;">End Date</p>
                                    <input type="date" class="popup" name="">
                                    <p class="mb-1 mt-4" style="font-size:14px;">type</p>
                                    <select class="popup pt-0 pb-0">
                                        <option value="none" selected="" disabled="" hidden=""></option>
                                        <option value="newsest">Time</option>
                                        <option value="oldest">Goal</option>
                                    </select>
                                    <p class="mb-1 mt-4" style="font-size:14px;">Total Seats</p>
                                    <input type="number" class="popup" name="">
                                    <p class="mb-1 mt-4" style="font-size:14px;">Registration Deadline</p>
                                    <input type="date" class="popup" name="">
                                    <p class="mb-1 mt-4" style="font-size:14px;">theme</p>
                                    <select class="popup pt-0 pb-0">
                                        <option value="none" selected="" disabled="" hidden=""></option>
                                        <option value="newsest">environment</option>
                                        <option value="oldest">animal</option>
                                    </select>
                                    <p class="mb-1 mt-4" style="font-size:14px;">skill</p>
                                    <select class="popup pt-0 pb-0">
                                        <option value="none" selected="" disabled="" hidden=""></option>
                                        <option value="newsest">english</option>
                                        <option value="oldest">learn</option>
                                    </select>
                                    <p class="mb-1 mt-4" style="font-size:14px;">Image</p>
                                    <input type="file" name="">
                                    <p class="mb-1 mt-4" style="font-size:14px;">Document</p>
                                    <input type="file" name="">
                                    <p class="mb-1 mt-4" style="font-size:14px;">Availability</p>
                                    <select class="popup pt-0 pb-0">
                                        <option value="none" selected="" disabled="" hidden=""></option>
                                        <option value="newsest">weekly</option>
                                        <option value="oldest">monthly</option>
                                        <option value="oldest">daily</option>
                                    </select>
                                    <p class="mb-1 mt-4" style="font-size:14px;">Video URL</p>
                                    <input type="url" class="popup" name="">
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="d-flex align-content-end justify-content-end">
                    <a class="col-example8 mt-4 mb-4 me-2" href="ruff.html" style="font-size:calc(13px + 0.1vw);">
                        cancel
                    </a>
                    <a class="col-example mt-4 mb-4" href="ruff.html" style="font-size:calc(13px + 0.1vw);">
                        save
                    </a>
                </div>
            <?php } else { ?>
                <form action="adminpanel.php?add_mission" method="post">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active1 gray ps-0 pe-5 fs-4" data-toggle="tab" href="#userc">Mission</a>
                        </li>
                    </ul>
                    <div class="d-flex justify-content-between mt-4 mb-4">
                        <div style="border: 2px solid #dee2e6; border-radius:5px;">
                            <div class="input-group">
                                <span class="input-group-text" style="background-color:transparent; border:none;">
                                    <img src="../Assets/search.png" height="15px">
                                </span>
                                <input type="text" placeholder="search" class="form-control" style="border:none;border-radius:5px;background-color:transparent;">
                            </div>
                        </div>
                        <button class="col-example1" type="submit" name="add_mission" style="font-size:calc(12px + 0.15vw);background-color: white; padding-top: 7px;">
                            <i class="fa fa-plus me-2" aria-hidden="true"></i>
                            Add
                        </button>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="userc">
                            <table class="table" style="border: 1px solid #dee2e6;">
                                <thead class="table-light border-bottom">
                                    <tr>
                                        <td class="p-3 pe-0 fs-6" scope="col">Mission Title</td>
                                        <td class="p-3 pe-0 fs-6" scope="col">Mission type</td>
                                        <td class="p-3 pe-0 fs-6" scope="col">Start Date</td>
                                        <td class="p-3 pe-0 fs-6" scope="col">End Date</td>
                                        <td class="p-3 pe-0 fs-6" scope="col">Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * FROM mission";
                                    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $title = $row['title'];
                                        $mission_type = $row['mission_type'];
                                        $start_date = $row['start_date'];
                                        $end_date = $row['end_date'];
                                        if ($start_date != null && $end_date != null) {
                                            $start_date = date("d/m/Y", strtotime($start_date));
                                            $end_date = date("d/m/Y", strtotime($end_date));
                                        }
                                        echo "<tr>";
                                        echo "<td class='p-3 pe-0' style='font-size:13px;'>$title</td>";
                                        echo "<td class='p-3 pe-0' style='font-size:13px;'>$mission_type</td>";
                                        echo "<td class='p-3 pe-0' style='font-size:13px;'>$start_date</td>";
                                        echo "<td class='p-3 pe-0' style='font-size:13px;'>$end_date</td>";
                                        echo "<td class='p-3 pe-0 p-0' style='font-size:20px;'>";
                                        echo "<i class='fa fa-pencil-square-o pe-2' style='color: #f88634;' aria-hidden='true'></i>";
                                        echo "<a href='#' data-bs-toggle='modal' data-bs-target='#popup1'><i class='fa fa-trash-o text-dark' aria-hidden='true'></i></a>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination pager justify-content-end">
                                    <li class="page-item">
                                        <a class="page-link" href="#" style="border-radius:5px; padding:10px; height:30px; width:30px; margin:4px;"><img src="../Assets/previous.png" alt=""></a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#" style="border-radius:5px; padding:10px; height:30px; width:30px; margin:4px;"><img src="../Assets/left.png" alt=""></a></li>
                                    <li class="page-item"><a class="page-link active text-center" href="#" style="border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px;">1</a>
                                    </li>
                                    <li class="page-item"><a class="page-link text-center" href="#" style="border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px; color:black;">2</a>
                                    </li>
                                    <li class="page-item"><a class="page-link text-center" href="#" style="border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px; color:black;">3</a>
                                    </li>
                                    <li class="page-item"><a class="page-link text-center" href="#" style="border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px; color:black;">4</a>
                                    </li>
                                    <li class="page-item"><a class="page-link text-center" href="#" style="border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px; color:black;">5</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#" style="border-radius:5px; padding:10px; height:30px; width:30px; margin:4px;"><img src="../Assets/arrow.png" alt=""></a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#" style="border-radius:5px; padding:10px; height:30px; width:30px; margin:4px;"><img src="../Assets/next.png" alt=""></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </form>
            <?php } ?>
        </div>
        <?php if (isset($_POST['add_theme'])) {
            echo "<div class='tab-pane show active' id='theme'>";
        } else {
            echo "<div class='tab-pane' id='theme'>";
        } ?>
        <?php if (isset($_POST['add_theme'])) { ?>
            <br />
            <table class="table table-borderless" style="border: 1px solid #dee2e6;">
                <thead class="table-light border-bottom">
                    <tr>
                        <td class="p-3 fs-6" scope="col">Add</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="p-3 fs-6">
                            <form>
                                <p class="mb-1" style="font-size:14px;">Theme Name</p>
                                <input type="text" class="popup" name="">
                                <p class="mb-1 mt-4" style="font-size:14px;">Status</p>
                                <select class="popup pt-0 pb-0">
                                    <option value="none" selected="" disabled="" hidden=""></option>
                                    <option value="newsest">Active</option>
                                    <option value="oldest">Inactive</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="d-flex align-content-end justify-content-end">
                <a class="col-example8 mt-4 mb-4 me-2" href="ruff.html" style="font-size:calc(13px + 0.1vw);">
                    cancel
                </a>
                <a class="col-example mt-4 mb-4" href="ruff.html" style="font-size:calc(13px + 0.1vw);">
                    save
                </a>
            </div>
        <?php } else { ?>
            <form action="adminpanel.php?add_theme" method="post">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active1 gray ps-0 pe-5 fs-4" data-toggle="tab" href="#userc">Mission
                            Theme</a>
                    </li>
                </ul>
                <div class="d-flex justify-content-between mt-4 mb-4">
                    <div style="border: 2px solid #dee2e6; border-radius:5px;">
                        <div class="input-group">
                            <span class="input-group-text" style="background-color:transparent; border:none;">
                                <img src="../Assets/search.png" height="15px">
                            </span>
                            <input type="text" placeholder="search" class="form-control" style="border:none;border-radius:5px;background-color:transparent;">
                        </div>
                    </div>
                    <button class="col-example1" name="add_theme" type="submit" style="font-size:calc(12px + 0.15vw);background-color: white; padding-top: 7px;">
                        <i class="fa fa-plus me-2" aria-hidden="true"></i>
                        Add
                    </button>
                </div>
                <div class="tab-content">
                    <div class="tab-pane show active" id="userc">
                        <table class="table" style="border: 1px solid #dee2e6;">
                            <thead class="table-light border-bottom">
                                <tr>
                                    <td class="p-3 pe-0 fs-6" scope="col">Name</td>
                                    <td class="p-3 pe-0 fs-6" scope="col">Status</td>
                                    <td class="p-3 pe-0 fs-6" scope="col">Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM mission_theme";
                                $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $title = $row['title'];
                                    $status = $row['status'];
                                    echo "<tr>";
                                    echo "<td class='p-3 pe-0' style='font-size:13px;'>$title</td>";
                                    echo "<td class='p-3 pe-0' style='font-size:13px;color: #7ed470;'>";
                                    if ($status == 1) {
                                        echo "Active";
                                    } else {
                                        echo "Inactive";
                                    }
                                    echo "</td>";
                                    echo "<td class='p-3 pe-0 p-0' style='font-size:20px;'>";
                                    echo "<i class='fa fa-pencil-square-o pe-2' style='color: #f88634;' aria-hidden='true'></i>";
                                    echo "<a href='#' data-bs-toggle='modal' data-bs-target='#popup1'><i class='fa fa-trash-o text-dark' aria-hidden='true'></i></a>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pager justify-content-end">
                                <li class="page-item">
                                    <a class="page-link" href="#" style="border-radius:5px; padding:10px; height:30px; width:30px; margin:4px;"><img src="../Assets/previous.png" alt=""></a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#" style="border-radius:5px; padding:10px; height:30px; width:30px; margin:4px;"><img src="../Assets/left.png" alt=""></a></li>
                                <li class="page-item"><a class="page-link active text-center" href="#" style="border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px;">1</a>
                                </li>
                                <li class="page-item"><a class="page-link text-center" href="#" style="border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px; color:black;">2</a>
                                </li>
                                <li class="page-item"><a class="page-link text-center" href="#" style="border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px; color:black;">3</a>
                                </li>
                                <li class="page-item"><a class="page-link text-center" href="#" style="border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px; color:black;">4</a>
                                </li>
                                <li class="page-item"><a class="page-link text-center" href="#" style="border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px; color:black;">5</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#" style="border-radius:5px; padding:10px; height:30px; width:30px; margin:4px;"><img src="../Assets/arrow.png" alt=""></a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#" style="border-radius:5px; padding:10px; height:30px; width:30px; margin:4px;"><img src="../Assets/next.png" alt=""></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </form>
        <?php } ?>
        </div>
        <?php if (isset($_POST['add_skill'])) {
            echo "<div class='tab-pane show active' id='skill'>";
        } else {
            echo "<div class='tab-pane' id='skill'>";
        } ?>
        <?php if (isset($_POST['add_skill'])) { ?>
            <br />
            <table class="table table-borderless" style="border: 1px solid #dee2e6;">
                <thead class="table-light border-bottom">
                    <tr>
                        <td class="p-3 fs-6" scope="col">Add</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="p-3 fs-6">
                            <form>
                                <p class="mb-1" style="font-size:14px;">Skill Name</p>
                                <input type="text" class="popup" name="">
                                <p class="mb-1 mt-4" style="font-size:14px;">Status</p>
                                <select class="popup pt-0 pb-0">
                                    <option value="none" selected="" disabled="" hidden=""></option>
                                    <option value="newsest">Active</option>
                                    <option value="oldest">Inactive</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="d-flex align-content-end justify-content-end">
                <a class="col-example8 mt-4 mb-4 me-2" href="ruff.html" style="font-size:calc(13px + 0.1vw);">
                    cancel
                </a>
                <a class="col-example mt-4 mb-4" href="ruff.html" style="font-size:calc(13px + 0.1vw);">
                    save
                </a>
            </div>
        <?php } else { ?>
            <form action="adminpanel.php?add_skill" method="post">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active1 gray ps-0 pe-5 fs-4" data-toggle="tab" href="#userc">Mission
                            Skill</a>
                    </li>
                </ul>
                <div class="d-flex justify-content-between mt-4 mb-4">
                    <div style="border: 2px solid #dee2e6; border-radius:5px;">
                        <div class="input-group">
                            <span class="input-group-text" style="background-color:transparent; border:none;">
                                <img src="../Assets/search.png" height="15px">
                            </span>
                            <input type="text" placeholder="search" class="form-control" style="border:none;border-radius:5px;background-color:transparent;">
                        </div>
                    </div>
                    <button class="col-example1" type="submit" name="add_skill" style="font-size:calc(12px + 0.15vw);background-color: white; padding-top: 7px;">
                        <i class="fa fa-plus me-2" aria-hidden="true"></i>
                        Add
                    </button>
                </div>
                <div class="tab-content">
                    <div class="tab-pane show active" id="userc">
                        <table class="table" style="border: 1px solid #dee2e6;">
                            <thead class="table-light border-bottom">
                                <tr>
                                    <td class="p-3 pe-0 fs-6" scope="col">Name</td>
                                    <td class="p-3 pe-0 fs-6" scope="col">Status</td>
                                    <td class="p-3 pe-0 fs-6" scope="col">Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM skill";
                                $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $title = $row['skill_name'];
                                    $status = $row['status'];
                                    echo "<tr>";
                                    echo "<td class='p-3 pe-0' style='font-size:13px;'>$title</td>";
                                    echo "<td class='p-3 pe-0' style='font-size:13px;color: #7ed470;'>";
                                    if ($status == 1) {
                                        echo "Active";
                                    } else {
                                        echo "Inactive";
                                    }
                                    echo "</td>";
                                    echo "<td class='p-3 pe-0 p-0' style='font-size:20px;'>";
                                    echo "<i class='fa fa-pencil-square-o pe-2' style='color: #f88634;' aria-hidden='true'></i>";
                                    echo "<a href='#' data-bs-toggle='modal' data-bs-target='#popup1'><i class='fa fa-trash-o text-dark' aria-hidden='true'></i></a>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pager justify-content-end">
                                <li class="page-item">
                                    <a class="page-link" href="#" style="border-radius:5px; padding:10px; height:30px; width:30px; margin:4px;"><img src="../Assets/previous.png" alt=""></a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#" style="border-radius:5px; padding:10px; height:30px; width:30px; margin:4px;"><img src="../Assets/left.png" alt=""></a></li>
                                <li class="page-item"><a class="page-link active text-center" href="#" style="border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px;">1</a>
                                </li>
                                <li class="page-item"><a class="page-link text-center" href="#" style="border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px; color:black;">2</a>
                                </li>
                                <li class="page-item"><a class="page-link text-center" href="#" style="border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px; color:black;">3</a>
                                </li>
                                <li class="page-item"><a class="page-link text-center" href="#" style="border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px; color:black;">4</a>
                                </li>
                                <li class="page-item"><a class="page-link text-center" href="#" style="border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px; color:black;">5</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#" style="border-radius:5px; padding:10px; height:30px; width:30px; margin:4px;"><img src="../Assets/arrow.png" alt=""></a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#" style="border-radius:5px; padding:10px; height:30px; width:30px; margin:4px;"><img src="../Assets/next.png" alt=""></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </form>
        <?php } ?>
        </div>
        <div class="tab-pane" id="app">
            <form action="adminpanel.php" method="post">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active1 gray ps-0 pe-5 fs-4" data-toggle="tab" href="#userc">Mission
                            Application</a>
                    </li>
                </ul>
                <div class="d-flex justify-content-between mt-4 mb-4">
                    <div style="border: 2px solid #dee2e6; border-radius:5px;">
                        <div class="input-group">
                            <span class="input-group-text" style="background-color:transparent; border:none;">
                                <img src="../Assets/search.png" height="15px">
                            </span>
                            <input type="text" placeholder="search" class="form-control" style="border:none;border-radius:5px;background-color:transparent;">
                        </div>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane show active" id="userc">
                        <table class="table" style="border: 1px solid #dee2e6;">
                            <thead class="table-light border-bottom">
                                <tr>
                                    <td class="p-3 pe-0 fs-6" scope="col">Mission Title</td>
                                    <td class="p-3 pe-0 fs-6" scope="col">Mission ID</td>
                                    <td class="p-3 pe-0 fs-6" scope="col">User ID</td>
                                    <td class="p-3 pe-0 fs-6" scope="col">User Name</td>
                                    <td class="p-3 pe-0 fs-6" scope="col">Applied Date</td>
                                    <td class="p-3 pe-0 fs-6" scope="col">Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT *,mission.title as mission_title FROM mission_application
                                        INNER JOIN mission ON mission_application.mission_id=mission.mission_id
                                        INNER JOIN user On mission_application.user_id=user.user_id";
                                $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $mission_id = $row['mission_id'];
                                    $title = $row['mission_title'];
                                    $user_id = $row['user_id'];
                                    $first_name = $row['first_name'];
                                    $last_name = $row['last_name'];
                                    $applied_at = $row['applied_at'];
                                    $applied_at = date("d/m/Y", strtotime($applied_at));
                                    $approval_status = $row['approval_status'];
                                    echo "<tr>";
                                    echo "<td class='p-3 pe-0' style='font-size:13px;'>$title</td>";
                                    echo "<td class='p-3 pe-0' style='font-size:13px;'>$mission_id</td>";
                                    echo "<td class='p-3 pe-0' style='font-size:13px;'>$user_id</td>";
                                    echo "<td class='p-3 pe-0' style='font-size:13px;'>$first_name $last_name</td>";
                                    echo "<td class='p-3 pe-0' style='font-size:13px;'>$applied_at</td>";
                                    echo "<td class='p-3 pe-0 p-0' style='font-size:20px;'>";
                                    echo "<i class='fa fa-check-circle-o pe-2' style='color: #14c506;' aria-hidden='true'></i>";
                                    echo "<a href='#' data-bs-toggle='modal' data-bs-target='#popup1'><i class='fa fa-times-circle-o text-danger' aria-hidden='true'></i></a>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pager justify-content-end">
                                <li class="page-item">
                                    <a class="page-link" href="#" style="border-radius:5px; padding:10px; height:30px; width:30px; margin:4px;"><img src="../Assets/previous.png" alt=""></a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#" style="border-radius:5px; padding:10px; height:30px; width:30px; margin:4px;"><img src="../Assets/left.png" alt=""></a></li>
                                <li class="page-item"><a class="page-link active text-center" href="#" style="border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px;">1</a>
                                </li>
                                <li class="page-item"><a class="page-link text-center" href="#" style="border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px; color:black;">2</a>
                                </li>
                                <li class="page-item"><a class="page-link text-center" href="#" style="border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px; color:black;">3</a>
                                </li>
                                <li class="page-item"><a class="page-link text-center" href="#" style="border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px; color:black;">4</a>
                                </li>
                                <li class="page-item"><a class="page-link text-center" href="#" style="border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px; color:black;">5</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#" style="border-radius:5px; padding:10px; height:30px; width:30px; margin:4px;"><img src="../Assets/arrow.png" alt=""></a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#" style="border-radius:5px; padding:10px; height:30px; width:30px; margin:4px;"><img src="../Assets/next.png" alt=""></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </form>
        </div>
        <div class="tab-pane" id="story">
            <form action="adminpanel.php" method="post">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active1 gray ps-0 pe-5 fs-4" data-toggle="tab" href="#userc">Story</a>
                    </li>
                </ul>
                <div class="d-flex justify-content-between mt-4 mb-4">
                    <div style="border: 2px solid #dee2e6; border-radius:5px;">
                        <div class="input-group">
                            <span class="input-group-text" style="background-color:transparent; border:none;">
                                <img src="../Assets/search.png" height="15px">
                            </span>
                            <input type="text" placeholder="search" class="form-control" style="border:none;border-radius:5px;background-color:transparent;">
                        </div>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane show active" id="userc">
                        <table class="table" style="border: 1px solid #dee2e6;">
                            <thead class="table-light border-bottom">
                                <tr>
                                    <td class="p-3 pe-0 fs-6" scope="col">Story Title</td>
                                    <td class="p-3 pe-0 fs-6" scope="col">Full Name</td>
                                    <td class="p-3 pe-0 fs-6" scope="col">Mission title</td>
                                    <td class="p-3 pe-0 fs-6" scope="col">Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT *,mission.title as mission_title,story.title as story_title FROM story
                                        INNER JOIN mission ON story.mission_id=mission.mission_id
                                        INNER JOIN user ON story.user_id=user.user_id";
                                $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $story_title = $row['story_title'];
                                    $mission_title = $row['mission_title'];
                                    $first_name = $row['first_name'];
                                    $last_name = $row['last_name'];
                                    echo "<tr>";
                                    echo "<td class='p-3 pe-0' style='font-size:13px;'>$story_title</td>";
                                    echo "<td class='p-3 pe-0' style='font-size:13px;'>$first_name $last_name</td>";
                                    echo "<td class='p-3 pe-0' style='font-size:13px;'>$mission_title</td>";
                                    echo "<td class='p-3 pe-0 p-0' style='font-size:20px;'>";
                                    echo "<button class='col-example13' href='#' style='background-color: white;'>View</button>";
                                    echo "<i class='fa fa-check-circle-o pe-2 ps-2' style='color: #14c506;' aria-hidden='true'></i>";
                                    echo "<i class='fa fa-times-circle-o text-danger pe-2' aria-hidden='true'></i>";
                                    echo "<a href='#' data-bs-toggle='modal' data-bs-target='#popup1'><i class='fa fa-trash-o text-dark' aria-hidden='true'></i></a>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pager justify-content-end">
                                <li class="page-item">
                                    <a class="page-link" href="#" style="border-radius:5px; padding:10px; height:30px; width:30px; margin:4px;"><img src="../Assets/previous.png" alt=""></a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#" style="border-radius:5px; padding:10px; height:30px; width:30px; margin:4px;"><img src="../Assets/left.png" alt=""></a></li>
                                <li class="page-item"><a class="page-link active text-center" href="#" style="border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px;">1</a>
                                </li>
                                <li class="page-item"><a class="page-link text-center" href="#" style="border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px; color:black;">2</a>
                                </li>
                                <li class="page-item"><a class="page-link text-center" href="#" style="border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px; color:black;">3</a>
                                </li>
                                <li class="page-item"><a class="page-link text-center" href="#" style="border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px; color:black;">4</a>
                                </li>
                                <li class="page-item"><a class="page-link text-center" href="#" style="border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px; color:black;">5</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#" style="border-radius:5px; padding:10px; height:30px; width:30px; margin:4px;"><img src="../Assets/arrow.png" alt=""></a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#" style="border-radius:5px; padding:10px; height:30px; width:30px; margin:4px;"><img src="../Assets/next.png" alt=""></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </form>
        </div>
        <div class="tab-pane" id="banner">
            <form action="adminpanel.php?add_user" method="post">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active1 gray ps-0 pe-5 fs-4" data-toggle="tab" href="#userc">Banner
                            Management</a>
                    </li>
                </ul>
                <div class="d-flex justify-content-between mt-4 mb-4">
                    <div style="border: 2px solid #dee2e6; border-radius:5px;">
                        <div class="input-group">
                            <span class="input-group-text" style="background-color:transparent; border:none;">
                                <img src="../Assets/search.png" height="15px">
                            </span>
                            <input type="text" placeholder="search" class="form-control" style="border:none;border-radius:5px;background-color:transparent;">
                        </div>
                    </div>
                    <a class="col-example1" href="#" style="font-size:calc(12px + 0.15vw);background-color: white; padding-top: 7px;">
                        <i class="fa fa-plus me-2" aria-hidden="true"></i>
                        Add
                    </a>
                </div>
                <div class="tab-content">
                    <div class="tab-pane show active" id="userc">
                        <table class="table" style="border: 1px solid #dee2e6;">
                            <thead class="table-light border-bottom">
                                <tr>
                                    <td class="p-3 pe-0 fs-6" scope="col">First Name</td>
                                    <td class="p-3 pe-0 fs-6" scope="col">Last Name</td>
                                    <td class="p-3 pe-0 fs-6" scope="col">Email</td>
                                    <td class="p-3 pe-0 fs-6" scope="col">Employee id</td>
                                    <td class="p-3 pe-0 fs-6" scope="col">Department</td>
                                    <td class="p-3 pe-0 fs-6" scope="col">Status</td>
                                    <td class="p-3 pe-0 fs-6" scope="col">Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="p-3 pe-0" style="font-size:13px;">Adam</td>
                                    <td class="p-3 pe-0" style="font-size:13px;">Baldwin</td>
                                    <td class="p-3 pe-0" style="font-size:13px;">Adam12546@yahs.com</td>
                                    <td class="p-3 pe-0" style="font-size:13px;">1365465645</td>
                                    <td class="p-3 pe-0" style="font-size:13px;">HR</td>
                                    <td class="p-3 pe-0" style="font-size:13px;color: #7ed470;">Active</td>
                                    <td class="p-3 pe-0 p-0" style="font-size:13px;">
                                        <i class="fa fa-pencil-square-o" style="color: #f88634;" aria-hidden="true"></i>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#popup1"><i class="fa fa-trash-o text-dark" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pager justify-content-end">
                                <li class="page-item">
                                    <a class="page-link" href="#" style="border-radius:5px; padding:10px; height:30px; width:30px; margin:4px;"><img src="../Assets/previous.png" alt=""></a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#" style="border-radius:5px; padding:10px; height:30px; width:30px; margin:4px;"><img src="../Assets/left.png" alt=""></a></li>
                                <li class="page-item"><a class="page-link active text-center" href="#" style="border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px;">1</a>
                                </li>
                                <li class="page-item"><a class="page-link text-center" href="#" style="border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px; color:black;">2</a>
                                </li>
                                <li class="page-item"><a class="page-link text-center" href="#" style="border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px; color:black;">3</a>
                                </li>
                                <li class="page-item"><a class="page-link text-center" href="#" style="border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px; color:black;">4</a>
                                </li>
                                <li class="page-item"><a class="page-link text-center" href="#" style="border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px; color:black;">5</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#" style="border-radius:5px; padding:10px; height:30px; width:30px; margin:4px;"><img src="../Assets/arrow.png" alt=""></a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#" style="border-radius:5px; padding:10px; height:30px; width:30px; margin:4px;"><img src="../Assets/next.png" alt=""></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </form>
        </div>
        </div>
        </div>
        </div><?php
            }
        } else {
            header('Location:../design/login.php');
        }
                ?>
</body>

</html>