<!DOCTYPE html>
<html>
    <?php
        include("templates/header.php");
        include('helpers/recipeList.php');
        $log->info("Navigated to the Recipe Collections page.");
        $collections = new recipeList($db, $conn);
        $collections_list = $collections->generateRecipeCollectionsList(
                $collections->getAllRecipeCollections());
        ?>
    <head>
        <meta charset="UTF-8">
        <title>Recipes</title>
        <link rel="stylesheet" href="resources/styles.css">
    </head>
    <body>
        <?php include('templates/navigation-bar.php'); ?>
        <div class="page">
            <div class="background-image"></div>
            <div id="recipe-collections-page" class="page-body">
            <h1 class="title" id="recipe-collections">Recipe Collections</h1>
            <?php
            if($collections_list!=null){
            foreach($collections_list as $collection_id => $collection_name){
            ?>
            <form action="recipe-collection.php" method="GET" class="recipe-collections">
                <input type="hidden" name="id" value="<?=$collection_id?>" />
                <input class="recipe-collection-link" type="submit" value="<?=$collection_name?>"/>
            </form><br />
            <?php }} else{?>
            <p class="no_results">0 results</p>
            <?php } ?>
            </div>
        </div>
    </body>
</html>
