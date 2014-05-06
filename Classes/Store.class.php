<?php
/*  Store
 *  General information about a physical store
 *    That is, one for each building, not one for each brand
 *  Use brand to connect to store's name
 *  Matches Store table
 *  Each object represents a row in the table
 *  Use variables as normal, despite private visibility (i.e., $objRep->varName)
 *  See DatabaseObject.trait.php for creation information
 */

require_once "Classes/DatabaseObject.trait.php";
 
class Store {
	use DatabaseObjectAutoGen;
	
	//Variables
	private $StoreID;
	private $BrandID;
	private $Address; //tinyText
	//Restrictions
	
	//Help messages
	//... can't use variables/constants to define constants
	
	//Defaults
	
	
	//Validate each variable passed in
	//data should be column/value pairs
	//public abstract function validate($data) {}
	
}

Store::$tableName = "Store";
Store::$idName = "StoreID";
?>
