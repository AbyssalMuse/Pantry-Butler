<?php
/*  GroceryList
 *  List of ingredients each user needs
 *  Matches GroceryList table
 *  Each object represents a row in the table
 *  Use variables as normal, despite private visibility (i.e., $objRep->varName)
 *  See DatabaseObject.trait.php for creation information
 */

require_once "Classes/DatabaseObject.trait.php";
 
class GroceryList {
	use DatabaseObjectComposite;
	
	//Variables
	private $UserID;
	private $IngredientID;
	private $Priority; //int unsigned
	//Restrictions
	
	//Help messages
	//... can't use variables/constants to define constants
	
	
	//Validate each variable passed in
	//data should be column/value pairs
	//public abstract function validate($data) {}
	
}

GroceryList::$tableName = "GroceryList";
GroceryList::$idFields = array("UserID", "IngredientID");
?>
