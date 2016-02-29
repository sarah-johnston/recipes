<!DOCTYPE html>
<html>
    <?php
    include("helpers/DAL.php");
    include('helpers/recipeCollectionPage.php');
    $db = new DAL();
    $collection = new recipeCollectionPage($db);
    $collection_name = $collection->getCurrentCollectionName();
    $collection_recipes = $collection->getCurrentCollectionRecipes();
    $collection_recipe_details = $collection->getCurrentCollectionRecipesDetails();
    $is_collection = True;

    ?>
    <head>
        <meta charset="UTF-8">
        <title><?=$collection_name?></title>
        <link rel="stylesheet" href="resources/styles.css">
    </head>
    <body>
        <?php include('templates/header.php'); ?>
        <article>
        <h1 id="collection-name"><?=$collection_name?></h1>
        <h3>Ingredients</h3>
        <?php 
        foreach ($collection_recipe_details as $recipe){
            $recipe_ingredients = $recipe["ingredients"];
            $recipe_name = $recipe["name"];
        ?>
        <table>
            <?php include("templates/ingredients.php")?>
        </table>
        <?php
        }
        ?>
        <h3 class="method">Method</h3>
        <?php
        foreach ($collection_recipe_details as $recipe){
            $recipe_method = $recipe["method"];
            $recipe_name = $recipe["name"];
        include("templates/method.php");
        }
        ?>
        </article>
    </body>
</html>
