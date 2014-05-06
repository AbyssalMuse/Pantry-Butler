<!-- Index
     Splash page with basic examples of how the site can help you
     Was using http://www.pearltrees.com/ as inspiration, but they've changed it into something better yet in the last few months
-->
<!-- To do: No separate signup/login page, just include it right on this page -->

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

  		<title>The Pantry Butler</title>
  		
  		<!-- Common styles and javascript -->
  		<?php require_once "Includes/HTML.inc.php"; ?>
  	</head>

  	<body>
		<?php require_once "Includes/Navbar.inc.php"; ?>
		
		<!-- Spacer, about third of screen down -->
		<br><br><br>
		<div class="container">
			<div class="row">
				<div class="col-sm-offset-1">
					<h1>What can the Pantry Butler do for you?</h1>
				</div>
			</div>
		</div>
		<br><br>
		<!-- Pictures and Signup buttons -->
		<!-- Signup in middle, surrounded by pictures at four corners -->
		<!-- To do: Make sure signup button is in screen on phone -->
		<!-- To do: Create pictures instead of text, continue to use panels? -->
		<div class="container">
			<!-- Pictures -->
			<div class="row">
				<div class="col-sm-3 col-sm-offset-1">
					<div class="panel-group">
						<!-- Example: Pantry -->
						<div class="panel panel-default list-grey">
							<div class="panel-heading">
								<h4 class="panel-title">Keep your pantry stocked</h4>
							</div>
							<div class="panel-body">
								<h1>Picture here</h1>
								<h3>Butler passing food to you at stove</h3>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-3 col-sm-offset-4">
					<div class="panel-group">
						<!-- Example: Recipe -->
						<div class="panel panel-default list-grey">
							<div class="panel-heading">
								<h4 class="panel-title">Suggest recipes</h4>
							</div>
							<div class="panel-body">
								<h1>Picture here</h1>
								<h3>Butler reading books, passing notes to you</h3>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Signup -->
			<br><br><br>
			<div class="row">
				<div class="col-sm-4 col-sm-offset-4">
					<!-- To do: Different button style -->
					<a href="Signup.php" class="btn btn-info btn-lg btn-block">Sign up</a>
				</div>
			</div>
			<br><br><br>
			<!-- More picture -->
			<div class="row">
				<div class="col-sm-3 col-sm-offset-1">
					<div class="panel-group">
						<!-- Example: Money -->
						<div class="panel panel-default list-grey">
							<div class="panel-heading">
								<h4 class="panel-title">Save you money</h4>
							</div>
							<div class="panel-body">
								<h1>Picture here</h1>
								<h3>Butler juggling food between trashcan and kitchen</h3>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-3 col-sm-offset-4">
					<div class="panel-group">
						<!-- Example: Shopping -->
						<div class="panel panel-default list-grey">
							<div class="panel-heading">
								<h4 class="panel-title">Organize your shopping list</h4>
							</div>
							<div class="panel-body">
								<h1>Picture here</h1>
								<h3>Butler following you in the store... following, not stalking...</h3>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
