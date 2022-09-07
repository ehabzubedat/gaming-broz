<?php
require '../init.php';

if(!empty($_SESSION)) {
    $username_validation1 = $userHndlr->CheckUserUsername($db,array($_SESSION['id'],$_POST['username']));
    $username_validation2 = $userHndlr->CheckUsername($db,array($_POST['username']));
    
    if($username_validation1 || $username_validation2) {
        echo 'success';   
    }
    else{
        echo 'error';
    }
}
else {
    if($userHndlr->CheckUsername($db,array($_POST['username']))) {
        echo 'success'; 
    }
    else {
        echo 'error';
    }
}

$db->disconnect();
?>