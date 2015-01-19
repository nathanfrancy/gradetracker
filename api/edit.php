<?php

ini_set("allow_url_fopen", true);
require("../data/master.php");

$data = json_decode(file_get_contents("php://input"));

$response = null;

$rq = $data->rq;
$id = $data->id;
$title = $data->title;
$description = $data->description;
$firstname = $data->firstname;
$lastname = $data->lastname;
$email = $data->email;
$username = $data->username;
$theme = $data->theme;
$date_given = $data->date_given;
$status = $data->status;

$currentpassword = $data->currentpassword;
$newpassword = $data->newpassword;


// Check if a session auth_id is present. Must be logged in at the very least
// to view any type of data in the system. Otherwise get an error.
if (isset($_SESSION['auth_id'])) {
    $auth_id = $_SESSION['auth_id'];

	if ($rq == "editSchoolYear") {
		$response = null;
		$schoolyear = editSchoolYear($id, $title);
		$response['message'] = "success";
	}
	else if ($rq == "editStudent") {
		$response = null;
		$student = editStudent($id, $firstname, $lastname, $status);
		$response['message'] = "success";
	}
	else if ($rq == "editStandard") {
		$response = null;
		$standard = editStandard($id, $title, $description, $date_given);
		$response['message'] = "success";
	}
	else if ($rq == "editUser") {
		$response = null;

		// Check if auth_id and posted id match
		if ($auth_id === $id) {
			$response['response'] = "success";
			$response['message'] = editUser($id, $firstname, $lastname, $email, $username, $theme);
		}
		else {
			$response['response'] = "fail";
			$response['message'] = "Something fishy is going on here.";
		}
	}
	else if ($rq == "userPasswordReset") {
		$response = null;
		$response['response'] = changePassword($currentpassword, $newpassword);
	}
	else {
		$response['response'] = "fail";
		$response['message'] = "Request type is invalid.";
	}
}
else {
	$response['response'] = "fail";
	$response['message'] = "You cannot perform this operation.";
}

header('Content-Type: application/json');
echo json_encode($response);

?>