<!-- for stick to top -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
<br /><br /><br />
<div class="container-lg mt-5">
    <h2 class="mb-0">Privacy and Cookies Policy</h2>
    <div class="row pageactive">
        <div class="col-lg-3 col-md-3 col-sm-12 col-12 mb-5">
            <div id="list-example" class="list-group sticky-top" style="padding-top:60px ;">
                <?php foreach ($pages as $page) { ?>
                    <a class="gray1 list-group-item list-group-item-action" href="#policy<?php echo $page->cms_page_id ?>">
                        <div class="d-flex justify-content-between">
                            <?php echo $page->title ?>
                            <img class="mt-2" src="mvc/Assets/images/arrow.png" height="10px">
                        </div>
                    </a>
                    <hr class="div ms-3 me-3">
                <?php } ?>
            </div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 col-12 mb-5">
            <div data-bs-spy="scroll" data-bs-target="#list-example" data-bs-smooth-scroll="true" class="scrollspy-example" tabindex="0">
                <?php foreach ($pages as $page) { ?>
                    <div id="policy<?php echo $page->cms_page_id ?>" class="temp"><br /><br />
                        <h4 class="mt-2" style="font-size:calc(11px + 0.8vw);"><?php echo $page->title ?></h4>
                        <?php echo $page->description ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>