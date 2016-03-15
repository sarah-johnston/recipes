
function validateForm(){
    var name_valid = validateName();
    var amounts_valid = validateAmounts();

    return (name_valid && amounts_valid);
}

function showIngredientNinja(){
    ingredient = document.getElementById('new-ingredient-name').value = "";
    ingredient_plural = document.getElementById('new-ingredient-name-plural').value = "";
    document.getElementById('new-ingredient-ninja').style.display = 'inline';
    document.getElementById('overlay').style.display = 'inline';
}

function hideIngredientNinja(){
    document.getElementById('new-ingredient-ninja').style.display = 'none';
    document.getElementById('overlay').style.display = 'none';
}

function showUnitNinja(){
    unit = document.getElementById('new-unit-name').value = "";
    unit = document.getElementById('new-unit-to-si').value = "";
    unit = document.getElementById('new-unit-type').selectedIndex = 0;
    document.getElementById('new-unit-ninja').style.display = 'inline';
    document.getElementById('overlay').style.display = 'inline';
}

function hideUnitNinja(){
    document.getElementById('new-unit-ninja').style.display='none';
    document.getElementById('overlay').style.display = 'none';
}

function addUnit(){
    unit_name = document.getElementById('new-unit-name').value;
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
                hideUnitNinja();
                refreshUnitDropdown();
            }
        });
}

function addIngredient(){
    ingredient_name = document.getElementById('new-ingredient-name').value;
    ingredient_plural = document.getElementById('new-ingredient-name-plural').value;
        $.ajax({
            type: 'POST',
            url: 'add-new-ingredient.php',
            data: {
                ingredient_name : ingredient_name, 
                ingredient_plural : ingredient_plural
            },
            success: function(){
                hideIngredientNinja();
                refreshIngredientDropdown();
            }
        });
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

//generalise?
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
        $.ajax({
            type: 'POST',
            url: 'reload-ingredients-dropdown.php',
            dataType: 'html',
            success: function(data){
                $('.input-recipe-ingredient').html(data);
            }
        });
}