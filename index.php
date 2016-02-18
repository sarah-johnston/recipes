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
        echo "Connected successfully <br>";
                
        $sql = "SELECT recipe_id, recipe_name FROM recipes";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
           die(mysqli_error($conn));
        }
        if (mysqli_num_rows($result) > 0){
            //output each row
            while($row = mysqli_fetch_assoc($result)){
                echo "id: " . $row["recipe_id"] . "name: " . 
                        $row["recipe_name"] . "<br>";
            } 
        }
        else {
            echo "0 results";
        }
        ?>
    </body>
</html>
