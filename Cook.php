<!-- Cook
     Slideshow with instructions and ingredients for each step in the cooking process
     
     Dynamically pulls recipe information from data, using RecipeOverview
       Usage is simple - create, use accessor functions
       RecipeOverview does most of the heavy lifting...
     Doesn't pull images yet
     Doesn't pull time for each step yet
-->
<!-- To do: Accept RecipeID through post or calendar table -->
<!-- To do: Slideshow advances when step time is complete -->
<!-- To do: Time counts down -->

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

  		<title>The Pantry Butler - Cook!</title>
  		
  		<!-- Common styles and javascript -->
  		<?php require_once "Includes/HTML.inc.php"; ?>

  		<!-- Gather recipe information -->
  		<?php 	require_once "Classes/RecipeOverview.class.php";
  		      	require_once "Classes/Cuisine.class.php";
  		      
			//To do: Get RecipeID from $_POST or Calendar table
  			$recipe = new RecipeOverview(1);
  			$cuisine = Cuisine::createFromQuery("Indian");
			//To do: Test for bad recipe, cuisine
		?>
  	</head>

  	<body>
		<?php require_once "Includes/Navbar.inc.php"; ?>
		
	
		<!-- Carousel - slideshow of cooking steps and instructions -->
		<div id="recipeCarousel" class="carousel slide" data-ride="carousel">
			<!-- Indicators -->
			<ol class="carousel-indicators carousel-indicators-top">
				<li data-target="#recipeCarousel" data-slide-to="0" class="active"></li> <!-- Overview (guaranteed) -->
				<!-- Generate indicator for each step -->
				<?php
		for ($i = 1; $i < $recipe->getNumSteps(); $i++) {
			print  '<li data-target="#recipeCarousel" data-slide-to="';
			print 	 $i;
			print 	 '"></li>
				';
		}
				?>
			</ol>
		
			<!-- Wrapper for slides -->
			<div class="carousel-inner">
				<!-- Overview (guaranteed) -->
				<div class="item active">
					<div class="carousel-caption">
						<div class="row">
							<div class="col-xs-offset-3 col-xs-6 text-center">
								<span class="h1"><?php print $recipe->getName(); ?></span>
							</div>
						</div>
						<!-- 
						     Phones and Tablets - Vertical layout, accordions for ingredients and tools, all col-12, time up top
						     Computers          - Horizontal layout, full list for ingredients and tools, several columns, time on right (so last in list)
						-->
						<!-- Row so all columns line up horizontally, mainly for computers -->
						<div class="row">
							<!-- Time up top for phones, tablets -->
							<div class="hidden-md hidden-lg">
								<h4 class="recipeTime">Time: <?php print $recipe->getTimeTotal(); ?></h4>
							</div>
							<!-- Tools (assume there are some) -->
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
							<!-- Ingredients (assume there are some) -->
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
							/* Expansion past screen test
							if ($i == $recipe->getNumIngredients())
								$ingredient = $recipe->getIngredient(0);
							else
							*/
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
							<div class="col-md-4 hidden-xs hidden-sm">
								<h2 class="recipeTime">Time: <?php print $recipe->getTimeTotal(); ?></h2>
								<br><br><br>
								<img src="Images/keema.jpg" alt="Overview">
							</div>
						</div>
					</div>
				</div>
				<!-- Steps -->
				<!-- Same layout as overview, just dynamically created -->
				<?php
		for ($i = 1; $i < $recipe->getNumSteps(); $i++) {
			$step = $recipe->getStep($i);
			print  '
				<div class="item">
					<div class="carousel-caption recipeStep">
						<div class="row">
							<div class="col-xs-offset-3 col-xs-6 text-center">
								<span class="h1">'.$recipe->getName().'</span>
							</div>
						</div>
						<div class="row">
							<div class="hidden-md hidden-lg">
								<h4 class="recipeTime">Time: '.$recipe->getTimeTotal().'</h4>
							</div>
							<div class="col-md-4">';
			if ($step->hasTool()) {
				print '
							 	<a class="a-override hidden-md hidden-lg" data-toggle="collapse" href="#AccordionTool'.$i.'"><h4><span class="glyphicon glyphicon-chevron-up"></span>&nbsp;Tools</h4></a>
								<h2 class="hidden-xs hidden-sm">Tools</h2>
								<ul class="list-group recipeTool panel-collapse collapse in" id="AccordionTool'.$i.'">
									<li class="list-group-item">'.$step->getToolName().'</li>
								</ul>';
			}
			if ($step->getNumIngredients() > 0) {
				print '
								<a class="a-override hidden-md hidden-lg" data-toggle="collapse" href="#AccordionIngredient'.$i.'"><h4><span class="glyphicon glyphicon-chevron-up"></span>&nbsp;Ingredients</h4></a>
								<h2 class="hidden-xs hidden-sm">Ingredients</h2>
								<ul class="list-group recipeIngredient panel-collapse collapse in" id="AccordionIngredient'.$i.'">';
				for ($j = 0; $j < $step->getNumIngredients(); $j++) {
					/* Expansion past screen test
					if ($i == $recipe->getNumIngredients())
						$ingredient = $recipe->getIngredient(0);
					else
					*/
					$ingredient = $step->getIngredient($j);
					$ingName = $ingredient->getName();
					$ingDetails = $ingredient->getAmount().' '.$ingredient->getMeasurementName();
					if ($ingredient->hasPreparation()) {
						$ingDetails .= ', '.$ingredient->getPreparationName();
					}
					//Use inline-block to show multiple lines if name and details is too long
					//See above for more details
					if (strlen($ingName.$ingDetails) >= 32) {
						print	'
									<li class="list-group-item" style="display: inline-block; width: 100%;">
									';
					} else {
						print	'
									<li class="list-group-item">
									';
					}
					print 					$ingName.'<span class="pull-right">'.$ingDetails.'</span>
									</li>';
				}
				print '
								</ul>';
			}
			print '
							</div>
							<div class="col-md-8">
								<div class="hidden-xs hidden-sm">
									<h2 class="recipeTime">Time: '.$recipe->getTimeTotal().'</h2>
								</div>
								<br>
							        '.$step->getInstructions().'
							        <br><br><br>
								<img src="Images/keema.jpg" alt="Overview">
							</div>
						</div>
					</div>
				</div>';
		}
				?>
				
			</div>
			
			<!-- Controls -->
			<!-- Important to leave these at 15% width for phone sizing -->
			<a class="left carousel-control" href="#recipeCarousel" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left"></span>
			</a>
			<a class="right carousel-control" href="#recipeCarousel" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right"></span>
			</a>
		</div>
		
	</body>
</html>

