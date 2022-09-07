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
// All friends
$all_friends = $friendHndlr->select_all_friends($db,$_SESSION['id']);
?>

<!-- Main -->
<main>
    <div class="profile_container">
        <?php 
        /* Profile navbar (with profile pic and username) */
        include "php/includes/themes/profileNav.php"; 
        ?>

        <div class="all_users">
            <div id="friends-search-result" class="usersWrapper"></div>
            <div id="friend-list" class="usersWrapper">
                <?php
                    if($friends_num > 0){
                        foreach($all_friends as $row){
                            echo '<div class="user_box">
                                    <div class="user_img"><img src="img/uploads/profile pictures/'.$row['profile_picture'].'" alt="Profile image"></div>
                                    <div class="user_info"><span>'.$row['username'].'</span>
                                    <span><a href="user_profile.php?uid='.$row['id'].'" class="see_profileBtn">See profile</a></span></div>
                                </div>';
                        }
                    }
                    else{
                        echo '<h4>You have no friends :(</h4>';
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
