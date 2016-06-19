<?php

/**
 * Class to handle the display of a single recipe.
 *
 * @author Sarah.Johnston
 */
class recipePage {
    
    private $log;

    function __construct($db, $conn) {
        $this->db = $db;
        $this->conn = $conn;
        $this->id = mysqli_real_escape_string($conn, $_GET['id']);
        $this->log = Logger::getLogger(__CLASS__);
    }
    
    function getRecipeName($recipe_id){
        $this->log->debug("Getting the name of the recipe with ID '". $recipe_id . "'");
        $sql = "SELECT recipe_name FROM recipes WHERE recipe_id = " 
                    .$recipe_id. " LIMIT 1";
        return mysqli_fetch_assoc($this->db->runQuery($this->conn, $sql))['recipe_name'];
    }
    
    function getRecipeIngredients($recipe_id){
        $this->log->debug("Getting the ingredients for the recipe with ID '". $recipe_id . "'");
        $sql = "SELECT ri.recipe_ingredient_amount, "
                    . "u.unit_name, i.recipe_ingredient FROM ingredients i "
                    . "INNER JOIN recipe_ingredients ri "
                    . "ON i.recipe_ingredient_id=ri.recipe_ingredient_id "
                    . "LEFT JOIN units u ON ri.unit_id=u.unit_id "
                    . "WHERE recipe_id = " .$recipe_id;
        $result = $this->db->runQuery($this->conn, $sql);
        $ingredients = array();
        while($row = mysqli_fetch_assoc($result)){
            $ingredient = array(
                "amount"=>$row['recipe_ingredient_amount'],
                "unit"=>$row['unit_name'], 
                "ingredient"=>$row['recipe_ingredient']);
            array_push($ingredients, $ingredient);
        }
        $this->log->trace("Recipe ingredients:");
        $this->log->trace($ingredients);
        return $ingredients;
    }
    
    function getRecipeMethod($recipe_id){
        $this->log->debug("Getting the method for the recipe with ID '". $recipe_id . "'");
        $sql = "SELECT recipe_method FROM recipes WHERE recipe_id = " 
                    .$recipe_id. " LIMIT 1";
        $result = nl2br(mysqli_fetch_assoc($this->db->runQuery($this->conn, $sql))['recipe_method']);
        
        $this->log->trace("Recipe method:");
        $this->log->trace($result);
        return $result;
    }
    
    function getCurrentRecipeName(){
        $this->log->info("Getting the name of the current recipe.");
        return self::getRecipeName($this->id);
    }
    
    function getCurrentRecipeId(){
        $this->log->info("Getting the ID of the current recipe.");
        return $this->id;
    }
    
    function getCurrentIngredients(){
        $this->log->info("Getting the ingredients of the current recipe.");
        return self::getRecipeIngredients($this->id);
    }
    
    function getCurrentMethod(){
        $this->log->info("Getting the method of the current recipe.");
        return self::getRecipeMethod($this->id);
    }
    
}
