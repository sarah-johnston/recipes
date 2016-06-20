<!DOCTYPE html>
<html>
    <?php
        include("templates/header.php");
        include('helpers/recipeCollectionPage.php');
        $collection = new recipeCollectionPage($db, $conn);
        $collection_name = $collection->getCurrentCollectionName();
        $log->info("Navigated to the Recipe Collection page for '" . $collection_name . "'");
        $collection_recipe_details = $collection->getCurrentCollectionRecipesDetails();
        $is_collection = True;
    ?>
    <head>
        <meta charset="UTF-8">
        <title><?=$collection_name?></title>
        <link rel="stylesheet" href="resources/styles.css">
    </head>
    <body>
        <?php include('templates/navigation-bar.php'); ?>
        <div class="page">
            <div class="background-image"></div>
            <div id="recipe-collection" class="page-body">
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
            <form action="collection-deleted.php" method="POST" 
                  onSubmit="return confirm('Are you sure you want to delete this recipe collection? This will not delete the individual recipes in the collection.')">
                <input type="hidden" name="delete_recipe_collection" value="<?=$collection->getCurrentCollectionId()?>" />
               <button id="delete-recipe-collection" type="submit" name="submit">Delete collection</button>
            </form>
            </div>
        </div>
    </body>
</html>
