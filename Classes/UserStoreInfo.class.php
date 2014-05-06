<?php
/*  UserStoreInfo
 *  User comments and statistics for each store, including rating and first date used, etc.
 *  Matches UserStoreInfo table
 *  Each object represents a row in the table
 *  Use variables as normal, despite private visibility (i.e., $objRep->varName)
 *  See DatabaseObject.trait.php for creation information
 */

require_once "Classes/DatabaseObject.trait.php";
 
class UserStoreInfo {
	use DatabaseObjectComposite;
	
	//Variables
	private $UserID;
	private $StoreID;
	private $Rating; //tinyInt unsigned
	private $FirstUsed; //date
	private $LastUsed; //date
	private $NumberOfUses; //smallInt, unsigned
	private $AverageSpending; //float
	//Restrictions
	
	//Help messages
	//... can't use variables/constants to define constants
	
	
	//Validate each variable passed in
	//data should be column/value pairs
	//public abstract function validate($data) {}
	
}

UserStoreInfo::$tableName = "UserStoreInfo";
UserStoreInfo::$idFields = array("UserID", "StoreID");
?>
