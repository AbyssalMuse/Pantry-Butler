<?php
/*  User
 *  Matches User table
 *  Each object represents a row in the table
 *  Use variables as normal, despite private visibility (i.e., $objRep->varName)
 *  See DatabaseObject.trait.php for creation information
 *  Also has validation functions for each field, use before attempting to insert new user into database
 */

require_once "Classes/DatabaseObject.trait.php";
 
class User {
	use DatabaseObjectAutoGen;
	//set these
	//private static $tableName = "User"; //Works, doesn't interfere with mysql_fetch_object
	//private static $idName = "UserID"; //set to array of names if composite key
	private $UserID;
	private $Password;	//Hash with md5() before passing here
	private $Email;
	private $ZipCode;
	private $UserName;
	private $JoinDate;
	//Restrictions
	const USERNAME_MAXWIDTH = 20;
	const PASSWORD_MAXWIDTH = 32;
	const EMAIL_MAXWIDTH = 30;
	//Help messages
	//... can't use variables/constants to define constants
	const HELP_USERNAME = "Letters only, 20 character max.";
	const HELP_PASSWORD = "Mix of letters and numbers, 32 character max. Must contain at least 1 lowercase letter, 1 uppercase letter, and 1 number.";
	const HELP_EMAIL = "Email address, 30 character max";
	const PATTERN_USERNAME = "[a-zA-Z]{1,20}";
	const PATTERN_PASSWORD = "[a-zA-Z0-9]{1,32}";
	
	//Defaults
	public static function defaultValues() {
		$data = array("JoinDate" => date("Y-m-d H:i:s",time()));
		return($data);	
	}
	
	//Validate each variable passed in
	//data should be column/value pairs
	//public abstract function validate($data) {}
	public static function validateUserName($test) {
		if (empty($test))
			return(false);
		else if (!is_string($test))
			return(false);
		else if (strlen($test) <= 0)
			return(false);
		else if (strlen($test) > User::USERNAME_MAXWIDTH)
			return(false);
		else if (preg_match("/[^[:alnum:]]/", $test))
			return(false);
		else
			return(true);
	}
	public static function validatePassword($test) {
		if (empty($test)) {
			print "1";
			return(false);
		} else if (!is_string($test)) {
			print "2";
			return(false);
		} else if (strlen($test) <= 0) {
			print "3";
			return(false);
		} else if (strlen($test) > User::PASSWORD_MAXWIDTH) {
			print "4";
			return(false);
		//} else if (!(preg_match("[a-z]", $test) && preg_match("[A-Z]", $test) && preg_match("[0-9]", $test))) {
		} else if (!(preg_match("/[a-z]/", $test))) {
			print "5";
			return(false);
		} else
			return(true);
	}
	public static function validateEmail($test) {
		if (empty($test))
			return(false);
		else if (!is_string($test))
			return(false);
		else if (strlen($test) <= 0)
			return(false);
		else if (strlen($test) > User::EMAIL_MAXWIDTH)
			return(false);
		else if (!(preg_match("/[[:alnum:]]*@/", $test)))
			return(false);
		else
			return(true);
	}
	public static function validateZipCode($test) {
		if (empty($test))
			return(false);
		else if (!is_string($test))
			return(false);
		else if (strlen($test) <= 0)
			return(false);
		else if (strlen($test) > 5)
			return(false);
		else
			return(true);
	}
	public static function validateUserID($test) {
		return(true);
	}
	public static function validateJoinDate($test) {
		return(true);
	}
}

User::$tableName = "User";
User::$idName = "UserID";
?>
