<?php
 	require('config/connect.php')
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="jquery-ui-2/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
	<style type="text/css">
		body {font-family: monospace;}
	</style>
</head>
<body style="background-color: #F4F7F6">
	<nav class="navbar" style="background-color: #fff">
		  <div class="container-fluid">
		    <div class="navbar-header">
		      <a class="navbar-brand" href="#">Doc</a>
		    </div>
		    <ul class="nav navbar-nav navbar-right"style="margin-right:10%">
		      <li class="active"><a href="#">Home</a></li>
		      <li><a href="register.php">REGISTER</a></li> 
		    </ul>
		  </div>
	</nav>
	<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-2">
					<div class="panel panel-default">
						<div class="panel-heading">
							REGISTRATION PAGE
						</div>
						<div class="panel-body">
							<form method="post" action="config/process.php">
								<div class="form-group">
									<label>Firstname : </label>
									<input type="text" name="firstname" placeholder="Enter Firstname Here" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Lastname : </label>
									<input type="text" name="lastname" placeholder="Enter Lastname Here" class="form-control" required>
								</div>
								<div class="form-group">
									<input type="submit" name="submit" class="btn btn-md col-md-offset-4"
									 style="background-color: #0D739B;color:#fff">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			
	</div>
	<script type="text/javascript" src="js/jquery-3.1.1.js"></script>
	<script type="text/javascript" src="jquery-ui-2/jquery-ui.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>

</body>
</html>