<?php 
    if($is_collection){
        ?>
<h4>for <?=$recipe_name?>:</h4>
<?php
    }
    foreach ($recipe_ingredients as $ingredient){
?>
<tr>
    <td><?=$ingredient["amount"]?></td>
    <td><?=$ingredient["unit"]?></td>
    <td><?=$ingredient["ingredient"]?></td>
</tr>
<?php
    }
?>