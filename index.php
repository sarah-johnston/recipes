<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>test</title>
    </head>
    <body>
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
        if (mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                echo "<a href = 'recipe.php?id=" . $row["recipe_id"] . "'>" 
                        . $row["recipe_name"] . "</a><br>";
            } 
        }
        else {
            echo "0 results";
        }
        ?>
    </body>
</html>
