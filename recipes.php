<!DOCTYPE html>
<html>
    <?php
        include("templates/header.php");
        include('helpers/recipeList.php');
        $log->info("Navigated to the Recipes page.");
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
        <div class="page">
            <div class="background-image"></div>
            <div id="recipes-list-page" class="page-body">
            <h1 class="title" id="recipes">Recipes</h1>
            <?php
            if($recipes_list != null){
            foreach($recipes_list as $recipe_id => $recipe_name){
            ?>
            <form action="recipe.php" method="GET" class="recipes">
                <input type="hidden" name="id" value="<?=$recipe_id?>" />
                <input class="recipe-link" type="submit" value="<?=$recipe_name?>"/>
            </form><br />
            <?php }} else{ ?>       
            <p class="no_results">0 results</p>
            <?php } ?>
            </div>
        </div>
    </body>
</html>
