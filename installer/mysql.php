<?php 
	$servername = isset($_REQUEST["url"]) ? $_REQUEST["url"] : "localhost";
	$username = isset($_REQUEST["username"]) ? $_REQUEST["username"] : "";
	$password = isset($_REQUEST["password"]) ? $_REQUEST["password"] : "";
	$dbname = isset($_REQUEST["dbname"]) ? $_REQUEST["dbname"] : "";
	// Read the file
	$readmaster = fopen("tools/mysqli-master.php", "r");
	$masterdata = fread($readmaster, filesize("tools/mysqli-master.php"));
	fclose($readmaster);
	// Write it to the mysqli.php
	// Check if folder exists. If not, create it.
	$dirname = dirname("../tools/mysqli.php");
	if (!is_dir($dirname)) mkdir($dirname, 0755, true);
	$writeblank = fopen("../tools/mysqli.php", "w");
	fwrite($writeblank, $masterdata);
	fclose($writeblank);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Installer - MySQL Setup</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
	</head>
	<body>
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.php">Website Builder - Installer</a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li><a href="index.php">Main Page</a></li>
						<li class="active"><a>MySQL Setup  <span class="sr-only">(current)</span></a></li>
						<li><a href="help.php">Help</a></li>
						<li><a href="about.php">About</a></li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
		<div class="jumbotron jumbotron-blue">
			<div class="container">
				<h1>Website Builder - SQL Setup</h1>
				<p>A database is a collection of information that is organized so that it can easily be accessed, managed, and updated. In one view, databases can be classified according to types of content: bibliographic, full-text, numeric, and images.</p>
				<p>The installation needs MySQL for it to work properly. Please fill up the details below.</p>
			</div>
		</div>
		<div class="container">
			<div class="col-md-6">
				<div class="row">
					<form>
						<div class="form-group">
							<label for="url">Database URL</label>
							<input type="text" class="form-control" id="url" name="url" placeholder="localhost" value="<?php echo $servername; ?>">
							<p class="help-block">In case you have no idea what this should be, put it as localhost</p>
						</div>
						<div class="form-group">
							<label for="username">Database Username</label>
							<input type="text" class="form-control" id="username" name="username" placeholder="admin" value="<?php echo $username; ?>">
						</div>
						<div class="form-group">
							<label for="password">Database Password</label>
							<input type="password" class="form-control" id="password" name="password" placeholder="admin" value="<?php echo $password; ?>">
						</div>
						<div class="form-group">
							<label for="dbname">Database Name</label>
							<input type="text" class="form-control" id="dbname" name="dbname" placeholder="test" value="<?php echo $dbname; ?>">
						</div>
						<input type="hidden" name="checked" value="checked">
						<?php
							$connected = false;
							$error_connecting = false;
							if (isset($_REQUEST['checked'])) {
								// Try hitting the mysql to check if this connects. If not, throw error.
								// If it connect show the proceed button, after saving the data in a proper module.
								// Create connection
								@$conn = new mysqli($servername, $username, $password, $dbname);
								// Check connection
								if ($conn->connect_error) {
									$error_connecting = true;
								} else {
									$connected = true;
									// Set the value in tools/mysqli.php in proper format
									$readfile = fopen("../tools/mysqli.php", "r");
									// Read the file
									$data = fread($readfile, filesize("../tools/mysqli.php"));
									fclose($readfile);
									$writefile = fopen("../tools/mysqli.php", "w");
									// Update the placeholders with actual values
									$data = str_replace("_URL_", $servername, $data);
									$data = str_replace("_USERNAME_", $username, $data);
									$data = str_replace("_PASSWORD_", $password, $data);
									$data = str_replace("_DBNAME_", $dbname, $data);
									fwrite($writefile, $data);
									fclose($writefile);
								}
								@$conn->close();
							}
						?>
						<div class="form-group">
						<button type="submit" class="btn btn-default" <?php if ($connected) echo "disabled='disabled'"?>>Test Connection</button>
						<?php if ($connected) echo "<span class='text-success'>Connection successful</span>"; ?>
						<?php if ($error_connecting) echo "<span class='text-error'>Connection failed</span>"; ?>
						</div>
						
						<?php 
							if ($connected) {
						?>
						<div class="form-group">
							<a class="btn btn-primary btn-lg" href="site.php">Proceed to Site Settings</a>
						</div>
						<?php
							}
						?>
					</form>
				</div>
			</div>
		</div>
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>