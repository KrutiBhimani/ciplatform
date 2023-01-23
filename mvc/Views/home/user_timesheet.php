<div id="popup1" class="modal" style="--bs-modal-width:900px;">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content p-2">
<div class="modal-header pb-0" style="border-bottom:0 ;">
<p class="mb-0" style="font-size:20px ;">Please input below Volunteering Hours</p>
</div>
<form method="post" enctype="multipart/form-data">
<div class="modal-body pb-0">
<p class="mb-1">Mission</p>
<select class="popup pt-0 pb-0" name='mission_id'>
<option value="none" selected="" disabled="" hidden="">Select your mission</option>
<?php foreach ($missions as $mission) { ?>
<option value="<?php echo $mission->mission_id ?>"><?php echo $mission->mission_title ?></option>
<?php } ?>
</select>
<p class="mb-1 mt-3">Date Volunteered</p>
<input type="date" name="date_volunteered" class="popup" value="Select date">
<div class="row">
<div class="col">
<p class="mb-1 mt-3">Hours</p>
<input type="number" class="popup" name="h" placeholder="Enter Spent Hours">
</div>
<div class="col">
<p class="mb-1 mt-3">Minute</p>
<input type="number" class="popup" name="m" placeholder="Enter Spent Minutes">
</div>
</div>
<p class="mb-1 mt-3">Message</p>
<textarea class="popup1" rows="4" placeholder="Enter your message" name="notes"></textarea>
</div>
<div class="modal-footer" style="border-top:0 ;">
<button type="button" class="col-example8" data-bs-dismiss="modal">Cancle
</button>
<button type="submit" name="add_hours" class="col-example7" data-bs-dismiss="modal">Submit
</button>
</div>
</form>
</div>
</div>
</div>
<div id="popup2" class="modal" style="--bs-modal-width:900px;">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content p-2">
<div class="modal-header pb-0" style="border-bottom:0 ;">
<p class="mb-0" style="font-size:20px ;">Please input below Volunteering Goal</p>
</div>
<form method="post" enctype="multipart/form-data">
<div class="modal-body pb-0">
<p class="mb-1">Mission</p>
<select class="popup pt-0 pb-0" name='mission_id'>
<option value="none" selected="" disabled="" hidden="">Select your mission</option>
<?php foreach ($missions as $mission) { ?>
<option value="<?php echo $mission->mission_id ?>"><?php echo $mission->mission_title ?></option>
<?php } ?>
</select>
<p class="mb-1 mt-3">Action</p>
<input type="text" class="popup" name="action" placeholder="Enter Action">
<p class="mb-1 mt-3">Date Volunteered</p>
<input type="date" name="date_volunteered" class="popup">
<p class="mb-1 mt-3">Message</p>
<textarea class="popup1" rows="4" placeholder="Enter your message" name="notes"></textarea>
</div>
<div class="modal-footer" style="border-top:0 ;">
<button type="button" class="col-example8" data-bs-dismiss="modal">Cancle
</button>
<button type="submit" name="add_goals" class="col-example7" data-bs-dismiss="modal">Submit
</button>
</div>
</form>
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
<td class="pt-3 ps-3 pb-1" scope="col" style="font-size:12px; font-weight: bold;">Mission
</td>
<td class="pt-3 ps-3 pb-1" scope="col" style="font-size:13px; font-weight: bold;">Date</td>
<td class="pt-3 ps-3 pb-1" scope="col" style="font-size:13px; font-weight: bold;">Hours</td>
<td class="pt-3 ps-3 pb-1" scope="col" style="font-size:13px; font-weight: bold;">Minutes
</td>
<td class="pt-3 ps-3 pb-1" scope="col" style="font-size:13px; font-weight: bold;"></td>
</tr>
</thead>
<tbody>

