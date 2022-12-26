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
				case '/timesheet':
					include "adminController/timesheetController.php";
					break;
				case '/ruff':
					include "ruffController.php";
					break;
				case '/stories';
					include "homeController/storyController.php";
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
				default:
					break;
			}
		}
	}
}

$obj = new Controller;
