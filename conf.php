<?php
	//session_set_cookie_params(0,"/","",1,1);
	session_start();

	require_once './db/database.php';
	require_once './lib/error.php';
	require_once './lib/site_control.php';
	require_once './lib/sanitize.php';
	require_once './lib/Entries.php';

?>