<?php foreach ($hours as $hour) {
$date = $hour->date_volunteered;
$date = date("d/m/Y", strtotime($date));
$time = $hour->time;
date('H:i', strtotime($date));
?>
<tr>
<td class="pt-3 ps-3" style="font-size:11px;"><?php echo $hour->title ?></td>
<td class="pt-3 ps-3" style="font-size:11px;"><?php echo $date ?></td>
<td class="pt-3 ps-3" style="font-size:11px;"><?php echo date('H', strtotime($time)) . 'h'; ?></td>
<td class="pt-3 ps-3" style="font-size:11px;"><?php echo date('i', strtotime($time)) . 'min'; ?></td>
<td class="pt-3 ps-3" style="font-size:11px;">
<button class="p-0" data-bs-toggle="modal" data-bs-target="#popupedit<?php echo $hour->timesheet_id ?>" type="button" style='border:none;background-color:white;'>
<i class="fa fa-pencil-square-o" style="color: #f88634; font-size:15px" aria-hidden="true"></i>
</button>
<button class="p-0" data-bs-toggle="modal" data-bs-target="#popupdelete<?php echo $hour->timesheet_id ?>" type="button" style='border:none;background-color:white;'>
<i class="fa fa-trash-o text-dark" style="font-size:15px" aria-hidden="true"></i>
</button>
</td>
</tr>
<div id="popupdelete<?php echo $hour->timesheet_id ?>" class="modal" style="--bs-modal-width:900px;">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content p-2">
<div class="modal-header pb-0" style="border-bottom:0 ;">
<p class="mb-0" style="font-size:20px ;">Confirm Delete</p>
</div>
<form method="post" enctype="multipart/form-data">
<input type='text' value="<?php echo $hour->timesheet_id ?>" name="timesheet_id" hidden>
<div class="modal-body pb-0">
<p class="mb-1">Are you sure you want to delete this item?</p>
</div>
<div class="modal-footer" style="border-top:0 ;">
<button type="button" class="col-example8" data-bs-dismiss="modal">Cancle
</button>
<button type="submit" name="delete_hours" class="col-example7" data-bs-dismiss="modal">Delete
</button>
</div>
</form>
</div>
</div>
</div>
<div id="popupedit<?php echo $hour->timesheet_id ?>" class="modal" style="--bs-modal-width:900px;">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content p-2">
<div class="modal-header pb-0" style="border-bottom:0 ;">
<p class="mb-0" style="font-size:20px ;">Please input below Volunteering Hours</p>
</div>
<form method="post" enctype="multipart/form-data">
<input type='text' value="<?php echo $hour->timesheet_id ?>" name="timesheet_id" hidden>
<div class="modal-body pb-0">
<p class="mb-1">Mission</p>
<select class="popup pt-0 pb-0" name='mission_id'>
<option value="none" selected="" disabled="" hidden="">Select your mission</option>
<?php foreach ($missions as $mission) { ?>
<option value="<?php echo $mission->mission_id ?>" <?php if ($hour->mission_id == $mission->mission_id) {
echo 'selected';
} ?>><?php echo $mission->mission_title ?></option>
<?php } ?>
</select>
<p class="mb-1 mt-3">Date Volunteered</p>
<input type="date" name="date_volunteered" value="<?php echo $hour->date_volunteered ?>" class="popup" value="Select date">
<div class="row">
<div class="col">
<p class="mb-1 mt-3">Hours</p>
<input type="number" class="popup" name="h" value="<?php echo date('H', strtotime($time)); ?>" placeholder="Enter Spent Hours">
</div>
<div class="col">
<p class="mb-1 mt-3">Minute</p>
<input type="number" class="popup" name="m" value="<?php echo date('i', strtotime($time)); ?>" placeholder="Enter Spent Minutes">
</div>
</div>
<p class="mb-1 mt-3">Message</p>
<textarea class="popup1" rows="4" placeholder="Enter your message" name="notes"><?php echo $hour->notes ?></textarea>
</div>
<div class="modal-footer" style="border-top:0 ;">
<button type="button" class="col-example8" data-bs-dismiss="modal">Cancle
</button>
<button type="submit" name="edit_hours" class="col-example7" data-bs-dismiss="modal">Submit
</button>
</div>
</form>
</div>
</div>
</div>
<?php
} ?>
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
<td class="pt-3 ps-3 pb-1" scope="col" style="font-size:12px; font-weight: bold;">Mission
</td>
<td class="pt-3 ps-3 pb-1" scope="col" style="font-size:13px; font-weight: bold;">Date</td>
<td class="pt-3 ps-3 pb-1" scope="col" style="font-size:13px; font-weight: bold;">Action</td>
<td class="pt-3 ps-3 pb-1 pe-3" scope="col" style="font-size:13px; font-weight: bold;"></td>
</tr>
</thead>
<tbody>
<?php foreach ($goals as $goal) {
$date = $goal->date_volunteered;
$date = date("d/m/Y", strtotime($date));
date('H:i', strtotime($date));
?>
<tr>
<td class="pt-3 ps-3" style="font-size:11px;"><?php echo $goal->title ?></td>
<td class="pt-3 ps-3" style="font-size:11px;"><?php echo $date ?></td>
<td class="pt-3 ps-3" style="font-size:11px;"><?php echo $goal->action; ?></td>
<td class="pt-3 ps-3" style="font-size:11px;">
<button class="p-0" data-bs-toggle="modal" data-bs-target="#popupedit<?php echo $goal->timesheet_id ?>" type="button" style='border:none;background-color:white;'>
<i class="fa fa-pencil-square-o" style="color: #f88634; font-size:15px" aria-hidden="true"></i>
</button>
<button class="p-0" data-bs-toggle="modal" data-bs-target="#popupdelete<?php echo $goal->timesheet_id ?>" type="button" style='border:none;background-color:white;'>
<i class="fa fa-trash-o text-dark" style="font-size:15px" aria-hidden="true"></i>
</button>
</td>
</tr>
<div id="popupdelete<?php echo $goal->timesheet_id ?>" class="modal" style="--bs-modal-width:900px;">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content p-2">
<div class="modal-header pb-0" style="border-bottom:0 ;">
<p class="mb-0" style="font-size:20px ;">Confirm Delete</p>
</div>
<form method="post" enctype="multipart/form-data">
<input type='text' value="<?php echo $goal->timesheet_id ?>" name="timesheet_id" hidden>
<div class="modal-body pb-0">
<p class="mb-1">Are you sure you want to delete this item?</p>
</div>
<div class="modal-footer" style="border-top:0 ;">
<button type="button" class="col-example8" data-bs-dismiss="modal">Cancle
</button>
<button type="submit" name="delete_hours" class="col-example7" data-bs-dismiss="modal">Delete
</button>
</div>
</form>
</div>
</div>
</div>
<div id="popupedit<?php echo $goal->timesheet_id ?>" class="modal" style="--bs-modal-width:900px;">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content p-2">
<div class="modal-header pb-0" style="border-bottom:0 ;">
<p class="mb-0" style="font-size:20px ;">Please input below Volunteering Goal</p>
</div>
<form method="post" enctype="multipart/form-data">
<input type='text' value="<?php echo $goal->timesheet_id ?>" name="timesheet_id" hidden>
<div class="modal-body pb-0">
<p class="mb-1">Mission</p>
<select class="popup pt-0 pb-0" name='mission_id'>
<option value="none" selected="" disabled="" hidden="">Select your mission</option>
<?php foreach ($missions as $mission) { ?>
<option value="<?php echo $mission->mission_id ?>" <?php if ($goal->mission_id == $mission->mission_id) {
echo 'selected';
} ?>><?php echo $mission->mission_title ?></option>
<?php } ?>
</select>
<p class="mb-1 mt-3">Action</p>
<input type="text" class="popup" name="action" value="<?php echo $goal->action ?>" placeholder="Enter Action">
<p class="mb-1 mt-3">Date Volunteered</p>
<input type="date" name="date_volunteered" value="<?php echo $goal->date_volunteered ?>" class="popup">
<p class="mb-1 mt-3">Message</p>
<textarea class="popup1" rows="4" placeholder="Enter your message" name="notes"><?php echo $goal->notes ?></textarea>
</div>
<div class="modal-footer" style="border-top:0 ;">
<button type="button" class="col-example8" data-bs-dismiss="modal">Cancle
</button>
<button type="submit" name="edit_goals" class="col-example7" data-bs-dismiss="modal">Submit
</button>
</div>
</form>
</div>
</div>
</div>
<?php } ?>
</tbody>
</table>
</div>
</div>
</div>