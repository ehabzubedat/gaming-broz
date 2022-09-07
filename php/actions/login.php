<?php
require '../init.php';
header('Content-type: application/json');

$response = array();
    
if(isset($_POST['username']) && isset($_POST['password']))
{
    if($userHndlr->login($db,array($_POST['username'],hash('sha256',$_POST['password']))) == 1)
    {
        $_SESSION = $userHndlr->getUserData($db,array($_POST['username'],hash('sha256',$_POST['password'])));
        $response['status'] = 'success';
    }
    else
    {
        $response['status'] = 'error';
        $response['message'] = 'Invalid username or password!'; 
    }
}

echo json_encode($response);
$db->disconnect();
?>