<?php
require '../init.php';

if(isset($_POST['search']) && strlen($_POST['search']) > 0){
    $count_users = $userHndlr->searchUser($db,$_POST['search'],true);
    if($count_users > 0){
        if($userHndlr->searchUser($db,$_POST['search'])){
            $result = $userHndlr->searchUser($db,$_POST['search']);
            
            foreach($result as $user){
                echo '<div class="user_box rounded">
                        <div class="user_img"><img src="img/uploads/profile pictures/'.$user['profile_picture'].'" alt="Profile image"></div>
                        <div class="user_info"><span>'.$user['username'].'</span>
                            <a href="user_profile.php?uid='.$user['id'].'" class="see_profileBtn">See profile</a>
                        </div>
                    </div>';
            }
        }
    }
    else{
        echo '<div class="container">
                <div class="row d-flex justify-content-center">
                    <h1>User not found</h1>
                </div>
                <div class="row d-flex justify-content-center">
                    <p>The user you looking for could not be found</p>
                </div>
            </div>';
    }
}

$db->disconnect();
?>