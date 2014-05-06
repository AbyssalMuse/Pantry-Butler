<!-- Initial Setup
     Collect all necessary information from user to get them started
     Need to plan enough meals to last until they want to go shopping, like a week or so
       Find their cuisine preferences, their allergns, and calculate meals from those
       Then let them choose a recipe
       Show ingredients for recipe, select if they Have it, Need More, Don't Have it, or Don't Know
       After they've set up the information enable the Add to Calendar button
         If ingredients were missing (Don't have it) then add to the Cook Later/After shopping list
         If they have all the ingredients then add to the Cook list
         If they need more or don't have an ingredient then add to the Shopping List
       Should locate nearby stores as well, but haven't added that yet
       
     Dynamically pulls information from database, but there's not much in the database at this point
     To see lists fill in, choose Cuisines I Like -> Indian, then Meals -> Keema, fill in ingredient information and click Add to Calendar
     To see Allergns in action, choose Cuisines I Like -> Indian, then Allergns -> Citrus
-->

<!-- Common tools, php classes -->
<?php
	require_once "Includes/Global.inc.php";
?>

<!DOCTYPE html>
<html lang="en">
  	<head>
  		<!-- Bootstrap copy -->
  		<!-- To do: Probably useful for search engines, should fill out -->
  		<meta charset="utf-8">
  		<meta http-equiv="X-UA-Compatible" content="IE=edge">
  		<meta name="viewport" content="width=device-width, initial-scale=1">
  		<meta name="description" content="">
  		<meta name="author" content="">
  		<link rel="shortcut icon" href="../../assets/ico/favicon.ico">

  		<title>The Pantry Butler - Initial Setup</title>
  		
  		<!-- Common styles and javascript -->
  		<?php require_once "Includes/HTML.inc.php"; ?>
  		
  		<script>
  			var cuisineList = new Array();
  			var cuisineLikeList = new Array();
  			var cuisineTryList = new Array();
  			var allergnList = new Array();
  			var allergnChosenList = new Array();
  			var mealList = new Array();
  			var currentMeal = "";
  			var mealIngredientList = new Array();
  			var mealToolList = new Array();
  			var mealPlanList = new Array(); //list of accepted meals
  			var mealWantList = new Array(); //list of accepted, but need ingredients, meals
  			//... these lists won't be necessary when I start using the database
  			var userIngredients = new Array();
  			var userTools = new Array();
  			//shopping lists
  			var shoppingList = new Array();
  			
  			//Start up
  			//Blank all lists
			//Make database queries - cuisines and allergns
				$(document).ready(function() {
					//Blank slate
					fillCuisineLists();
					fillAllergnLists();
					fillMealList();
					
					//Start filling up lists with database queries - cuisines and allergns
					queryCuisines();
					queryAllergns();
					
					//on focus change of accordion groups, upload the information to server
					
					//Keep dropdown list open for Suggest new Cuisine!
					//Solution from Stack Overflow (http://stackoverflow.com/questions/10480697/keep-bootstrap-dropdown-open-on-click)
					$("ul.dropdown-menu").on("click", "[data-stopPropagation]", function(e) {
							e.stopPropagation();
					});
				});
  			
				//All query functions
				//... lists may already have information, if user reloads page then post/keep their information
				//    so need to merge results instead of overwriting
				//    probably separate overall lists and display lists
			
			//... can separate the cuisine list selection buttons, just append different onClicks to the different lists, like in Allergns
			//Cuisine lists
			//Once queried, fill in and light it up (already open)
				function queryCuisines() {
					$.post("InitialSetup.ajax.php", {"Action": "AllCuisines"}, function(result) {
							//... check success?
							for (i = 0; i < result.length; i++) {
								cuisineList.push(result[i]);
							}
							fillCuisineLists();
							$('#AccordionCuisineHeader').addClass("panel-success");
					}, "json");
				}
				//Fill in cuisine lists - both Like and Try
				function fillCuisineLists() {
					//Refresh lists
					$('.CuisineList').empty();
					//suggest a cuisine up top
					//... would probably be faster to create the cuisine list items and then copy to both lists
					$('.CuisineList').append('<li class="list-group-item no-border"><input data-stopPropagation="true" type="text" onkeyup="suggestCuisine($(this), event)" placeholder="Suggest new Cuisine!"></li>');
					//Add items
					for (i = 0; i < cuisineList.length; i++) {
						$('.CuisineList').append('<li class="list-group-item no-border"><a onClick="addCuisine($(this))">' + cuisineList[i] + '</a></li>');
					}
				}
			//Cuisine selected
			//Tell meals to load up (if Like, not Try)
				function addCuisine(selection) {
					cuisine = selection.parent().text();
					//Add to appropriate list, change badge count
					if (selection.parent().parent().hasClass("CuisineLike")) {
						cuisineLikeList.push(cuisine);
						$('.CuisineLikeCount').text(cuisineLikeList.length);
						queryMeals(cuisine);
					} else if (selection.parent().parent().hasClass("CuisineTry")) {
						cuisineTryList.push(cuisine);
						$('.CuisineTryCount').text(cuisineTryList.length);
					} else { //... handle better
						alert("Selected cuisine");
					}
					//Refresh overall list
					cuisineList.splice(cuisineList.indexOf(cuisine), 1);
					fillCuisineLists();
				}
				//Suggest new cuisine
				function suggestCuisine(selection, event) {
					if (event.which == 13) {
						alert("Catching suggestion " + selection.val());
						selection.val("");
					}
				}
				
			//Allergn lists
			//Once queried, fill in and light it up (don't open because most users won't need it)
				function queryAllergns() {
					$.post("InitialSetup.ajax.php", {"Action": "AllAllergns"}, function(result) {
						//... check success?
						for (i = 0; i < result.length; i++) {
							allergnList.push(result[i]);
						}
						fillAllergnLists();
						$('#AccordionAllergnHeader').addClass("panel-success");
					}, "json");
				}
				//Fill in Allergn lists - both
				//... message if user selects all allergns and none left?
				function fillAllergnLists() {
					//refresh lists
					$('.AllergnList').empty();
					//add items
					for (i = 0; i < allergnList.length; i++) {
						$('.AllergnList.AllergnSelect').append('<li class="list-group-item no-border"><a onClick="addAllergn($(this))">' + allergnList[i] + '</a></li>');
						$('.AllergnList.AllergnInfo').append('<li class="list-group-item no-border"><a onClick="selectAllergn($(this))">' + allergnList[i] + '</a></li>');
					}
				}
			//New allergn
			//Tell meals to load up
				function addAllergn(selection) {
					allergn = selection.parent().text();
					removeMeals(allergn);
					//Add to allergn chosen list
					allergnChosenList.push(allergn);
					$('.AllergnChosenCount').text(allergnChosenList.length);
					//Refresh lists
					allergnList.splice(allergnList.indexOf(allergn), 1);
					fillAllergnLists();
				}
				//Show more information
				function selectAllergn(selection) {
					allergn = selection.parent().text();
					$('#AllergnInformation').load("InitialSetup.ajax.php", 
						{"Action": "AllergnDescription", "Allergn": allergn}, 
						function(responseTxt,statusTxt,xhr) {
							$('#AllergnInformationName').text(" - " + allergn);
						}
					);
				}
				
			//Meal lists
			//Once a cuisine has been liked make the query
			//Once queried, fill in, light it up, open it
			//... only open it for first query, assume user decision after that
			//    or don't open it, color alone should be enough cue
				function queryMeals(newCuisine) {
					//Standby mode
					$('#AccordionMealHeader').removeClass("panel-success");
					$('#AccordionMealHeader').addClass("panel-warning");
					$('#AccordionMealLoading').show();
					//Query response
					$.post("InitialSetup.ajax.php", {"Action": "Meals", "Cuisine": newCuisine}, function(result) {
						if (result != null) {
							for (i = 0; i < result.length; i++) {
								//... don't add if already planned meal
								mealList.push(result[i]);
							}
							fillMealList();
						}
						//... handle error
						$('#AccordionMealHeader').removeClass("panel-warning");
						$('#AccordionMealHeader').addClass("panel-success");
						$('#AccordionMealLoading').hide();
					}, "json");
				}
			//Once an allergn has been chosen, remove offending meals
				function removeMeals(allergn) {
					//Standby mode
					$('#AccordionMealHeader').removeClass("panel-success");
					$('#AccordionMealHeader').addClass("panel-warning");
					$('#AccordionMealLoading').show();
					//Query response
					$.post("InitialSetup.ajax.php", {"Action": "AllergnMeals", "Allergn": allergn}, function(result) {
						//... really need to leave the query on php, let it walk through
						if (result != null) {
							for (i = 0; i < result.length; i++) {
								meal = result[i]['Name'];
								j = mealList.indexOf(meal);
								if (j >= 0)
									mealList.splice(j, 1);
							}
							fillMealList();
						}
						$('#AccordionMealHeader').removeClass("panel-warning");
						$('#AccordionMealHeader').addClass("panel-success");
						$('#AccordionMealLoading').hide();
					}, "json");
				}
				//Fill in meals
				function fillMealList() {
					//refresh lists
					$('.MealList').empty();
					//add items
					for (i = 0; i < mealList.length; i++) {
						$('.MealList').append('<li class="list-group-item no-border"><a onClick="selectMeal($(this))">' + mealList[i] + '</a></li>');
					}
				}
			//Possible meal selected
			//Show more information - gather pantry/calendar information
				function selectMeal(selection) {
					meal = selection.parent().text();
					currentMeal = meal;
					$.post("InitialSetup.ajax.php", {"Action": "MealDetails", "RecipeName": meal}, function(result) {
						console.log(result);
						//... check success?
						mealIngredientList = result['ingredients'];
						mealToolList = result['tools'];
						//copy known have/dont data into ingredients and tools
						//... won't be necessary once fully using database
						for (i = 0; i < mealIngredientList.length; i++) {
							ingredient = mealIngredientList[i];
							//Look for user ingredient
							for (j = 0; j < userIngredients.length; j++) {
								if (ingredient.name == userIngredients[j].name) {
									break;
								}
							}
							//If found, then reference 'old' ingredient in userIngredient
							if (j < userIngredients.length) {
								mealIngredientList[i] = userIngredients[j];
							//Otherwise, add reference to userIngredient list
							} else {
								ingredient.status = "";
								userIngredients.push(ingredient);
							}
						}
						
						//... test
						mealIngredientList[1].status = "Have";
						mealIngredientList[2].status = "More";
						//fill table
						fillMealTable();
					}, "json");
				}
				//Fill in ingredient table
				function fillMealTable() {
					$('#MealTable').empty();
					//ingredients
					if (mealIngredientList.length > 0) {
						//Big screens can have each option horizontially, small screens need a dropdown
						//Visibility/Responsive classes aren't quite right here
						//Because you can have the full table with tablet in portrait mode (400px)
						//Also a bit wonky, do I need div wrappers? hide the individual select, options, td, etc.?
						//  Either way, got both elements on the tablet but not the computer
						//Headers
						if (screen.availWidth >= 400) {
							$('#MealTable').append("<tr>				\
										<th>Ingredient required</th>	\
										<th>Amount</th>			\
										<th>Have</th>			\
										<th>Need<br>more</th>		\
										<th>Don't<br>have</th>		\
										<th>Note<br>sure</th>		\
									</tr>");
						} else {
							$('#MealTable').append("<tr>				\
										<th>Ingredient required</th>	\
										<th>Amount</th>			\
										<th>Availability</th>		\
									</tr>");
						}
						//Details
						for (i = 0; i < mealIngredientList.length; i++) {
							ing = mealIngredientList[i];
							amountLine = ing.amount + ' ' + ing.measurement;
							if (ing.preparation)
								amountLine += ', ' + ing.preparation;
							if (screen.availWidth  >= 400) {
								$('#MealTable').append('<tr>																				\
												<td>' + ing.name + '</td>																\
												<td>' + amountLine + '</td>																\
												<form>																			\
													<td><input type="radio" value="Have" name="' + i + '" onClick="hasIngredient($(this))" data-index="' + i + '" data-sel="Have"></td>		\
													<td><input type="radio" value="More" name="' + i + '" onClick="hasIngredient($(this))" data-index="' + i + '" data-sel="Dont"></td>		\
													<td><input type="radio" value="Dont" name="' + i + '" onClick="hasIngredient($(this))" data-index="' + i + '" data-sel="More"></td>		\
													<td><input type="radio" value="Unkn" name="' + i + '" onClick="hasIngredient($(this))" data-index="' + i + '" data-sel="Unknown"></td>		\
												</form>																			\
											</tr>');
							} else {
								$('#MealTable').append('<tr>																						\
												<td>' + ing.name + '</td>																		\
												<td>' + amountLine + '</td>																		\
												<td>																					\
													<div class="dropdown">																		\
														<button type="button" class="btn dropdown-toggle form-control" style="height: 68px; width: 68px;" data-toggle="dropdown" data-index="' + i + '">	\
															<span class="caret pull-right"</span>														\
														</button>																		\
														<ul class="dropdown-menu dropdown-menu-right" style="left: -20px; position: relative" role="menu">							\
															<li class="list-group-item no-border"><a onClick="selectIngredient($(this))" data-index="' + i + '" data-sel="Have">Have</a></li>		\
															<li class="list-group-item no-border"><a onClick="selectIngredient($(this))" data-index="' + i + '" data-sel="More">Need more</a></li>		\
															<li class="list-group-item no-border"><a onClick="selectIngredient($(this))" data-index="' + i + '" data-sel="Dont">Don\'t have</a></li>	\
															<li class="list-group-item no-border"><a onClick="selectIngredient($(this))" data-index="' + i + '" data-sel="Unknown">Not sure</a></li>	\
														</ul>																			\
													</div>																				\
												</td>																					\
											</tr>');
							}
							//if ingredient is known, then fill out
							if (ing.status != "") {
								if (ing.status == "Have") {
									$('#MealTable :radio[data-index="' + i + '"][value="Have"]').prop("checked", true);
									$('#MealTable :button[data-index="' + i + '"]').empty();
									$('#MealTable :button[data-index="' + i + '"]').append("<span class='caret pull-right'</span>Have");
								} else if (ing.status == "Dont") {
									$('#MealTable :radio[data-index="' + i + '"][value="Dont"]').prop("checked", true);
									$('#MealTable :button[data-index="' + i + '"]').empty();
									$('#MealTable :button[data-index="' + i + '"]').append("<span class='caret pull-right'</span>Don't<br />have&nbsp;&nbsp;");
								} else if (ing.status == "More") {
									$('#MealTable :radio[data-index="' + i + '"][value="More"]').prop("checked", true);
									$('#MealTable :button[data-index="' + i + '"]').empty();
									$('#MealTable :button[data-index="' + i + '"]').append("<span class='caret pull-right'</span>Need<br />more&nbsp;&nbsp;");
								} else { //if (ing.status == "Unknown") {
									$('#MealTable :radio[data-index="' + i + '"][value="Unknown"]').prop("checked", true);
									$('#MealTable :button[data-index="' + i + '"]').empty();
									$('#MealTable :button[data-index="' + i + '"]').append("<span class='caret pull-right'</span>Not<br />sure&nbsp;&nbsp;");
								}
							}
						}
					}
					//... not yet, tool is just a string so adding a field is complicated
					/*
					//tools
					if (mealToolList.length > 0) {
						//header
						$('#MealTable').append("<tr><th>Tools required</th></tr>");
						for (i = 0; i < mealToolList.length; i++) {
							//if tool is known, then fill out
							$('#MealTable').append('<tr>														\
											<td>' + mealToolList[i] + '</td>									\
											<td></td>												\
											<form>													\
												<td><input type="radio" value="Have" name="HasTool' + i + '" onClick="hasTool($(this))"></td>	\
												<td><input type="radio" value="Dont" name="HasTool' + i + '" onClick="hasTool($(this))"></td>	\
												<td></td>											\
												<td></td>											\
											</form>													\
										</tr>');
						}
					}
					*/
					//if all ingredients and tools known, then enable Add to Calendar
					//else disable it
				}
				//Small device menu selection
				function selectIngredient(selection) {
					sel = selection.attr("data-sel");
					if (sel == "Have") {
						newText = "<span class='caret pull-right'</span>Have";
					} else if (sel == "More") {
						newText = "<span class='caret pull-right'</span>Need<br />more&nbsp;&nbsp;";
					} else if (sel == "Dont") {
						newText = "<span class='caret pull-right'</span>Don't<br />have&nbsp;&nbsp;";
					} else { //if (sel == "Unknown") {
						newText = "<span class='caret pull-right'</span>Not<br />sure&nbsp;&nbsp;";
					}
					i = selection.attr("data-index");
					$('#MealTable :button[data-index="' + i + '"]').empty();
					$('#MealTable :button[data-index="' + i + '"]').append(newText);
					hasIngredient(selection);
				}
			//Ingredient/Pantry information updated
			//Enable Add to Calendar button if all ingredients accounted
			//... this function or an overwatch function?
				function hasIngredient(selection) {
					i = selection.attr("data-index");
					mealIngredientList[i].status = selection.attr("data-sel");
					//Count up unmarked
					//... could keep a count, but that would leave code scattered in several functions
					if ($('#AddToCalendar').attr("disabled") == "disabled") {
						for (i = 0; i < mealIngredientList.length; i++) {
							if (mealIngredientList[i].status == "")
								return;
						}
						$('#AddToCalendar').removeAttr("disabled");
					}
				}
			//Add meal to calendar
			//... tell calendar to load up
				function addMeal() {
					//walk through list of pantry selections from meal
					//  if any marked don't, then add to want list
					//  if any marked need more or don't, then add them to shopping list
					//  ... store all answers in database
					cantCook = false;
					for (i = 0; i < mealIngredientList.length; i++) {
						status = mealIngredientList[i].status;
						if (status == "Dont") {
							cantCook = true;
							shoppingList.push(mealIngredientList[i].name);
						} else if (status == "More") {
							shoppingList.push(mealIngredientList[i].name);
						}
					}
					fillShoppingList();
					//add to calendar
					if (cantCook)
						mealWantList.push(currentMeal);
					else
						mealPlanList.push(currentMeal);
					fillCalendars();
					//update counts
					$('.MealPlanCount').text(mealPlanList.length);
					$('.MealWantCount').text(mealWantList.length);
					//remove from meal list
					mealList.splice(mealList.indexOf(currentMeal), 1);
					//empty out meal table
					mealIngredientList.splice(0);
					mealToolList.splice(0);
					currentMeal = "";
					fillMealTable();
				}
			
			//... not showing the calendar now
			//    should allow user to move meal dates around
				function fillCalendars() {
					$('.CalendarPlanList').empty();
					for (i = 0; i < mealPlanList.length; i++) {
						meal = mealPlanList[i];
						$('.CalendarPlanList').append('<li class="list-group-item"><a>' + meal + '</a></li>');
					}
					$('.CalendarWantList').empty();
					for (i = 0; i < mealWantList.length; i++) {
						meal = mealWantList[i];
						$('.CalendarWantList').append('<li class="list-group-item"><a>' + meal + '</a></li>');
					}
					if ((mealPlanList.length > 0) || (mealWantList.length > 0)) {
						$('#AccordionCalendarHeader').addClass("panel-success");
					} else {
						$('#AccordionCalendarHeader').removeClass("panel-success");
					}
				}
			
			//Shopping List
			//... don't open/green until some ingredients
				function fillShoppingList() {
					$('.ShoppingList').empty();
					for (i = 0; i < shoppingList.length; i++) {
						ing = shoppingList[i];
						$('.ShoppingList').append('<li class="list-group-item"><a>' + ing + '</a></li>');
					}
					if (shoppingList.length > 0)
						$('#AccordionShoppingHeader').addClass("panel-success");
					else
						$('#AccordionShoppingHeader').removeClass("panel-success");
				}
  		</script>
  	</head>

  	<body>
  		<?php require_once "Includes/Navbar.inc.php"; ?>
  		<!-- All carets are pull-right to line up badges correctly 
  		     ... that also pulls them up to top of line for some reason
  		-->
  		<div class="container center-block">
			<form class="form-horizontal" role="form" method="post" action="InitialSetup.php">
				<div class="panel-group" id="SetupAccordion">
					<!-- Cuisine choice -->
					<div id="AccordionCuisineHeader" class="panel panel-default list-grey">
						<div class="panel-heading" data-toggle="collapse" data-parent="#SetupAccordion" href="#AccordionCuisine">
							<h4 class="panel-title">
								<a>Cuisine Choice</a>
							</h4>
						</div>
						<div id="AccordionCuisine" class="panel-collapse collapse in">
							<div class="panel-body">
								<div class="row">
									<div class="col-sm-4">
										<div class="input-group">
											<div class="input-group-btn">
												<button type="button" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown">
													<span class="pull-left">Cuisines I like</span><span class="caret pull-right"></span><span class="badge pull-right CuisineLikeCount">0</span>
												</button>
												<ul class="dropdown-menu scrollable CuisineList CuisineLike" role="menu"> <!-- relative position expands panel to show list -->
													<!-- figure out how to make these full width, containers and col-sm-4 don't seem to work -->
													<!-- fill in with database query
													<li class="list-group-item no-border"><a onClick="addCuisine($(this))">Name of cuisine</a></li>
													-->
												</ul>
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="input-group">
											<div class="input-group-btn">
												<button type="button" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown">
													<span class="pull-left">Cuisines I want to try</span><span class="caret pull-right"></span><span class="badge pull-right CuisineTryCount">0</span>
												</button>
												<ul class="dropdown-menu scrollable CuisineList CuisineTry" role="menu"> <!-- relative position expands panel to show list -->
													<!-- fill in with database query
													<li class="list-group-item no-border"><a onClick="addCuisine($(this))">Name of cuisine</a></li>
													-->
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Allergns -->
					<div id="AccordionAllergnHeader" class="panel panel-default list-grey">
						<div class="panel-heading" data-toggle="collapse" data-parent="#SetupAccordion" href="#AccordionAllergn">
							<h4 class="panel-title">
								<a>Allergns</a>
							</h4>
						</div>
						<div id="AccordionAllergn" class="panel-collapse collapse">
							<div class="panel-body">
								<div class="row">
									<div class="col-sm-4">
										<div class="input-group">
											<div class="input-group-btn">
												<button type="button" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown">
													<span class="pull-left">Allergns</span><span class="caret pull-right"></span><span class="badge pull-right AllergnChosenCount">0</span>
												</button>
												<ul class="dropdown-menu scrollable AllergnList AllergnSelect" role="menu"> <!-- relative position expands panel to show list -->
													<!-- figure out how to make these full width, containers and col-sm-4 don't seem to work -->
													<!-- fill in with database query
													<li class="list-group-item no-border"><a onClick="addAllergn($(this))">Name of ingredient</a></li>
													-->
												</ul>
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="input-group">
											<div class="input-group-btn">
												<button type="button" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown">
													<span class="pull-left">See more information on allergns</span><span class="caret pull-right"></span>
												</button>
												<ul class="dropdown-menu scrollable AllergnList AllergnInfo" role="menu"> <!-- relative position expands panel to show list -->
													<!-- figure out how to make these full width, containers and col-sm-4 don't seem to work -->
													<!-- fill in with database query
													<li class="list-group-item no-border"><a onClick="selectAllergn($(this))">Name of ingredient</a></li>
													-->
												</ul>
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<p><strong>More Information<span id="AllergnInformationName"></span></strong></p>
										<textarea id="AllergnInformation" class="form-control" rows="3" readonly style="background-color: #fff;"></textarea>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Meal planning -->
					<div id="AccordionMealHeader" class="panel panel-default list-grey">
						<div class="panel-heading" data-toggle="collapse" data-parent="#SetupAccordion" href="#AccordionMeal">
							<h4 class="panel-title">
								<a>Meal Planning<span id="AccordionMealLoading" class="pull-right" hidden="hidden">Loading new recipes...<span class="glyphicon glyphicon-refresh pull-right"></span></span></a>
							</h4>
						</div>
						<div id="AccordionMeal" class="panel-collapse collapse">
							<div class="panel-body">
								<div class="row">
									<div class="col-sm-4">
										<div class="input-group">
											<div class="input-group-btn">
												<button type="button" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown">
													<span class="pull-left">Recipes</span><span class="caret pull-right"></span>
												</button>
												<ul class="dropdown-menu scrollable MealList" role="menu"> <!-- relative position expands panel to show list -->
													<!-- figure out how to make these full width, containers and col-sm-4 don't seem to work -->
													<!-- Fill in with database query
													<li class="list-group-item no-border"><a onClick="selectMeal($(this))">Name of meal</a></li>
													-->
												</ul>
											</div>
										</div>
									</div>
									<div class="col-sm-8">
										<!-- Tablets and smaller - Meals planned over buttons, outside of button toolbar
									             Computer screens    - Meals planned on right, within button toolbar 
									             Phones              - Combine Save for Later and No thanks buttons
									             Tablets and bigger  - Show buttons separately 
									        -->
										<div class="hidden-md hidden-lg well well-sm"><span class="badge MealPlanCount">0</span> meals planned, <span class="badge MealPlanCount">0</span> days until need to go shopping</div>
										<div class="btn-toolbar">
											<div class="btn-group"><button id="AddToCalendar" type="button" class="btn btn-default" disabled="disabled" onClick="addMeal()">Add to Calendar</button></div>
											<div class="btn-group visible-phone">
												<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
													Other options<span class="caret pull-right"></span>
												</button>
												<ul class="dropdown-menu">
													<li class="list-group-item no-border"><a>Save for later</a></li>
													<li class="list-group-item no-border"><a>No thanks</a></li>
												</ul>
											</div>
											<div class="btn-group visible-tablet"><button type="button" class="btn btn-default">Save for Later</button></div>
											<div class="btn-group visible-tablet"><button type="button" class="btn btn-default">No thanks</button></div>
											<div class="hidden-xs well well-sm pull-right"><span class="badge MealPlanCount">0</span> meals planned, <span class="badge MealPlanCount">0</span> days until need to go shopping</div>
										</div>
										<table id="MealTable" class="table table-striped">
											<!-- Header information
											<tr>
												<th>Ingredient required</th>
												<th>Amount</th>
												<th>Have</th>
												<th>Don't<br>have</th>
												<th>Need<br>more</th>
												<th>Don't<br>know</th>
											</tr>
											-->
											<!-- Fill in with database query
											<tr>
												<td>Name of ingredient</td>
												<td>Amount</td>
												<form>
													<td><input type="radio" name="HasIngredient" onClick="hasIngredient($(this), true)"></td>
													<td><input type="radio" name="HasIngredient" onClick="hasIngredient($(this), false)"></td>
													<td><input type="radio" name="HasIngredient" onClick="hasIngredient($(this), "ask")"></td>
													<td><input type="radio" name="HasIngredient" onClick="hasIngredient($(this))"></td>
												</form>
											</tr>
											-->
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Calendar -->
					<div id="AccordionCalendarHeader" class="panel panel-default list-grey">
						<div class="panel-heading" data-toggle="collapse" data-parent="#SetupAccordion" href="#AccordionCalendar">
							<h4 class="panel-title">
								<a>Calendar</a>
							</h4>
						</div>
						<div id="AccordionCalendar" class="panel-collapse collapse">
							<div class="panel-body">
								<div class="row">
									<!-- Tablet looked good with col=6, but registers as extra small device
									     ... figure out how to specify tablet instead of pixel/sm size? -->
									<div class="col-xs-12 col-sm-6 col-md-4">
										<h4>Meals you can cook now<span class="badge pull-right MealPlanCount">0</span></h4>
										<ul class="list-group list-height-limit CalendarPlanList">
											<!-- fill in with database query
											<li class="list-group-item"><a>Name of meal</a></li>
											-->
										</ul>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-4">
										<h4>Meals you need to shop for<span class="badge pull-right MealWantCount">0</span></h4>
										<ul class="list-group list-height-limit CalendarWantList">
											<!-- fill in with database query
											<li class="list-group-item"><a>Name of meal</a></li>
											-->
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Shopping list validation -->
					<div id="AccordionShoppingHeader" class="panel panel-default list-grey">
						<div class="panel-heading" data-toggle="collapse" data-parent="#SetupAccordion" href="#AccordionShopping">
							<h4 class="panel-title">
								<a>Shopping</a>
							</h4>
						</div>
						<div id="AccordionShopping" class="panel-collapse collapse">
							<div class="panel-body">
								<div class="row">
									<div class="col-sm-4">
										<h3>Shopping List</h3>
										<ul class="list-group list-height-limit ShoppingList">
											<!-- figure out how to make these full width, containers and col-sm-4 don't seem to work -->
											<!-- fill in with database query
											<li class="list-group-item"><a>Name of ingredient</a></li>
											-->
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- ordered list, can move around -->
					<!-- Pantry additions -->
					<!-- Recipe additions -->
				</div>
			</form>
		</div>

	</body>
</html>

