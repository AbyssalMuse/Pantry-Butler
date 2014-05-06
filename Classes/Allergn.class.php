<?php
/*  Allergn
 *  General information on each allergn - name, description, etc.
 *  Matches Allergn table
 *  Each object represents a row in the table
 *  Use variables as normal, despite private visibility (i.e., $objRep->varName)
 *  See DatabaseObject.trait.php for creation information
 */

require_once "Classes/DatabaseObject.trait.php";
 
class Allergn {
	use DatabaseObjectAutoGen;
	
	//Variables
	private $AllergnID;
	private $Name;
	private $Description;
	//Restrictions
	const NAME_MAXWIDTH = 30;
	const DESCRIPTION_MAXWIDTH = 100;
	//Help messages
	//... can't use variables/constants to define constants
	const HELP_NAME = "Letters only, 30 character max.";
	const HELP_DESCRIPTION = "Letters only, 100 character max";
	
	//Defaults
	
	
	//Validate each variable passed in
	//data should be column/value pairs
	//public abstract function validate($data) {}
	
}

Allergn::$tableName = "Allergn";
Allergn::$idName = "AllergnID";
?>
