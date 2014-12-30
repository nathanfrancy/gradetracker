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

require_once('_account.php');
require_once('_schoolyears.php');
require_once('_students.php');
require_once('_standards.php');
require_once('_grades.php');

?>