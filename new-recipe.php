<!DOCTYPE html>
<html>
    <?php
    include("templates/header.php");
    include("helpers/newRecipe.php");
    $log->info("Navigated to the New Recipe page.");
    $recipe = new newRecipe($db, $conn);
        $ingredients = $recipe->generateIngredientsList();
    $units = $recipe->generateUnitsList();
    $unit_types = $recipe->generateUnitTypesList();
    ?>
    <head>
        <meta charset="UTF-8">
        <title>Add New Recipe</title>
        <link rel="stylesheet" href="resources/styles.css">
        <script src="resources/newRecipeHelpers.js"></script>
        <script src="resources/jquery-1.12.1.min.js"></script>
        <script>
        $(function () {
            $("#add-new-ingredient").click(function () {
                $('#new-table-row').clone().show().appendTo('#ingredients-table')
                        .removeAttr('id').removeAttr('style');
            });
            $("#ingredients-table").on('click', '.delete-ingredient', function () {
                $(this).closest('tr').remove();
            });
            $(".add-ingredient-input").keydown(function (e) {
                if (e.keyCode == 13)  // the enter key code
                {
                    $('#add-ingredient-button').click();
                    return false;
                }
                if (e.keyCode == 27)  // the escape key code
                {
                    $('#cancel-add-ingredient').click();
                    return false;
                }
            });
            $(".add-unit-input").keydown(function (e) {
                if (e.keyCode == 13)  // the enter key code
                {
                    $('#add-unit-button').click();
                    return false;
                }
                if (e.keyCode == 27)  // the escape key code
                {
                    $('#cancel-add-unit').click();
                    return false;
                }
            });
        });
    </script>
    </head>    
    <body>
        <?php include('templates/navigation-bar.php'); ?>
        <div class="page">
            <div class="background-image"></div>
            <div id="new-recipe-page" class="page-body">
                <div id="overlay"></div>
                <h1 class="title">Add New Recipe</h1>
                <form id="new-recipe" name="new-recipe-form" action="recipe-created.php" method="POST" onsubmit="return validateForm();">
                    <div id="name">
                        <h3 id="new-recipe-name">Recipe Name:</h3>
                        <input type="text" name="recipe_name" id="input-recipe-name"/>
                        <p id="recipe-name-required">* Recipe name is a required field.</p>
                    </div>
                    <h3 class="new-recipe-ingredients" id="new-recipe-ingredients">Ingredients:</h3>
                    <p id="recipe-amounts-required">* Recipe amounts are required fields.</p>
                    <p id="recipe-amounts-numerical">* Recipe amounts must be numbers.</p>
                    <table id="ingredients-table" width="350px" border="1">
                        <tr class="table-headings">
                            <td>Ingredient</td>
                            <td>Amount</td>
                            <td>Unit</td>
                        </tr>
                        <tr class="new-ingredient">
                            <?php include("templates/new-ingredient-row.php") ?>
                        </tr>
                    </table>
                    <div id="add-new-ingredient">&#43;</div>
                    <br>
                    <div id="recipe-method">
                    <h3 class="new-recipe-method">Method:</h3>
                    <textarea name="recipe_method" id="input-recipe-method"></textarea>
                    </div>
                    <input type="submit" name="submit" value="Submit" id="submit-new-recipe" onclick="removeHiddenElements()">
                </form>
                <button id="create-ingredient" type="button" value="Add New Ingredient" onclick="showIngredientForm()">Add New Ingredient</button>
                <div id="new-ingredient-form">

                    <h3>Add a new ingredient</h3>
                    <p id="new-ingredient-name-required">* Ingredient name is a required field.</p>
                    <p id="new-ingredient-name-text">* Invalid ingredient name</p> 
                    <p id="new-ingredient-name-exists">* An ingredient with that name already exists</p>
                    <div id="cancel-add-ingredient" onclick="hideIngredientForm()">x</div>
                    <div class="ingredient-input">
                    Ingredient:
                    <input type="text" name="new_ingredient_name" id="new-ingredient-name" class="add-ingredient-input"><br/>   
                    </div>
                    <div class="ingredient-input">
                    Plural of ingredient:
                    <input type="text" name="new_ingredient_name_plural" id="new-ingredient-name-plural" class="add-ingredient-input"><br/>   
                    </div>
                    <button id="add-ingredient-button" type="button" onclick="addIngredient($().value)">Add</button>

                </div>
                <button id="create-unit" type="button" value="Add New Unit" onclick="showUnitForm()">Add New Unit</button>
                <div id="new-unit-form">
                    <form id="new-unit-form">
                        <div id="cancel-add-unit" onclick="hideUnitForm()">x</div>
                        <div class="unit-input">
                        <h3>Add a new unit</h3>
                        <p id="new-unit-name-required">* Unit name is a required field.</p>
                        <p id="new-unit-name-text">* Invalid unit name</p>
                        <p id="new-unit-name-exists">* A unit with that name already exists</p>
                        Unit:
                        <input type="text" name="new_unit_name" id="new-unit-name" class="add-unit-input">
                        </div>
                        <div class="unit-input">
                        <br/>
                        Unit type:
                        <select id="new-unit-type" name="new_unit_type" class="add-unit-input">
                            <option></option>
                            <?php foreach ($unit_types as $unit_type_id => $unit_type){?>
                            <option value = <?=$unit_type_id?>><?=$unit_type?></option>
                            <?php }?>
                        </select>
                        </div>
                        <br/> 
                        <div class="unit-input">
                        Unit to SI amount:
                        <input type="text" name="new_unit_to_si" id="new-unit-to-si" class="add-unit-input">
                        </div>
                        <br/>   
                        <button id="add-unit-button" type="button" onclick="addUnit()">Add</button>
                    </form>
                </div>
                <table>
                    <tr id="new-table-row" class="new-ingredient">
                        <?php include("templates/new-ingredient-row.php") ?>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html
