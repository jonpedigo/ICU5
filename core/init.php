<?php ob_start(); session_start();

$locallist = array(
    '127.0.0.1',
    '::1'
);

if(!in_array($_SERVER['REMOTE_ADDR'], $locallist)){
	
    $session_local = false;
	
}else{
	
    $session_local = true;
	
	
}

if(!$session_local){
	
	//error_reporting(0);
	require_once('recaptchalib.php');
	
}	

date_default_timezone_set('America/New_York');

require("PasswordHash.php");

require 'database/connect.php';
require 'functions/general.php';
require 'functions/users.php';
require 'functions/posts.php';
require 'functions/messages.php';
require 'functions/communities.php';
require 'functions/points.php';
require 'functions/notifications.php';


terminator();
ddos();

$current_file = explode('/', $_SERVER['SCRIPT_NAME']);
$current_file = end($current_file);


//user initialization
if (logged_in() === true) {
	$session_user_id = $_SESSION['user_id'];
	$user_data = user_data($session_user_id, 'user_id', 'username', 'password', 'active','first_name', 'last_name', 'email', 'password_recover', 'type', 'allow_email', 'profile', 'email_code');
	if (user_active($user_data['username']) === false) {
		session_destroy();
		header('Location: index.php');
		exit();
	}
	if ($current_file !== 'changepassword.php' && $user_data['password_recover'] == 1) {
		header('Location: changepassword.php?force');
		exit();
	}
}

$errors = array();

if(isset($_GET['c'])){

	$community_in = $_GET['c'];

}

?>