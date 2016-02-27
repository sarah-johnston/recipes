<?php
include('RecipePage.php');
/**
 * Class to handle the display of a collection of recipes.
 *
 * @author Sarah.Johnston
 */
class recipeCollectionPage {
    function __construct($db) {
        $this->db = $db;
        $this->conn = $this->db->connectToDatabase();
        $this->id = mysqli_real_escape_string($this->conn, $_POST['id']);
    }
    
    function getCollectionName($collection_id){
        $sql = "SELECT collection_name FROM collections WHERE collection_id = " . $collection_id;
        return mysqli_fetch_assoc(mysqli_query($this->conn, $sql))['collection_name'];
    }

    /**
     * Returns a list of the IDs of the recipes included in the collection.
     */
    function getCollectionRecipes($collection_id){
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
        return $recipe_ids;
    }    
    
    function getMultipleRecipesDetails($recipe_id_list){
        $recipe_page = new RecipePage($this->db);
        $recipes_details = array();
        foreach ($recipe_id_list as $recipe_id){
            $recipe_name = $recipe_page->getRecipeName($recipe_id);
            $recipe_method = $recipe_page->getRecipeMethod($recipe_id);
            $recipe_ingredients = $recipe_page->getRecipeIngredients($recipe_id);
            array_push($recipes_details, array("name"=>$recipe_name, 
                "ingredients"=>$recipe_ingredients, "method"=>$recipe_method));
        }
        return $recipes_details;
    }
    
    function getCurrentCollectionName(){
        return self::getCollectionName($this->id);
    }
    
    function getCurrentCollectionRecipes(){
        return self::getCollectionRecipes($this->id);
    }
    
    function getCurrentCollectionRecipesDetails(){
        $recipe_ids = self::getCurrentCollectionRecipes();
        return self::getMultipleRecipesDetails($recipe_ids);
    }
}
