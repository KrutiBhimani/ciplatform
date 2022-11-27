<div class="tab-content p-3" style="z-index: 1">
    <?php if ($pagei == 1 || $missioni == 1) { ?>
        <div class="tab-pane" id="user">
        <?php } else { ?>
            <div class="tab-pane show active" id="user">
            <?php } ?>
            <?php if ($useri == 0) { ?>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active1 gray ps-0 pe-5 fs-4" data-toggle="tab" href="#userc">User</a>
                    </li>
                </ul>
                <div class="d-flex justify-content-between mt-4 mb-4">
                    <form class='m-0' method="post" enctype="multipart/form-data">
                        <div style="border: 2px solid #dee2e6; border-radius:5px;">
                            <div class="input-group">
                                <span class="input-group-text" style="background-color:transparent; border:none;">
                                    <img src="../Assets/search.png" height="15px">
                                </span>
                                <input type="text" name='searchuser' placeholder="search" class="form-control" style="border:none;border-radius:5px;background-color:transparent;">
                            </div>
                        </div>
                    </form>
                    <a class="col-example1" href='adduser' style="font-size:calc(12px + 0.15vw); padding-top: 7px;">
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
                                <?php
                                foreach ($users as $user) {
                                ?>
                                    <tr>
                                        <td class="p-3 pe-0" style="font-size:13px;"><?php echo $user->first_name; ?></td>
                                        <td class="p-3 pe-0" style="font-size:13px;"><?php echo $user->last_name; ?></td>
                                        <td class="p-3 pe-0" style="font-size:13px;"><?php echo $user->email; ?></td>
                                        <td class="p-3 pe-0" style="font-size:13px;"><?php echo $user->employee_id; ?></td>
                                        <td class="p-3 pe-0" style="font-size:13px;"><?php echo $user->department; ?></td>
                                        <td class="p-3 pe-0" style="font-size:13px;color: #7ed470;"><?php if ($user->status == 1) echo 'Active';
                                                                                                    else echo 'Inactive'; ?></td>
                                        <td class="p-3 pe-0 p-0" style="font-size:20px;">
                                            <a href="edituser?edit=<?php
                                                                    $id = $user->user_id;
                                                                    $salt = "SECRET_STUFF";
                                                                    $encrypted_id = base64_encode($id . $salt);
                                                                    echo $encrypted_id; ?>"><i class="fa fa-pencil-square-o" style="color: #f88634;" aria-hidden="true"></i>
                                                <a onClick="javascript:return confirm('Are you sure to delete?');" href='deleteuser?delete=<?php echo $user->user_id; ?>'><i class="fa fa-trash-o text-dark" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <?php if (!isset($_POST['searchuser'])) { ?>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination pager justify-content-end">
                                    <li class="page-item">
                                        <a class="page-link" href="#" style="border-radius:5px; padding:10px; height:30px; width:30px; margin:4px;"><img src="../Assets/previous.png" alt=""></a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#" style="border-radius:5px; padding:10px; height:30px; width:30px; margin:4px;"><img src="../Assets/left.png" alt=""></a></li>
                                    <?php
                                    for ($i = 1; $i <= $cnt; $i++) {
                                        if ($i == $page)
                                            echo "<li class='page-item'><a class='page-link active text-center' href='admin?page=$i' style='border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px;'><b>$i</b></a></li>";
                                        else
                                            echo "<li class='page-item'><a class='page-link text-center' href='admin?page=$i' style='border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px; color:black;'>$i</a></li>";
                                    } ?>
                                    <li class="page-item">
                                        <a class="page-link" href="#" style="border-radius:5px; padding:10px; height:30px; width:30px; margin:4px;"><img src="../Assets/arrow.png" alt=""></a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#" style="border-radius:5px; padding:10px; height:30px; width:30px; margin:4px;"><img src="../Assets/next.png" alt=""></a></li>
                                </ul>
                            </nav><?php } ?>
                    </div>
                </div>
            <?php } else if ($useri == 1) { ?>
                <br />
                <form method="post" enctype="multipart/form-data">
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
                                        <?php foreach ($cities as $city) { ?>
                                            <option value='<?php echo $city->city_id; ?>'><?php echo $city->name; ?></option>
                                        <?php } ?>
                                    </select>
                                    <p class="mb-1 mt-4" style="font-size:14px;">Country</p>
                                    <select class="popup pt-0 pb-0" name="country_id" required>
                                        <option value="none" selected="" disabled="" hidden=""></option>
                                        <?php foreach ($countries as $country) { ?>
                                            <option value='<?php echo $city->country_id; ?>'><?php echo $country->name; ?></option>
                                        <?php } ?>
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
                        <a class="col-example8 mt-4 mb-4 me-2" href="#" style="font-size:calc(13px + 0.1vw);">
                            cancel
                        </a>
                        <button class="col-example mt-4 mb-4" name="add_user" type="submit" style="font-size:calc(13px + 0.1vw);">
                            save
                        </button>
                    </div>
                </form>
            <?php } else if ($useri == 2) { ?>
                <br />
                <form method="post" enctype="multipart/form-data">
                    <table class="table table-borderless" style="border: 1px solid #dee2e6;">
                        <thead class="table-light border-bottom">
                            <tr>
                                <td class="p-3 fs-6" scope="col">Edit</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="p-3 fs-6">
                                    <input type='number' name='user_id' value="<?php echo $user->user_id; ?>" hidden>
                                    <p class="mb-1" style="font-size:14px;">First Name</p>
                                    <input type="text" name="first_name" class="popup" value="<?php echo $user->first_name; ?>">
                                    <p class="mb-1 mt-4" style="font-size:14px;">Last Name</p>
                                    <input type="text" name="last_name" class="popup" value="<?php echo $user->last_name; ?>">
                                    <p class="mb-1 mt-4" style="font-size:14px;">Email</p>
                                    <input type="email" name="email" class="popup" value="<?php echo $user->email; ?>" required>
                                    <p class="mb-1 mt-4" style="font-size:14px;">Phone number</p>
                                    <input type="text" name="phone_number" class="popup" value="<?php echo $user->phone_number; ?>" required>
                                    <p class="mb-1 mt-4" style="font-size:14px;">password</p>
                                    <input type="password" name="password" class="popup" value="<?php echo $user->password; ?>" required>
                                    <p class="mb-1 mt-4" style="font-size:14px;">Avatar</p>
                                    <img class="m-2" style="height:50px" src="../Assets/<?php echo $user->avatar; ?>">
                                    <input type="file" name="avatar" value="">
                                    <p class="mb-1 mt-4" style="font-size:14px;">Employee ID</p>
                                    <input type="text" name="employee_id" class="popup" value="<?php echo $user->employee_id; ?>">
                                    <p class="mb-1 mt-4" style="font-size:14px;">Department</p>
                                    <input type="text" name="department" class="popup" value="<?php echo $user->department; ?>">
                                    <p class="mb-1 mt-4" style="font-size:14px;">City</p>
                                    <select class="popup pt-0 pb-0" name="city_id" required>
                                        <option value="<?php echo $user->city_id; ?>" selected="" hidden><?php echo $user->city_name; ?></option>
                                        <?php foreach ($cities as $city) { ?>
                                            <option value='<?php echo $city->city_id; ?>'><?php echo $city->name; ?></option>
                                        <?php } ?>
                                    </select>
                                    <p class="mb-1 mt-4" style="font-size:14px;">Country</p>
                                    <select class="popup pt-0 pb-0" name="country_id" required>
                                        <option value="<?php echo $user->country_id; ?>" selected="" hidden><?php echo $user->country_name; ?></option>
                                        <?php foreach ($countries as $country) { ?>
                                            <option value='<?php echo $city->country_id; ?>'><?php echo $country->name; ?></option>
                                        <?php } ?>
                                    </select>
                                    <p class="mb-1 mt-4" style="font-size:14px;">Profile text</p>
                                    <textarea rows="5" name="profile_text" class="popup1"><?php echo $user->profile_text; ?></textarea>
                                    <p class="mb-1 mt-4" style="font-size:14px;">Status</p>
                                    <select class="popup pt-0 pb-0" name="status">
                                        <option value="<?php echo $user->status; ?>"><?php echo $user->status; ?></option>
                                        <?php
                                        if ($user->status == '1') {
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
                        <button class="col-example mt-4 mb-4" name="edit_user" type="submit" style="font-size:calc(13px + 0.1vw);">
                            save
                        </button>
                    </div>
                </form>
            <?php } ?>
            </div>
            <?php if ($pagei == 1) { ?>
                <div class="tab-pane show active" id="page">
                <?php } else { ?>
                    <div class="tab-pane" id="page">
                    <?php } ?>
                    <?php if ($pagei == 0) { ?>
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
                            <a class="col-example1" href="addpage" style="font-size:calc(12px + 0.15vw); padding-top: 7px;">
                                <i class="fa fa-plus me-2" aria-hidden="true"></i>
                                Add
                            </a>
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
                                        foreach ($pages as $page) {
                                        ?>
                                            <tr>
                                                <td class="p-3 pe-0" style="font-size:13px;"><?php echo $page->title; ?></td>
                                                <td class="p-3 pe-0" style="font-size:13px;color: #7ed470;"><?php if ($page->status == 1) echo 'Active';
                                                                                                            else echo 'Inactive'; ?></td>
                                                <td class="p-3 pe-0 p-0" style="font-size:20px;">
                                                    <i class="fa fa-pencil-square-o" style="color: #f88634;" aria-hidden="true"></i>
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#popup1"><i class="fa fa-trash-o text-dark" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                        <?php
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
                    <?php } else if ($pagei == 1) { ?>
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
                    <?php } ?>
                    </div>
                    <?php if ($missioni == 1) { ?>
                        <div class="tab-pane show active" id="mission">
                        <?php } else { ?>
                            <div class="tab-pane" id="mission">
                            <?php } ?>
                            <?php if ($missioni == 0) { ?>
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
                                    <a class="col-example1" href="addmission" style="font-size:calc(12px + 0.15vw); padding-top: 7px;">
                                        <i class="fa fa-plus me-2" aria-hidden="true"></i>
                                        Add
                                    </a>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="userc">
                                        <table class="table" style="border: 1px solid #dee2e6;">
                                            <thead class="table-light border-bottom">
                                                <tr>
                                                    <td class="p-3 pe-0 fs-6" scope="col">Mission Title</td>
                                                    <td class="p-3 pe-0 fs-6" scope="col">Mission Type</td>
                                                    <td class="p-3 pe-0 fs-6" scope="col">Start Date</td>
                                                    <td class="p-3 pe-0 fs-6" scope="col">End Date</td>
                                                    <td class="p-3 pe-0 fs-6" scope="col">Action</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($missions as $mission) {
                                                ?>
                                                    <tr>
                                                        <td class="p-3 pe-0" style="font-size:13px;"><?php echo $mission->title; ?></td>
                                                        <td class="p-3 pe-0" style="font-size:13px;"><?php echo $mission->mission_type; ?></td>
                                                        <td class="p-3 pe-0" style="font-size:13px;"><?php echo $mission->start_date; ?></td>
                                                        <td class="p-3 pe-0" style="font-size:13px;"><?php echo $mission->end_date; ?></td>
                                                        <td class="p-3 pe-0 p-0" style="font-size:20px;">
                                                            <i class="fa fa-pencil-square-o" style="color: #f88634;" aria-hidden="true"></i>
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#popup1"><i class="fa fa-trash-o text-dark" aria-hidden="true"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php
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
                            <?php } else if ($missioni == 1) { ?>
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
                            <?php } ?>
                            </div>
                            <div class="tab-pane" id="theme">
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
                                    <a class="col-example1" href="addmission" style="font-size:calc(12px + 0.15vw);background-color: white; padding-top: 7px;">
                                        <i class="fa fa-plus me-2" aria-hidden="true"></i>
                                        Add
                                    </a>
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
                                                foreach ($themes as $theme) {
                                                ?>
                                                    <tr>
                                                        <td class="p-3 pe-0" style="font-size:13px;"><?php echo $theme->title; ?></td>
                                                        <td class="p-3 pe-0" style="font-size:13px;color: #7ed470;"><?php if ($theme->status == 1) echo 'Active';
                                                                                                                    else echo 'Inactive'; ?></td>
                                                        <td class="p-3 pe-0 p-0" style="font-size:20px;">
                                                            <i class="fa fa-pencil-square-o" style="color: #f88634;" aria-hidden="true"></i>
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#popup1"><i class="fa fa-trash-o text-dark" aria-hidden="true"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
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
                            </div>
                            <div class="tab-pane" id="skill">
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
                                                    <td class="p-3 pe-0 fs-6" scope="col">Name</td>
                                                    <td class="p-3 pe-0 fs-6" scope="col">Status</td>
                                                    <td class="p-3 pe-0 fs-6" scope="col">Action</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($skills as $skill) {
                                                ?>
                                                    <tr>
                                                        <td class="p-3 pe-0" style="font-size:13px;"><?php echo $skill->skill_name; ?></td>
                                                        <td class="p-3 pe-0" style="font-size:13px;color: #7ed470;"><?php if ($skill->status == 1) echo 'Active';
                                                                                                                    else echo 'Inactive'; ?></td>
                                                        <td class="p-3 pe-0 p-0" style="font-size:20px;">
                                                            <i class="fa fa-pencil-square-o" style="color: #f88634;" aria-hidden="true"></i>
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#popup1"><i class="fa fa-trash-o text-dark" aria-hidden="true"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php
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
                            </div>
                            <div class="tab-pane" id="app">
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
                                                    <td class="p-3 pe-0 fs-6" scope="col">Mission Id</td>
                                                    <td class="p-3 pe-0 fs-6" scope="col">User Id</td>
                                                    <td class="p-3 pe-0 fs-6" scope="col">User Name</td>
                                                    <td class="p-3 pe-0 fs-6" scope="col">Applied Date</td>
                                                    <td class="p-3 pe-0 fs-6" scope="col">Action</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($apps as $app) {
                                                ?>
                                                    <tr>
                                                        <td class="p-3 pe-0" style="font-size:13px;"><?php echo $app->mission_title; ?></td>
                                                        <td class="p-3 pe-0" style="font-size:13px;"><?php echo $app->mission_id; ?></td>
                                                        <td class="p-3 pe-0" style="font-size:13px;"><?php echo $app->user_id; ?></td>
                                                        <td class="p-3 pe-0" style="font-size:13px;"><?php echo $app->first_name . ' ';
                                                                                                        echo $app->last_name; ?></td>

                                                        <td class="p-3 pe-0" style="font-size:13px;"><?php
                                                                                                        $applied_at = $app->applied_at;
                                                                                                        $applied_at = date("d/m/Y", strtotime($applied_at));
                                                                                                        echo $applied_at; ?></td>
                                                        <td class="p-3 pe-0 p-0" style="font-size:20px;">
                                                            <i class='fa fa-check-circle-o pe-2' style='color: #14c506;' aria-hidden='true'></i>
                                                            <a href='#' data-bs-toggle='modal' data-bs-target='#popup1'><i class='fa fa-times-circle-o text-danger' aria-hidden='true'></i></a>
                                                        </td>
                                                    </tr>
                                                <?php
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
                            </div>
                            <div class="tab-pane" id="story">
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
                                                    <td class="p-3 pe-0 fs-6" scope="col">Mission Title</td>
                                                    <td class="p-3 pe-0 fs-6" scope="col">Action</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($storys as $story) {
                                                ?>
                                                    <tr>
                                                        <td class="p-3 pe-0" style="font-size:13px;"><?php echo $story->story_title; ?></td>
                                                        <td class="p-3 pe-0" style="font-size:13px;"><?php echo $story->first_name . ' ';
                                                                                                        echo $app->last_name; ?></td>
                                                        <td class="p-3 pe-0" style="font-size:13px;"><?php echo $story->mission_title; ?></td>
                                                        <td class="p-3 pe-0 p-0" style="font-size:20px;">
                                                            <button class='col-example13' href='#' style='background-color: white;'>View</button>
                                                            <i class='fa fa-check-circle-o pe-2' style='color: #14c506;' aria-hidden='true'></i>
                                                            <i class='fa fa-times-circle-o text-danger pe-2' aria-hidden='true'></i>
                                                            <a href='#' data-bs-toggle='modal' data-bs-target='#popup1'><i class='fa fa-trash-o text-dark' aria-hidden='true'></i></a>
                                                        </td>
                                                    </tr>
                                                <?php
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
                            </div>
                            <div class="tab-pane" id="banner">
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
                            </div>
                        </div>
                </div>
        </div>
        </body>

        </html>