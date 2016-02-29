<td>
    <select name="ingredients" id="input-recipe-ingredient">
        <?php foreach ($ingredients as $ingredient) {?>
        <option value="<?=$ingredient?>"><?=$ingredient?></option>
        <?php }?>
    </select>
</td>
<td id="amount">
    <input type="text" name="ingredient_amount" class="ingredient-amount"/>
</td>
<td id="unit">
    <select name="ingredient_unit" id="input-recipe-ingredient-unit">
        <?php foreach ($units as $unit) {?>
        <option value="<?=$unit?>"><?=$unit?></option>
        <?php }?>
    </select>
</td>
<td>
    <input type="button" value="Delete Ingredient" class="delete-ingredient" />
</td>
