<?php

/*  Recipe Overview
    For print out, such as cooking steps
    Read-only - no mutators (use Recipe/Step/StepIngredient classes)
    Not the same as a Recipe object
    To do:
    	Make all variables read-only - disconnect from database completely
    	... not quite, need this for recipe creation too
*/

require_once "Classes/Recipe.class.php";
require_once "Classes/RecipeStep.class.php";
require_once "Classes/RecipeStepIngredient.class.php";
require_once "Classes/Tool.class.php";
require_once "Classes/Ingredient.class.php";
require_once "Classes/Measurement.class.php";
require_once "Classes/Preparation.class.php";

class RecipeOverview {
	//Variables
	private $recipe;
	private $steps = array();		//Array of inner-class steps, contains ingredients for that step
	//Overview collections
	//... could just make these functions
	private $ingOverview = array();		//Array of inner-class ingredients
	private $toolOverview = array();	//Array of strings
	private $timeTotal;			//number of seconds, or string?
	
	
	//Constructors
	function __construct($id) {
		$this->recipe = Recipe::createFromQuery($id);
		$steps = RecipeStep::createSliceFromQuery("RecipeID = '$id'", "StepID");
		foreach ($steps as $step) {
			array_push($this->steps, new RecipeOverviewStep($step));
		}
		$ingredients = RecipeStepIngredient::createSliceFromQuery("RecipeID = '$id'", "StepID, IngredientID");
		foreach ($ingredients as $ingredient) {
			$step = $this->steps[$ingredient->StepID];
			$step->addIngredient($ingredient);
		}
		//Overview info
		foreach ($this->steps as $step) {
			if (!$step->hasTool())
				continue;
			if (!in_array($step->getToolName(), $this->toolOverview))
				array_push($this->toolOverview, $step->getToolName());
		}
		foreach ($this->steps as $step) {
			for ($i = 0; $i < $step->getNumIngredients(); $i++) {
				$ingredient = $step->getIngredient($i);
				$alreadyInOverview = false;
				foreach ($this->ingOverview as $ingInOverview) {
					if ($ingredient->getName() == $ingInOverview->getName()) {
						if (($ingredient->getMeasurementName() == $ingInOverview->getMeasurementName()) && ($ingredient->getPreparationName() == $ingInOverview->getPreparationName())) {
							$ingInOverview = $this->ingOverview[$iOverview];
							$ingInOverview->addAmount($ingredient->getAmount());
							$alreadyInOverview = true;
							break;
						}
					}
				}
				if ($alreadyInOverview === false)
					array_push($this->ingOverview, new ScratchIngredient($ingredient)); //Scratch because we'll be adding to the quantities
			}
		}
	}
	public static function createFromName($name) {
		$recipes = Recipe::createSliceFromQuery("Name = '$name'");
		//... if more than one, choose user or default
		return(new RecipeOverview($recipes[0]->RecipeID));
	}
	
	//Accessors
	public function getName() {		
		return($this->recipe->Name);
	}
	public function getNumSteps() {
		return(count($this->steps));
	}
	public function getStep($i) {
		return($this->steps[$i]);
	}
	public function getNumIngredients() {
		return(count($this->ingOverview));
	}
	public function getIngredient($i) {
		return($this->ingOverview[$i]);
	}
	public function getNumTools() {
		return(count($this->toolOverview));
	}
	public function getToolName($i) {
		return($this->toolOverview[$i]);
	}
	public function getTimeTotal() {
		return($this->recipe->CookingTime);
	}
	public function getRecipe() {
		return($this->recipe);
	}
	
	//Mutators
	//None
	
	//Others
	//Public
	
	//Private helpers
	
}

class RecipeOverviewStep {
	private $recipeStep;
	private $tool;
	private $ingredients = array();
	//... not entirely sure this is the one I want
	public function __construct($step) {
		$this->recipeStep = $step;
		//Retrieve tool
		if ($step->ToolID != null)
			$this->tool = Tool::createFromQuery($step->ToolID);
		else
			$this->tool = null;
	}
	//helper functions
	public function addIngredient($stepIngredient) {
		$ing = new RecipeOverviewIngredient($stepIngredient);
		array_push($this->ingredients, $ing);
	}
	//Accessors
	public function hasTool() {
		return(isset($this->tool));
	}
	public function getTool() {
		if (isset($this->tool))
			return($this->tool);
		else
			return(null);
	}
	public function getToolName() {
		if (isset($this->tool))
			return($this->tool->Name);
		else
			return("");
	}
	public function getNumIngredients() {
		return(count($this->ingredients));
	}
	public function getIngredient($i) {
		return($this->ingredients[$i]);
	}
	public function getInstructions() {
		return($this->recipeStep->Instructions);
	}
	public function getRecipeStep() {
		return($this->recipeStep);
	}
}

class RecipeOverviewIngredient {
	private $recipeStepIngredient;
	private $ingredient;
	private $measurement;
	private $preparation;
	
	public function __construct($stepIngredient) {
		$this->recipeStepIngredient = $stepIngredient;
		//Retrieve ingredient
		if ($stepIngredient->IngredientID != null)
			$this->ingredient = Ingredient::createFromQuery($stepIngredient->IngredientID);
		else
			$this->ingredient = null;
		//Retrieve measurement
		if ($stepIngredient->MeasurementID != null)
			$this->measurement = Measurement::createFromQuery($stepIngredient->MeasurementID);
		else
			$this->measurement = null;
		//Retrieve preparation
		if ($stepIngredient->PreparationID != null)
			$this->preparation = Preparation::createFromQuery($stepIngredient->PreparationID);
		else
			$this->preparation = null;
	}
	
	//Helper/Accessor functions
	public function getIngredient() {
		if (isset($this->ingredient))
			return($this->ingredient);
		else
			return(null);
	}
	public function getName() {
		if (isset($this->ingredient))
			return($this->ingredient->Name);
		else
			return("");
	}
	public function getAmount() {
		return($this->recipeStepIngredient->Amount);
	}
	public function getMeasurement() {
		if (isset($this->measurement))
			return($this->measurement);
		else
			return(null);
	}
	public function getMeasurementName() {
		if (isset($this->measurement)) {
			return($this->measurement->MeasurementName);
		} else
			return("");
	}
	public function hasPreparation() {
		return(isset($this->preparation));
	}
	public function getPreparation() {
		if (isset($this->preparation))
			return($this->preparation);
		else
			return(null);
	}
	public function getPreparationName() {
		if (isset($this->preparation))
			return($this->preparation->PreparationName);
		else
			return("");
	}
	public function getRecipeStepIngredient() {
		return($this->recipeStepIngredient);
	}
}

//decoupled from database for overview information
class ScratchIngredient {
	public $name;
	public $amount;
	public $measurement;
	public $preparation;
	
	public function __construct($recipeOverviewIngredient) {
		$this->name = $recipeOverviewIngredient->getName();
		$this->amount = $recipeOverviewIngredient->getAmount();
		$this->measurement = $recipeOverviewIngredient->getMeasurementName();
		$this->preparation = $recipeOverviewIngredient->getPreparationName();
	}
	
	//Accessors
	public function getName() {		return($this->name);			}
	public function getAmount() {		return($this->amount);			}
	public function getMeasurementName() {	return($this->measurement);			}
	public function hasPreparation() {	return(!empty($this->preparation));	}
	public function getPreparationName() {	return($this->preparation);			}
	//Mutators
	public function addAmount($amount) {	$this->amount += $amount;		}
}
?>
