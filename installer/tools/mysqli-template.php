<?php
	$url = "_URL_";
	$username = "_USERNAME_";
	$password = "_PASSWORD_";
	$dbname = "_DBNAME_";
	$tableprefix = "_TABLEPREFIX_";
	function query($query) {
		global $url;
		global $username;
		global $password;
		global $dbname;
		$conn = new mysqli($url, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			$error_connecting = true;
		} else {
			$result = $conn->query($query);
		}
		$conn->close();
		return $result;
	}
	function multi_query($query) {
		global $url;
		global $username;
		global $password;
		global $dbname;
		$conn = new mysqli($url, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			$error_connecting = true;
		} else {
			$result = $conn->multi_query($query);
		}
		$conn->close();
		return $result;
	}
?>