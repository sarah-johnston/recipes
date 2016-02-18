<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
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

            $id = mysqli_real_escape_string($conn, $_GET['id']);
            $sql = "SELECT `recipe_name` FROM `recipes` WHERE `recipe_id` = " 
                    .$id. " LIMIT 1";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

            // Page content
            echo $row['recipe_name'];
            
        ?>
    </body>
</html>
