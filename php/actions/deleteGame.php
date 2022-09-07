<?php
require '../init.php';

if(isset($_SESSION['type'])){
	
	if($_SESSION['type'] != "admin") {
		header("Location: ../../accessDenied.php");
	}

	$id = $_GET['id'];

	if($articleHndlr->deleteArticlesByGameId($db,$id)) {
        if($gameHndlr->deleteGame($db,$id)) {
            header("Location: ../../games.php?success=1");
        }
	}
	else {
		header("Location: ../../games.php?success=0");
	}
}

?>