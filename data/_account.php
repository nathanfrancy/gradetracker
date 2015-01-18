<?php

function validate($input_username, $input_password) {
	// Connect and initialize sql template
	$link = connect_db();
	$sql = "SELECT id FROM user WHERE BINARY username = ? AND BINARY password = ?";
	
	// Create prepared statement and bind passed in variables username and password
	$stmt = $link->stmt_init();
	$stmt->prepare($sql);
	$stmt->bind_param('ss', $link->real_escape_string($input_username), sha1($input_password));
	$userid = $stmt->execute();
	$userid = 0;
    $stmt->bind_result($userid);
	$stmt->fetch();
	
	if ($userid !== 0) {
		$_SESSION['auth_id'] = $userid;
	}
	
	mysqli_stmt_close($stmt);
	return $userid;
}

function getUser($id) {
	$user = null;
	
	// Connect and initialize sql and prepared statement template
	$link = connect_db();
	$sql = "SELECT * FROM user WHERE id = ? LIMIT 1";
	$stmt = $link->stmt_init();
	$stmt->prepare($sql);
	$stmt->bind_param('i', $id);
	$stmt->execute();
	$result = $stmt->get_result();

	// bind the result to $theBook for json encoding
	while ($row = $result->fetch_array(MYSQLI_BOTH)) {
		$user['id'] = $row['id'];
        $user['firstname'] = $row['firstname'];
        $user['lastname'] = $row['lastname'];
        $user['email'] = $row['email'];
        $user['username'] = $row['username'];
	}
	
	mysqli_stmt_close($stmt);
	return $user;
}

function createNewUser($firstname, $lastname, $email, $username, $password) {
    $link = connect_db();
	$sql = "INSERT INTO  `user` (`firstname`, `lastname`, `email`, `username`, `password`) VALUES (?, ?, ?, ?, ?)";
	$stmt = $link->stmt_init();
	$stmt->prepare($sql);
	$stmt->bind_param('sssss', 
                      $link->real_escape_string($firstname), 
                      $link->real_escape_string($lastname), 
                      $link->real_escape_string($email), 
                      $link->real_escape_string($username),
                      $link->real_escape_string(sha1($password)));
	$stmt->execute();
	$id = $link->insert_id;
	mysqli_stmt_close($stmt);
	$link->close();
    
    if ($id !== 0) {
		$_SESSION['auth_id'] = $id;
	}
	
	return $id;
}

function getOwnerOfSchoolYear($standard) {
    $owner_id = 0;
    $schoolyear_id = $standard['schoolyear_id'];
    
    // Connect and initialize sql and prepared statement template
	$link = connect_db();
	$sql = "SELECT * FROM schoolyear WHERE id = ? LIMIT 1";
	$stmt = $link->stmt_init();
	$stmt->prepare($sql);
	$stmt->bind_param('i', $schoolyear_id);
	$stmt->execute();
	$result = $stmt->get_result();

	while ($row = $result->fetch_array(MYSQLI_BOTH)) {
		$owner_id = $row['user_id'];
	}
	
	mysqli_stmt_close($stmt);
    
    return $owner_id;
}

?>