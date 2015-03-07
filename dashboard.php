<?php 
session_start();

$user = null;
if ( isset($_SESSION['auth_id']) && ($_SESSION['auth_id'] != 0) ) {
    require('data/master.php');
    $user = getUser($_SESSION['auth_id']);
    if ($user['type'] === "admin") {
        header("Location: dashboard-admin.php");
    }

    /* Cookie checking to make sure you are who you say you are. */
    //setcookie("token", "Nathan", time() + (20 * 365 * 24 * 60 * 60), "/", NULL);
    //$_COOKIE['username'] = "Nathan";
    $token = $_COOKIE['auth_token'];
    if ($token === $user['token']) {
        // Ok
        // Get the user's theme, and make sure it is one of the default themes, if not resolve to "bootstrap" default template
        // TODO: eventually fix the user's profile to be set back to default if something goes wrong
        $bootswatch_whitelist = array("cerulean", "cosmo", "cyborg", "darkly","flatly", "journal", "lumen", "paper", "readable", "sandstone", "simplex", "slate", "spacelab", "superhero", "united", "yeti");
        $theme = $user['theme'];
        if (!in_array($theme, $bootswatch_whitelist)) { $theme = "bootstrap"; }
    }
    else {
        header("Location: logout.php");
    }
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
    <link id="boots_theme" href="assets/vendor/css/bootswatch/<?php echo $theme; ?>.css" rel="stylesheet">

    <!-- Custom CSS -->
    <!--<link href="assets/vendor/css/sb-admin.css" rel="stylesheet">-->
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
    <script src="assets/js/controllers/accountController.js"></script>
    <script src="assets/js/controllers/dashboardController.js"></script>
    <script src="assets/js/controllers/schoolYearController.js"></script>
    <script src="assets/js/controllers/studentController.js"></script>
    <script src="assets/js/controllers/standardController.js"></script>
    
    <!-- Angular custom plugins -->
    <script src="assets/js/plugins/datepicker.js"></script>
    
</head>

<body>
    
    <!-- Navbar -->
    <?php require('partials/navbar.php'); ?>
    
    <!-- Wrapper for the views -->
    <div id="wrapper" class="container-fluid">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div ng-view></div>
            </div>
        </div>
    </div>

</body>

</html>