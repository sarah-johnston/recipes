<?php
include('helpers/recipeList.php');
/**
 * Class to handle returning recipes based on search criteria.
 *
 * @author Sarah.Johnston
 */
class searchResults extends recipeList {

    public function __construct($db) {
        parent::__construct($db);
        $this->search_text = mysqli_real_escape_string($this->conn, $_POST['search_text']);
    }
    
    function getRecipesSearchResults(){
        $sql = "SELECT recipe_id, recipe_name FROM recipes WHERE recipe_name LIKE '%" . $this->search_text . "%'";
        return $this->db->runQuery($this->conn, $sql);     
    }
    
    function getCollectionsSearchResults(){
        $sql = "SELECT collection_id, collection_name FROM collections WHERE collection_name LIKE '%" . $this->search_text . "%'";
        return $this->db->runQuery($this->conn, $sql);
    }
}
