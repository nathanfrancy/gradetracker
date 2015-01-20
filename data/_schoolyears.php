<?php

function getAllSchoolYears($user_id) {
    $schoolyears = array();
	
	// Connect and initialize sql and prepared statement template
	$link = connect_db();
	$sql = "SELECT schoolyear.*, count(student.schoolyear_id) as number_of_students from schoolyear left join student on (schoolyear.id = student.schoolyear_id) where schoolyear.user_id = ? group by schoolyear.id";
	$stmt = $link->stmt_init();
	$stmt->prepare($sql);
    $stmt->bind_param('i', $user_id);
	$stmt->execute();
	$result = $stmt->get_result();
	
	// Bind result to Book object and push each one on the end of $books array
    while ($row = $result->fetch_array(MYSQLI_BOTH)) {
        $schoolyear['id'] = $row['id'];
        $schoolyear['title'] = $row['title'];
        $schoolyear['num_students'] = $row['number_of_students'];
        $schoolyear['q1_start'] = $row['q1_start'];
        $schoolyear['q1_end'] = $row['q1_end'];
        $schoolyear['q2_start'] = $row['q2_start'];
        $schoolyear['q2_end'] = $row['q2_end'];
        $schoolyear['q3_start'] = $row['q3_start'];
        $schoolyear['q3_end'] = $row['q3_end'];
        $schoolyear['q4_start'] = $row['q4_start'];
        $schoolyear['q4_end'] = $row['q4_end'];
		array_push($schoolyears, $schoolyear);
	}
	
	mysqli_stmt_close($stmt);
	return $schoolyears;
}

function getSchoolYear($id) {
	$schoolyear = null;
	
	// Connect and initialize sql and prepared statement template
	$link = connect_db();
	$sql = "SELECT * FROM `schoolyear` WHERE id = ? LIMIT 1";
	$stmt = $link->stmt_init();
	$stmt->prepare($sql);
	$stmt->bind_param('i', $id);
	$stmt->execute();
	$result = $stmt->get_result();

	// bind the result to $theBook for json encoding
	while ($row = $result->fetch_array(MYSQLI_BOTH)) {
		$schoolyear['id'] = $row['id'];
		$schoolyear['title'] = $row['title'];
		$schoolyear['user_id'] = $row['user_id'];
		$schoolyear['q1_start'] = $row['q1_start'];
        $schoolyear['q1_end'] = $row['q1_end'];
        $schoolyear['q2_start'] = $row['q2_start'];
        $schoolyear['q2_end'] = $row['q2_end'];
        $schoolyear['q3_start'] = $row['q3_start'];
        $schoolyear['q3_end'] = $row['q3_end'];
        $schoolyear['q4_start'] = $row['q4_start'];
        $schoolyear['q4_end'] = $row['q4_end'];
	}
	
	mysqli_stmt_close($stmt);
	return $schoolyear;
}

function addSchoolYear($title, $q1_start, $q1_end, $q2_start, $q2_end, $q3_start, $q3_end, $q4_start, $q4_end) {
    $link = connect_db();
	$sql = "INSERT INTO  `schoolyear` (`title`, `user_id`, `q1_start`, `q1_end`, `q2_start`, `q2_end`, `q3_start`, `q3_end`, `q4_start`, `q4_end`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
	$stmt = $link->stmt_init();
	$stmt->prepare($sql);
	$stmt->bind_param('sissssssss', 
		$link->real_escape_string($title), 
		$_SESSION['auth_id'],
		$link->real_escape_string($q1_start),
		$link->real_escape_string($q1_end),
		$link->real_escape_string($q2_start),
		$link->real_escape_string($q2_end),
		$link->real_escape_string($q3_start),
		$link->real_escape_string($q3_end),
		$link->real_escape_string($q4_start),
		$link->real_escape_string($q4_end));
	$stmt->execute();
	$id = $link->insert_id;
	mysqli_stmt_close($stmt);
	$link->close();
	
	return $id;
}

function editSchoolYear($id, $title, $q1_start, $q1_end, $q2_start, $q2_end, $q3_start, $q3_end, $q4_start, $q4_end) {
	$link = connect_db();
	$sql = "UPDATE  `schoolyear` SET `title`=?, `q1_start`=?, `q1_end`=?, `q2_start`=?, `q2_end`=?, `q3_start`=?, `q3_end`=?, `q4_start`=?, `q4_end`=? WHERE id = ?";
	
	// Create prepared statement and bind parameters
	$stmt = $link->stmt_init();
	$stmt->prepare($sql);
	$stmt->bind_param('sssssssssi', 
		$link->real_escape_string($title),
		$link->real_escape_string($q1_start),
		$link->real_escape_string($q1_end),
		$link->real_escape_string($q2_start),
		$link->real_escape_string($q2_end),
		$link->real_escape_string($q3_start),
		$link->real_escape_string($q3_end),
		$link->real_escape_string($q4_start),
		$link->real_escape_string($q4_end),
		$id);
	
    // Execute the query, get the last inserted id
    $stmt->execute();
	$rows = $link->affected_rows;
	mysqli_stmt_close($stmt);
	$link->close();
    $schoolYear = getSchoolYear($id);
	
	return $schoolYear;
}

?>