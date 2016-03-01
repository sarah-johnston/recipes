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
        $sql = "SELECT recipe_ingredient FROM ingredients";
        return $this->db->runQuery($this->conn, $sql);
    }
    
    function getAllUnits(){
        $sql = "SELECT unit_name FROM units";
        return $this->db->runQuery($this->conn, $sql);
    }
    
    function generateIngredientsList(){
        $ingredients_list = self::getAllIngredients();
        $ingredients = array();
        if (mysqli_num_rows($ingredients_list) > 0){
            while($row = mysqli_fetch_assoc($ingredients_list)){
                array_push($ingredients, $row['recipe_ingredient']);
            }
            return $ingredients;
        }
        else{
            return [""];
        }
        return $ingredients;
    }
        
    function generateUnitsList(){
        $units_list = self::getAllUnits();
        $units = array("None");
        if (mysqli_num_rows($units_list) > 0){
            while($row = mysqli_fetch_assoc($units_list)){
                array_push($units, $row['unit_name']);
            }
            return $units;
        }
        else{
            return [""];
        }
        return $units;
    }
    
}
