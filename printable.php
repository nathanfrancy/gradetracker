<?php
session_start();

if (isset($_SESSION['auth_id'])) {

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        
        if (!is_int($id)) {
            
            /*******
             At this point, everything is good to go, can 
             include the data/master script and try to resolve 
             the standard scores
            ********/
            
            include('data/master.php');

            // Get the user, check for the theme and correct if necessary
            $user = getUser($_SESSION['auth_id']);
            $bootswatch_whitelist = array("cerulean", "cosmo", "cyborg", "darkly","flatly", "journal", "lumen", "paper", "readable", "sandstone", "simplex", "slate", "spacelab", "superhero", "united", "yeti");
            $theme = $user['theme'];
            if (!in_array($theme, $bootswatch_whitelist)) { $theme = "bootstrap"; }
?>
<!doctype html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="assets/vendor/css/bootswatch/<?php echo $theme; ?>.css">
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
}
else {
    echo "Not authorized to view this page.";
}

?>