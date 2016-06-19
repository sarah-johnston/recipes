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
    
    /**
     * Returns all available ingredients in the database.
     * 
     * @return type : Array of all ingredient IDs and names in the database.
     */
    function getAllIngredients(){
        $this->log->info("Getting the list of all available ingredients.");
        $sql = "SELECT recipe_ingredient, recipe_ingredient_id FROM ingredients ORDER BY recipe_ingredient ASC";
        return $this->db->runQuery($this->conn, $sql);
    }
    
    /**
     * Returns all available units in the database.
     * 
     * @return type : Array of all unit IDs and names in the database.
     */
    function getAllUnits(){
        $this->log->info("Getting the list of all available units.");
        $sql = "SELECT unit_name, unit_id FROM units ORDER BY unit_name ASC";
        return $this->db->runQuery($this->conn, $sql);
    }
    
    /**
     * Returns all available types of units in the database.
     * 
     * @return type : Array of all unit type IDs and names in the database.
     */
    function getAllUnitTypes(){
        $this->log->info("Getting the list of all available unit types.");
        $sql = "SELECT unit_type, unit_type_id FROM unit_types";
        return $this->db->runQuery($this->conn, $sql);
    }

    /**
     * Returns a list of all available ingredients and their IDs.
     * 
     * @return type : Array of all ingredient IDs and names in the database.
     */
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
        
    /**
     * Returns a list of all available units and their IDs.
     * 
     * @return type : Array of all unit IDs and names in the database.
     */
    function generateUnitsList(){
        // Generate the list of all available units.
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
    
    /**
     * Returns a list of all available unit types and their IDs.
     * 
     * @return type : Array of all unit type IDs and names in the database.
     */
    function generateUnitTypesList(){
        $unit_types_list = self::getAllUnitTypes();
        $unit_types = array();
        if (mysqli_num_rows($unit_types_list) > 0){
            while($row = mysqli_fetch_assoc($unit_types_list)){
                $unit_types[$row['unit_type_id']] = $row['unit_type'];
            }
            $this->log->trace("Found ingredients:");
            $this->log->trace($unit_types);
            return $unit_types;
        }
        else{
            $this->log->warn("Did not find any available ingredients.");
            return [""];
        }
    }
    
    /**
     * Adds a new recipe to the database.
     * 
     * @param type $recipe_name : Name of the new recipe.
     * @param type $ingredients : Ingredients in the new recipe.
     * @param type $method : Method for the new recipe.
     * @return type : ID of the new recipe.
     */
    function addNewRecipe($recipe_name, $ingredients, $method){
        $recipe_id = self::addRecipeNameAndMethod($recipe_name, $method);
        self::addRecipeIngredients($recipe_id, $ingredients);
        return $recipe_id;
    }
    
    /**
     * Helper funtion which adds the name and method of a new recipe to the 
     * database, and returns the ID of the new recipe.
     * 
     * @param type $recipe_name : Name of the new recipe.
     * @param type $method : Method for the new recipe.
     * @return type : ID of the new recipe.
     */
    private function addRecipeNameAndMethod($recipe_name, $method){
        $sql = "INSERT INTO recipes (recipe_name, recipe_method) VALUES ('" . $recipe_name . "', '" . $method . "');";
        $this->db->runQuery($this->conn, $sql);
        $recipe_id = $this->conn->insert_id;
        $this->log->info("ID of the new recipe:");
        $this->log->info($recipe_id);
        return $recipe_id;
    }
    
    /**
     * Helper function which adds the ingredients of a new 
     * @param type $recipe_id
     * @param type $ingredients
     */
    private function addRecipeIngredients($recipe_id, $ingredients){
        // Helper function to add the ingredients of the new recipe to the database, given the recipe id.
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
    
    function addNewIngredient($ingredient_name, $ingredient_name_plural){
        // Adds a new ingredient to the database.
        $sql = "INSERT INTO ingredients (recipe_ingredient, recipe_ingredient_plural) VALUES ('" . $ingredient_name . "', '" . $ingredient_name_plural . "');";
        $this->db->runQuery($this->conn, $sql);
        $ingredient_id = $this->conn->insert_id;
        $this->log->info("ID of the new ingredient:");
        $this->log->info($ingredient_id);
        return $ingredient_id;
    }
    
    function addNewUnit($unit_name, $unit_type, $unit_to_si){
        // Adds a new unit to the database.
        $sql = "INSERT INTO units (unit_name, unit_type_id, unit_to_si_amount) VALUES ('" . $unit_name . "', '" . $unit_type . "', '" . $unit_to_si . "');";
        $this->db->runQuery($this->conn, $sql);
        $unit_id = $this->conn->insert_id;
        $this->log->info("ID of the new unit:");
        $this->log->info($unit_id);
        return $unit_id;
    }
}
