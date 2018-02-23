<?php
	include_once("scripts/php/AP_functions.php");
	if(session_destroy()) // Destroying All Sessions
	{
		header("Location: index.php"); // Redirecting To Home Page
	}
?>