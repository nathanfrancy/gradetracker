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

// Variables for password resets
$currentpassword = $data->currentpassword;
$newpassword = $data->newpassword;

// Variables for school year quarters
$q1_start = $data->q1_start;
$q1_end = $data->q1_end;
$q2_start = $data->q2_start;
$q2_end = $data->q2_end;
$q3_start = $data->q3_start;
$q3_end = $data->q3_end;
$q4_start = $data->q4_start;
$q4_end = $data->q4_end;


// Check if a session auth_id is present. Must be logged in at the very least
// to view any type of data in the system. Otherwise get an error.
if (isset($_SESSION['auth_id'])) {
	$auth_id = $_SESSION['auth_id'];
	$user = getUser($auth_id);

	if ($rq == "editSchoolYear") {
		$response = null;
		$schoolyear = editSchoolYear($id, $title, $q1_start, $q1_end, $q2_start, $q2_end, $q3_start, $q3_end, $q4_start, $q4_end);
		$response['response'] = "success";
		$response['message'] = "Successfully edited {$title}.";
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

		// Check if auth_id and posted id match OR if the user is an administrator
		if ($auth_id === $id || $user['type'] === "admin") {
			$response['response'] = "success";
			$response['message'] = editUser($id, $firstname, $lastname, $email, $username, $theme);
		}
		else {
			$response['response'] = "danger";
			$response['message'] = "You are not able to edit this user account.";
		}
	}
	else if ($rq == "userPasswordReset") {
		$response = null;
		$response['response'] = changePassword($currentpassword, $newpassword);
	}
	else {
		$response['response'] = "danger";
		$response['message'] = "Request type is invalid.";
	}
}
else {
	$response['response'] = "danger";
	$response['message'] = "You cannot perform this operation.";
}

header('Content-Type: application/json');
echo json_encode($response);

?>