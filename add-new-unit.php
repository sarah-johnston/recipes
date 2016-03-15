<?php
include("templates/header.php");

$log->info("Adding a new unit.");

if(isset($_POST['unit_name'])){
    $unit_name = $_POST['unit_name'];
}
else{
    $unit_name = "";
}
if(isset($_POST['unit_type'])){
    $unit_type = $_POST['unit_type'];
}
else{
    $unit_type = "";
}
if(isset($_POST['unit_to_si'])){
    $unit_to_si = $_POST['unit_to_si'];
}
 else {
     $unit_to_si = "";
 }
 $log->debug("Unit name: " . $unit_name);
 $log->debug("Unit type: " . $unit_type);
 $log->debug("Unit to SI percentage: " . $unit_to_si);

include("helpers/newRecipe.php");
$recipe = new newRecipe($db, $conn); 

$recipe->addNewUnit($unit_name, $unit_type, $unit_to_si);
 
