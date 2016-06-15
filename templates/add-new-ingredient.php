<button id="create-ingredient" type="button" value="Add a new ingredient" onclick="showIngredientNinja()">Add a new ingredient</button>
<script src="resources/jquery-1.12.1.min.js"></script>
<script>
    $(function(){
        $(".add-ingredient-input").keypress(function (e) {
            if (e.keyCode == 13)  // the enter key code
            {
                $('#add-ingredient-button').click();
                return false;
            }
        });
    });</script>
<div id="new-ingredient-ninja">
    <h3>Add a new ingredient</h3>
    Ingredient:
    <input type="text" name="new_ingredient_name" id="new-ingredient-name" class="add-ingredient-input"><br/>   
    Plural of ingredient:
    <input type="text" name="new_ingredient_name_plural" id="new-ingredient-name-plural" class="add-ingredient-input"><br/>   
    <button id="add-ingredient-button" type="button" onclick="addIngredient($().value)">Add</button>
    <button type="button" onclick="hideIngredientNinja()">Cancel</button>
</div>

