<?php 
include("templates/header.php");
include("helpers/newRecipe.php");
$recipe = new newRecipe($db, $conn);
$units = $recipe->generateUnitsList();
foreach ($units as $unit_id => $unit) {?>
    <option value="<?=$unit_id?>"><?=$unit?></option>
<?php }?>
