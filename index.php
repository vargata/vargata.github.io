<?php require_once './src/db.php'; ?>

<!doctype html>
<html lang="en">
<?php include('./src/head.php'); ?>
	<body>
		
<?php include('./src/sidemenu.php'); ?>
	
		<div class="page_container">
		
			<div class="overlay"></div>
		
			<!-- Main content -->
			<div class="page_wrap">

<?php include './src/cookies.php'; ?>

<?php include './src/header.php'; ?>

<?php

if(isset($_GET['page']))
    include("./" . $_GET['page'] . '.php');
else
    include('./landing.php');

?>

<?php include('./src/newsletter.php'); ?>

<?php include('./src/footer.php'); ?>

			</div>
			<!-- end of Main content -->

		</div>

<?php include('./src/scripts.php'); ?>

	</body>
</html>