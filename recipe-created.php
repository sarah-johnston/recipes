<html>
    <?php
        include("templates/header.php");
        include("helpers/newRecipe.php");
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
                $method = $_POST["recipe_method"];
                nl2br($method);
                $log->info("Recipe method: " . $method);
            }
            else{
            $method = "";
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
            
            $new_recipe = new newRecipe($db, $conn);
            $recipe_id = $new_recipe->addNewRecipe($recipe_name, $ingredients_details, $method);
            }
    ?>
        <form action='recipe.php' method='GET' name='frm'>
            <input type="hidden" name="id" value="<?=$recipe_id?>" />
        </form>
        <script language="JavaScript">
        document.frm.submit();
        </script>
        <h1>Recipe Created</h1>
    </body>
</html>
