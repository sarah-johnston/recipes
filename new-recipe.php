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
        <script>
        function validateForm(){
            var name_valid = validateName();
            var amounts_valid = validateAmounts();
            
            return (name_valid && amounts_valid);
        }
        
        function showIngredientNinja(){
            ingredient = document.getElementById('new-ingredient-name').value = "";
            document.getElementById('new-ingredient-ninja').style.display='inline';
        }
        function hideIngredientNinja(){
            unit = document.getElementById('new-unit-name').value = "";
            document.getElementById('new-ingredient-ninja').style.display='none';
        }
        function showUnitNinja(){
            document.getElementById('new-unit-ninja').style.display='inline';
        }
        function hideUnitNinja(){
            document.getElementById('new-unit-ninja').style.display='none';
        }
        function addIngredient(){
            ingredient = document.getElementById('new-ingredient-name').value;
            alert(ingredient);
        }
        function addUnit(){
            unit = document.getElementById('new-unit-name').value;
            alert(unit);
        }
        
        function validateName(){
            var recipe_name = document.getElementById('input-recipe-name').value;
            if((recipe_name === "") || (recipe_name === null)){
                document.getElementById('recipe-name-required').style.display='inline';
                document.getElementById('input-recipe-name').style.background = "rgb(255, 204, 204)";
                return false;
            }
            else{
                document.getElementById('recipe-name-required').style.display='none';
                document.getElementById('input-recipe-name').style.background = "#f1f1f1";
                return true;
            }
            
        }
        function validateAmounts(){
            var amounts = document.querySelectorAll('#new-recipe .ingredient-amount');
            var amounts_valid = true;
            for (var i = 0; i < amounts.length; i++) {
                if((amounts[i].value === "")||(amounts[i].value === null)){ //|| isNaN(amounts[i])){    //this is failing! whyyy?
                    amounts[i].style.background = "rgb(255, 204, 204)";
                    amounts_valid = false;
                }
                else{
                    amounts[i].style.background = "#f1f1f1";
                }
            }
            if(!amounts_valid){
                document.getElementById('recipe-amounts-required').style.display='inline';
            }
            else{
                document.getElementById('recipe-amounts-required').style.display='none';
            }
            return amounts_valid;
        }
        
        </script>
    </head>
    <body>
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
                <br/>
                Ingredient:
                <input type="text" name="new_ingredient_name" id="new-ingredient-name">
                <button type="button" onclick="addIngredient($().value)">Add</button>
                <button type="button" onclick="hideIngredientNinja()">Cancel</button>
            </div>
            <div id="new-unit-ninja">
                <br/>
                Unit:
                <input type="text" name="new_unit_name" id="new-unit-name">
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
