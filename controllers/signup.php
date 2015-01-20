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
        $firstname = $_POST['firstname'];
		$valid = isset($_POST['firstname']) && $_POST['firstname'] !== "";
        $lastname = $_POST['lastname'];
		$valid = isset($_POST['lastname']) && $_POST['lastname'] !== "";
        $email = $_POST['email'];
		$valid = isset($_POST['email']) && $_POST['email'] !== "";
        $username = $_POST['username'];
		$valid = isset($_POST['username']) && $_POST['username'] !== "";
        $password = $_POST['password'];
		$valid = isset($_POST['password']) && $_POST['password'] !== "";
		
		if ($valid) {
			$userid = createNewUser($firstname, $lastname, $email, $username, $password);
			
			if ($userid != 0) {
				$response['message'] = "valid";
				$response['id'] = $userid;
				$_SESSION['auth_id'] = $userid;
				updateToken();
			}
			else {
				$response['message'] = "Invalid username and/or password.";
				$response['id'] = 0;
			}
		}
		else {
			$response['message'] = "Missing username and/or password.";
            $response['id'] = 0;
		}
		
		echo json_encode($response);
	}
    
}
?>