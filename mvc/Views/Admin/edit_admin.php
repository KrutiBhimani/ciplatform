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
                    <input type="text" name="first_name" class="popup" value="<?php echo $admin->first_name; ?>">
                    <p class="mb-1 mt-4" style="font-size:14px;">Last Name</p>
                    <input type="text" name="last_name" class="popup" value="<?php echo $admin->last_name; ?>">
                    <p class="mb-1 mt-4" style="font-size:14px;">Email</p>
                    <input type="email" name="email" class="popup" value="<?php echo $admin->email; ?>" required>
                    <p class="mb-1 mt-4" style="font-size:14px;">Phone number</p>
                    <input type="text" name="phone_number" class="popup" value="<?php echo $admin->phone_number; ?>" required>
                    <p class="mb-1 mt-4" style="font-size:14px;">password</p>
                    <input type="password" name="password" class="popup" value="<?php echo $admin->password; ?>" required>
                    <p class="mb-1 mt-4" style="font-size:14px;">Avatar</p>
                    <img class="m-2" style="height:50px" src="../mvc/Assets/uplodes/<?php echo $admin->avatar; ?>">
                    <input type="file" name="avatar" value="">
                </td>
            </tr>
        </tbody>
    </table>
    <div class="d-flex align-content-end justify-content-end">
        <a class="col-example8 mt-4 mb-4 me-2" href="ruff.html" style="font-size:calc(13px + 0.1vw);">
            cancel
        </a>
        <button class="col-example mt-4 mb-4" name="edit_admin" type="submit" style="font-size:calc(13px + 0.1vw);">
            save
        </button>
    </div>
</form>