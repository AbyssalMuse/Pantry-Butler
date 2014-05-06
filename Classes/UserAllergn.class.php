<?php
/*  UserAllergn
 *  Severity of each allergn for each user
 *  Matches UserAllergn table
 *  Each object represents a row in the table
 *  Use variables as normal, despite private visibility (i.e., $objRep->varName)
 *  See DatabaseObject.trait.php for creation information
 */

require_once "Classes/DatabaseObject.trait.php";
 
class UserAllergn {
	use DatabaseObjectComposite;
	
	//Variables
	private $UserID;
	private $AllergnID;
	private $Degree; //tinyInt
	//Restrictions
	
	//Help messages
	//... can't use variables/constants to define constants
	
	
	//Validate each variable passed in
	//data should be column/value pairs
	//public abstract function validate($data) {}
	
}

UserAllergn::$tableName = "UserAllergn";
UserAllergn::$idFields = array("UserID", "AllergnID");
?>
