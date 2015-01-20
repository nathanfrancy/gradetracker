<?php
date_default_timezone_set('America/Chicago');

if(!isset($_SESSION)){
    session_start();
}

function connect_db() {
    $host = "localhost";
    $username = "root";
    $password = "root";
    $db = "gradetracker";

	$link = new mysqli($host, $username, $password, $db) or trigger_error($link->error);
	return $link;
}

function set_cookie($key, $value) {
	// Set the cookie and expiration date to 24 hours from now.
	setcookie($key, $value, time() + (24 * 60 * 60), "/", NULL);
    $_COOKIE[$key] = $value;
}

require_once('_account.php');
require_once('_schoolyears.php');
require_once('_students.php');
require_once('_standards.php');
require_once('_grades.php');


function generate_random_string($length) {
	$charset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $str = '';
    $count = strlen($charset);
    while ($length--) {
        $str .= $charset[mt_rand(0, $count-1)];
    }
    return $str;
}

?>