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
                    <input type="text" name="title" class="popup" value="<?php echo $pagei->title; ?>" required>
                    <p class="mb-1 mt-4" style="font-size:14px;">Description</p>
                    <textarea rows="8" name="description" class="popup1"><?php echo $pagei->description; ?></textarea>
                    <p class="mb-1 mt-4" style="font-size:14px;">Slug</p>
                    <input type="text" name="slug" class="popup" value="<?php echo $pagei->slug; ?>" required>
                    <p class="mb-1 mt-4" style="font-size:14px;">Status</p>
                    <select class="popup pt-0 pb-0" name="status">
                        <option value="<?php echo $pagei->status; ?>"><?php echo $pagei->status; ?></option>
                        <?php
                        if ($pagei->status == '1') {
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
        <a class="col-example8 mt-4 mb-4 me-2" href="#" style="font-size:calc(13px + 0.1vw);">
            cancel
        </a>
        <button class="col-example mt-4 mb-4" name="edit_page" type="submit" style="font-size:calc(13px + 0.1vw);">
            save
        </button>
    </div>
</form>