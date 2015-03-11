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
$schoolyear_id = $data->schoolyear_id;
$date_given = $data->date_given;
$students = $data->students;
$standard = $data->standard;
$subject_id = $data->subject_id;

// Variables for school year quarters
$q1_start = $data->q1_start;
$q1_end = $data->q1_end;
$q2_start = $data->q2_start;
$q2_end = $data->q2_end;
$q3_start = $data->q3_start;
$q3_end = $data->q3_end;
$q4_start = $data->q4_start;
$q4_end = $data->q4_end;


/* Check if there is an authorized id in the session, 
    don't allow anything to happen unless it is present */
if (isset($_SESSION['auth_id'])) {
    $auth_id = $_SESSION['auth_id'];
    
    // Check if there is a request type defined in the request
    if ($rq !== "") {

        /**
         * insert a new school year into the database
         */
        if ($rq === "addSchoolYear") {
            if ($title !== null) {
                $newid = addSchoolYear($title, $q1_start, $q1_end, $q2_start, $q2_end, $q3_start, $q3_end, $q4_start, $q4_end);
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
                $newid = addStudent($firstname, $lastname, $schoolyear_id, 'enabled');
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
            if ($title !== null && $date_given !== null && $subject_id != null) {
                $newid = addStandard($title, $description, $date_given, $schoolyear_id, $subject_id);
                $response['response'] = "success";
                $response['message'] = "Successfully added {$title}.";
                $response['newid'] = $newid;
            }
            else {
                $response['response'] = "fail";
                $response['message'] = "Title, subject and date given are required.";
            }
        }

        else if ($rq === "addSubject") {
            if ($title !== null) {
                $newid = addSubjectToSchoolYear($title, $schoolyear_id);
                $response['response'] = "success";
                $response['message'] = "Successfully added {$title}.";
                $response['newid'] = $newid;
            }
            else {
                $response['response'] = "fail";
                $response['message'] = "Title and date given are required.";
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
}
else {
    $response['response'] = "fail";
    $response['message'] = "You cannot perform this operation.";
}


// Respond with $response in json format
header('Content-Type: application/json');
echo json_encode($response);

?>