<!DOCTYPE html>
<html>
    <?php
        include("templates/header.php");
        include("helpers/newRecipe.php");
        $log->info("Navigated to the New Recipe page.");
        $recipe = new newRecipe($db, $conn);
        $ingredients = $recipe->generateIngredientsList();
        $units = $recipe->generateUnitsList();
        ?>
    <head>
        <meta charset="UTF-8">
        <title>New Recipe</title>
        <link rel="stylesheet" href="resources/styles.css">
    </head>
    <body>
        <?php include('templates/navigation-bar.php'); ?>
        <h1 class="title">New Recipe</h1>
        <form id="new-recipe">
            <div id="name">
                <h3 id="new-recipe-name">Recipe Name:</h3>
                <input type="text" name="recipe_name" id="input-recipe-name"/>
            </div>
            <h3 class="new-recipe-ingredients">Ingredients:</h3>
            <?php include("templates/add-new-ingredients.php");?>
            <h3 class="new-recipe-method">Method:</h3>
            <textarea name="recipe-method" id="input-recipe-method"></textarea>
            <input type="submit" value="Submit" id="submit-new-recipe">
        </form>
    </body>
</html
