<?php
/*  Author
 *  General information for each author - names, website, etc.
 *  Matches Author table
 *  Each object represents a row in the table
 *  Use variables as normal, despite private visibility (i.e., $objRep->varName)
 *  See DatabaseObject.trait.php for creation information
 */

require_once "Classes/DatabaseObject.trait.php";
 
class Author {
	use DatabaseObjectAutoGen;
	
	//Variables
	private $AuthorID;
	private $FirstName;
	private $LastName;
	private $WebSite; //tinyText
	private $Image; //blob
	//Restrictions
	const FIRSTNAME_MAXWIDTH = 20;
	const LASTNAME_MAXWIDTH = 20;
	const WEBSITE_MAXWIDTH = 100;
	//Help messages
	//... can't use variables/constants to define constants
	const HELP_FIRSTNAME = "Letters only, 20 character max.";
	const HELP_FIRSTNAME = "Letters only, 20 character max.";
	
	//Defaults
	
	
	//Validate each variable passed in
	//data should be column/value pairs
	//public abstract function validate($data) {}
	
}

Author::$tableName = "Author";
Author::$idName = "AuthorID";
?>
