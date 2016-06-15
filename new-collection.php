<!DOCTYPE html>
<html>
    <?php
    include("templates/header.php");
    include("helpers/newRecipe.php");
    $log->info("Navigated to the New Recipe Collection page.");
    $recipe = new newRecipe($db, $conn);
    $ingredients = $recipe->generateIngredientsList();
    $units = $recipe->generateUnitsList();
    ?>
    <head>
        <meta charset="UTF-8">
        <title>Create New Recipe Collection</title>
        <link rel="stylesheet" href="resources/styles.css">
    </head>
    <body>
        <?php include('templates/navigation-bar.php'); ?>
        <div id="new-recipe-collection-page">
            <div id="overlay"></div>
            <h1 class="title">Create New Recipe Collection</h1>
            
            </div>
        </div>
    </body>
</html
