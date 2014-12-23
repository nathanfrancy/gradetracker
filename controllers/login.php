<?php
session_start();

require('../data/master.php');

$controllerType = null;
if (isset($_POST['controllerType'])) {
    $controllerType = $_POST['controllerType'];
}

if ($controllerType != null) {
    
    if ($controllerType === 'login') {
		$response = null;
		
		// variable keeps track of whether data is valid
		$valid = true;
		
		// variables that checking for login, and updating $valid if one of them isn't set
		$username = $_POST['username'];
		$valid = isset($_POST['username']);
		$password = $_POST['password'];
		$valid = isset($_POST['password']);
		
		if ($valid) {
			$userid = validate($username, $password);
			
			if ($userid != 0) {
				$response['message'] = "valid";
				$response['id'] = $userid;
			}
			else {
				$response['message'] = "Invalid username and/or email account.";
				$response['id'] = 0;
			}
		}
		else {
			$response['message'] = "Missing username and/or email.";
            $response['id'] = 0;
		}
		
		echo json_encode($response);
	}
    
}