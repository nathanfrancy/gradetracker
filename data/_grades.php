<?php

function recordIndividualStandardGrade($student_id, $standard_id, $rating) {
    $d = date("m-d-Y");
    
	$link = connect_db();
	$sql = "INSERT INTO grade (`student_id`, `standard_id`,`rating`, `date_updated`) VALUES (?,?,?,?) ON DUPLICATE KEY UPDATE rating=?, date_updated=?";
	
	// Create prepared statement and bind parameters
	$stmt = $link->stmt_init();
	$stmt->prepare($sql);
	$stmt->bind_param('iissss', $student_id, $standard_id, $rating, $d, $rating, $d);
	
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
	$sql = "
SELECT s.*, g.*, s.`id` as `studentid` 
FROM `student` s 
LEFT JOIN `grade` g ON g.`student_id` = s.`id` AND g.standard_id = ?
LEFT JOIN `standard` st ON g.standard_id = st.id
WHERE s.`schoolyear_id` = ? AND s.`status` = 'enabled'";
	$stmt = $link->stmt_init();
	$stmt->prepare($sql);
    $stmt->bind_param('ii', $standard_id, $schoolyear_id);
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
        $student['date_updated'] = $row['date_updated'];
		array_push($students, $student);
	}
	
	mysqli_stmt_close($stmt);
	return $students;
}


?>