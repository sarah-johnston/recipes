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