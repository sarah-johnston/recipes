<html>
    <?php
        include("templates/header.php");
        $log->info("Navigated to the Recipe Collection Deleted page.");
        ?>
    <head>
        <meta charset="UTF-8">
        <title>Recipe Deleted</title>
        <link rel="stylesheet" href="resources/styles.css">
    </head>
    <body>
        <?php include('templates/navigation-bar.php');
        if(!empty($_POST["delete_recipe_collection"])){
        $delete_collection_id = $_POST["delete_recipe_collection"];
        $log->info("Deleting recipe collection with ID: " . $delete_collection_id);
    }
    
    if(isset($delete_collection_id)){
        $sql = "DELETE FROM collections WHERE collection_id = '" 
                . $delete_collection_id . "';";
        $sql2 = "DELETE FROM recipe_collections WHERE collection_id = '" 
                . $delete_collection_id."';";
        $db->runQuery($conn, $sql);
        $db->runQuery($conn, $sql2);
        header('Location: index.php', true, 302);
    }
    ?>
    <h1>Recipe Collection Deleted</h1>
    </body>
</html>
