<!-- Calendar Today
     Displays complete recipe information for all meals today
     Complete = match CookSelect splash page, all ingredients and tools required as well as time
     Use Calendar for less information, several days
     Use CalendarWide for little information to show several weeks
-->

<!-- Common tools, php classes -->
<?php
	require_once "Includes/Global.inc.php";
?>
<!-- Not sure where I use this now, but removing it blanks out the screen
     Must be automatically used by Bootstrap's Carousel, so leave it
     And leave it up here, not in the head block, or blanks screen
-->
<script src="js/holder.js"></script>

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

  		<title>The Pantry Butler - CalendarToday</title>

  		<!-- Common styles and javascript -->
  		<?php require_once "Includes/HTML.inc.php"; ?>
  		
  		<!-- Gather recipe information -->
  		<?php 
  			require_once "Classes/RecipeOverview.class.php";
  			require_once "Classes/Cuisine.class.php";
  		
  			//To do: Get (multiple) RecipeID from $_POST or Calendar table
  			$recipe = new RecipeOverview(1);
  			$cuisine = Cuisine::createFromQuery("Indian");
			//To do: Test for bad recipe, cuisine
		?>
  	</head>

  	<body>
		<?php require_once "Includes/Navbar.inc.php"; ?>
		
		<!-- Display each recipe in an accordion
		     Full descriptions, like a recipe overview
		-->
		<!-- The layout of this page matches Cook! including carousel (even slideshow though not used) -->
		<!-- Carousel classes used for width mostly, some color too I think -->
		<!-- Removing Carousel classes hides/misplaces the information in the carousel slide -->
		<!-- To do: Figure out why carousel blocks navbar dropdowns -->
		<!-- To do: Alternative to Carousel -->
		<div class="carousel slide">
			<div class="carousel-inner">
				<div class="carousel-caption">
					<div class="panel-group" id="CalendarAccordion">
						<!-- Breakfast -->
						<!-- Test header information -->
						<!-- To do: Fill in dynamically, match layout of Dinner -->
						<div id="AccordionBreakfastHeader" class="panel panel-default list-grey">
							<!-- Header -->
							<div class="panel-heading"  data-toggle="collapse" data-parent="#CalendarAccordion" href="#AccordionBreakfast">
								<h4 class="panel-title">
									<a>Breakfast</a>
									<span class="pull-right spacer-right"><span class="hidden-phone">Print </span><span class="glyphicon glyphicon-print"></span></span>
									<span class="pull-right spacer-right"><span class="hidden-phone">Save </span><span class="glyphicon glyphicon-save"></span></span>
								</h4>
							</div>
							<!-- Body -->
							<div id="AccordionBreakfast" class="panel-collapse collapse">
								<div class="panel-body list-grey">
									<h1 class="recipeTitle">Sausage Scrambler</h1>
								</div>
							</div>
						</div>
						<!-- Dinner -->
						<div id="AccordionDinnerHeader" class="panel panel-default list-grey">
							<!-- Header -->
							<div class="panel-heading"  data-toggle="collapse" data-parent="#CalendarAccordion" href="#AccordionDinner">
								<h4 class="panel-title">
									<a>Dinner</a>
									<span class="pull-right spacer-right"><span class="hidden-phone">Print </span><span class="glyphicon glyphicon-print"></span></span>
									<span class="pull-right spacer-right"><span class="hidden-phone">Save </span><span class="glyphicon glyphicon-save"></span></span>
								</h4>
							</div>
							<!-- Body -->
							<div id="AccordionDinner" class="panel-collapse collapse in">
								<div class="panel-body list-grey">
									<h1 class="recipeTitle"><?php print $recipe->getName(); ?></h1>
									<!-- 
									     Phones and Tablets - Vertical layout, accordions, all col-12, time up top
									     Computers          - Horizontal layout
									-->
									<!-- Row so all columns line up horizontally, mainly for computers -->
									<div class="row">
										<!-- 
										     Phones and Tablets - Vertical layout, accordions for ingredients and tools, all col-12, time up top
										     Computers          - Horizontal layout, full list for ingredients and tools, several columns, time on right (so last in list)
										-->
										<!-- Time up top for phones, tablets -->
										<div class="hidden-md hidden-lg">
											<h4 class="recipeTime">Time: <?php print $recipe->getTimeTotal(); ?></h4>
										</div>
										<!-- Tools -->
										<!-- To do: test whether there are any tools first, create alternative if empty -->
										<div class="col-md-2">
											<!-- Collapse trigger for phones, tablets -->
											<a class="a-override hidden-md hidden-lg" data-toggle="collapse" href="#AccordionTool0"><h4><span class="glyphicon glyphicon-chevron-up"></span>&nbsp;Tools</h4></a>
											<!-- Always show full list for computers -->
											<h2 class="hidden-xs hidden-sm">Tools</h2>
											<!-- List -->
											<ul class="list-group recipeTool panel-collapse collapse in" id="AccordionTool0">
												<!-- Generate tool list items - just the name -->
												<?php
													for ($i = 0; $i < $recipe->getNumTools(); $i++) {
														print '<li class="list-group-item">'.$recipe->getToolName($i).'</span></li>';
													}
												?>
											</ul>
										</div>
										<!-- Ingredients -->
										<!-- To do: test whether there are any ingredients first, create alternative if empty -->
										<div class="col-md-4">
											<!-- Collapse trigger for phones, tablets -->
											<a class="a-override hidden-md hidden-lg" data-toggle="collapse" href="#AccordionIngredient0"><h4><span class="glyphicon glyphicon-chevron-up"></span>&nbsp;Ingredients</h4></a>
											<!-- Always show full list for computers -->
											<h2 class="hidden-xs hidden-sm">Ingredients</h2>
											<!-- List -->
											<ul class="list-group recipeIngredient panel-collapse collapse in" id="AccordionIngredient0">
												<!-- Generate ingredient list items - name on left, details on right -->
												<?php
									for ($i = 0; $i < $recipe->getNumIngredients(); $i++) {
										$ingredient = $recipe->getIngredient($i);
										$ingName = $ingredient->getName();
										$ingDetails = $ingredient->getAmount().' '.$ingredient->getMeasurementName();
										if ($ingredient->hasPreparation()) {
											$ingDetails .= ', '.$ingredient->getPreparationName();
										}
										//Use inline-block to show multiple lines if name and details is too long
										//32 characters is great for the big screen, where ingredient table is 1/3 screen
										//... But too short for small screens that have the full width
										//    and inline-block will make the list item the minimum width
										//  Solution is to add width = 100%
										//... More common method of testing heights is impossible, 
										//    because this is tested when the first slide is visible and others invisible
										//    and the height of those other slides is negative at that time
										//Can't just use inline-block, too short, uses minimum width until past parent's width
										if (strlen($ingName.$ingDetails) >= 32) {
											print	'
												<li class="list-group-item" style="display: inline-block; width: 100%;">
												';
										} else {
											print	'
												<li class="list-group-item">
												';
										}
										print 			$ingName.'<span class="pull-right">'.$ingDetails.'</span>
												</li>';
									}
												?>
											</ul>
										</div>
										<!-- Time on right for computer -->
										<div class="col-md-2 hidden-xs hidden-sm">
											<h2 class="recipeTime">Time: <?php print $recipe->getTimeTotal(); ?></h2>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Controls -->
			<!-- Used for width control -->
			<a class="left carousel-control">
			</a>
			<a class="right carousel-control">
			</a>
		</div>
	</body>
</html>

