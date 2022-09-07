<?php 
if(basename($_SERVER['PHP_SELF']) === "user_profile.php"){
    $username = $user_data['username'];
    $profile_picture = $user_data['profile_picture'];
} 
else{
    $username = $_SESSION['username'];
    $profile_picture = $_SESSION['profile_picture'];
}
// Number of friend requests
$requests_num = $friendHndlr->request_notification($db,$_SESSION['id'],true);
// Number of friends
$friends_num = $friendHndlr->count_friends($db,$_SESSION['id']);
?>

<div class="inner_profile mt-4 mb-2 d-flex justify-content-center">
    <div class="avatar-preview profile-picture">
        <div id="imagePreview" class="image-div" style="background-image: url('img/uploads/profile pictures/<?= $profile_picture; ?>');"></div>
    </div>
</div>
<div class="col-12 d-flex justify-content-center">
    <h3 class="text-center mb-0">@<?= $username; ?></h3>
</div>
<nav>
    <ul>
        <li>
            <a href="account.php" rel="noopener noreferrer" <?php if(basename($_SERVER['PHP_SELF']) === "account.php"){echo 'class="active-nav"';}?>>Account
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle <?php if(basename($_SERVER['PHP_SELF']) === "myFriends.php" || basename($_SERVER['PHP_SELF']) === "friendRequests.php" || basename($_SERVER['PHP_SELF']) === "searchFriends.php"){echo 'active-nav';}?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Friends
                <span class="badge"><?php echo $friends_num + $requests_num; ?></span>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item m-0 <?php if(basename($_SERVER['PHP_SELF']) === "myFriends.php"){echo 'active-nav';}?>" href="myFriends.php">
                    My Friends
                    <span class="badge"><?php echo $friends_num; ?></span>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item m-0 <?php if(basename($_SERVER['PHP_SELF']) === "friendRequests.php"){echo 'active-nav';}?>" href="friendRequests.php" rel="noopener noreferrer">Freind Requests
                    <span class="badge"><?php echo $requests_num; ?></span>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item m-0 <?php if(basename($_SERVER['PHP_SELF']) === "searchFriends.php"){echo 'active-nav';}?>" href="searchFriends.php">Search For Friends</a>
            </div>
        </li>
        <?php
        if($_SESSION['type'] === 'admin'){
            include "php/includes/themes/adminMangamentNav.php";
        }
        ?>
        <li><a href="php/actions/logout.php" rel="noopener noreferrer">Logout</a></li>
    </ul>
</nav>
