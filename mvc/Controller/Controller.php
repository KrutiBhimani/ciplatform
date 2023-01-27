<?php

date_default_timezone_set('Asia/Kolkata');
require_once('mvc/Model/loginModel.php');
session_start();

class Controller extends loginModel
{

	function __construct()
	{
		parent::__construct();

		if (isset($_SERVER['PATH_INFO'])) {
			switch ($_SERVER['PATH_INFO']) {
				case '/register':
					include 'registerController.php';
					break;
				case '/login':
					include 'loginController.php';
					break;
				case '/home':
					include 'homeController/homeController.php';
					break;
				case '/logout':
					include 'logoutController.php';
					break;
				case '/forgot':
					include 'forgotController.php';
					break;
				case '/reset':
					include 'resetController.php';
					break;
				case '/user';
					include 'adminController/userController.php';
					break;
				case '/page';
					include 'adminController/pageController.php';
					break;
				case '/mission';
					include 'adminController/missionController.php';
					break;
				case '/theme';
					include 'adminController/themeController.php';
					break;
				case '/skill';
					include 'adminController/skillController.php';
					break;
				case '/app';
					include 'adminController/appController.php';
					break;
				case '/story';
					include 'adminController/storyController.php';
					break;
				case '/banner';
					include 'adminController/bannerController.php';
					break;
				case '/edit_admin':
					include "adminController/editAdminController.php";
					break;
				case '/stories';
					include "homeController/storyController.php";
					break;
				case '/share_story';
					include "homeController/share_storyController.php";
					break;
				case '/story_detail';
					include "homeController/story_detailController.php";
					break;
				case '/edit_user';
					include "homeController/edituserController.php";
					break;
				case '/user_timesheet';
					include "homeController/usertimesheetController.php";
					break;
				case '/policy';
					include "homeController/policyController.php";
					break;
				case '/Volunteering_Mission';
					include "homeController/Volunteering_MissionController.php";
					break;
				default:
?>
					<script type="text/javascript">
						window.location.href = 'login';
					</script>
<?php
					break;
			}
		}
	}
}

$obj = new Controller;
