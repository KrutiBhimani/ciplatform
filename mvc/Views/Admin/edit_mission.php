<br />
<form class="m-3" method="post" enctype="multipart/form-data">
    <table class="table table-borderless" style="border: 1px solid #dee2e6;">
        <thead class="table-light border-bottom">
            <tr>
                <td class="p-3 fs-6" scope="col">Edit</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="p-3 fs-6">
                    <p class="mb-1" style="font-size:14px;">Title</p>
                    <input type="text" class="popup" name="title" value="<?php echo $mission->mission_title; ?>" required>
                    <p class="mb-1 mt-4" style="font-size:14px;">Short Description</p>
                    <input type="text" class="popup" name="short_description" value="<?php echo $mission->short_description; ?>" required>
                    <p class="mb-1 mt-4" style="font-size:14px;">Description</p>
                    <textarea rows="5" name="description" class="popup1"><?php echo $mission->description; ?></textarea>
                    <p class="mb-1 mt-4" style="font-size:14px;">City</p>
                    <select class="popup pt-0 pb-0" name="city_id" required>
                        <option value="<?php echo $mission->city_id; ?>" selected="" hidden><?php echo $mission->city_name; ?></option>
                        <?php foreach ($cities as $city) { ?>
                            <option value='<?php echo $city->city_id; ?>'><?php echo $city->name; ?></option>
                        <?php } ?>
                    </select>
                    <p class="mb-1 mt-4" style="font-size:14px;">Country</p>
                    <select class="popup pt-0 pb-0" name="country_id" required>
                        <option value="<?php echo $mission->country_id; ?>" selected="" hidden><?php echo $mission->country_name; ?></option>
                        <?php foreach ($countries as $country) { ?>
                            <option value='<?php echo $country->country_id; ?>'><?php echo $country->name; ?></option>
                        <?php } ?>
                    </select>
                    <p class="mb-1 mt-4" style="font-size:14px;">Organisation Name</p>
                    <input type="text" class="popup" name="organization_name" value="<?php echo $mission->organization_name; ?>">
                    <p class="mb-1 mt-4" style="font-size:14px;">Organisation Detail</p>
                    <input type="text" class="popup" name="organization_detail" value="<?php echo $mission->organization_detail; ?>">
                    <p class="mb-1 mt-4" style="font-size:14px;">Start Date</p>
                    <input type="datetime-local" step="1" class="popup" name="start_date" value="<?php echo $mission->start_date; ?>">
                    <p class="mb-1 mt-4" style="font-size:14px;">End Date</p>
                    <input type="datetime-local" step="1" class="popup" name="end_date" value="<?php echo $mission->end_date; ?>">
                    <p class="mb-1 mt-4" style="font-size:14px;">type</p>
                    <select class="popup pt-0 pb-0" id="selecttype" name="mission_type" required>
                        <option value="<?php echo $mission->mission_type; ?>"><?php echo $mission->mission_type; ?></option>
                        <?php
                        if ($mission->mission_type == 'GOAL') {
                            echo "<option value='TIME'>TIME</option>";
                        } else {
                            echo "<option value='GOAL'>GOAL</option>";
                        }
                        ?>
                    </select>
                    <div id='divresult1'>
                        <?php if ($mission->mission_type == 'TIME') { ?>
                            <p class='mb-1 mt-4' style='font-size:14px;'>Total Seats</p>
                            <input type='number' class='popup' name='total_seat' value="<?php echo $mission->total_seat; ?>">
                            <p class='mb-1 mt-4' style='font-size:14px;'>Registration Deadline</p>
                            <input type="datetime-local" step="1" class='popup' name='deadline' value="<?php echo $mission->deadline; ?>">
                        <?php } else { ?>
                            <p class='mb-1 mt-4' style='font-size:14px;'>Goal</p>
                            <input type='text' class='popup' name='goal_objective_text' value="<?php echo $mission->goal_objective_text; ?>">
                            <p class='mb-1 mt-4' style='font-size:14px;'>Goal Value</p>
                            <input type="number" step="1" class='popup' name='goal_value' value="<?php echo $mission->goal_value; ?>">
                        <?php } ?>
                    </div>
                    <div id="divResult"></div>
                    <p class="mb-1 mt-4" style="font-size:14px;">theme</p>
                    <select class="popup pt-0 pb-0" name="theme_id" required>
                        <option value="<?php echo $mission->theme_id; ?>" selected=""><?php echo $mission->theme_title; ?></option>
                        <?php foreach ($themes as $theme) { ?>
                            <option value='<?php echo $theme->mission_theme_id; ?>'><?php echo $theme->title; ?></option>
                        <?php } ?>
                    </select>
                    <p class="mb-1 mt-4" style="font-size:14px;">skill</p>
                    <select class="popup pt-0 pb-0 h-50" name="mission_skill_id[]" multiple="multiple" size=6>
                        <?php foreach ($selectedSkills as $selectedSkill) { ?>
                            <option value='<?php echo $selectedSkill->skill_id; ?>' selected=""><?php echo $selectedSkill->skill_name; ?></option>
                        <?php } ?>
                        <?php foreach ($skills as $skill) { ?>
                            <option value='<?php echo $skill->skill_id; ?>'><?php echo $skill->skill_name; ?></option>
                        <?php } ?>
                    </select>
                    <p class="mb-1 mt-4" style="font-size:14px;">Image</p>
                    <input type="file" name="media_name[]" multiple>
                    <p class="mb-1 mt-4" style="font-size:14px;">Document</p>
                    <input type="file" name="document_name[]" multiple>
                    <p class="mb-1 mt-4" style="font-size:14px;">Availability</p>
                    <select class="popup pt-0 pb-0" name="availability">
                        <option value="<?php echo $mission->availability; ?>" selected=""><?php echo $mission->availability; ?></option>
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
        <button class="col-example mt-4 mb-4" name="edit_mission" type="submit" style="font-size:calc(13px + 0.1vw);">
            save
        </button>
    </div>
</form>
<script type="text/javascript">
    $(document).ready(function() {
        $('#selecttype').change(function() {
            var selectedOptions = $('#selecttype option:selected');
            if (selectedOptions.length > 0) {
                var resultString = '';
                selectedOptions.each(function() {
                    var val = $(this).val();
                    if (val == "TIME") {
                        resultString += "<p class='mb-1 mt-4' style='font-size:14px;'>Total Seats</p><input type='number' class='popup' name='total_seat'><p class='mb-1 mt-4' style='font-size:14px;' >Registration Deadline</p><input type='date' class='popup' name='deadline'>";

                    } else
                        resultString += "<p class='mb-1 mt-4' style='font-size:14px;'>Goal</p><input type='text' class='popup' name='goal_objective_text'><p class='mb-1 mt-4' style='font-size:14px;' >Goal Value*</p><input type='number' class='popup' name='goal_value'>";
                    $("#divresult1").remove();
                });
                $('#divResult').html(resultString);
            }
        });
    });
</script>