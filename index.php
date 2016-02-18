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
        $sql = "SELECT recipe_id, recipe_name FROM recipes";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
           die(mysqli_error($conn));
        }
        
        ?>
    <head>
        <meta charset="UTF-8">
        <title>Recipes</title>
    </head>
    <body>
        <h1>Recipes</h1>
        <?php
        if (mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                $recipe_id = $row['recipe_id'];
                $recipe_name = $row['recipe_name'];
        ?>
        <form action="recipe.php" method="POST">
            <input type="hidden" name="id" value="<?=$recipe_id?>" />
            <input type="submit" value="<?=$recipe_name?>"/>
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
