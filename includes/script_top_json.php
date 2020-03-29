<?php

	include(dirname(__FILE__).'/../classes/configure.php'); 
	$conClass = new Connect;
	$con = $conClass->dbconnect();	

	include(DIR_BASEADMIN.DIR_CLASSES.'definefilename.php');
	include(DIR_BASEADMIN.DIR_CLASSES.'definetablename.php');	
	include(DIR_BASEADMIN.DIR_FUNCTIONS.'mysqlfunction.php');	
	include(DIR_BASEADMIN.DIR_FUNCTIONS.'utilityfunction.php');	
        include(DIR_BASEADMIN.DIR_CLASSES.'login.php');	
        
?>