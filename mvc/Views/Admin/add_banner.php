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
                    <p class="mb-1" style="font-size:14px;">Title</p>
                    <input type="text" name="title" class="popup" required>
                    <p class="mb-1 mt-4" style="font-size:14px;">Description</p>
                    <textarea rows="5" name="text" class="popup1" required></textarea>
                    <p class="mb-1 mt-4" style="font-size:14px;">Sort Order</p>
                    <input type="number" name="sort_order" class="popup" required>
                    <p class="mb-1 mt-4" style="font-size:14px;">Image</p>
                    <input type="file" name="image" value="" required>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="d-flex align-content-end justify-content-end">
        <a class="col-example8 mt-4 mb-4 me-2" href="#" style="font-size:calc(13px + 0.1vw);">
            cancel
        </a>
        <button class="col-example mt-4 mb-4" name="add_banner" type="submit" style="font-size:calc(13px + 0.1vw);">
            save
        </button>
    </div>
</form>