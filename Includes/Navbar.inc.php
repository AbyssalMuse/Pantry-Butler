<!-- Navbar
     Navigation for site
     Include this just after body tag
     Header/Redirect - generates html printout, do not use before redirect
-->

<!-- Scripting for advanced mode toggle -->
<!-- Toggle simply hides/shows Advanced class of navbar -->
<!-- Also scripting to keep login dropdown open -->
<!-- To do: Put dropdown script in another script section? Not sure about two $(document).ready though -->
<?php
	//To do: Once far enough with user login, make sure this works
	//Keep advanced variable between pages
	if (!isset($_SESSION["AdvancedMenu"])) {
		//... maybe keep as user preference?
		$_SESSION["AdvancedMenu"] = false;
	}
	
	function setAdvancedMenu() {
		//To do: Paranoia check - type should be boolean
		$_SESSION["AdvancedMenu"] = $_POST["AdvancedMenu"];
	}
?>
<script>
	var advancedMode = false; //Default
	//Load on startup
	$(document).ready(function() {
		<?php
		if ($_SESSION["AdvancedMenu"] == false)
			print "advancedMenu = true; toggleManage();";
		else
			print "advancedMenu = false; toggleManage();";
		?>
		
		//Keep dropdown list open for login
		//Solution from Stack Overflow (http://stackoverflow.com/questions/10480697/keep-bootstrap-dropdown-open-on-click)
		$("ul.dropdown-menu").on("click", "[data-stopPropagation]", function(e) {
				e.stopPropagation();
		});
	});
	//Pass advanced status between pages
	//To do: Make sure this works
	$(window).bind('beforeunload', function() {
		$.post('NavBar.inc.php', {AdvancedMenu: advancedMenu});
	});
	//Toggle
	function toggleManage() {
		if (advancedMenu == false) {
			$("li.Simple.Toggle").hide();  //Manage >>
			$("li.Advanced").show(); //Includes << Manage
			advancedMenu = true;
		} else { //if (advancedMenu == true) {
			$("li.Simple.Toggle").show(); //Manage >>
			$("li.Advanced").hide(); //Including << Manage
			advancedMenu = false;
		}
	}
</script>

<!-- Navbar HTML -->
<div class="navbar-wrapper">
	<div class="container-fluid">
		<!-- Color inverse, always on top -->
		<div class="navbar navbar-inverse navbar-static-top" role="navigation">
			<div class="container">
				<!-- Collapse button, branding -->
				 <div class="navbar-header">
					 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#PBNavbarCollapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					 </button>
					<a class="navbar-brand" href="index.php">The Pantry Butler</a>
				</div>
				<!-- Full menu -->
				<div class="navbar-collapse collapse" id="PBNavbarCollapse">
					<ul class="nav navbar-nav">
						<li class="Simple"><a href="CookSelect.php">Cook!</a></li>
						<li class="dropdown Simple"><a href="ShoppingList.php">Shopping List</a></li>
						<!-- Simple toggle, Manage >> -->
						<li class="Simple Toggle" onClick="toggleManage()">
							<a>Manage
								<span class="hidden-xs visible=md"> &gt&gt </span>
								<span class="visible-xs hidden-md pull-left glyphicon glyphicon-chevron-down"> </span> <!-- pull-left or jumps to next line -->
							</a>
						</li>
						
						<!-- Advanced options -->
						<li class="dropdown Advanced"><a href="Preferences.php">Preferences</a></li>
						<li class="dropdown Advanced"><a href="Pantry.php">Pantry</a></li>
						<!-- Recipe options - View, Create -->
						<li class="dropdown Advanced" >
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Recipes<b class="caret"></b></a>
							<ul class="list-group dropdown-menu no-padding list-grey">
								<li class="list-group-item list-grey"><a href="MyRecipes.php">View</a></li>
								<li class="list-group-item list-grey"><a href="CreateRecipe.php">Create</a></li>
							</ul>
						</li>
						<!-- Calendar options - Today, 3 day, Week, Month -->
						<li class="dropdown Advanced" >
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Calendar<b class="caret"></b></a>
							<ul class="list-group dropdown-menu no-padding list-grey">
								<li class="list-group-item list-grey"><a href="Calendar.php?length=1">Today</a></li>
								<li class="list-group-item list-grey"><a href="Calendar.php?length=3">3 Day</a></li>
								<li class="list-group-item list-grey"><a href="Calendar.php?length=7">Week</a></li>
								<li class="list-group-item list-grey"><a href="Calendar.php?length=30">Month</a></li>
							</ul>
						</li>
						<!-- Advanced Toggle, << Manage -->
						<li class="Advanced Toggle" onClick="toggleManage()" >
							<a>Manage
								<span class="hidden-xs visible=md"> &lt&lt </span>
								<span class="visible-xs hidden-md pull-left glyphicon glyphicon-chevron-up"> </span> <!-- pull-left or jumps to next line -->
							</a>
						</li>
						
					</ul>
					<!-- Login -->
					<!-- Drops down a form with link to login and signup -->
					<!-- To do: Screen reader tags -->
					<div class="navbar-form navbar-right">
						<a href="#" class="btn btn-success dropdown-toggle" data-toggle="dropdown">Log in</a>
						<ul class="list-group dropdown-menu list-grey">
							<!-- Login -->
							<form role="form" method="post" action="Login.php" style="padding-left: 10px;">
								<!-- Head back to this page after login -->
								<!-- Not really safe, but works for now -->
								<!-- To do: Write javascript login that doesn't change pages -->
								<!-- To do: Alternative login procedure to get back to this page, instead of header... 
								            maybe indexes, maybe go straight to cook or shop -->
								<input type="text" class="hidden" name="Page" value="<?php echo $_SERVER['PHP_SELF']?>">
								<li class="list-group-item list-grey no-border" data-stopPropagation="true">
									<label for="LoginUsername">Name</label>
								</li>
								<li class="list-group-item list-grey no-border" data-stopPropagation="true">
									<input type="text" class="form-control" id="LoginUsername" name="Username" placeholder="Name">
								</li>
								<li class="list-group-item list-grey no-border" data-stopPropagation="true">
									<label for="LoginPassword">Password</label>
								</li>
								<li class="list-group-item list-grey no-border" data-stopPropagation="true">
									<input type="password" class="form-control" id="LoginPassword" name="Password" placeholder="Password">
								</li>
								<li class="list-group-item list-grey no-border" data-stopPropagation="true">
									<!-- Have to use input or button, anchor won't work but is desired style -->
									<input value="Log in (does not work yet, use sign up below)" style="background:none!important; border:none; padding:0!important;">
								</li>
							</form>
							<!-- Sign up -->
							<li class="list-group-item list-grey no-border">
								<a href="Signup.php">or sign up, right through here</a>
							</li>
						</ul>
					</div>
					<div class="navbar-form navbar-right">
						<a href="Presentation.php" class="btn btn-info dropdown-toggle" data-toggle="dropdown">Presentation</a>
						<ul class="list-group dropdown-menu list-grey">
							<li><a href="Presentation.php">Database and flow pictures</a></li>
							<li><a href="PresentationCode.php">Code</a>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
