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
					include 'homeController.php';
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
				case '/ruff':
					include "Views/ruff.php";
				default:
					break;
			}
		}
	}
}

$obj = new Controller;
