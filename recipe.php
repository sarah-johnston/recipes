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
            
            $recipe_name_sql = "SELECT recipe_name, recipe_method FROM recipes WHERE recipe_id = " 
                    .$id. " LIMIT 1";
            $ingredients_sql = "SELECT ri.recipe_ingredient_amount, "
                    . "u.unit_name, i.recipe_ingredient FROM ingredients i "
                    . "INNER JOIN recipe_ingredients ri "
                    . "ON i.recipe_ingredient_id=ri.recipe_ingredient_id "
                    . "LEFT JOIN units u ON ri.unit_id=u.unit_id "
                    . "WHERE recipe_id = " .$id;
            $recipe_details = mysqli_fetch_assoc(mysqli_query($conn, $recipe_name_sql));
            $recipe_name = $recipe_details['recipe_name'];
            $recipe_method = $recipe_details['recipe_method'];
            $ingredients = mysqli_query($conn, $ingredients_sql);
            if (!$ingredients) {
                die(mysqli_error($conn));
            }
        ?>
    <head>
        <meta charset="UTF-8">
        <title><?=$recipe_name;?></title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <article>
            <h1><?=$recipe_name;?></h1>
            <table>
                <h3>Ingredients</h3>
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
                ?>
            </table>
            <h3>Method</h3>
            <p><?=$recipe_method;?></p>
        </article>
    </body>
</html>
