<?php include "header.php"; ?>
<?php
$first_name = "";
$last_name = "";
include "navbar1.php"; ?>
<br /><br />

    <div class="container-lg">
        <p class="fs-2 fw-light pt-5 mb-2">Share your story</p>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                <p class="mb-1 mt-4" style="width:100% ;">Select mission</p>
                <select class="popup pt-0 pb-0">
                    <option value="none" selected="" disabled="" hidden="">Select your mission</option>
                    <option value="newsest">Newest</option>
                    <option value="oldest">Oldest</option>
                    <option value="lowest">Lowest available seats</option>
                    <option value="highest">Highest available seats</option>
                    <option value="favourite">Sort by my favourite</option>
                    <option value="deadline">sort by deadline</option>
                </select>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                <p class="mb-1 mt-4">My Story Title</p>
                <input type="text" class="popup" name="" placeholder="Enter story title">
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-12 removecal">
                <p class="mb-1 mt-4">Date</p>
                <input type="date" name="" class="popup" value="Select date">
            </div>
        </div>
        <p class="mb-1 mt-4">My Story</p>
        <textarea rows="5" placeholder="Enter your message" name="" class="popup1"></textarea>
        <p class="mb-1 mt-4">Enter Video URL</p>
        <input type="url" class="popup" name="" placeholder="Enter your url">
        <script>
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#blah')
                            .attr('src', e.target.result)
                            .width(80)
                            .height(80);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }</script>
        <p class="mb-1 mt-3">Mission Images</p>
        <label for="choose-file2" class="custom-file-upload">
            <img src="../Assets/drag-and-drop.png" style="height:calc(20px + 2vw);"><br />
        </label>
        <input type="file" id="choose-file2" onchange="readURL(this);" style="display: none;" />
        <div class="d-none d-sm-block d-flex">
            <div class="row p-2">
                <div class="p-1 position-relative i1" style="width: calc(100%/11);">
                    <img src="../Assets/img2.png" alt="" style="object-fit: cover;width: 100%; height: 100%;" />
                    <img src="../Assets/cross.png" class="position-absolute cross" onclick="$('.i1').remove();">
                </div>
                <div class="p-1 position-relative i2" style="width: calc(100%/11);">
                    <img src="../Assets/Grow-Trees-On-the-path-to-environment-sustainability-4.png" alt=""
                        style="object-fit: cover;width: 100%; height: 100%;" />
                    <img src="../Assets/cross.png" class="position-absolute cross" onclick="$('.i2').remove();">
                </div>
                <div class="p-1 position-relative i3" style="width: calc(100%/11);">
                    <img src="../Assets/img22.png" alt="" style="object-fit: cover;width: 100%; height: 100%;" />
                    <img src="../Assets/cross.png" class="position-absolute cross" onclick="$('.i3').remove();">
                </div>
                <div class="p-1 position-relative i4" style="width: calc(100%/11);">
                    <img src="../Assets/wolgawron-169hero-service-istock.jpg" alt=""
                        style="object-fit: cover;width: 100%; height: 100%;" />
                    <img src="../Assets/cross.png" class="position-absolute cross" onclick="$('.i4').remove();">
                </div>
                <div class="p-1 position-relative i5" style="width: calc(100%/11);">
                    <img src="../Assets/img.png" alt="" style="object-fit: cover;width: 100%; height: 100%;" />
                    <img src="../Assets/cross.png" class="position-absolute cross" onclick="$('.i5').remove();">
                </div>
                <div class="p-1 position-relative i6" style="width: calc(100%/11);">
                    <img src="../Assets/CSR-initiative-stands-for-Coffee--and-Farmer-Equity-4.png" alt=""
                        style="object-fit: cover;width: 100%; height: 100%;" />
                    <img src="../Assets/cross.png" class="position-absolute cross" onclick="$('.i6').remove();">
                </div>
                <div class="p-1 position-relative i7" style="width: calc(100%/11);">
                    <img src="../Assets/img2.png" alt="" style="object-fit: cover;width: 100%; height: 100%;" />
                    <img src="../Assets/cross.png" class="position-absolute cross" onclick="$('.i7').remove();">
                </div>
                <div class="p-1 position-relative i8" style="width: calc(100%/11);">
                    <img src="../Assets/Grow-Trees-On-the-path-to-environment-sustainability-4.png" alt=""
                        style="object-fit: cover;width: 100%; height: 100%;" />
                    <img src="../Assets/cross.png" class="position-absolute cross" onclick="$('.i8').remove();">
                </div>
                <div class="p-1 position-relative i9" style="width: calc(100%/11);">
                    <img src="../Assets/img22.png" alt="" style="object-fit: cover;width: 100%; height: 100%;" />
                    <img src="../Assets/cross.png" class="position-absolute cross" onclick="$('.i9').remove();">
                </div>
                <div class="p-1 position-relative i10" style="width: calc(100%/11);">
                    <img src="../Assets/wolgawron-169hero-service-istock.jpg" alt=""
                        style="object-fit: cover;width: 100%; height: 100%;" />
                    <img src="../Assets/cross.png" class="position-absolute cross" onclick="$('.i10').remove();">
                </div>
                <div class="p-1 position-relative i11" style="width: calc(100%/11);">
                    <img src="../Assets/img.png" alt="" style="object-fit: cover;width: 100%; height: 100%;" />
                    <img src="../Assets/cross.png" class="position-absolute cross" onclick="$('.i11').remove();">
                </div>
                <div class="p-1 position-relative i12" style="width: calc(100%/11);">
                    <img src="../Assets/CSR-initiative-stands-for-Coffee--and-Farmer-Equity-4.png" alt=""
                        style="object-fit: cover;width: 100%; height: 100%;" />
                    <img src="../Assets/cross.png" class="position-absolute cross" onclick="$('.i12').remove();">
                </div>
                <div class="p-1 position-relative i13" style="width: calc(100%/11);">
                    <img src="" id="blah" alt="" style="object-fit: cover;width: 100%; height: 100%;" />
                    <img src="../Assets/cross.png" class="position-absolute cross" onclick="$('.i13').remove();">
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between mt-3 mb-5">
            <div>
                <button type="button" class="col-example8">Cancle</button>
            </div>
            <div>
                <button type="button" class="col-example7">Save</button>
                <button type="button" class="col-example7">Submit</button>
            </div>
        </div>
    </div>
    <?php include "footer.php"; ?>
</body>

</html>