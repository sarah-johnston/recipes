function validateForm(){
    var name_valid = validateName();
    var amounts_valid = validateAmounts();

    return (name_valid && amounts_valid);
}

function showIngredientForm(){
    ingredient = document.getElementById('new-ingredient-name').value = "";
    ingredient_plural = document.getElementById('new-ingredient-name-plural').value = "";
    document.getElementById('new-ingredient-form').style.display = 'inline';
    document.getElementById('overlay').style.display = 'inline';
}

function hideIngredientForm(){
    document.getElementById('new-ingredient-form').style.display = 'none';
    document.getElementById('overlay').style.display = 'none';
    document.getElementById('new-ingredient-name-required').style.display='none';
    document.getElementById('new-ingredient-name-text').style.display='none';
    document.getElementById('new-ingredient-name-exists').style.display='none';
    document.getElementById('new-ingredient-name').style.background = "#f1f1f1";
}

function showUnitForm(){
    unit = document.getElementById('new-unit-name').value = "";
    unit = document.getElementById('new-unit-to-si').value = "";
    unit = document.getElementById('new-unit-type').selectedIndex = 0;
    document.getElementById('new-unit-form').style.display = 'inline';
    document.getElementById('overlay').style.display = 'inline';
}

function hideUnitForm(){
    document.getElementById('new-unit-form').style.display='none';
    document.getElementById('overlay').style.display = 'none';
    document.getElementById('new-unit-name-required').style.display='none';
    document.getElementById('new-unit-name-text').style.display='none';
    document.getElementById('new-unit-name-exists').style.display='none';
    document.getElementById('new-unit-name').style.background = "#f1f1f1";
}

function addUnit(){
    var unitValid = validateNewUnit();
    if(unitValid){
    unit_name = document.getElementById('new-unit-name').value.toLowerCase();
    unit_type = document.getElementById('new-unit-type').value;
    unit_to_si = document.getElementById('new-unit-to-si').value;
        $.ajax({
            type: 'POST',
            url: 'add-new-unit.php',
            data: {
                unit_name : unit_name, 
                unit_type : unit_type,
                unit_to_si : unit_to_si
            },
            success: function(){
                hideUnitForm();
                refreshUnitDropdown();
            }
        });
    }
}

