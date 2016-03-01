<?php
include('RecipePage.php');
/**
 * Class to handle the display of a collection of recipes.
 *
 * @author Sarah.Johnston
 */
class recipeCollectionPage {
    
    private $log;
    private $db;
    
    function __construct($db, $conn) {
        $this->db = $db;
        $this->conn = $conn;
        $this->id = mysqli_real_escape_string($conn, $_POST['id']);
        $this->log = Logger::getLogger(__CLASS__);
    }
    
    function getCollectionName($collection_id){
        $this->log->info("Getting the name of the collection with ID '". $collection_id . "'");
        $sql = "SELECT collection_name FROM collections WHERE collection_id = " . $collection_id;
        return mysqli_fetch_assoc($this->db->runQuery($this->conn, $sql))['collection_name'];
    }

    /**
     * Returns a list of the IDs of the recipes included in the collection.
     */
    function getCollectionRecipes($collection_id){
        $this->log->debug("Getting the IDs of the recipes included in the collection with ID '" . $collection_id . "'");
        $sql = "SELECT r.recipe_id FROM recipes r "
            ."INNER JOIN recipe_collections rc "
            ."ON rc.recipe_id = r.recipe_id "
            ."INNER JOIN collections c "
            ."ON c.collection_id = rc.collection_id "
            ."WHERE c.collection_id =" . $collection_id;
        $result = $this->db->runQuery($this->conn, $sql);
        $recipe_ids = array();
        while($row = mysqli_fetch_assoc($result)){
            $recipe_ids[] = $row["recipe_id"];
        }
        $this->log->debug("Found recipes with IDs:");
        $this->log->debug($recipe_ids);
        return $recipe_ids;
    }    
    
    function getMultipleRecipesDetails($recipe_id_list){
        $this->log->debug("Getting the names, methods and ingedients of the recipes with IDs:");
        $this->log->debug($recipe_id_list);
        $recipe_page = new RecipePage($this->db, $this->conn);
        $recipes_details = array();
        foreach ($recipe_id_list as $recipe_id){
            $recipe_name = $recipe_page->getRecipeName($recipe_id);
            $recipe_method = $recipe_page->getRecipeMethod($recipe_id);
            $recipe_ingredients = $recipe_page->getRecipeIngredients($recipe_id);
            array_push($recipes_details, array("name"=>$recipe_name, 
                "ingredients"=>$recipe_ingredients, "method"=>$recipe_method));
        }
        $this->log->debug("Found names, methods and ingredients:");
        $this->log->debug($recipes_details);
        return $recipes_details;
    }
    
    function getCurrentCollectionName(){
        $this->log->info("Getting the name of the current recipe collection.");
        return self::getCollectionName($this->id);
    }
    
    function getCurrentCollectionRecipes(){
        $this->log->info("Getting the IDs of the recipes that belong to the current collection.");
        return self::getCollectionRecipes($this->id);
    }
    
    function getCurrentCollectionRecipesDetails(){
        $this->log->info("Getting the details of the recipes that belong to the current collection.");
        $recipe_ids = self::getCurrentCollectionRecipes();
        return self::getMultipleRecipesDetails($recipe_ids);
    }
}
