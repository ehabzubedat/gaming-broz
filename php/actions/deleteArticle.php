<?php
require '../init.php';

if(isset($_SESSION['type'])){
	
	if($_SESSION['type'] != "admin") {
		header("Location: ../../accessDenied.php");
	}
	
	$id = $_GET['id'];

	if($articleHndlr->deleteArticle($db,$id)) {
		header("Location: ../../articles.php?success=1");
	}
	else {
		header("Location: ../../articles.php?success=0");
	}
}
?>