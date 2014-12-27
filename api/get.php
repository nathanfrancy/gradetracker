<?php

require("../data/master.php");

// Response object will contain everything that will be served
// back to the user, in a json format (at the bottom)
$response = null;

$id = null;
$auth_id = $_SESSION['auth_id'];

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

// Check if there is a request type defined in the request
if (isset($_GET['rq'])) {
    
    $rq = $_GET['rq'];
    
    /* Start of long if-statements to determine which request type 
        the user is wanting. If the request type is not a valid one,
        is puts a warning message in the response.
    */
    if ($rq === "getAllSchoolYears") {
        $schoolYears = getAllSchoolYears($auth_id);
        $response = $schoolYears;
    }
    else if ($rq === "getSchoolYear") {
        $schoolyear = getSchoolYear($id);
        $response = $schoolyear;
    }
    else if ($rq === "getStudentsFromSchoolYear") {
        $students = getStudentsFromSchoolYear($id);
        $response = $students;
    }
    else if ($rq === "getStudent") {
        $student = getStudent($id);
        $response = $student;
    }
    else if ($rq === "getStandardsFromSchoolYear") {
        $standards = getStandardsFromSchoolYear($id);
        $response = $standards;
    }
    else if ($rq === "getStandard") {
        $standard = getStandard($id);
        $response = $standard;
    }
    else if ($rq === "getStudentsWithStandardGrades") {
        $students = getStudentsWithStandardGrades($_GET['schoolyear_id'], $_GET['standard_id']);
        $response = $students;
    }
    
    else {
        $response['response'] = "fail";
        $response['message'] = "Request type not valid.";
    }
}
else {
    $response['response'] = "fail";
    $response['message'] = "No request type (rq) defined in request.";
}


// Respond with $response in json format
header('Content-Type: application/json');
echo json_encode($response);

?>