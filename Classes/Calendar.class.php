<?php
/*  Calendar
 *  Planned meal - recipe and date
 *  Matches Calendar table
 *  Each object represents a row in the table
 *  Use variables as normal, despite private visibility (i.e., $objRep->varName)
 *  See DatabaseObject.trait.php for creation information
 */

require_once "Classes/DatabaseObject.trait.php";
 
class Calendar {
	use DatabaseObjectComposite;
	
	//Variables
	private $UserID;
	private $RecipeID;
	private $PlannedDate; //date
	//Restrictions
	
	//Help messages
	//... can't use variables/constants to define constants
	
	
	//Validate each variable passed in
	//data should be column/value pairs
	//public abstract function validate($data) {}
	
}

Calendar::$tableName = "Calendar";
Calendar::$idFields = array("UserID", "RecipeID");
?>
