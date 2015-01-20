<?php

require("../data/master.php");

$response = null;

$id = null;
$auth_id = $_SESSION['auth_id'];

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

if (rq === "deleteSchoolYear") {
    //$response = deleteSchoolYear($id);
}


// Respond with $response in json format
header('Content-Type: application/json');
echo json_encode($response);

?>