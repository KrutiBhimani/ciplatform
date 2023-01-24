<br />
<form class="m-3" method="post" enctype="multipart/form-data">
    <table class="table table-borderless" style="border: 1px solid #dee2e6;">
        <thead class="table-light border-bottom">
            <tr>
                <td class="p-3 fs-6" scope="col">Add</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="p-3 fs-6">
                    <p class="mb-1" style="font-size:14px;">Title*</p>
                    <input type="text" class="popup" name="title" required>
                    <p class="mb-1 mt-4" style="font-size:14px;">Short Description*</p>
                    <input type="text" class="popup" name="short_description" required>
                    <p class="mb-1 mt-4" style="font-size:14px;">Description</p>
                    <textarea rows="5" name="description" class="popup1"></textarea>
                    <p class="mb-1 mt-4" style="font-size:14px;">City*</p>
                    <select class="popup pt-0 pb-0" name="city_id" required>
                        <option value="none" selected="" disabled="" hidden=""></option>
                        <?php foreach ($cities as $city) { ?>
                            <option value='<?php echo $city->city_id; ?>'><?php echo $city->name; ?></option>
                        <?php } ?>
                    </select>
                    <p class="mb-1 mt-4" style="font-size:14px;">Country*</p>
                    <select class="popup pt-0 pb-0" name="country_id" required>
                        <option value="none" selected="" disabled="" hidden=""></option>
                        <?php foreach ($countries as $country) { ?>
                            <option value='<?php echo $country->country_id; ?>'><?php echo $country->name; ?></option>
                        <?php } ?>
                    </select>
                    <p class="mb-1 mt-4" style="font-size:14px;">Organisation Name</p>
                    <input type="text" class="popup" name="organization_name">
                    <p class="mb-1 mt-4" style="font-size:14px;">Organisation Detail</p>
                    <input type="text" class="popup" name="organization_detail">
                    <p class="mb-1 mt-4" style="font-size:14px;">Start Date</p>
                    <input type="datetime-local" step="1" class="popup" name="start_date">
                    <p class="mb-1 mt-4" style="font-size:14px;">End Date</p>
                    <input type="datetime-local" step="1" class="popup" name="end_date">
                    <p class="mb-1 mt-4" style="font-size:14px;">type*</p>
                    <select class="popup pt-0 pb-0" id="selecttype" name="mission_type" required>
                        <option value="none" selected="" disabled="" hidden=""></option>
                        <option value='TIME'>Time</option>
                        <option value='GOAL'>Goal</option>
                    </select>
                    <div id="divResult"></div>
                    <p class="mb-1 mt-4" style="font-size:14px;">theme*</p>
                    <select class="popup pt-0 pb-0" name="theme_id" required>
                        <option value="none" selected="" disabled="" hidden=""></option>
                        <?php foreach ($themes as $theme) { ?>
                            <option value='<?php echo $theme->mission_theme_id; ?>'><?php echo $theme->title; ?></option>
                        <?php } ?>
                    </select>
                    <p class="mb-1 mt-4" style="font-size:14px;">skill</p>
                    <select class="popup pt-0 pb-0 h-50" name="skill_id[]" multiple="multiple" size=6>
                        <?php foreach ($skills as $skill) { ?>
                            <option value='<?php echo $skill->skill_id; ?>'><?php echo $skill->skill_name; ?></option>
                        <?php } ?>
                    </select>
                    <!-- <input id="divResult1" value=''></input> -->
                    <p class="mb-1 mt-4" style="font-size:14px;">Image</p>
                    <input type="file" name="media_name[]" multiple>
                    <p class="mb-1 mt-4" style="font-size:14px;">Document</p>
                    <input type="file" name="document_name[]" multiple>
                    <p class="mb-1 mt-4" style="font-size:14px;">Availability</p>
                    <select class="popup pt-0 pb-0" name="availability">
                        <option value="none" selected="" disabled="" hidden=""></option>
                        <option value='daily'>Daily</option>
                        <option value='weekly'>Weekly</option>
                        <option value='week-end'>Weekend</option>
                        <option value='monthly'>Monthly</option>
                    </select>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="d-flex align-content-end justify-content-end">
        <a class="col-example8 mt-4 mb-4 me-2" href="#" style="font-size:calc(13px + 0.1vw);">
            cancel
        </a>
        <button class="col-example mt-4 mb-4" name="add_mission" type="submit" style="font-size:calc(13px + 0.1vw);">
            save
        </button>
    </div>
</form>