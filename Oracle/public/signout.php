<?php include_once 'header.php'; ?>
<?php		
	session_unset();
	session_destroy();	
	header('Location: index.php');
 ?> 

 <?php include_once 'footer.php'; ?>