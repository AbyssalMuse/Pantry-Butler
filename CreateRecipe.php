<!-- Create Recipe
     Write up or edit recipes through this page
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

  		<title>The Pantry Butler - Create Recipe</title>
  		
  		<!-- Custom styles for this page -->
  		<link href="css/CreateRecipe.css" rel="stylesheet"> 
  		
  		<!-- Common styles and javascript -->
  		<?php require_once "Includes/HTML.inc.php"; ?>
  		
  	</head>
  	<body>
  		<?php require_once "Includes/Navbar.inc.php"; ?>
  		
  		<!-- Accordions for overview, each step 
  		     Set up basic information in overview - name, total time, description, picture
  		     Set up instructions and required tools, ingredients and their amounts, measurement, and preparation in each step
  		     Overview has a central list of all ingredients and tools
  		       Can either add to the central list and choose the ingredient in a step
  		       Or add in the step and see the ingredient pop up in the Overview
  		-->
  		<div class="container center-block">
  			<div class="panel-group" id="CreateAccordion">
  				<!-- Overview -->
				<div id="AccordionOverviewHeader" class="panel panel-default">
					<!-- Header -->
					<div class="panel-heading" data-toggle="collapse" data-parent="#CreateAccordion" href="#AccordionOverview">
						<h4 class="panel-title">
							<a>Recipe Overview
								<ul class="nav nav-pills pull-right">
									<li class="label label-warning force-pill hidden-xs"><span class="h4">Unused Ingredients: <span>0</span></span></li>
									<li class="label label-warning force-pill spacer-left hidden-xs"><span class="h4">Unused Tools: <span>0</span></li>
									<li class="label label-warning visible-xs"><span>Ing: </span><span class="badge">0</span></li>
									<li class="label label-warning spacer-left visible-xs"><span>Tools: <span class="badge">0</span></li>
								</ul>
							</a>
						</h4>
					</div>
					<!-- Body -->
					<!-- To do: Add image upload -->
					<!-- To do: Make buttons functional -->
					<div id="AccordionOverview" class="panel-collapse collapse in">
						<div class="panel-body">
							<!-- Name and Time -->
							<div class="row">
								<div class="col-sm-6 col-sm-offset-2">
									<div class="input-group">
										<input type="text" class="form-control input-lg" placeholder="Recipe Name">
										<span class="help-block"></span>
									</div>
								</div>
								<div class="col-sm-3 col-sm-offset-1">
									<h2 class="form-control-static">Time: 00:00</h2>
								</div>
							</div>
							<!-- Other Information -->
							<div class="row">
								<!-- Cuisines -->
								<div class="col-sm-4">
									<div class="panel-group">
										<div id="CuisineAccordion" class="panel panel-default">
											<div id="AccordionCuisineHeader" class="panel-heading">
												<h4 class="panel-title" data-toggle="collapse" data-parent="#CuisineAccordion" href="#AccordionCuisine">Add Cuisines</h4>
											</div>
											<div id="AccordionCuisine" class="panel-body panel-collapse collapse">
												<ul id="ChosenCuisineList" class="list-group Cuisine Overview">
													<!-- Fill in with chosen cuisines
													<li>Name of cuisine<span class="glyphicon glyphicon-remove pull-right" onClick="removeItem($(this))"></span></li>
													-->
												</ul>
											</div>
											<div class="panel-footer">
												<div class="input-group">
													<!-- Absolute position keeps the text bar full-width when the drop-down menu opens -->
													<input type="text" class="form-control" style="position: absolute;" id="CuisineOverview" placeholder="Enter cuisine">
													<span class="input-group-btn">
														<button type="button" class="btn btn-default dropdown-toggle pull-right" data-toggle="dropdown" data-ajax="queryCuisines">Choose <span class="caret"></span></button>
														<ul id="ChooseCuisineList" class="dropdown-menu scrollable pull-right Cuisine Overview" role="menu">
															<!-- Fill in with database query
															<li class="list-group-item no-border"><a onClick="addItem($(this))">Name of cuisine</a></li>
															-->
														</ul>
													</span>
												</div>
											</div>
										</div>
									</div>				
								</div>
								<!-- Ingredients -->
								<div class="col-sm-4">
									<div class="panel-group">
										<div id="IngredientAccordion" class="panel panel-default">
											<div id="AccordionIngredientHeader" class="panel-heading">
												<h4 class="panel-title" data-toggle="collapse" data-parent="#IngredientAccordion" href="#AccordionIngredient">Add Ingredients</h4>
											</div>
											<div id="AccordionIngredient" class="panel-body panel-collapse collapse">
												<ul id="ChosenIngredientList" class="list-group Ingredient Overview">
													<!-- Fill in with chosen Ingredients
													<li>Name of Ingredient<span class="glyphicon glyphicon-remove pull-right" onClick="removeItem($(this))"></span></li>
													-->
												</ul>
											</div>
											<div class="panel-footer">
												<div class="input-group">
													<!-- Absolute position keeps the text bar full-width when the drop-down menu opens -->
													<input type="text" class="form-control" style="position: absolute;" id="IngredientOverview" placeholder="Enter Ingredient">
													<span class="input-group-btn">
														<button type="button" class="btn btn-default dropdown-toggle pull-right" data-toggle="dropdown" data-ajax="queryIngredients">Choose <span class="caret"></span></button>
														<ul id="ChooseIngredientList" class="dropdown-menu scrollable pull-right Ingredient Overview" role="menu">
															<!-- Fill in with database query
															<li class="list-group-item no-border"><a onClick="addItem($(this))">Name of Ingredient</a></li>
															-->
														</ul>
													</span>
												</div>
											</div>
										</div>
									</div>				
								</div>
								<!-- Tools -->
								<div class="col-sm-4">
									<div class="panel-group">
										<div id="ToolAccordion" class="panel panel-default">
											<div id="AccordionToolHeader" class="panel-heading">
												<h4 class="panel-title" data-toggle="collapse" data-parent="#ToolAccordion" href="#AccordionTool">Add Tools</h4>
											</div>
											<div id="AccordionTool" class="panel-body panel-collapse collapse">
												<ul id="ChosenToolList" class="list-group Tool Overview">
													<!-- Fill in with chosen Tools
													<li>Name of Tool<span class="glyphicon glyphicon-remove pull-right" onClick="removeItem($(this))"></span></li>
													-->
												</ul>
											</div>
											<div class="panel-footer">
												<div class="input-group">
													<!-- Absolute position keeps the text bar full-width when the drop-down menu opens -->
													<input type="text" class="form-control" style="position: absolute;" id="ToolOverview" placeholder="Enter Tool">
													<span class="input-group-btn">
														<button type="button" class="btn btn-default dropdown-toggle pull-right" data-toggle="dropdown" data-ajax="queryTools">Choose <span class="caret"></span></button>
														<ul id="ChooseToolList" class="dropdown-menu scrollable pull-right Tool Overview" role="menu">
															<!-- Fill in with database query
															<li class="list-group-item no-border"><a onClick="addItem($(this))">Name of Tool</a></li>
															-->
														</ul>
													</span>
												</div>
											</div>
										</div>
									</div>				
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- To do: Generate first step with javascript/php -->
				<!-- To do: Generate another step, using this blank template, when user opens the step by clicking on the collapser -->
				<!-- Step 1 -->
				<div id="AccordionStepHeader" class="panel panel-default">
					<!-- Header -->
					<div class="panel-heading" data-toggle="collapse" data-parent="#CreateAccordion" href="#AccordionStep">
						<h4 class="panel-title">
							<a onClick="addStep()">Step
								<!-- Quick glance information -->
								<ul class="nav nav-pills pull-right">
									<li class="label label-info force-pill hidden-xs"><span class="h4">Time: <span>0</span></span></li>
									<li class="label label-info force-pill hidden-xs"><span class="h4">Ingredients: <span>0</span></span></li>
									<li class="label label-info force-pill spacer-left hidden-xs"><span class="h4">Tools: <span>0</span></li>
									<li class="label label-info visible-xs"><span>Ing: </span><span class="badge">0</span></li>
									<li class="label label-info spacer-left visible-xs"><span>Tools: <span class="badge">0</span></li>
								</ul>
							</a>
						</h4>
					</div>
					<!-- Body -->
					<div id="AccordionStep" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="row">
								<!-- Basic information in side-view - Time, Tool list, Ingredient list -->
								<div class="col-sm-4">
									<!-- Time -->
									<div class="panel-group">
										<div class="panel panel-default">
											<div class="panel-heading">
												<h4 class="panel-title">Time</h4>
											</div>
											<div class="panel-body">
												<input type="time" class="Time Step">
											</div>
										</div>
									</div>
									<!-- Tools, collapsable list -->
									<div class="panel-group">
										<div id="ToolAccordionStep" class="panel panel-default">
											<div id="AccordionToolHeaderStep" class="panel-heading">
												<h4 class="panel-title" data-toggle="collapse" data-parent="#ToolAccordionStep" href="#AccordionToolStep">Add Tools</h4>
											</div>
											<div id="AccordionToolStep" class="panel-body panel-collapse collapse">
												<ul id="ChosenToolListStep" class="list-group Tool Step">
													<!-- Fill in with chosen Tools
													<li>Name of Tool<span class="glyphicon glyphicon-remove pull-right" onClick="removeItem($(this))"></span></li>
													-->
												</ul>
											</div>
											<!-- Add another tool by filling out this form -->
											<div class="panel-footer">
												<div class="input-group">
													<!-- Absolute position keeps the text bar full-width when the drop-down menu opens -->
													<input type="text" class="form-control" style="position: absolute;" id="ToolStep" placeholder="Enter Tool">
													<span class="input-group-btn">
														<button type="button" class="btn btn-default dropdown-toggle pull-right" data-toggle="dropdown" data-ajax="queryTools">Choose <span class="caret"></span></button>
														<ul id="ChooseToolListStep" class="dropdown-menu scrollable pull-right Tool Step" role="menu">
															<!-- Fill in with tools from Overview, or database query Tools table
															<li class="list-group-item no-border"><a onClick="addItem($(this))">Name of Tool</a></li>
															-->
														</ul>
													</span>
												</div>
											</div>
										</div>
									</div>
									<!-- Ingredients, collapsable list -->
									<div class="panel-group">
										<div id="IngredientAccordionStep" class="panel panel-default">
											<div id="AccordionIngredientHeaderStep" class="panel-heading">
												<h4 class="panel-title" data-toggle="collapse" data-parent="#IngredientAccordionStep" href="#AccordionIngredientStep">Add Ingredients</h4>
											</div>
											<div id="AccordionIngredientStep" class="panel-body panel-collapse collapse">
												<ul id="ChosenIngredientListStep" class="list-group Ingredient Step">
													<li>	
														Name of Ingredient<span class="glyphicon glyphicon-remove pull-right" onClick="removeItem($(this))"></span>
													    <br>Amount Measurement, Preparation
													</li>
													<!-- Fill in with chosen Ingredients
													<li>	
														Name of Ingredient<span class="glyphicon glyphicon-remove pull-right" onClick="removeItem($(this))"></span>
													    <br>Amount Measurement, Preparation
													</li>
													-->
												</ul>
											</div>
											<!-- Add another ingredient by filling out this form -->
											<div class="panel-footer">
												<!-- Name -->
												<div class="input-group">
													<!-- Absolute position keeps the text bar full-width when the drop-down menu opens -->
													<input type="text" class="form-control" style="position: absolute;" id="IngredientStep" placeholder="Enter Ingredient">
													<span class="input-group-btn">
														<button type="button" class="btn btn-default dropdown-toggle pull-right" data-toggle="dropdown" data-ajax="queryIngredients">Choose <span class="caret"></span></button>
														<ul id="ChooseIngredientListStep" class="dropdown-menu scrollable pull-right Ingredient Step" role="menu">
															<li class="list-group-item no-border"><a onClick="addItem($(this))">Name of Ingredient</a></li>
															<!-- Fill in with ingredients from Overview
															<li class="list-group-item no-border"><a onClick="addItem($(this))">Name of Ingredient</a></li>
															-->
														</ul>
													</span>
												</div>
												<!-- Details - Amount, Measurement, Preparation -->
												<!-- To do: Alternative to form, only used for grouping buttons and formatting -->
												<form class="form-inline" role="form">
													<!-- Amount -->
													<div class="form-group">
														<input type="text" placeholder="Amount" maxlength="7" size="7" style="color: #333333;">
													</div>
													<!-- Measurement -->
													<div class="form-group">
														<div class="input-group">
															<input type="text" placeholder="Measurement" size="9" style="color: #333333;">
															<div class="input-group-btn">
																<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" style="font-size: 6px;"><span class="caret"></span></button>
																<ul class="dropdown-menu pull-right">
																	<!-- Fill in with database query on Measurement lookup table
																	<li class="list-group-item no-border"><a onClick="addItem($(this))">Name of Measurement</a></li>
																	-->
																</ul>
															</div>
														</div>
													</div>
													<!-- Preparation -->
													<div class="form-group">
														<div class="input-group">
															<input type="text" placeholder="Preparation" size="9" style="color: #333333;">
															<div class="input-group-btn">
																<button type="button" class="btn btn-default btn-small dropdown-toggle" data-toggle="dropdown" style="font-size: 6px;"><span class="caret"></span></button>
																<ul class="dropdown-menu pull-right">
																	<!-- Fill in with database query on Preparation lookup table
																	<li class="list-group-item no-border"><a onClick="addItem($(this))">Name of Measurement</a></li>
																	-->
																</ul>
															</div>
														</div>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
								<!-- Instructions and image upload -->
								<div class="col-sm-8">
									<textarea rows="4" placeholder="Enter Instructions"></textarea>
									<input type="file">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</body>
</html>

