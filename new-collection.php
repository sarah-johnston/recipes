<!DOCTYPE html>
<html>
    <?php
    include("templates/header.php");
    include("helpers/newRecipeCollection.php");
    $log->info("Navigated to the New Recipe Collection page.");
    $collection = new newRecipeCollection($db, $conn);
    $recipes = $collection->generateRecipesList();
    ?>
    <head>
        <meta charset="UTF-8">
        <title>Create New Recipe Collection</title>
        <link rel="stylesheet" href="resources/styles.css">
        <script src="resources/newRecipeCollectionHelpers.js"></script>
        <script src="resources/jquery-1.12.1.min.js"></script>
        <script>
        $(function () {
            $("#add-new-recipe").click(function () {
                $('#new-recipe-row select').attr('class', 'input-recipe');
                $('#new-recipe-row').clone().show().appendTo('#recipes-list')
                        .removeAttr('id').removeAttr('style');
                $('#new-recipe-row select').removeAttr('class');
            });
            $("#recipes-list").on('click', '.delete-recipe', function () {
                $(this).closest('div.new-recipe').remove();
            });
        });
    </script>
    </head>
    <body>
        <?php include('templates/navigation-bar.php'); ?>
        <div class="page">
            <div class="background-image"></div>
            <div id="new-recipe-collection-page" class="page-body">
                <div id="overlay"></div>
                <h1 class="title">Create New Recipe Collection</h1>
                <form id="new-recipe-collection" name="new-collection-form" action="collection-created.php" method="POST" onsubmit="return validateCollectionForm();">
                    <div id="name">
                        <h3 id="new-collection-name">Collection Name:</h3>
                        <input type="text" name="collection_name" id="input-collection-name"/>
                        <p id="collection-name-required">* Collection name is a required field.</p>                        
                    </div>
                    <div id="recipes">
                    <h3 class="new-collection-recipes" id="new-collection-recipes">Recipes:</h3>                    
                    <p id="no-duplicate-recipes">* Cannot have the same recipe more than once in a collection.</p>
                    <div id="recipes-list">
                        <div class="new-recipe">
                            <?php include("templates/new-recipe-row.php") ?>
                        </div>
                    </div>
                    <div id="add-new-recipe">&#43;</div>
                    <br>
                    </div>
                    <input type="submit" name="submit" value="Submit" id="submit-new-recipe-collection" onclick="removeHiddenElements()">
                </form>
                <div id="new-recipe-row" class="new-recipe">
                    <select name="recipes[]">
                        <?php foreach ($recipes as $recipe_id => $recipe_name) {?>
                        <option class="recipe-ingredient-option" value="<?=$recipe_id?>"><?=$recipe_name?></option>
                        <?php }?>
                    </select>
                    <div class="delete-recipe">x</div>
                </div>
            </div>
        </div>
    </body>
</html
