<!DOCTYPE html>
<html>
    <?php
        include("templates/header.php");
        include('helpers/recipeList.php');
        $recipes = new recipeList($db, $conn);
        $recipes_list = $recipes->generateRecipesList($recipes->getAllRecipes());
        ?>
    <head>
        <meta charset="UTF-8">
        <title>Recipes</title>
        <link rel="stylesheet" href="resources/styles.css">
    </head>
    <body>
        <?php include('templates/navigation-bar.php'); ?>
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
