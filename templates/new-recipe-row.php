<select name="recipes[]" class="input-recipe">
            <?php foreach ($recipes as $recipe_id => $recipe_name) {?>
            <option class="recipe-ingredient-option" value="<?=$recipe_id?>"><?=$recipe_name?></option>
            <?php }?>
</select>
<div class="delete-recipe">x</div>
