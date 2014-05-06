<?php
/*  Ingredient
 *  General information on each ingredient - name, image, description, etc.
 *  Matches Ingredient table
 *  Each object represents a row in the table
 *  Use variables as normal, despite private visibility (i.e., $objRep->varName)
 *  See DatabaseObject.trait.php for creation information
 */

require_once "Classes/DatabaseObject.trait.php";
 
class Ingredient {
	use DatabaseObjectAutoGen;
	
	//Variables
	private $IngredientID;
	private $Name;
	private $Description; //tinyText
	private $Image; //blob
	private $UserIDCreator;
	//Restrictions
	const NAME_MAXWIDTH = 20;
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

Ingredient::$tableName = "Ingredient";
Ingredient::$idName = "IngredientID";
?>
