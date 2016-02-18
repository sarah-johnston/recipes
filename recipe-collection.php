<!DOCTYPE html>
<html>
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "recipes";
        $port = 3306;
        // create connection
        $conn = mysqli_connect($servername, $username, $password, $database, $port);
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $collection_sql = "SELECT collection_name FROM collections WHERE collection_id = " . $id;
        $collection_name = mysqli_fetch_assoc(mysqli_query($conn, $collection_sql))['collection_name'];
        $recipes_sql = "SELECT r.recipe_name, r.recipe_method, r.recipe_id FROM recipes r "
            ."INNER JOIN recipe_collections rc "
            ."ON rc.recipe_id = r.recipe_id "
            ."INNER JOIN collections c "
            ."ON c.collection_id = rc.collection_id "
            ."WHERE c.collection_id =" . $id;
        $recipes = mysqli_query($conn, $recipes_sql);
            if (!$recipes) {
                die(mysqli_error($conn));
            }

    ?>
    <head>
        <meta charset="UTF-8">
        <title><?=$collection_name?></title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <h1><?=$collection_name?></h1>
        <?php 
        if (mysqli_num_rows($recipes) > 0){
            while($row = mysqli_fetch_assoc($recipes)){
                $recipe = $row['recipe_name'];
                $recipe_id = $row['recipe_id'];
                $recipe_name = $row['recipe_name'];
                $ingredients_sql = "SELECT ri.recipe_ingredient_amount, "
                    . "u.unit_name, i.recipe_ingredient FROM ingredients i "
                    . "INNER JOIN recipe_ingredients ri "
                    . "ON i.recipe_ingredient_id=ri.recipe_ingredient_id "
                    . "LEFT JOIN units u ON ri.unit_id=u.unit_id "
                    . "WHERE recipe_id = " .$recipe_id;
                $ingredients = mysqli_query($conn, $ingredients_sql);
        ?>
        <table>
            <h3>Ingredients for <?=$recipe_name?>:</h3>
            <?php 
            if (mysqli_num_rows($ingredients) > 0){
            while($row = mysqli_fetch_assoc($ingredients)){
                $ingredient_amount = $row['recipe_ingredient_amount'];
                $ingredient_unit = $row['unit_name'];
                $ingredient_name = $row['recipe_ingredient'];
            ?>
           <tr>
                <td><?=$ingredient_amount?></td>
                <td><?=$ingredient_unit?></td>
                <td><?=$ingredient_name?></td>
            </tr>
            <?php
                }
            }
            }
        }
            ?>
        </table>
        <?php 
        $recipes = mysqli_query($conn, $recipes_sql);
        if (mysqli_num_rows($recipes) > 0){
            while($row = mysqli_fetch_assoc($recipes)){
                $recipe_name = $row['recipe_name'];
                $recipe_method = $row['recipe_method'];
        ?>        
        <h3>Method for <?=$recipe_name?>:</h3>
        <p><?=$recipe_method?></p>
        <?php
            }
        }
        ?>
    </body>
</html>
