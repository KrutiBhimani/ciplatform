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
                    <img class="m-2" style="height:50px" src="../mvc/Assets/uplodes/<?php echo $user->avatar; ?>">
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