<?php
	$dburl = "_URL_";
	$dbusername = "_USERNAME_";
	$dbpassword = "_PASSWORD_";
	$dbname = "_DBNAME_";
	$tableprefix = "_TABLEPREFIX_";
	function query($query) {
		global $dburl;
		global $dbusername;
		global $dbpassword;
		global $dbname;
		$conn = new mysqli($url, $dbusername, $dbpassword, $dbname);
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
		global $dburl;
		global $dbusername;
		global $dbpassword;
		global $dbname;
		$conn = new mysqli($url, $dbusername, $dbpassword, $dbname);
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