<?php
include('recipeList.php');
/**
 * Class to handle returning recipes based on search criteria.
 *
 * @author Sarah.Johnston
 */
class searchResults extends recipeList {
    
    private $log;

    public function __construct($db, $conn) {
        parent::__construct($db, $conn);
        $this->db = $db;
        $this->conn = $conn;
        $this->search_text = mysqli_real_escape_string($conn, $_POST['search_text']);
        $this->log = Logger::getLogger(__CLASS__);
        $this->log->info("Searched for '" . $this->search_text . "'.");
    }
    
    function getRecipesSearchResults(){
        $this->log->info("Getting recipes which match the search criteria.");
        $sql = "SELECT recipe_id, recipe_name FROM recipes WHERE recipe_name LIKE '%" . $this->search_text . "%'";
        return $this->db->runQuery($this->conn, $sql);     
    }
    
    function getCollectionsSearchResults(){
        $this->log->info("Getting recipe collections which match the search criteria.");
        $sql = "SELECT collection_id, collection_name FROM collections WHERE collection_name LIKE '%" . $this->search_text . "%'";
        return $this->db->runQuery($this->conn, $sql);
    }
}
