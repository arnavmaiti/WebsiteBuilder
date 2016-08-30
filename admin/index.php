<?php
	// Check if the installer folder exists.
	$host = $_SERVER['HTTP_HOST'];
	$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$installer_dir = "../installer/";
	if (file_exists($installer_dir) && is_dir($installer_dir)) {
		// If so, redirect to the installer
		header("Location: http://$host$uri/$installer_dir");
	}
?>
<?php
    // Call the sso and add the auth level as admin
    require "../functions/sso.php";
    authenticate(1, "login.php");
?>