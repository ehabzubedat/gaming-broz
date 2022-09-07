<?php
require '../init.php';

// Method that redirect to profle page
function redirect_to_profile()
{
    header('Location: ../../profile.php');
    exit;
}

// check if get parameters are set
if(isset($_GET['action']) && isset($_GET['id'])){
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
            
            // IF GET SEND REQUEST ACTION
            if($_GET['action'] == 'send_req'){
                // check if friend request is already sent or not
                if($friendHndlr->request_already_sent($db,$user_ids)){
                    redirect_to_profile();
                }
                // check if the two user's are already friends 
                elseif($friendHndlr->check_if_friends($db,$user_ids)){
                    redirect_to_profile();
                }
                // Otherwise make a friend request 
                else{
                    if($friendHndlr->send_friend_request($db,array($my_id,$user_id))){
                        header('Location: ../../user_profile.php?uid='.$user_id);
                        exit;
                    }
                }
            }
            // IF GET CANCEL REQUEST OR IGNORE REQUEST ACTION
            else if($_GET['action'] == 'cancel_req' || $_GET['action'] == 'ignore_req'){
                if($friendHndlr->cancel_or_ignore_friend_request($db,$user_ids)){
                    header('Location: ../../user_profile.php?uid='.$user_id);
                    exit;
                }
            }
            // IF GET ACCEPT REQUEST ACTION
            elseif($_GET['action'] == 'accept_req'){
                if($friendHndlr->check_if_friends($db,$user_ids)){
                    redirect_to_profile();
                }
                else{
                    if($friendHndlr->make_friends($db,$user_ids,$my_id,$user_id)){
                        header('Location: ../../user_profile.php?uid='.$user_id);
                        exit;
                    }
                }
            }
            // IF GET UNFRIEND REQUEST ACTION
            elseif($_GET['action'] == 'unfriend_req'){
                if($friendHndlr->delete_friend($db,$user_ids)){
                    header('Location: ../../user_profile.php?uid='.$user_id);
                    exit;
                }
            }
            else{
                redirect_to_profile();
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