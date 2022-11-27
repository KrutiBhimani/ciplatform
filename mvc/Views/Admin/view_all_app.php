<div class="p-3">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active1 gray ps-0 pe-5 fs-4" data-toggle="tab" href="#userc">Mission
                Application</a>
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
                            echo "<li class='page-item'><a class='page-link active text-center' href='app?page=$i' style='border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px;'><b>$i</b></a></li>";
                        else
                            echo "<li class='page-item'><a class='page-link text-center' href='app?page=$i' style='border-radius:5px; padding:5px; height:30px; width:30px; margin:4px; font-size:15px; color:black;'>$i</a></li>";
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