<?php 
require 'php/init.php';	

/* Header */
if(!empty($_SESSION)) { // checking if user is logged in
    include "php/includes/themes/headerSignedIn.php";
}
else {
    include "php/includes/themes/header.php";
    header("Location: login.php");
}
// All friend request senders
$all_req_senders = $friendHndlr->request_notification($db,$_SESSION['id'],false);
?>

    <!-- Main -->
    <main>
        <div class="profile_container">
            <?php 
            /* Profile navbar (with profile pic and username) */
            include "php/includes/themes/profileNav.php"; 
            ?>
            <div class="all_users">
                <div class="usersWrapper">
                    <?php
                    if($requests_num > 0){
                        foreach($all_req_senders as $row){
                            echo '<div class="user_box">
                                    <div class="user_img"><img src="img/uploads/profile pictures/'.$row['profile_picture'].'" 
                                    alt="Profile image"></div>
                                    <div class="user_info"><span>'.$row['username'].'</span>
                                        <a href="user_profile.php?uid='.$row['sender'].'" class="see_profileBtn">See profile</a>
                                    </div>
                                    <div>
                                        <a href="php/actions/ignore_request.php?id='.$row['sender'].'" class="req_actionBtn ignoreRequest">Ignore</a>&nbsp;
                                        <a href="php/actions/accept_request.php?id='.$row['sender'].'" class="req_actionBtn acceptRequest">Accept</a>
                                    </div>
                                </div>';
                        }
                    }
                    else{
                        echo '<h4>You have no friend requests!</h4>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>
    <!-- /.Main -->

<?php 
/* Footer */
include "php/includes/themes/footer.php" 
?>