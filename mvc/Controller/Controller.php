<?php

date_default_timezone_set('Asia/Kolkata');
require_once('Model/Model.php');
session_start();

class Controller extends Model
{

	function __construct()
	{
		parent::__construct();

		if (isset($_SERVER['PATH_INFO'])) {
			switch ($_SERVER['PATH_INFO']) {
				case '/register':
					if (isset($_POST['register'])) {
						$password = $_POST['password'];
						$password2 = $_POST['password2'];
						if ($password == $password2) {
							$insert_data = [
								'first_name' => $_POST['first_name'],
								'last_name' => $_POST['last_name'],
								'email' => $_POST['email'],
								'password' => $_POST['password'],
								'phone_number' => $_POST['phone_number'],
								'city_id' => 1,
								'country_id' => 1
							];
							$insertEx = $this->InsertData('user', $insert_data);
							if ($insertEx['Code']) {
?>
								<script type="text/javascript">
									alert("<?php echo 'your registration is successfull!' ?>");
									window.location.href = 'login';
								</script>
							<?php
							} else {
							?>
								<script type="text/javascript">
									alert("<?php echo 'please try again!' ?>");
									window.location.href = 'register';
								</script>
					<?php
							}
						}
					}
					$selectData = $this->SelectBanner();
					$banners = $selectData['Data'];
					include 'Views/header.php';
					include 'Views/registration.php';
					break;
				case '/login':
					//if (isset($_SESSION['user_data'])) {

					?>
					<!-- <script type="text/javascript">
							window.location.href = 'home';
						</script> -->
					<?php
					//} else if (isset($_SESSION['admin_data'])) {
					?>
					<!-- <script type="text/javascript">
							window.location.href = 'admin';
						</script> -->
					<?php
					//}
					if (isset($_POST['login'])) {
						$email = mysqli_real_escape_string($this->connection, $_POST['email']);
						$password = mysqli_real_escape_string($this->connection, $_POST['password']);

						$loginEx = $this->LoginData($email, $password);
						if ($loginEx['Code']) {
							$_SESSION['user_data'] = $loginEx['Data1'];
							$_SESSION['admin_data'] = $loginEx['Data2'];
							if ($_SESSION['user_data']) {
					?>
								<script type="text/javascript">
									window.location.href = 'home';
								</script>
							<?php
							} else if ($_SESSION['admin_data']) {
							?>
								<script type="text/javascript">
									window.location.href = 'user';
								</script>
							<?php
							}
						} else {
							?>
							<script type="text/javascript">
								alert("<?php echo $loginEx['Message'] ?>");
								window.location.href = 'login';
							</script>
						<?php
						}
					}
					$selectData = $this->SelectBanner();
					$banners = $selectData['Data'];
					include 'Views/header.php';
					include 'Views/login.php';
					break;

				case '/home':
					if (!isset($_SESSION['user_data'])) {
						?>
						<script type="text/javascript">
							window.location.href = 'login';
						</script>
					<?php
					}
					include 'Views/header.php';
					include 'Views/navbar1.php';
					include 'Views/navbar2.php';
					include 'Views/home.php';
					break;

				case '/logout':
					if (isset($_SESSION['admin_data'])) {
						unset($_SESSION['admin_data']);
						session_destroy();
					} else if (isset($_SESSION['user_data'])) {
						unset($_SESSION['user_data']);
						session_destroy();
					}
					?>
					<script type="text/javascript">
						alert("logged out successfully.");
						window.location.href = 'login';
					</script>
					<?php
					break;
				case '/forgot':
					if (isset($_POST['forgot'])) {
						$email = mysqli_real_escape_string($this->connection, $_POST['email']);
						$resetEx = $this->ResetPass($email);
						if ($resetEx['Code']) {
							$_SESSION['reset_data'] = $resetEx['Data'];
							$token = md5(2418 * 2) . substr(md5(uniqid(rand(), 1)), 3, 10);
							if ($_SESSION['reset_data']) {
								$link = "<a href='http://localhost/ci-platform/mvc/reset?key=" . $_SESSION['reset_data']->email . "&t=" . $token . "'>Click To Reset password</a>";
								require 'Views/PHPMailerAutoload.php';
								require_once('../PHPMailer/src/PHPMailer.php');
								require_once('../PHPMailer/src/Exception.php');
								require_once('../PHPMailer/src/OAuthTokenProvider.php');
								require_once('../PHPMailer/src/OAuth.php');
								require_once('../PHPMailer/src/POP3.php');
								require_once('../PHPMailer/src/SMTP.php');
								if (empty($errors)) {
									$insert_data = [
										'email' => $_SESSION['reset_data']->email,
										'created_at' => date("Y/m/d H:i:s"),
										'token' => $token
									];
									$insertEx = $this->InsertData('password_reset', $insert_data);
									$mail = new PHPMailer\PHPMailer\PHPMailer(true); //defaults to using php "mail()"; the true param means it will throw exceptions on errors, which we need to catch
									try {
										//$mail->SMTPDebug = 1;                               // Enable verbose debug output
										$mail->isSMTP();                                    // Set mailer to use SMTP
										$mail->Host = 'smtp.office365.com'; // Specify main and backup SMTP servers
										$mail->SMTPAuth = true;                             // Enable SMTP authentication
										$mail->Username = 'krutipatel5773@outlook.com';           // SMTP username
										$mail->Password = 'kruti9607';                       // SMTP password
										$mail->SMTPSecure = 'tls';                          // Enable TLS encryption, `ssl` also accepted
										$mail->Port = 587;                                  // TCP port to connect, tls=587, ssl=465
										$mail->From = 'krutipatel5773@outlook.com';
										$mail->FromName = 'kruti bhimani';
										$mail->addAddress($email);     // Add a recipient
										$mail->addReplyTo($email);
										$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
										$mail->isHTML(false);                                  // Set email format to HTML
										$mail->Subject = 'Reset Password';
										$mail->Body    = 'Click On This Link to Reset Password ' . $link . '';
										$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
										if (!$mail->send()) {
											echo 'Message could not be sent.';
											echo 'Mailer Error: ' . $mail->ErrorInfo;
										} else { ?>
											<script type="text/javascript">
												alert("message sent to your email.");
												window.location.href = 'forgot';
											</script>
								<?php }
										$errors[] = "Send mail sucsessfully";
									}
									// catch (phpmailerException $e) 
									// {
									//   $errors[] = $e->errorMessage(); //Pretty error messages from PHPMailer
									// } 
									catch (Exception $e) {
										$errors[] = $e->getMessage(); //Boring error messages from anything else!
									}
								}
							} else { ?>
								<script type="text/javascript">
									alert("user not found");
									window.location.href = 'forgot';
								</script>
								<?php }
						}
					}
					$selectData = $this->SelectBanner();
					$banners = $selectData['Data'];
					include 'Views/header.php';
					include 'Views/forgotpsd.php';
					break;
				case '/reset':
					if ($_GET['key'] && $_GET['t']) {
						$email = $_GET['key'];
						$token = $_GET['t'];
						$hourEx = $this->CheckHour($token);
						if ($hourEx['Code']) {
							$created_at = $hourEx['Data']->created_at;
							$start_date = new DateTime($created_at);
							$end_date = new DateTime(date("Y-m-d H:i:s"));
							$interval = $start_date->diff($end_date);
							$min = $interval->format('%i');
							$hour = $interval->format('%h');
							$mon = $interval->format('%m');
							$day = $interval->format('%d');
							$year = $interval->format('%y');
							$diff = $year + $mon + $day * 24 * 60 + $hour * 60 + $min;
							if ($diff <= 240) {
								if (isset($_SESSION['reset_data'])) {
									$email = $_SESSION['reset_data']->email;
									if (isset($_POST['reset'])) {
										$password = mysqli_real_escape_string($this->connection, $_POST['password']);
										$password2 = mysqli_real_escape_string($this->connection, $_POST['password2']);
										if ($password == $password2) {
											$changeEx = $this->UpdatePass($email, $password);
											if ($changeEx['Code']) {
								?>
												<script type="text/javascript">
													alert("<?php echo $changeEx['Message'] ?>");
													window.location.href = 'login';
												</script>
											<?php
											} else {
											?>
												<script type="text/javascript">
													alert("<?php echo $changeEx['Message'] ?>");
													window.location.href = 'register';
												</script>
								<?php
											}
										}
									}
									$selectData = $this->SelectBanner();
									$banners = $selectData['Data'];
									include 'Views/header.php';
									include 'Views/resetpsd.php';
									break;
								}
							} else { ?>
								<script type="text/javascript">
									alert("link expired");
									window.location.href = 'forgot';
								</script>
						<?php }
						}
					} else { ?>
						<script type="text/javascript">
							window.location.href = 'forgot';
						</script>
					<?php }

				case '/user';
					if (!isset($_SESSION['admin_data'])) {
					?>
						<script type="text/javascript">
							window.location.href = 'login';
						</script>
						<?php
					}
					$case = 1;
					include 'Views/header.php';
					$firstname = $_SESSION['admin_data']->first_name;
					$lastname = $_SESSION['admin_data']->last_name;
					$avtar = $_SESSION['admin_data']->avatar;
					include 'Views/adminsidebar.php';
					if (isset($_GET['source']))
						$source = $_GET['source'];
					else
						$source = '';
					switch ($source) {
						case 'add_user':
							$selectData = $this->SelectData('country');
							$countries = $selectData['Data'];
							$resultString = 0;
						?>
							<script type="text/javascript">
								$(document).ready(function() {
									$('#selectCountries').change(function() {
										var selectedOptions = $('#selectCountries option:selected');
										if (selectedOptions.length > 0) {
											$resultString = $(this).val();
											document.getElementById("divResult").value = $resultString;
										}
									});
								})
							</script>
							<?php
							$selectData = $this->SelectData('city');
							$cities = $selectData['Data'];

							if (isset($_POST['add_user'])) {
								$avatar = $_FILES['avatar']['name'];
								$avatar_temp = $_FILES['avatar']['tmp_name'];
								$insert_data = [
									'first_name' => $_POST['first_name'],
									'last_name' => $_POST['last_name'],
									'email' => $_POST['email'],
									'password' => $_POST['password'],
									'phone_number' => $_POST['phone_number'],
									'city_id' => $_POST['city_id'],
									'country_id' => $_POST['country_id'],
									'employee_id' => $_POST['employee_id'],
									'department' => $_POST['department'],
									'profile_text' => $_POST['profile_text'],
									'status' => $_POST['status'],
									'avatar' => $avatar
								];
								$insertEx = $this->InsertData('user', $insert_data);
								if ($insertEx['Code']) {
									if (!is_null($avatar)) {
										move_uploaded_file($avatar_temp, '../Assets/' . $avatar);
									}
							?>
									<script type="text/javascript">
										alert("<?php echo $insertEx['Message'] ?>");
										window.location.href = 'user';
									</script>
								<?php
								} else {
								?>
									<script type="text/javascript">
										alert("<?php echo $insertEx['Message'] ?>");
										window.location.href = 'user?source=add_user';
									</script>
								<?php
								}
							}
							include "Views/Admin/add_user.php";
							break;
						case 'edit_user':
							$encrypted_id = $_GET['edit'];
							$salt = "SECRET_STUFF";
							$decrypted_id_raw = base64_decode($encrypted_id);
							$decrypted_id = preg_replace(sprintf('/%s/', $salt), '', $decrypted_id_raw);
							$user_id = $decrypted_id;
							$selectData9 = $this->SelectById($user_id);
							$user = $selectData9['Data'];
							if (isset($_POST['edit_user'])) {
								$avatar = $_FILES['avatar']['name'];
								$avatar_temp = $_FILES['avatar']['tmp_name'];
								if (empty($avatar)) {
									$selectData12 = $this->SelectId($user_id);
									$avatar = $selectData12['Data']->avatar;
								}
								$update_data = [
									'user_id' => $user_id,
									'first_name' => $_POST['first_name'],
									'last_name' => $_POST['last_name'],
									'email' => $_POST['email'],
									'password' => $_POST['password'],
									'phone_number' => $_POST['phone_number'],
									'city_id' => $_POST['city_id'],
									'country_id' => $_POST['country_id'],
									'employee_id' => $_POST['employee_id'],
									'department' => $_POST['department'],
									'profile_text' => $_POST['profile_text'],
									'status' => $_POST['status'],
									'avatar' => $avatar,
									'updated_at' => date("Y-m-d h:i:s")
								];
								$upd_data = $this->UpdateData('user', $update_data, $user_id);
								if ($upd_data) {
									if (!is_null($avatar)) {
										move_uploaded_file($avatar_temp, '../Assets/' . $avatar);
									}
								?>
									<script type="text/javascript">
										alert("Data update successfully.");
										window.location.href = 'user';
									</script>
								<?php
								} else {
								?>
									<script type="text/javascript">
										alert("Something Went Wrong.");
										window.location.href = 'user?source=edit_user&edit=<?php
																							$id = $user->user_id;
																							$salt = "SECRET_STUFF";
																							$encrypted_id = base64_encode($id . $salt);
																							echo $encrypted_id; ?>';
									</script>
								<?php
								}
							}
							include "Views/Admin/edit_user.php";
							break;
						case 'delete_user':
							$encrypted_id = $_GET['delete'];
							$salt = "SECRET_STUFF";
							$decrypted_id_raw = base64_decode($encrypted_id);
							$decrypted_id = preg_replace(sprintf('/%s/', $salt), '', $decrypted_id_raw);
							$user_id = $decrypted_id;
							$update_data = [
								'deleted_at' => date("Y-m-d h:i:s")
							];
							$where = [
								'user_id' => $user_id
							];
							$delete_data = $this->UpdateData1('user', $update_data, $where);

							if ($delete_data) {
								?>
								<script type="text/javascript">
									alert("Data deleted successfully.");
									window.location.href = 'user';
								</script>
							<?php
							} else {
							?>
								<script type="text/javascript">
									alert("Something Went Wrong.");
									window.location.href = 'user';
								</script>
								<?php
							}
							break;
						default:
							$pagecount = 5;
							if (isset($_GET['page'])) {
								$page = $_GET['page'];
							} else
								$page = 1;
							if ($page == "" || $page == 1) {
								$postno = 0;
							} else
								$postno = ($page * $pagecount) - $pagecount;
							$selectData1 = $this->Select('user');
							$cnt = $selectData1['Data'];
							$cnt = ceil($cnt / $pagecount);
							$selectData1 = $this->SelectData('user', $postno, $pagecount);
							$users = $selectData1['Data'];
							if (isset($_POST['search'])) {
								$where = [
									'first_name' => $_POST['search'],
									'last_name' => $_POST['search'],
									'email' => $_POST['search'],
									'employee_id' => $_POST['search'],
									'department' => $_POST['search']
								];
								$selectData1 = $this->SelectData('user', 0, 0, $where);
								$users = $selectData1['Data'];
							}
							include "Views/Admin/view_all_user.php";
					}
					break;
				case '/page';
					$case = 2;
					include 'Views/header.php';
					$firstname = $_SESSION['admin_data']->first_name;
					$lastname = $_SESSION['admin_data']->last_name;
					$avtar = $_SESSION['admin_data']->avatar;
					include 'Views/adminsidebar.php';
					if (isset($_GET['source']))
						$source = $_GET['source'];
					else
						$source = '';
					switch ($source) {
						case 'add_page':
							if (isset($_POST['add_page'])) {
								$insert_data = [
									'title' => $_POST['title'],
									'description' => $_POST['description'],
									'slug' => $_POST['slug'],
									'status' => $_POST['status']
								];
								$insertEx = $this->InsertData('cms_page', $insert_data);
								echo $insertEx;
								if ($insertEx['Code']) {
								?>
									<script type="text/javascript">
										alert("<?php echo $insertEx['Message'] ?>");
										window.location.href = 'page';
									</script>
								<?php
								} else {
								?>
									<script type="text/javascript">
										alert("<?php echo $insertEx['Message'] ?>");
										window.location.href = 'page?source=add_page';
									</script>
								<?php
								}
							}
							include "Views/Admin/add_page.php";
							break;
						case 'edit_page':
							$encrypted_id = $_GET['edit'];
							$salt = "SECRET_STUFF";
							$decrypted_id_raw = base64_decode($encrypted_id);
							$decrypted_id = preg_replace(sprintf('/%s/', $salt), '', $decrypted_id_raw);
							$cms_page_id = $decrypted_id;
							$where = [
								'cms_page_id' => $cms_page_id
							];
							$selectData = $this->SelectData1('cms_page', $where);
							$pagei = $selectData['Data'];
							if (isset($_POST['edit_page'])) {
								$update_data = [
									'title' => $_POST['title'],
									'description' => $_POST['description'],
									'slug' => $_POST['slug'],
									'status' => $_POST['status'],
									'updated_at' => date("Y-m-d h:i:s")
								];
								$where = [
									'cms_page_id' => $cms_page_id
								];
								$upd_data = $this->UpdateData1('cms_page', $update_data, $where);
								if ($upd_data) {
								?>
									<script type="text/javascript">
										alert("Data update successfully.");
										window.location.href = 'page';
									</script>
								<?php
								} else {
								?>
									<script type="text/javascript">
										alert("Something Went Wrong.");
										window.location.href = 'page?source=edit_page&edit=<?php $id = $pag->cms_page_id;
																							$salt = "SECRET_STUFF";
																							$encrypted_id = base64_encode($id . $salt);
																							echo $encrypted_id; ?> ';
									</script>
								<?php
								}
							}
							include "Views/Admin/edit_page.php";
							break;
						case 'delete_page':
							$encrypted_id = $_GET['delete'];
							$salt = "SECRET_STUFF";
							$decrypted_id_raw = base64_decode($encrypted_id);
							$decrypted_id = preg_replace(sprintf('/%s/', $salt), '', $decrypted_id_raw);
							$cms_page_id = $decrypted_id;
							$update_data = [
								'deleted_at' => date("Y-m-d h:i:s")
							];
							$where = [
								'cms_page_id' => $cms_page_id
							];
							$delete_data = $this->UpdateData1('cms_page', $update_data, $where);
							if ($delete_data) {
								?>
								<script type="text/javascript">
									alert("Data deleted successfully.");
									window.location.href = 'page';
								</script>
							<?php
							} else {
							?>
								<script type="text/javascript">
									alert("Something Went Wrong.");
									window.location.href = 'page';
								</script>
							<?php
							}
						default:
							$pagecount = 5;
							if (isset($_GET['page'])) {
								$page = $_GET['page'];
							} else
								$page = 1;
							if ($page == "" || $page == 1) {
								$postno = 0;
							} else
								$postno = ($page * $pagecount) - $pagecount;
							$selectData = $this->Select('cms_page');
							$cnt = $selectData['Data'];
							$cnt = ceil($cnt / $pagecount);
							$selectData = $this->SelectData('cms_page', $postno, $pagecount);
							$pages = $selectData['Data'];

							if (isset($_POST['search'])) {
								$where = [
									'title' => $_POST['search']
								];
								$selectData1 = $this->SelectData('cms_page', 0, 0, $where);
								$pages = $selectData1['Data'];
							}
							include "Views/Admin/view_all_page.php";
					}
					break;
				case '/mission';
					$case = 3;
					include 'Views/header.php';
					$firstname = $_SESSION['admin_data']->first_name;
					$lastname = $_SESSION['admin_data']->last_name;
					$avtar = $_SESSION['admin_data']->avatar;
					include 'Views/adminsidebar.php';
					if (isset($_GET['source']))
						$source = $_GET['source'];
					else
						$source = '';
					switch ($source) {
						case 'add_mission':
							?>
							<script type="text/javascript">
								$(document).ready(function() {
									$('#selecttype').change(function() {
										var selectedOptions = $('#selecttype option:selected');
										if (selectedOptions.length > 0) {
											var resultString = '';
											selectedOptions.each(function() {
												var val = $(this).val();
												if (val == "TIME")
													resultString += "<p class='mb-1 mt-4' style='font-size:14px;'>Total Seats</p><input type='number' class='popup' name='total_seat'><p class='mb-1 mt-4' style='font-size:14px;' >Registration Deadline</p><input type='date' class='popup' name='deadline'>";
											});
											$('#divResult').html(resultString);
										}
									});
								});
							</script>
							<?php
							$selectData = $this->SelectData('city');
							$cities = $selectData['Data'];
							$selectData = $this->SelectData('country');
							$countries = $selectData['Data'];
							$selectData = $this->SelectData('mission_theme');
							$themes = $selectData['Data'];
							$selectData = $this->SelectData('skill');
							$skills = $selectData['Data'];
							if (isset($_POST['add_mission'])) {
								$skil = $_POST['mission_skill_id'];
								$insert_data = [
									'title' => $_POST['title'],
									'short_description' => $_POST['short_description'],
									'description' => $_POST['description'],
									'city_id' => $_POST['city_id'],
									'Country_id' => $_POST['country_id'],
									'organization_name' => $_POST['organization_name'],
									'organization_detail' => $_POST['organization_detail'],
									'start_date' => $_POST['start_date'],
									'end_date' => $_POST['end_date'],
									'mission_type' => $_POST['mission_type'],
									'theme_id' => $_POST['theme_id'],
									'availability' => $_POST['availability']
								];
								$insertEx = $this->InsertData('mission', $insert_data);
								if ($insertEx['Code']) {
									$selectData = $this->GetMission();
									$mission_id = $selectData['Data']->max;
									foreach ($skil as $item) {
										$expEx = $this->exp($mission_id, $item);
									}
									if ($_POST['mission_type'] == 'TIME') {
										$insert_data = [
											'mission_id' => $mission_id,
											'total_seat' => $_POST['total_seat'],
											'deadline' => $_POST['deadline']
										];
										$this->InsertData('time_mission', $insert_data);
									}
									$media_name = $_FILES['media_name']['name'];
									$media_name_temp = $_FILES['media_name']['tmp_name'];
									if (!is_null($media_name) && $media_name != '') {
										move_uploaded_file($media_name_temp, '../Assets/' . $media_name);
										$media_type = substr(strstr($media_name, '.'), 1);
										$media_path = 'Assets/' . $media_name;
										$insert_data = [
											'mission_id' => $mission_id,
											'media_name' => $media_name,
											'media_type' => $media_type,
											'media_path' => $media_path
										];
										$this->InsertData('mission_media', $insert_data);
									}
									$document_name = $_FILES['document_name']['name'];
									$document_name_temp = $_FILES['document_name']['tmp_name'];
									if (!is_null($document_name) && $media_name != '') {
										move_uploaded_file($document_name_temp, '../Assets/' . $document_name);
										$document_type = substr(strstr($document_name, '.'), 1);
										$document_path = 'Assets/' . $document_name;
										$insert_data = [
											'mission_id' => $mission_id,
											'document_name' => $document_name,
											'document_type' => $document_type,
											'document_path' => $document_path
										];
										$this->InsertData('mission_document', $insert_data);
									}
							?>
									<script type="text/javascript">
										alert("<?php echo $insertEx['Message'] ?>");
										window.location.href = 'mission';
									</script>
								<?php
								} else {
								?>
									<script type="text/javascript">
										alert("<?php echo $insertEx['Message'] ?>");
										window.location.href = 'mission?source=add_mission';
									</script>
							<?php
								}
							}
							include "Views/Admin/add_mission.php";
							break;
						case 'edit_mission':
							?>
							<script type="text/javascript">
								$(document).ready(function() {
									$('#selecttype').change(function() {
										var selectedOptions = $('#selecttype option:selected');
										if (selectedOptions.length > 0) {
											var resultString = '';
											selectedOptions.each(function() {
												var val = $(this).val();
												if (val == "TIME")
													resultString += "<p class='mb-1 mt-4' style='font-size:14px;'>Total Seats</p><input type='number' class='popup' name='total_seat' value='<?php echo $mission->total_seat; ?>'><p class='mb-1 mt-4' style='font-size:14px;' >Registration Deadline</p><input type='date' class='popup' name='deadline' value='<?php echo $mission->deadline; ?>'>";
												else if (val == "GOAL")
													$("#divresult1").remove();
											});
											$('#divResult').html(resultString);
										}
									});
								});
							</script>
							<?php
							$encrypted_id = $_GET['edit'];
							$salt = "SECRET_STUFF";
							$decrypted_id_raw = base64_decode($encrypted_id);
							$decrypted_id = preg_replace(sprintf('/%s/', $salt), '', $decrypted_id_raw);
							$mission_id = $decrypted_id;
							$selectData = $this->SelectData2($mission_id);
							$mission = $selectData['Data'];
							$selectData = $this->SelectData('city');
							$cities = $selectData['Data'];
							$selectData = $this->SelectData('country');
							$countries = $selectData['Data'];
							$selectData = $this->SelectData('mission_theme');
							$themes = $selectData['Data'];
							$selectData = $this->SelectData('skill');
							$skills = $selectData['Data'];
							$selectData = $this->GetSelectedSkill($mission_id);
							$selectedSkills = $selectData['Data'];
							if (isset($_POST['edit_theme'])) {
								$update_data = [
									'title' => $_POST['title'],
									'status' => $_POST['status'],
									'updated_at' => date("Y-m-d h:i:s")
								];
								$where = [
									'mission_theme_id' => $mission_theme_id
								];
								$upd_data = $this->UpdateData1('mission_theme', $update_data, $where);
								if ($upd_data) {
							?>
									<script type="text/javascript">
										alert("Data update successfully.");
										window.location.href = 'theme';
									</script>
								<?php
								} else {
								?>
									<script type="text/javascript">
										alert("Something Went Wrong.");
										window.location.href = 'theme?source=edit_theme&edit=<?php $id = $theme->mission_theme_id;
																								$salt = "SECRET_STUFF";
																								$encrypted_id = base64_encode($id . $salt);
																								echo $encrypted_id; ?>';
									</script>
								<?php
								}
							}
							include "Views/Admin/edit_mission.php";
							break;
						case 'delete_mission':
							$encrypted_id = $_GET['delete'];
							$salt = "SECRET_STUFF";
							$decrypted_id_raw = base64_decode($encrypted_id);
							$decrypted_id = preg_replace(sprintf('/%s/', $salt), '', $decrypted_id_raw);
							$mission_id = $decrypted_id;
							$where = [
								'mission_id' => $mission_id
							];
							$delete_data = $this->DeleteData1('mission', $where);
							if ($delete_data) {
								?>
								<script type="text/javascript">
									alert("Data deleted successfully.");
									window.location.href = 'mission';
								</script>
							<?php
							} else {
							?>
								<script type="text/javascript">
									alert("Something Went Wrong.");
									window.location.href = 'mission';
								</script>
								<?php
							}
						default:
							$pagecount = 5;
							if (isset($_GET['page'])) {
								$page = $_GET['page'];
							} else
								$page = 1;
							if ($page == "" || $page == 1) {
								$postno = 0;
							} else
								$postno = ($page * $pagecount) - $pagecount;
							$selectData1 = $this->Select('mission');
							$cnt = $selectData1['Data'];
							$cnt = ceil($cnt / $pagecount);
							$selectData1 = $this->SelectData('mission', $postno, $pagecount);
							$missions = $selectData1['Data'];
							if (isset($_POST['search'])) {
								$where = [
									'title' => $_POST['search'],
									'start_date' => $_POST['search'],
									'end_date' => $_POST['search'],
									'mission_type' => $_POST['search']
								];
								$selectData1 = $this->SelectData('mission', 0, 0, $where);
								$missions = $selectData1['Data'];
							}
							include "Views/Admin/view_all_mission.php";
					}
					break;
				case '/theme';
					$case = 4;
					include 'Views/header.php';
					$firstname = $_SESSION['admin_data']->first_name;
					$lastname = $_SESSION['admin_data']->last_name;
					$avtar = $_SESSION['admin_data']->avatar;
					include 'Views/adminsidebar.php';
					if (isset($_GET['source']))
						$source = $_GET['source'];
					else
						$source = '';
					switch ($source) {
						case 'add_theme':
							if (isset($_POST['add_theme'])) {
								$insert_data = [
									'title' => $_POST['title'],
									'status' => $_POST['status']
								];
								$insertEx = $this->InsertData('mission_theme', $insert_data);
								echo $insertEx;
								if ($insertEx['Code']) {
								?>
									<script type="text/javascript">
										alert("<?php echo $insertEx['Message'] ?>");
										window.location.href = 'theme';
									</script>
								<?php
								} else {
								?>
									<script type="text/javascript">
										alert("<?php echo $insertEx['Message'] ?>");
										window.location.href = 'theme?source=add_theme';
									</script>
								<?php
								}
							}
							include "Views/Admin/add_theme.php";
							break;
						case 'edit_theme':
							$encrypted_id = $_GET['edit'];
							$salt = "SECRET_STUFF";
							$decrypted_id_raw = base64_decode($encrypted_id);
							$decrypted_id = preg_replace(sprintf('/%s/', $salt), '', $decrypted_id_raw);
							$mission_theme_id = $decrypted_id;
							$where = [
								'mission_theme_id' => $mission_theme_id
							];
							$selectData = $this->SelectData1('mission_theme', $where);
							$theme = $selectData['Data'];
							if (isset($_POST['edit_theme'])) {
								$update_data = [
									'title' => $_POST['title'],
									'status' => $_POST['status'],
									'updated_at' => date("Y-m-d h:i:s")
								];
								$where = [
									'mission_theme_id' => $mission_theme_id
								];
								$upd_data = $this->UpdateData1('mission_theme', $update_data, $where);
								if ($upd_data) {
								?>
									<script type="text/javascript">
										alert("Data update successfully.");
										window.location.href = 'theme';
									</script>
								<?php
								} else {
								?>
									<script type="text/javascript">
										alert("Something Went Wrong.");
										window.location.href = 'theme?source=edit_theme&edit=<?php $id = $theme->mission_theme_id;
																								$salt = "SECRET_STUFF";
																								$encrypted_id = base64_encode($id . $salt);
																								echo $encrypted_id; ?>';
									</script>
								<?php
								}
							}
							include "Views/Admin/edit_theme.php";
							break;
						case 'delete_theme':
							$encrypted_id = $_GET['delete'];
							$salt = "SECRET_STUFF";
							$decrypted_id_raw = base64_decode($encrypted_id);
							$decrypted_id = preg_replace(sprintf('/%s/', $salt), '', $decrypted_id_raw);
							$mission_theme_id = $decrypted_id;
							$update_data = [
								'deleted_at' => date("Y-m-d h:i:s")
							];
							$where = [
								'mission_theme_id' => $mission_theme_id
							];
							$delete_data = $this->UpdateData1('mission_theme', $update_data, $where);
							if ($delete_data) {
								?>
								<script type="text/javascript">
									alert("Data deleted successfully.");
									window.location.href = 'theme';
								</script>
							<?php
							} else {
							?>
								<script type="text/javascript">
									alert("Something Went Wrong.");
									window.location.href = 'theme';
								</script>
								<?php
							}
						default:
							$pagecount = 5;
							if (isset($_GET['page'])) {
								$page = $_GET['page'];
							} else
								$page = 1;
							if ($page == "" || $page == 1) {
								$postno = 0;
							} else
								$postno = ($page * $pagecount) - $pagecount;
							$selectData = $this->Select('mission_theme');
							$cnt = $selectData['Data'];
							$cnt = ceil($cnt / $pagecount);
							$selectData = $this->SelectData('mission_theme', $postno, $pagecount);
							$themes = $selectData['Data'];
							if (isset($_POST['search'])) {
								$where = [
									'title' => $_POST['search']
								];
								$selectData = $this->SelectData('mission_theme', 0, 0, $where);
								$themes = $selectData['Data'];
							}
							include "Views/Admin/view_all_theme.php";
					}
					break;
				case '/skill';
					$case = 5;
					include 'Views/header.php';
					$firstname = $_SESSION['admin_data']->first_name;
					$lastname = $_SESSION['admin_data']->last_name;
					$avtar = $_SESSION['admin_data']->avatar;
					include 'Views/adminsidebar.php';
					if (isset($_GET['source']))
						$source = $_GET['source'];
					else
						$source = '';
					switch ($source) {
						case 'add_skill':
							if (isset($_POST['add_skill'])) {
								$insert_data = [
									'skill_name' => $_POST['skill_name'],
									'status' => $_POST['status']
								];
								$insertEx = $this->InsertData('skill', $insert_data);
								echo $insertEx;
								if ($insertEx['Code']) {
								?>
									<script type="text/javascript">
										alert("<?php echo $insertEx['Message'] ?>");
										window.location.href = 'skill';
									</script>
								<?php
								} else {
								?>
									<script type="text/javascript">
										alert("<?php echo $insertEx['Message'] ?>");
										window.location.href = 'skill?source=add_skill';
									</script>
								<?php
								}
							}
							include "Views/Admin/add_skill.php";
							break;
						case 'edit_skill':
							$encrypted_id = $_GET['edit'];
							$salt = "SECRET_STUFF";
							$decrypted_id_raw = base64_decode($encrypted_id);
							$decrypted_id = preg_replace(sprintf('/%s/', $salt), '', $decrypted_id_raw);
							$skill_id = $decrypted_id;
							$where = [
								'skill_id' => $skill_id
							];
							$selectData = $this->SelectData1('skill', $where);
							$skill = $selectData['Data'];
							if (isset($_POST['edit_skill'])) {
								$update_data = [
									'skill_name' => $_POST['skill_name'],
									'status' => $_POST['status'],
									'updated_at' => date("Y-m-d h:i:s")
								];
								$where = [
									'skill_id' => $skill_id
								];
								$upd_data = $this->UpdateData1('skill', $update_data, $where);
								if ($upd_data) {
								?>
									<script type="text/javascript">
										alert("Data update successfully.");
										window.location.href = 'skill';
									</script>
								<?php
								} else {
								?>
									<script type="text/javascript">
										alert("Something Went Wrong.");
										window.location.href = 'skill?source=edit_skill&edit=<?php $id = $skill->skill_id;
																								$salt = "SECRET_STUFF";
																								$encrypted_id = base64_encode($id . $salt);
																								echo $encrypted_id; ?> ';
									</script>
								<?php
								}
							}
							include "Views/Admin/edit_skill.php";
							break;
						case 'delete_skill':
							$encrypted_id = $_GET['delete'];
							$salt = "SECRET_STUFF";
							$decrypted_id_raw = base64_decode($encrypted_id);
							$decrypted_id = preg_replace(sprintf('/%s/', $salt), '', $decrypted_id_raw);
							$skill_id = $decrypted_id;
							$update_data = [
								'deleted_at' => date("Y-m-d h:i:s")
							];
							$where = [
								'skill_id' => $skill_id
							];
							$delete_data = $this->UpdateData1('skill', $update_data, $where);
							if ($delete_data) {
								?>
								<script type="text/javascript">
									alert("Data deleted successfully.");
									window.location.href = 'skill';
								</script>
							<?php
							} else {
							?>
								<script type="text/javascript">
									alert("Something Went Wrong.");
									window.location.href = 'skill';
								</script>
							<?php
							}
						default:
							$pagecount = 5;
							if (isset($_GET['page'])) {
								$page = $_GET['page'];
							} else
								$page = 1;
							if ($page == "" || $page == 1) {
								$postno = 0;
							} else
								$postno = ($page * $pagecount) - $pagecount;
							$selectData = $this->Select('skill');
							$cnt = $selectData['Data'];
							$cnt = ceil($cnt / $pagecount);
							$selectData = $this->SelectData('skill', $postno, $pagecount);
							$skills = $selectData['Data'];
							if (isset($_POST['search'])) {
								$where = [
									'skill_name' => $_POST['search']
								];
								$selectData = $this->SelectData('skill', 0, 0, $where);
								$skills = $selectData['Data'];
							}
							include "Views/Admin/view_all_skill.php";
					}
					break;
				case '/app';
					$case = 6;
					include 'Views/header.php';
					$firstname = $_SESSION['admin_data']->first_name;
					$lastname = $_SESSION['admin_data']->last_name;
					$avtar = $_SESSION['admin_data']->avatar;
					include 'Views/adminsidebar.php';
					if (isset($_GET['source']))
						$source = $_GET['source'];
					else
						$source = '';
					switch ($source) {
						case 'edit_app':
							$encrypted_id = $_GET['edit'];
							$salt = "SECRET_STUFF";
							$decrypted_id_raw = base64_decode($encrypted_id);
							$decrypted_id = preg_replace(sprintf('/%s/', $salt), '', $decrypted_id_raw);
							$mission_application_id = $decrypted_id;
							$update_data = [
								'approval_status' => 'APPROVE',
								'updated_at' => date("Y-m-d h:i:s")
							];
							$where = [
								'mission_application_id' => $mission_application_id
							];
							$upd_data = $this->UpdateData1('mission_application', $update_data, $where);
							if ($upd_data) {
							?>
								<script type="text/javascript">
									alert("Data update successfully.");
									window.location.href = 'app';
								</script>
							<?php
							} else {
							?>
								<script type="text/javascript">
									alert("Something Went Wrong.");
									window.location.href = 'app';
								</script>
							<?php
							}
							break;
						case 'delete_app':
							$encrypted_id = $_GET['delete'];
							$salt = "SECRET_STUFF";
							$decrypted_id_raw = base64_decode($encrypted_id);
							$decrypted_id = preg_replace(sprintf('/%s/', $salt), '', $decrypted_id_raw);
							$mission_application_id = $decrypted_id;
							echo $mission_application_id;
							$update_data = [
								'approval_status' => 'DECLINE',
								'deleted_at' => date("Y-m-d h:i:s")
							];
							$where = [
								'mission_application_id' => $mission_application_id
							];
							$upd_data = $this->UpdateData1('mission_application', $update_data, $where);
							if ($upd_data) {
							?>
								<script type="text/javascript">
									alert("Data update successfully.");
									window.location.href = 'app';
								</script>
							<?php
							} else {
							?>
								<script type="text/javascript">
									alert("Something Went Wrong.");
									window.location.href = 'app';
								</script>
							<?php
							}
							break;
						default:
							$pagecount = 5;
							if (isset($_GET['page'])) {
								$page = $_GET['page'];
							} else
								$page = 1;
							if ($page == "" || $page == 1) {
								$postno = 0;
							} else
								$postno = ($page * $pagecount) - $pagecount;
							$selectData = $this->Select('mission_application');
							$cnt = $selectData['Data'];
							$cnt = ceil($cnt / $pagecount);
							$selectData = $this->SelectJoinApp($postno, $pagecount);
							$apps = $selectData['Data'];
							if (isset($_POST['search'])) {
								$where = [
									'mission.title' => $_POST['search'],
									'last_name' => $_POST['search'],
									'first_name' => $_POST['search']
								];
								$selectData = $this->SelectJoinApp(0, 0, $where);
								$apps = $selectData['Data'];
							}
							include "Views/Admin/view_all_app.php";
					}
					break;
				case '/story';
					$case = 7;
					include 'Views/header.php';
					$firstname = $_SESSION['admin_data']->first_name;
					$lastname = $_SESSION['admin_data']->last_name;
					$avtar = $_SESSION['admin_data']->avatar;
					include 'Views/adminsidebar.php';
					if (isset($_GET['source']))
						$source = $_GET['source'];
					else
						$source = '';
					switch ($source) {
						case 'view_story':
							$encrypted_id = $_GET['view'];
							$salt = "SECRET_STUFF";
							$decrypted_id_raw = base64_decode($encrypted_id);
							$decrypted_id = preg_replace(sprintf('/%s/', $salt), '', $decrypted_id_raw);
							$story_id = $decrypted_id;
							$selectData = $this->SelectViewStory($story_id);
							$story = $selectData['Data'];
							$where = [
								'story_id' => $story_id
							];
							$selectData1 = $this->SelectData('story_media', 0, 0, $where);
							$medias = $selectData1['Data'];
							include "Views/Admin/view_story.php";
							break;
						case 'approve_story':
							$encrypted_id = $_GET['edit'];
							$salt = "SECRET_STUFF";
							$decrypted_id_raw = base64_decode($encrypted_id);
							$decrypted_id = preg_replace(sprintf('/%s/', $salt), '', $decrypted_id_raw);
							$story_id = $decrypted_id;
							$update_data = [
								'status' => 'PUBLISHED',
								'updated_at' => date("Y-m-d h:i:s")
							];
							$where = [
								'story_id' => $story_id
							];
							$upd_data = $this->UpdateData1('story', $update_data, $where);
							if ($upd_data) {
							?>
								<script type="text/javascript">
									alert("Data update successfully.");
									window.location.href = 'story';
								</script>
							<?php
							} else {
							?>
								<script type="text/javascript">
									alert("Something Went Wrong.");
									window.location.href = 'story';
								</script>
							<?php
							}
							break;
						case 'decline_story':
							$encrypted_id = $_GET['edit'];
							$salt = "SECRET_STUFF";
							$decrypted_id_raw = base64_decode($encrypted_id);
							$decrypted_id = preg_replace(sprintf('/%s/', $salt), '', $decrypted_id_raw);
							$story_id = $decrypted_id;
							$update_data = [
								'status' => 'DECLINED',
								'updated_at' => date("Y-m-d h:i:s")
							];
							$where = [
								'story_id' => $story_id
							];
							$upd_data = $this->UpdateData1('story', $update_data, $where);
							if ($upd_data) {
							?>
								<script type="text/javascript">
									alert("Data update successfully.");
									window.location.href = 'story';
								</script>
							<?php
							} else {
							?>
								<script type="text/javascript">
									alert("Something Went Wrong.");
									window.location.href = 'story';
								</script>
							<?php
							}
							break;
						case 'delete_story':
							$encrypted_id = $_GET['delete'];
							$salt = "SECRET_STUFF";
							$decrypted_id_raw = base64_decode($encrypted_id);
							$decrypted_id = preg_replace(sprintf('/%s/', $salt), '', $decrypted_id_raw);
							$story_id = $decrypted_id;
							$update_data = [
								'deleted_at' => date("Y-m-d h:i:s")
							];
							$where = [
								'story_id' => $story_id
							];
							$delete_data = $this->UpdateData1('story', $update_data, $where);
							if ($delete_data) {
							?>
								<script type="text/javascript">
									alert("Data deleted successfully.");
									window.location.href = 'story';
								</script>
							<?php
							} else {
							?>
								<script type="text/javascript">
									alert("Something Went Wrong.");
									window.location.href = 'story';
								</script>
								<?php
							}
							break;
						default:
							$pagecount = 5;
							if (isset($_GET['page'])) {
								$page = $_GET['page'];
							} else
								$page = 1;
							if ($page == "" || $page == 1) {
								$postno = 0;
							} else
								$postno = ($page * $pagecount) - $pagecount;
							$selectData = $this->Select('story');
							$cnt = $selectData['Data'];
							$cnt = ceil($cnt / $pagecount);
							$selectData = $this->SelectJoinStory($postno, $pagecount);
							$storys = $selectData['Data'];
							if (isset($_POST['search'])) {
								$where = [
									'story.title' => $_POST['search'],
									'mission.title' => $_POST['search'],
									'first_name' => $_POST['search'],
									'last_name' => $_POST['search']
								];
								$selectData = $this->SelectJoinStory(0, 0, $where);
								$storys = $selectData['Data'];
							}
							include "Views/Admin/view_all_story.php";
					}
					break;
				case '/banner';
					$case = 8;
					include 'Views/header.php';
					$firstname = $_SESSION['admin_data']->first_name;
					$lastname = $_SESSION['admin_data']->last_name;
					$avtar = $_SESSION['admin_data']->avatar;
					include 'Views/adminsidebar.php';
					if (isset($_GET['source']))
						$source = $_GET['source'];
					else
						$source = '';
					switch ($source) {
						case 'add_banner':
							if (isset($_POST['add_banner'])) {
								$image = $_FILES['image']['name'];
								$image_temp = $_FILES['image']['tmp_name'];
								$insert_data = [
									'title' => $_POST['title'],
									'text' => $_POST['text'],
									'sort_order' => $_POST['sort_order'],
									'image' => $image
								];
								$insertEx = $this->InsertData('banner', $insert_data);
								if ($insertEx['Code']) {
									if (!is_null($image)) {
										move_uploaded_file($image_temp, '../Assets/' . $image);
									}
								?>
									<script type="text/javascript">
										alert("<?php echo $insertEx['Message'] ?>");
										window.location.href = 'banner';
									</script>
								<?php
								} else {
								?>
									<script type="text/javascript">
										alert("<?php echo $insertEx['Message'] ?>");
										window.location.href = 'page?source=add_banner';
									</script>
								<?php
								}
							}
							include "Views/Admin/add_banner.php";
							break;
						case 'edit_banner':
							$encrypted_id = $_GET['edit'];
							$salt = "SECRET_STUFF";
							$decrypted_id_raw = base64_decode($encrypted_id);
							$decrypted_id = preg_replace(sprintf('/%s/', $salt), '', $decrypted_id_raw);
							$banner_id = $decrypted_id;
							$where = [
								'banner_id' => $banner_id
							];
							$selectData = $this->SelectData1('banner', $where);
							$banner = $selectData['Data'];
							if (isset($_POST['edit_banner'])) {
								$image = $_FILES['image']['name'];
								$image_temp = $_FILES['image']['tmp_name'];
								if (empty($image)) {
									$selectData12 = $this->SelectData1('banner', $where);
									$image = $selectData12['Data']->image;
								}
								$update_data = [
									'title' => $_POST['title'],
									'text' => $_POST['text'],
									'sort_order' => $_POST['sort_order'],
									'image' => $image,
									'updated_at' => date("Y-m-d h:i:s")
								];
								$where = [
									'banner_id' => $banner_id
								];
								$upd_data = $this->UpdateData1('banner', $update_data, $where);
								if ($upd_data) {
									if (!is_null($avatar)) {
										move_uploaded_file($avatar_temp, '../Assets/' . $avatar);
									}
								?>
									<script type="text/javascript">
										alert("Data update successfully.");
										window.location.href = 'banner';
									</script>
								<?php
								} else {
								?>
									<script type="text/javascript">
										alert("Something Went Wrong.");
										window.location.href = 'banner?source=edit_banner&edit=<?php
																								$id = $banner->banner_id;
																								$salt = "SECRET_STUFF";
																								$encrypted_id = base64_encode($id . $salt);
																								echo $encrypted_id; ?>';
									</script>
								<?php
								}
							}
							include "Views/Admin/edit_banner.php";
							break;
						case 'delete_banner':
							$encrypted_id = $_GET['delete'];
							$salt = "SECRET_STUFF";
							$decrypted_id_raw = base64_decode($encrypted_id);
							$decrypted_id = preg_replace(sprintf('/%s/', $salt), '', $decrypted_id_raw);
							$banner_id = $decrypted_id;
							$update_data = [
								'deleted_at' => date("Y-m-d h:i:s")
							];
							$where = [
								'banner_id' => $banner_id
							];
							$delete_data = $this->UpdateData1('banner', $update_data, $where);
							if ($delete_data) {
								?>
								<script type="text/javascript">
									alert("Data deleted successfully.");
									window.location.href = 'banner';
								</script>
							<?php
							} else {
							?>
								<script type="text/javascript">
									alert("Something Went Wrong.");
									window.location.href = 'banner';
								</script>
<?php
							}
						default:
							$pagecount = 5;
							if (isset($_GET['page'])) {
								$page = $_GET['page'];
							} else
								$page = 1;
							if ($page == "" || $page == 1) {
								$postno = 0;
							} else
								$postno = ($page * $pagecount) - $pagecount;
							$selectData = $this->Select('banner');
							$cnt = $selectData['Data'];
							$cnt = ceil($cnt / $pagecount);
							$selectData = $this->SelectData('banner', $postno, $pagecount);
							$banners = $selectData['Data'];
							if (isset($_POST['search'])) {
								$where = [
									'title' => $_POST['search'],
									'sort_order' => $_POST['search']
								];
								$selectData = $this->SelectData('banner', 0, 0, $where);
								$banners = $selectData['Data'];
							}
							include "Views/Admin/view_all_banner.php";
					}
					break;
				case '/ruff':
					include "Views/ruff.php";
				default:

					break;
			}
		}
	}
}

$obj = new Controller;


?>