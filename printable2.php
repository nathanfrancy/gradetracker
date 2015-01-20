<?php

$grades = explode(",", $_GET['grades']);

echo "<h1>Grades</h1>";
echo "<pre>";
print_r($grades);
echo "</pre>";

?>