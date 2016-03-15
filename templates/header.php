<?php
    include("helpers/database.php");
    if(!isset($log)){
        $log = Logger::getLogger("general");
    }
    if(!isset($conn)){
        $db = new database();
        $conn = $db->connectToDatabase();
    }
?>
<link rel="icon" type="image/ico" href="resources/octopus-icon.png">