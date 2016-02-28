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
        <h1 class="title" id="recipe-collections">Recipe Collections</h1>
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
    </body>
</html>
