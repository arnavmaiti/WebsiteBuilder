<?php 
// Expecting $url, $username, $password, $dbname
function executesql($location) {
	$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
	if ($conn->connect_error) {
		$error_connecting = true;
	} else {
	}
	$conn->close();
}
?>