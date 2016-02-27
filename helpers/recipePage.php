<?php

/**
 * Class to handle the display of a single recipe.
 *
 * @author Sarah.Johnston
 */
class recipePage {
    
    function __construct($db) {
        $this->db = $db;
        $this->conn = $this->db->connectToDatabase();
        $this->id = mysqli_real_escape_string($this->conn, $_POST['id']);
    }
    
    function getRecipeName($recipe_id){
        $sql = "SELECT recipe_name FROM recipes WHERE recipe_id = " 
                    .$recipe_id. " LIMIT 1";
        $result = $this->db->runQuery($this->conn, $sql);
        return mysqli_fetch_assoc($result)['recipe_name'];
    }
    
    function getRecipeIngredients($recipe_id){
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
        return $ingredients;
    }
    
    function getRecipeMethod($recipe_id){
        $sql = "SELECT recipe_method FROM recipes WHERE recipe_id = " 
                    .$recipe_id. " LIMIT 1";
        $result = $this->db->runQuery($this->conn, $sql);
        return mysqli_fetch_assoc($result)['recipe_method'];
    }
    
    function getCurrentRecipeName(){
        return self::getRecipeName($this->id);
    }
    
    function getCurrentIngredients(){
        return self::getRecipeIngredients($this->id);
    }
    
    function getCurrentMethod(){
        return self::getRecipeMethod($this->id);
    }
    
}
