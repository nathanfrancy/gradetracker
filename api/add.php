<?php

ini_set("allow_url_fopen", true);
require("../data/master.php");

$data = json_decode(file_get_contents("php://input"));

$response = null;

$rq = $data->rq;
$id = $data->id;
$title = $data->title;


// Check if there is a request type defined in the request
if ($rq !== "") {
    
    if ($rq === "addSchoolYear") {
        if ($title !== null) {
            $newid = addSchoolYear($title);
            $response['response'] = "success";
            $response['message'] = "Successfully added {$title}.";
            $response['newid'] = $newid;
        }
        else {
            $response['response'] = "fail";
            $response['message'] = "Name is required.";
        }
    }
    else {
        $response['response'] = "fail";
        $response['message'] = "Request type not valid.";
    }
}
else {
    $response['response'] = "fail";
    $response['message'] = "No request type [rq] defined in request.";
}


// Respond with $response in json format
header('Content-Type: application/json');
echo json_encode($response);

?>