<?php
/*  Tool
 *  General information on each tool - appliance or utensil, description, etc.
 *  Matches Tool table
 *  Each object represents a row in the table
 *  Use variables as normal, despite private visibility (i.e., $objRep->varName)
 *  See DatabaseObject.trait.php for creation information
 */

require_once "Classes/DatabaseObject.trait.php";
 
class Tool {
	use DatabaseObjectAutoGen;
	
	//Variables
	private $ToolID;
	private $Name;
	private $UserIDCreator;
	private $Appliance; //bit
	private $Utensil; //bit
	private $Description;
	//Restrictions
	const NAME_MAXWIDTH = 20;
	//Help messages
	//... can't use variables/constants to define constants
	
	//Defaults
	
	
	//Validate each variable passed in
	//data should be column/value pairs
	//public abstract function validate($data) {}
	
}

Tool::$tableName = "Tool";
Tool::$idName = "ToolID";
?>
