<?php 
include("templates/header.php");
include("helpers/newRecipe.php");
$recipe = new newRecipe($db, $conn);
$ingredients = $recipe->generateIngredientsList();
foreach ($ingredients as $ingredient_id => $ingredient) {?>
    <option value="<?=$ingredient_id?>"><?=$ingredient?></option>
<?php }?>
