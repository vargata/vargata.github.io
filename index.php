<?php require_once 'db.php';?>

<!doctype html>
<html lang="en">
<?php include('head.php'); ?>
	<body>
		
<?php include('sidemenu.php'); ?>
	
		<div class="page_container">
		
			<div class="overlay"></div>
		
			<!-- Main content -->
			<div class="page_wrap">

<?php include 'cookies.php'; ?>

<?php include 'header.php'; ?>

<?php

if(isset($_GET['page']))
    include("./" . $_GET['page'] . '.php');
else
    include('landing.php');

?>

<?php include('newsletter.php'); ?>

<?php include('footer.php'); ?>

			</div>
			<!-- end of Main content -->

		</div>

<?php include('scripts.php'); ?>

	</body>
</html>