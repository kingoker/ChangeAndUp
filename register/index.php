<?php
	require "db.php"; 
	if (isset ($_SESSION['logged_user']) ){
		header('Location: courses.html');

	}else
		header('Location: sign-up.php');
?>