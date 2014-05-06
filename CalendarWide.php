<!-- Calendar Wide
     Displays recipe names for each day for next few weeks
     Use CalendarToday for complete information for one or two days
     Use CalendarWide for more information to show several days
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
  		
  		<!-- Display each day as a panel, date in header and recipes in body
  		     Few details, but can link to see more
  		     4 panels per row
  		-->
  		<!-- To do: Test tablets, phones - should get a vertical list -->
  		<div class="container center-block">
  			<!-- To do: Use $_POST["length"] to determine number of days to print with php -->
			<div class="row">
				<!-- Today -->
				<div class="col-sm-3">
					<div class="panel-group">
						<!-- Leave panel without borders
						<div class="panel panel-default list-grey">
						-->
						<!-- Header -->
						<div class="panel-heading" >
							<h4 class="panel-title">Today</h4>
						</div>
						<!-- Body -->
						<div class="panel-body list-grey">
							<ul class="list-group list-grey Today">
								<!-- Test data for layout -->
								<!-- To do: Fill in dynamically -->
								<!-- Breakfast -->
								<li class="list-group-item list-grey">
									<p>
										<span class="glyphicon glyphicon-edit"></span>
										<span class="spacer-left">Breakfast</span>
										<span class="pull-right">00:10</span>
									</p>
									<p class="text-center">
										<a>Sausage Scrambler</a>
									</p>
								</li>
								<!-- Dinner -->
								<li class="list-group-item list-grey">
									<p>
										<span class="glyphicon glyphicon-edit"></span>
										<span class="spacer-left">Dinner</span>
										<span class="pull-right">00:30</span>
									</p>
									<p class="text-center">
										<a>Keema</a>
									</p>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- Tomorrow -->
				<div class="col-sm-3">
					<div class="panel-group">
						<!-- Header -->
						<div class="panel-heading" >
							<h4 class="panel-title">Tomorrow</h4>
						</div>
						<!-- Body -->
						<div class="panel-body list-grey">
							<ul class="list-group list-grey Today">
								<!-- Test data for layout -->
								<!-- To do: Fill in dynamically -->
								<!-- Breakfast -->
								<li class="list-group-item list-grey">
									<p>
										<span class="glyphicon glyphicon-edit"></span>
										<span class="spacer-left">Breakfast</span>
										<span class="pull-right">00:10</span>
									</p>
									<p class="text-center">
										<a>Sausage Scrambler</a>
									</p>
								</li>
								<!-- Dinner -->
								<li class="list-group-item list-grey">
									<p>
										<span class="glyphicon glyphicon-edit"></span>
										<span class="spacer-left">Dinner</span>
										<span class="pull-right">00:30</span>
									</p>
									<p class="text-center">
										<a>Keema</a>
									</p>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- Next1 -->
				<!-- To do: Rest should follow this format, 4 per row -->
				<div class="col-sm-3">
					<div class="panel-group">
						<div class="panel-heading" >
							<h4 class="panel-title">May 1st, 2014</h4>
						</div>
						<div class="panel-body list-grey">
							<ul class="list-group list-grey Today">
								<li class="list-group-item list-grey">
									<p>
										<span class="glyphicon glyphicon-edit"></span>
										<span class="spacer-left">Breakfast</span>
										<span class="pull-right">00:10</span>
									</p>
									<p class="text-center">
										<a>Sausage Scrambler</a>
									</p>
								</li>
								<li class="list-group-item list-grey">
									<p>
										<span class="glyphicon glyphicon-edit"></span>
										<span class="spacer-left">Dinner</span>
										<span class="pull-right">00:30</span>
									</p>
									<p class="text-center">
										<a>Keema</a>
									</p>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="panel-group">
						<div class="panel-heading" >
							<h4 class="panel-title">May 2nd, 2014</h4>
						</div>
						<div class="panel-body list-grey">
							<ul class="list-group list-grey Today">
								<li class="list-group-item list-grey">
									<p>
										<span class="glyphicon glyphicon-edit"></span>
										<span class="spacer-left">Breakfast</span>
										<span class="pull-right">00:10</span>
									</p>
									<p class="text-center">
										<a>Sausage Scrambler</a>
									</p>
								</li>
								<li class="list-group-item list-grey">
									<p>
										<span class="glyphicon glyphicon-edit"></span>
										<span class="spacer-left">Dinner</span>
										<span class="pull-right">00:30</span>
									</p>
									<p class="text-center">
										<a>Keema</a>
									</p>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3">
					<div class="panel-group">
						<div class="panel-heading" >
							<h4 class="panel-title">Today</h4>
						</div>
						<div class="panel-body list-grey">
							<ul class="list-group list-grey Today">
								<li class="list-group-item list-grey">
									<p>
										<span class="glyphicon glyphicon-edit"></span>
										<span class="spacer-left">Breakfast</span>
										<span class="pull-right">00:10</span>
									</p>
									<p class="text-center">
										<a>Sausage Scrambler</a>
									</p>
								</li>
								<li class="list-group-item list-grey">
									<p>
										<span class="glyphicon glyphicon-edit"></span>
										<span class="spacer-left">Dinner</span>
										<span class="pull-right">00:30</span>
									</p>
									<p class="text-center">
										<a>Keema</a>
									</p>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="panel-group">
						<div class="panel-heading" >
							<h4 class="panel-title">Today</h4>
						</div>
						<div class="panel-body list-grey">
							<ul class="list-group list-grey Today">
								<li class="list-group-item list-grey">
									<p>
										<span class="glyphicon glyphicon-edit"></span>
										<span class="spacer-left">Breakfast</span>
										<span class="pull-right">00:10</span>
									</p>
									<p class="text-center">
										<a>Sausage Scrambler</a>
									</p>
								</li>
								<li class="list-group-item list-grey">
									<p>
										<span class="glyphicon glyphicon-edit"></span>
										<span class="spacer-left">Dinner</span>
										<span class="pull-right">00:30</span>
									</p>
									<p class="text-center">
										<a>Keema</a>
									</p>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="panel-group">
						<div class="panel-heading" >
							<h4 class="panel-title">Today</h4>
						</div>
						<div class="panel-body list-grey">
							<ul class="list-group list-grey Today">
								<li class="list-group-item list-grey">
									<p>
										<span class="glyphicon glyphicon-edit"></span>
										<span class="spacer-left">Breakfast</span>
										<span class="pull-right">00:10</span>
									</p>
									<p class="text-center">
										<a>Sausage Scrambler</a>
									</p>
								</li>
								<li class="list-group-item list-grey">
									<p>
										<span class="glyphicon glyphicon-edit"></span>
										<span class="spacer-left">Dinner</span>
										<span class="pull-right">00:30</span>
									</p>
									<p class="text-center">
										<a>Keema</a>
									</p>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="panel-group">
						<div class="panel-heading" >
							<h4 class="panel-title">Today</h4>
						</div>
						<div class="panel-body list-grey">
							<ul class="list-group list-grey Today">
								<li class="list-group-item list-grey">
									<p>
										<span class="glyphicon glyphicon-edit"></span>
										<span class="spacer-left">Breakfast</span>
										<span class="pull-right">00:10</span>
									</p>
									<p class="text-center">
										<a>Sausage Scrambler</a>
									</p>
								</li>
								<li class="list-group-item list-grey">
									<p>
										<span class="glyphicon glyphicon-edit"></span>
										<span class="spacer-left">Dinner</span>
										<span class="pull-right">00:30</span>
									</p>
									<p class="text-center">
										<a>Keema</a>
									</p>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- Load and display more recipes -->
			<!-- To do: Figure out how to dynamically include more and more php -->
			<a class="h4 text-shadow-hover">Show more...</a>
  		</div>

	</body>
</html>

