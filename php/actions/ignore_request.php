<?php
require '../init.php';

// Method that redirect to profle page
function redirect_to_profile()
{
    header('Location: ../../profile.php');
    exit;
}

// check if $_GET id parameter are set
if(isset($_GET['id'])){
    // check if user is logged in
    if(isset($_SESSION['id'])){
        // if parameter id is equal to $_SESSION['user id'] THEN redirect to profile
        if($_GET['id'] == $_SESSION['id']){
            redirect_to_profile();
        }
        // Otherwise do this
        else{
            // Assaign id's to variables  
            $user_id = $_GET['id'];
            $my_id = $_SESSION['id'];
            // Array of the ids of the session user id and the visited profile user id
            $user_ids = array($my_id,$user_id,$user_id,$my_id);
            
            if($friendHndlr->cancel_or_ignore_friend_request($db,$user_ids)){
                header('Location: ../../friendRequests.php');
                exit;
            }
        }
    }
    else{
        header('Location: logout.php');
        exit;
    }
}
else{
    redirect_to_profile();
}