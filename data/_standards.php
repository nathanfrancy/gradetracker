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
        $standard['date_given'] = $row['date_given'];
        $standard['schoolyear_id'] = $row['schoolyear_id'];
		array_push($standards, $standard);
	}
	
	mysqli_stmt_close($stmt);
	return $standards;
}

?>