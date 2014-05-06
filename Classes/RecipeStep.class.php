<?php
/*  RecipeStep
 *  Information on each step in a recipe, including necessary cooking time
 *  Matches RecipeStep table
 *  Each object represents a row in the table
 *  Use variables as normal, despite private visibility (i.e., $objRep->varName)
 *  See DatabaseObject.trait.php for creation information
 */
 //To do: Remove ToolID - now using a table

require_once "Classes/DatabaseObject.trait.php";
 
class RecipeStep {
	use DatabaseObjectComposite;
	//set these
	//private static $tableName = "User"; //Works, doesn't interfere with mysql_fetch_object
	//private static $idName = "UserID"; //set to array of names if composite key
	private $RecipeID;
	private $StepID;
	private $UserIDCreator;
	private $Instructions;
	private $ToolID;
	private $CookingTime;
	//Restrictions
	const INSTRUCTIONS_MAXWIDTH = 500;
	//Help messages
	//... can't use variables/constants to define constants
	const HELP_INSTRUCTIONS = "500 character max.";
	
	//Validate each variable passed in
	//data should be column/value pairs
	//public abstract function validate($data) {}
	
}

RecipeStep::$tableName = "RecipeStep";
RecipeStep::$idFields = array("RecipeID", "StepID");
?>
