<html>
    <?php
        include("templates/header.php");
        include("helpers/newRecipeCollection.php");
        $log->info("Navigated to the Recipe Collection Created page.");
        ?>
    <head>
        <meta charset="UTF-8">
        <title>Recipe Collection Created</title>
        <link rel="stylesheet" href="resources/styles.css">
    </head>
    <body>
        <?php include('templates/navigation-bar.php');
        if($_POST["submit"] == "Submit"){
            if(!empty($_POST["collection_name"])){
                $collection_name = $_POST["collection_name"];
                $log->info("Recipe name: " . $collection_name);
            }
            if(!empty($_POST["recipes"])){
                $recipes = $_POST["recipes"];
                $log->info("Recipes in the collection: ");
                $log->info($recipes);
            }
            
            $new_recipe_collection = new newRecipeCollection($db, $conn);
            $collection_id = $new_recipe_collection->addNewRecipeCollection($collection_name, $recipes);
            }
    ?>
        <form action='recipe-collection.php' method='GET' name='frm'>
            <input type="hidden" name="id" value="<?=$collection_id?>" />
        </form>
        <script language="JavaScript">
        document.frm.submit();
        </script>
        <h1>Recipe Collection Created</h1>
    </body>
</html>
