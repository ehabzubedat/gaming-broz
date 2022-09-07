<?php
header('Content-type: application/json');

if($_POST) {
	require '../init.php';

	$response = array();

	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$birthday = $_POST['birthday'];		
	$gender = $_POST['gender'];
	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = hash('sha256',$_POST['password']);

	if(isset($_FILES['profile_picture']['name'])) {
		$allowed_types = array('jpg','jpeg');
		if(!in_array(pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION),$allowed_types)) {
			$response['status'] = 'error';
        	$response['message'] = 'Error.. Invalid image type.'; 
		}
		else {
			if($_FILES['profile_picture']['size'] > 10485760) { //10 MB (size is also in bytes)
				$response['status'] = 'error';
				$response['message'] = 'Error.. The image is too large.'; 
			} 
			else {
				$uploads_dir = '../../img/uploads/profile pictures/';
				$new_img_name = round(microtime(true) * 1000).".".pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION);
									
				if(move_uploaded_file($_FILES['profile_picture']['tmp_name'], $uploads_dir.$new_img_name)) {
					if(file_exists($uploads_dir.$new_img_name)) {
						// Insert with the image selected by the user
						if($userHndlr->insertUser($db,array($first_name,$last_name,$birthday,$gender,$email,$username,$password,$new_img_name))) {
							$response['status'] = 'success';
        					$response['message'] = 'Great! You have been successfully signed up.';
						}
						else {
							$response['status'] = 'error';
							$response['message'] = 'Error.. Please try again later.';
						}
					}
				}
			}
		}
	}

	echo json_encode($response);
	$db->disconnect();
}
?>