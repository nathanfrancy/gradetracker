<?php

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    if (!is_int($id)) {
        include('data/master.php');?>
    

<!doctype html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="assets/vendor/css/bootstrap.min.css">
    </head>
    <body>
        
    </body>
</html>

<?php printStandardScores($id);
    }
    else {
        echo "id value is invalid";
    }
}
else {
    echo "No id specified.";
}

?>