<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Installer - Main</title>
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
						<li class="active"><a href="index.php">Main Page <span class="sr-only">(current)</span></a></li>
						<li><a href="mysql.php">Start Installation</a></li>
						<li><a href="help.php">Help</a></li>
						<li><a href="about.php">About</a></li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
		<div class="jumbotron jumbotron-blue">
			<div class="container">
				<h1>Website Builder - Installer</h1>
				<p>Welcome to the installer. You can install a website easily and hassle-free with this installer. Just fill up the necessary details and click next on each of the pages to finish the installation.</p>
			</div>
		</div>
		<div class="container">
			<div class="col-md-6">
				<div class="panel panel-primary row">
					<div class="panel-heading">
						<h3 class="panel-title">Requirements</h3>
					</div>
					<div class="panel-body">
						These are the basic requirements for the website builder to work. Please note that the website builder will NOT work in case any of the conditions are not satisfied by your server. In addition, make sure that the passwords are tough to crack, but easy to remember for you. Thank you.
					</div>
					<ul class="list-group">
						<li class="list-group-item list-group-item-info"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> PHP (Since you can see this page, we assume it is present.)</li>
						<li class="list-group-item"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> My SQL database</li>
						<li class="list-group-item list-group-item-info"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Morbi leo risus</li>
						<li class="list-group-item"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Porta ac consectetur ac</li>
						<li class="list-group-item list-group-item-info"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Vestibulum at eros</li>
					</ul>
				</div>
				<div class="row">
					<a class="btn btn-primary btn-lg" href="mysql.php">Proceed to installation<a/>
				</div>
			</div>
		</div>
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>