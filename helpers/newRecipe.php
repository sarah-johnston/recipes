<?php
/**
 * Class to handle adding a new recipe to the site.
 *
 * @author Sarah.Johnston
 */
class newRecipe {
    
    private $log;
    private $db;
    
    function __construct($db, $conn) {
        $this->db = $db;
        $this->conn = $conn;
        $this->log = Logger::getLogger(__CLASS__);
    }
    
    function getAllIngredients(){
        $this->log->info("Getting the list of all available ingredients.");
        $sql = "SELECT recipe_ingredient, recipe_ingredient_id FROM ingredients";
        return $this->db->runQuery($this->conn, $sql);
    }
    
    function getAllUnits(){
        $this->log->info("Getting the list of all available units.");
        $sql = "SELECT unit_name, unit_id FROM units";
        return $this->db->runQuery($this->conn, $sql);
    }
    
    function generateIngredientsList(){
        $ingredients_list = self::getAllIngredients();
        $ingredients = array();
        if (mysqli_num_rows($ingredients_list) > 0){
            while($row = mysqli_fetch_assoc($ingredients_list)){
                $ingredients[$row['recipe_ingredient_id']] = $row['recipe_ingredient'];
            }
            $this->log->trace("Found ingredients:");
            $this->log->trace($ingredients);
            return $ingredients;
        }
        else{
            $this->log->warn("Did not find any available ingredients.");
            return [""];
        }
    }
        
    function generateUnitsList(){
        $units_list = self::getAllUnits();
        $units = array("None");
        if (mysqli_num_rows($units_list) > 0){
            while($row = mysqli_fetch_assoc($units_list)){
                $units[$row['unit_id']] = $row['unit_name'];
            }
            $this->log->trace("Found units:");
            $this->log->trace($units);
            return $units;
        }
        else{
            $this->log->warn("Did not find any available units.");
            return [""];
        }
        return $units;
    }
    
    function addNewRecipe($recipe_name, $ingredients, $method){
        
        $recipe_id = self::addRecipeNameAndMethod($recipe_name, $method);
        self::addRecipeIngredients($recipe_id, $ingredients);
        return $recipe_id;
    }
    
    private function addRecipeNameAndMethod($recipe_name, $method){
        $sql = "INSERT INTO recipes (recipe_name, recipe_method) VALUES ('" . $recipe_name . "', '" . $method . "');";
        $this->db->runQuery($this->conn, $sql);
        $recipe_id = $this->conn->insert_id;
        $this->log->info("ID of the new recipe:");
        $this->log->info($recipe_id);
        return $recipe_id;
    }
    
    private function addRecipeIngredients($recipe_id, $ingredients){
        for ($i = 0; $i < count($ingredients[0]); $i++) {
            $ingredient_id = $ingredients[0][$i];
            $this->log->info("Ingredient id:");
            $this->log->info($ingredient_id);

            $amount = $ingredients[1][$i];
            $this->log->info("Amount:");
            $this->log->info($amount);

            $unit_id = $ingredients[2][$i];
            $this->log->info("Unit id:");
            $this->log->info($unit_id);

            $sql = "INSERT INTO recipe_ingredients (recipe_id, 
                recipe_ingredient_id, recipe_ingredient_amount, unit_id)
                VALUES('" . $recipe_id . "', '" . $ingredient_id . "', '" . $amount . "', '" . $unit_id . "');";
            $this->db->runQuery($this->conn, $sql);
        }
    }
    
}
