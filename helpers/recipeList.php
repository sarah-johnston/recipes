<?php
/**
 * Class to handle the display of the list of recipes and collections on the
 * homepage.
 *
 * @author Sarah.Johnston
 */
class recipeList {

    public function __construct($db) {
        $this->db = $db;
        $this->conn = $this->db->connectToDatabase();
    }
    
    function getAllRecipes(){
        $sql = "SELECT recipe_id, recipe_name FROM recipes";
        return $this->db->runQuery($this->conn, $sql);
    }
    
    function getAllRecipeCollections(){
        $sql = "SELECT collection_id, collection_name FROM collections";
        return $this->db->runQuery($this->conn, $sql);
    }
    
    function generateRecipesList($recipes){       
        $recipeList = array();
        if (mysqli_num_rows($recipes) > 0){
            while($row = mysqli_fetch_assoc($recipes)){
                $recipeList[$row['recipe_id']] = $row['recipe_name'];
            }
            return $recipeList;
        }
        else{
            $recipeList[""] = "0 results";
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
            return $collectionsList;
        }
        else{
            $collectionsList[""] = "0 results";
        }
        return $collectionsList;
    }
}
