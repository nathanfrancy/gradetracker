<?php

function getAllSchoolYears($user_id) {
    $schoolyears = array();
	
	// Connect and initialize sql and prepared statement template
	$link = connect_db();
	$sql = "SELECT * FROM `schoolyear` WHERE `user_id` = ? ORDER BY `id`";
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

?>