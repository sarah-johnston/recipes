<?php
include("templates/header.php");

$log->info("Adding a new ingredient.");

if(isset($_POST['ingredient_name'])){
    $ingredient_name = $_POST['ingredient_name'];
}
else{
    $ingredient_name = "";
}
if(isset($_POST['ingredient_plural'])){
    $ingredient_plural = $_POST['ingredient_plural'];
}
else{
    $ingredient_plural = "";
}
 $log->debug("Ingredient name: " . $ingredient_name);
 $log->debug("Ingredient name plural: " . $ingredient_plural);

include("helpers/newRecipe.php");
$recipe = new newRecipe($db, $conn); 

$recipe->addNewIngredient($ingredient_name, $ingredient_plural);
 
