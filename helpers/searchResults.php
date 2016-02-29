<?php
/**
 * Class to handle returning recipes based on search criteria.
 *
 * @author Sarah.Johnston
 */
class searchResults {
    
    function __construct($db) {
        $this->db = $db;
        $this->conn = $this->db->connectToDatabase();
        $this->search_text = mysqli_real_escape_string($this->conn, $_POST['search_text']);
    }
    
    function getRecipes(){
        $sql = "SELECT recipe_id, recipe_name FROM recipes WHERE recipe_name LIKE '%" . $this->search_text . "%'";
        return $this->db->runQuery($this->conn, $sql);     
    }
    
    function getCollections(){
        $sql = "SELECT collection_id, collection_name FROM collections WHERE collection_name LIKE '%" . $this->search_text . "%'";
        return $this->db->runQuery($this->conn, $sql);
    }
    
    function getRecipesSearchResults(){       
        $recipes = self::getRecipes($this->conn);
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
    
    function getCollectionsSearchResults(){       
        $collections = self::getCollections($this->conn);
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
