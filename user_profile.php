<?php 
require 'php/init.php';	

/* Header */
if(!empty($_SESSION)) { // checking if user is logged in
    if(isset($_GET['uid'])){
        $user_data = $userHndlr->getUserDataById($db,array($_GET['uid']));
        if($user_data ==  true){
            if($user_data['id'] == $_SESSION['id']){
                header('Location: account.php');
                exit;
            }
        } 
    }
    include "php/includes/themes/headerSignedIn.php";
}
else {
    include "php/includes/themes/header.php";
    header("Location: login.php");
}
// Array of the ids of the session user id and the visited profile user id
$user_ids = array($_SESSION['id'],$user_data['id'],$user_data['id'],$_SESSION['id']);
// Check friends
$is_already_friends = $friendHndlr->check_if_friends($db,$user_ids);
// if i am the request sender 
$check_req_sender = $friendHndlr->check_if_sender_or_reciver($db,array($_SESSION['id'],$user_data['id']));
// if i am the request reciver 
$check_req_receiver = $friendHndlr->check_if_sender_or_reciver($db,array($user_data['id'],$_SESSION['id']));
?>

    <!-- Main -->
    <main>
        <div class="profile_container">
            <?php 
            /* Profile navbar (with profile pic and username) */
            include "php/includes/themes/profileNav.php"; 
            ?>
            <div class="actions rounded">
                <?php
                if($is_already_friends){
                    echo '<a href="php/actions/functions.php?action=unfriend_req&id='.$user_data['id'].'" class="req_actionBtn unfriend">Unfriend</a>';
                }
                elseif($check_req_sender){
                    echo '<a href="php/actions/functions.php?action=cancel_req&id='.$user_data['id'].'" class="req_actionBtn cancleRequest">Cancel Request</a>';
                }
                elseif($check_req_receiver){
                    echo '<a href="php/actions/functions.php?action=ignore_req&id='.$user_data['id'].'" class="req_actionBtn ignoreRequest">Ignore</a>&nbsp;
                            <a href="php/actions/functions.php?action=accept_req&id='.$user_data['id'].'" class="req_actionBtn acceptRequest">Accept</a>';
                }
                else{
                    echo '<a href="php/actions/functions.php?action=send_req&id='.$user_data['id'].'" class="req_actionBtn sendRequest">Send Request</a>';
                }
                ?>
            </div>

        </div>
    </main>
    <!-- /.Main -->

<?php 
/* Footer */
include "php/includes/themes/footer.php" 
?>