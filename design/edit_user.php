<?php include "header.php"; ?>
<?php
$first_name = "";
$last_name = "";
include "navbar1.php"; ?>
<br /><br />

<div id="popup1" class="modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-2">
            <div class="modal-header pb-0" style="border-bottom:0 ;">
                <p class="mb-0" style="font-size:20px ;">Change Password </p>
            </div>
            <div class="modal-body pb-0">
                <input type="text" class="popup mb-3" name="" placeholder="Enter old password">
                <input type="text" class="popup mb-3" name="" placeholder="Enter new password">
                <input type="text" class="popup mb-2" name="" placeholder="Enter confirm password">
            </div>
            <div class="modal-footer" style="border-top:0 ;">
                <button type="button" class="col-example8" data-bs-dismiss="modal">Cancle
                </button>
                <button type="button" class="col-example7" data-bs-dismiss="modal">Change Password
                </button>
            </div>
        </div>
    </div>
</div>
<div id="popup3" class="modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3">
            <div class="modal-header pb-0" style="border-bottom:0 ;">
                <p class="mb-0" style="font-size:20px ;">Add Your Skills</p>
            </div>
            <div class="modal-body pb-0">
                <div class="row" style="font-size:10px ;">
                    <div class="col p-3" style="border:solid 1px #d9d9d9">
                        <input type="checkbox" name="skills" value="1" />
                        <label for="option-1">Anthropology</label><br />
                        <input type="checkbox" name="skills" value="2" />
                        <label for="option-2">Archeology</label><br />
                        <input type="checkbox" name="skills" value="3" />
                        <label for="option-3">Astronomy</label><br />
                        <input type="checkbox" name="skills" value="4" />
                        <label for="option-4">Computer Science</label><br />
                        <input type="checkbox" name="skills" value="5" />
                        <label for="option-5">Environmental Science</label><br />
                        <input type="checkbox" name="skills" value="6" />
                        <label for="option-6">History</label><br />
                        <input type="checkbox" name="skills" value="7" />
                        <label for="option-7">Library Sciences</label><br />
                        <input type="checkbox" name="skills" value="8" />
                        <label for="option-8">Mathematics</label><br />
                        <input type="checkbox" name="skills" value="9" />
                        <label for="option-9">Music Theory</label><br />
                        <input type="checkbox" name="skills" value="10" />
                        <label for="option-10">Research</label><br />
                        <input type="checkbox" name="skills" value="11" />
                        <label for="option-11">Administrative Support</label><br />
                        <input type="checkbox" name="skills" value="12" />
                        <label for="option-12">Customer Service</label><br />
                        <input type="checkbox" name="skills" value="13" />
                        <label for="option-13">Data Entry</label><br />
                        <input type="checkbox" name="skills" value="14" />
                        <label for="option-14">Executive Admin</label><br />
                        <input type="checkbox" name="skills" value="15" />
                        <label for="option-15">Office Management</label><br />
                        <input type="checkbox" name="skills" value="16" />
                        <label for="option-16">Office Reception</label><br />
                        <input type="checkbox" name="skills" value="17" />
                        <label for="option-17">Program Management</label><br />
                        <input type="checkbox" name="skills" value="18" />
                        <label for="option-18">Transactions</label><br />
                        <input type="checkbox" name="skills" value="19" />
                        <label for="option-19">Agronomy </label><br />
                        <input type="checkbox" name="skills" value="20" />
                        <label for="option-20">Animal Care / Handling </label><br />
                        <input type="checkbox" name="skills" value="21" />
                        <label for="option-21">Animal Therapy</label><br />
                        <input type="checkbox" name="skills" value="22" />
                        <label for="option-22">Aquarium Maintenance</label><br />
                        <input type="checkbox" name="skills" value="23" />
                        <label for="option-23">Botany</label><br />
                        <input type="checkbox" name="skills" value="24" />
                        <label for="option-24">Environmental Education</label><br />
                        <input type="checkbox" name="skills" value="25" />
                        <label for="option-25">Environmental Policy</label><br />
                        <input type="checkbox" name="skills" value="26" />
                        <label for="option-26">Farming</label><br />
                    </div>
                    <div class="col-1 align-self-center text-center">
                        <img class="mb-2" src="../Assets/arrow.png">
                        <img class="mt-2" src="../Assets/left.png">
                    </div>
                    <script>
                        $(document).ready(function() {
                            $('input[name="skills"]').click(function() {
                                getSelectedCheckBoxes('skills');
                            });

                            var getSelectedCheckBoxes = function(groupName) {
                                var result = $('input[name="' + groupName + '"]:checked');
                                if (result.length > 0) {
                                    resultString = "";
                                    result.each(function() {
                                        var selectedValue = $(this).val();
                                        resultString += $('label[for="option-' + selectedValue + '"]').text() + "<br/>";
                                    });
                                    $('#divskills').html(resultString);
                                }
                            };
                        });

                        function myFunction() {
                            var rslt = window.resultString;
                            const chars = rslt.replace(/<br\/>/g, '\n');
                            document.getElementById("divskill").innerHTML = chars;
                        }
                    </script>
                    <div class="col p-3" style="border:solid 1px #d9d9d9">
                        <div id="divskills"></div>
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
            <div class="row col-example10 m-0">
                <div class="col-lg-12 col-md-12 col-sm-3 col-4 mt-3 mb-3">
                    <img src="../Assets/user-img-large - Copy.png" class="rounded-circle" style="height:calc(50px + 8vw);">
                </div>
                <div class="col-lg-12 col-md-12 col-sm-7 col-6" style="margin-top: auto;margin-bottom:auto;">
                    <h4 class="" style="font-size:calc(15px + 0.1vw);">Evan Donohue</h4>
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
                                <input type="text" class="popup" name="" placeholder="Enter your name" required />
                            </div>
                            <div class="col">
                                <p class="mb-1" style="font-size:14px;">Surname*</p>
                                <input type="text" class="popup" name="" placeholder="Enter your surname" required />
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col">
                                <p class="mb-1" style="font-size:14px;">Employee ID</p>
                                <input type="text" class="popup" name="" placeholder="Enter your employee id">
                            </div>
                            <div class="col">
                                <p class="mb-1" style="font-size:14px;">Manager</p>
                                <input type="text" class="popup" name="" placeholder="Enter your manager details">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col">
                                <p class="mb-1" style="font-size:14px;">Title</p>
                                <input type="text" class="popup" name="" placeholder="Enter your employee id">
                            </div>
                            <div class="col">
                                <p class="mb-1" style="font-size:14px;">Department</p>
                                <input type="text" class="popup" name="" placeholder="Enter your manager details">
                            </div>
                        </div>
                        <p class="mb-1 mt-4" style="font-size:14px;">My Profile*</p>
                        <textarea rows="4" placeholder="Enter your message" name="m_org_detail" class="popup1"></textarea>
                        <p class="mb-1 mt-4" style="font-size:14px;">Why I Volunteer?</p>
                        <textarea rows="4" placeholder="Enter your message" name="m_org_detail" class="popup1"></textarea>

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
                                <input type="text" class="popup" name="" placeholder="Enter your city" required />
                            </div>
                            <div class="col">
                                <p class="mb-1" style="font-size:14px;">Country*</p>
                                <select class="popup pt-0 pb-0">
                                    <option value="none" selected="" disabled="" hidden="">Select your country
                                    </option>
                                    <option value="newsest">India</option>
                                    <option value="oldest">Korea</option>
                                    <option value="lowest">Afghanistan</option>
                                    <option value="highest">pakistan</option>
                                    <option value="favourite">china</option>
                                    <option value="deadline">bangladesh</option>
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
                                <select class="popup pt-0 pb-0">
                                    <option value="none" selected="" disabled="" hidden="">Select your availability
                                    </option>
                                    <option value="newsest">Newest</option>
                                    <option value="oldest">Oldest</option>
                                    <option value="lowest">Lowest available seats</option>
                                    <option value="highest">Highest available seats</option>
                                    <option value="favourite">Sort by my favourite</option>
                                    <option value="deadline">sort by deadline</option>
                                </select>
                            </div>
                            <div class="col">
                                <p class="mb-1" style="font-size:14px;">LinkedIn</p>
                                <input type="url" class="popup" name="" placeholder="Enter linkedIn URL" required />
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
                        <textarea rows="6" class="popup1 mt-3" id="divskill" placeholder="select your skill" disabled></textarea>

                        <button type="button" class="col-example8 mt-3" data-bs-toggle="modal" data-bs-target="#popup3">Add Skills</button>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end mt-4 mb-5">
                <button type="button" class="col-example7">Save</button>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
</body>

</html>