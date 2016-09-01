<?php 
	session_start();

	if(!isset($_SESSION["userSession"]) || $_SESSION["userSession"]=='') {
		header("Location: index.php");
		return;
	}
	include_once './users/user.crud.php';

	$userCrud = new CRUDUser();

	$userData = mysql_fetch_array($userCrud->readSingle($_SESSION["userSession"]));
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<?php include '../includes_resources.php' ?>
</head>
<body class="dashboard-home">
<?php include 'admin_header_include.php' ?>
</body>
</html>