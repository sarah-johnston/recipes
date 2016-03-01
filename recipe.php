<!DOCTYPE html>
<html>
    <?php
    include("templates/header.php");
    include('helpers/recipePage.php');
    $log->info("Navigated to a Recipe page.");
    $recipe = new recipePage($db, $conn);
    $is_collection = False;
    $recipe_name = $recipe->getCurrentRecipeName();
    $log->info("Recipe name: " . $recipe_name);
    $recipe_ingredients = $recipe->getCurrentIngredients();
    $recipe_method = $recipe->getCurrentMethod();
        ?>
    <head>
        <meta charset="UTF-8">
        <title><?=$recipe_name?></title>
        <link rel="stylesheet" href="resources/styles.css">
    </head>
    <body>
        <?php include('templates/navigation-bar.php'); ?>
        <article>
            <h1 id="recipe-name" class="title"><?=$recipe_name?></h1>
            <h3 class="heading" id="ingredients-heading">Ingredients</h3>
            <table id="ingredients">
                <?php include("templates/ingredients.php")?>
            </table>
            <h3 class="heading" id="method-heading">Method</h3>
            <?php include("templates/method.php")?>
        </article>
    </body>
</html>