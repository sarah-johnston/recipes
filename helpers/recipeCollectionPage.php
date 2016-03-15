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
    /**
     * Gets the name of a recipe collection, given the ID.
     * 
     * @param type $collection_id : ID of the recipe collection.
     * @return type : name of the recipe collection
     */
    function getCollectionName($collection_id){
        // 
        $this->log->debug("Getting the name of the recipe collection with ID '". $collection_id . "'");
        $sql = "SELECT collection_name FROM collections WHERE collection_id = " . $collection_id;
        return mysqli_fetch_assoc($this->db->runQuery($this->conn, $sql))['collection_name'];
    }
    /**
     * Returns a list of the IDs of the recipes included in the collection.
     * 
     * @param type $collection_id : ID of the recipe collection.
     * @return type : list of the recipe IDs in the collection.
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
        $this->log->trace("Found recipes with IDs:");
        $this->log->trace($recipe_ids);
        return $recipe_ids;
    }    
    
    /**
     * 
     * @param type $recipe_id_list
     * @return array
     */
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
        $this->log->trace("Found names, methods and ingredients:");
        $this->log->trace($recipes_details);
        return $recipes_details;
    }
    
    /**
     * 
     * @return type
     */
    function getCurrentCollectionName(){
        $this->log->info("Getting the name of the current recipe collection.");
        return self::getCollectionName($this->id);
    }
    
    /**
     * 
     * @return type
     */
    function getCurrentCollectionRecipes(){
        $this->log->info("Getting the IDs of the recipes that belong to the current recipe collection.");
        return self::getCollectionRecipes($this->id);
    }
    
    /**
     * 
     * @return type
     */
    function getCurrentCollectionRecipesDetails(){
        $this->log->info("Getting the details of the recipes that belong to the current recipe collection.");
        $recipe_ids = self::getCurrentCollectionRecipes();
        return self::getMultipleRecipesDetails($recipe_ids);
    }
}
