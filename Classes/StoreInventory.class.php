<?php
/*  StoreInventory
 *  List of ingredients at store, along with price and quantity
 *  Matches StoreInventory table
 *  Each object represents a row in the table
 *  Use variables as normal, despite private visibility (i.e., $objRep->varName)
 *  See DatabaseObject.trait.php for creation information
 */

require_once "Classes/DatabaseObject.trait.php";
 
class StoreInventory {
	use DatabaseObjectComposite;
	
	//Variables
	private $StoreID;
	private $IngredientID;
	private $Price;
	private $Quantity;
	//Restrictions
	
	//Help messages
	//... can't use variables/constants to define constants
	
	
	//Validate each variable passed in
	//data should be column/value pairs
	//public abstract function validate($data) {}
	
}

StoreInventory::$tableName = "StoreInventory";
StoreInventory::$idFields = array("StoreID", "IngredientID");
?>
