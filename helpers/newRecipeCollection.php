<?php
/**
 * Class to handle adding a new recipe collection to the site.
 *
 * @author Sarah.Johnston
 */
class newRecipeCollection {
    
    private $log;
    private $db;
    
    function __construct($db, $conn) {
        $this->db = $db;
        $this->conn = $conn;
        $this->log = Logger::getLogger(__CLASS__);
    }
    
     /**
     * Returns all available recipes in the database.
     * 
     * @return type : Array of all recipe IDs and names in the database.
     */
    function getAllRecipes(){
        $this->log->info("Getting the list of all available ingredients.");
        $sql = "SELECT recipe_name, recipe_id FROM recipes ORDER BY recipe_name ASC";
        return $this->db->runQuery($this->conn, $sql);
    }
    
    /**
     * Returns a list of all available recipes and their IDs.
     * 
     * @return type : Array of all recipe IDs and names in the database.
     */
    function generateRecipesList(){
        $recipes_list = self::getAllRecipes();
        $recipes = array();
        if (mysqli_num_rows($recipes_list) > 0){
            while($row = mysqli_fetch_assoc($recipes_list)){
                $recipes[$row['recipe_id']] = $row['recipe_name'];
            }
            $this->log->trace("Found recipes:");
            $this->log->trace($recipes);
            return $recipes;
        }
        else{
            $this->log->warn("Did not find any available recipes.");
            return [""];
        }
    }
    
}