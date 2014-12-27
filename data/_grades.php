<?php



function recordIndividualStandardGrade($student_id, $standard_id, $rating) {
	$link = connect_db();
	$sql = "INSERT INTO grade (`student_id`, `standard_id`,`rating`) VALUES (?,?,?) ON DUPLICATE KEY UPDATE rating=?";
	
	// Create prepared statement and bind parameters
	$stmt = $link->stmt_init();
	$stmt->prepare($sql);
	$stmt->bind_param('iiss', $student_id, $standard_id, $rating, $rating);
	
    // Execute the query, get the last inserted id
    $stmt->execute();
	$rows = $link->affected_rows;
	mysqli_stmt_close($stmt);
	$link->close();
	
	return "true";
}

function getStudentsWithStandardGrades($schoolyear_id, $standard_id) {
    $students = array();
	
	// Connect and initialize sql and prepared statement template
	$link = connect_db();
	$sql = "SELECT *, `student`.`id` as `studentid` FROM `student` LEFT JOIN `grade` ON `grade`.`student_id` = `student`.`id` WHERE `student`.`schoolyear_id` = ?";
	$stmt = $link->stmt_init();
	$stmt->prepare($sql);
    $stmt->bind_param('i', $schoolyear_id);
	$stmt->execute();
	$result = $stmt->get_result();
	
	// Bind result to Book object and push each one on the end of $books array
    while ($row = $result->fetch_array(MYSQLI_BOTH)) {
        $student['id'] = $row['studentid'];
        $student['firstname'] = $row['firstname'];
        $student['lastname'] = $row['lastname'];
        $student['schoolyear_id'] = $row['schoolyear_id'];
        $student['status'] = $row['status'];
        $student['rating'] = $row['rating'];
		array_push($students, $student);
	}
	
	mysqli_stmt_close($stmt);
	return $students;
}


?>