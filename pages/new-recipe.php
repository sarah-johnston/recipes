<!DOCTYPE html>
<html>
    <?php
        include("../helpers/DAL.php");
        $db = new DAL();
        ?>
    <head>
        <meta charset="UTF-8">
        <title>New Recipe</title>
        <link rel="stylesheet" href="../styles.css">
    </head>
    <body>
        <?php include('../templates/header.php'); ?>
        <h1 class="title">New Recipe</h1>
        <form id="new-recipe">
            <div id="name">
                <h3 id="new-recipe-name">Recipe Name:</h3>
                <input type="text" name="recipe_name" id="input-recipe-name"/>
            </div>
            <h3 class="new-recipe-ingredients">Ingredients:</h3>
            <?php include("../templates/add-new-ingredients.php");?>
            <h3 class="new-recipe-method">Method:</h3>
            <textarea name="recipe-method" id="input-recipe-method"></textarea>
            <input type="submit" value="Submit" id="submit-new-recipe">
        </form>
    </body>
</html