<?php
	/* Global
	** Includes general tools and classes for all pages
	** Include this on top of page
	** Header/Redirect - should be safe to use
	*/
	
	//To do: Remove this page? Session stuff is necessary, maybe user, but trying to get rid of DatabaseTools and UserTools

	//Session
	session_start();
	
	//General tools
	require_once "Classes/User.class.php";
	require_once "Classes/UserTools.class.php";
	require_once "Classes/DatabaseTools.class.php";
	
	//Initialize
	$userTools = new UserTools();
	date_default_timezone_set('America/New_York'); //I forget what warning this prevents, but keeps database quiet
	//Connect to database
	$dbo = new DatabaseTools();
	$dbo->connect();
?>

