<!-- Pantry
     List of all user's ingredients
     So they can manually edit the amounts, etc.
     Basically a fail-safe, or for those who really want to keep track of their ingredients
     I don't expect average users to use this page - they should let Calendar set up new recipes and decide if they need more ingredients
-->
<!-- To do: Add to shopping list buttons for every ingredient -->

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

  		<title>The Pantry Butler - Pantry</title>
  		
  		<!-- Common styles and javascript -->
  		<?php require_once "Includes/HTML.inc.php"; ?>
  	</head>

  	<body>
  		<?php require_once "Includes/Navbar.inc.php"; ?>
  		
  		<!-- Ingredients and a search - both in accordions
  		     Search area first, open
  		     Another accordion for each ingredient type, full of corresponding ingredients in user's pantry
  		-->
  		<!-- To do: Don't list ingredients that user has ignored for months? -->
  		<div class="container center-block">
			<div class="panel-group" id="PantryAccordion">
				<!-- Search -->
				<div id="AccordionSearchHeader" class="panel panel-default list-grey">
					<!-- Header -->
					<div class="panel-heading"  data-toggle="collapse" data-parent="#PantryAccordion" href="#AccordionSearch">
						<h4 class="panel-title">
							<a>Search</a>
							<span class="pull-right spacer-right"><span class="hidden-phone">Print </span><span class="glyphicon glyphicon-print"></span></span>
							<span class="pull-right spacer-right"><span class="hidden-phone">Save </span><span class="glyphicon glyphicon-save"></span></span>
						</h4>
					</div>
					<!-- Body -->
					<div id="AccordionSearch" class="panel-collapse collapse in">
						<div class="panel-body list-grey">
							<div class="row">
								<!-- To do: Make the searches functional -->
								<!-- Ingredient search -->
								<div class="col-sm-4">
									<label class="sr-only" for="SearchName">Name of Ingredient</label>
									<div class="input-group">
										<input type="text" class="form-control" id="SearchName" placeholder="Enter ingredient">
										<span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
										<!-- To do: Dynamically create names of ingredients from user's pantry-->
									</div>
								</div>
								<!-- Category filter -->
								<div class="col-sm-4">
									<label class="sr-only" for="SearchCategory">Category</label>
									<div class="input-group">
										<input type="text" class="form-control" id="SearchCategory" placeholder="Enter category">
										<span class="input-group-addon"><span class="caret"></span></span>
										<!-- To do: Dynamically create names of categories -->
									</div>
								</div>
								<!-- Cuisine search -->
								<div class="col-sm-4">
									<label class="sr-only" for="SearchCuisine">Cuisine</label>
									<div class="input-group">
										<input type="text" class="form-control" id="SearchCuisine" placeholder="Enter Cuisine">
										<span class="input-group-addon"><span class="caret"></span></span>
										<!-- To do: Dynamically create cuisines -->
									</div>
								</div>
							</div>
							<!-- Ingredients found -->
							<h1>Results</h1>
							<div class="row">
								<!-- Lists of ingredients
								     One column on phone, all vertical
								     Two columns on tablet
								     Three columns on computer -->
								<!-- Phone one column, vertical layout -->
								<div class="hidden-tablet">
									<div class="col-xs-12"> <!-- Force full width -->
										<ul class="list-group list-grey All">
											<!-- To do: Dynamically fill in with results, match layout -->
											<li class="list-group-item list-grey">
												<!-- To do: Figure out options, edit is dropdown? -->
												<span class="glyphicon glyphicon-edit spacer-right"></span>
												Milk
												<span class="pull-right">1 gallon</span>
											</li>
											<li class="list-group-item list-grey">
												<span class="glyphicon glyphicon-edit spacer-right"></span>
												Eggs
												<span class="pull-right">12</span>
											</li>
											<li class="list-group-item list-grey">
												<span class="glyphicon glyphicon-edit spacer-right"></span>
												Cheese
												<span class="pull-right">8 oz</span>
											</li>
										</ul>
									</div>
								</div>
								<!-- Tablet, computer layout - 2 or 3 per row -->
								<div class="hidden-phone">
									<!-- To do: Dynamically fill in with results, match layout -->
									<!-- To do: Figure out if lists top to bottom or left to right first -->
									<div class="col-xs-6 col-sm-4"> <!-- 2 for tablets, 3 for computer -->
										<ul class="list-group list-grey All">
											<li class="list-group-item list-grey">
												<!-- To do: Figure out options, edit is dropdown? -->
												<p class="glyphicon glyphicon-edit spacer-left">
													Milk
												</p>
												<p class="spacer-left">
													&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1 gallon
												</p>
											</li>
										</ul>
									</div>
									<div class="col-xs-6 col-sm-4">
										<ul class="list-group list-grey All">
											<li class="list-group-item list-grey">
												<p class="glyphicon glyphicon-edit spacer-left">
													Eggs
												</p>
												<p class="spacer-left">
													&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;12
												</p>
											</li>
										</ul>
									</div>
									<!-- Last column, so hide on tablets -->
									<div class="hidden-xs col-sm-4">
										<ul class="list-group list-grey All">
											<li class="list-group-item list-grey">
												<p class="glyphicon glyphicon-edit spacer-left">
													Cheese
												</p>
												<p class="spacer-left">
													&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;8 oz
												</p>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- To do: Figure out all categories -->
				<!-- To do: Dynamically create and fill in categories, match layout above -->
				<!-- To do: Skip some categories? Don't show vegetarians meat? -->
				<!-- Meat -->
				<!-- This layout should match results above -->
				<div id="AccordionMeatHeader" class="panel panel-default list-grey">
					<!-- Header -->
					<div class="panel-heading"  data-toggle="collapse" data-parent="#PantryAccordion" href="#AccordionMeat">
						<h4 class="panel-title">
							<a>Meats</a>
							<span class="pull-right spacer-right"><span class="hidden-phone">Print </span><span class="glyphicon glyphicon-print"></span></span>
							<span class="pull-right spacer-right"><span class="hidden-phone">Save </span><span class="glyphicon glyphicon-save"></span></span>
						</h4>
					</div>
					<!-- Body -->
					<div id="AccordionMeat" class="panel-collapse collapse">
						<div class="panel-body list-grey">
							<div class="row">
								<!-- Lists of ingredients
								     One column on phone, all vertical
								     Two columns on tablet
								     Three columns on computer -->
								<!-- Phone one column, vertical layout -->
								<div class="hidden-tablet">
									<div class="col-xs-12"> <!-- Force full width -->
										<ul class="list-group list-grey All">
											<!-- To do: Dynamically fill in with results, match layout -->
											<li class="list-group-item list-grey">
												<!-- To do: Figure out options, edit is dropdown? -->
												<span class="glyphicon glyphicon-edit spacer-right"></span>
												Beef, ground
												<span class="pull-right">1 lb</span>
											</li>
										</ul>
									</div>
								</div>
								<!-- Tablet, computer layout - 2 or 3 per row -->
								<div class="hidden-phone">
									<!-- To do: Dynamically fill in with results, match layout -->
									<!-- To do: Figure out if lists top to bottom or left to right first -->
									<div class="col-xs-6 col-sm-4"> <!-- 2 for tablets, 3 for computer -->
										<ul class="list-group list-grey All">
											<li class="list-group-item list-grey">
												<!-- To do: Figure out options, edit is dropdown? -->
												<p class="glyphicon glyphicon-edit spacer-left">
													Beef, ground
												</p>
												<p class="spacer-left">
													&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1 lb
												</p>
											</li>
										</ul>
									</div>
									<div class="col-xs-6 col-sm-4">
										<ul class="list-group list-grey All">
											<li class="list-group-item list-grey">
												<p class="glyphicon glyphicon-edit spacer-left">
													Veal, ground
												</p>
												<p class="spacer-left">
													&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1 lb
												</p>
											</li>
										</ul>
									</div>
									<!-- Last column, so hide on tablets -->
									<div class="hidden-xs col-sm-4">
										<ul class="list-group list-grey All">
											<li class="list-group-item list-grey">
												<p class="glyphicon glyphicon-edit spacer-left">
													Lamb, ground
												</p>
												<p class="spacer-left">
													&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1 lb
												</p>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Following layouts should match Meat, Results above -->
				<!-- Dairy -->
				<div id="AccordionDairyHeader" class="panel panel-default list-grey">
					<div class="panel-heading"  data-toggle="collapse" data-parent="#PantryAccordion" href="#AccordionDairy">
						<h4 class="panel-title">
							<a>Dairy</a>
							<span class="pull-right spacer-right"><span class="hidden-phone">Print </span><span class="glyphicon glyphicon-print"></span></span>
							<span class="pull-right spacer-right"><span class="hidden-phone">Save </span><span class="glyphicon glyphicon-save"></span></span>
						</h4>
					</div>
					<div id="AccordionDairy" class="panel-collapse collapse">
						<div class="panel-body list-grey">
							
						</div>
					</div>
				</div>
				<!-- Fruit -->
				<div id="AccordionFruitHeader" class="panel panel-default list-grey">
					<div class="panel-heading"  data-toggle="collapse" data-parent="#PantryAccordion" href="#AccordionFruit">
						<h4 class="panel-title">
							<a>Fruits</a>
							<span class="pull-right spacer-right"><span class="hidden-phone">Print </span><span class="glyphicon glyphicon-print"></span></span>
							<span class="pull-right spacer-right"><span class="hidden-phone">Save </span><span class="glyphicon glyphicon-save"></span></span>
						</h4>
					</div>
					<div id="AccordionFruit" class="panel-collapse collapse">
						<div class="panel-body list-grey">
							
						</div>
					</div>
				</div>
				<!-- Vegetable -->
				<div id="AccordionVegetableHeader" class="panel panel-default list-grey">
					<div class="panel-heading"  data-toggle="collapse" data-parent="#PantryAccordion" href="#AccordionVegetable">
						<h4 class="panel-title">
							<a>Vegetables</a>
							<span class="pull-right spacer-right"><span class="hidden-phone">Print </span><span class="glyphicon glyphicon-print"></span></span>
							<span class="pull-right spacer-right"><span class="hidden-phone">Save </span><span class="glyphicon glyphicon-save"></span></span>
						</h4>
					</div>
					<div id="AccordionVegetable" class="panel-collapse collapse">
						<div class="panel-body list-grey">
							
						</div>
					</div>
				</div>
				<!-- Other -->
				<div id="AccordionOtherHeader" class="panel panel-default list-grey">
					<div class="panel-heading"  data-toggle="collapse" data-parent="#PantryAccordion" href="#AccordionOther">
						<h4 class="panel-title">
							<a>Others</a>
							<span class="pull-right spacer-right"><span class="hidden-phone">Print </span><span class="glyphicon glyphicon-print"></span></span>
							<span class="pull-right spacer-right"><span class="hidden-phone">Save </span><span class="glyphicon glyphicon-save"></span></span>
						</h4>
					</div>
					<div id="AccordionOther" class="panel-collapse collapse">
						<div class="panel-body list-grey">
							
						</div>
					</div>
				</div>
			</div>
		</div>

	</body>
</html>

