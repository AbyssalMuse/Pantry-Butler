<?php
/*  Brand
 *  General information for each brand (Kroger, Wal-Mart, etc.) - name, website, image, etc.
 *  Matches Brand table
 *  Each object represents a row in the table
 *  Use variables as normal, despite private visibility (i.e., $objRep->varName)
 *  See DatabaseObject.trait.php for creation information
 */

require_once "Classes/DatabaseObject.trait.php";
 
class Brand {
	use DatabaseObjectAutoGen;
	
	//Variables
	private $BrandID;
	private $Name;
	private $WebSite; //tinyText
	private $Image; //blob
	//Restrictions
	const NAME_MAXWIDTH = 20;
	//Help messages
	//... can't use variables/constants to define constants
	const HELP_NAME = "Letters only, 20 character max.";
	
	//Defaults
	
	
	//Validate each variable passed in
	//data should be column/value pairs
	//public abstract function validate($data) {}
	
}

Brand::$tableName = "Brand";
Brand::$idName = "BrandID";
?>
