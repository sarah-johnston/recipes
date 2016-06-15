<!DOCTYPE html>
<html>
    <?php
        include("templates/header.php");
        include('helpers/recipeList.php');
        $log->info("Navigated to the home page.");
        $recipes = new recipeList($db, $conn);
        $recipes_list = $recipes->generateRecipesList($recipes->getAllRecipes());
        $collections_list = $recipes->generateRecipeCollectionsList(
                $recipes->getAllRecipeCollections());
        ?>
    <head>
        <meta charset="UTF-8">
        <title>Recipes</title>
        <link rel="stylesheet" href="resources/styles.css">
    </head>
    <body>
        <div id="home-page">
        <?php
        include('templates/navigation-bar.php'); 
        ?>
        <h1 class="section" id="recipes">Recipes</h1>
        <?php
        foreach($recipes_list as $recipe_id => $recipe_name){
        ?>
        <form action="recipe.php" method="POST" class="recipes">
            <input type="hidden" name="id" value="<?=$recipe_id?>" />
            <input class="recipe-link" type="submit" value="<?=$recipe_name?>"/>
        </form><br />
        <?php 
        }
        ?>        
        <h1 class="section" id="recipe-collections">Recipe Collections</h1>
        <?php
        foreach($collections_list as $collection_id => $collection_name){
        ?>
        <form action="recipe-collection.php" method="POST" class="recipe-collections">
            <input type="hidden" name="id" value="<?=$collection_id?>" />
            <input class="recipe-collection-link" type="submit" value="<?=$collection_name?>"/>
        </form><br />
        <?php 
        } 
        ?>
        </div>
    </body>
</html>
