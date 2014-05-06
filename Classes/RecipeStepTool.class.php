<?php
/*  RecipeStepTool
 *  Tool used in this step in this recipe
 *  Matches RecipeStepTool table
 *  Each object represents a row in the table
 *  Use variables as normal, despite private visibility (i.e., $objRep->varName)
 *  See DatabaseObject.trait.php for creation information
 */

require_once "Classes/DatabaseObject.trait.php";
 
class RecipeStepTool {
	use DatabaseObjectComposite;
	
	//Variables
	private $RecipeID;
	private $StepID;
	private $ToolID;
	private $UserIDCreator;
	private $PreferredBrand;
	//Restrictions
	const MEASUREMENT_MAXWIDTH = 15;
	const PREPARATION_MAXWIDTH = 15;
	//Help messages
	//... can't use variables/constants to define constants
	
	
	//Validate each variable passed in
	//data should be column/value pairs
	//public abstract function validate($data) {}
	
}

RecipeStepTool::$tableName = "RecipeStepTool";
RecipeStepTool::$idFields = array("RecipeID", "StepID", "ToolID");
?>
