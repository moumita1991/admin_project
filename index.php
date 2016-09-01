<?php 
	define('ROOT', dirname(__FILE__));

	session_start();
	include_once 'admin/users/user.crud.php';

	if(isset($_SESSION["userSession"])!='') {
		header("Location: admin/dashboard.php");
		return;
	}

	if(isset($_POST["loginUsername"]) && isset($_POST["loginPassword"])) {
		$username = trim($_POST['loginUsername']);
	    $username = strip_tags($username);
	    $username = htmlspecialchars($username);
	  
	    $pass = trim($_POST['loginPassword']);
	    $pass = strip_tags($pass);
	    $pass = htmlspecialchars($pass);

	    $userCrud = new CRUDUser();

	    $res = $userCrud->userExists($username,$pass);

	    if(mysql_num_rows($res)) {
	    	$row = mysql_fetch_array($res);
	    	$_SESSION["userSession"] = $row["user_id"];

	    	header("Location: admin/dashboard.php");
	    	return;
	    } else {
	    	$msg = 'Username/password does not match!!';
	    }
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<?php include 'includes_resources.php' ?>
</head>
<body class="login-body">
<div class="container-fluid">
	<div class="top-fill"></div>
	<div class="row">
		<div class="col-sm-12 col-md-6 col-sm-offset-0 col-md-offset-3">
			<div class="panel panel-primary shadow-panle">
				<div class="panel-heading">
					Please Login
				</div>	
				<div class="panel-body">
					<?php
						if(isset($msg)) {
							?>
							<div class="alert alert-warning alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span></button>
  								<strong><?php echo $msg ?></strong>
							</div>
							<?php
						}
					?>
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" autocomplete="false">
						<div class="form-group">
							<label for="loginUsername">Username</label>
    						<input type="text" class="form-control" id="loginUsername" name="loginUsername" placeholder="Username">
						</div>
						<div class="form-group">
							<label for="loginPassword">Password</label>
    						<input type="password" class="form-control" id="loginPassword" name="loginPassword" placeholder="Username">
						</div>
						<div class="form-group text-right">
							<button class="btn btn-success btn-lg" type="submit">Login</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>