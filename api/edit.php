<?php

ini_set("allow_url_fopen", true);
require("../data/master.php");

$data = json_decode(file_get_contents("php://input"));

$response = null;

$rq = $data->rq;
$id = $data->id;
$title = $data->title;


if ($rq == "editSchoolYear") {
	$response = null;
	$schoolyear = editSchoolYear($id, $title);
	$response['message'] = "success";
}
else {
	$response['message'] = "fail";
	$response['error_message'] = "Request type is invalid.";
}

header('Content-Type: application/json');
echo json_encode($response);

?>