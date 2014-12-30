<?php

function getStandardsFromSchoolYear($schoolyear_id) {
    $standards = array();
	
	// Connect and initialize sql and prepared statement template
	$link = connect_db();
	$sql = "SELECT * FROM `standard` WHERE `schoolyear_id` = ?";
	$stmt = $link->stmt_init();
	$stmt->prepare($sql);
    $stmt->bind_param('i', $schoolyear_id);
	$stmt->execute();
	$result = $stmt->get_result();
	
	// Bind result to Book object and push each one on the end of $books array
    while ($row = $result->fetch_array(MYSQLI_BOTH)) {
        $standard['id'] = $row['id'];
        $standard['title'] = $row['title'];
        $standard['description'] = $row['description'];
        $standard['date_given'] = $row['date_given'];
        $standard['schoolyear_id'] = $row['schoolyear_id'];
		array_push($standards, $standard);
	}
	
	mysqli_stmt_close($stmt);
	return $standards;
}

function getStandard($id) {
	$standard = null;
	
	// Connect and initialize sql and prepared statement template
	$link = connect_db();
	$sql = "SELECT * FROM `standard` WHERE id = ? LIMIT 1";
	$stmt = $link->stmt_init();
	$stmt->prepare($sql);
	$stmt->bind_param('i', $id);
	$stmt->execute();
	$result = $stmt->get_result();

	// bind the result to $theBook for json encoding
	while ($row = $result->fetch_array(MYSQLI_BOTH)) {
		$standard['id'] = $row['id'];
		$standard['title'] = $row['title'];
        $standard['description'] = $row['description'];
		$standard['date_given'] = $row['date_given'];
		$standard['schoolyear_id'] = $row['schoolyear_id'];
	}
	
	mysqli_stmt_close($stmt);
	return $standard;
}

function addStandard($title, $description, $date_given, $schoolyear_id) {
    $link = connect_db();
	$sql = "INSERT INTO  `standard` (`title`, `description`, `date_given`, `schoolyear_id`) VALUES (?, ?, ?)";
	$stmt = $link->stmt_init();
	$stmt->prepare($sql);
	$stmt->bind_param('sssi', $link->real_escape_string($title), $link->real_escape_string($description), $link->real_escape_string($date_given), $schoolyear_id);
	$stmt->execute();
	$id = $link->insert_id;
	mysqli_stmt_close($stmt);
	$link->close();
	
	return $id;
}

function editStandard($id, $title, $description, $date_given) {
	$link = connect_db();
	$sql = "UPDATE  `standard` SET `title`=?, `date_given`=?, `description`=? WHERE id = ?";
	
	// Create prepared statement and bind parameters
	$stmt = $link->stmt_init();
	$stmt->prepare($sql);
	$stmt->bind_param('sssi', $link->real_escape_string($title), $link->real_escape_string($date_given), $link->real_escape_string($description), $id);
	
    // Execute the query, get the last inserted id
    $stmt->execute();
	$rows = $link->affected_rows;
	mysqli_stmt_close($stmt);
	$link->close();
    $standard = getStandard($id);
	
	return $standard;
}


?>