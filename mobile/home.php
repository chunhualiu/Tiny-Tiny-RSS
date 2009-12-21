<?php
	error_reporting(E_ERROR | E_WARNING | E_PARSE);

	header('Content-Type: text/html; charset=utf-8');

	define('MOBILE_VERSION', true);

	require_once "../config.php";
	require_once "functions.php";
	require_once "../functions.php"; 

	require_once "../sessions.php";

	require_once "../version.php"; 
	require_once "../db-prefs.php";

	$link = db_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	init_connection($link);

	login_sequence($link, true);

	$use_cats = mobile_get_pref($link, 'ENABLE_CATS');
	$offset = (int) db_escape_string($_REQUEST["skip"]);

	if ($use_cats) {
		render_categories_list($link); 
	} else {
		render_flat_feed_list($link, $offset);
	}
?>