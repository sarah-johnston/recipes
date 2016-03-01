<!DOCTYPE html>
<html>
    <?php 
    include("templates/header.php");
    include('helpers/searchResults.php');
    $search_results = new searchResults($db, $conn);
    $recipes_list = $search_results->generateRecipesList($search_results->getRecipesSearchResults());
    $collections_list = $search_results->generateRecipeCollectionsList(
            $search_results->getCollectionsSearchResults());
    ?>
    <head>
        <meta charset="UTF-8">
        <title>Search Results</title>
        <link rel="stylesheet" href="resources/styles.css">
    </head>
    <body>
        <?php include('templates/navigation-bar.php'); ?>
        <h1>Search Results</h1>
        <h2 value="<?=$search_text?>" />
        <h3 class="section" id="recipes">Recipes</h3>
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
        <h3 class="section" id="recipe-collections">Recipe Collections</h3>
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
