<?php

ini_set("allow_url_fopen", true);
require("../data/master.php");

$data = json_decode(file_get_contents("php://input"));

$response = null;

$rq = $data->rq;
$id = $data->id;
$title = $data->title;
$firstname = $data->firstname;
$lastname = $data->lastname;
$schoolyear_id = $data->schoolyear_id;
$date_given = $data->date_given;
$students = $data->students;
$standard = $data->standard;

// Check if there is a request type defined in the request
if ($rq !== "") {
    

    /**
     * insert a new school year into the database
     */
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


    else if ($rq === "addStudent") {
        if ($firstname !== null && $lastname !== null && $schoolyear_id !== null) {
            $newid = addStudent($firstname, $lastname, $schoolyear_id);
            $response['response'] = "success";
            $response['message'] = "Successfully added {$firstname} {$lastname}.";
            $response['newid'] = $newid;
        }
        else {
            $response['response'] = "fail";
            $response['message'] = "Name is required.";
        }
    }


    else if ($rq === "addStandard") {
        if ($title !== null && $date_given !== null) {
            $newid = addStandard($title, $date_given, $schoolyear_id);
            $response['response'] = "success";
            $response['message'] = "Successfully added {$title}.";
            $response['newid'] = $newid;
        }
        else {
            $response['response'] = "fail";
            $response['message'] = "Name is required.";
        }
    }


    else if ($rq === "recordStandardGrades") {
        
        if ($students !== null) {

            foreach ($students as $student) {
                recordIndividualStandardGrade($student->id, $standard->id, $student->rating);
            }

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