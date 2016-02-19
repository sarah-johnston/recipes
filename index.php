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
        // check connection
        if(!$conn) {
            die("Conection failed: " . mysqli_connect_error());
        }
        $recipes = "SELECT recipe_id, recipe_name FROM recipes";
        $collections = "SELECT collection_id, collection_name FROM collections";
        $result1 = mysqli_query($conn, $recipes);
        if (!$result1) {
           die(mysqli_error($conn));
        }
        $result2 = mysqli_query($conn, $collections);
        if (!$collections) {
           die(mysqli_error($conn));
        }
        
        ?>
    <head>
        <meta charset="UTF-8">
        <title>Recipes</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <h1 class="section" id="recipes">Recipes</h1>
        
        <?php
        if (mysqli_num_rows($result1) > 0){
            while($row = mysqli_fetch_assoc($result1)){
                $recipe_id = $row['recipe_id'];
                $recipe_name = $row['recipe_name'];
        ?>
        <form action="recipe.php" method="POST" class="recipes">
            <input type="hidden" name="id" value="<?=$recipe_id?>" />
            <input class="recipe-link" type="submit" value="<?=$recipe_name?>"/>
        </form><br />
        <?php 
            } 
        }
        else {
            echo "0 results";
        }
        ?>
        
        <h1 class="section" id="recipe-collections">Recipe Collections</h1>
        <?php
        if (mysqli_num_rows($result2) > 0){
            while($row = mysqli_fetch_assoc($result2)){
                $collection_id = $row['collection_id'];
                $collection_name = $row['collection_name'];
        ?>
        <form action="recipe-collection.php" method="POST" class="recipe-collections">
            <input type="hidden" name="id" value="<?=$collection_id?>" />
            <input class="recipe-collection-link" type="submit" value="<?=$collection_name?>"/>
        </form><br />
        <?php 
            } 
        }
        else {
            echo "0 results";
        }
        ?>
    </body>
</html>
