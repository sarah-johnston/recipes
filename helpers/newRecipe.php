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
    
}
