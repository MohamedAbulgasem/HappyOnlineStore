<?php
	session_start();
	//Delete session variables
	unset($_SESSION);
	//Reset the session array
	$_SESSION = array();
	//Remove session data from the server
	session_destroy();
	//Redirect to Home page
	header("Location: index.php");
?>