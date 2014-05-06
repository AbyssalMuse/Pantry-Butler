<!-- My Recipes
     Lets user see their favorite recipes all in one place
     Basically this will be the social part of the site
     Rate recipes, share them, edit them, etc.
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

  		<title>The Pantry Butler - Recipes</title>
  		
  		<!-- Common styles and javascript -->
  		<?php require_once "Includes/HTML.inc.php"; ?>
  	</head>

  	<body>
  		<?php require_once "Includes/Navbar.inc.php"; ?>
  		
  		<!-- Recipes and a search - both in accordions
  		     Search area first, open
  		     Another accordion for each cuisine, full of corresponding recipes
  		-->
  		<!-- To do: Think about uses for this page. Nice to have it all in one, but for editing, rating, pushing to friends/forums? -->
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
					<div id="AccordionSearch" class="panel-collapse collapse">
						<div class="panel-body list-grey">
							<div class="row">
								<!-- To do: Make the searches functional -->
								<!-- Recipe search -->
								<div class="col-sm-4">
									<label class="sr-only" for="SearchRecipe">Recipe</label>
									<div class="input-group">
										<input type="password" class="form-control" id="SearchRecipe" placeholder="Enter Recipe">
										<span class="input-group-addon"><span class="caret"></span></span>
										<!-- To do: Dynamically create list of recipes from user's created recipes-->
									</div>
								</div>
								<!-- Ingredient search -->
								<div class="col-sm-4">
									<label class="sr-only" for="SearchName">Ingredient</label>
									<div class="input-group">
										<input type="email" class="form-control" id="SearchName" placeholder="Enter ingredient">
										<span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
										<!-- To do: Create dropdown of available ingredients once possibilities narrowed down a bit -->
									</div>
								</div>
								<!-- Cuisine search -->
								<!-- To do: Cuisines already provided below, so search by rating or author instead? -->
								<div class="col-sm-4">
									<label class="sr-only" for="SearchCuisine">Cuisine</label>
									<div class="input-group">
										<input type="password" class="form-control" id="SearchCuisine" placeholder="Enter Cuisine">
										<span class="input-group-addon"><span class="caret"></span></span>
										<!-- To do: Dynamically create list of cuisines? Or just pull in all user's choices? -->
									</div>
								</div>
							</div>
							<!-- Recipes found -->
							<h1>Results</h1>
							<ul class="list-group list-grey All">
								<!-- To do: Dynamically fill in, match following format -->
								<li class="list-group-item list-grey">
									<!-- To do: Selection key? Or should edit have some options? -->
									<span class="glyphicon glyphicon-edit spacer-right"></span>
									Keema
									<!-- Show rating -->
									<span class="spacer-left"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star-empty"></span>
								</li>
								<li class="list-group-item list-grey">
									<!-- To do: Selection key? Or should edit have some options? -->
									<span class="glyphicon glyphicon-edit spacer-right"></span>
									Sausage Scramble
									<!-- Show rating -->
									<span class="spacer-left"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- My Uploaded -->
				<div id="AccordionMyHeader" class="panel panel-default list-grey">
					<!-- Header -->
					<div class="panel-heading"  data-toggle="collapse" data-parent="#PantryAccordion" href="#AccordionMy">
						<h4 class="panel-title">
							<a>My Uploaded Recipes</a>
							<span class="pull-right spacer-right"><span class="hidden-phone">Print </span><span class="glyphicon glyphicon-print"></span></span>
							<span class="pull-right spacer-right"><span class="hidden-phone">Save </span><span class="glyphicon glyphicon-save"></span></span>
						</h4>
					</div>
					<!-- Body -->
					<div id="AccordionMy" class="panel-collapse collapse in">
						<div class="panel-body list-grey">
							<ul class="list-group list-grey All">
								<!-- To do: Dynamically fill in with user's recipes -->
								<li class="list-group-item list-grey">
									<span class="glyphicon glyphicon-edit spacer-right"></span>
									Keema
									<!-- Rating -->
									<span class="spacer-left"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star-empty"></span>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- To do: Dynamically create panels based on user's cuisines -->
				<!-- To do: Should I only pull in favorited recipes? All that match cuisine? Only those commented by user? -->
				<!-- To do: Match format of above My Recipes panel, if any changes -->
				<!-- TexMex -->
				<div id="AccordionTexMexHeader" class="panel panel-default list-grey">
					<!-- Header -->
					<div class="panel-heading"  data-toggle="collapse" data-parent="#PantryAccordion" href="#AccordionTexMex">
						<h4 class="panel-title">
							<a>TexMex</a>
							<span class="pull-right spacer-right"><span class="hidden-phone">Print </span><span class="glyphicon glyphicon-print"></span></span>
							<span class="pull-right spacer-right"><span class="hidden-phone">Save </span><span class="glyphicon glyphicon-save"></span></span>
						</h4>
					</div>
					<!-- Body -->
					<div id="AccordionTexMex" class="panel-collapse collapse">
						<div class="panel-body list-grey">
							<ul class="list-group list-grey All">
								<!-- To do: Dynamically fill in with user's recipes -->
								<li class="list-group-item list-grey">
									<span class="glyphicon glyphicon-edit spacer-right"></span>
									Sausage Scrambler
									<span class="spacer-left"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- Indian -->
				<div id="AccordionIndianHeader" class="panel panel-default list-grey">
					<!-- Header -->
					<div class="panel-heading"  data-toggle="collapse" data-parent="#PantryAccordion" href="#AccordionIndian">
						<h4 class="panel-title">
							<a>Indian</a>
							<span class="pull-right spacer-right"><span class="hidden-phone">Print </span><span class="glyphicon glyphicon-print"></span></span>
							<span class="pull-right spacer-right"><span class="hidden-phone">Save </span><span class="glyphicon glyphicon-save"></span></span>
						</h4>
					</div>
					<!-- Body -->
					<div id="AccordionIndian" class="panel-collapse collapse">
						<div class="panel-body list-grey">
							<ul class="list-group list-grey All">
								<li class="list-group-item list-grey">
									<!-- To do: Dynamically fill in with user's recipes -->
									<span class="glyphicon glyphicon-edit spacer-right"></span>
									Keema
									<span class="spacer-left"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star-empty"></span>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

	</body>
</html>

