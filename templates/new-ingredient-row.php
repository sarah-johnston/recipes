    <td>
        <select name="ingredients[]" class="input-recipe-ingredient">
            <?php foreach ($ingredients as $ingredient_id => $ingredient) {?>
            <option class="recipe-ingredient-option" value="<?=$ingredient_id?>"><?=$ingredient?></option>
            <?php }?>
        </select>
    </td>
    <td id="amount">
        <input type="text" name="ingredient_amount[]" class="ingredient-amount"/>
    </td>
    <td id="unit">
            <select name="ingredient_unit[]" class="input-recipe-unit">
            <?php foreach ($units as $unit_id => $unit) {?>
            <option class="recipe-unit-option" value="<?=$unit_id?>"><?=$unit?></option>
            <?php }?>
        </select>
    </td>
    <td>
        <div class="delete-ingredient">x</div>
    </td>
