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
    
    /**
     * Adds a new recipe collection to the database.
     * 
     * @param type $collection_name : Name of the new collection.
     * @param type $ingredients : Ingredients in the new recipe.
     * @param type $method : Method for the new recipe.
     * @return type : ID of the new recipe.
     */
    function addNewRecipeCollection($collection_name, $recipes){
        $collection_id = self::createNewRecipeCollection($collection_name);
        self::addRecipesToCollection($collection_id, $recipes);
        return $collection_id;
    }
    
    
    /**
     * Helper funtion which adds the name and method of a new recipe collection
     * to the database, and returns the ID of the new collection.
     * 
     * @param type $collection_name : Name of the new recipe collection.
     * @return type : ID of the new collection.
     */
    private function createNewRecipeCollection($collection_name){
        $sql = "INSERT INTO collections (collection_name) VALUES ('" . $collection_name . "');";
        $this->db->runQuery($this->conn, $sql);
        $collection_id = $this->conn->insert_id;
        $this->log->info("ID of the new recipe collection:");
        $this->log->info($collection_id);
        return $collection_id;
    }
    
    /**
     * Helper function which adds recipes to a collection.
     * @param type $collection_id
     * @param type $recipes
     */
    private function addRecipesToCollection($collection_id, $recipes){
        // Helper function to add the ingredients of the new recipe to the database, given the recipe id.
        for ($i = 0; $i < count($recipes); $i++) {
            $recipe_id = $recipes[$i];
            $this->log->info("Recipe id:");
            $this->log->info($recipe_id);

            $sql = "INSERT INTO recipe_collections (collection_id, recipe_id)
                VALUES('" . $collection_id . "', '" . $recipe_id . "');";
            $this->db->runQuery($this->conn, $sql);
        }
    }
    
}