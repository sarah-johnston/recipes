<?php
/**
 * Class to handle the display of the list of recipes and collections on the
 * homepage.
 *
 * @author Sarah.Johnston
 */
class recipeList {
    
    private $log;

    public function __construct($db, $conn) {
        $this->db = $db;
        $this->conn = $conn;
        $this->log = Logger::getLogger(__CLASS__);
    }
    
    function getAllRecipes(){
        $this->log->info("Getting all recipes.");
        $sql = "SELECT recipe_id, recipe_name FROM recipes";
        return $this->db->runQuery($this->conn, $sql);
    }
    
    function getAllRecipeCollections(){
        $this->log->info("Getting all recipe collections.");
        $sql = "SELECT collection_id, collection_name FROM collections";
        return $this->db->runQuery($this->conn, $sql);
    }
    
    function generateRecipesList($recipes){
        $recipeList = array();
        if (mysqli_num_rows($recipes) > 0){
            while($row = mysqli_fetch_assoc($recipes)){
                $recipeList[$row['recipe_id']] = $row['recipe_name'];
            }
            $this->log->info("Found " . count($recipeList) ." recipes.");
            $this->log->debug($recipeList);
        }
        else{
            $this->log->info("Did not find any recipes that matched the query.");
            $recipeList = null;
        }
        return $recipeList;
    }
    
    function generateRecipeCollectionsList($collections){       
        $collectionsList = array();
        if (mysqli_num_rows($collections) > 0){
            while($row = mysqli_fetch_assoc($collections)){
                $collectionsList[$row['collection_id']] =
                        $row['collection_name'];
            }
            $this->log->info("Found " . count($collectionsList) ." recipe collections.");
            $this->log->debug("Found recipe collections: ");
            $this->log->debug($collectionsList);
            return $collectionsList;
        }
        else{
            $this->log->info("Did not find any recipe collections that matched the query.");
            $collectionsList = null;
        }
        return $collectionsList;
    }
}
