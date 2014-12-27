<?php

ini_set("allow_url_fopen", true);

$data = json_decode(file_get_contents("php://input"));

$response = null;

$students = $data->students;

echo print_r($students);

?>