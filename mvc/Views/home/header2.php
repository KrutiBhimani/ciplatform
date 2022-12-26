<br /><br />
<form id="selectSort1" method="post" enctype="multipart/form-data" class="mt-3 mb-0 border-sm-block" style="border-bottom:2px solid rgb(225, 225, 225)">
    <div class="container-lg">
        <div class="container-lg d-sm-none mt-2">
            <table class="table m-0">
                <thead>
                    <tr style="border:1px solid rgb(183, 183, 183)">
                        <td class="p-2">
                            <input type="text" id="search" name="search" placeholder="Search mission..." class="form-control shadow-none m-2" style="border:none; font-size:18px;" onChange="showHide2()">
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
                                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <label class="w-100">Country</label>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <?php foreach ($countries as $country) { ?>
                                                        <li><a class="dropdown-item" href="#"><?php echo $country->name ?></a></li>
                                                    <?php } ?>
                                                </ul>
                                            </li>
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <label class="w-100">City</label>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <?php foreach ($cities as $city) { ?>
                                                        <li><a class="dropdown-item" href="#"><input type="checkbox" class="me-2"><?php echo $city->name ?></a></li>
                                                    <?php } ?>
                                                </ul>
                                            </li>
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <label class="w-100">Theme</label>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <?php foreach ($themes as $theme) { ?>
                                                        <li><a class="dropdown-item" href="#"><input type="checkbox" class="me-2"><?php echo $theme->title ?></a></li>
                                                    <?php } ?>
                                                </ul>
                                            </li>
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <label class="w-100">Skill</label>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <?php foreach ($skills as $skill) { ?>
                                                        <li><a class="dropdown-item" href="#"><input type="checkbox" class="me-2"><?php echo $skill->skill_name ?></a></li>
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
        <div class="d-none d-sm-block">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <td class="border-end" style="width:calc(100%/2);">
                            <div class="input-group d-flex align-items-center">
                                <div class="input-group-prepend" style="padding:5px 0">
                                    <img src="../mvc/Assets/images/search.png" alt="" class="input-group-text p-0 m-0" id="basic-addon1" style="background-color:white; border:none;">
                                </div>
                                <input type="text" value="<?php if (isset($_POST['search'])) {
                                                                echo $_POST['search'];
                                                            } ?>" id="clickedButton" name="search" placeholder="Search mission..." class="form-control shadow-none m-2" style="border:none; font-size:18px;" onChange="showHide1()">
                            </div>
                        </td>
                        <td class="border-end" style="width:calc(100%/8);">
                            <nav class="navbar navbar-expand" style="background-color:white ;">
                                <ul class="w-100 navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="w-100 nav-item dropdown fs-6">
                                        <select class="Rounded-Rectangle-9 w-100" name="country" onChange="showCountry()">
                                            <option value="none" selected="" disabled="" hidden="">Country</option>
                                            <?php foreach ($countries as $country) { ?>
                                                <option value="<?php echo $country->name ?>"><?php echo $country->name ?></option>
                                            <?php } ?>
                                        </select>
                                    </li>
                                </ul>
                            </nav>
                        </td>
                        <td class="border-end pe-4" style="width:calc(100%/8);">
                            <nav class="navbar navbar-expand" style="background-color:white ;">
                                <ul class="w-100 navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="w-100 nav-item dropdown fs-6">
                                        <a class="w-100 nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="width:100% ;">
                                            <label class="w-100">City</label>
                                        </a>
                                        <ul class="dropdown-menu p-0" aria-labelledby="navbarDropdown">
                                            <select class="Rounded-Rectangle-9 w-100" name="city[]" onkeydown="showCity()" multiple size="10">
                                                <?php foreach ($cities as $city) { ?>
                                                    <option value="<?php echo $city->name ?>"><?php echo $city->name ?></option>
                                                <?php } ?>
                                            </select>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </td>
                        <td class="border-end pe-4" style="width:calc(100%/8);">
                            <nav class="navbar navbar-expand" style="background-color:white ;">
                                <ul class="w-100 navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="w-100 nav-item dropdown fs-6">
                                        <a class="w-100 nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="width:100% ;">
                                            <label class="w-100">Theme</label>
                                        </a>
                                        <ul class="dropdown-menu p-0" aria-labelledby="navbarDropdown">
                                            <select class="Rounded-Rectangle-9 w-100" name="theme[]" onkeydown="showTheme()" multiple size="6">
                                                <?php foreach ($themes as $theme) { ?>
                                                    <option value="<?php echo $theme->title ?>"><?php echo $theme->title ?></option>
                                                <?php } ?>
                                            </select>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </td>
                        <td class="border-end pe-4" style="width:calc(100%/8);">
                            <nav class="navbar navbar-expand" style="background-color:white ;">
                                <ul class="w-100 navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="w-100 nav-item dropdown fs-6">
                                        <a class="w-100 nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="width:100% ;">
                                            <label class="w-100">Skill</label>
                                        </a>
                                        <ul class="dropdown-menu p-0" aria-labelledby="navbarDropdown">
                                            <select class="Rounded-Rectangle-9 w-100" name="skill[]" onkeypress="showSkill()" multiple size="10">
                                                <option value="none" selected="" disabled="" hidden="">Skill</option>
                                                <?php foreach ($skills as $skill) { ?>
                                                    <option value="<?php echo $skill->skill_name ?>"><?php echo $skill->skill_name ?></option>
                                                <?php } ?>
                                            </select>
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
</form>