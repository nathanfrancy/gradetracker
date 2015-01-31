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
	
	mysqli_stmt_close($stmt);
	return $userid;
}

function checkPassword($try) {
	$password_encrypted = null;
	
	// Connect and initialize sql and prepared statement template
	$link = connect_db();
	$sql = "SELECT password FROM user WHERE id = ? LIMIT 1";
	$stmt = $link->stmt_init();
	$stmt->prepare($sql);
	$stmt->bind_param('i', $_SESSION['auth_id']);
	$stmt->execute();
	$result = $stmt->get_result();

	// bind the result to $theBook for json encoding
	while ($row = $result->fetch_array(MYSQLI_BOTH)) {
		$password_encrypted = $row['password'];
	}
	mysqli_stmt_close($stmt);

	if (sha1($try) === $password_encrypted) {
		return TRUE;
	}
	return FALSE;
}

function updateToken() {
	// Check if auth_id and submitted id match. If so, go ahead and perform update
	if (isset($_SESSION['auth_id'])) {
		$new_token = generate_random_string(50);
		$link = connect_db();
		$sql = "UPDATE  `user` SET `token`=? WHERE id = ?";
		
		// Create prepared statement and bind parameters
		$stmt = $link->stmt_init();
		$stmt->prepare($sql);
		$stmt->bind_param('si', $new_token, $_SESSION['auth_id']);
	    $stmt->execute();
		mysqli_stmt_close($stmt);
		$link->close();
		set_cookie('auth_token', $new_token);
	}
}

function changePassword($oldpassword, $newpassword) {
	$is_valid = checkPassword($oldpassword);
	if ($is_valid === TRUE) {
		$link = connect_db();
		$sql = "UPDATE  `user` SET `password`=? WHERE id = ?";
		$stmt = $link->stmt_init();
		$stmt->prepare($sql);
		$stmt->bind_param('si', sha1($link->real_escape_string($newpassword)), $_SESSION['auth_id']);
		$stmt->execute();
		$result = $stmt->get_result();
		mysqli_stmt_close($stmt);
		return TRUE;
	}
	else {
		return FALSE;
	}
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
        $user['theme'] = $row['theme'];
        $user['token'] = $row['token'];
        $user['type'] = $row['type'];
	}
	
	mysqli_stmt_close($stmt);
	return $user;
}

function createNewUser($firstname, $lastname, $email, $username, $password) {
    $first_token = generate_random_string(50);
    $link = connect_db();
	$sql = "INSERT INTO  `user` (`firstname`, `lastname`, `email`, `username`, `password`, `theme`, `token`) VALUES (?, ?, ?, ?, ?, 'yeti', ?)";
	$stmt = $link->stmt_init();
	$stmt->prepare($sql);
	$stmt->bind_param('ssssss', 
                      $link->real_escape_string($firstname), 
                      $link->real_escape_string($lastname), 
                      $link->real_escape_string($email), 
                      $link->real_escape_string($username),
                      $link->real_escape_string(sha1($password)),
                      $first_token);
	$stmt->execute();
	$id = $link->insert_id;
	mysqli_stmt_close($stmt);
	$link->close();

    if ($id !== 0) {
		$_SESSION['auth_id'] = $id;
		set_cookie('auth_token', $first_token);
	}
	
	return $id;
}

function editUser($id, $firstname, $lastname, $email, $username, $theme) {
	// Check if auth_id and submitted id match. If so, go ahead and perform update
	if ($id === $_SESSION['auth_id']) {
		$link = connect_db();
		$sql = "UPDATE  `user` SET `firstname`=?, `lastname`=?, `email`=?, `username`=?, `theme`=? WHERE id = ?";
		
		// Create prepared statement and bind parameters
		$stmt = $link->stmt_init();
		$stmt->prepare($sql);
		$stmt->bind_param('sssssi', 
			$link->real_escape_string($firstname), 
			$link->real_escape_string($lastname), 
			$link->real_escape_string($email), 
			$link->real_escape_string($username), 
			$link->real_escape_string($theme), 
			$_SESSION['auth_id']);
		
	    // Execute the query, get the last inserted id
	    $stmt->execute();
		$rows = $link->affected_rows;
		mysqli_stmt_close($stmt);
		$link->close();
	    $student = getStudent($id);
		
		return "Successfully edited {$firstname} {$lastname}.";
	}
	else {
		return "You are not logged into the account you are trying to edit.";
	}
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

function getAllUsersSortedByType() {
	$response = null;
    $users = array();
	
	// Connect and initialize sql and prepared statement template
	$link = connect_db();
	$sql = "SELECT * from `user`";
	$stmt = $link->stmt_init();
	$stmt->prepare($sql);
    //$stmt->bind_param('ii', $standard_id, $schoolyear_id);
	$stmt->execute();
	$result = $stmt->get_result();
	
	// Bind result to Book object and push each one on the end of $books array
    while ($row = $result->fetch_array(MYSQLI_BOTH)) {
        $user['id'] = $row['id'];
		$user['firstname'] = $row['firstname'];
        $user['lastname'] = $row['lastname'];
        $user['email'] = $row['email'];
        $user['username'] = $row['username'];
        $user['theme'] = $row['theme'];
        $user['type'] = $row['type'];

        array_push($users, $user);
	}
	$response = $users;
	
	mysqli_stmt_close($stmt);
	return $response;
}

function insertLoginAttempt($outcome, $user_id, $tried_username) {
    $date_tried = date("Y-m-j H:i:s");
    $ip_remote = $_SERVER['REMOTE_ADDR'];
    $ip_forwarded = "not provided";
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) { 
    	$ip_forwarded = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    $link = connect_db();
	$sql = "INSERT INTO  `login_attempt` (`date_tried`, `outcome`, `username_tried`, `ip_address_forwarded`, `ip_address_remote`, `user_id`) VALUES (?,?,?,?,?,?)";
	$stmt = $link->stmt_init();
	$stmt->prepare($sql);
	$stmt->bind_param('sssssi', 
					  $date_tried,
					  $link->real_escape_string($outcome),
					  $link->real_escape_string($tried_username),
					  $ip_forwarded,
					  $ip_remote,
                      $user_id);
	$stmt->execute();
	$id = $link->insert_id;
	mysqli_stmt_close($stmt);
	$link->close();
}

?>