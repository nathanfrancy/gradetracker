<?php 
session_start();
$user = null;
if ( isset($_SESSION['auth_id']) && ($_SESSION['auth_id'] != 0) ) {
    require('data/master.php');
    $user = getUser($_SESSION['auth_id']);
}
else {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en" ng-app="dashboardApp">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>

    <!-- Bootstrap Core CSS -->
    <link href="assets/vendor/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="assets/vendor/css/sb-admin.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <!-- jQuery -->
    <script src="assets/vendor/js/jquery.min.js"></script>
    
    <!-- Angular -->
    <script src="assets/vendor/js/angular.min.js"></script>
    <script src="assets/vendor/js/angular-route.min.js"></script>
    <script src="assets/vendor/js/angular-ui-bootstrap.min.js"></script>
    
    <!-- Angular custom app -->
    <script src="assets/js/dashboardApp.js"></script>

    <!-- Angular custom services -->
    <script src="assets/js/services.js"></script>
    
    <!-- Angular custom controllers -->
    <script src="assets/js/controllers/dashboardController.js"></script>
    <script src="assets/js/controllers/schoolYearController.js"></script>
    <script src="assets/js/controllers/studentController.js"></script>
    
</head>

<body>
    <div id="wrapper">

        <!-- Navbar -->
        <?php require('partials/navbar.php'); ?>

        <div id="page-wrapper">
            <div class="container-fluid">
                <div ng-view></div>
            </div>
        </div>
    </div>

</body>

</html>
