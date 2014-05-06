<?php
/*  Preparation
 *  Lookup, list of available preparation styles - diced, cubed, etc.
 *  Matches Preparation table
 *  Each object represents a row in the table
 *  Use variables as normal, despite private visibility (i.e., $objRep->varName)
 *  See DatabaseObject.trait.php for creation information
 */

require_once "Classes/DatabaseObject.trait.php";
 
class Preparation {
	use DatabaseObjectSimple;
	//set these
	//private static $tableName = "User"; //Works, doesn't interfere with mysql_fetch_object
	//private static $idName = "UserID"; //set to array of names if composite key
	private $PreparationName;
	
	const NAME_MAXWIDTH = 15;
	
	//Validate each variable passed in
	//data should be column/value pairs
	//public abstract function validate($data) {}
	
}

Preparation::$tableName = "Preparation";
Preparation::$idName = "PreparationName";
?>
