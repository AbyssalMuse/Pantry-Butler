<?php
	//Common tools, php classes
	require_once "Includes/Global.inc.php";
	
	//Variables
	$errorUsername = false;
	$errorUsernameDuplicate = false;
	$errorPassword = false;
	$errorPassword2 = false;
	$errorEmail = false;
	$errorSignup = false;
	//Task
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		//Validate input
		//Validation through static function in User class
		$errorUsername = (empty($_POST["Username"])) ? true : !(User::validateUsername($_POST["Username"]));
		if ($errorUsername == false) {
			if (!(UserTools::isNewUserName($_POST["Username"]))) {
				$errorUsernameDuplicate = true;
			}
		}
		$errorPassword = (empty($_POST["Password"])) ? true : !(User::validatePassword($_POST["Password"]));
		$errorPassword2 = (empty($_POST["Password2"])) ? true: ($_POST["Password"] != $_POST["Password2"]); //Password 1 == Password 2
		$errorEmail = (empty($_POST["Email"])) ? true : !(User::validateEmail($_POST["Email"]));
		//No errors then try to create user
		//If user successfully created, send to Initial Setup
		if (($errorUsername == false) && ($errorUsernameDuplicate == false) && ($errorPassword == false) && ($errorPassword2 == false) && ($errorEmail == false)) {
			//if (UserTools::signup($_POST["Username"], $_POST["Password"], $_POST["Email"]) == false)
			//	$errorSignup = true;
			//else {
				header("Location: InitialSetup.php");
			//}
		}
	}
?>

<!-- Do not put comments above, disrupts redirect -->
<!-- Signup
     Basic user signup page
     Validates their input through User static functions, if valid creates a new user through User::createNew
     
     Doesn't work at this time
-->

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

  		<title>The Pantry Butler - Sign Up</title>
  		
  		<!-- Common styles and javascript -->
  		<?php require_once "Includes/HTML.inc.php"; ?>
  		
  		<?php
  			if ($errorSignup)
  				echo '<script>alert("Unable to create user at this time. Please try again shortly.")</script>';
  		?>
  	</head>

  	<body>
	  	<?php require_once "Includes/Navbar.inc.php"; ?>
	  	
	  	<!-- Single accordion with form -->
	  	<!-- Use accordion with panel header to match other pages -->
	  	<!-- To do: Combine with login? -->
  		<div class="container center-block">
			<form class="form-horizontal" role="form" method="post" action="Signup.php">
				<div class="panel-group">
					<div class="panel panel-default list-grey">
						<!-- Header -->
						<div class="panel-heading">
							<h4 class="panel-title">
								<a>Sign up</a>
							</h4>
						</div>
						<!-- Body -->
						<!-- Use php to repopulate information if errors -->
						<div class="panel-body">
							<!-- Username -->
							<div class="form-group <?php if ($errorUsername) echo 'has-error'; ?>">
								<label for="InputUsername" class="col-sm-4 control-label">User name</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="InputUsername" name="Username" pattern="<?php echo User::PATTERN_USERNAME; ?>" value="<?php if (isset($_POST["Username"])) echo $_POST["Username"]; ?>">
									<span class="help-block"><?php echo User::HELP_USERNAME; ?></span> <!-- Line up with text field -->
									<?php if ($errorUsernameDuplicate) echo '<span class="help-block">That username has already been chosen.</span>'; ?>
								</div>
							</div>
							<!-- Password -->
							<div class="form-group <?php if ($errorPassword) echo 'has-error'; ?>">
								<label for="InputPassword" class="col-sm-4 control-label">Password</label>
								<div class="col-sm-8">
									<input type="password" class="form-control" id="InputPassword" name="Password" pattern="<?php echo User::PATTERN_PASSWORD; ?>" value="<?php if (isset($_POST["Password"])) echo $_POST["Password"]; ?>">
									<span class="help-block"><?php echo User::HELP_PASSWORD; ?></span> <!-- Line up with text field -->
								</div>
							</div>
							<!-- Password verify -->
							<div class="form-group <?php if ($errorPassword2) echo 'has-error'; ?>">
								<label for="InputPassword2" class="col-sm-4 control-label">Verify Password</label>
								<div class="col-sm-8">
									<input type="password" class="form-control" id="InputPassword2" name="Password2" pattern="<?php echo User::PATTERN_PASSWORD; ?>" value="<?php if (isset($_POST["Password2"])) echo $_POST["Password2"]; ?>">
									<span class="help-block">Verify password.</span> <!-- Line up with text field -->
								</div>
							</div>
							<!-- Email -->
							<div class="form-group <?php if ($errorEmail) echo 'has-error'; ?>">
								<label for="InputEmail" class="col-sm-4 control-label">Email</label>
								<div class="col-sm-8">
									<input type="email" class="form-control" id="InputEmail" name="Email" value="<?php if (isset($_POST["Email"])) echo $_POST["Email"]; ?>">
									<span class="help-block"><?php echo User::HELP_EMAIL; ?></span>  <!-- Line up with text field -->
								</div>
							</div>
						</div>
						<!-- Submit -->
						<div class="panel-footer">
							<div class="row">
								<div class="col-xs-offset-3 col-sm-offset-11">
									<input type="submit" class="btn btn-danger" value="Submit">
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>

	</body>
</html>

