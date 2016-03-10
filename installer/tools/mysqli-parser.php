<?php 
// This is a very basic parser, with no batch commit or rollback.
// This needs to be updated later to a better version.

// Always remember to include mysqli.php to include the db data.
// Only expecting insert and update statements. So no returns.
function parse($location, $url, $username, $password, $dbname, $tableprefix) {
	// Find the file
	$readsql = fopen($location, "r");
	if ($readsql) {
		while (($line = fgets($readsql)) !== false) {
			// Adding a check if the line contains a # in front, meaning comment.
			if ((substr($line, 0, 1) !== "#")) {
				// process the line read.
				executesql($line, $url, $username, $password, $dbname, $tableprefix);
			}
		}
		fclose($readsql);
	} else {
		fclose($readsql);
		// error opening the file.
		return false;
	}
	return true;
}

// Expecting $url, $username, $password, $dbname
function executesql($statement, $url, $username, $password, $dbname, $tableprefix) {
	// Replace the __prefix__ with the actual table prefix
	$statement = str_replace("__prefix__", $tableprefix, $statement);
	$conn = new mysqli($url, $username, $password, $dbname);
		// Check connection
	if ($conn->connect_error) {
		return false;
	} else {
		if ($conn->query($statement) === TRUE) {
			return true;
		} else {
			return false;
		}
	}
	$conn->close();
}
?>