<?php
	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		if (isset($_GET["length"])) {
			if ($_GET["length"] == 1)
				header("Location: CalendarToday.php");
			else if ($_GET["length"] > 7)
				header("Location: CalendarWide.php");
		}
	}
?>
<!-- Do not put comments above - interferes with redirect -->
<!-- Redirect based on number of days user wants to see
     This page for general display - week, 3 day 
     Today for showing recipes of the day, including necessary ingredients
     Wide for showing multiple weeks at a time, only includes recipe names
-->

<!-- Calendar
     Displays recipes for next few days, 2-7 days
     Display vertically, in accordions, with some basic information
     Use CalendarToday for complete information
     Use CalendarWide for little information to show several weeks
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

  		<title>The Pantry Butler - Calendar</title>
  		
  		<!-- Common styles and javascript -->
  		<?php require_once "Includes/HTML.inc.php"; ?>
  	</head>

  	<body>
  		<?php require_once "Includes/Navbar.inc.php"; ?>
  		
  		<!-- Display each day in an accordion
  		     Short descriptions for recipe
  		-->
  		<div class="container center-block">
			<div class="panel-group" id="CalendarAccordion">
				<!-- To do: Use $_POST["length"] to determine number of days to print with php -->
				<!-- Today -->
				<div id="AccordionTodayHeader" class="panel panel-default list-grey">
					<!-- Today header -->
					<div class="panel-heading"  data-toggle="collapse" data-parent="#CalendarAccordion" href="#AccordionToday">
						<h4 class="panel-title">
							<a>Today</a>
							<span class="pull-right spacer-right"><span class="hidden-phone">Print </span><span class="glyphicon glyphicon-print"></span></span>
							<span class="pull-right spacer-right"><span class="hidden-phone">Save </span><span class="glyphicon glyphicon-save"></span></span>
						</h4>
					</div>
					<!-- Today body -->
					<div id="AccordionToday" class="panel-collapse collapse in">
						<div class="panel-body list-grey">
							<ul class="list-group list-grey All">
								<!-- Break down meals into general breakfast, lunch, dinner
								     Only show if a recipe is found for that time
								     Requires Calendar table to have a new Time/MealName field
								-->
								<!-- Breakfast -->
								<li class="list-group-item list-grey">
									<!-- To do: Test data, should be filled dynamically in future, but with this layout -->
									<!-- To do: connect list items with javascript functions -->
									<!-- To do: link recipe to a Cook or Overview page, or construct a modal "page" from php -->
									<p class="glyphicon glyphicon-edit spacer-left"> <!-- Change meal button -->
										Breakfast
										<span class="spacer-left">Time: 00:10</span>
										<!-- Options: Remove, Show tools, Show ingredients
										     Show individually on tablets, computers
										     Collect into dropdown for phone
										-->
										<!-- Tablets and computers - show individually -->
										<div class="hidden-phone">
											<div class="pull-right">
												<button type="button" class="btn btn-danger list-grey dropdown-toggle spacer-left" data-toggle="dropdown">
													Remove<span class="glyphicon glyphicon-trash spacer-left">
												</button>
											</div>
											<div class="btn-group pull-right">
												<button type="button" class="btn btn-primary list-grey dropdown-toggle spacer-left" data-toggle="dropdown">Tools</button>
												<ul class="list-group dropdown-menu list-grey no-border scrollable">
													<!-- List of required tools, fill in dynamically -->
												</ul>
											</div>
											<div class="btn-group pull-right">
												<button type="button" class="btn btn-primary list-grey dropdown-toggle spacer-left" data-toggle="dropdown">Ingredients</button>
												<ul class="list-group dropdown-menu list-grey no-border scrollable">
													<!-- List of required ingredients and maybe amounts, fill in dynamically -->
												</ul>
											</div>
										</div>
										<!-- Phone - dropdown button -->
										<div class="btn-group hidden-tablet pull-right">
											<button type="button" class="btn btn-primary list-grey dropdown-toggle pull-right spacer-left" data-toggle="dropdown">
												<span class="visible-tablet">More Info<span class="caret"></span></span> <!-- legacy? -->
												<span class="visible-phone caret">Info</span>
											</button>
											<ul class="list-group dropdown-menu list-grey scrollable" role="menu">
												<li class="list-group-item list-grey no-border hidden-tablet">Ingredients</li>
												<li class="list-group-item list-grey no-border hidden-tablet">Tools</li>
												<li class="list-group-item list-grey no-border">Remove</li>
											</ul>
										</div>
									</p>
									<!-- More info on recipe through link -->
									<p class="spacer-left">
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a>Sausage Scrambler</a>
									</p>
								</li>
								<!-- Dinner -->
								<li class="list-group-item list-grey">
									<p class="glyphicon glyphicon-edit spacer-left">
										Dinner
										<span class="spacer-left">Time: 00:30</span>
										<!-- Options: Remove, Show tools, Show ingredients
										     Show individually on tablets, computers
										     Collect into dropdown for phone
										-->
										<!-- Tablets and computers - show individually -->
										<div class="hidden-phone">
											<div class="pull-right">
												<button type="button" class="btn btn-danger list-grey dropdown-toggle spacer-left" data-toggle="dropdown">
													Remove<span class="glyphicon glyphicon-trash spacer-left">
												</button>
											</div>
											<div class="btn-group pull-right">
												<button type="button" class="btn btn-primary list-grey dropdown-toggle spacer-left" data-toggle="dropdown">Tools</button>
												<ul class="list-group dropdown-menu list-grey no-border scrollable">
													<!-- List of required tools, fill in dynamically -->
												</ul>
											</div>
											<div class="btn-group pull-right">
												<button type="button" class="btn btn-primary list-grey dropdown-toggle spacer-left" data-toggle="dropdown">Ingredients</button>
												<ul class="list-group dropdown-menu list-grey no-border scrollable">
													<!-- List of required ingredients, fill in dynamically -->
												</ul>
											</div>
										</div>
										<!-- Phone - dropdown button -->
										<div class="btn-group hidden-tablet pull-right">
											<button type="button" class="btn btn-primary list-grey dropdown-toggle pull-right spacer-left" data-toggle="dropdown">
												<span class="visible-tablet">More Info<span class="caret"></span></span> <!-- legacy? -->
												<span class="visible-phone caret">Info</span>
											</button>
											<ul class="list-group dropdown-menu list-grey scrollable" role="menu">
												<li class="list-group-item list-grey no-border hidden-tablet">Ingredients</li>
												<li class="list-group-item list-grey no-border hidden-tablet">Tools</li>
												<li class="list-group-item list-grey no-border">Remove</li>
											</ul>
										</div>
									</p>
									<!-- More info on recipe through link -->
									<p class="spacer-left">
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a>Artichoke Pasta</a>
									</p>
								</li>
								<!-- Preparation for tomorrow, future meals, such as marinades -->
								<!-- To do: figure out how to express it in Calendar table -->
								<li class="list-group-item list-grey">
									<p class="glyphicon glyphicon-edit spacer-left">
										For tomorrow
										<span class="spacer-left">Time: 00:10</span>
										<!-- Options: Remove, Show tools, Show ingredients
										     Show individually on tablets, computers
										     Collect into dropdown for phone
										-->
										<!-- Tablets and computers - show individually -->
										<div class="hidden-phone">
											<div class="pull-right">
												<button type="button" class="btn btn-danger list-grey dropdown-toggle spacer-left" data-toggle="dropdown">
													Remove<span class="glyphicon glyphicon-trash spacer-left">
												</button>
											</div>
											<div class="btn-group pull-right">
												<button type="button" class="btn btn-primary list-grey dropdown-toggle spacer-left" data-toggle="dropdown">Tools</button>
												<ul class="list-group dropdown-menu list-grey no-border scrollable">
													<!-- List of required tools, fill in dynamically -->
												</ul>
											</div>
											<div class="btn-group pull-right">
												<button type="button" class="btn btn-primary list-grey dropdown-toggle spacer-left" data-toggle="dropdown">Ingredients</button>
												<ul class="list-group dropdown-menu list-grey no-border scrollable">
													<!-- List of required ingredients, fill in dynamically -->
												</ul>
											</div>
										</div>
										<!-- Phone - dropdown button -->
										<div class="btn-group hidden-tablet pull-right">
											<button type="button" class="btn btn-primary list-grey dropdown-toggle pull-right spacer-left" data-toggle="dropdown">
												<span class="visible-tablet">More Info<span class="caret"></span></span> <!-- legacy? -->
												<span class="visible-phone caret">Info</span>
											</button>
											<ul class="list-group dropdown-menu list-grey scrollable" role="menu">
												<li class="list-group-item list-grey no-border hidden-tablet">Ingredients</li>
												<li class="list-group-item list-grey no-border hidden-tablet">Tools</li>
												<li class="list-group-item list-grey no-border">Remove</li>
											</ul>
										</div>
									</p>
									<!-- More info on recipe through link -->
									<p class="spacer-left">
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a>Steak Marinade</a>
									</p>
								</li>
								<!-- To do: Fill in more with database query
								
								-->
							</ul>
						</div>
					</div>
				</div>
				<!-- Tomorrow -->
				<!-- To do: Fill in dynamically, use today as template -->
				<div id="AccordionTomorrowHeader" class="panel panel-default list-grey">
					<div class="panel-heading"  data-toggle="collapse" data-parent="#CalendarAccordion" href="#AccordionTomorrow">
						<h4 class="panel-title">
							<a>Tomorrow</a>
							<span class="pull-right spacer-right"><span class="hidden-phone">Print </span><span class="glyphicon glyphicon-print"></span></span>
							<span class="pull-right spacer-right"><span class="hidden-phone">Save </span><span class="glyphicon glyphicon-save"></span></span>
						</h4>
					</div>
					<div id="AccordionTomorrow" class="panel-collapse collapse">
						<div class="panel-body list-grey">
						
						</div>
					</div>
				</div>
				<!-- Next1 -->
				<!-- To do: Fill in dynamically, use today as template -->
				<!-- To do: Fill in panel title dynamically with calendar date -->
				<div id="AccordionNext1Header" class="panel panel-default list-grey">
					<div class="panel-heading"  data-toggle="collapse" data-parent="#CalendarAccordion" href="#AccordionNext1">
						<h4 class="panel-title">
							<a>May 1st, 2014</a>
							<span class="pull-right spacer-right"><span class="hidden-phone">Print </span><span class="glyphicon glyphicon-print"></span></span>
							<span class="pull-right spacer-right"><span class="hidden-phone">Save </span><span class="glyphicon glyphicon-save"></span></span>
						</h4>
					</div>
					<div id="AccordionNext1" class="panel-collapse collapse">
						<div class="panel-body list-grey">
						
						</div>
					</div>
				</div>
				<!-- Next2 -->
				<!-- To do: Fill in dynamically, use today as template -->
				<!-- To do: Fill in panel title dynamically with calendar date -->
				<div id="AccordionNext2Header" class="panel panel-default list-grey">
					<div class="panel-heading"  data-toggle="collapse" data-parent="#CalendarAccordion" href="#AccordionNext2">
						<h4 class="panel-title">
							<a>May 2nd, 2014</a>
							<span class="pull-right spacer-right"><span class="hidden-phone">Print </span><span class="glyphicon glyphicon-print"></span></span>
							<span class="pull-right spacer-right"><span class="hidden-phone">Save </span><span class="glyphicon glyphicon-save"></span></span>
						</h4>
					</div>
					<div id="AccordionNext2" class="panel-collapse collapse">
						<div class="panel-body list-grey">
						
						</div>
					</div>
				</div>
			</div>
		</div>

	</body>
</html>

