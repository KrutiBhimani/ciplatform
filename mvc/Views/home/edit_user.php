<br /><br /><br />
<form method="post" enctype="multipart/form-data">
    <div id="popup1" class="modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-2">
                <div class="modal-header pb-0" style="border-bottom:0 ;">
                    <p class="mb-0" style="font-size:20px ;">Change Password </p>
                </div>
                <div class="modal-body pb-0">
                    <input type="password" class="popup mb-3" name="password" placeholder="Enter old password" required>
                    <input type="password" class="popup mb-3" name="password1" placeholder="Enter new password" required>
                    <input type="password" class="popup mb-2" name="password2" placeholder="Enter confirm password" required>
                </div>
                <div class="modal-footer" style="border-top:0 ;">
                    <button type="button" class="col-example8" data-bs-dismiss="modal">Cancle
                    </button>
                    <button type="submit" name='change' class="col-example7" data-bs-dismiss="modal">Change Password
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<form method="post" enctype="multipart/form-data">
    <div id="popup3" class="modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3">
                <div class="modal-header pb-0" style="border-bottom:0 ;">
                    <p class="mb-0" style="font-size:20px ;">Add Your Skills</p>
                </div>
                <div class="modal-body pb-0">
                    <div class="row" style="font-size:10px ;">
                        <div class="col p-3" style="border:solid 1px #d9d9d9">
                            <select id="selectCountries" class='w-100 border-none' name="skill[]" multiple="multiple" size=26 style="border: none;overflow-y: auto; font-size:12px">
                                <?php foreach ($skills as $skill) {
                                ?>
                                    <option value='<?php echo $skill->skill_id; ?>' <?php foreach ($selected as $select) {
                                                                                        if ($select->skill_id == $skill->skill_id) {
                                                                                            echo 'selected';
                                                                                        }
                                                                                    } ?>><?php echo $skill->skill_name ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                        <div class="col-1 align-self-center text-center">
                            <img class="mb-2" src="../mvc/Assets/images/arrow.png">
                            <img class="mt-2" src="../mvc/Assets/images/left.png">
                        </div>
                        <script>
                            $(document).ready(function() {
                                $('#selectCountries').ready(function() {
                                    var selectedOptions = $('#selectCountries option:selected');
                                    if (selectedOptions.length > 0) {
                                        var resultString = '';
                                        selectedOptions.each(function() {
                                            resultString += $(this).text() + '<br/>';
                                        });
                                        $('#divResult').html(resultString);
                                    }
                                });
                            });

                            $(document).ready(function() {
                                $('#selectCountries').change(function() {
                                    var selectedOptions = $('#selectCountries option:selected');
                                    if (selectedOptions.length > 0) {
                                        var resultString = '';
                                        selectedOptions.each(function() {
                                            resultString += $(this).text() + '<br/>';
                                        });
                                        $('#divResult').html(resultString);
                                    }
                                });
                            });

                            function myFunction() {
                                var rslt = document.getElementById("divResult").innerHTML;
                                const chars = rslt.replace(/<br>/g, '\n');
                                document.getElementById("divskill").innerHTML = chars;
                            }
                        </script>
                        <div class="col p-3" style="border:solid 1px #d9d9d9">
                            <div id="divResult" style="font-size: 12px;"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-0 pt-2" style="border-top:0 ;justify-content:flex-start;">
                    <button type="button" class="col-example8" data-bs-dismiss="modal">Cancle
                    </button>
                    <button type="button" class="col-example7" data-bs-dismiss="modal" onclick="myFunction()">Save
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="container-lg">
        <div class="row mt-5">
            <div class="col-lg-3 col-md-3 col-sm-12 col-12 mb-5">
                <div class="row col col-example10 text-center m-0">
                    <div class="col-lg-12 col-md-12 col-sm-5 col-5">
                        <script>
                            function readURL(input) {
                                if (input.files && input.files[0]) {
                                    var reader = new FileReader();
                                    reader.onload = function(e) {
                                        $('#blah')
                                            .attr('src', e.target.result);
                                    };
                                    reader.readAsDataURL(input.files[0]);
                                }
                            }
                        </script>
                        <label for="choose-file2">
                            <img id="blah" src="../mvc/Assets/<?php if ($user->avatar == '') echo 'images/user1.png';
                                                                else echo 'uplodes/' . $user->avatar; ?>" class="rounded-circle mt-4 mb-3" style="height:calc(30px + 8vw);width:calc(30px + 8vw);">
                        </label>
                        <input type="file" name='avatar' id="choose-file2" onchange="readURL(this);" style="display: none;">
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-5 col-5" style="margin: auto;">
                        <h4 class="" style="font-size:calc(15px + 0.1vw);"><?php echo $user->first_name . ' ' . $user->last_name ?></h4>
                        <a href="#" style="font-size:calc(11px + 0.1vw); color: black;" data-bs-toggle="modal" data-bs-target="#popup1">change password</a><br />
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                <div>
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active1 gray ps-0 pe-0 pt-0" data-toggle="tab" href="#mission">Basic
                                Information</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="mission">
                            <div class="row mt-4">
                                <div class="col">
                                    <p class="mb-1" style="font-size:14px;">Name*</p>
                                    <input type="text" class="popup" name="first_name" value="<?php echo $user->first_name ?>" placeholder="Enter your name" required />
                                </div>
                                <div class="col">
                                    <p class="mb-1" style="font-size:14px;">Surname*</p>
                                    <input type="text" class="popup" name="last_name" value="<?php echo $user->last_name ?>" placeholder="Enter your surname" required />
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col">
                                    <p class="mb-1" style="font-size:14px;">Employee ID</p>
                                    <input type="text" class="popup" name="employee_id" value="<?php echo $user->employee_id ?>" placeholder="Enter your employee id">
                                </div>
                                <div class="col">
                                    <p class="mb-1" style="font-size:14px;">Manager</p>
                                    <input type="text" class="popup" name="manager" value="<?php echo $user->manager ?>" placeholder="Enter your manager details">
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col">
                                    <p class="mb-1" style="font-size:14px;">Title</p>
                                    <input type="text" class="popup" name="title" value="<?php echo $user->title ?>" placeholder="Enter your employee id">
                                </div>
                                <div class="col">
                                    <p class="mb-1" style="font-size:14px;">Department</p>
                                    <input type="text" class="popup" name="department" value="<?php echo $user->department ?>" placeholder="Enter your manager details">
                                </div>
                            </div>
                            <p class="mb-1 mt-4" style="font-size:14px;">My Profile*</p>
                            <textarea rows="4" placeholder="Enter your message" name="profile_text" value="<?php echo $user->profile_text ?>" class="popup1"><?php echo $user->profile_text ?></textarea>
                            <p class="mb-1 mt-4" style="font-size:14px;">Why I Volunteer?</p>
                            <textarea rows="4" placeholder="Enter your message" name="why_i_volunteer" value="<?php echo $user->why_i_volunteer ?>" class="popup1"><?php echo $user->why_i_volunteer ?></textarea>

                        </div>
                    </div>
                </div>
                <div class="mt-5">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active1 gray ps-0 pe-0 pt-0" data-toggle="tab" href="#mission">Address
                                Information</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="mission">
                            <div class="row mt-4">
                                <div class="col">
                                    <p class="mb-1" style="font-size:14px;">City</p>
                                    <select class="popup pt-0 pb-0" name="city_id" required>
                                        <?php foreach ($cities as $city) { ?>
                                            <option value='<?php echo $city->city_id; ?>' <?php if ($city->city_id == $user->city_id) {
                                                                                                echo 'selected';
                                                                                            } ?>><?php echo $city->name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col">
                                    <p class="mb-1" style="font-size:14px;">Country*</p>
                                    <select class="popup pt-0 pb-0" name="country_id" required>
                                        <?php foreach ($countries as $country) { ?>
                                            <option value='<?php echo $country->country_id; ?>' <?php if ($country->country_id == $user->country_id) {
                                                                                                    echo 'selected';
                                                                                                } ?>><?php echo $country->name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-5">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active1 gray ps-0 pe-0 pt-0" data-toggle="tab" href="#mission">Professional
                                Information</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="mission">
                            <div class="row mt-4">
                                <div class="col">
                                    <p class="mb-1" style="font-size:14px;">Availablity</p>
                                    <select class="popup pt-0 pb-0" name='availability'>
                                        <?php if ($user->availability == null) { ?>
                                            <option value="none" selected="" disabled="" hidden="">Select your availability</option>
                                        <?php } ?>
                                        <option value="daily" <?php if ($user->availability == 'daily') {
                                                                    echo 'selected';
                                                                } ?>>Daily</option>
                                        <option value="weekly" <?php if ($user->availability == 'weekly') {
                                                                    echo 'selected';
                                                                } ?>>Weekly</option>
                                        <option value="week-end" <?php if ($user->availability == 'week-end') {
                                                                        echo 'selected';
                                                                    } ?>>Weekend</option>
                                        <option value="monthly" <?php if ($user->availability == 'monthly') {
                                                                    echo 'selected';
                                                                } ?>>Monthly</option>
                                    </select>
                                    </select>
                                </div>
                                <div class="col">
                                    <p class="mb-1" style="font-size:14px;">LinkedIn</p>
                                    <input type="url" class="popup" name="linked_in_url" value="<?php echo $user->linked_in_url ?>" placeholder="Enter linkedIn URL" required />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-5">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active1 gray ps-0 pe-0 pt-0" data-toggle="tab" href="#mission">My
                                Skills</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="mission">
                            <textarea rows="6" class="popup1 mt-3" id="divskill" placeholder="select your skill" disabled><?php foreach ($selected as $select) {
                                                                                                                                echo $select->skill_name . '&#13;&#10;';
                                                                                                                            } ?></textarea>

                            <button type="button" class="col-example8 mt-3" data-bs-toggle="modal" data-bs-target="#popup3">Add Skills</button>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-4 mb-5">
                    <button type="submit" name="edit_user" class="col-example7">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>