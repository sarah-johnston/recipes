<?php
/**
 * Class to encapsulate interaction with the database.
 *
 * @author Sarah.Johnston
 */
class DAL {

    public function __construct() {
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->database = "recipes";
        $this->port = 3306;
    }
    
    public function connectToDatabase(){
        // create connection
        $conn = mysqli_connect($this->servername, $this->username, $this->password, 
                $this->database, $this->port);
        // check connection
        if(!$conn) {
            die("Conection failed: " . mysqli_connect_error());
        }
        return $conn;
    }
    
    function runQuery($conn, $sql){
        $result = mysqli_query($conn, $sql);
        if (!$sql) {
           die(mysqli_error($conn));
        }
        return $result; 
    }
}
