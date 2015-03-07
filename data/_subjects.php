<?php

function getSubjectsFromSchoolYear($schoolyear_id) {
    $subjects = array();
	
	// Connect and initialize sql and prepared statement template
	$link = connect_db();
	$sql = "SELECT * FROM `subject` WHERE `schoolyear_id` = ?";
	$stmt = $link->stmt_init();
	$stmt->prepare($sql);
    $stmt->bind_param('i', $schoolyear_id);
	$stmt->execute();
	$result = $stmt->get_result();
	
	// Bind result to Book object and push each one on the end of $books array
    while ($row = $result->fetch_array(MYSQLI_BOTH)) {
        $subject['id'] = $row['id'];
        $subject['title'] = $row['title'];
        $subject['schoolyear_id'] = $row['schoolyear_id'];
		array_push($subjects, $subject);
	}
	
	mysqli_stmt_close($stmt);
	return $subjects;
}


?>