function addIngredient(){
    var ingredientValid = validateNewIngredient();
    if(ingredientValid){
    ingredient_name = document.getElementById('new-ingredient-name').value.toLowerCase();
    ingredient_plural = document.getElementById('new-ingredient-name-plural').value;
        $.ajax({
            type: 'POST',
            url: 'add-new-ingredient.php',
            data: {
                ingredient_name : ingredient_name, 
                ingredient_plural : ingredient_plural
            },
            success: function(){
                hideIngredientForm();
                refreshIngredientDropdown();
            }
        });
    }
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

function validateNewIngredient(){
    var ingredient_present = true;
    var ingredient_valid = true;
    var ingredient_exists = false;
    var textOnly = new RegExp("^[a-zA-Z ]*$");
    var ingredient_name = document.getElementById('new-ingredient-name').value;
    var existing_ingredients = document.getElementsByClassName('recipe-ingredient-option');
    
    // Set defaults (validation messages hidden, background grey).
    document.getElementById('new-ingredient-name-exists').style.display='none';
    document.getElementById('new-ingredient-name-required').style.display='none';
    document.getElementById('new-ingredient-name-text').style.display='none';
    document.getElementById('new-ingredient-name').style.background = "#f1f1f1";
    
    if((ingredient_name === "") || (ingredient_name === null)){
        document.getElementById('new-ingredient-name-required').style.display='block';
        document.getElementById('new-ingredient-name').style.background = "rgb(255, 204, 204)";
        ingredient_present = false;
    }
    if(!textOnly.test(ingredient_name)){
        document.getElementById('new-ingredient-name-text').style.display='block';
        document.getElementById('new-ingredient-name').style.background = "rgb(255, 204, 204)";
        ingredient_valid = false;
    }
    
    // Check if the ingredient we're adding already exists.
    for(i = 0; i < existing_ingredients.length; i++){
        if(existing_ingredients[i].textContent === ingredient_name){
            ingredient_exists = true;
            document.getElementById('new-ingredient-name-exists').style.display='block';
            document.getElementById('new-ingredient-name').style.background = "rgb(255, 204, 204)";
            break;
        }
    }    
    return(ingredient_present && ingredient_valid && !ingredient_exists);
}

function validateNewUnit(){
    var unit_present = true;
    var unit_valid = true;
    var unit_exists = false;
    var textOnly = new RegExp("^[a-zA-Z ]*$");
    var unit_name = document.getElementById('new-unit-name').value;
    var existing_units = document.getElementsByClassName('recipe-unit-option');
    
    // Set defaults (validation messages hidden, background grey).
    document.getElementById('new-unit-name').style.background = "#f1f1f1";
    document.getElementById('new-unit-name-required').style.display='none';
    document.getElementById('new-unit-name-text').style.display='none';
    document.getElementById('new-unit-name-exists').style.display='none';
    
    if((unit_name === "") || (unit_name === null)){
        document.getElementById('new-unit-name-required').style.display='block';
        document.getElementById('new-unit-name').style.background = "rgb(255, 204, 204)";
        unit_present = false;
        }
    if(!textOnly.test(unit_name)){
        document.getElementById('new-unit-name-text').style.display='block';
        document.getElementById('new-unit-name').style.background = "rgb(255, 204, 204)";
        unit_valid = false;
    }
    
    // Check if the unit we're adding already exists.
    for(i = 0; i < existing_units.length; i++){
        if(existing_units[i].textContent === unit_name){
            unit_exists = true;
            document.getElementById('new-unit-name-exists').style.display='block';
            document.getElementById('new-unit-name').style.background = "rgb(255, 204, 204)";
            break;
        }
    }
    return(unit_present && unit_valid && !unit_exists);
}

function validateAmounts(){
    var amounts = document.querySelectorAll('#new-recipe .ingredient-amount');
    var amounts_valid = true;
    var amounts_present = true;
   
    for (var i = 0; i < amounts.length; i++) {
        var amount_present = true;
        var amount_valid = true;
        if((amounts[i].value === "")||(amounts[i].value === null)){ 
            amount_present = false;
            amounts_present = false;
        }
        if(isNaN(amounts[i].value)){ 
            amount_valid = false;
            amounts_valid = false;
        }
        if(!amount_present || !amount_valid){
            amounts[i].style.background = "rgb(255, 204, 204)";
        }
        else{
            amounts[i].style.background = "#f1f1f1";
        }
    }

    if(!amounts_present){
        document.getElementById('recipe-amounts-required').style.display='inline';
    }
    else{
        document.getElementById('recipe-amounts-required').style.display='none';
    }
    if(!amounts_valid){
        document.getElementById('recipe-amounts-numerical').style.display='block';
    }
    else{
        document.getElementById('recipe-amounts-numerical').style.display='none';
    }
    return (amounts_present && amounts_valid);
}


function refreshUnitDropdown(){
        $.ajax({
            type: 'POST',
            url: 'reload-unit-dropdown.php',
            dataType: 'html',
            success: function(data){
                $('.input-recipe-unit').html(data);
            }
        });
}
function refreshIngredientDropdown(){
        var selectedItems = [];
        var ingredientElements = [];
        $(".input-recipe-ingredient").each(function(){
            selectedItems.push($(this).val());
            ingredientElements.push($(this));
        });      
        $.ajax({
            type: 'POST',
            url: 'reload-ingredients-dropdown.php',
            dataType: 'html',
            success: function(data){
                $('.input-recipe-ingredient').html(data);
                for(var i = 0; i < selectedItems.length; i++){
                    ingredientElements[i].val(selectedItems[i]);
                };
            }
        });
}
