<html>
    <?php
        include("templates/header.php");
        $log->info("Navigated to the Recipe Deleted page.");
        ?>
    <head>
        <meta charset="UTF-8">
        <title>Recipe Deleted</title>
        <link rel="stylesheet" href="resources/styles.css">
    </head>
    <body>
        <?php include('templates/navigation-bar.php');
        if(!empty($_POST["delete_recipe"])){
        $delete_recipe_id = $_POST["delete_recipe"];
        $log->info("Deleting recipe with ID: " . $delete_recipe_id);
    }
    
    if(isset($delete_recipe_id)){
        $sql = "DELETE FROM recipes WHERE recipe_id = '" 
                . $delete_recipe_id . "';";
        $sql2 = "DELETE FROM recipe_ingredients WHERE recipe_id = '" 
                . $delete_recipe_id."';";
        $db->runQuery($conn, $sql);
        $db->runQuery($conn, $sql2);
        header('Location: index.php', true, 302);
    }
    ?>
    <h1>Recipe Deleted</h1>
    </body>
</html>
