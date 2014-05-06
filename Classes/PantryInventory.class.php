<?php
/*  PantryInventory
 *  List of ingredients each user has
 *  Matches PantryInventory table
 *  Each object represents a row in the table
 *  Use variables as normal, despite private visibility (i.e., $objRep->varName)
 *  See DatabaseObject.trait.php for creation information
 */

require_once "Classes/DatabaseObject.trait.php";
 
class PantryInventory {
	use DatabaseObjectComposite;
	
	//Variables
	private $UserID;
	private $IngredientID;
	private $Amount; //float
	private $MeasurementID; //15 length
	private $Priority; //int unsigned
	private $BrandIDPreffered;
	//Restrictions
	//??? choose from list for measurement
	//Help messages
	//... can't use variables/constants to define constants
	
	
	//Validate each variable passed in
	//data should be column/value pairs
	//public abstract function validate($data) {}
	
}

PantryInventory::$tableName = "PantryInventory";
PantryInventory::$idFields = array("UserID", "IngredientID");
?>
