<!-- Shopping List
     See the list while you shop, check off items as you get them, or push them off until later
     Breaks down by store
     If at home, save and print buttons for off-line copies
-->
<!-- To do: Use geolocation to determine which store they're at and show that list -->

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

  		<title>The Pantry Butler - Shopping List</title>
  		
  		<!-- Common styles and javascript -->
  		<?php require_once "Includes/HTML.inc.php"; ?>
  	</head>

  	<body>
  		<?php require_once "Includes/Navbar.inc.php"; ?>
  		
  		<!-- Shopping lists broken down by store, with All in top accordion -->
  		<div class="container center-block">
			<div class="panel-group" id="ShoppingAccordion">
				<!-- All -->
				<div id="AccordionAllHeader" class="panel panel-default list-grey">
					<!-- Header -->
					<div class="panel-heading"  data-toggle="collapse" data-parent="#ShoppingAccordion" href="#AccordionAll">
						<h4 class="panel-title">
							<a>Complete Shopping List</a>
							<span class="pull-right spacer-right"><span class="hidden-phone">Print </span><span class="glyphicon glyphicon-print"></span></span>
							<span class="pull-right spacer-right"><span class="hidden-phone">Save </span><span class="glyphicon glyphicon-save"></span></span>
						</h4>
					</div>
					<!-- Body -->
					<div id="AccordionAll" class="panel-collapse collapse">
						<div class="panel-body list-grey">
							<!-- List of ingredients with name, price, amount you need, and options
							     Also includes a divider that calculates prices of items above
							     Can move ingredients around, change order, including divider
							-->
							<!-- To do: Make buttons functional -->
							<!-- To do: Make divider functional -->
							<ul class="list-group list-grey All">
								<!-- To do: Dynamically create list of ingredients -->
								<li class="list-group-item list-grey">
									<div>
										<span class="checkbox-inline spacer-right"><input type="checkbox" id="Item02"></span> <!-- Got item -->
										Milk
										<!-- Show all options inline on computer -->
										<!-- Price after amount on phone, so need to handle in this branch too -->
										<div class="hidden-xs">
											<span class="pull-right">$7.00 ($3.50 each)</span>
											<span class="pull-right spacer-right">Remove <span class="glyphicon glyphicon-trash"></span></span>
											<span class="pull-right spacer-right">Move <span class="glyphicon glyphicon-arrow-right"></span></span>
											<span class="glyphicon glyphicon-arrow-up spacer-right pull-right"></span>
											<span class="glyphicon glyphicon-arrow-down spacer-right pull-right"></span>
											<span class="spacer-right pull-right">Priority</span>
										</div>
										<!-- Options in pull-down on tablets and phones -->
										<div class="btn-group visible-xs pull-right">
											<span class="spacer-right hidden-phone">$7.00 ($3.50 each)</span> <!-- Shown after amount -->
											<button type="button" class="btn btn-default list-grey dropdown-toggle pull-right spacer-left" data-toggle="dropdown">
												<span class="visible-tablet">Options<span class="caret"></span></span>
												<span class="visible-phone caret"></span>
											</button>
											<ul class="list-group dropdown-menu list-grey scrollable" role="menu">
												<li class="list-group-item list-grey no-border">Priority - Up</li>
												<li class="list-group-item list-grey no-border">Priority - Down</li>
												<li class="list-group-item list-grey no-border">Change Store</li>
												<li class="list-group-item list-grey no-border">Later</li>
												<li class="list-group-item list-grey no-border">Remove</li>
											</ul>
										</div>
									</div>
									<!-- Amount -->
									<span class="spacer-left">
								    		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2 gallons
								    	</span>
								    	<!-- Price for phone -->
								    	<span class="spacer-left visible-phone">
								    		$7.00 ($3.50 each)
								    	</span>
								</li>
								<!-- Rest of ingredients should have the same layout, except the divider... -->
								<li class="list-group-item list-grey">
									<div>
										<span class="checkbox-inline spacer-right"><input type="checkbox" id="Item02"></span>
										Bread
										<div class="hidden-xs">
											<span class="pull-right">$2.50</span>
											<span class="pull-right spacer-right">Remove <span class="glyphicon glyphicon-trash"></span></span>
											<span class="pull-right spacer-right">Move <span class="glyphicon glyphicon-arrow-right"></span></span>
											<span class="glyphicon glyphicon-arrow-up spacer-right pull-right"></span>
											<span class="glyphicon glyphicon-arrow-down spacer-right pull-right"></span>
											<span class="spacer-right pull-right">Priority</span>
										</div>
										<div class="btn-group visible-xs pull-right">
											<span class="spacer-right hidden-phone">$2.50</span>
											<button type="button" class="btn btn-default list-grey dropdown-toggle pull-right spacer-left" data-toggle="dropdown">
												<span class="visible-tablet">Options<span class="caret"></span></span>
												<span class="visible-phone caret"></span>
											</button>
											<ul class="list-group dropdown-menu list-grey scrollable" role="menu">
												<li class="list-group-item list-grey no-border">Priority - Up</li>
												<li class="list-group-item list-grey no-border">Priority - Down</li>
												<li class="list-group-item list-grey no-border">Change Store</li>
												<li class="list-group-item list-grey no-border">Later</li>
												<li class="list-group-item list-grey no-border">Remove</li>
											</ul>
										</div>
									</div>
									<span class="spacer-left">
								    		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1 loaf
								    	</span>
								    	<span class="spacer-left visible-phone">
								    		$2.50
								    	</span>
								</li>
								<li class="list-group-item list-grey">
									<div>
										<span class="checkbox-inline spacer-right"><input type="checkbox" id="Item02"></span>
										Eggs
										<div class="hidden-xs">
											<span class="pull-right">$1.25</span>
											<span class="pull-right spacer-right">Remove <span class="glyphicon glyphicon-trash"></span></span>
											<span class="pull-right spacer-right">Move <span class="glyphicon glyphicon-arrow-right"></span></span>
											<span class="glyphicon glyphicon-arrow-up spacer-right pull-right"></span>
											<span class="glyphicon glyphicon-arrow-down spacer-right pull-right"></span>
											<span class="spacer-right pull-right">Priority</span>
										</div>
										<div class="btn-group visible-xs pull-right">
											<span class="spacer-right hidden-phone">$1.25</span>
											<button type="button" class="btn btn-default list-grey dropdown-toggle pull-right spacer-left" data-toggle="dropdown">
												<span class="visible-tablet">Options<span class="caret"></span></span>
												<span class="visible-phone caret"></span>
											</button>
											<ul class="list-group dropdown-menu list-grey scrollable" role="menu">
												<li class="list-group-item list-grey no-border">Priority - Up</li>
												<li class="list-group-item list-grey no-border">Priority - Down</li>
												<li class="list-group-item list-grey no-border">Change Store</li>
												<li class="list-group-item list-grey no-border">Later</li>
												<li class="list-group-item list-grey no-border">Remove</li>
											</ul>
										</div>
									</div>
									<span class="spacer-left">
								    		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1 dozen
								    	</span>
								    	<span class="spacer-left visible-phone">
								    		$1.25
								    	</span>
								</li>
							<!-- Total Divider -->
								<li class="divider list-group-item list-grey">
									<span class="glyphicon glyphicon-sort spacer-right"></span>
									Total cost:<span class="pull-right">$10.75</span>
								</li>
								<li class="list-group-item list-grey">
									<div>
										<span class="checkbox-inline spacer-right"><input type="checkbox" id="Item02"></span>
										Cheese
										<div class="hidden-xs">
											<span class="pull-right">$2.00</span>
											<span class="pull-right spacer-right">Remove <span class="glyphicon glyphicon-trash"></span></span>
											<span class="pull-right spacer-right">Move <span class="glyphicon glyphicon-arrow-right"></span></span>
											<span class="glyphicon glyphicon-arrow-up spacer-right pull-right"></span>
											<span class="glyphicon glyphicon-arrow-down spacer-right pull-right"></span>
											<span class="spacer-right pull-right">Priority</span>
										</div>
										<div class="btn-group visible-xs pull-right">
											<span class="spacer-right hidden-phone">$2.00</span>
											<button type="button" class="btn btn-default list-grey dropdown-toggle pull-right spacer-left" data-toggle="dropdown">
												<span class="visible-tablet">Options<span class="caret"></span></span>
												<span class="visible-phone caret"></span>
											</button>
											<ul class="list-group dropdown-menu list-grey scrollable" role="menu">
												<li class="list-group-item list-grey no-border">Priority - Up</li>
												<li class="list-group-item list-grey no-border">Priority - Down</li>
												<li class="list-group-item list-grey no-border">Change Store</li>
												<li class="list-group-item list-grey no-border">Later</li>
												<li class="list-group-item list-grey no-border">Remove</li>
											</ul>
										</div>
									</div>
									<span class="spacer-left">
								    		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;8 oz block
								    	</span>
								    	<span class="spacer-left visible-phone">
								    		$2.00
								    	</span>
								</li>
								<!-- fill in with database query
								
								-->
							</ul>
						</div>
					</div>
				</div>
				<!-- Kroger -->
				<!-- Layout matches above -->
				<!-- To do: Dynamically create from database -->
				<div id="AccordionKrogerHeader" class="panel panel-default list-grey">
					<div class="panel-heading"  data-toggle="collapse" data-parent="#ShoppingAccordion" href="#AccordionKroger">
						<h4 class="panel-title">
							<a>Kroger Shopping List</a>
							<span class="pull-right spacer-right"><span class="hidden-phone">Print </span><span class="glyphicon glyphicon-print"></span></span>
							<span class="pull-right spacer-right"><span class="hidden-phone">Save </span><span class="glyphicon glyphicon-save"></span></span>
						</h4>
					</div>
					<div id="AccordionKroger" class="panel-collapse collapse in">
						<div class="panel-body list-grey">
							<ul class="list-group list-grey All">
								<li class="list-group-item list-grey">
									<div>
										<span class="checkbox-inline spacer-right"><input type="checkbox" id="Item02"></span>
										Eggs
										<div class="hidden-xs">
											<span class="pull-right">$1.00</span>
											<span class="pull-right spacer-right">Remove <span class="glyphicon glyphicon-trash"></span></span>
											<span class="pull-right spacer-right">Move <span class="glyphicon glyphicon-arrow-right"></span></span>
											<span class="glyphicon glyphicon-arrow-up spacer-right pull-right"></span>
											<span class="glyphicon glyphicon-arrow-down spacer-right pull-right"></span>
											<span class="spacer-right pull-right">Priority</span>
										</div>
										<div class="btn-group visible-xs pull-right">
											<span class="spacer-right hidden-phone">$1.00</span>
											<button type="button" class="btn btn-default list-grey dropdown-toggle pull-right spacer-left" data-toggle="dropdown">
												<span class="visible-tablet">Options<span class="caret"></span></span>
												<span class="visible-phone caret"></span>
											</button>
											<ul class="list-group dropdown-menu list-grey scrollable" role="menu">
												<li class="list-group-item list-grey no-border">Priority - Up</li>
												<li class="list-group-item list-grey no-border">Priority - Down</li>
												<li class="list-group-item list-grey no-border">Change Store</li>
												<li class="list-group-item list-grey no-border">Later</li>
												<li class="list-group-item list-grey no-border">Remove</li>
											</ul>
										</div>
									</div>
									<span class="spacer-left">
								    		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1 dozen
								    	</span>
								    	<span class="spacer-left visible-phone">
								    		$1.00
								    	</span>
								</li>
								<li class="list-group-item list-grey">
									<div>
										<span class="checkbox-inline spacer-right"><input type="checkbox" id="Item02"></span>
										Cheese
										<div class="hidden-xs">
											<span class="pull-right">$2.00</span>
											<span class="pull-right spacer-right">Remove <span class="glyphicon glyphicon-trash"></span></span>
											<span class="pull-right spacer-right">Move <span class="glyphicon glyphicon-arrow-right"></span></span>
											<span class="glyphicon glyphicon-arrow-up spacer-right pull-right"></span>
											<span class="glyphicon glyphicon-arrow-down spacer-right pull-right"></span>
											<span class="spacer-right pull-right">Priority</span>
										</div>
										<div class="btn-group visible-xs pull-right">
											<span class="spacer-right hidden-phone">$2.00</span>
											<button type="button" class="btn btn-default list-grey dropdown-toggle pull-right spacer-left" data-toggle="dropdown">
												<span class="visible-tablet">Options<span class="caret"></span></span>
												<span class="visible-phone caret"></span>
											</button>
											<ul class="list-group dropdown-menu list-grey scrollable" role="menu">
												<li class="list-group-item list-grey no-border">Priority - Up</li>
												<li class="list-group-item list-grey no-border">Priority - Down</li>
												<li class="list-group-item list-grey no-border">Change Store</li>
												<li class="list-group-item list-grey no-border">Later</li>
												<li class="list-group-item list-grey no-border">Remove</li>
											</ul>
										</div>
									</div>
									<span class="spacer-left">
								    		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;8 oz block
								    	</span>
								    	<span class="spacer-left visible-phone">
								    		$2.00
								    	</span>
								</li>
								<li class="divider list-group-item list-grey">
									<span class="glyphicon glyphicon-sort spacer-right"></span>
									Total cost:<span class="pull-right">$3.75</span>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

	</body>
</html>

