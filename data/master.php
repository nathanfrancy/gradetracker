<?php
session_start();

function connect_db() {
    $host = "localhost";
    $username = "root";
    $password = "root";
    $db = "gradetracker";

	$link = new mysqli($host, $username, $password, $db) or trigger_error($link->error);
	return $link;
}

require_once('_account.php');

?>