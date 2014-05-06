<?php
/*  UserRecipeInfo
 *  User comments and statistics for each recipe, including ratings, associated author, etc.
 *  Matches UserRecipeInfo table
 *  Each object represents a row in the table
 *  Use variables as normal, despite private visibility (i.e., $objRep->varName)
 *  See DatabaseObject.trait.php for creation information
 */

require_once "Classes/DatabaseObject.trait.php";
 
class UserRecipeInfo {
	use DatabaseObjectComposite;
	
	//Variables
	private $UserID;
	private $RecipeID;
	private $AuthorIDOverwrite;
	private $BrandIDOverwrite;
	private $FirstCook; //date
	private $LastCook; //date
	private $NumberOfCooks; //smallInt, unsigned
	private $Rating; //tinyInt unsigned
	private $AveragePrice; //float
	//Restrictions
	
	//Help messages
	//... can't use variables/constants to define constants
	
	
	//Validate each variable passed in
	//data should be column/value pairs
	//public abstract function validate($data) {}
	
}

UserRecipeInfo::$tableName = "UserRecipeInfo";
UserRecipeInfo::$idFields = array("UserID", "RecipeID");
?>
