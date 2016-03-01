<?php
include("resources/log4php/Logger.php");
Logger::configure('resources/config.xml');
/**
 * Class to encapsulate interaction with the database.
 *
 * @author Sarah.Johnston
 */
class database {

    private $conn;
    
    public function __construct() {
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->database = "recipes";
        $this->port = 3306;
	}
        
    public function connectToDatabase(){
        // create connection
        $this->log = Logger::getLogger(__CLASS__);
            $this->log->info("Attempting to connect to the '"
                . $this->database . "' database on " . $this->servername .
                ":" . $this->port . " with credentials [" .
                "username: '" . $this->username . 
                "' password: '" .  $this->password . "']."
                );
        $conn = mysqli_connect($this->servername, $this->username, $this->password, 
                    $this->database, $this->port);

            // check connection
            if(!$conn) {
                $error = "Connection failed with error: " . mysqli_connect_error();
                $this->log->fatal($error);
                // This doesn't seem to capture Notices or Warnings.
                die($error);
            }
            else{
                $this->log->info("Connected successfully.");
                return $conn;
            }
        }
        
    function runQuery($conn, $sql){
        $this->log->debug("Running the following query: " . $sql);
        $result = mysqli_query($conn, $sql);
        if (!$sql) {
            $error = mysqli_error($conn);
            $warnings = mysqli_warning_count($conn);
            $error = "Connection failed with error: " . mysqli_connect_error();
            $this->log->info($error);
            die($error);
        }
        else{
            $this->log->debug("Query ran successfully.");
            return $result; 
        }
    }
}
