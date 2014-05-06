<?php
/*  Recipe
 *  General information for each recipe - total cooking time, description, etc.
 *    Use RecipeOverview for the complete recipe with steps, ingredients, and tools
 *  Matches Recipe table
 *  Each object represents a row in the table
 *  Use variables as normal, despite private visibility (i.e., $objRep->varName)
 *  See DatabaseObject.trait.php for creation information
 */

require_once "Classes/DatabaseObject.trait.php";
 
class Recipe {
	use DatabaseObjectAutoGen;
	
	//Variables
	private $RecipeID;
	private $Name;
	private $UserIDCreator;
	private $CookingTime;
	private $Description;
	private $PreparationInstructions;
	private $Source; //tinyText
	private $AuthorID;
	private $BrandID;
	private $Image; //blob
	private $Servings; //tinyInt
	private $Unfinished; //boolean
	//Restrictions
	const NAME_MAXWIDTH = 20;
	const DESCRIPTION_MAXWIDTH = 100;
	const PREPARATIONINSTRUCTIONS_MAXWIDTH = 100;
	//Help messages
	//... can't use variables/constants to define constants
	const HELP_NAME = "Letters only, 20 character max.";
	const HELP_DESCRIPTION = "Letters only, 100 character max";
	const HELP_PREPARATIONINSTRUCTIONS = "Letters only, 100 character max";
	
	//Defaults
	
	
	//Validate each variable passed in
	//data should be column/value pairs
	//public abstract function validate($data) {}
	
}

Recipe::$tableName = "Recipe";
Recipe::$idName = "RecipeID";
?>
