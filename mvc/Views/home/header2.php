<br /><br />
<form id="selectSort3" method="post" enctype="multipart/form-data" class="mb-0 border-sm-block" style="margin-top: 13px;">
    <div>
        <div class="container-lg p-0">
            <div class="container-lg d-sm-none mt-2">
                <table class="table m-0">
                    <thead>
                        <tr style="border:1px solid rgb(183, 183, 183)">
                            <td class="p-2">
                                <input type="text" value="<?php if (isset($_POST['search'])) {
                                                                echo $_POST['search'];
                                                            } ?>" id="clickedButton" name="search" placeholder="Search mission..." class="form-control shadow-none m-2" style="border:none; font-size:18px;" onChange="showHide2()">
                            </td>
                            <td>
                                <nav class="navbar navbar-expand-sm" style="background-color:white ;">
                                    <div class="container-fluid justify-content-end">
                                        <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent2" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                            <img src="../mvc/Assets/images/filter.png" class="input-group-text m-0 p-0" id="basic-addon1" style="background-color:white; border:none;" height="30px">
                                        </button>
                                    </div>
                                </nav>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <nav class="navbar navbar-expand-sm" style="background-color:white ;">
                                    <div class="container-fluid">
                                        <div class="collapse navbar-collapse w-100" id="navbarSupportedContent2">
                                            <ul class="navbar-nav me-auto mb-2 mb-lg-0 fs-6">
                                                <li class="nav-item dropdown">
                                                    <select class="Rounded-Rectangle-9 w-100 ps-0 pe-0" name="country" onkeydown="showHide2()">
                                                        <option value="none" hidden="">Country</option>
                                                        <?php foreach ($countries as $country) { ?>
                                                            <option value="<?php echo $country->name ?>" <?php if (isset($_POST['country'])) {
                                                                                                                if ($country->name == $_POST['country']) {
                                                                                                                    echo 'selected';
                                                                                                                }
                                                                                                            } ?>><?php echo $country->name ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </li>
                                                <li class="nav-item dropdown" style="margin: 0 22px 0 5px;">
                                                    <a class="w-100 nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="width:100% ;">
                                                        <label class="w-100">City</label>
                                                    </a>
                                                    <ul class="dropdown-menu p-0" aria-labelledby="navbarDropdown">
                                                        <?php foreach ($cities as $city) { ?>
                                                            <input type="checkbox" name='city[]' value="<?php echo $city->name ?>" onkeydown="showHide2()" <?php if (isset($_POST['city'])) {
                                                                                                                                                                foreach ($_POST['city'] as $item) {
                                                                                                                                                                    if ($city->name == $item) {
                                                                                                                                                                        echo 'checked';
                                                                                                                                                                    }
                                                                                                                                                                }
                                                                                                                                                            } ?>> <?php echo $city->name ?> <br />
                                                        <?php } ?>
                                                    </ul>
                                                </li>
                                                <li class="nav-item dropdown" style="margin: 0 22px 0 5px;">
                                                    <a class="w-100 nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="width:100% ;">
                                                        <label class="w-100">Theme</label>
                                                    </a>
                                                    <ul class="dropdown-menu p-0" aria-labelledby="navbarDropdown">
                                                        <?php foreach ($themes as $theme) { ?>
                                                            <input type="checkbox" name='theme[]' value="<?php echo $theme->title ?>" onkeydown="showHide2()" <?php if (isset($_POST['theme'])) {
                                                                                                                                                                    foreach ($_POST['theme'] as $item) {
                                                                                                                                                                        if ($theme->title == $item) {
                                                                                                                                                                            echo 'checked';
                                                                                                                                                                        }
                                                                                                                                                                    }
                                                                                                                                                                } ?>> <?php echo $theme->title ?> <br />
                                                        <?php } ?>
                                                    </ul>
                                                </li>
                                                <li class="nav-item dropdown" style="margin: 0 22px 0 5px;">
                                                    <a class="w-100 nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="width:100% ;">
                                                        <label class="w-100">Skill</label>
                                                    </a>
                                                    <ul class="dropdown-menu p-0" aria-labelledby="navbarDropdown">
                                                        <?php foreach ($skills as $skill) { ?>
                                                            <input type="checkbox" name='skill[]' value="<?php echo $skill->skill_name ?>" onkeydown="showHide2()" <?php if (isset($_POST['skill'])) {
                                                                                                                                                                        foreach ($_POST['skill'] as $item) {
                                                                                                                                                                            if ($skill->skill_name == $item) {
                                                                                                                                                                                echo 'checked';
                                                                                                                                                                            }
                                                                                                                                                                        }
                                                                                                                                                                    } ?>> <?php echo $skill->skill_name ?> <br />
                                                        <?php } ?>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </nav>
                            </td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</form>
<form id="selectSort1" action="home" method="post" enctype="multipart/form-data" class="mb-0">
    <div style="border-bottom:2px solid rgb(225, 225, 225)" class="border-sm-block">
        <div class="container-lg">
            <div class="d-none d-sm-block">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <td class="border-end pb-1" style="width:calc(100%/2);">
                                <div class="input-group d-flex align-items-center">
                                    <div class="input-group-prepend" style="padding:5px 0">
                                        <img src="../mvc/Assets/images/search.png" alt="" class="input-group-text p-0 m-0" id="basic-addon1" style="background-color:white; border:none;">
                                    </div>
                                    <input type="text" value="<?php if (isset($_POST['search'])) {
                                                                    echo $_POST['search'];
                                                                } ?>" id="clickedButton" name="search" placeholder="Search mission..." class="form-control shadow-none m-2" style="border:none; font-size:18px;" onChange="showHide()">
                                </div>
                            </td>
                            <td class="border-end pb-1" style="width:calc(100%/8);">
                                <nav class="navbar navbar-expand ps-0 pe-0" style="background-color:white ;">
                                    <ul class="w-100 navbar-nav me-auto mb-2 mb-lg-0">
                                        <li class="w-100 nav-item dropdown fs-6">
                                            <select class="Rounded-Rectangle-9 w-100" name="country" onkeydown="showHide()">
                                                <option value="none" hidden="">Country</option>
                                                <?php foreach ($countries as $country) { ?>
                                                    <option value="<?php echo $country->name ?>" <?php if (isset($_POST['country'])) {
                                                                                                        if ($country->name == $_POST['country']) {
                                                                                                            echo 'selected';
                                                                                                        }
                                                                                                    } ?>><?php echo $country->name ?></option>
                                                <?php } ?>
                                            </select>
                                        </li>
                                    </ul>
                                </nav>
                            </td>
                            <td class="border-end pe-4 pb-1" style="width:calc(100%/8);">
                                <nav class="navbar navbar-expand ps-0 pe-0" style="background-color:white ;">
                                    <ul class="w-100 navbar-nav me-auto mb-2 mb-lg-0">
                                        <li class="w-100 nav-item dropdown fs-6">
                                            <a class="w-100 nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="width:100% ;">
                                                <label class="w-100">City</label>
                                            </a>
                                            <ul class="dropdown-menu p-0" aria-labelledby="navbarDropdown">
                                                <?php foreach ($cities as $city) { ?>
                                                    <input type="checkbox" name='city[]' value="<?php echo $city->name ?>" onkeydown="showHide()" <?php if (isset($_POST['city'])) {
                                                                                                                                                        foreach ($_POST['city'] as $item) {
                                                                                                                                                            if ($city->name == $item) {
                                                                                                                                                                echo 'checked';
                                                                                                                                                            }
                                                                                                                                                        }
                                                                                                                                                    } ?>> <?php echo $city->name ?> <br />
                                                <?php } ?>
                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                            </td>
                            <td class="border-end pe-4 pb-1" style="width:calc(100%/8);">
                                <nav class="navbar navbar-expand ps-0 pe-0" style="background-color:white ;">
                                    <ul class="w-100 navbar-nav me-auto mb-2 mb-lg-0">
                                        <li class="w-100 nav-item dropdown fs-6">
                                            <a class="w-100 nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="width:100% ;">
                                                <label class="w-100">Theme</label>
                                            </a>
                                            <ul class="dropdown-menu p-0" aria-labelledby="navbarDropdown">
                                                <?php foreach ($themes as $theme) { ?>
                                                    <input type="checkbox" name='theme[]' value="<?php echo $theme->title ?>" onkeydown="showHide()" <?php if (isset($_POST['theme'])) {
                                                                                                                                                            foreach ($_POST['theme'] as $item) {
                                                                                                                                                                if ($theme->title == $item) {
                                                                                                                                                                    echo 'checked';
                                                                                                                                                                }
                                                                                                                                                            }
                                                                                                                                                        } ?>> <?php echo $theme->title ?> <br />
                                                <?php } ?>
                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                            </td>
                            <td class="border-end pe-4 pb-1" style="width:calc(100%/8);">
                                <nav class="navbar navbar-expand ps-0 pe-0" style="background-color:white ;">
                                    <ul class="w-100 navbar-nav me-auto mb-2 mb-lg-0">
                                        <li class="w-100 nav-item dropdown fs-6">
                                            <a class="w-100 nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="width:100% ;">
                                                <label class="w-100">Skill</label>
                                            </a>
                                            <ul class="dropdown-menu p-0" aria-labelledby="navbarDropdown">
                                                <?php foreach ($skills as $skill) { ?>
                                                    <input type="checkbox" name='skill[]' value="<?php echo $skill->skill_name ?>" onkeydown="showHide()" <?php if (isset($_POST['skill'])) {
                                                                                                                                                                foreach ($_POST['skill'] as $item) {
                                                                                                                                                                    if ($skill->skill_name == $item) {
                                                                                                                                                                        echo 'checked';
                                                                                                                                                                    }
                                                                                                                                                                }
                                                                                                                                                            } ?>> <?php echo $skill->skill_name ?> <br />
                                                <?php } ?>
                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                            </td>
                        </tr>
                    </thead>
                </table>
            </div>

        </div>
    </div>
    <div class="container-lg d-none d-lg-block mb-4 mt-3">
        <div class="row row-cols-auto ps-4" id="text">
            <?php
            if (isset($_POST['skill']) || isset($_POST['theme']) || isset($_POST['city']) || (isset($_POST['country']) && $_POST['country'] != 'none')) {
                $skill = array();
                $theme = array();
                $city = array();
                $country = array();
                if (isset($_POST['country']) && $_POST['country'] != 'none') { ?>
                    <div class="p-1 six-txt pe-2 m-1">
                        <span id="removecountry"><?php echo $_POST['country'] ?></span>
                        <img src="../mvc/Assets/images/cancel.png" alt="" height="8px" onclick="removecountry()" style="cursor: pointer;">
                    </div>
                    <?php }
                if (isset($_POST['skill'])) {
                    foreach ($_POST['skill'] as $item) {
                    ?>
                        <div class="p-1 six-txt pe-2 m-1">
                            <span><?php echo $item ?></span>
                            <img src="../mvc/Assets/images/cancel.png" alt="" height="8px" onclick="remove('<?php echo $item ?>')" style="cursor: pointer;">
                        </div>
                    <?php
                    }
                }
                if (isset($_POST['theme'])) {
                    foreach ($_POST['theme'] as $item) {
                    ?>
                        <div id="t1" class="p-1 six-txt pe-2 m-1">
                            <button value="<?php echo $item ?>" class="six-txt1" style="background-color: transparent;border:none;">
                                <span><?php echo $item ?></span>
                            </button>
                            <img src="../mvc/Assets/images/cancel.png" alt="" height="8px" onclick="remove('<?php echo $item ?>');" style="cursor: pointer;">
                        </div>
                    <?php
                    }
                }
                if (isset($_POST['city'])) {
                    foreach ($_POST['city'] as $item) {
                    ?>
                        <div id='remove' class="p-1 six-txt pe-2 m-1">
                            <span><?php echo $item ?></span>
                            <img src="../mvc/Assets/images/cancel.png" id='removeAll' alt="" height="8px" onclick="remove('<?php echo $item ?>')" style="cursor: pointer;">
                        </div>
                <?php
                    }
                }
                ?>
                <button class="p-1 ps-2 pe-2 m-1" style="border:none; background-color:transparent;">
                    <a href="home" style="color:black; font-size:11px">Clear all</a>
                </button>
            <?php } ?>
        </div>
    </div>
    <?php if ($row > 0) { ?>
        <div class="container-lg mt-3">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-12">
                    <h2 class="mb-0" style="font-size:calc(14px + 0.3vw);">Explore <b> <?php echo $row ?> missions</b></h2>
                </div>
                <div class="col-lg-7 col-mb-7 col-sm-7 col-0" style="display:flex; justify-content:flex-end">
                    <div class="d-none d-lg-block">

                        <select class="Rounded-Rectangle-8" name="sort" onkeydown="showHide()">
                            <?php if (isset($_POST['sort'])) { ?>
                                <option value="<?php echo $_POST['sort']; ?>" selected hidden><?php echo $_POST['sort']; ?></option>
                            <?php } else { ?>
                                <option value="none" selected="" disabled="" hidden="">Sort By...</option>
                            <?php } ?>
                            <option value="Newest">Newest</option>
                            <option value="Oldest">Oldest</option>
                            <option value="Lowest available seats">Lowest available seats</option>
                            <option value="Highest available seats">Highest available seats</option>
                            <option value="Sort by my favourite">Sort by my favourite</option>
                            <option value="sort by deadline">sort by deadline</option>
                        </select>
                        <a id="gridlink" class="ms-2" href="#"><i id="h1" class="fa fa-th-large Ellipse-574 p-2 fs-5" aria-hidden="true" style="color:gray"></i></a>
                        <a id="listlink" href="#"><i id="h2" class="fa fa-list-ul p-2 fs-5" aria-hidden="true" style="color:gray"></i></a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</form>