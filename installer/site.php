<?php
	// Initial connect to create a table called wbuilder_locale
	include('../tools/mysqli.php');
	include('tools/mysqli-parser.php');
	// Call the 1_create_localization_sql.sql file
	parse('sql/1_create_localization.sql', $dburl, $dbusername, $dbpassword, $dbname, $tableprefix);
	
	$sitetitle = isset($_REQUEST["sitetitle"]) ? $_REQUEST["sitetitle"] : "";
	$sitedesc = isset($_REQUEST["sitedesc"]) ? $_REQUEST["sitedesc"] : "";
	$language = isset($_REQUEST["language"]) ? $_REQUEST["language"] : "";
	$timezone = isset($_REQUEST["timezone"]) ? $_REQUEST["timezone"] : "";
	$saved = false;
	$error_connecting = false;
	if (isset($_REQUEST['checked'])) {
		// Try hitting the mysql to check if this connects. If not, throw error.
		// If it connect show the proceed button, after saving the data in a proper module.
		// Create connection
		$conn = new mysqli($dburl, $dbusername, $dbpassword, $dbname);
		// Check connection
		if ($conn->connect_error) {
			$error_connecting = true;
		} else {
			// Save the data in the site table
			$sql = "INSERT INTO ".$tableprefix."site (site_key, site_value) VALUES ('sitetitle', '".$conn->real_escape_string($sitetitle)."');";
			$sql .= "INSERT INTO ".$tableprefix."site (site_key, site_value) VALUES ('sitedesc', '".$conn->real_escape_string($sitedesc)."');";
			$sql .= "INSERT INTO ".$tableprefix."site (site_key, site_value) VALUES ('language', '".$conn->real_escape_string($language)."');";
			$sql .= "INSERT INTO ".$tableprefix."site (site_key, site_value) VALUES ('timezone', '".$conn->real_escape_string($timezone)."');";
			$result = multi_query($sql);
		}
		$conn->close();
		$saved = true;
	}
	// Locales
	function locales() {
		global $tableprefix;
		$locales = array();
		$result = query("SELECT locale, name FROM ".$tableprefix."locale");
		while($row = $result->fetch_assoc()) {
			$locales[$row['locale']] = $row['name'];
		}
		return $locales;
	}
	// Timezones
	function generate_timezone_list() {
		static $regions = array(
			DateTimeZone::AFRICA,
			DateTimeZone::AMERICA,
			DateTimeZone::ANTARCTICA,
			DateTimeZone::ASIA,
			DateTimeZone::ATLANTIC,
			DateTimeZone::AUSTRALIA,
			DateTimeZone::EUROPE,
			DateTimeZone::INDIAN,
			DateTimeZone::PACIFIC,
		);
		$timezones = array();
		foreach( $regions as $region )
		{
			$timezones = array_merge( $timezones, DateTimeZone::listIdentifiers( $region ) );
		}
		$timezone_offsets = array();
		foreach( $timezones as $timezone )
		{
			$tz = new DateTimeZone($timezone);
			$timezone_offsets[$timezone] = $tz->getOffset(new DateTime);
		}
		// sort timezone by timezone name
		ksort($timezone_offsets); 
		$timezone_list = array();
		foreach( $timezone_offsets as $timezone => $offset )
		{
			$offset_prefix = $offset < 0 ? '-' : '+';
			$offset_formatted = gmdate( 'H:i', abs($offset) ); 
			$pretty_offset = "UTC${offset_prefix}${offset_formatted}";       
			$t = new DateTimeZone($timezone);
			$c = new DateTime(null, $t);
			$current_time = $c->format('g:i A');
			$timezone_list["(${pretty_offset}) $timezone"] = "$timezone - $current_time (${pretty_offset})";
		}
		return $timezone_list;
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Installer - Site Setup</title>
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
						<li class="active"><a>Site Setup  <span class="sr-only">(current)</span></a></li>
						<li><a href="help.php">Help</a></li>
						<li><a href="about.php">About</a></li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
		<div class="jumbotron jumbotron-blue">
			<div class="container">
				<h1>Website Builder - Site Setup</h1>
				<p>Site data is needed to set up your site properly with data such as site name, title, language, time etc.</p>
				<p>The site setup is needed to show your site properly. Please fill up the details below.</p>
			</div>
		</div>
		<div class="container">
			<div class="col-md-6">
				<div class="row">
					<form>
						<div class="form-group">
							<label for="sitetitle">Site Title</label>
							<input type="text" class="form-control" id="sitetitle" name="sitetitle" placeholder="Website Builder" value="<?php echo $sitetitle; ?>" <?php if ($saved) echo "disabled='disabled'"?>>
						</div>
						<div class="form-group">
							<label for="sitedesc">Site Description</label>
							<textarea class="form-control" id="sitedesc" name="sitedesc" placeholder="Put your site description here" value="<?php echo $sitedesc; ?>" rows="3" <?php if ($saved) echo "disabled='disabled'"?>></textarea>
						</div>
						<div class="form-group">
							<label for="language">Site Language</label>
							<select class="form-control" id="language" name="language" placeholder="admin" value="<?php echo $language; ?>" <?php if ($saved) echo "disabled='disabled'"?>>
								<?php foreach(locales() as $key => $value) { ?>
									<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label for="timezone">Timezone</label>
							<select class="form-control" id="language" name="timezone" placeholder="admin" value="<?php echo $timezone; ?>" <?php if ($saved) echo "disabled='disabled'"?>>
								<?php foreach(generate_timezone_list() as $key => $value) { ?>
									<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
								<?php } ?>
							</select>
						</div>
						<input type="hidden" name="checked" value="checked">
						<div class="form-group">
						<button type="submit" class="btn btn-primary" <?php if ($saved) echo "disabled='disabled'"?>>Save</button>
						<?php if ($saved) echo "<span class='text-success'>Save successful</span>"; ?>
						<?php if ($error_connecting) echo "<span class='text-error'>Save failed</span>"; ?>
						</div>
						
						<?php 
							if ($saved) {
						?>
						<div class="form-group">
							<a class="btn btn-primary btn-lg" href="data.php">Proceed to Data Setup</a>
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