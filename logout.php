<?php

session_start();
session_destroy();
unset($_SESSION['auth_id']);
header("Location: index.php");

?>