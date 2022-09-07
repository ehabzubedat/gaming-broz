<?php
require '../init.php';
header('Content-type: application/json');

$response = array();

if(isset($_GET['id']) && isset($_POST['article_title']) && ($_POST['article_content'])) {
	// Data
	$id = $_GET['id'];
	$title = $_POST['article_title'];
	$content = $_POST['article_content'];
	$allowed_image_types = array('jpg','jpeg');

	// Check if there is a file uploaded
	if($_FILES['article_image']['size'] > 0) {
		if($_FILES['article_image']['size'] > 10485760) { //10 MB (size is also in bytes)
			$response['status'] = 'error';
			$response['message'] = 'Image file size is too big!';
		} 
		else if(!in_array(pathinfo($_FILES['article_image']['name'], PATHINFO_EXTENSION),$allowed_image_types)) {
			$response['status'] = 'error';
			$response['message'] = 'Invalid image type only jpg and jpeg allowed!';
		}
		else {
			$uploads_dir = '../../img/uploads/articles/';
			$new_img_name = round(microtime(true) * 1000).".".pathinfo($_FILES['article_image']['name'], PATHINFO_EXTENSION);
					
			move_uploaded_file($_FILES['article_image']['tmp_name'], $uploads_dir.$new_img_name);

			if(file_exists($uploads_dir.$new_img_name)){
				$update_query = "UPDATE articles SET title=?, content=?, image=?, last_updated=NOW() WHERE id=?";
				if($gameHndlr->updateGame($db,$update_query,array($title,$content,$new_img_name,$id))) {
					$response['status'] = 'success';
					$response['message'] = 'Great! Article updated successfully.';
				}
				else {
					$response['status'] = 'error';
					$response['message'] = 'Error.. Couldnt update article!';
				}
			}
		}
	}
	else {
		$update_query = "UPDATE articles SET title=?, content=?, last_updated=NOW() WHERE id=?";
		if($gameHndlr->updateGame($db,$update_query,array($title,$content,$id))) {
			$response['status'] = 'success';
			$response['message'] = 'Great! Article updated successfully.';
		}
		else {
			$response['status'] = 'error';
			$response['message'] = 'Error.. Couldnt update article!';
		}
	}
}


echo json_encode($response);
$db->disconnect();
?>