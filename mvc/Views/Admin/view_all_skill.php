<div class="p-3">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active1 gray ps-0 pe-5 fs-4" data-toggle="tab" href="#userc">Mission
                Skill</a>
        </li>
    </ul>
    <div class="d-flex justify-content-between mt-4 mb-4">
        <form class='m-0' method="post" enctype="multipart/form-data">
            <div style="border: 2px solid #dee2e6; border-radius:5px;">
                <div class="input-group">
                    <span class="input-group-text" style="background-color:transparent; border:none;">
                        <img src="../Assets/search.png" height="15px">
                    </span>
                    <input type="text" name='search' placeholder="search" class="form-control" style="border:none;border-radius:5px;background-color:transparent;">
                </div>
            </div>
        </form>
        <a class="col-example1" href='skill?source=add_skill' style="font-size:calc(12px + 0.15vw); padding-top: 7px;">
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
                                <a href='skill?source=edit_skill&edit=<?php
                                                                    $id = $skill->skill_id;
                                                                    $salt = "SECRET_STUFF";
                                                                    $encrypted_id = base64_encode($id . $salt);
                                                                    echo $encrypted_id; ?>'><i class="fa fa-pencil-square-o" style="color: #f88634;" aria-hidden="true"></i></a>
                                <a onClick="javascript:return confirm('Are you sure to delete?');" href='skill?source=delete_skill&delete=<?php $id = $skill->skill_id; $salt = "SECRET_STUFF"; $encrypted_id = base64_encode($id . $salt); echo $encrypted_id; ?>'><i class="fa fa-trash-o text-dark" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <?php if (!isset($_POST['search'])) { ?>
            <nav aria-label="Page navigation example">
                <ul class="pagination pager justify-content-end">
                    <li class="page-item">
                        <a class="page-link" href="#" style="border-radius:5px; padding:10px; height:30px; width:30px; margin:4px;"><img src="../Assets/previous.png" alt=""></a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#" style="border-radius:5px; padding:10px; height:30px; width:30px; margin:4px;"><img src="../Assets/left.png" alt=""></a></li>
                    <?php
                    for ($i = 1; $i <= $cnt; $i++) {
                        if ($i == $page)
                            echo "<li class='page-item'><a class='page-link active text-center' href='skill?page=$i' style='border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px;'><b>$i</b></a></li>";
                        else
                            echo "<li class='page-item'><a class='page-link text-center' href='skill?page=$i' style='border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px; color:black;'>$i</a></li>";
                    } ?>
                    <li class="page-item">
                        <a class="page-link" href="#" style="border-radius:5px; padding:10px; height:30px; width:30px; margin:4px;"><img src="../Assets/arrow.png" alt=""></a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#" style="border-radius:5px; padding:10px; height:30px; width:30px; margin:4px;"><img src="../Assets/next.png" alt=""></a></li>
                </ul><?php } ?>
            </nav>
        </div>
    </div>
</div>