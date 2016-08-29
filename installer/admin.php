<?php
	// Initial connect to create a table called wbuilder_locale
	include('../tools/mysqli.php');
	include('tools/mysqli-parser.php');
	
    $username = isset($_REQUEST["username"]) ? $_REQUEST["username"] : "";
    $firstname = isset($_REQUEST["firstname"]) ? $_REQUEST["firstname"] : "";
    $lastname = isset($_REQUEST["lastname"]) ? $_REQUEST["lastname"] : "";
    $secquestion = isset($_REQUEST["secquestion"]) ? $_REQUEST["secquestion"] : "";
    $secanswer = isset($_REQUEST["secanswer"]) ? $_REQUEST["secanswer"] : "";
    $saved = false;
    $passnomatch = false;
    $userexists = false;
    
    if (isset($_REQUEST['checked'])) {
        $result = query("SELECT id FROM ".$tableprefix."user WHERE username='".$username."'");
        if ($result->num_rows > 0) {
            $userexists = true;
        } else {
            // Check if the password is entered same twice
        $password = $_REQUEST["password"];
        $retypepass = $_REQUEST["retypepass"];
        if ($password != $retypepass) {
            $passnomatch = true;
        } else {
            // Add admin user
            $result = query("INSERT INTO ".$tableprefix."user (username, password, lastlogin, role) VALUES ('".$username."', '".md5($password)."', '".round(microtime(true) * 1000)."', '1')");
            $result = query("SELECT id FROM ".$tableprefix."user WHERE username='".$username."'");
            while($row = $result->fetch_assoc()) {
                $id = $row['id'];
            }
            // Add the user's other creds
            $result = query("INSERT INTO ".$tableprefix."user_details (userid, firstname, lastname, secquestion, secanswer) VALUES ('".$id."', '".$firstname."', '".$lastname."', '".$secquestion."', '".$secanswer."')");
            $saved = true;
        }
        }
    }
    
    // Security questions
	function secquestions() {
		global $tableprefix;
		$secquestions = array();
		$result = query("SELECT id, secquestion FROM ".$tableprefix."user_security_questions");
		while($row = $result->fetch_assoc()) {
			$secquestions[$row['id']] = $row['secquestion'];
		}
		return $secquestions;
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Installer - Admin User Setup</title>
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
						<li class="active"><a>Admin User Setup  <span class="sr-only">(current)</span></a></li>
						<li><a href="help.php">Help</a></li>
						<li><a href="about.php">About</a></li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
		<div class="jumbotron jumbotron-blue">
			<div class="container">
				<h1>Website Builder - Admin User Setup</h1>
				<p>This is where you will set the admin user for your website.</p>
				<p>Proceed with step-by-step single click set for all your data.</p>
			</div>
		</div>
		<div class="container">
			<div class="col-md-6">
				<div class="row">
					<form>
						<div class="form-group">
							<label for="username">Enter Username</label>
							<input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>" <?php if ($saved) echo "disabled='disabled'"?>>
						</div>
                        <div class="form-group">
							<label for="firstname">Enter First Name</label>
							<input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $firstname; ?>" <?php if ($saved) echo "disabled='disabled'"?>>
						</div>
                        <div class="form-group">
							<label for="lastname">Enter Last Name</label>
							<input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $lastname; ?>" <?php if ($saved) echo "disabled='disabled'"?>>
						</div>
                        <div class="form-group">
							<label for="username">Choose Security Question</label>
                            <select class="form-control" id="secquestion" name="secquestion" placeholder="Select One" value="<?php echo $secquestion; ?>" <?php if ($saved) echo "disabled='disabled'"?>>
								<?php foreach(secquestions() as $key => $value) { ?>
									<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
								<?php } ?>
							</select>
						</div>
                        <div class="form-group">
							<label for="secanswer">Enter Your Answer</label>
							<input type="text" class="form-control" id="secanswer" name="secanswer" value="<?php echo $lastname; ?>" <?php if ($saved) echo "disabled='disabled'"?>>
						</div>
                        <div class="form-group">
							<label for="password">Enter Password</label>
							<input type="password" class="form-control" id="password" name="password" <?php if ($saved) echo "disabled='disabled'"?>>
						</div>
                        <div class="form-group">
							<label for="retypepass">Enter Password Again</label>
							<input type="password" class="form-control" id="retypepass" name="retypepass" <?php if ($saved) echo "disabled='disabled'"?>>
                            <?php if ($passnomatch) echo "<span class='text-danger'>Passwords did not match</span>"; ?>
						</div>
                        <input type="hidden" name="checked" value="checked">
						<div class="form-group">
							<button class="btn btn-primary" type="submit" <?php if ($saved) echo "disabled='disabled'"?>>Create Admin User</button>
                            <?php if ($userexists) echo "<span class='text-danger'>User already exists</span>"; ?>
                            <?php if ($saved) echo "<span class='text-success'>Save successful</span>"; ?>
						</div>
					</form>
					<?php if ($saved) { ?>
						<div class="form-group">
							<a class="btn btn-primary btn-lg" href="finishup.php">Proceed to Finish Up</a>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>