<html>
    <?php
        include("templates/header.php");
        $log->info("Navigated to the Recipe Created page.");
        ?>
    <head>
        <meta charset="UTF-8">
        <title>Recipe Created</title>
        <link rel="stylesheet" href="resources/styles.css">
    </head>
    <body>
        <?php include('templates/navigation-bar.php');
        if($_POST["submit"] == "Submit"){
            if(!empty($_POST["recipe_name"])){
                $recipe_name = $_POST["recipe_name"];
                $log->info("Recipe name: " . $recipe_name);
            }
            if(!empty($_POST["recipe_method"])){
                $recipe_method = $_POST["recipe_method"];
                $log->info("Recipe method: " . $recipe_method);
            }
            if(!empty($_POST["ingredients"])){
                $ingredients = $_POST["ingredients"];
                $log->info("Recipe ingredients: ");
                $log->info($ingredients);
            }
            if(!empty($_POST["ingredient_amount"])){
                $amounts = $_POST["ingredient_amount"];
                $log->info("Ingredients amounts: ");
                $log->info($amounts);
            }
            if(!empty($_POST["ingredient_unit"])){
                $units = $_POST["ingredient_unit"];
                $log->info("Ingredient units: ");
                $log->info($units);
            }
            
            if((isset($ingredients)) && (isset($amounts)) && (isset($units))){
                $ingredients_details = array($ingredients, $amounts, $units);
                $log->info($ingredients_details);
            }
            if((isset($recipe_name)) && (isset($recipe_method)))
            {
                $sql = "INSERT INTO recipes (recipe_name, recipe_method) VALUES ('" . $recipe_name . "', '" . $recipe_method . "');";
                $db->runQuery($conn, $sql);
                $recipe_id = $conn->insert_id;
                $log->info("ID of the new recipe:");
                $log->info($recipe_id);
            }
            if(isset($ingredients_details)){
            for ($i = 0; $i < count($ingredients_details[0]); $i++) {
                $ingredient_id = $ingredients_details[0][$i];
                $log->info("Ingredient id:");
                $log->info($ingredient_id);

                $amount = $ingredients_details[1][$i];
                $log->info("Amount:");
                $log->info($amount);

                $unit_id = $ingredients_details[2][$i];
                $log->info("Unit id:");
                $log->info($unit_id);
                
                $sql = "INSERT INTO recipe_ingredients (recipe_id, 
                    recipe_ingredient_id, recipe_ingredient_amount, unit_id)
                    VALUES('" . $recipe_id . "', '" . $ingredient_id . "', '" . $amount . "', '" . $unit_id . "');";
                $db->runQuery($conn, $sql);
             }
            }
            
            }
            
    //handle the form input here
    //and redirect to the new recipe page?
    ?>
        <h1>Recipe Created</h1>
    </body>
</html>
