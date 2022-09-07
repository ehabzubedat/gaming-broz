<?php
require '../init.php';
header('Content-type: application/json');

$response = array();

if(isset($_GET['id']) && isset($_POST['game_title']) && 
	($_POST['game_download_link']) && isset($_POST['game_trailer_link'])) {
	// Data
	$id = $_GET['id'];
	$name = $_POST['game_title'];
	$download_link = $_POST['game_download_link'];
	$trailer_link = $_POST['game_trailer_link'];
	$allowed_image_types = array('jpg','jpeg');
		
	// Check if there is a file uploaded
	if($_FILES['game_image']['size'] > 0){
		if($_FILES['game_image']['size'] > 10485760) { //10 MB (size is also in bytes)
			$response['status'] = 'error';
			$response['message'] = 'Image file size is too big!';
		} 
		else if(!in_array(pathinfo($_FILES['game_image']['name'], PATHINFO_EXTENSION),$allowed_image_types)) {
			$response['status'] = 'error';
			$response['message'] = 'Invalid image type only jpg and jpeg allowed!';
		}
		else {
			$uploads_dir = '../../img/uploads/games/';
			$new_img_name = round(microtime(true) * 1000).".".pathinfo($_FILES['game_image']['name'], PATHINFO_EXTENSION);
					
			move_uploaded_file($_FILES['game_image']['tmp_name'], $uploads_dir.$new_img_name);

			if(file_exists($uploads_dir.$new_img_name)){
				$update_query = "UPDATE games SET name=?, download_link=?, trailer_link=?, photo=? WHERE id=?";
				if($gameHndlr->updateGame($db,$update_query,array($name,$download_link,$trailer_link,$new_img_name,$id))) {
					$response['status'] = 'success';
					$response['message'] = 'Great! Game updated successfully.';
				}
				else {
					$response['status'] = 'error';
					$response['message'] = 'Error.. Couldnt update game!';
				}
			}
		}
	}
	else {
		$update_query = "UPDATE games SET name=?, download_link=?, trailer_link=? WHERE id=?";
		if($gameHndlr->updateGame($db,$update_query,array($name,$download_link,$trailer_link,$id))) {
			$response['status'] = 'success';
			$response['message'] = 'Great! Game updated successfully.';
		}
		else {
			$response['status'] = 'error';
			$response['message'] = 'Error.. Couldnt update game!';
		}
	}
}


echo json_encode($response);
$db->disconnect();
?>