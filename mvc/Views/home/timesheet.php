<div id="popup1" class="modal" style="--bs-modal-width:900px;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-2">
            <div class="modal-header pb-0" style="border-bottom:0 ;">
                <p class="mb-0" style="font-size:20px ;">Please input below Volunteering Hours</p>
            </div>
            <div class="modal-body pb-0">
                <p class="mb-1">Mission</p>
                <select class="popup pt-0 pb-0">
                    <option value="none" selected="" disabled="" hidden="">Select Mission</option>
                    <option value="newsest">Mission 1</option>
                    <option value="oldest">Mission 2</option>
                    <option value="lowest">Mission 3</option>
                    <option value="highest">Mission 4</option>
                    <option value="favourite">Mission 5</option>
                    <option value="deadline">Mission 6</option>
                </select>
                <p class="mb-1 mt-3">Date Volunteered</p>
                <input type="date" name="m_sdate" class="popup">
                <div class="row">
                    <div class="col">
                        <p class="mb-1 mt-3">Hours</p>
                        <input type="text" class="popup" name="m_title" placeholder="Enter Spent Hours">
                    </div>
                    <div class="col">
                        <p class="mb-1 mt-3">Minute</p>
                        <input type="text" class="popup" name="m_title" placeholder="Enter Spent Minutes">
                    </div>
                </div>
                <p class="mb-1 mt-3">Message</p>
                <textarea class="popup1" rows="4" placeholder="Enter your message" name="m_detail"></textarea>
            </div>
            <div class="modal-footer" style="border-top:0 ;">
                <button type="button" class="col-example8" data-bs-dismiss="modal">Cancle
                </button>
                <button type="button" class="col-example7" data-bs-dismiss="modal">Submit
                </button>
            </div>
        </div>
    </div>
</div>
<div id="popup2" class="modal" style="--bs-modal-width:900px;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-2">
            <div class="modal-header pb-0" style="border-bottom:0 ;">
                <p class="mb-0" style="font-size:20px ;">Please input below Volunteering Goal</p>
            </div>
            <div class="modal-body pb-0">
                <p class="mb-1">Mission</p>
                <select class="popup pt-0 pb-0">
                    <option value="none" selected="" disabled="" hidden="">Select Mission</option>
                    <option value="newsest">Mission 1</option>
                    <option value="oldest">Mission 2</option>
                    <option value="lowest">Mission 3</option>
                    <option value="highest">Mission 4</option>
                    <option value="favourite">Mission 5</option>
                    <option value="deadline">Mission 6</option>
                </select>
                <p class="mb-1 mt-3">Action</p>
                <input type="text" class="popup" name="m_title" placeholder="Enter Action">
                <p class="mb-1 mt-3">Date Volunteered</p>
                <input type="date" name="m_sdate" class="popup">
                <p class="mb-1 mt-3">Message</p>
                <textarea class="popup1" rows="4" placeholder="Enter your message" name="m_detail"></textarea>
            </div>
            <div class="modal-footer" style="border-top:0 ;">
                <button type="button" class="col-example8" data-bs-dismiss="modal">Cancle
                </button>
                <button type="button" class="col-example7" data-bs-dismiss="modal">Submit
                </button>
            </div>
        </div>
    </div>
</div>
<br /><br />
<div class="container-lg">
    <p class="fs-2 fw-light pt-5">Volunteering Timesheet</p>
    <div class="row">
        <div class="col m-2 pb-5 " style="border: 1px solid #dee2e6; border-radius: 5px;">
            <div class="d-flex justify-content-between mb-4 mt-4">
                <p class="ps-3 m-0" style="font-size:13px;">Volunteering Hours</p>
                <button data-bs-toggle="modal" data-bs-target="#popup1" type="button" class="col-example7 ps-2 pe-2 pt-1 pb-1" style="font-size:13px;">
                    <i class="fa fa-plus pe-1" aria-hidden="true"></i>
                    Add
                </button>

            </div>
            <table class="w-100">
                <thead>
                    <tr>
                        <td class="p-3 pe-0 pb-1" scope="col" style="font-size:12px; font-weight: bold;">Mission
                        </td>
                        <td class="p-3 pe-0 pb-1" scope="col" style="font-size:13px; font-weight: bold;">Date</td>
                        <td class="p-3 pe-0 pb-1" scope="col" style="font-size:13px; font-weight: bold;">Hours</td>
                        <td class="p-3 pe-0 pb-1" scope="col" style="font-size:13px; font-weight: bold;">Minutes
                        </td>
                        <td class="p-3 pe-0 pb-1" scope="col" style="font-size:13px; font-weight: bold;"></td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="p-3 pe-0 pb-0" style="font-size:11px;">Environment Conservation</td>
                        <td class="p-3 pe-0 pb-0" style="font-size:11px;">22/02/2022</td>
                        <td class="p-3 pe-0 pb-0" style="font-size:11px;">1h</td>
                        <td class="p-3 pe-0 pb-0" style="font-size:11px;">30min</td>
                        <td class="p-3 pe-0 pb-0" style="font-size:11px;">
                            <i class="fa fa-pencil-square-o" style="color: #f88634;" aria-hidden="true"></i>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#popup1"><i class="fa fa-trash-o text-dark" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col m-2 pb-5" style="border: 1px solid #dee2e6; border-radius: 5px;">
            <div class="d-flex justify-content-between mb-4 mt-4">
                <p class="ps-3 m-0" style="font-size:13px;">Volunteering Goals</p>
                <button data-bs-toggle="modal" data-bs-target="#popup2" type="button" class="col-example7 ps-2 pe-2 pt-1 pb-1" style="font-size:13px;">
                    <i class="fa fa-plus pe-1" aria-hidden="true"></i>
                    Add
                </button>
            </div>
            <table class="w-100">
                <thead>
                    <tr>
                        <td class="p-3 pe-0 pb-1" scope="col" style="font-size:12px; font-weight: bold;">Mission
                        </td>
                        <td class="p-3 pe-0 pb-1" scope="col" style="font-size:13px; font-weight: bold;">Date</td>
                        <td class="p-3 pe-0 pb-1" scope="col" style="font-size:13px; font-weight: bold;">Action</td>
                        <td class="p-3 pe-0 pb-1" scope="col" style="font-size:13px; font-weight: bold;"></td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="p-3 pe-0 pb-0" style="font-size:11px;">Plantation Programme</td>
                        <td class="p-3 pe-0 pb-0" style="font-size:11px;">22/02/2022</td>
                        <td class="p-3 pe-0 pb-0" style="font-size:11px;">0</td>
                        <td class="p-3 pe-0 pb-0" style="font-size:11px;">
                            <i class="fa fa-pencil-square-o" style="color: #f88634;" aria-hidden="true"></i>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#popup1"><i class="fa fa-trash-o text-dark" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                    <tr style="font-size: 20px;">
                        <td class="p-3 pe-0 pb-0" style="font-size:11px;">Education Programme</td>
                        <td class="p-3 pe-0 pb-0" style="font-size:11px;">22/02/2022</td>
                        <td class="p-3 pe-0 pb-0" style="font-size:11px;">1</td>
                        <td class="p-3 pe-0  pb-0" style="font-size:11px;">
                            <i class="fa fa-pencil-square-o" style="color: #f88634;" aria-hidden="true"></i>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#popup1"><i class="fa fa-trash-o text-dark" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>