<?php

function getStudentsFromSchoolYear($schoolyear_id) {
    $students = array();
	
	// Connect and initialize sql and prepared statement template
	$link = connect_db();
	$sql = "SELECT * FROM `student` WHERE `schoolyear_id` = ?";
	$stmt = $link->stmt_init();
	$stmt->prepare($sql);
    $stmt->bind_param('i', $schoolyear_id);
	$stmt->execute();
	$result = $stmt->get_result();
	
	// Bind result to Book object and push each one on the end of $books array
    while ($row = $result->fetch_array(MYSQLI_BOTH)) {
        $student['id'] = $row['id'];
        $student['firstname'] = $row['firstname'];
        $student['lastname'] = $row['lastname'];
        $student['schoolyear_id'] = $row['schoolyear_id'];
		array_push($students, $student);
	}
	
	mysqli_stmt_close($stmt);
	return $students;
}

function getStudent($id) {
	$student = null;
	
	// Connect and initialize sql and prepared statement template
	$link = connect_db();
	$sql = "SELECT * FROM `student` WHERE id = ? LIMIT 1";
	$stmt = $link->stmt_init();
	$stmt->prepare($sql);
	$stmt->bind_param('i', $id);
	$stmt->execute();
	$result = $stmt->get_result();

	// bind the result to $theBook for json encoding
	while ($row = $result->fetch_array(MYSQLI_BOTH)) {
		$student['id'] = $row['id'];
		$student['firstname'] = $row['firstname'];
		$student['lastname'] = $row['lastname'];
		$student['schoolyear_id'] = $row['schoolyear_id'];
	}
	
	mysqli_stmt_close($stmt);
	return $student;
}

function addStudent($firstname, $lastname, $schoolyear_id) {
    $link = connect_db();
	$sql = "INSERT INTO  `student` (`firstname`, `lastname`, `schoolyear_id`) VALUES (?, ?, ?)";
	$stmt = $link->stmt_init();
	$stmt->prepare($sql);
	$stmt->bind_param('ssi', $link->real_escape_string($firstname), $link->real_escape_string($lastname), $schoolyear_id);
	$stmt->execute();
	$id = $link->insert_id;
	mysqli_stmt_close($stmt);
	$link->close();
	
	return $id;
}

function editStudent($id, $firstname, $lastname) {
	$link = connect_db();
	$sql = "UPDATE  `student` SET `firstname`=?, `lastname`=? WHERE id = ?";
	
	// Create prepared statement and bind parameters
	$stmt = $link->stmt_init();
	$stmt->prepare($sql);
	$stmt->bind_param('ssi', $link->real_escape_string($firstname), $link->real_escape_string($lastname), $id);
	
    // Execute the query, get the last inserted id
    $stmt->execute();
	$rows = $link->affected_rows;
	mysqli_stmt_close($stmt);
	$link->close();
    $student = getStudent($id);
	
	return $student;
}

?>