<!DOCTYPE html>
<html>
    <?php 
    include("templates/header.php");
    include('helpers/searchResults.php');
    $log->info("Navigated to the Search Results page.");
    $search_results = new searchResults($db, $conn);
    $recipes_list = $search_results->generateRecipesList($search_results->getRecipesSearchResults());
    $collections_list = $search_results->generateRecipeCollectionsList(
            $search_results->getCollectionsSearchResults());
    $search_term = $_GET['search_text'];
    ?>
    <head>
        <meta charset="UTF-8">
        <title>Search Results</title>
        <link rel="stylesheet" href="resources/styles.css">
    </head>
    <body>
        <?php include('templates/navigation-bar.php'); ?>
        <div class="page">
            <div class="background-image"></div>
            <div id="search-results-page" class="page-body">
            <p id="search-results-for">Search results for "<?=$search_term?>"</p>
            <h3 class="section" id="recipes">Recipes</h3>
            <?php
            if($recipes_list != null){
            foreach($recipes_list as $recipe_id => $recipe_name){
            ?>
            <form action="recipe.php" method="GET" class="recipes">
                <input type="hidden" name="id" value="<?=$recipe_id?>" />
                <input class="recipe-link" type="submit" value="<?=$recipe_name?>"/>
            </form><br />
            <?php 
            }}
            else{ ?>   
            <p class="no_results">0 results</p>
            <?php } ?>
            <h3 class="section" id="recipe-collections">Recipe Collections</h3>
            <?php
            if($collections_list != null){
            foreach($collections_list as $collection_id => $collection_name){
            ?>
            <form action="recipe-collection.php" method="GET" class="recipe-collections">
                <input type="hidden" name="id" value="<?=$collection_id?>" />
                <input class="recipe-collection-link" type="submit" value="<?=$collection_name?>"/>
            </form><br />
            <?php }}
            else{ ?>
            <p class="no_results">0 results</p>
            <?php } ?>
            </div>
        </div>
    </body>
</html>
