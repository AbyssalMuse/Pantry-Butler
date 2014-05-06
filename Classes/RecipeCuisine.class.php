<?php
/*  RecipeCuisine
 *  Connect recipe to cuisine
 *  Matches RecipeCuisine table
 *  Each object represents a row in the table
 *  Use variables as normal, despite private visibility (i.e., $objRep->varName)
 *  See DatabaseObject.trait.php for creation information
 */

require_once "Classes/DatabaseObject.trait.php";
 
class RecipeCuisine {
	use DatabaseObjectComposite;
	//set these
	//private static $tableName = "User"; //Works, doesn't interfere with mysql_fetch_object
	//private static $idName = "UserID"; //set to array of names if composite key
	private $RecipeID;
	private $CuisineID;
	//Restrictions
	const CUISINE_MAXWIDTH = 20;
	//Help messages
	//... can't use variables/constants to define constants
	const HELP_INSTRUCTIONS = "20 character max.";
	
	//Validate each variable passed in
	//data should be column/value pairs
	//public abstract function validate($data) {}
	
}

RecipeCuisine::$tableName = "RecipeCuisine";
RecipeCuisine::$idFields = array("RecipeID", "CuisineID");
?>
