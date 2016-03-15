<!DOCTYPE html>
<html>
    <?php
        include("templates/header.php");
        include("helpers/newRecipe.php");
        $log->info("Navigated to the New Recipe page.");
        $recipe = new newRecipe($db, $conn);
        $ingredients = $recipe->generateIngredientsList();
        $units = $recipe->generateUnitsList();
        ?>
    <head>
        <meta charset="UTF-8">
        <title>New Recipe</title>
        <link rel="stylesheet" href="resources/styles.css">
        <script src="resources/newRecipeHelpers.js"></script>
    </head>
    <body>
        <div id="overlay"></div>
        <?php include('templates/navigation-bar.php'); ?>
        <h1 class="title">New Recipe</h1>
        <form id="new-recipe" name="new-recipe-form" action="recipe-created.php" method="POST" onsubmit="return validateForm();">
            <div id="name">
                <h3 id="new-recipe-name">Recipe Name:</h3>
                <input type="text" name="recipe_name" id="input-recipe-name"/>
                <p id="recipe-name-required">* Recipe name is a required field.</p>
            </div>
            <h3 class="new-recipe-ingredients" id="new-recipe-ingredients">Ingredients:</h3>
            <p id="recipe-amounts-required">* Recipe amounts are required fields.</p>
            <?php include("templates/add-new-ingredients.php");?>
            
            <!--TODO: implement this feature!-->
            <button id="create-ingredient" type="button" value="Add a new ingredient" onclick="showIngredientNinja()">Add a new ingredient</button>
            <button id="create-unit" type="button" value="Add a new unit" onclick="showUnitNinja()">Add a new unit</button>
            <!--might need to be a form. -->
            <!-- also might need to change the ingredient dropdowns to use javascript so new ingredients are added without reload-->
            <div id="new-ingredient-ninja">
                <h3>Add a new ingredient</h3>
                Ingredient:
                <input type="text" name="new_ingredient_name" id="new-ingredient-name"><br/>   
                Plural of ingredient:
                <input type="text" name="new_ingredient_name_plural" id="new-ingredient-name-plural"><br/>   
                <button type="button" onclick="addIngredient($().value)">Add</button>
                <button type="button" onclick="hideIngredientNinja()">Cancel</button>
            </div>
            <div id="new-unit-ninja">
                <h3>Add a new unit</h3>
                Unit:
                <input type="text" name="new_unit_name" id="new-unit-name">
                <br/>
                Unit type:
                <select id="new-unit-type" name="new_unit_type">
                    <option value="volume">Volume</option>
                    <option value="mass">Mass</option>
                </select>
                <br/>   
                Unit to SI amount:
                <input type="text" name="new_unit_to_si" id="new-unit-to-si">
                <br/>   
                <button type="button" onclick="addUnit()">Add</button>
                <button type="button" onclick="hideUnitNinja()">Cancel</button>
            </div>
            <h3 class="new-recipe-method">Method:</h3>
            <textarea name="recipe_method" id="input-recipe-method"></textarea>
            <input type="submit" name="submit" value="Submit" id="submit-new-recipe" onclick="removeHiddenElements()">
        </form>
        <table>
            <tr id="new-table-row" class="new-ingredient">
                <?php include("templates/new-ingredient-row.php")?>
            </tr>
        </table>
    </body>
</html
