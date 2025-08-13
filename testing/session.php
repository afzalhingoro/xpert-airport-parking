<?php
date_default_timezone_set('Europe/London');
error_reporting(E_ALL & ~E_NOTICE);
include 'include/class.db.php';

$db = new DB();
$db->init('localhost', 'parkingz_parking', '1Qi^6Y=OHrI)', 'parkingz_parkingzone', '');

include 'library/functions.php';

function set_cookie($cookie_value){
	$cookie_name = "traffic";
	setcookie($cookie_name, $cookie_value, time() + (3600), "/");
}
function create_cookie($cookie_value){
	if (isset($_COOKIE['traffic'])) {
		unset($_COOKIE['traffic']);
	}
	set_cookie($cookie_value);
}
?>