<?php
/*  RecipeAllergn
 *  Recipes that can trigger allergns and degree of severity
 *  Matches RecipeAllergn table
 *  Each object represents a row in the table
 *  Use variables as normal, despite private visibility (i.e., $objRep->varName)
 *  See DatabaseObject.trait.php for creation information
 */

require_once "Classes/DatabaseObject.trait.php";
 
class RecipeAllergn {
	use DatabaseObjectComposite;
	
	//Variables
	private $RecipeID;
	private $AllergnID;
	private $Degree; //tinyInt unsigned
	//Restrictions
	const ALLERGN_MAXWIDTH = 20;
	//Help messages
	//... can't use variables/constants to define constants
	const HELP_INSTRUCTIONS = "20 character max.";
	
	//Validate each variable passed in
	//data should be column/value pairs
	//public abstract function validate($data) {}
	
}

RecipeAllergn::$tableName = "RecipeAllergn";
RecipeAllergn::$idFields = array("RecipeID", "AllergnID");
?>
