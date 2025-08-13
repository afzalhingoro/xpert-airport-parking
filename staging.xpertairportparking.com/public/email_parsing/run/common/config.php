<?php  
 

		define("DBUSER","manchesterairpor_usr");

		define("DBPASS","GZBFBlTLm0kI");

		define("DATABASE","manchesterairpor_database");

		define("HOST","localhost");

		define("BASEURL", rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/');

		define("SITEURL",'http://manchesterairportspaces.co.uk/');
	 

		define("PREFIX","ec_");


		 require_once(BASEURL."public/email_parsing/common/dbase.php");
 
	

   $db = new Dbase(); 
?>