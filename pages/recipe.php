<!DOCTYPE html>
<html>
    <?php
    include("../helpers/DAL.php");
    include('../helpers/recipePage.php');
    $db = new DAL();
    $recipe = new recipePage($db);
    $is_collection = False;
    $recipe_name = $recipe->getCurrentRecipeName();
    $recipe_ingredients = $recipe->getCurrentIngredients();
    $recipe_method = $recipe->getCurrentMethod();
        ?>
    <head>
        <meta charset="UTF-8">
        <title><?=$recipe_name?></title>
        <link rel="stylesheet" href="../styles.css">
    </head>
    <body>
        <?php include('../templates/header.php'); ?>
        <article>
            <h1 id="recipe-name" class="title"><?=$recipe_name?></h1>
            <h3 class="heading" id="ingredients-heading">Ingredients</h3>
            <table id="ingredients">
                <?php include("../templates/ingredients.php")?>
            </table>
            <h3 class="heading" id="method-heading">Method</h3>
            <?php include("../templates/method.php")?>
        </article>
    </body>
</html>
