<?php
/*  Measurement
 *  Lookup, array of available measurement names - lb, kilo, oz, etc.
 *  Matches Measurement table
 *  Each object represents a row in the table
 *  Use variables as normal, despite private visibility (i.e., $objRep->varName)
 *  See DatabaseObject.trait.php for creation information
 */

require_once "Classes/DatabaseObject.trait.php";
 
class Measurement {
	use DatabaseObjectSimple;
	
	//Variables
	private $MeasurementName;
	
	const NAME_MAXWIDTH = 15;
	
	//Validate each variable passed in
	//data should be column/value pairs
	//public abstract function validate($data) {}
	
}

Measurement::$tableName = "Measurement";
Measurement::$idName = "MeasurementName";
?>
