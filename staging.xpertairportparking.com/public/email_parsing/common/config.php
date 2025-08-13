<?php  
 
 

		define("DBUSER","manchesterairpor_usr");

		define("DBPASS","GZBFBlTLm0kI");

		define("DATABASE","manchesterairpor_database");

		define("HOST","localhost");

		define("BASEURL", rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/manchesterairportspaces.co.uk/');

		define("SITEURL",'http://manchesterairportspaces.co.uk/');
	 

		define("PREFIX","ec_");


		 require_once(BASEURL."public_html/public/email_parsing/run/common/dbase.php");
 
	

   $db = new Dbase(); 
?>