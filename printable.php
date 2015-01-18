<?php
session_start();

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    if (!is_int($id)) {
        
        /*******
         At this point, everything is good to go, can 
         include the data/master script and try to resolve 
         the standard scores
        ********/
        
        include('data/master.php');
?>
<!doctype html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="assets/vendor/css/bootstrap.min.css">
        <style>
            * { -webkit-print-color-adjust: exact; }
        </style>
    </head>
    <body>
        <div class="container">
            <?php printStandardScores($id); ?>
        </div>
    </body>
</html>

<?php
    }
    else { // Id value isn't an integer value
        echo "id value is invalid";
    }
}
else { // Missing id value in request
    echo "No id specified.";
}

?>