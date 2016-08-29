<?php
	// Initial connect to create a table called wbuilder_locale
	include('../tools/mysqli.php');
	include('tools/mysqli-parser.php');
	
	// Checks to see that the button are enabled
	$tablebtn = true;
	$databtn = false;
	
	// Checks to see that the setup is complete
	$tablecomplete = false;
	$datacomplete = false;
	
	// Add table setup
	if (isset($_REQUEST['tablesetup'])) {
		// Call the 2_create_tables.sql file
		parse('sql/2_create_tables.sql', $dburl, $dbusername, $dbpassword, $dbname, $tableprefix);
		$tablebtn = false;
		$tablecomplete = true;
		$databtn = true;
	}
	
	// Add initial data setup
	if (isset($_REQUEST['initdatasetup'])) {
		// Call the 3_set_initial_data.sql file
		parse('sql/3_set_initial_data.sql', $dburl, $dbusername, $dbpassword, $dbname, $tableprefix);
		$tablebtn = false;
		$databtn = false;
		$tablecomplete = true;
		$datacomplete = true;
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Installer - Data Setup</title>
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
						<li class="active"><a>Data Setup  <span class="sr-only">(current)</span></a></li>
						<li><a href="help.php">Help</a></li>
						<li><a href="about.php">About</a></li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
		<div class="jumbotron jumbotron-blue">
			<div class="container">
				<h1>Website Builder - Data Setup</h1>
				<p>This is where you will set the final set of data for your website.</p>
				<p>Proceed with step-by-step single click set for all your data.</p>
			</div>
		</div>
		<div class="container">
			<div class="col-md-6">
				<div class="row">
					<form>
						<p>Click the button below to proceed with the table creation.</p>
						<input type="hidden" name="tablesetup" value="true">
						<div class="form-group">
							<button class="btn btn-primary btn-lg" type="submit" <?php if (!$tablebtn) echo "disabled='disabled'"?>>Start Table Creation</button>
							<?php if(!$tablebtn) { ?><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> <?php } ?>
						</div>
					</form>
					<?php if ($tablecomplete) { ?>
					<form>
						<p>Click the button below to proceed with the intial data setup.</p>
						<input type="hidden" name="initdatasetup" value="true">
						<div class="form-group">
							<button class="btn btn-primary btn-lg" type="submit" <?php if (!$databtn) echo "disabled='disabled'"?>>Start Initial Data Setup</button>
							<?php if(!$databtn) { ?><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> <?php } ?>
						</div>
					</form>
					<?php } ?>
					<?php if ($tablecomplete && $datacomplete) { ?>
						<div class="form-group">
							<a class="btn btn-primary btn-lg" href="admin.php">Proceed to Admin User Creation</a>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>