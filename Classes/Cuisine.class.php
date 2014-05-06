<?php
/*  Cuisine
 *  Lookup, list of available cuisines
 *  Matches Cuisine table
 *  Each object represents a row in the table
 *  Use variables as normal, despite private visibility (i.e., $objRep->varName)
 *  See DatabaseObject.trait.php for creation information
 */

require_once "Classes/DatabaseObject.trait.php";
 
class Cuisine {
	use DatabaseObjectSimple;
	
	//Variables
	private $CuisineName;
	
	const NAME_MAXWIDTH = 20;
	
	//Validate each variable passed in
	//data should be column/value pairs
	//public abstract function validate($data) {}
	
}

Cuisine::$tableName = "Cuisine";
Cuisine::$idName = "CuisineName";
?>
