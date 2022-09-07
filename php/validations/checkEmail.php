<?php
require '../init.php';

if(!empty($_SESSION)) {
    $email_validation1 = $userHndlr->CheckUserEmail($db,array($_SESSION['id'],$_POST['email']));
    $email_validation2 = $userHndlr->CheckEmail($db,array($_POST['email']));
    
    if($email_validation1 || $email_validation2 ) {
        echo 'success';
    }
    else {
        echo 'error';
    }
}
else {
    if($userHndlr->CheckEmail($db,array($_POST['email']))) {
        echo 'success'; 
    }
    else {
        echo 'error';
    } 
}

$db->disconnect();
?>