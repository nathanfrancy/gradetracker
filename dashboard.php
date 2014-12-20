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
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="assets/vendor/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="assets/vendor/css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
</head>

<body>
    <div id="wrapper">

        <!-- Navbar -->
        <?php require('partials/navbar.php'); ?>

        <div id="page-wrapper">
            <div class="container-fluid">
                
                <h1 class="page-header">Dashboard <small>Account Overview</small></h1>
                
                <br><br><br><br><br><br><br>
                <br><br><br><br><br><br><br><br>
                <br><br><br><br><br><br><br><br>
                <br><br><br><br><br><br><br><br>
                <br><br><br><br><br><br><br><br>
                <br><br><br><br><br><br><br><br>
                
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="assets/vendor/js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="assets/vendor/js/bootstrap.min.js"></script>
    
    <script>$("#dashboard").addClass("active");</script>

</body>

</html>
