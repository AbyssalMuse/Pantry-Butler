<?php
	/*	Initial Setup AJAX
		Database interface for Initial Setup
		Issue commands with appropriate Action word, include data
		  in appropriate fields, use POST
		
		Queries return objects representing a row in the table
		This information is processed and passed on to page
		For instance, we need the names of cuisines so we 
		  ask database for all cuisines, get back an array
		  of Cuisine objects, walk through that array 
		  copying their names into a data array, and send
		  the page that data array of names
		  
		Manipulating the database will work in reverse
		Page sends new information and ID to here
		This page sets the variable, which is propagated up
		For instance, we need to note that a user likes Indian
		  cuisine, so we get an Action "AddCuisine" with 
		  "CuisineName" = "Indian", this page then constructs a
		  UserCuisine matching that user and the Indian cuisine, 
		  then it sets the Rating to "Like" with 
		  $newUserCuisine->Rating = "Like"
		
		Note - can't pass back objects directly from slice/results yet
	        All variables are private and json_encode, by default, ignores those
	        Can override this by implementing the JSON_Serializable interface
	*/
	/*	To do: Work on uploading information back to database
	
	*/
	
	//Warning - don't require a page with html data
	//  It will print out and send back that entire page
	require_once "Classes/RecipeOverview.class.php";
	require_once "Classes/Allergn.class.php";
	require_once "Classes/RecipeAllergn.class.php";
	require_once "Classes/Cuisine.class.php";

	require_once "Classes/DatabaseTools.class.php";
	$dbo = new DatabaseTools();
	$dbo->connect(); //... legacy?
	
	if (isset($_POST["Action"])) {
		if ($_POST["Action"] == "AllCuisines") {
			$cuisines = Cuisine::createSliceFromQuery("", "CuisineName");
			$data = array();
			foreach ($cuisines as $cuisine) {
				array_push($data, $cuisine->CuisineName);
			}
			header('Content-Type: application/json');
			echo json_encode($data);
		} else if ($_POST["Action"] == "AllAllergns") {
			$allergns = Allergn::createSliceFromQuery("", "Name");
			$data = array();
			foreach ($allergns as $allergn) {
				array_push($data, $allergn->Name);
			}
			header('Content-Type: application/json');
			echo json_encode($data);
		} else if ($_POST["Action"] == "Meals") {
			$recipes = Recipe::createSliceFromQuery("RecipeID IN (SELECT RecipeID FROM RecipeCuisine WHERE CuisineID = '{$_POST["Cuisine"]}')", "Name");
			$data = array();
			foreach ($recipes as $recipe) {
				array_push($data, $recipe->Name);
			}
			header('Content-Type: application/json');
			echo json_encode($data);
		} else if ($_POST["Action"] == "AllergnDescription") {
			$allergns = Allergn::createSliceFromQuery("Name = '{$_POST["Allergn"]}'");
			//header = text
			echo $allergns[0]->Description;
		} else if ($_POST["Action"] == "AllergnMeals") {
			$query = "SELECT Name FROM Recipe INNER JOIN RecipeAllergn WHERE AllergnID = (SELECT AllergnID FROM Allergn WHERE Name = '{$_POST["Allergn"]}');";
			$result = mysql_query($query);
			if (mysql_num_rows($result) > 0) {
				$data = $dbo->processRowSet($result);
			} else {
				$data = null;
			}
			header('Content-Type: application/json');
			echo json_encode($data);
		} else if ($_POST["Action"] == "MealDetails") {
			$recipe = RecipeOverview::createFromName($_POST["RecipeName"]);
			//test
			$ingredients = array();
			for ($i = 0; $i < $recipe->getNumIngredients(); $i++) {
				$name = $recipe->getIngredient($i)->getName();
				$amount = $recipe->getIngredient($i)->getAmount();
				$measurement = $recipe->getIngredient($i)->getMeasurementName();
				array_push($ingredients, array("name"=>$name, "amount"=>$amount, "measurement"=>$measurement));
			}
			$tools = array();
			for ($i = 0; $i < $recipe->getNumTools(); $i++) {
				array_push($tools, array("name"=>$recipe->getToolName($i)));
			}
			$info = array("ingredients"=>$ingredients, "tools"=>$tools);
			//var_dump($info);
			header('Content-Type: application/json');
			echo json_encode($info);
		} else {
			echo "Unknown action " + $_POST["Action"];
		}
		
	} else { //... handle better
		echo "No action passed";
	}
?>
