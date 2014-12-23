<?php

function getAllSchoolYears($user_id) {
    $schoolyears = array();
	
	// Connect and initialize sql and prepared statement template
	$link = connect_db();
	$sql = "SELECT * FROM `schoolyear` WHERE `user_id` = ? ORDER BY `title` desc";
	$stmt = $link->stmt_init();
	$stmt->prepare($sql);
    $stmt->bind_param('i', $user_id);
	$stmt->execute();
	$result = $stmt->get_result();
	
	// Bind result to Book object and push each one on the end of $books array
    while ($row = $result->fetch_array(MYSQLI_BOTH)) {
        $schoolyear['id'] = $row['id'];
        $schoolyear['title'] = $row['title'];
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
	}
	
	mysqli_stmt_close($stmt);
	return $schoolyear;
}

function addSchoolYear($title) {
    $link = connect_db();
	$sql = "INSERT INTO  `schoolyear` (`title`, `user_id`) VALUES (?, ?)";
	$stmt = $link->stmt_init();
	$stmt->prepare($sql);
	$stmt->bind_param('si', $link->real_escape_string($title), $_SESSION['auth_id']);
	$stmt->execute();
	$id = $link->insert_id;
	mysqli_stmt_close($stmt);
	$link->close();
	
	return $id;
}

function editSchoolYear($id, $title) {
	$link = connect_db();
	$sql = "UPDATE  `schoolyear` SET `title`=? WHERE id = ?";
	
	// Create prepared statement and bind parameters
	$stmt = $link->stmt_init();
	$stmt->prepare($sql);
	$stmt->bind_param('si', $link->real_escape_string($title), $id);
	
    // Execute the query, get the last inserted id
    $stmt->execute();
	$rows = $link->affected_rows;
	mysqli_stmt_close($stmt);
	$link->close();
    $schoolYear = getSchoolYear($id);
	
	return $schoolYear;
}

?>