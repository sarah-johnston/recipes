<!DOCTYPE html>
<html>
    <?php
        include("../helpers/DAL.php");
        include('../helpers/recipeList.php');
        $db = new DAL();
        $recipes = new recipeList($db);
        $recipes_list = $recipes->generateRecipesList();
        $collections_list = $recipes->generateRecipeCollectionsList();
        ?>
    <head>
        <meta charset="UTF-8">
        <title>Recipes</title>
        <link rel="stylesheet" href="../styles.css">
    </head>
    <body>
        <?php include('../templates/header.php'); ?>
        <h1 class="title" id="recipes">Recipes</h1>
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
    </body>
</html>
